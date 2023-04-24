@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ລາຍງານຊຳລະຄ່າທຳນຽມ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ລາຍງານ</a></li>
                            <li class="breadcrumb-item"><a href="#">ລາຍງານຄ່າທຳນຽມ</a></li>
                            <li class="breadcrumb-item active">ລາຍງານຊຳລະຄ່າທຳນຽມ</li>
                        </ol>
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

                                <form method="GET" action="{{ route('fees.report') }}" id="filter-form">
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
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <h5>ລວມທັງໝົດ: {{ $count }}</h5>
                                    </div>
                                    <form action="{{ route('fees.export') }}" method="get">
                                        <input type="hidden" name="major_id" value="{{ request('major_id') }}">
                                        <input type="hidden" name="gen_id" value="{{ request('gen_id') }}">
                                        <input type="hidden" name="feeType" value="{{ request('feeType') }}">
                                        <input type="hidden" name="status" value="{{ request('status') }}">
                                        <button type="submit" class="btn btn-light"><i class="fas fa-file-excel"></i>
                                            Excel</button>
                                    </form>
                                </div>
                                <div id="table-responsive">
                                    <table class="table my-table">
                                        <thead>
                                            <tr>
                                                <th>ລະຫັດນັກສຶກສາ</th>
                                                <th>ຊື່-ນາມສະກຸນ ລາວ</th>
                                                <th>ຮຸ່ນການສຶກສາ</th>
                                                <th>ສາຂາວິຊາ</th>
                                                <th>ປະເພດຄ່າທຳນຽມ</th>
                                                <th>ສະຖານະການຊຳລະ</th>
                                                <th>ວັນທີຊຳລະ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->student_id }}
                                                        <input type="hidden" name="student_id[]"
                                                            value="{{ $item->id }}">
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
                                                    <td>{{ $item->date !== null ? date('d/m/Y', strtotime($item->date)) : '' }}
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
@endsection
