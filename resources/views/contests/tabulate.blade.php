<!DOCTYPE html>
<html>

<head>

<title>Contest Tabulation</title>

<style>

*{
    box-sizing:border-box;
}


body{

    font-family:Arial,sans-serif;

    background:#F8FAFC;

    margin:0;

    padding:30px;

}



.container{

    max-width:1200px;

    margin:auto;

    background:white;

    padding:35px;

    border-radius:18px;

    border:2px solid #1E3A8A;

    box-shadow:0 10px 25px rgba(0,0,0,.10);

}



h1{

    text-align:center;

    color:#1E3A8A;

    margin-bottom:15px;

}



.info{

    text-align:center;

    color:#475569;

    line-height:1.8;

    margin-bottom:35px;

}


.info strong{

    color:#1E3A8A;

}



.exposure-title{

    color:#1E3A8A;

    margin-top:35px;

    margin-bottom:15px;

}



.progress{

    background:#F8FAFC;

    padding:15px;

    border-radius:10px;

    margin-bottom:20px;

    text-align:center;

}



.judge{

    display:inline-block;

    margin:5px;

    color:#166534;

    font-weight:bold;

}



table{

    width:100%;

    border-collapse:collapse;

    margin-bottom:35px;

}



th{

    background:#1E3A8A;

    color:white;

    padding:12px;

    text-align:center;

}



td{

    padding:12px;

    text-align:center;

    border-bottom:1px solid #E2E8F0;

}



tr:hover{

    background:#F8FAFC;

}



.total{

    background:#EEF2FF;

    color:#1E3A8A;

    font-weight:bold;

}



.ranking{

    margin-top:30px;

}



.rank{

    font-size:22px;

    font-weight:bold;

}



.champion{

    color:#B45309;

    font-weight:bold;

}



.back{

    display:inline-block;

    margin-top:20px;

    padding:12px 25px;

    background:#1E3A8A;

    color:white;

    text-decoration:none;

    border-radius:8px;

    border:2px solid #1E3A8A;

    font-weight:bold;

}



.back:hover{

    background:#F59E0B;

    border-color:#F59E0B;

}



/* PRINT BUTTONS */

.action-buttons{

    display:flex;

    justify-content:center;

    gap:15px;

    margin-bottom:35px;

    flex-wrap:wrap;

}



.action-btn{

    padding:12px 25px;

    border-radius:10px;

    text-decoration:none;

    font-weight:bold;

    border:2px solid;

    transition:.3s;

}



.action-btn:hover{

    background:#F59E0B;

    color:white;

    border-color:#F59E0B;

}



.print{

    color:#1E3A8A;

    background:#EEF2FF;

    border-color:#1E3A8A;

}



.result{

    color:#059669;

    background:#ECFDF5;

    border-color:#059669;

}



.ranking-btn{

    color:#D97706;

    background:#FFFBEB;

    border-color:#D97706;

}


</style>

</head>


<body>


<div class="container">


<h1>

🏆 Contest Tabulation

</h1>



<div class="info">


<strong>Contest:</strong>

{{ $contest->name }}


<br>


<strong>Tabulator:</strong>

{{ $contest->tabulator_name }}


</div>

<div class="action-buttons">


<a href="{{ route('contests.print.scores',$contest->id) }}"
   target="_blank"
   class="action-btn print">

    🖨 Print Tabulation

</a>



<a href="{{ route('contests.print.results',$contest->id) }}"
   target="_blank"
   class="action-btn result">

    🏆 Print Results

</a>



<a href="{{ route('contests.print.rankings',$contest->id) }}"
   target="_blank"
   class="action-btn ranking-btn">

    📊 Print Rankings

</a>



</div>




@php


/*
|--------------------------------------------------------------------------
| ACTIVE CONTESTANTS
|--------------------------------------------------------------------------
*/

$qualifiedContestants = $contest->contestants
    ->where('is_active',1)
    ->values();




/*
|--------------------------------------------------------------------------
| SCORE STORAGE
|--------------------------------------------------------------------------
*/

$overall = [];



/*
|--------------------------------------------------------------------------
| PREVIOUS EXPOSURE SCORES
|--------------------------------------------------------------------------
| Used for Carry Over computation
|--------------------------------------------------------------------------
*/

