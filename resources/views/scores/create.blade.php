<!DOCTYPE html>
<html>

<head>

<title>Judge Score Entry</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    font-family:Arial,sans-serif;
    background:#F8FAFC;
    padding:30px;

}

.container{

    max-width:1200px;
    margin:auto;
    background:white;
    padding:35px;
    border-radius:18px;
    border:2px solid #1E3A8A;
    box-shadow:0 10px 25px rgba(0,0,0,.10);

}

h1{

    text-align:center;
    color:#1E3A8A;
    margin-bottom:15px;

}

.info{

    text-align:center;
    color:#475569;
    line-height:1.8;
    margin-bottom:30px;

}

.info strong{

    color:#1E3A8A;

}

.alert{

    background:#FEE2E2;
    color:#991B1B;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
    text-align:center;
    font-weight:bold;

}

.success{

    background:#DCFCE7;
    color:#166534;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
    text-align:center;
    font-weight:bold;

}

.section-title{

    background:#1E3A8A;
    color:white;
    padding:12px;
    border-radius:10px;
    margin-top:30px;
    margin-bottom:15px;
    font-size:20px;

}

table{

    width:100%;
    border-collapse:collapse;
    margin-bottom:30px;

}

th{

    background:#1E3A8A;
    color:white;
    padding:12px;
    text-align:center;

}

td{

    padding:12px;
    border-bottom:1px solid #E2E8F0;
    text-align:center;

}

tr:hover{

    background:#F8FAFC;

}

.score-input{

    width:80px;
    padding:8px;
    text-align:center;
    border:1px solid #CBD5E1;
    border-radius:8px;
    font-weight:bold;

}

.score-input:focus{

    outline:none;
    border-color:#1E3A8A;
    box-shadow:0 0 4px rgba(30,58,138,.3);

}

.submit-btn{

    width:100%;
    padding:15px;
    background:#1E3A8A;
    color:white;
    border:none;
    border-radius:10px;
    font-size:17px;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;

}

.submit-btn:hover{

    background:#F59E0B;

}

</style>

</head>

<body>

<div class="container">

<h1>

📝 Judge Score Entry

</h1>

<div class="info">

<strong>Judge:</strong> {{ $judge->name }}

<br>

<strong>Contest:</strong> {{ $contest->name }}

<br>

<strong>Exposure:</strong> {{ $exposure->name }}

</div>

@if(session('error'))

<div class="alert">

{{ session('error') }}

</div>

@endif

@if(session('success'))

<div class="success">

{{ session('success') }}

</div>

@endif

<form action="{{ route('scores.store') }}" method="POST">

@csrf

<input
type="hidden"
name="exposure_id"
value="{{ $exposure->id }}">
@if($contest->contest_type == 'double')

<div class="section-title">

👨 Male Contestants

</div>

<table>

<tr>

<th>No.</th>

<th>Contestant</th>

@foreach($criteria as $criterion)

<th>

{{ $criterion->name }}

<br>

<small>

{{ $criterion->minimum_score }}

-

{{ $criterion->maximum_score }}

</small>

</th>

@endforeach

</tr>

@foreach($maleContestants as $contestant)

<tr>

<td>

{{ $contestant->number }}

</td>

<td>

<strong>

{{ $contestant->name }}

</strong>

</td>

@foreach($criteria as $criterion)

<td>

<input
type="number"
class="score-input"
name="scores[{{ $contestant->id }}][{{ $criterion->id }}]"
min="{{ $criterion->minimum_score }}"
max="{{ $criterion->maximum_score }}"
step="0.01"
required>

</td>

@endforeach

</tr>

@endforeach

</table>



<div class="section-title">

👩 Female Contestants

</div>

<table>

<tr>

<th>No.</th>

<th>Contestant</th>

@foreach($criteria as $criterion)

<th>

{{ $criterion->name }}

<br>

<small>

{{ $criterion->minimum_score }}

-

{{ $criterion->maximum_score }}

</small>

</th>

@endforeach

</tr>

@foreach($femaleContestants as $contestant)

<tr>

<td>

{{ $contestant->number }}

</td>

<td>

<strong>

{{ $contestant->name }}

</strong>

</td>

@foreach($criteria as $criterion)

<td>

<input
type="number"
class="score-input"
name="scores[{{ $contestant->id }}][{{ $criterion->id }}]"
min="{{ $criterion->minimum_score }}"
max="{{ $criterion->maximum_score }}"
step="0.01"
required>

</td>

@endforeach

</tr>

@endforeach

</table>

@else

<div class="section-title">

👥 Contestants

</div>

<table>

<tr>

<th>No.</th>

<th>Contestant</th>

@foreach($criteria as $criterion)

<th>

{{ $criterion->name }}

<br>

<small>

{{ $criterion->minimum_score }}

-

{{ $criterion->maximum_score }}

</small>

</th>

@endforeach

</tr>

@foreach($contestants as $contestant)

<tr>

<td>

{{ $contestant->number }}

</td>

<td>

<strong>

{{ $contestant->name }}

</strong>

</td>

@foreach($criteria as $criterion)

<td>

<input
type="number"
class="score-input"
name="scores[{{ $contestant->id }}][{{ $criterion->id }}]"
min="{{ $criterion->minimum_score }}"
max="{{ $criterion->maximum_score }}"
step="0.01"
required>

</td>

@endforeach

</tr>

@endforeach

</table>

@endif
<button
type="submit"
class="submit-btn">

💾 Submit Scores

</button>

</form>

</div>

</body>

</html>