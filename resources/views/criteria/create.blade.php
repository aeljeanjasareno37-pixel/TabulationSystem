<!DOCTYPE html>
<html>

<head>

<title>Add Criteria</title>

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
}

h3,h4{
    text-align:center;
}

h3{
    color:#475569;
}

h4{
    color:#64748B;
    margin-bottom:25px;
}

.error{
    background:#FEE2E2;
    color:#991B1B;
    padding:12px;
    border-radius:8px;
    margin-bottom:20px;
}

label{
    display:block;
    font-weight:bold;
    margin-bottom:6px;
    color:#334155;
}

input{

    width:100%;
    padding:10px;
    border:1px solid #CBD5E1;
    border-radius:8px;
    margin-bottom:16px;

}

.btn{

    width:100%;
    padding:12px;
    background:#1E3A8A;
    color:white;
    border:none;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;

}

.btn:hover{

    background:#F59E0B;

}

.back-btn{

    display:block;
    margin-top:15px;
    text-align:center;
    padding:12px;
    background:#1E3A8A;
    color:white;
    border-radius:10px;
    text-decoration:none;
    font-weight:bold;

}

</style>

</head>


<body>


<div class="container">


<h1>
➕ Add Criteria
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




<form action="{{ route('criteria.store',[$contest->id,$exposure->id]) }}"
method="POST">

@csrf



<label>
Criteria Name
</label>

<input
type="text"
name="name"
value="{{ old('name') }}"
placeholder="Example: Beauty"
required>




<label>
Percentage (%)
</label>

<input
type="number"
name="percentage"
value="{{ old('percentage') }}"
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
value="{{ old('minimum_score',0) }}"
min="0"
step="0.01"
required>




<label>
Maximum Score
</label>

<input
type="number"
name="maximum_score"
value="{{ old('maximum_score',100) }}"
min="0"
step="0.01"
required>




<label>
Sort Order
</label>

<input
type="number"
name="sort_order"
value="{{ old('sort_order',0) }}"
min="0">



<button class="btn">

💾 Save Criteria

</button>


</form>



<a href="{{ route('criteria.index',[$contest->id,$exposure->id]) }}"
class="back-btn">

← Back to Criteria List

</a>



</div>


</body>

</html>