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
    background:#F8FAFC;
    margin:0;
    padding:40px;
}

.container{
    max-width:900px;
    margin:auto;
    background:white;
    padding:35px;
    border-radius:18px;
    border:2px solid #1E3A8A;
    box-shadow:0 10px 25px rgba(0,0,0,.12);
}

/* TITLE */

h1{
    text-align:center;
    color:#1E3A8A;
    font-size:32px;
    margin-bottom:25px;
}

h2{
    color:#1E3A8A;
    text-align:center;
    margin-bottom:20px;
}

h3{
    text-align:center;
    margin:10px;
    color:#334155;
}

/* INFO */

.info{
    background:#F1F5F9;
    padding:20px;
    border-radius:12px;
    margin-bottom:30px;
    text-align:center;
}

.info strong{
    color:#1E3A8A;
}

/* TABLE */

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

/* STATUS */

.open{
    color:#16A34A;
    font-weight:bold;
}

.locked{
    color:#DC2626;
    font-weight:bold;
}

.completed{
    color:#059669;
    font-weight:bold;
}

/* BUTTON */

.action-btn{
    display:inline-block;
    background:#1E3A8A;
    color:white;
    text-decoration:none;
    padding:10px 20px;
    border-radius:8px;
    font-weight:bold;
    transition:.3s;
}

.action-btn:hover{
    background:#F59E0B;
}

.submitted-badge{
    background:#DCFCE7;
    color:#166534;
    padding:8px 14px;
    border-radius:8px;
    font-weight:bold;
    display:inline-block;
}

/* LOGOUT */

.logout{
    text-align:center;
    margin-top:30px;
}

.logout button{
    background:#1E3A8A;
    color:white;
    border:none;
    padding:12px 24px;
    border-radius:8px;
    font-weight:bold;
    cursor:pointer;
}

.logout button:hover{
    background:#F59E0B;
}

</style>

</head>

<body>

<div class="container">

<h1>⚖️ Judge Dashboard</h1>

@if(session('success'))

<div style="
background:#DCFCE7;
color:#166534;
padding:12px;
border-radius:8px;
margin-bottom:20px;
text-align:center;
">

{{ session('success') }}

</div>

@endif

@if(session('error'))

<div style="
background:#FEE2E2;
color:#991B1B;
padding:12px;
border-radius:8px;
margin-bottom:20px;
text-align:center;
">

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

<h2>🎤 Available Exposures</h2>

<table>

<tr>

<th>Exposure</th>

<th>Status</th>

<th>Action</th>

</tr>
@foreach($exposures as $exposure)

<tr>

<td>
    <strong>{{ $exposure->name }}</strong>
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