$previousExposureScores = [];




/*
|--------------------------------------------------------------------------
| TOP 5 FLAG
|--------------------------------------------------------------------------
*/

$topFiveReached = false;



@endphp





@foreach($contest->exposures->sortBy('order') as $exposure)



<h2 class="exposure-title">

🎤 {{ $exposure->name }}

</h2>





<div class="progress">


<strong>
Judge Progress
</strong>


<br>



@php

$finished = 0;

@endphp





@foreach($contest->judges as $judge)



@php


$count = \App\Models\Score::where('judge_id',$judge->id)

    ->where('exposure_id',$exposure->id)

    ->count();



$required =
    $qualifiedContestants->count()
    *
    $exposure->criteria->count();




if($count >= $required){

    $finished++;

}


@endphp





<span class="judge">


👨‍⚖️ {{ $judge->name }}


@if($count >= $required)

✔ Submitted

@else

⏳ Pending

@endif


</span>


<br>



@endforeach




<strong>

{{ $finished }} / {{ $contest->judges->count() }} Judges Finished

</strong>



</div><table>


<tr>


<th>
Contestant
</th>



@foreach($exposure->criteria as $criterion)


<th>

{{ $criterion->name }}

<br>

({{ number_format($criterion->percentage,2) }}%)

</th>


@endforeach



<th>
Total
</th>


</tr>





@foreach($qualifiedContestants as $contestant)



@php

$total = 0;

@endphp





<tr>


<td>

<strong>

{{ $contestant->name }}

</strong>

</td>





@foreach($exposure->criteria as $criterion)



@php


$average = $contest->scores

    ->where('contestant_id',$contestant->id)

    ->where('exposure_id',$exposure->id)

    ->where('criteria_id',$criterion->id)

    ->avg('score');



$average = $average ?? 0;




$total += 

    ($average * $criterion->percentage) / 100;



@endphp




<td>

{{ number_format($average,2) }}

</td>




@endforeach






@php

/*
|--------------------------------------------------------------------------
| FINAL EXPOSURE CARRY OVER
|--------------------------------------------------------------------------
|
| CCDI Guide:
|
| Final Score =
| Raw Final Score + Carry Over Percentage
|
*/


$rawFinalScore = $total;



if(

    $exposure->is_final

    &&

    $exposure->carry_over_percentage > 0

){


    $previousScores =

        $previousExposureScores[$contestant->id] ?? [];



    if(count($previousScores) > 0){



        /*
        |--------------------------------------------------------------------------
        | CARRY OVER COMPUTATION
        |--------------------------------------------------------------------------
        | Previous rounds total × carry over percentage
        |
        */


        $previousTotal =

            collect($previousScores)->sum();




        $carryOver =

            ($previousTotal *

            $exposure->carry_over_percentage)

            /100;




        $total = $rawFinalScore;



    }




}



@endphp





<td class="total">


{{ number_format($total,2) }}


</td>



</tr>





@php


/*
|--------------------------------------------------------------------------
| INITIALIZE CONTESTANT STORAGE
|--------------------------------------------------------------------------
*/


if(!isset($overall[$contestant->id])){


    $overall[$contestant->id] = [

        'id'=>$contestant->id,

        'name'=>$contestant->name,

        'scores'=>[],


    ];


}




/*
|--------------------------------------------------------------------------
| SAVE EXPOSURE SCORE
|--------------------------------------------------------------------------
*/


$overall[$contestant->id]['scores'][$exposure->id] = $total;






/*
|--------------------------------------------------------------------------
| SAVE NON FINAL SCORES
|--------------------------------------------------------------------------
|
| These will be used for Carry Over
|
*/


if(!$exposure->is_final){



    $previousExposureScores[$contestant->id][] = $total;



}



@endphp





@endforeach



</table>@php


/*
|--------------------------------------------------------------------------
| TOP 5 CUT AFTER FORMAL WEAR
|--------------------------------------------------------------------------
|
| Activity Guide:
|
| 1. Production Wear
| 2. Casual Wear
| 3. Formal Wear
| 4. Top 5
| 5. Question and Answer
|
*/


