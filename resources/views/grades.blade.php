<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Student Grades</h1>

        <form method="GET" action="{{ route('studentgrades.filter') }}">
            <div class="form-group">
                <label for="generation_id">Generation</label>
                <select name="generation_id" id="generation_id" class="form-control">
                    <option value="">Select Generation</option>
                    @foreach ($generations as $generation)
                        <option value="{{ $generation->id }}" {{ $generation_id == $generation->id ? 'selected' : '' }}>
                            {{ $generation->gen }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="major_id">Major</label>
                <select name="major_id" id="major_id" class="form-control">
                    <option value="">Select Major</option>
                    @foreach ($majors as $major)
                        <option value="{{ $major->id }}" {{ $major_id == $major->id ? 'selected' : '' }}>
                            {{ $major->major }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="subject_id">Subject</label>
                <select name="subject_id" id="subject_id" class="form-control">
                    <option value="">Select Subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $subject_id == $subject->id ? 'selected' : '' }}>
                            {{ $subject->subject }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Generation</th>
                    <th>Major</th>
                    <th>Subject</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->user->fname_lo }}</td>
                        <td>{{ $student->generation->name }}</td>
                        <td>{{ $student->major->name }}</td>
                        <td>{{ $subjects->find($subject_id)->name }}</td>
                        <td>
                            <form action="{{ route('studentgrades.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                <input type="hidden" name="subject_id" value="{{ $subject_id }}">
                                <input type="number" name="grade" class="form-control"
                                    value="{{ $student->studentGrades->first()->grade ?? '' }}">
                                <button type="submit" class="btn btn-sm btn-success">Save</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
