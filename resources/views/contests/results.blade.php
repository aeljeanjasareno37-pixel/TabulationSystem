<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Contest Results</title>


<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}


body{

    font-family:Arial, Helvetica, sans-serif;

    background:#F8FAFC;

    padding:40px;

}



.container{

    max-width:1000px;

    margin:auto;

    background:white;

    padding:35px;

    border-radius:15px;

    border:2px solid #1E3A8A;

    box-shadow:0 8px 20px rgba(0,0,0,.12);

}



h1{

    text-align:center;

    color:#1E3A8A;

    font-size:34px;

    margin-bottom:10px;

}



.subtitle{

    text-align:center;

    font-size:18px;

    color:#475569;

    margin-bottom:30px;

    line-height:1.8;

}



.subtitle small{

    color:#1E3A8A;

    font-weight:bold;

}



table{

    width:100%;

    border-collapse:collapse;

}



th{

    background:#1E3A8A;

    color:white;

    padding:15px;

    text-align:center;

}



td{

    padding:15px;

    text-align:center;

    border-bottom:1px solid #E2E8F0;

}



tr:hover{

    background:#F8FAFC;

}



.rank{

    font-size:24px;

    font-weight:bold;

}



.score{

    font-size:18px;

    font-weight:bold;

    color:#059669;

}



.champion{

    color:#D97706;

    font-weight:bold;

}



.runner{

    color:#475569;

    font-size:14px;

    font-weight:bold;

}



.finalist{

    color:#64748B;

    font-size:14px;

    font-weight:bold;

}



.btn{

    display:block;

    width:fit-content;

    margin:30px auto 0;

    background:#1E3A8A;

    color:white;

    padding:12px 25px;

    border-radius:8px;

    text-decoration:none;

    font-weight:bold;

    transition:.3s;

}



.btn:hover{

    background:#F59E0B;

}



</style>


</head>


<body>


<div class="container">



<h1>

🏆 Contest Results

</h1>




<div class="subtitle">


<strong>

{{ $contest->name }}

</strong>


<br>


@if($contest->tabulator_name)

<small>

Tabulator: {{ $contest->tabulator_name }}

</small>

@endif


</div>






<table>


<thead>

<tr>


<th width="15%">

Rank

</th>


<th>

Contestant

</th>


<th width="25%">

Final Score

</th>


<th width="25%">

Award

</th>


</tr>


</thead>





<tbody>



@forelse($results as $index=>$result)



<tr>



<td class="rank">


@if($index==0)

🥇


@elseif($index==1)

🥈


@elseif($index==2)

🥉


@else

{{ $index+1 }}

@endif


</td>





<td>


<strong>

{{ $result['name'] }}

</strong>



<br>



@if($index==0)

<span class="champion">

👑 Champion

</span>


@elseif($index==1)

<span class="runner">

🥈 1st Runner-up

</span>


@elseif($index==2)

<span class="runner">

🥉 2nd Runner-up

</span>


@else

<span class="finalist">

Finalist

</span>


@endif



</td>





<td class="score">


{{ number_format($result['total'],2) }}


</td>





<td>



@if($index==0)

🏆 Champion


@elseif($index==1)

🥈 1st Runner-up


@elseif($index==2)

🥉 2nd Runner-up


@else

Finalist


@endif



</td>



</tr>



@empty



<tr>

<td colspan="4">

No results available.

</td>

</tr>



@endforelse



</tbody>


</table>





<a href="{{ route('contests.index') }}" class="btn">

← Back to Contest List

</a>




</div>



</body>


</html>