if(

    !$topFiveReached

    &&

    strtolower(trim($exposure->name)) == 'formal wear'

){



    /*
    |--------------------------------------------------------------------------
    | COMPUTE PRELIMINARY RANKING
    |--------------------------------------------------------------------------
    |
    | Count Production + Casual + Formal only
    |
    */


    $preliminaryRanking = collect($overall)

        ->map(function($row,$id) use ($contest){


            $total = 0;



            foreach($row['scores'] as $exposureId=>$score){



                $currentExposure = 

                    $contest->exposures

                    ->where('id',$exposureId)

                    ->first();



                if($currentExposure){


                    $total += $score;


                }



            }




            return [

                'id'=>$id,

                'total'=>$total

            ];



        })


        ->sortByDesc('total')

        ->take($exposure->top_n ?? 5)

        ->values();







    /*
    |--------------------------------------------------------------------------
    | STORE TOP 5 IDS
    |--------------------------------------------------------------------------
    */


    $qualifiedIds = 

        $preliminaryRanking

        ->pluck('id')

        ->toArray();






    /*
    |--------------------------------------------------------------------------
    | FILTER CONTESTANTS FOR FINAL ROUND
    |--------------------------------------------------------------------------
    */


    $qualifiedContestants =

        $contest->contestants

        ->whereIn('id',$qualifiedIds)

        ->values();






    /*
    |--------------------------------------------------------------------------
    | REMOVE ELIMINATED CONTESTANTS
    |--------------------------------------------------------------------------
    |
    | Only Top 5 continues
    |
    */


    $overall = collect($overall)

        ->filter(function($row) use ($qualifiedIds){


            return in_array(

                $row['id'],

                $qualifiedIds

            );


        })

        ->toArray();






    $topFiveReached = true;



}



@endphp




@endforeach@php

/*
|--------------------------------------------------------------------------
| FINAL SCORE COMPUTATION
|--------------------------------------------------------------------------
|
| CCDI GUIDE:
|
| Overall Score =
| Production Wear
| + Casual Wear
| + Formal Wear
| + Final Q&A Score
|
| Final exposure already contains Carry Over
|
*/


$rankingData = [];



foreach($overall as $id=>$row){



    $grandTotal = 0;



    $grandTotal = 0;

$preliminaryTotal = 0;

$finalScore = 0;


foreach($row['scores'] as $exposureId=>$exposureScore){


    $currentExposure = $contest->exposures

        ->where('id',$exposureId)

        ->first();



    if($currentExposure->is_final){


        $finalScore = $exposureScore;


    }else{


        $preliminaryTotal += $exposureScore;


    }



}



$carryOver = 0;


$finalExposure = $contest->exposures

    ->where('is_final',1)

    ->first();



if($finalExposure){


    $carryOver =

        ($preliminaryTotal *

        $finalExposure->carry_over_percentage)

        /100;


}



$grandTotal =

    $finalScore

    +

    $carryOver;



    $rankingData[] = [


        'name'=>$row['name'],


        'total'=>(float)$grandTotal



    ];



}




$overall = collect($rankingData)

    ->sortByDesc('total')

    ->values()

    ->toArray();



@endphp






<h2 class="exposure-title ranking">

🏆 Overall Ranking

</h2>






<table>


<tr>


<th>

Rank

</th>


<th>

Contestant

</th>


<th>

Overall Score

</th>


</tr>






@foreach($overall as $index=>$row)



<tr>



<td class="rank">



@if($index == 0)

🥇


@elseif($index == 1)

🥈


@elseif($index == 2)

🥉


@else

{{ $index + 1 }}


@endif



</td>






<td>



<strong>

{{ $row['name'] }}

</strong>






@if($index == 0)


<br>


<span class="champion">

👑 Champion

</span>





@elseif($index == 1)


<br>

1st Runner-up





@elseif($index == 2)


<br>

2nd Runner-up





@endif




</td>







<td class="total">


{{ number_format($row['total'],2) }}



</td>





</tr>






@endforeach




</table>








<a href="{{ route('contests.index') }}" class="back">

← Back to Contest List

</a>







</div>



</body>


</html>