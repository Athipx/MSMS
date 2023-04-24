<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('grades.store') }}" method="POST">
        @csrf
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Generation</th>
                    <th>Subject</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->user->name }}</td>
                        <td>{{ $student->generation->name }}</td>
                        <td>{{ $student->assigns->first()->subject->name }}</td>
                        <td>
                            <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                            <input type="number" name="grade[]" step="0.01" min="0" max="100">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit">Submit Grades</button>
    </form>
</body>

</html>
