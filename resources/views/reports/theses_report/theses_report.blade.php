@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ບັນດາວິທະຍານິພົນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ວິທະຍານິພົນ</a></li>
                            <li class="breadcrumb-item active">ບັນດາວິທະຍານິພົນ</li>
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
                                <form method="GET" action="{{ route('theses.report') }}" id="filter-form">
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
                                                <label for="">ສະຖານະວິທະຍານິພົນ</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">-- ເລືອກ ສະຖານະວິທະຍານິພົນ --</option>
                                                    <option value="in_progress"
                                                        {{ isset($status) && $status == 'in_progress' ? 'selected' : '' }}>
                                                        ກຳລັງດຳເນີນການ
                                                    </option>
                                                    <option value="pass"
                                                        {{ isset($status) && $status == 'pass' ? 'selected' : '' }}>
                                                        ຜ່ານ
                                                    </option>
                                                    <option value="not_pass"
                                                        {{ isset($status) && $status == 'not_pass' ? 'selected' : '' }}>
                                                        ບໍ່ຜ່ານ
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
                    @if (isset($theses))
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h5>ລວມທັງໝົດ: {{ $count }}</h5>
                                        </div>
                                        <form action="{{ route('theses.export') }}" method="get">
                                            <input type="hidden" name="major_id" value="{{ request('major_id') }}">
                                            <input type="hidden" name="gen_id" value="{{ request('gen_id') }}">
                                            <input type="hidden" name="subject_id" value="{{ request('subject_id') }}">
                                            <button type="submit" class="btn btn-light"><i class="fas fa-file-excel"></i>
                                                Excel</button>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table my-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;">ລຳດັບ</th>
                                                    <th>ຊື່ຫົວບົດວິທະຍານິພົນ</th>
                                                    <th>ນັກສຶກສາ</th>
                                                    <th>ສາຂາວິຊາ</th>
                                                    <th>ຮຸ່ນການສຶກສາ</th>
                                                    <th>ສະຖານະວິທະຍານິພົນ</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @foreach ($theses as $row)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>
                                                            <p class="thesis-title"
                                                                style="font-size: 14px; line-height: 1.1;"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="{{ $row->title_lo }}">
                                                                {{ $row->title_lo }}</p>
                                                            <p class="thesis-title"
                                                                style="font-size: 14px; line-height: 1.1;"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="{{ $row->title_en }}">
                                                                {{ $row->title_en }}</p>
                                                        </td>
                                                        <td>
                                                            {{ $row->full_name }}
                                                        </td>
                                                        <td>
                                                            {{ $row->major }}
                                                        </td>
                                                        <td>
                                                            <div
                                                                style="color:#fff; font-weight:bold; width: 40px; height: 40px; background:#3051d3; border-radius: 50px; display: flex; justify-content: center; align-items: center;">
                                                                {{ $row->gen }}</div>
                                                        </td>
                                                        <td>
                                                            @if ($row->status == 'pass')
                                                                <i class="fas fa-dot-circle mr-1 text-success"></i>ຜ່ານ
                                                            @elseif($row->status == 'not_pass')
                                                                <i class="fas fa-dot-circle mr-1 text-danger"></i>ບໍ່ຜ່ານ
                                                            @else
                                                                <i
                                                                    class="fas fa-dot-circle mr-1 text-warning"></i>ກຳລັງດຳເນີນການ
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
@endsection
