<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Judge;
use App\Models\Contest;
use App\Models\Exposure;
use App\Models\Contestant;
use App\Models\Criteria;
use Illuminate\Http\Request;


class ScoreController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Show Score Entry Page
    |--------------------------------------------------------------------------
    */

    public function create($exposure_id)
    {

        if (!session()->has('judge_id')) {

            return redirect()
                ->route('judge.login');

        }



        $judge = Judge::findOrFail(
            session('judge_id')
        );



        $contest = Contest::findOrFail(
            $judge->contest_id
        );



        // Check contest active

        if (!$contest->is_active) {

            return redirect()
                ->route('judge.dashboard')
                ->with(
                    'error',
                    'This contest is not active.'
                );

        }




        $exposure = Exposure::findOrFail(
            $exposure_id
        );




        // Security check

        if ($exposure->contest_id != $contest->id) {

            abort(403);

        }




        // Locked exposure

        if ($exposure->is_locked) {

            return redirect()
                ->route('judge.dashboard')
                ->with(
                    'error',
                    'This exposure is already locked.'
                );

        }





        /*
        |--------------------------------------------------------------------------
        | Get Contestants
        |--------------------------------------------------------------------------
        */


        if ($contest->contest_type == 'double') {


            $maleContestants = Contestant::where(
                    'contest_id',
                    $contest->id
                )
                ->where(
                    'is_active',
                    1
                )
                ->where(
                    'gender',
                    'Male'
                )
                ->orderBy('number')
                ->get();



            $femaleContestants = Contestant::where(
                    'contest_id',
                    $contest->id
                )
                ->where(
                    'is_active',
                    1
                )
                ->where(
                    'gender',
                    'Female'
                )
                ->orderBy('number')
                ->get();



            $contestants = collect();



        } else {



            $contestants = Contestant::where(
                    'contest_id',
                    $contest->id
                )
                ->where(
                    'is_active',
                    1
                )
                ->orderBy('number')
                ->get();



            $maleContestants = collect();


            $femaleContestants = collect();



        }





        /*
        |--------------------------------------------------------------------------
        | Get Criteria
        |--------------------------------------------------------------------------
        */


        $criteria = Criteria::where(
                'exposure_id',
                $exposure->id
            )
            ->where(
                'is_active',
                1
            )
            ->orderBy('sort_order')
            ->get();






        return view(
            'scores.create',
            compact(
                'judge',
                'contest',
                'exposure',
                'criteria',
                'contestants',
                'maleContestants',
                'femaleContestants'
            )
        );


    }









    /*
    |--------------------------------------------------------------------------
    | Save Scores
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {



        if (!session()->has('judge_id')) {


            return redirect()
                ->route('judge.login');


        }






        $request->validate([

    'exposure_id' => 'required|exists:exposures,id',

    'scores' => 'required|array',

]);







        $judge = Judge::findOrFail(
            session('judge_id')
        );






        $contest = Contest::findOrFail(
            $judge->contest_id
        );






        if (!$contest->is_active) {


            return back()
                ->with(
                    'error',
                    'This contest is not active.'
                );


        }







        $exposure = Exposure::findOrFail(
            $request->exposure_id
        );





        // Security check

        if ($exposure->contest_id != $contest->id) {

            abort(403);

        }







        if ($exposure->is_locked) {


            return back()
                ->with(
                    'error',
                    'This exposure is already locked.'
                );


        }









        $criteriaList = Criteria::where(
            'exposure_id',
            $exposure->id
        )->get();









        foreach ($request->scores as $contestant_id => $criteriaScores) {



            foreach ($criteriaScores as $criteria_id => $scoreValue) {




                $criterion = $criteriaList
                    ->where(
                        'id',
                        $criteria_id
                    )
                    ->first();





                if (!$criterion) {

                    continue;

                }







                if (
                    !is_numeric($scoreValue) ||
                    $scoreValue < $criterion->minimum_score ||
                    $scoreValue > $criterion->maximum_score
                ) {



                    return back()
                        ->with(
                            'error',
                            "Invalid score for {$criterion->name}."
                        );


                }









                Score::updateOrCreate(

                    [

                        'contest_id' => $contest->id,

                        'exposure_id' => $exposure->id,

                        'contestant_id' => $contestant_id,

                        'judge_id' => $judge->id,

                        'criteria_id' => $criteria_id,

                    ],


                    [

                        'score' => $scoreValue

                    ]

                );




            }



        }










        /*
        |--------------------------------------------------------------------------
        | Check Complete Exposure
        |--------------------------------------------------------------------------
        */





        $judgeCount = $contest
            ->judges()
            ->count();





        $contestantCount = $contest
            ->contestants()
            ->where(
                'is_active',
                1
            )
            ->count();





        $criteriaCount = $criteriaList
            ->count();







        $expectedScores =

            $judgeCount *

            $contestantCount *

            $criteriaCount;









        $submittedScores = Score::where(
                'contest_id',
                $contest->id
            )
            ->where(
                'exposure_id',
                $exposure->id
            )
            ->count();









        if ($submittedScores >= $expectedScores) {




            $exposure->update([

                'is_locked' => true

            ]);






            // Open next exposure


            $nextExposure = Exposure::where(
                    'contest_id',
                    $contest->id
                )
                ->where(
                    'order',
                    '>',
                    $exposure->order
                )
                ->orderBy('order')
                ->first();







            if ($nextExposure) {



                $nextExposure->update([

                    'is_locked' => false

                ]);



            }




        }








        return redirect()

            ->route('judge.dashboard')

            ->with(
                'success',
                'Scores submitted successfully!'
            );



    }



}