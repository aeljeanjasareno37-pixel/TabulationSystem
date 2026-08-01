```html
<!DOCTYPE html>
<html>

<head>

<title>Judge Dashboard</title>

<style>

*{
    box-sizing:border-box;
}

body{
    font-family:Arial, sans-serif;
    background:linear-gradient(135deg,#0f172a,#1e3a8a);
    margin:0;
    padding:40px;
}


/* MAIN CARD */

.container{

    max-width:1100px;
    margin:auto;
    background:white;
    padding:45px;
    border-radius:25px;
    box-shadow:0 20px 50px rgba(0,0,0,.25);

}



/* HEADER */

h1{

    text-align:center;
    color:#2563eb;
    font-size:40px;
    margin-bottom:35px;

}


h2{

    text-align:center;
    color:#1e3a8a;
    margin:35px 0 20px;

}



/* ALERT */

.alert-success{

    background:#dcfce7;
    color:#166534;
    padding:15px;
    border-radius:12px;
    margin-bottom:20px;
    text-align:center;
    font-weight:bold;

}


.alert-error{

    background:#fee2e2;
    color:#991b1b;
    padding:15px;
    border-radius:12px;
    margin-bottom:20px;
    text-align:center;
    font-weight:bold;

}



/* INFO */

.info{

    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    color:white;
    padding:30px;
    border-radius:20px;
    text-align:center;
    margin-bottom:35px;

}


.info h3{

    margin:12px;
    color:white;

}


.info strong{

    color:#facc15;

}



/* TABLE */

table{

    width:100%;
    border-collapse:separate;
    border-spacing:0;
    overflow:hidden;
    border-radius:18px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);

}


th{

    background:#0f172a;
    color:white;
    padding:18px;
    font-size:16px;

}


td{

    padding:18px;
    text-align:center;
    border-bottom:1px solid #e2e8f0;

}


tr:hover{

    background:#f8fafc;

}



/* STATUS */

.open{

    background:#dcfce7;
    color:#166534;
    padding:8px 15px;
    border-radius:20px;
    font-weight:bold;

}


.locked{

    background:#fee2e2;
    color:#991b1b;
    padding:8px 15px;
    border-radius:20px;
    font-weight:bold;

}


.completed{

    background:#d1fae5;
    color:#047857;
    padding:8px 15px;
    border-radius:20px;
    font-weight:bold;

}



/* BUTTON */

.action-btn{

    display:inline-block;
    background:#2563eb;
    color:white;
    text-decoration:none;
    padding:12px 25px;
    border-radius:12px;
    font-weight:bold;
    transition:.3s;

}


.action-btn:hover{

    background:#1d4ed8;
    transform:translateY(-2px);

}



/* SUBMITTED */

.submitted-badge{

    background:#dcfce7;
    color:#166534;
    padding:10px 18px;
    border-radius:20px;
    font-weight:bold;

}



/* LOGOUT */

.logout{

    text-align:center;
    margin-top:40px;

}


.logout button{

    background:#ef4444;
    color:white;
    border:none;
    padding:14px 35px;
    border-radius:12px;
    font-weight:bold;
    cursor:pointer;
    font-size:15px;

}


.logout button:hover{

    background:#b91c1c;

}



</style>

</head>


<body>

<body>

<h1 style="color:red;font-size:80px;">
TEST JUDGE DASHBOARD
</h1>

<div class="container">


<h1>
⚖️ Judge Dashboard
</h1>



@if(session('success'))

<div class="alert-success">

{{ session('success') }}

</div>

@endif



@if(session('error'))

<div class="alert-error">

{{ session('error') }}

</div>

@endif




<div class="info">


<h3>
Welcome,
<strong>{{ $judge->name }}</strong>
</h3>


<h3>
Contest:
<strong>{{ $judge->contest->name }}</strong>
</h3>


</div>





<h2>
🎤 Available Exposures
</h2>




<table>


<tr>

<th>
Exposure
</th>

<th>
Status
</th>

<th>
Action
</th>

</tr>



@foreach($exposures as $exposure)


<tr>


<td>

<strong>
{{ $exposure->name }}
</strong>

</td>



<td>


@if($exposure->status == 'submitted')

<span class="completed">
✅ Submitted
</span>


@elseif($exposure->status == 'open')


<span class="open">
🟢 Open
</span>


@else


<span class="locked">
🔒 Locked
</span>


@endif


</td>




<td>



@if($exposure->status == 'submitted')


<span class="submitted-badge">
✔ Submitted
</span>



@elseif($exposure->status == 'open')


<a href="{{ route('scores.create', $exposure->id) }}"
class="action-btn">

📝 Enter Scores

</a>



@else


<span class="locked">
🔒 Closed
</span>



@endif



</td>



</tr>



@endforeach



</table>




<div class="logout">


<form action="{{ route('judge.logout') }}" method="POST">

@csrf


<button type="submit">

🚪 Logout

</button>


</form>


</div>



</div>


</body>

</html>
```
