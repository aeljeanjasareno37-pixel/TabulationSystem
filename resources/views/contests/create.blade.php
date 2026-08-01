<!DOCTYPE html>
<html>

<head>

    <title>Create Contest</title>

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

            margin:25px auto;

            background:white;

            padding:28px;

            border-radius:14px;

            border:2px solid #1E3A8A;

            box-shadow:0 8px 18px rgba(0,0,0,.10);

        }

        h1{

            text-align:center;

            color:#1E3A8A;

            font-size:28px;

            margin-bottom:22px;

        }

        label{

            display:block;

            font-weight:bold;

            color:#334155;

            margin-bottom:6px;

            font-size:15px;

        }

        input,
        textarea,
        select{

            width:100%;

            padding:10px;

            margin-bottom:16px;

            border:1px solid #CBD5E1;

            border-radius:8px;

            font-size:15px;

            transition:.3s;

        }

        input:focus,
        textarea:focus,
        select:focus{

            outline:none;

            border-color:#1E3A8A;

        }

        textarea{

            height:90px;

            resize:vertical;

        }

        .btn{

            width:100%;

            background:#1E3A8A;

            color:white;

            border:2px solid #1E3A8A;

            padding:12px;

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

            margin-top:15px;

            text-align:center;

            background:#1E3A8A;

            color:white;

            border:2px solid #1E3A8A;

            padding:12px;

            border-radius:10px;

            text-decoration:none;

            font-size:15px;

            font-weight:bold;

            transition:.3s;

        }

        .back-btn:hover{

            background:#F59E0B;

            border-color:#F59E0B;

            color:white;

        }

        .error{

            background:#FEE2E2;

            color:#991B1B;

            border-radius:8px;

            padding:12px;

            margin-bottom:18px;

        }

        .error ul{

            margin:0;

            padding-left:18px;

        }

    </style>

</head>

<body>

<div class="container">

    <h1>🏆 Create Contest</h1>

    @if($errors->any())

        <div class="error">

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('contests.store') }}" method="POST">

        @csrf

        <label>Contest Name</label>

        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Example: CCDI Mr. and Ms. Intramurals 2026"
            required>

        <label>Contest Type</label>

        <select name="contest_type" required>

            <option value="">Select Contest Type</option>

            <option value="single">Single Contest</option>

            <option value="double">Double Contest (Male / Female)</option>

            <option value="group">Group Contest</option>

        </select>

        <label>Number of Judges</label>

        <input
            type="number"
            name="judge_count"
            value="{{ old('judge_count') }}"
            placeholder="Example: 5"
            required>

        <label>Number of Contestants</label>

        <input
            type="number"
            name="contestant_count"
            value="{{ old('contestant_count') }}"
            placeholder="Example: 20"
            required>

        <label>Tabulator Name (Optional)</label>

        <input
            type="text"
            name="tabulator_name"
            value="{{ old('tabulator_name') }}"
            placeholder="Example: Aeljean Villamil Jasareno">

        <label>Description (Optional)</label>

        <textarea
            name="description"
            placeholder="Example: CCDI Mr. and Ms. Intramurals Pageant">{{ old('description') }}</textarea>

        <button type="submit" class="btn">

            💾 Save Contest

        </button>

    </form>

    <a href="{{ route('contests.index') }}" class="back-btn">

        ← Back to Contest List

    </a>

</div>

</body>

</html>