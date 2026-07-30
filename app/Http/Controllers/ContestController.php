<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ContestController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | CONTEST LIST
    |--------------------------------------------------------------------------
    */

    public function index()
    {

        $contests = Contest::all();


        return view(
            'contests.index',
            compact('contests')
        );

    }



    /*
    |--------------------------------------------------------------------------
    | SETTINGS PAGE
    |--------------------------------------------------------------------------
    */

    public function settings(Contest $contest)
    {

        $contest->load([
            'contestants',
            'judges',
            'exposures',
            'criteria'
        ]);


        return view(
            'contests.settings',
            compact('contest')
        );

    }





    /*
    |--------------------------------------------------------------------------
    | ACTIVATE CONTEST
    |--------------------------------------------------------------------------
    */

    public function activate(Contest $contest)
    {

        Contest::where('is_active',true)
            ->update([
                'is_active'=>false
            ]);



        $contest->update([

            'is_active'=>true,

            'is_completed'=>false

        ]);



        return back()->with(
            'success',
            'Contest activated successfully!'
        );

    }






    /*
    |--------------------------------------------------------------------------
    | COMPLETE CONTEST
    |--------------------------------------------------------------------------
    */

    public function complete(Contest $contest)
    {

        $contest->update([

            'is_completed'=>true,

            'is_active'=>false

        ]);



        return back()->with(
            'success',
            'Contest completed successfully!'
        );

    }







    /*
    |--------------------------------------------------------------------------
    | TABULATION PAGE
    |--------------------------------------------------------------------------
    */

    public function tabulate(Contest $contest)
    {


        $contest->load([

            'contestants',

            'judges',

            'exposures.criteria',

            'scores'

        ]);



        return view(
            'contests.tabulate',
            compact('contest')
        );


    }








    /*
    |--------------------------------------------------------------------------
    | CREATE CONTEST
    |--------------------------------------------------------------------------
    */

    public function create()
    {

        return view(
            'contests.create'
        );

    }








    /*
    |--------------------------------------------------------------------------
    | STORE CONTEST
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {


        $request->validate([


            'name'=>'required',

            'contest_type'=>'required',

            'judge_count'=>'required|integer|min:1',

            'contestant_count'=>'required|integer|min:1',

            'tabulator_name'=>'nullable|max:255'


        ]);




        Contest::create([


            'name'=>$request->name,

            'contest_type'=>$request->contest_type,

            'judge_count'=>$request->judge_count,

            'contestant_count'=>$request->contestant_count,

            'tabulator_name'=>$request->tabulator_name,


            'logo'=>null,

            'pageant_logo'=>null,


            'is_active'=>false,

            'is_completed'=>false


        ]);





        return redirect()

            ->route('contests.index')

            ->with(

                'success',

                'Contest created successfully!'

            );


    }








    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Contest $contest)
    {


        $contest->load(
            'contestants'
        );


        return view(
            'contests.show',
            compact('contest')
        );


    }








    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Contest $contest)
    {


        return view(
            'contests.edit',
            compact('contest')
        );


    }








    /*
    |--------------------------------------------------------------------------
    | UPDATE CONTEST WITH LOGO
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Contest $contest)
    {


        $request->validate([


            'name'=>'required|max:255',

            'contest_type'=>'required',

            'judge_count'=>'required|integer|min:1',

            'contestant_count'=>'required|integer|min:1',

            'tabulator_name'=>'nullable|max:255',

            'logo'=>'nullable|image|max:2048',

            'pageant_logo'=>'nullable|image|max:2048'


        ]);




        $data=[


            'name'=>$request->name,


            'contest_type'=>$request->contest_type,


            'judge_count'=>$request->judge_count,


            'contestant_count'=>$request->contestant_count,


            'tabulator_name'=>$request->tabulator_name,


        ];





        if($request->hasFile('logo'))
        {


            if($contest->logo)
            {

                Storage::disk('public')
                    ->delete($contest->logo);

            }



            $data['logo'] =
                $request->file('logo')
                ->store('logos','public');


        }







        if($request->hasFile('pageant_logo'))
        {


            if($contest->pageant_logo)
            {

                Storage::disk('public')
                    ->delete($contest->pageant_logo);

            }



            $data['pageant_logo'] =
                $request->file('pageant_logo')
                ->store('pageant_logos','public');


        }





        $contest->update($data);





        return redirect()

            ->route('contests.index')

            ->with(

                'success',

                'Contest updated successfully!'

            );


    }
    /*
    |--------------------------------------------------------------------------
    | DELETE CONTEST
    |--------------------------------------------------------------------------
    */

    public function destroy(Contest $contest)
    {


        if($contest->logo)
        {

            Storage::disk('public')
                ->delete($contest->logo);

        }



        if($contest->pageant_logo)
        {

            Storage::disk('public')
                ->delete($contest->pageant_logo);

        }




        $contest->delete();




        return redirect()

            ->route('contests.index')

            ->with(

                'success',

                'Contest deleted successfully!'

            );


    }








    /*
    |--------------------------------------------------------------------------
    | FINAL RESULT COMPUTATION
    |--------------------------------------------------------------------------
    |
    | CCDI FLOW:
    |
    | Production Wear
    | Casual Wear
    | Formal Wear
    |        |
    |        ↓
    | Top 5 Cut
    |        |
    |        ↓
    | Question and Answer
    |        |
    |        ↓
    | Carry Over
    |        |
    |        ↓
    | Final Ranking
    |
    |--------------------------------------------------------------------------
    */



    private function calculateFinalResults(Contest $contest)
    {



        $contestants = $contest->contestants

            ->where('is_active',1)

            ->values();





        $exposures = $contest->exposures

            ->sortBy('order')

            ->values();







        $storage=[];







        /*
        |--------------------------------------------------------------------------
        | INITIALIZE CONTESTANTS
        |--------------------------------------------------------------------------
        */


        foreach($contestants as $contestant)
        {


            $storage[$contestant->id]=[


                'contestant_id'=>$contestant->id,


                'name'=>$contestant->name,


                'scores'=>[]


            ];



        }









        /*
        |--------------------------------------------------------------------------
        | COMPUTE EXPOSURE SCORE
        |--------------------------------------------------------------------------
        */


        foreach($exposures as $exposure)
        {



            foreach($storage as $id=>$row)
            {



                $total=0;





                foreach($exposure->criteria as $criterion)
                {



                    $average = $contest->scores

                        ->where(
                            'contestant_id',
                            $id
                        )

                        ->where(
                            'exposure_id',
                            $exposure->id
                        )

                        ->where(
                            'criteria_id',
                            $criterion->id
                        )

                        ->avg('score');






                    $average = $average ?? 0;






                    $total +=

                    ($average *
                    $criterion->percentage)
                    /100;




                }





                $storage[$id]['scores']
                    [$exposure->id]
                    =
                    round($total,2);



            }




        }









        /*
        |--------------------------------------------------------------------------
        | TOP 5 AFTER FORMAL WEAR
        |--------------------------------------------------------------------------
        */


        $formalWear = $exposures

            ->filter(function($item){

                return strtolower(
                    trim($item->name)
                )
                ==
                'formal wear';

            })

            ->first();







        if($formalWear)
        {



            $topIds = collect($storage)

                ->map(function($row){


                    return [

                        'id'=>$row['contestant_id'],


                        'total'=>collect(
                            $row['scores']
                        )->sum()


                    ];



                })


                ->sortByDesc('total')


                ->take(
                    $formalWear->top_n ?? 5
                )


                ->pluck('id')


                ->toArray();









            $storage = collect($storage)

                ->filter(function($row) use ($topIds){



                    return in_array(

                        $row['contestant_id'],

                        $topIds

                    );


                })


                ->toArray();



        }









        /*
        |--------------------------------------------------------------------------
        | FINAL COMPUTATION WITH CARRY OVER
        |--------------------------------------------------------------------------
        */


        $finalResults=[];







        foreach($storage as $row)
        {



            $preliminary=0;


            $finalScore=0;






            foreach($row['scores'] as $exposureId=>$score)
            {



                $exposure = $exposures

                    ->where(
                        'id',
                        $exposureId
                    )

                    ->first();






                if(!$exposure)
                {

                    continue;

                }






                if($exposure->is_final)
                {


                    $finalScore=$score;


                }
                else
                {


                    $preliminary += $score;


                }




            }









            /*
            |--------------------------------------------------------------------------
            | CARRY OVER
            |--------------------------------------------------------------------------
            */


            $carryOver=0;





            $finalExposure = $exposures

                ->where(
                    'is_final',
                    true
                )

                ->first();







            if($finalExposure)
            {


                $carryOver =

                ($preliminary *

                $finalExposure->carry_over_percentage)

                /100;



            }









            /*
            |--------------------------------------------------------------------------
            | FINAL TOTAL
            |--------------------------------------------------------------------------
            */


            $grandTotal =

                $finalScore

                +

                $carryOver;









            $finalResults[]=[



                'contestant_id'=>

                    $row['contestant_id'],



                'name'=>

                    $row['name'],



                'total'=>

                    round(
                        $grandTotal,
                        2
                    )


            ];




        }









        return collect($finalResults)

            ->sortByDesc('total')

            ->values()

            ->toArray();



    }
    /*
    |--------------------------------------------------------------------------
    | RESULTS PAGE
    |--------------------------------------------------------------------------
    */

    public function results(Contest $contest)
    {


        $contest->load([

            'contestants',

            'judges',

            'exposures.criteria',

            'scores'


        ]);




        $results =

            $this->calculateFinalResults($contest);





        return view(

            'contests.results',

            compact(

                'contest',

                'results'

            )

        );


    }








    /*
    |--------------------------------------------------------------------------
    | RANKINGS PAGE
    |--------------------------------------------------------------------------
    */

    public function rankings(Contest $contest)
    {


        $contest->load([

            'contestants',

            'exposures.criteria',

            'scores'


        ]);





        $rankings =

            $this->calculateFinalResults($contest);







        return view(

            'contests.rankings',

            compact(

                'contest',

                'rankings'

            )

        );


    }









    /*
    |--------------------------------------------------------------------------
    | PRINT SCORE SHEET
    |--------------------------------------------------------------------------
    */


    public function printScores(Contest $contest)
    {



        $contest->load([


            'contestants',


            'judges',


            'exposures.criteria',


            'scores'



        ]);






        return view(

            'contests.print_scores',

            compact(

                'contest'

            )

        );


    }









    /*
    |--------------------------------------------------------------------------
    | PRINT RESULTS
    |--------------------------------------------------------------------------
    */


    public function printResults(Contest $contest)
    {


        $contest->load([


            'contestants',


            'judges',


            'exposures.criteria',


            'scores'


        ]);







        $results =

            $this->calculateFinalResults($contest);







        return view(

            'contests.print_results',

            compact(

                'contest',

                'results'


            )

        );


    }









    /*
    |--------------------------------------------------------------------------
    | PRINT RANKINGS
    |--------------------------------------------------------------------------
    */


    public function printRankings(Contest $contest)
    {



        $contest->load([


            'contestants',


            'judges',


            'exposures.criteria',


            'scores'


        ]);







        $rankings =

            $this->calculateFinalResults($contest);







        return view(

            'contests.print_rankings',

            compact(

                'contest',

                'rankings'


            )

        );


    }



}