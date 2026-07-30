<!DOCTYPE html>
<html>

<head>

<title>Judge Portal</title>


<style>

*{
    box-sizing:border-box;
}


body{

    font-family:Arial, sans-serif;

    background:#F8FAFC;

    margin:0;

    padding:40px;

}



/* Main Container */

.container{

    max-width:500px;

    margin:80px auto;

    background:white;

    padding:40px;

    border-radius:18px;

    box-shadow:0 10px 25px rgba(0,0,0,0.10);

    border:2px solid #1E3A8A;

}



/* Title */

h1{

    text-align:center;

    color:#1E3A8A;

    font-size:32px;

    margin-bottom:10px;

}



.subtitle{

    text-align:center;

    color:#64748B;

    margin-bottom:30px;

}



/* Error */

.error{

    background:#FEE2E2;

    color:#991B1B;

    padding:12px;

    border-radius:8px;

    margin-bottom:20px;

}



/* Form */

label{

    font-weight:bold;

    color:#334155;

}



input{

    width:100%;

    padding:14px;

    margin-top:8px;

    border:1px solid #CBD5E1;

    border-radius:10px;

    font-size:16px;

}



input:focus{

    outline:none;

    border-color:#1E3A8A;

}



/* Login Button */

.login-btn{

    width:100%;

    margin-top:25px;

    padding:14px;


    background:#1E3A8A;

    color:white;


    border:2px solid #1E3A8A;

    border-radius:10px;


    font-size:16px;

    font-weight:bold;


    cursor:pointer;

    transition:0.3s;

}



.login-btn:hover{

    background:#F59E0B;

    border-color:#F59E0B;

}



/* Back Dashboard Button */

.back-btn{

    display:block;

    width:100%;

    margin-top:25px;

    text-align:center;


    background:#1E3A8A;

    color:white;


    padding:14px;


    border-radius:10px;


    text-decoration:none;


    font-weight:bold;


    border:2px solid #1E3A8A;


    transition:0.3s;

}



.back-btn:hover{

    background:#F59E0B;

    border-color:#F59E0B;

    color:white;

}



</style>


</head>



<body>



<div class="container">



<h1>

👨‍⚖️ Judge Portal

</h1>



<p class="subtitle">

CCDI Tabulation System

</p>





@if(session('error'))

<div class="error">

{{ session('error') }}

</div>

@endif





<form action="{{ route('judge.authenticate') }}" method="POST">


@csrf



<label>

Access Code

</label>



<input

type="text"

name="access_code"

placeholder="Enter your access code"

required

>




<button type="submit" class="login-btn">

🔐 Login as Judge

</button>



</form>






<a href="{{ route('dashboard') }}" class="back-btn">

← Back to Dashboard

</a>





</div>


</body>


</html>