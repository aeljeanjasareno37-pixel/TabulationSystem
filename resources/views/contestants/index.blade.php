<!DOCTYPE html>
<html>

<head>

<title>Contestant List</title>

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

    max-width:1200px;
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

/* ADD */

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

/* BACK */

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

.gender{

    font-weight:bold;

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

</style>

</head>

<body>

<div class="container">

<h1>

👥 Contestant List

</h1>

<div class="subtitle">

<strong>Contest:</strong>

{{ $contest->name }}

</div>

<div class="top-bar">

<a href="{{ route('contests.settings',$contest->id) }}"
class="btn back-btn">

← Back to Settings

</a>

<a href="{{ route('contestants.create',$contest->id) }}"
class="btn add-btn">

➕ Add Contestant

</a>

</div>

<table>

<tr>

<th>ID</th>

<th>No.</th>

<th>Contestant Name</th>

<th>Gender</th>

<th>Second Name</th>

<th>Team Name</th>

<th>Actions</th>

</tr>

@if($contest->contest_type == 'double')

    <tr>
        <td colspan="7"
            style="
                background:#DBEAFE;
                color:#1E3A8A;
                font-weight:bold;
                text-align:left;
                font-size:18px;
            ">
            👨 Male Contestants
        </td>
    </tr>

    @foreach($maleContestants as $contestant)

    <tr>

        <td>{{ $contestant->id }}</td>

        <td>{{ $contestant->number }}</td>

        <td>
            <strong>{{ $contestant->name }}</strong>
        </td>

        <td>👨 Male</td>

        <td>{{ $contestant->second_name }}</td>

        <td>{{ $contestant->team_name }}</td>

        <td>

            <a href="{{ route('contestants.edit',[$contest->id,$contestant->id]) }}"
               class="action-btn edit">
                ✏️ Edit
            </a>

            <form action="{{ route('contestants.destroy',[$contest->id,$contestant->id]) }}"
                  method="POST"
                  style="display:inline-block;">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="action-btn delete"
                    onclick="return confirm('Delete this contestant?')">

                    🗑 Delete

                </button>

            </form>

        </td>

    </tr>

    @endforeach

    <tr>
        <td colspan="7"
            style="
                background:#FCE7F3;
                color:#BE185D;
                font-weight:bold;
                text-align:left;
                font-size:18px;
            ">
            👩 Female Contestants
        </td>
    </tr>

    @foreach($femaleContestants as $contestant)

    <tr>

        <td>{{ $contestant->id }}</td>

        <td>{{ $contestant->number }}</td>

        <td>
            <strong>{{ $contestant->name }}</strong>
        </td>

        <td>👩 Female</td>

        <td>{{ $contestant->second_name }}</td>

        <td>{{ $contestant->team_name }}</td>

        <td>

            <a href="{{ route('contestants.edit',[$contest->id,$contestant->id]) }}"
               class="action-btn edit">
                ✏️ Edit
            </a>

            <form action="{{ route('contestants.destroy',[$contest->id,$contestant->id]) }}"
                  method="POST"
                  style="display:inline-block;">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="action-btn delete"
                    onclick="return confirm('Delete this contestant?')">

                    🗑 Delete

                </button>

            </form>

        </td>

    </tr>

    @endforeach

@else

    @foreach($contestants as $contestant)

    <tr>

        <td>{{ $contestant->id }}</td>

        <td>{{ $contestant->number }}</td>

        <td>
            <strong>{{ $contestant->name }}</strong>
        </td>

        <td>
            @if($contestant->gender=='Male')
                👨 Male
            @elseif($contestant->gender=='Female')
                👩 Female
            @else
                —
            @endif
        </td>

        <td>{{ $contestant->second_name }}</td>

        <td>{{ $contestant->team_name }}</td>

        <td>

            <a href="{{ route('contestants.edit',[$contest->id,$contestant->id]) }}"
               class="action-btn edit">
                ✏️ Edit
            </a>

            <form action="{{ route('contestants.destroy',[$contest->id,$contestant->id]) }}"
                  method="POST"
                  style="display:inline-block;">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="action-btn delete"
                    onclick="return confirm('Delete this contestant?')">

                    🗑 Delete

                </button>

            </form>

        </td>

    </tr>

    @endforeach

@endif

</table>

</div>

</body>

</html>