<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Print Score Sheet</title>


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

    max-width:1100px;

    margin:auto;

    background:white;

    padding:35px;

    border-radius:18px;

    border:2px solid #1E3A8A;

    box-shadow:0 10px 25px rgba(0,0,0,.12);

}



/* LOGO AREA */

.logo-area{

    display:flex;

    justify-content:center;

    align-items:center;

    gap:30px;

    margin-bottom:20px;

}



.logo-area img{

    max-height:90px;

    max-width:150px;

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



.subtitle strong{

    color:#1E3A8A;

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

    border-radius:10px;

    font-weight:bold;

    cursor:pointer;

    margin-bottom:25px;

}



.print-btn:hover{

    background:#F59E0B;

}



.exposure-title{

    margin-top:35px;

    margin-bottom:15px;

    color:#1E3A8A;

}




table{

    width:100%;

    border-collapse:collapse;

    margin-bottom:30px;

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




.total{

    background:#EEF2FF;

    color:#059669;

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





<div class="logo-area">


@if($contest->logo)

<img src="{{ asset('storage/'.$contest->logo) }}">


@endif



@if($contest->pageant_logo)

<img src="{{ asset('storage/'.$contest->pageant_logo) }}">


@endif



</div>





<h1>

📝 Score Sheet

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





@foreach($contest->exposures->sortBy('order') as $exposure)



<h2 class="exposure-title">

🎤 {{ $exposure->name }}

</h2>





<table>


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





@foreach($contest->contestants->where('is_active',1) as $contestant)



<tr>


<td>

<strong>

{{ $contestant->name }}

</strong>

</td>





@php

$total = 0;

@endphp




@foreach($exposure->criteria as $criterion)



@php

$average = $contest->scores

->where('contestant_id',$contestant->id)

->where('exposure_id',$exposure->id)

->where('criteria_id',$criterion->id)

->avg('score');


$average = $average ?? 0;



$total += ($average * $criterion->percentage) / 100;


@endphp





<td>

{{ number_format($average,2) }}

</td>



@endforeach





<td class="total">

{{ number_format($total,2) }}

</td>



</tr>



@endforeach




</table>




@endforeach





</div>



</body>

</html>