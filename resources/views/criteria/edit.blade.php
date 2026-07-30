<!DOCTYPE html>
<html>

<head>

<title>Edit Criteria</title>

<style>

*{
    box-sizing:border-box;
}


body{

    font-family:Arial, sans-serif;

    background:#F8FAFC;

    padding:20px;

}



.container{

    max-width:560px;

    margin:30px auto;

    background:white;

    padding:28px;

    border-radius:15px;

    border:2px solid #1E3A8A;

    box-shadow:0 8px 18px rgba(0,0,0,.10);

}



h1{

    text-align:center;

    color:#1E3A8A;

    margin-bottom:10px;

}



h3{

    text-align:center;

    color:#475569;

}



h4{

    text-align:center;

    color:#64748B;

    margin-bottom:25px;

}



label{

    display:block;

    font-weight:bold;

    color:#334155;

    margin-bottom:6px;

}



input{

    width:100%;

    padding:10px;

    border:1px solid #CBD5E1;

    border-radius:8px;

    margin-bottom:16px;

    font-size:15px;

}



input:focus{

    outline:none;

    border-color:#1E3A8A;

}



.error{

    background:#FEE2E2;

    color:#991B1B;

    padding:12px;

    border-radius:8px;

    margin-bottom:20px;

}



.btn{

    width:100%;

    padding:12px;

    background:#1E3A8A;

    color:white;

    border:2px solid #1E3A8A;

    border-radius:10px;

    font-weight:bold;

    cursor:pointer;

}



.btn:hover{

    background:#F59E0B;

    border-color:#F59E0B;

}



.back-btn{

    display:block;

    margin-top:15px;

    text-align:center;

    padding:12px;

    background:#1E3A8A;

    color:white;

    border:2px solid #1E3A8A;

    border-radius:10px;

    text-decoration:none;

    font-weight:bold;

}



.back-btn:hover{

    background:#F59E0B;

    border-color:#F59E0B;

}


</style>

</head>


<body>


<div class="container">


<h1>

✏️ Edit Criteria

</h1>



<h3>

{{ $contest->name }}

</h3>



<h4>

Exposure: {{ $exposure->name }}

</h4>




@if($errors->any())

<div class="error">

<ul>

@foreach($errors->all() as $error)

<li>
{{ $error }}
</li>

@endforeach

</ul>

</div>

@endif





<form method="POST"
action="{{ route('criteria.update',
[$contest->id,$exposure->id,$criteria->id]) }}">


@csrf

@method('PUT')



<label>
Criteria Name
</label>


<input
type="text"
name="name"
value="{{ old('name',$criteria->name) }}"
required>



<label>
Percentage (%)
</label>


<input
type="number"
name="percentage"
value="{{ old('percentage',$criteria->percentage) }}"
min="0"
max="100"
step="0.01"
required>




<label>
Minimum Score
</label>


<input
type="number"
name="minimum_score"
value="{{ old('minimum_score',$criteria->minimum_score) }}"
min="0"
step="0.01"
required>




<label>
Maximum Score
</label>


<input
type="number"
name="maximum_score"
value="{{ old('maximum_score',$criteria->maximum_score) }}"
min="0"
step="0.01"
required>




<button class="btn"
type="submit">

💾 Update Criteria

</button>




</form>




<a href="{{ route('criteria.index',
[$contest->id,$exposure->id]) }}"
class="back-btn">

← Back to Criteria List

</a>



</div>


</body>


</html>