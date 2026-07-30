<!DOCTYPE html>
<html>

<head>

<title>Add Judge</title>


<style>

body{

    font-family:Arial, sans-serif;
    background:#F8FAFC;
    padding:30px;

}


/* Container */

.container{

    max-width:600px;
    margin:auto;

    background:white;

    padding:35px;

    border-radius:15px;

    box-shadow:0 5px 15px rgba(0,0,0,0.1);

}



/* Header */

h1{

    text-align:center;
    color:#1E3A8A;
    margin-bottom:10px;

}



h3{

    text-align:center;
    color:#475569;
    margin-bottom:30px;

}



/* Error */

.error-box{

    background:#FEE2E2;
    color:#991B1B;

    padding:15px;

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

    padding:12px;

    margin-top:8px;

    border:1px solid #CBD5E1;

    border-radius:8px;

    font-size:16px;

    box-sizing:border-box;

}



input:focus{

    outline:none;

    border-color:#1E3A8A;

}



/* Buttons */

.btn{

    background:#1E3A8A;

    color:white;

    padding:12px 25px;

    border:none;

    border-radius:8px;

    font-weight:bold;

    cursor:pointer;

    font-size:15px;

    transition:0.3s;

}



.btn:hover{

    background:#F59E0B !important;

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

    transition:0.3s;

}



.back-btn:hover{

    background:#F59E0B !important;

    color:white !important;

}



</style>


</head>



<body>



<div class="container">



<h1>

➕ Add Judge

</h1>



<h3>

Contest: {{ $contest->name }}

</h3>




@if ($errors->any())


<div class="error-box">


<ul>

@foreach ($errors->all() as $error)

<li>

{{ $error }}

</li>

@endforeach

</ul>


</div>


@endif





<form action="{{ route('judges.store', $contest->id) }}" method="POST">


@csrf




<label>

Judge Name

</label>



<input

type="text"

name="name"

value="{{ old('name') }}"

placeholder="Enter judge name"

required

>




<br><br>





<button type="submit" class="btn">

💾 Save Judge

</button>




</form>







<a href="{{ route('judges.index', $contest->id) }}" class="back-btn">

← Back to Judge List

</a>




</div>



</body>


</html>