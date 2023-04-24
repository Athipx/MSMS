@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ລາຍງານການຮຽນ-ສອນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ລາຍງານ</a></li>
                            <li class="breadcrumb-item"><a href="#">ລາຍງານການສຶກສາ</a></li>
                            <li class="breadcrumb-item active">ລາຍງານການຮຽນ-ສອນ</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        {{-- <!-- Modal Add classroom Form -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">ເພີ່ມການຮຽນ-ການສອນ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> --}}

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <form method="GET" action="{{ route('assigns.report') }}" id="filter-form">
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
                                                <label for="">ພາກການສຶກສາ</label>
                                                <select name="semister_id" id="semister_id" class="form-control">
                                                    <option value="">-- ເລືອກ ພາກການສຶກສາ --</option>
                                                    @foreach ($semisters as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ isset($semister_id) && $semister_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->semister }}
                                                        </option>
                                                    @endforeach
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

                    @if (isset($data))
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <h5>ລວມທັງໝົດ: {{ $count }}</h5>
                                        </div>
                                        <form action="{{ route('teacher.assigns.export') }}" method="get">
                                            <input type="hidden" name="major_id" value="{{ request('major_id') }}">
                                            <input type="hidden" name="gen_id" value="{{ request('gen_id') }}">
                                            <input type="hidden" name="semister_id" value="{{ request('semister_id') }}">
                                            <button type="submit" class="btn btn-light"><i class="fas fa-file-excel"></i>
                                                Excel</button>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table mb-0 my-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%;">ລະຫັດ</th>
                                                    <th>ວິຊາຮຽນ</th>
                                                    <th>ຮຸ່ນການສຶກສາ</th>
                                                    <th>ສາຂາວິຊາ</th>
                                                    <th>ພາກ / ເທີມການສຶກສາ</th>
                                                    <th>ຫ້ອງຮຽນ</th>
                                                    <th>ອາຈານສອນ</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $row)
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
                                                            @foreach ($row->teachers as $teacher)
                                                                {{ $teacher->fname_lo }} {{ $teacher->lname_lo }} </br>
                                                            @endforeach
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
