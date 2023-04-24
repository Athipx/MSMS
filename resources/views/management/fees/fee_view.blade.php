@extends('layouts.master')

@section('content')
    <title>ຊຳລະຄ່າທຳນຽມ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ຊຳລະຄ່າທຳນຽມ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຄ່າທຳນຽມ</a></li>
                            <li class="breadcrumb-item active">ຊຳລະຄ່າທຳນຽມ</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('fees.add') }}" type="button"
                                    class="btn btn-light btn-rounded waves-effect waves-light">
                                    <i class="fas fa-plus mr-1"></i>ເພີ່ມຂໍ້ມູນ
                                </a>
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

                                <form method="GET" action="{{ route('fees.view') }}" id="filter-form">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ປະເພດຄ່າທຳນຽມ</label>
                                                <select name="feeType" id="feeType" class="form-control">
                                                    <option value="">-- ເລືອກ ປະເພດຄ່າທຳນຽມ --</option>
                                                    @foreach ($feeTypes as $feeType)
                                                        <option value="{{ $feeType->id }}"
                                                            {{ isset($feeType_id) && $feeType_id == $feeType->id ? 'selected' : '' }}>
                                                            {{ $feeType->type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
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
                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">ສະຖານະການຊຳລະ</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="">-- ເລືອກ ສະຖານ --</option>
                                                    <option value="paid"
                                                        {{ isset($status) && $status == 'paid' ? 'selected' : '' }}>
                                                        ຊຳລະແລ້ວ</option>
                                                    <option value="unpaid"
                                                        {{ isset($status) && $status == 'unpaid' ? 'selected' : '' }}>
                                                        ຍັງບໍ່ໄດ້ຊຳລະ</option>
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
                                <table id="datatable" class="table dt-responsive nowrap my-table"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ລະຫັດນັກສຶກສາ</th>
                                            <th>ຊື່-ນາມສະກຸນ</th>
                                            <th>ຮຸ່ນການສຶກສາ</th>
                                            <th>ສາຂາວິຊາ</th>
                                            <th>ປະເພດຄ່າທຳນຽມ</th>
                                            <th>ສະຖານະການຊຳລະ</th>
                                            <th>ວັນທີຊຳລະ</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->student_id }}
                                                    <input type="hidden" name="student_id[]" value="{{ $item->id }}">
                                                </td>
                                                <td>{{ $item->fname }} {{ $item->lname }}</td>
                                                <td>{{ $item->gen }}</td>
                                                <td>{{ $item->major }}</td>
                                                <td>{{ $item->type }}</td>
                                                <td>
                                                    @if ($item->status == 'paid')
                                                        <h4><span class="badge badge-success">ຊຳລະແລ້ວ</span>
                                                        </h4>
                                                    @else
                                                        <h4><span class="badge badge-danger">ຍັງບໍ່ທັນຊຳລະ</span>
                                                        </h4>
                                                    @endif
                                                </td>
                                                <td>{{ $item->date !== null ? date('d/m/Y', strtotime($item->date)) : '-' }}
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('fee.detail', $item->stdfeeId) }}" type="button"
                                                            class="btn btn-outline-secondary btn-sm" data-toggle="tooltip"
                                                            data-placement="top" title="ເບິ່ງລາຍລະອຽດ">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('fee.edit', $item->stdfeeId) }}" type="button"
                                                            class="btn btn-outline-secondary btn-sm" data-toggle="tooltip"
                                                            data-placement="top" title="ແກ້ໄຂຂໍ້ມູນ">
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
