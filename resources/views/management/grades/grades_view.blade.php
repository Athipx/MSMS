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
                    <div class="col-md-4 {{ !in_array(Auth::user()->role, ['teacher', 'admin']) ? 'd-none' : '' }}">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('grades.add') }}" class="btn btn-light btn-rounded dropdown-toggle"
                                    type="button">
                                    <i class="fas fa-plus mr-1"></i>ເພີ່ມຂໍ້ມູນ
                                </a>
                                {{-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated" style="">
                                    <a class="dropdown-item" href="{{ route('grades.add') }}">ເພີ່ມທັງໝົດ</a>
                                    <a class="dropdown-item" href="#">ເພີ່ມລາຍບຸກຄົນ</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        {{-- <!-- Modal Add Gen Form -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">ເພີ່ມຄະແນນວິຊາ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('grade.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="student">Student:</label>
                                <select id="student" name="student_id" class="form-control">
                                    <option value="">--ເລືອກ ນັກສຶກສາ--</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->user->fname_lo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="assign">Assign:</label>
                                <select id="assign" name="assign_id" class="form-control">
                                    <option value="">--ເລືອກ ການຮຽນ-ການສອນ--</option>
                                    @foreach ($assigns as $assign)
                                        <option value="{{ $assign->id }}">{{ $assign->subject->subject }} -
                                            {{ $assign->teacher->user->fname_lo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="grade">Grade:</label>
                                <input id="grade" type="text" name="grade" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">ຍົກເລີກ</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">ບັນທຶກ</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> --}}

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <form method="GET" action="{{ route('grades.filterResults') }}" id="filter-form">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">ສາຂາວິຊາ</label>
                                                <select name="major_id" id="major_id" class="form-control">
                                                    <option value="">-- ເລືອກ ສາຂາວິຊາ --</option>
                                                    @foreach ($majors as $major)
                                                        <option value="{{ $major->id }}">
                                                            {{ $major->major }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ຮຸ່ນການສຶກສາ</label>
                                                <select name="gen_id" id="gen_id" class="form-control">
                                                    <option value="">-- ເລືອກ ຮຸ່ນການສຶກສາ --</option>
                                                    @foreach ($gen as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->gen }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ວິຊາຮຽນ</label>
                                                <select class="form-control" name="subject_id" id="subject_id">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="" class="text-white">btn</label>
                                                <button type="submit" class="btn btn-primary w-100"><i
                                                        class="fas fa-search mr-2"></i> ຄົ້ນຫາ</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                {{-- <form action="{{ route('grades.view') }}" method="get">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="major_id">ສາຂາວິຊາ</label>
                                                <select class="form-control" name="major_id" id="major_id">
                                                    <option value="">-- ເລືອກ ສາຂາວິຊາ --</option>
                                                    @foreach ($majors as $major)
                                                        <option value="{{ $major->id }}"
                                                            {{ old('major_id') == $major->id ? 'selected' : '' }}>
                                                            {{ $major->major }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ວິຊາຮຽນ</label>
                                                <select class="form-control" name="subject_id" id="subject_id">
                                                    <option value="">-- ເລືອກ ວິຊາຮຽນ --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary btn-rounded w-100"
                                                style="margin-top: 30px;"><i class="fas fa-search mr-2"></i>ຄົ້ນຫາ</button>
                                        </div>
                                    </div>
                                </form> --}}

                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                {{-- <div class="{{ Auth::user()->role !== 'admin' ? 'invisible' : 'visible' }}">
                                    <a href="{{ route('teachers.trash') }}" class="btn btn-light btn-rounded btn-sm mb-1">
                                        ຖັງຂີ້ເຫຍື້ອ</a>
                                    <hr>
                                </div> --}}
                                <div id="filter-result">
                                    {{-- <table id="datatable" class="table dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ລະຫັດນັກສຶກສາ</th>
                                                <th>ຊື່-ນາມສະກຸນ ລາວ</th>
                                                <th>ຮຸ່ນການສຶກສາ</th>
                                                <th>ສາຂາວິຊາ</th>
                                                <th>ວິຊາ</th>
                                                <th>ເກຣດ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($grades as $key => $row)
                                                <tr>
                                                    <td>{{ $row->student_id }}</td>
                                                    <td>{{ $row->fname }} {{ $row->lname }}</td>
                                                    <td>{{ $row->gen }}</td>
                                                    <td>{{ $row->major }}</td>
                                                    <td>{{ $row->subject }}</td>
                                                    <td>{{ $row->grade }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('grade.detail', $row->id) }}" type="button"
                                                                class="btn btn-outline-secondary btn-sm"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="ເບິ່ງລາຍລະອຽດ">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>
                                                            <a href="{{ route('grade.edit', $row->id) }}" type="button"
                                                                class="btn btn-outline-secondary btn-sm"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="ແກ້ໄຂຂໍ້ມູນ">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table> --}}
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>


    {{-- <script>
        $('#filter-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $('#filter-form').serialize();
            // console.log(formData);
            $.ajax({
                url: "{{ route('grades.filterResult') }}",
                type: 'GET',
                data: formData,
                success: function(response) {
                    var html = response.filterResults;
                    $('#filter-result').html(response);
                    // console.log(response);
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
