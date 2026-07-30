<!DOCTYPE html>
<html>

<head>

    <title>Edit Contestant</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background:#F8FAFC;
            padding:30px;
        }


        .container {

            background:white;
            max-width:600px;
            margin:auto;
            padding:30px;
            border-radius:12px;
            box-shadow:0 5px 15px #ddd;

        }


        h1 {

            color:#1E3A8A;
            text-align:center;

        }


        label {

            font-weight:bold;
            color:#374151;

        }


        input,
        select {

            width:100%;
            padding:10px;
            margin-top:5px;
            border:1px solid #ccc;
            border-radius:6px;

        }



        .update-btn {

            background:#D4AF37;
            color:white;
            border:none;
            padding:12px;
            width:100%;
            border-radius:6px;
            font-weight:bold;
            cursor:pointer;

        }


        .update-btn:hover {

            background:#B89620;

        }



        .back-btn {

            display:inline-block;
            margin-top:20px;
            background:#1E3A8A;
            color:white;
            padding:10px 20px;
            border-radius:6px;
            text-decoration:none;
            font-weight:bold;

        }


        .back-btn:hover {

            background:#162D6B;
            color:white;

        }



        .error-box {

            background:#FEE2E2;
            color:#B91C1C;
            padding:10px;
            border-radius:6px;

        }


    </style>


</head>



<body>


<div class="container">



<h1>✏️ Edit Contestant</h1>




@if($errors->any())

<div class="error-box">

<ul>

@foreach($errors->all() as $error)

<li>
{{ $error }}
</li>

@endforeach

</ul>

</div>

@endif





<form action="{{ route('contestants.update', [$contest->id, $contestant->id]) }}"
method="POST">


@csrf

@method('PUT')





<label>Select Contest:</label>


<select name="contest_id">


@foreach($contests as $item)


<option value="{{ $item->id }}"

{{ $contestant->contest_id == $item->id ? 'selected' : '' }}>


{{ $item->name }}


</option>


@endforeach


</select>




<br><br>




<label>Contestant Number:</label>


<input type="text"
value="{{ $contestant->number }}"
readonly>




<br><br>





<label>Contestant Name:</label>


<input type="text"
name="name"
value="{{ $contestant->name }}">





<br><br>





<label>Second Name:</label>


<input type="text"
name="second_name"
value="{{ $contestant->second_name }}">





<br><br>





<label>Team Name:</label>


<input type="text"
name="team_name"
value="{{ $contestant->team_name }}">





<br><br>





<button type="submit" class="update-btn">

Update Contestant

</button>




</form>





<a href="{{ route('contestants.index',$contest->id) }}"
class="back-btn">

← Back to Contestant List

</a>




</div>


</body>


</html>