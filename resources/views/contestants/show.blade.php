<!DOCTYPE html>
<html>
<head>
    <title>Contestant Details</title>
</head>

<body>

<h1>Contestant Details</h1>


<table border="1" cellpadding="10">

    <tr>
        <th>Contest</th>
        <td>{{ $contestant->contest->name }}</td>
    </tr>

    <tr>
        <th>Contestant Name</th>
        <td>{{ $contestant->name }}</td>
    </tr>

    <tr>
        <th>Contestant Number</th>
        <td>{{ $contestant->contestant_number }}</td>
    </tr>

    <tr>
        <th>Gender</th>
        <td>{{ $contestant->gender }}</td>
    </tr>

    <tr>
        <th>Category</th>
        <td>{{ $contestant->category }}</td>
    </tr>

    <tr>
        <th>Status</th>
        <td>
            @if($contestant->is_active)
                Active
            @else
                Inactive
            @endif
        </td>
    </tr>

    <tr>
        <th>Created At</th>
        <td>{{ $contestant->created_at }}</td>
    </tr>

</table>


<br>


<a href="{{ route('contestants.index') }}">
    Back to Contestant List
</a>


</body>
</html>