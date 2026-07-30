<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Print Final Rankings</title>


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




.branding{

    display:flex;

    justify-content:center;

    align-items:center;

    gap:25px;

    margin-bottom:20px;

}



.branding img{

    object-fit:contain;

}



.pageant-logo{

    width:90px;

    height:90px;

}



.contest-logo{

    width:90px;

    height:90px;

}



h1{

    text-align:center;

    color:#1E3A8A;

    font-size:34px;

    margin-bottom:10px;

}




.subtitle{

    text-align:center;

    color:#475569;

    font-size:18px;

    line-height:1.8;

    margin-bottom:30px;

}



.subtitle small{

    color:#1E3A8A;

    font-weight:bold;

}




.print-btn{

    background:#1E3A8A;

    color:white;

    border:none;

    padding:12px 25px;

    border-radius:8px;

    font-weight:bold;

    cursor:pointer;

    margin-bottom:25px;

}



.print-btn:hover{

    background:#F59E0B;

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





.rank{

    font-size:24px;

    font-weight:bold;

}





.score{

    color:#059669;

    font-size:18px;

    font-weight:bold;

}





.champion{

    color:#D97706;

    font-weight:bold;

}





.runner{

    color:#475569;

    font-weight:bold;

}





@media print{


body{

    background:white;

    padding:0;

}



.container{

    border:none;

    box-shadow:none;

}



.print-btn{

    display:none;

}


}



</style>


</head>


<body>


<div class="container">



<button onclick="window.print()" class="print-btn">

🖨 Print

</button>






<div class="branding">


@if($contest->pageant_logo)

<img src="{{ asset('storage/'.$contest->pageant_logo) }}"
class="pageant-logo">

@endif



@if($contest->logo)

<img src="{{ asset('storage/'.$contest->logo) }}"
class="contest-logo">

@endif



</div>






<h1>

🏆 Final Rankings

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


</tr>


</thead>





<tbody>



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



</tbody>



</table>





</div>


</body>


</html>