<!DOCTYPE html>
<html>

<head>

<title>Edit Contest</title>

<style>

body{
    font-family:Arial, sans-serif;
    background:#F8FAFC;
    padding:30px;
}

/* Main Card */

.container{
    max-width:650px;
    margin:auto;
    background:white;
    padding:35px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

/* Title */

h1{
    text-align:center;
    color:#1E3A8A;
    margin-bottom:30px;
}

/* Form */

label{
    font-weight:bold;
    color:#334155;
    display:block;
    margin-bottom:8px;
}

input,
select{
    width:100%;
    padding:12px;
    border:1px solid #CBD5E1;
    border-radius:8px;
    font-size:16px;
    box-sizing:border-box;
}

input:focus,
select:focus{
    outline:none;
    border-color:#1E3A8A;
}

.form-group{
    margin-bottom:20px;
}

/* Buttons */

.btn{
    background:#1E3A8A;
    color:white;
    padding:13px 25px;
    border:none;
    border-radius:8px;
    font-weight:bold;
    cursor:pointer;
    font-size:15px;
}

.btn:hover{
    background:#F59E0B;
}

.back-btn{
    display:block;
    width:fit-content;
    margin:30px auto 0;
    background:#1E3A8A;
    color:white;
    padding:12px 25px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
}

.back-btn:hover{
    background:#F59E0B;
    color:white;
}

.preview{
    margin-top:10px;
    margin-bottom:10px;
}

.preview img{
    width:120px;
    border-radius:8px;
    border:1px solid #CBD5E1;
}

</style>

</head>

<body>

<div class="container">

<h1>✏️ Edit Contest</h1>
@if ($errors->any())
    <div style="background:#FEE2E2;color:#991B1B;padding:15px;border-radius:8px;margin-bottom:20px;">
        <strong>Errors:</strong>
        <ul style="margin:10px 0 0 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('contests.update', $contest->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Contest Name</label>
        <input
            type="text"
            name="name"
            value="{{ $contest->name }}"
            required>
    </div>

    <div class="form-group">
        <label>Contest Type</label>

        <select name="contest_type">

            <option value="Single"
                {{ $contest->contest_type == 'Single' ? 'selected' : '' }}>
                Single
            </option>

            <option value="Double"
                {{ $contest->contest_type == 'Double' ? 'selected' : '' }}>
                Double
            </option>

            <option value="Group"
                {{ $contest->contest_type == 'Group' ? 'selected' : '' }}>
                Group
            </option>

        </select>
    </div>

    <div class="form-group">
        <label>Number of Judges</label>

        <input
            type="number"
            name="judge_count"
            value="{{ $contest->judge_count }}"
            required>
    </div>

    <div class="form-group">
        <label>Number of Contestants</label>

        <input
            type="number"
            name="contestant_count"
            value="{{ $contest->contestant_count }}"
            required>
    </div>

    <div class="form-group">
        <label>Tabulator Name</label>

        <input
            type="text"
            name="tabulator_name"
            value="{{ $contest->tabulator_name }}">
    </div>

    <div class="form-group">
        <label>School Logo</label>

        @if($contest->logo)
            <div class="preview">
                <img src="{{ asset('storage/'.$contest->logo) }}">
            </div>
        @endif

        <input
            type="file"
            name="logo"
            accept="image/*">
    </div>

    <div class="form-group">
        <label>Pageant Logo</label>

        @if($contest->pageant_logo)
            <div class="preview">
                <img src="{{ asset('storage/'.$contest->pageant_logo) }}">
            </div>
        @endif

        <input
            type="file"
            name="pageant_logo"
            accept="image/*">
    </div>

    <button type="submit" class="btn">
        💾 Update Contest
    </button>

</form>

<a href="{{ route('contests.index') }}" class="back-btn">
    ← Back to Contest List
</a>

</div>

</body>
</html>