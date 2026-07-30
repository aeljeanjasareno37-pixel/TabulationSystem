<!DOCTYPE html>
<html>

<head>

<title>Add Contestant</title>

<style>

*{
    box-sizing:border-box;
}

body{

    font-family: Arial, sans-serif;

    background:#F8FAFC;

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    margin:0;

}

/* MAIN CARD */

.container{

    background:white;

    width:650px;

    padding:45px;

    border-radius:18px;

    box-shadow:0 10px 25px rgba(0,0,0,0.12);

    border:2px solid #1E3A8A;

}

/* TITLE */

h1{

    text-align:center;

    color:#1E3A8A;

    margin-bottom:25px;

    font-size:36px;

}

/* CONTEST NAME */

.contest{

    text-align:center;

    font-size:18px;

    font-weight:bold;

    margin-bottom:30px;

    color:#333;

}

/* LABEL */

label{

    display:block;

    margin-top:18px;

    font-weight:bold;

    color:#333;

}

/* INPUT & SELECT */

input,
select{

    width:100%;

    padding:14px;

    margin-top:8px;

    border:1px solid #ccc;

    border-radius:10px;

    font-size:16px;

    background:white;

}

input:focus,
select:focus{

    outline:none;

    border-color:#1E3A8A;

    box-shadow:0 0 5px rgba(30,58,138,0.3);

}

/* BUTTON */

.button{

    width:100%;

    margin-top:35px;

    padding:15px;

    background:#1E3A8A;

    color:white;

    border:none;

    border-radius:10px;

    font-size:17px;

    cursor:pointer;

    transition:.3s;

    font-weight:bold;

}

.button:hover{

    background:#F59E0B;

}

/* BACK LINK */

.back{

    display:block;

    text-align:center;

    margin-top:20px;

    color:#1E3A8A;

    text-decoration:none;

    font-weight:bold;

}

.back:hover{

    color:#F59E0B;

}

</style>

</head>

<body>

<div class="container">

<h1>
👤 Add Contestant
</h1>

<div class="contest">

Contest:
<br>

{{ $contest->name }}

</div>

<form action="{{ route('contestants.store',$contest->id) }}" method="POST">

@csrf

<label>
Contestant Name
</label>

<input
type="text"
name="name"
placeholder="Enter contestant name"
required>

<label>
Second Name (Optional)
</label>

<input
type="text"
name="second_name"
placeholder="Enter second name">

<label>
Gender
</label>

<select name="gender" required>

    <option value="Male">Male</option>

    <option value="Female">Female</option>

</select>

<label>
Team Name (Optional)
</label>

<input
type="text"
name="team_name"
placeholder="Enter team name">

<button type="submit" class="button">

💾 Save Contestant

</button>

</form>

<a
class="back"
href="{{ route('contestants.index',$contest->id) }}">

← Back to Contestant List

</a>

</div>

</body>

</html>