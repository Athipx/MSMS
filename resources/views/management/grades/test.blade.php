@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ຄະແນນການສຶກສາ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ການສຶກສາ</a></li>
                            <li class="breadcrumb-item active">ຄະແນນການສຶກສາ</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <button type="button" class="btn btn-light btn-rounded waves-effect waves-light"
                                    data-toggle="modal" data-target="#myModal"><i class="fas fa-plus mr-1"></i>
                                    ເພີ່ມຂໍ້ມູນ</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">

                                <form method="post" action="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="major_id">ສາຂາວິຊາ</label>
                                                <select class="form-control" name="major_id" id="major_id">
                                                    <option value="">-- ເລືອກ ສາຂາວິຊາ --</option>
                                                    @foreach ($majors as $major)
                                                        <option value="{{ $major->id }}"
                                                            {{ old('major_id') == $major->major ? 'selected' : '' }}>
                                                            {{ $major->major }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="gen_id">ຮຸ່ນການສຶກສາ</label>
                                                <select class="custom-select" name="gen_id" id="gen_id">
                                                    <option value="">-- ເລືອກ ຮຸ່ນການສຶກສາ --</option>
                                                    @foreach ($gen as $item)
                                                        <option value="{{ $item->id }}">{{ $item->gen }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">ວິຊາຮຽນ</label>
                                                <select class="form-control" name="subject_id" id="subject_id">
                                                    <option value="">-- ເລືອກ ວິຊາຮຽນ --</option>
                                                    {{-- @foreach ($subjects as $item)
                                                        <option value="{{ $item->id }}">{{ $item->subject }}
                                                        </option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <a id="search" class="btn btn-primary" name="search"> Search</a>
                                        </div>
                                    </div>

                                    {{-- <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Year <span class="text-danger"> </span></h5>
                                                <div class="controls">
                                                    <select name="year_id" id="year_id" required=""
                                                        class="form-control">
                                                        <option value="" selected="" disabled="">Select Year
                                                        </option>
                                                        @foreach ($years as $year)
                                                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                        </div> <!-- End Col md 3 -->




                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Class <span class="text-danger"> </span></h5>
                                                <div class="controls">
                                                    <select name="class_id" id="class_id" required=""
                                                        class="form-control">
                                                        <option value="" selected="" disabled="">Select Class
                                                        </option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                        </div> <!-- End Col md 3 -->


                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Subject <span class="text-danger"> </span></h5>
                                                <div class="controls">
                                                    <select name="assign_subject_id" id="assign_subject_id" required=""
                                                        class="form-control">
                                                        <option selected="">Select Subject</option>
                                                        @foreach ($subjects as $exam)
                                                            <option value="{{ $exam->id }}">
                                                                {{ $exam->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                        </div> <!-- End Col md 3 -->


                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Exam Type <span class="text-danger"> </span></h5>
                                                <div class="controls">
                                                    <select name="exam_type_id" id="exam_type_id" required=""
                                                        class="form-control">
                                                        <option value="" selected="" disabled="">Select Class
                                                        </option>
                                                        @foreach ($exam_types as $exam)
                                                            <option value="{{ $exam->id }}">{{ $exam->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                        </div> <!-- End Col md 3 -->
                                        <div class="col-md-3">

                                            <a id="search" class="btn btn-primary" name="search"> Search</a>

                                        </div> <!-- End Col md 3 -->
                                    </div><!--  end row --> --}}


                                    <!--  ////////////////// Mark Entry table /////////////  -->


                                    <div class="row d-none" id="grade-entry">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID No</th>
                                                        <th>Student Name </th>
                                                        <th>Father Name </th>
                                                        <th>Gender</th>
                                                        <th>Marks</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="grade-entry-tr">

                                                </tbody>

                                            </table>
                                            <input type="submit" class="btn btn-rounded btn-primary" value="Submit">

                                        </div>

                                    </div>


                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>

    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            var major_id = $('#major_id').val();
            var gen_id = $('#gen_id').val();
            var subject_id = $('#subject_id').val();
            $.ajax({
                url: "{{ route('grades.getStudents') }}",
                type: "GET",
                data: {
                    'major_id': major_id,
                    'gen_id': gen_id
                },
                success: function(data) {
                    $('#grade-entry').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                        html +=
                            '<tr>' +
                            '<td>' + v.student_id +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"></td>' +
                            '<td>' + v.user.fname_lo + '</td>' +
                            '<td>' + v.major.major + '</td>' +
                            '<td>' + v.gen.gen + '</td>' +
                            '<td><input type="text" class="form-control" name="grade[]"></td>' +
                            '</tr>';
                    });
                    html = $('#grade-entry-tr').html(html);
                }
            });
        });
    </script>


    {{-- <script type="text/javascript">
        $(document).on('click', '#search', function(event) {
            event.preventDefault();
            var major_id = $('#major_id').val();
            var gen_id = $('#gen_id').val();
            var subject_id = $('#subject_id').val();
            $.ajax({
                url: "{{ route('grades.getStudents') }}",
                type: "GET",
                data: {
                    'major_id': major_id,
                    'gen_id': gen_id
                },
                success: function(data) {
                    $('#grade-entry').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                        html +=
                            '<tr>' +
                            '<td>' + v.student_id +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"></td>' +
                            '<td>' + v.user.fname_lo + '</td>' +
                            '<td>' + v.major.major + '</td>' +
                            '<td>' + v.gen.gen + '</td>' +
                            '<td><input type="text" class="form-control" name="grade[]"></td>' +
                            '</tr>';
                    });
                    $('#grade-entry-tr').html(html);
                }
            });
        });
    </script> --}}

    <!--   // for get Student Subject  -->
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#gen_id, #major_id', function() {
                var gen_id = $('#gen_id').val();
                var major_id = $('#major_id').val();
                $.ajax({
                    url: "{{ route('grades.getsubjects') }}",
                    type: "GET",
                    data: {
                        gen_id: gen_id,
                        major_id: major_id
                    },
                    success: function(data) {
                        var html = '<option value="">-- ເລືອກ ວິຊາຮຽນ --</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.id + '">' + v.subject
                                .subject + '</option>';
                        });
                        $('#subject_id').html(html);
                    }
                });
            });
        });
    </script>
@endsection
