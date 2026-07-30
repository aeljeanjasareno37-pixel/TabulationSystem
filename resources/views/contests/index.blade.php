<!DOCTYPE html>
<html>

<head>

<title>Contest Management</title>


<style>

*{
    box-sizing:border-box;
}


body{

    font-family:Arial,sans-serif;

    background:#F8FAFC;

    margin:0;

    padding:30px;

}



.container{

    max-width:1400px;

    margin:auto;

    background:white;

    padding:35px;

    border-radius:18px;

    border:2px solid #1E3A8A;

    box-shadow:0 10px 25px rgba(0,0,0,.12);

}




h1{

    text-align:center;

    color:#1E3A8A;

    margin-bottom:25px;

}





.top-bar{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:25px;

}




.btn{

    padding:12px 22px;

    border-radius:10px;

    text-decoration:none;

    font-weight:bold;

    border:2px solid;

    transition:.3s;

}





.create-btn{

    background:#DCFCE7;

    color:#166534;

    border-color:#16A34A;

}





.back-btn{

    background:#DBEAFE;

    color:#1E3A8A;

    border-color:#2563EB;

}





.btn:hover{

    background:#F59E0B;

    color:white;

    border-color:#F59E0B;

}





table{

    width:100%;

    border-collapse:collapse;

}





th{

    background:#1E3A8A;

    color:white;

    padding:14px;

}





td{

    padding:14px;

    text-align:center;

    border-bottom:1px solid #E2E8F0;

}





tr:hover{

    background:#F8FAFC;

}





.status{

    color:#166534;

    font-weight:bold;

}





.actions{

    display:flex;

    flex-wrap:wrap;

    justify-content:center;

    gap:8px;

}







.action-btn{

    padding:7px 11px;

    border-radius:8px;

    font-size:12px;

    font-weight:bold;

    text-decoration:none;

    border:2px solid;

    background:white;

    cursor:pointer;

    transition:.3s;

}





.action-btn:hover{

    background:#F59E0B;

    color:white;

    border-color:#F59E0B;

}





.settings{

    color:#7C3AED;

    border-color:#7C3AED;

}



.contestants{

    color:#059669;

    border-color:#059669;

}



.judges{

    color:#2563EB;

    border-color:#2563EB;

}



.exposures{

    color:#EA580C;

    border-color:#EA580C;

}



.tabulate{

    color:#166534;

    border-color:#166534;

}



.results{

    color:#B45309;

    border-color:#B45309;

}



.edit{

    color:#2563EB;

    border-color:#2563EB;

}



.delete{

    color:#DC2626;

    border-color:#DC2626;

}



.delete:hover{

    background:#DC2626;

    border-color:#DC2626;

}



</style>


</head>



<body>



<div class="container">



<h1>

🏆 Contest Management

</h1>





<div class="top-bar">


<a href="{{ route('dashboard') }}"
class="btn back-btn">

← Dashboard

</a>



<a href="{{ route('contests.create') }}"
class="btn create-btn">

➕ Create Contest

</a>



</div>







<table>


<tr>


<th>ID</th>

<th>Contest Name</th>

<th>Type</th>

<th>Judges</th>

<th>Contestants</th>

<th>Status</th>

<th>Action</th>


</tr>






@foreach($contests as $contest)



<tr>


<td>

{{ $contest->id }}

</td>



<td>

<strong>

{{ $contest->name }}

</strong>

</td>



<td>

{{ $contest->type }}

</td>



<td>

{{ $contest->judges->count() }}

</td>



<td>

{{ $contest->contestants->count() }}

</td>




<td>


@if($contest->is_active)


<span class="status">

🟢 Active

</span>


@else


<span>

⚪ Inactive

</span>


@endif


</td>





<td>



<div class="actions">





<a href="{{ route('contests.settings',$contest->id) }}"
class="action-btn settings">

⚙ Settings

</a>






<a href="{{ route('contestants.index',$contest->id) }}"
class="action-btn contestants">

👤 Contestants

</a>






<a href="{{ route('judges.index',$contest->id) }}"
class="action-btn judges">

👨‍⚖️ Judges

</a>






<a href="{{ route('exposures.index',$contest->id) }}"
class="action-btn exposures">

🎤 Exposures

</a>






<a href="{{ route('contests.tabulate',$contest->id) }}"
class="action-btn tabulate">

📝 Tabulate

</a>






<a href="{{ route('contests.results',$contest->id) }}"
class="action-btn results">

🏆 Results

</a>






<a href="{{ route('contests.edit',$contest->id) }}"
class="action-btn edit">

✏ Edit

</a>






<form action="{{ route('contests.destroy',$contest->id) }}"
method="POST"
style="display:inline;">


@csrf

@method('DELETE')



<button type="submit"
class="action-btn delete"
onclick="return confirm('Delete this contest?')">

🗑 Delete

</button>


</form>




</div>



</td>


</tr>



@endforeach





</table>






</div>



</body>


</html>