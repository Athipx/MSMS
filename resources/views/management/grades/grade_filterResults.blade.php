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
                    <div
                        class="col-md-4 {{ !in_array(Auth::user()->role, ['teacher', 'admin', 'headUnit']) ? 'd-none' : '' }}">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('grades.add') }}" class="btn btn-light btn-rounded" type="button">
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
                                                    @foreach ($gens as $item)
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

                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="filter-result">
                                    <table id="datatable" class="table dt-responsive nowrap"
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
                                                                class="btn btn-outline-secondary btn-sm {{ !in_array(Auth::user()->role, ['teacher', 'admin', 'headUnit']) ? 'd-none' : '' }}"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="ແກ້ໄຂຂໍ້ມູນ">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
