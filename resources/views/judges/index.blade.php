<!DOCTYPE html>
<html>

<head>

<title>Judge Management</title>


<style>

*{
    box-sizing:border-box;
}


body{

    font-family:Arial, sans-serif;
    background:#F8FAFC;
    margin:0;
    padding:30px;

}



.container{

    max-width:1000px;
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

    margin-bottom:10px;

}



.subtitle{

    text-align:center;

    color:#475569;

    margin-bottom:30px;

}




.top-bar{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:25px;

}





.btn{

    display:inline-block;

    padding:12px 22px;

    border-radius:10px;

    text-decoration:none;

    font-weight:bold;

    border:2px solid;

    transition:.3s;

}





/* ADD BUTTON */

.add-btn{

    background:#DCFCE7;

    color:#166534;

    border-color:#16A34A;

}



.add-btn:hover{

    background:#F59E0B;

    color:white;

    border-color:#F59E0B;

}





/* BACK BUTTON */

.back-btn{

    background:#DBEAFE;

    color:#1E3A8A;

    border-color:#2563EB;

}



.back-btn:hover{

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

    text-align:center;

}





td{

    padding:14px;

    text-align:center;

    border-bottom:1px solid #E2E8F0;

}





tr:hover{

    background:#F8FAFC;

}






.actions{

    min-width:200px;

}






.action-btn{

    display:inline-block;

    padding:8px 15px;

    margin:4px;

    border-radius:10px;

    text-decoration:none;

    font-weight:bold;

    font-size:13px;

    border:2px solid;

    transition:.3s;

    cursor:pointer;

}







/* EDIT */

.edit{

    color:#2563EB;

    border-color:#2563EB;

    background:white;

}



.edit:hover{

    background:#F59E0B;

    border-color:#F59E0B;

    color:white;

}






/* DELETE */

.delete{

    color:#DC2626;

    border-color:#DC2626;

    background:white;

}



.delete:hover{

    background:#DC2626;

    border-color:#DC2626;

    color:white;

}






.code{

    background:#EEF2FF;

    color:#1E3A8A;

    padding:7px 12px;

    border-radius:8px;

    font-weight:bold;

}



</style>


</head>


<body>



<div class="container">



<h1>

👨‍⚖️ Judge Management

</h1>



<div class="subtitle">

<strong>Contest:</strong>

{{ $contest->name }}

</div>






<div class="top-bar">



<a href="{{ route('contests.index') }}"
class="btn back-btn">

← Back to Contest List

</a>




<a href="{{ route('judges.create',$contest->id) }}"
class="btn add-btn">

➕ Add Judge

</a>



</div>








<table>


<tr>


<th>
ID
</th>


<th>
Judge Name
</th>


<th>
Access Code
</th>


<th>
Actions
</th>


</tr>







@foreach($judges as $judge)



<tr>



<td>

{{ $judge->id }}

</td>





<td>

<strong>

{{ $judge->name }}

</strong>

</td>





<td>

<span class="code">

{{ $judge->access_code }}

</span>

</td>







<td class="actions">





<a href="{{ route('judges.edit',
[
$contest->id,
$judge->id
]) }}"
class="action-btn edit">

✏️ Edit

</a>







<form action="{{ route('judges.destroy',
[
$contest->id,
$judge->id
]) }}"
method="POST"
style="display:inline-block;">


@csrf

@method('DELETE')



<button type="submit"
class="action-btn delete"
onclick="return confirm('Delete this judge?')">

🗑 Delete

</button>


</form>






</td>





</tr>




@endforeach





</table>





</div>



</body>

</html>