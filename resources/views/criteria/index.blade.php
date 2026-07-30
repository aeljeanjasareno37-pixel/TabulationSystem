<!DOCTYPE html>
<html>

<head>

<title>Criteria List</title>

<style>

*{
    box-sizing:border-box;
}


body{

    font-family:Arial, sans-serif;
    background:#F8FAFC;
    padding:30px;

}



.container{

    max-width:900px;

    margin:auto;

    background:white;

    padding:30px;

    border-radius:15px;

    border:2px solid #1E3A8A;

    box-shadow:0 8px 18px rgba(0,0,0,.10);

}



h1{

    text-align:center;

    color:#1E3A8A;

}



.subtitle{

    text-align:center;

    color:#475569;

    margin-bottom:25px;

}



.top-btn{

    display:inline-block;

    background:#1E3A8A;

    color:white;

    padding:10px 20px;

    border-radius:8px;

    text-decoration:none;

    font-weight:bold;

    margin-bottom:20px;

}



.top-btn:hover{

    background:#F59E0B;

}



table{

    width:100%;

    border-collapse:collapse;

}



th{

    background:#1E3A8A;

    color:white;

    padding:12px;

}



td{

    padding:12px;

    text-align:center;

    border-bottom:1px solid #ddd;

}



tr:hover{

    background:#F8FAFC;

}



.action a{

    text-decoration:none;

    font-weight:bold;

}



.edit{

    color:#2563EB;

}



.delete{

    color:#DC2626;

}



.empty{

    text-align:center;

    padding:20px;

    color:#64748B;

}



.back-btn{

    display:block;

    width:fit-content;

    margin:25px auto 0;

    background:#1E3A8A;

    color:white;

    padding:10px 25px;

    border-radius:8px;

    text-decoration:none;

    font-weight:bold;

}



.back-btn:hover{

    background:#F59E0B;

}



.success{

    background:#DCFCE7;

    color:#166534;

    padding:12px;

    border-radius:8px;

    text-align:center;

    margin-bottom:20px;

}


</style>

</head>


<body>


<div class="container">


<h1>
⚙️ Criteria List
</h1>


<div class="subtitle">

<strong>
{{ $contest->name }}
</strong>

<br>

Exposure:
{{ $exposure->name }}

</div>



@if(session('success'))

<div class="success">

{{ session('success') }}

</div>

@endif





<a href="{{ route('criteria.create',[$contest->id,$exposure->id]) }}" class="top-btn">

➕ Add Criteria

</a>





<table>


<tr>

<th>
Criteria Name
</th>


<th>
Percentage
</th>


<th>
Minimum Score
</th>


<th>
Maximum Score
</th>


<th>
Action
</th>


</tr>




@forelse($criteria as $item)


<tr>


<td>

{{ $item->name }}

</td>



<td>

{{ number_format($item->percentage,2) }}%

</td>



<td>

{{ number_format($item->minimum_score,2) }}

</td>



<td>

{{ number_format($item->maximum_score,2) }}

</td>



<td class="action">


<a class="edit"
href="{{ route('criteria.edit',[$contest->id,$exposure->id,$item->id]) }}">

✏️ Edit

</a>


&nbsp;


<form action="{{ route('criteria.destroy',[$contest->id,$exposure->id,$item->id]) }}"
method="POST"
style="display:inline;">

@csrf

@method('DELETE')


<button type="submit"
style="border:none;background:none;color:#DC2626;font-weight:bold;cursor:pointer;">

🗑 Delete

</button>


</form>



</td>


</tr>



@empty


<tr>

<td colspan="5" class="empty">

No criteria available.

</td>

</tr>


@endforelse



</table>




<a href="{{ route('exposures.index',$contest->id) }}" class="back-btn">

← Back to Exposure List

</a>



</div>


</body>


</html>