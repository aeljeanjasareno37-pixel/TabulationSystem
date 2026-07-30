<!DOCTYPE html>
<html>

<head>

    <title>Edit Judge</title>

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

        input{

            width:100%;

            padding:10px;

            border:1px solid #CBD5E1;

            border-radius:8px;

            margin-bottom:18px;

            font-size:15px;

        }

        input:focus{

            outline:none;

            border-color:#1E3A8A;

        }

        input[readonly]{

            background:#F1F5F9;

            color:#475569;

            cursor:not-allowed;

        }

        small{

            display:block;

            margin-top:-10px;

            margin-bottom:20px;

            color:#64748B;

        }

        /* Pantay ang dalawang button */

        .btn,
        .back-btn{

            display:block;

            width:100%;

            height:48px;

            line-height:22px;

            padding:12px;

            margin-top:15px;

            background:#1E3A8A;

            color:white;

            border:2px solid #1E3A8A;

            border-radius:10px;

            font-size:15px;

            font-weight:bold;

            text-align:center;

            text-decoration:none;

            cursor:pointer;

            transition:.3s;

        }

        .btn:hover,
        .back-btn:hover{

            background:#F59E0B;

            border-color:#F59E0B;

            color:white;

        }

    </style>

</head>

<body>

<div class="container">

    <h1>✏ Edit Judge</h1>

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

    <form action="{{ route('judges.update', [$contest->id, $judge->id]) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Judge Name</label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $judge->name) }}"
            required>

        <label>Access Code</label>

        <input
            type="text"
            value="{{ $judge->access_code }}"
            readonly>

        <small>
            Access code is automatically generated and cannot be edited.
        </small>

        <button type="submit" class="btn">

            💾 Update Judge

        </button>

    </form>

    <a href="{{ route('judges.index', $contest->id) }}" class="back-btn">

        ← Back to Judge List

    </a>

</div>

</body>

</html>