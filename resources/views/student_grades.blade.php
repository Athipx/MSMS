<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grades</title>
</head>

<body>
    <h1>Filter Student Grades</h1>

    <form method="GET" action="{{ route('student_grades') }}">
        <div class="form-group">
            <label for="generation">Generation:</label>
            <select id="generation" name="generation" class="form-control">
                <option value="">Select Generation</option>
                @foreach ($generations as $generation)
                    <option value="{{ $generation->id }}">{{ $generation->gen }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="major">Major:</label>
            <select id="major" name="major" class="form-control">
                <option value="">Select Major</option>
                @foreach ($majors as $major)
                    <option value="{{ $major->id }}">{{ $major->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subject">Subject:</label>
            <select id="subject" name="subject" class="form-control">
                <option value="">Select Subject</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="semester">Semester:</label>
            <select id="semester" name="semester" class="form-control">
                <option value="">Select Semester</option>
                @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    @if ($grades->isEmpty())
        <div class="alert alert-warning">
            No results found.
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Generation</th>
                    <th>Major</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade)
                    <tr>
                        <td>{{ $grade->student_name }}</td>
                        <td>{{ $grade->generation_name }}</td>
                        <td>{{ $grade->major_name }}</td>
                        <td>{{ $grade->grade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>
