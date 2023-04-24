@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ລາຍງານນັກສຶກສາ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ລາຍງານ</a></li>
                            <li class="breadcrumb-item active">ລາຍງານນັກສຶກສາ</li>
                        </ol>
                    </div>
                    {{-- <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('fees.add') }}" type="button"
                                    class="btn btn-light btn-rounded waves-effect waves-light">
                                    <i class="fas fa-plus mr-1"></i>ເພີ່ມຂໍ້ມູນ
                                </a>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <button class="btn btn-light btn-rounded dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-plus mr-1"></i>ເພີ່ມຂໍ້ມູນ
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                    <a class="dropdown-item" href="{{ route('fees.add') }}">ເພີ່ມຈຳນວນຫຼາຍ</a>
                                    <a class="dropdown-item" href="#">ເພີ່ມເປັນບຸກຄົນ</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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
                                <form method="GET" action="{{ route('students.report') }}" id="filter-form">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ສາຂາວິຊາ</label>
                                                <select name="major_id" id="major_id" class="form-control">
                                                    <option value="">-- ເລືອກ ສາຂາວິຊາ --</option>
                                                    @foreach ($majors as $major)
                                                        <option value="{{ $major->id }}"
                                                            {{ isset($major_id) && $major_id == $major->id ? 'selected' : '' }}>
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
                                                        <option value="{{ $item->id }}"
                                                            {{ isset($gen_id) && $gen_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->gen }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>ສະຖານະພາບການສຶກສາ</label>
                                                <div>
                                                    <select id="student_status" name="student_status" class="form-control">
                                                        <option value="">-- ເລືອກ ສະຖານະພາບການສຶກສາ --</option>
                                                        <option value="pending"
                                                            {{ isset($student_status) && $student_status == 'pending' ? 'selected' : '' }}>
                                                            ລໍຖ້າອະນຸມັດ
                                                        </option>
                                                        <option value="studying"
                                                            {{ isset($student_status) && $student_status == 'studying' ? 'selected' : '' }}>
                                                            ກຳລັງສຶກສາ
                                                        </option>
                                                        <option value="graduated"
                                                            {{ isset($student_status) && $student_status == 'graduated' ? 'selected' : '' }}>
                                                            ສຳເລັດການສຶກສາ
                                                        </option>
                                                        <option value="drop"
                                                            {{ isset($student_status) && $student_status == 'drop' ? 'selected' : '' }}>
                                                            ຢຸດຕິຊົ່ວຄາວ
                                                        </option>
                                                        <option value="quit"
                                                            {{ isset($student_status) && $student_status == 'quit' ? 'selected' : '' }}>
                                                            ໂຈະການສຶກສາ</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
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
                    @if (isset($students))
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="filter-result">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div>
                                                <h5>ລວມທັງໝົດ: {{ $count }}</h5>
                                            </div>
                                            <form action="{{ route('students.export') }}" method="get">
                                                <input type="hidden" name="major_id" value="{{ request('major_id') }}">
                                                <input type="hidden" name="gen_id" value="{{ request('gen_id') }}">
                                                <input type="hidden" name="student_status"
                                                    value="{{ request('student_status') }}">
                                                <button type="submit" class="btn btn-light"><i
                                                        class="fas fa-file-excel"></i> Excel</button>
                                            </form>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>ລຳດັບ</th>
                                                        <th>ລະຫັດບັນຊີຜູ້ໃຊ້</th>
                                                        <th>ລະຫັດນັກສຶກສາ</th>
                                                        <th>ຊື່-ນາມສະກຸນ</th>
                                                        <th>ສາຂາວິຊາ</th>
                                                        <th>ຮຸ່ນການສຶກສາ</th>
                                                        <th>ສະຖານະພາບການສຶກສາ</th>
                                                        <th>ວັນທີສ້າງ</th>
                                                        <th>ວັນທີແກ້ໄຂຫຼ້າສຸດ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 1;
                                                        $status = ['pending' => 'ລໍຖ້າອະນຸມັດ', 'studying' => 'ກຳລັງສຶກສາ', 'graduated' => 'ສຳເລັດການສຶກສາ', 'drop' => 'ຢຸດຕິຊົ່ວຄາວ', 'quit' => 'ໂຈະການສຶກສາ'];
                                                    @endphp
                                                    @foreach ($students as $row)
                                                        <tr>
                                                            <th scope="row">{{ $i++ }}</th>
                                                            <td>{{ $row->id }}</td>
                                                            <td>{{ $row->student_id }}</td>
                                                            <td>{{ $row->fname_lo }} {{ $row->lname_lo }}</td>
                                                            <td>{{ $row->major }}</td>
                                                            <td>{{ $row->gen }}</td>
                                                            <td>{{ $status[$row->status] }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($row->created_at)) }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($row->updated_at)) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    @endif
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
    {{-- <script type="text/javascript">
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
    </script> --}}
@endsection
