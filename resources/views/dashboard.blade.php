<!DOCTYPE html>
<html>

<head>

<title>CCDI Tabulation Dashboard</title>


<style>

*{
    box-sizing:border-box;
}


body {

    font-family: Arial, sans-serif;

    background:#F8FAFC;

    margin:0;

    padding:40px;

}



/* Title */

h1 {

    text-align:center;

    color:#1E3A8A;

    font-size:36px;

    margin-bottom:10px;

}


.subtitle{

    text-align:center;

    color:#64748B;

    font-size:18px;

}



/* Dashboard Cards */

.cards {

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));

    gap:20px;

    margin-top:35px;

}





.card {

    background:white;

    padding:25px;

    border-radius:18px;

    border:2px solid #1E3A8A;

    box-shadow:0 10px 25px rgba(0,0,0,0.10);

    text-align:center;

    transition:.3s;

}



.card:hover{

    transform:translateY(-5px);

}





.card h2 {

    margin:0;

    font-size:38px;

    color:#1E3A8A;

}



.card p {

    color:#555;

    font-size:18px;

    font-weight:bold;

}





/* Quick Actions */

.actions {

    margin-top:45px;

    text-align:center;

}



.actions h2{

    color:#1E3A8A;

    margin-bottom:20px;

}







/* Buttons */

.button {


    display:inline-block;

    background:#1E3A8A;

    color:white;

    padding:14px 25px;

    border-radius:10px;

    text-decoration:none;

    margin:10px;

    font-size:16px;

    font-weight:bold;

    transition:.3s;

}



.button:hover {


    background:#F59E0B;

    color:white;

}







/* System Status */

.status{

    margin-top:40px;

    background:white;

    border:2px solid #1E3A8A;

    border-radius:15px;

    padding:25px;

    text-align:center;

}



.status h2{

    color:#1E3A8A;

}



.status p{

    color:#475569;

    font-size:16px;

}





</style>


</head>



<body>



<h1>

🏆 CCDI Tabulation System Dashboard

</h1>


<p class="subtitle">

Admin Control Panel for Contest Management and Scoring

</p>







<div class="cards">



<div class="card">

<h2>
{{ $contests }}
</h2>

<p>
Contests
</p>

</div>





<div class="card">

<h2>
{{ $judges }}
</h2>

<p>
Judges
</p>

</div>





<div class="card">

<h2>
{{ $contestants }}
</h2>

<p>
Contestants
</p>

</div>





<div class="card">

<h2>
{{ $exposures }}
</h2>

<p>
Exposures
</p>

</div>



</div>








<div class="actions">



<h2>

Quick Actions

</h2>





<a href="{{ route('contests.index') }}" class="button">

🏆 Manage Contest

</a>





<a href="{{ route('judge.login') }}" class="button">

⚖️ Judge Portal

</a>





</div>







<div class="status">


<h2>

System Status

</h2>


<p>

🟢 System Ready

</p>


<p>

Contest management, scoring, tabulation, and ranking modules are active.

</p>


</div>






</body>


</html>