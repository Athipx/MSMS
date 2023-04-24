@extends('layouts.master')

@section('content')
    <title>ການຮຽນ-ສອນ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ການຮຽນ-ສອນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ການສຶກສາ</a></li>
                            <li class="breadcrumb-item active">ການຮຽນ-ສອນ</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('teacher.assigns.view') }}" id="filter-form">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">ສາຂາວິຊາ</label>
                                                <select name="major_id" id="major_id" class="form-control">
                                                    <option value="">-- ເລືອກ ສາຂາວິຊາ --</option>
                                                    @foreach ($major as $major)
                                                        <option value="{{ $major->id }}"
                                                            {{ isset($major_id) && $major_id == $major->id ? 'selected' : '' }}>
                                                            {{ $major->major }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">ຮຸ່ນການສຶກສາ</label>
                                                <select name="gen_id" id="gen_id" class="form-control">
                                                    <option value="">-- ເລືອກ ຮຸ່ນການສຶກສາ --</option>
                                                    @foreach ($gen as $item)
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
                                <table id="datatable" class="table dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">ລະຫັດ</th>
                                            <th>ວິຊາຮຽນ</th>
                                            <th>ຮຸ່ນການສຶກສາ</th>
                                            <th>ສາຂາວິຊາ</th>
                                            <th>ພາກ / ເທີມການສຶກສາ</th>
                                            <th>ຫ້ອງຮຽນ</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assigns as $row)
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->subject }}</td>
                                                <td>
                                                    <div
                                                        style="color:#fff; font-weight:bold; width: 50px; height: 50px; background:#3051d3; border-radius: 50px; display: flex; justify-content: center; align-items: center;">
                                                        {{ $row->gen }}
                                                    </div>
                                                </td>
                                                <td>{{ $row->major }}</td>
                                                <td>{{ $row->semister }}</td>
                                                <td>{{ $row->classroom }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('teacher.assign.detail', $row->id) }}"
                                                            type="button"
                                                            class="btn btn-outline-secondary btn-sm waves-effect waves-light"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="ເບິ່ງລາຍລະອຽດ">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
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
