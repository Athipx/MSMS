@extends('layouts.master')

@section('content')
    <title>ລາຍງານຊຳລະຄ່າຮຽນ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ລາຍງານຊຳລະຄ່າຮຽນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ລາຍງານຄ່າທຳນຽມ</a></li>
                            <li class="breadcrumb-item active">ລາຍງານຊຳລະຄ່າຮຽນ</li>
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
                                <form method="GET" action="{{ route('tutitions.report') }}" id="filter-form">
                                    <div class="row">
                                        <div class="col-md-4">
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
                                                <label for="">ສະຖານະການຊຳລະ</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">-- ເລືອກ ສະຖານະການຊຳລະ --</option>
                                                    <option value="paid"
                                                        {{ isset($status) && $status == 'paid' ? 'selected' : '' }}>
                                                        ຊຳລະແລ້ວ
                                                    </option>
                                                    <option value="unpaid"
                                                        {{ isset($status) && $status == 'unpaid' ? 'selected' : '' }}>
                                                        ຍັງບໍ່ທັນຊຳລະ
                                                    </option>
                                                    <option value="installment"
                                                        {{ isset($status) && $status == 'installment' ? 'selected' : '' }}>
                                                        ຜ່ອນຊຳລະ
                                                    </option>
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
                                    <form action="{{ route('tutitions.export') }}" method="get">
                                        <input type="hidden" name="major_id" value="{{ request('major_id') }}">
                                        <input type="hidden" name="gen_id" value="{{ request('gen_id') }}">
                                        <input type="hidden" name="feeType" value="{{ request('feeType') }}">
                                        <input type="hidden" name="status" value="{{ request('status') }}">
                                        <button type="submit" class="btn btn-light"><i class="fas fa-file-excel"></i>
                                            Excel</button>
                                    </form>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ລະຫັດຊຳລະ</th>
                                            <th>ລະຫັດນັກສຶກສາ</th>
                                            <th>ຊື່-ນາມສະກຸນນັກສຶກສາ</th>
                                            <th>ສາຂາວິຊາ</th>
                                            <th>ຮຸ່ນການສຶກສາ</th>
                                            <th>ສະຖານະການຊຳລະ</th>
                                            <th>ວັນທີຊຳລະ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $row)
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->student_id }}</td>
                                                <td>{{ $row->full_name }}</td>
                                                <td>{{ $row->major }}</td>
                                                <td>{{ $row->gen }}</td>
                                                <td>
                                                    @if ($row->status == 'paid')
                                                        <i class="fas fa-dot-circle mr-1 text-success"></i>ຊຳລະແລ້ວ
                                                    @elseif($row->status == 'unpaid')
                                                        <i class="fas fa-dot-circle mr-1 text-danger"></i>ຍັງບໍ່ທັນຊຳລະ
                                                    @else
                                                        <i class="fas fa-dot-circle mr-1 text-warning"></i>ຜ່ອນຊຳລະ
                                                    @endif
                                                </td>
                                                <td>{{ $row->due_date !== null ? date('d/m/Y', strtotime($row->due_date)) : '-' }}
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
@endsection
