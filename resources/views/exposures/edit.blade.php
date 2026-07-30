<!DOCTYPE html>
<html>

<head>

    <title>Edit Exposure</title>

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
            margin-bottom:10px;

        }

        h3{

            text-align:center;
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

        .error ul{

            margin:0;
            padding-left:20px;

        }

        label{

            display:block;
            font-weight:bold;
            color:#334155;
            margin-bottom:6px;

        }

        input[type=text],
        input[type=number]{

            width:100%;
            padding:10px;
            border:1px solid #CBD5E1;
            border-radius:8px;
            margin-bottom:16px;
            font-size:15px;

        }

        input[type=text]:focus,
        input[type=number]:focus{

            outline:none;
            border-color:#1E3A8A;

        }

        .checkbox{

            margin:15px 0;
            font-weight:bold;
            color:#334155;

        }

        .btn{

            width:100%;
            padding:12px;
            background:#1E3A8A;
            color:white;
            border:2px solid #1E3A8A;
            border-radius:10px;
            font-size:15px;
            font-weight:bold;
            cursor:pointer;
            transition:.3s;

        }

        .btn:hover{

            background:#F59E0B;
            border-color:#F59E0B;

        }

        .back-btn{

            display:block;
            width:100%;
            text-align:center;
            margin-top:15px;
            padding:12px;
            background:#1E3A8A;
            color:white;
            border:2px solid #1E3A8A;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
            transition:.3s;

        }

        .back-btn:hover{

            background:#F59E0B;
            border-color:#F59E0B;
            color:white;

        }

    </style>

</head>

<body>

<div class="container">

    <h1>✏ Edit Exposure</h1>

    <h3>{{ $contest->name }}</h3>

    @if ($errors->any())

        <div class="error">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('exposures.update', [$contest->id, $exposure->id]) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Exposure Name</label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $exposure->name) }}"
            required>

        <label>Order</label>

        <input
            type="number"
            name="order"
            value="{{ old('order', $exposure->order) }}"
            min="1"
            required>

        <div class="checkbox">

            <label>

                <<input type="hidden" name="is_final" value="0">

            <input
                type="checkbox"
                name="is_final"
                value="1"
            {{ old('is_final', $exposure->is_final) ? 'checked' : '' }}>

                Final Round

            </label>

        </div>

        <label>Carry Over Percentage</label>

        <input
            type="number"
            name="carry_over_percentage"
            value="{{ old('carry_over_percentage', $exposure->carry_over_percentage) }}"
            placeholder="Example: 30">

        <label>Top Qualifiers</label>

        <input
            type="number"
            name="top_n"
            value="{{ old('top_n', $exposure->top_n) }}"
            placeholder="Example: 10">

        <button type="submit" class="btn">

            💾 Update Exposure

        </button>

    </form>

    <a href="{{ route('exposures.index', $contest->id) }}" class="back-btn">

        ← Back to Exposure List

    </a>

</div>

</body>

</html>