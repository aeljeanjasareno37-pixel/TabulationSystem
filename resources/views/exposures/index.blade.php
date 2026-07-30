<!DOCTYPE html>
<html>

<head>

<title>Contest Exposures</title>

<style>

*{
    box-sizing:border-box;
}

body{
    font-family:Arial, sans-serif;
    background:#F8FAFC;
    margin:0;
    padding:50px;
}


.container{

    width:95%;
    max-width:1100px;
    margin:20px auto;
    background:white;
    padding:25px 30px;
    border-radius:16px;
    border:2px solid #1E3A8A;
    box-shadow:0 8px 20px rgba(0,0,0,.10);

}



h1{

    text-align:center;
    color:#1E3A8A;
    margin-bottom:10px;

}


.subtitle{

    text-align:center;
    color:#64748B;
    margin-bottom:25px;

}


/* SUCCESS */

.alert{

    background:#DCFCE7;
    color:#166534;
    padding:12px;
    border-radius:10px;
    text-align:center;
    margin-bottom:20px;
    font-weight:bold;

}



/* BUTTON */

.top-bar{

    margin-bottom:20px;

}


.btn{

    background:#1E3A8A;
    color:white;
    padding:10px 20px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
    border:2px solid #1E3A8A;
    display:inline-block;

}


.btn:hover{

    background:#F59E0B;
    border-color:#F59E0B;

}



/* TABLE */

table{

    width:100%;
    border-collapse:separate;
    border-spacing:0 8px;

}


th{

    background:#1E3A8A;
    color:white;
    padding:13px;
    text-align:center;

}


td{

    padding:14px;
    text-align:center;
    background:white;
    border-top:1px solid #E2E8F0;
    border-bottom:1px solid #E2E8F0;

}


td:first-child{

    border-left:1px solid #E2E8F0;

}


td:last-child{

    border-right:1px solid #E2E8F0;

}



tr td:first-child{

    border-radius:10px 0 0 10px;

}


tr td:last-child{

    border-radius:0 10px 10px 0;

}


tr:hover td{

    background:#F8FAFC;

}



/* STATUS */

.open{

    color:#16A34A;
    font-weight:bold;

}


.locked{

    color:#DC2626;
    font-weight:bold;

}



/* ACTION */

.action a,
.action button{

    text-decoration:none;
    font-weight:bold;
    margin:3px;
    padding:7px 12px;
    border-radius:8px;
    background:white;
    border:2px solid;
    display:inline-block;
    font-size:13px;
    cursor:pointer;

}



/* EDIT */

.edit{

    color:#2563EB;
    border-color:#2563EB;

}


.edit:hover{

    background:#2563EB;
    color:white;

}



/* CRITERIA */

.criteria{

    color:#7C3AED;
    border-color:#7C3AED;

}


.criteria:hover{

    background:#7C3AED;
    color:white;

}



/* LOCK */

.lock{

    color:#DC2626;
    border-color:#DC2626;

}


.lock:hover{

    background:#DC2626;
    color:white;

}



/* UNLOCK */

.unlock{

    color:#16A34A;
    border-color:#16A34A;

}


.unlock:hover{

    background:#16A34A;
    color:white;

}



/* DELETE */

.delete{

    color:#DC2626;
    border-color:#DC2626;

}


.delete:hover{

    background:#DC2626;
    color:white;

}


.empty-box{

    padding:40px;
    text-align:center;
    color:#64748B;

}


</style>


</head>


<body>


<div class="container">


<h1>
🎤 {{ $contest->name }} - Exposures
</h1>


<div class="subtitle">
Manage contest rounds and scoring criteria
</div>



@if(session('success'))

<div class="alert">

{{ session('success') }}

</div>

@endif




<div class="top-bar">

<a href="{{ route('exposures.create',$contest->id) }}"
class="btn">

➕ Add Exposure

</a>

</div>




<table>


<tr>

<th>
Order
</th>

<th>
Exposure
</th>

<th>
Final Round
</th>

<th>
Carry Over
</th>

<th>
Top N
</th>

<th>
Status
</th>

<th>
Action
</th>

</tr>




@if($exposures->count() > 0)



@foreach($exposures as $exposure)


<tr>


<td>

{{ $exposure->order }}

</td>



<td>

<strong>

{{ $exposure->name }}

</strong>

</td>



<td>

@if($exposure->is_final)

Yes

@else

No

@endif

</td>



<td>

{{ number_format($exposure->carry_over_percentage,2) }}%

</td>



<td>

{{ $exposure->top_n ?? '-' }}

</td>



<td>

@if($exposure->is_locked)

<span class="locked">

🔒 Locked

</span>


@else

<span class="open">

🟢 Open

</span>

@endif


</td>



<td class="action">



<a href="{{ route('exposures.edit',[$contest->id,$exposure->id]) }}"
class="edit">

✏️ Edit

</a>




<a href="{{ route('criteria.index',[$contest->id,$exposure->id]) }}"
class="criteria">

⚙ Criteria

</a>




@if($exposure->is_locked)


<form action="{{ route('exposures.unlock',[$contest->id,$exposure->id]) }}"
method="POST"
style="display:inline">

@csrf

<button class="unlock">

🔓 Unlock

</button>

</form>



@else



<form action="{{ route('exposures.lock',[$contest->id,$exposure->id]) }}"
method="POST"
style="display:inline">

@csrf

<button class="lock">

🔒 Lock

</button>

</form>


@endif





<form action="{{ route('exposures.destroy',[$contest->id,$exposure->id]) }}"
method="POST"
style="display:inline">

@csrf

@method('DELETE')


<button class="delete"
onclick="return confirm('Delete this exposure?')">

🗑 Delete

</button>


</form>



</td>


</tr>



@endforeach




@else


<tr>

<td colspan="7">


<div class="empty-box">


<div style="font-size:40px;">
🎤
</div>


<h3>
No Exposures Yet
</h3>


<p>
Start by adding your first contest round.
</p>



<a href="{{ route('exposures.create',$contest->id) }}"
class="btn">

➕ Add First Exposure

</a>



</div>


</td>

</tr>



@endif



</table>





<div style="margin-top:25px;">


<a href="{{ route('contests.index') }}"
class="btn">

← Back to Contest List

</a>


</div>



</div>


</body>

</html>