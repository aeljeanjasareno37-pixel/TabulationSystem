<!DOCTYPE html>
<html>
<head>
    <title>Contest Details</title>
</head>

<body>

<h1>Contest Details</h1>

@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif


<table border="1" cellpadding="10">

    <tr>
        <th>Contest Name</th>
        <td>{{ $contest->name }}</td>
    </tr>

    <tr>
        <th>Contest Type</th>
        <td>{{ $contest->contest_type }}</td>
    </tr>

    <tr>
        <th>Number of Judges</th>
        <td>{{ $contest->judge_count }}</td>
    </tr>

    <tr>
        <th>Number of Contestants</th>
        <td>{{ $contest->contestant_count }}</td>
    </tr>

    <tr>
        <th>Tabulator Name</th>
        <td>{{ $contest->tabulator_name }}</td>
    </tr>

    <tr>
        <th>Status</th>
        <td>
            @if($contest->is_active)
                Active
            @elseif($contest->is_completed)
                Completed
            @else
                Pending
            @endif
        </td>
    </tr>

    <tr>
        <th>Created At</th>
        <td>{{ $contest->created_at }}</td>
    </tr>

</table>


<br><br>


<h2>Contestants</h2>

<a href="{{ route('contestants.create') }}">
    Add Contestant
</a>


<br><br>


<table border="1" cellpadding="10">

    <thead>
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Gender</th>
            <th>Category</th>
            <th>Status</th>
        </tr>
    </thead>


    <tbody>

        @forelse($contest->contestants as $contestant)

        <tr>

            <td>
                {{ $contestant->name }}
            </td>

            <td>
                {{ $contestant->contestant_number }}
            </td>

            <td>
                {{ $contestant->gender }}
            </td>

            <td>
                {{ $contestant->category }}
            </td>

            <td>
                @if($contestant->is_active)
                    Active
                @else
                    Inactive
                @endif
            </td>

        </tr>

        @empty

        <tr>
            <td colspan="5">
                No contestants added yet.
            </td>
        </tr>

        @endforelse

    </tbody>

</table>


<br>


<a href="{{ route('contests.index') }}">
    Back to Contest List
</a>


</body>
</html>