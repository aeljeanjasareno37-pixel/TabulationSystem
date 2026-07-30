<!DOCTYPE html>
<html>

<head>

<title>Contest Settings</title>


<style>

*{
    box-sizing:border-box;
}


body{

    font-family:Arial, Helvetica, sans-serif;

    background:#F8FAFC;

    margin:0;

    padding:40px;

}



.container{

    max-width:1000px;

    margin:auto;

    background:white;

    padding:40px;

    border-radius:20px;

    border:2px solid #1E3A8A;

    box-shadow:0 10px 25px rgba(0,0,0,.12);

}





h1{

    text-align:center;

    color:#1E3A8A;

    font-size:34px;

    margin-bottom:20px;

}




/* LOGO */

.logo-area{

    display:flex;

    justify-content:center;

    align-items:center;

    gap:35px;

    margin-bottom:25px;

}



.logo-area img{

    width:130px;

    height:130px;

    object-fit:contain;

    border-radius:15px;

    border:2px solid #E2E8F0;

    padding:10px;

}





.subtitle{

    text-align:center;

    color:#475569;

    font-size:20px;

    margin-bottom:35px;

}



.subtitle strong{

    color:#1E3A8A;

}




.info-grid{

    display:grid;

    grid-template-columns:repeat(2,1fr);

    gap:20px;

    margin-bottom:35px;

}





.info-card{

    background:#F8FAFC;

    padding:20px;

    border-radius:15px;

    text-align:center;

}





.info-card h3{

    color:#1E3A8A;

    margin-bottom:10px;

}




.info-card p{

    font-size:18px;

    font-weight:bold;

    color:#334155;

}




.status-active{

    color:#16A34A;

    font-size:18px;

    font-weight:bold;

}




.status-inactive{

    color:#64748B;

    font-size:18px;

    font-weight:bold;

}







.buttons{

    display:flex;

    flex-wrap:wrap;

    justify-content:center;

    gap:15px;

    margin-top:25px;

}







.btn{

    padding:12px 22px;

    border-radius:10px;

    text-decoration:none;

    font-weight:bold;

    border:2px solid;

    transition:.3s;

}



.btn:hover{

    background:#F59E0B;

    color:white;

    border-color:#F59E0B;

}







.judges{

    color:#2563EB;

    border-color:#2563EB;

    background:#EFF6FF;

}



.contestants{

    color:#059669;

    border-color:#059669;

    background:#ECFDF5;

}



.exposures{

    color:#EA580C;

    border-color:#EA580C;

    background:#FFF7ED;

}




.tabulate{

    color:#7C3AED;

    border-color:#7C3AED;

    background:#F5F3FF;

}




.results{

    color:#B45309;

    border-color:#B45309;

    background:#FFFBEB;

}




.rankings{

    color:#BE123C;

    border-color:#BE123C;

    background:#FFF1F2;

}




.print{

    color:#475569;

    border-color:#475569;

    background:#F8FAFC;

}




.score-sheet{

    color:#0F766E;

    border-color:#0F766E;

    background:#F0FDFA;

}





.back{

    color:#1E3A8A;

    border-color:#1E3A8A;

    background:#EEF2FF;

}






.activate-btn{

    padding:12px 22px;

    border-radius:10px;

    border:2px solid #1E3A8A;

    background:#EEF2FF;

    color:#1E3A8A;

    font-weight:bold;

    cursor:pointer;

}




.activate-btn:hover{

    background:#F59E0B;

    color:white;

    border-color:#F59E0B;

}




.active-badge{

    color:#16A34A;

    font-weight:bold;

    padding:12px 22px;

}




</style>


</head>



<body>



<div class="container">



<h1>

🏆 Contest Settings

</h1>





@if($contest->logo || $contest->pageant_logo)


<div class="logo-area">


@if($contest->logo)

<img src="{{ asset('storage/'.$contest->logo) }}">

@endif



@if($contest->pageant_logo)

<img src="{{ asset('storage/'.$contest->pageant_logo) }}">

@endif



</div>


@endif





<div class="subtitle">


<strong>

{{ $contest->name }}

</strong>


<br>


@if($contest->tabulator_name)

<small>

Tabulator:
{{ $contest->tabulator_name }}

</small>

@endif



</div>







<div class="info-grid">





<div class="info-card">

<h3>
Contest Type
</h3>


<p>

{{ $contest->contest_type }}

</p>

</div>








<div class="info-card">

<h3>
Tabulator
</h3>


<p>

{{ $contest->tabulator_name ?? 'Not Set' }}

</p>

</div>







<div class="info-card">

<h3>
Number of Judges
</h3>


<p>

{{ $contest->judges->count() }}

</p>


</div>







<div class="info-card">

<h3>
Number of Contestants
</h3>


<p>

{{ $contest->contestants->count() }}

</p>


</div>







<div class="info-card">

<h3>
Status
</h3>


@if($contest->is_active)


<span class="status-active">

🟢 Active

</span>


@else


<span class="status-inactive">

⚪ Inactive

</span>


@endif


</div>





</div>









<div class="buttons">





<a href="{{ route('judges.index',$contest->id) }}"
class="btn judges">

👨‍⚖️ Manage Judges

</a>





<a href="{{ route('contestants.index',$contest->id) }}"
class="btn contestants">

👤 Manage Contestants

</a>





<a href="{{ route('exposures.index',$contest->id) }}"
class="btn exposures">

🎤 Manage Exposures

</a>





<a href="{{ route('contests.tabulate',$contest->id) }}"
class="btn tabulate">

📊 Tabulate

</a>





<a href="{{ route('contests.results',$contest->id) }}"
class="btn results">

🏆 Results

</a>





<a href="{{ route('contests.rankings',$contest->id) }}"
class="btn rankings">

🥇 Rankings

</a>






<a href="{{ route('contests.print.scores',$contest->id) }}"
class="btn score-sheet">

📝 Print Score Sheet

</a>





<a href="{{ route('contests.print.results',$contest->id) }}"
class="btn print">

🖨 Print Results

</a>





<a href="{{ route('contests.print.rankings',$contest->id) }}"
class="btn print">

🖨 Print Rankings

</a>







@if($contest->is_active)


<span class="active-badge">

✅ Contest Active

</span>



@else



<form action="{{ route('contests.activate',$contest->id) }}"
method="POST">

@csrf


<button class="activate-btn">

🔓 Activate Contest

</button>


</form>



@endif




</div>








<div class="buttons">


<a href="{{ route('contests.index') }}"
class="btn back">


← Back to Contest List


</a>


</div>







</div>


</body>


</html>