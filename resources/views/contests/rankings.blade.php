<!DOCTYPE html>
<html>

<head>

<title>Final Rankings</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}


body{

    font-family:Arial,sans-serif;
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
    margin-bottom:10px;
    font-size:34px;

}


.subtitle{

    text-align:center;
    font-size:18px;
    color:#475569;
    margin-bottom:30px;

}



table{

    width:100%;
    border-collapse:collapse;

}



th{

    background:#1E3A8A;
    color:white;
    padding:15px;

}



td{

    padding:15px;
    text-align:center;
    border-bottom:1px solid #ddd;

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

}



.back-btn{

    display:block;
    width:fit-content;
    margin:30px auto 0;
    background:#1E3A8A;
    color:white;
    padding:12px 25px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;

}



.back-btn:hover{

    background:#F59E0B;

}


</style>

</head>


<body>


<div class="container">


<h1>
🏆 Final Rankings
</h1>



<div class="subtitle">

{{ $contest->name }}

@if($contest->tabulator_name)

<br>

<strong>
Tabulator:
</strong>

{{ $contest->tabulator_name }}

@endif

</div>




<table>


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


</tr>





@forelse($rankings as $index=>$ranking)


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

{{ $ranking['name'] }}

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


@endif



</td>





<td class="score">


{{ number_format($ranking['total'],2) }}



</td>



</tr>



@empty


<tr>

<td colspan="3">

No rankings available.

</td>

</tr>


@endforelse



</table>




<a href="{{ route('contests.index') }}" class="back-btn">

← Back to Contest List

</a>



</div>


</body>


</html>