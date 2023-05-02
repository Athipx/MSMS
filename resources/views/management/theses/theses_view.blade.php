@extends('layouts.master')

@section('content')
    <title>ບັນດາວິທະຍານິພົນ</title>

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
                    <div class="col-md-4 {{ !in_array(Auth::user()->role, ['headUnit', 'admin']) ? 'd-none' : '' }}">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('thesis.add') }}" class="btn btn-light btn-rounded dropdown-toggle"
                                    type="button">
                                    <i class="fas fa-plus mr-1"></i> ເພີ່ມຂໍ້ມູນ
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
                                <table id="example" class="table dt-responsive nowrap my-table"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">ລະຫັດ</th>
                                            <th>ຊື່ຫົວບົດວິທະຍານິພົນ</th>
                                            <th>ນັກສຶກສາ</th>
                                            <th>ສາຂາວິຊາ</th>
                                            <th>ຮຸ່ນການສຶກສາ</th>
                                            <th>ສະຖານະວິທະຍານິພົນ</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display: table-header-group;">
                                        <tr>
                                            <th>ລະຫັດ</th>
                                            <th>ຊື່ຫົວບົດວິທະຍານິພົນ</th>
                                            <th>ນັກສຶກສາ</th>
                                            <th>ສາຂາວິຊາ</th>
                                            <th>ຮຸ່ນການສຶກສາ</th>
                                            <th>ສະຖານະວິທະຍານິພົນ</th>
                                            <th class="d-none"></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php $i = 1 @endphp
                                        @foreach ($theses as $row)
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>
                                                    <p class="thesis-title" style="font-size: 14px; line-height: 1.1;"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="{{ $row->title_lo }}">
                                                        {{ $row->title_lo }}</p>
                                                    <p class="thesis-title" style="font-size: 14px; line-height: 1.1;"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="{{ $row->title_en }}">
                                                        {{ $row->title_en }}</p>
                                                </td>
                                                <td>
                                                    {{ $row->student->user->fname_lo }} &nbsp;
                                                    {{ $row->student->user->lname_lo }}
                                                </td>
                                                <td>
                                                    {{ $row->major->major }}
                                                </td>
                                                <td>
                                                    <div
                                                        style="color:#fff; font-weight:bold; width: 40px; height: 40px; background:#3051d3; border-radius: 50px; display: flex; justify-content: center; align-items: center;">
                                                        {{ $row->gen->gen }}</div>
                                                </td>
                                                <td>
                                                    @if ($row->status == 'pass')
                                                        <i class="fas fa-dot-circle mr-1 text-success"></i>ຜ່ານ
                                                    @elseif($row->status == 'not_pass')
                                                        <i class="fas fa-dot-circle mr-1 text-danger"></i>ບໍ່ຜ່ານ
                                                    @else
                                                        <i class="fas fa-dot-circle mr-1 text-warning"></i>ກຳລັງດຳເນີນການ
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('thesis.detail', $row->id) }}" type="button"
                                                            class="btn btn-outline-secondary btn-sm" data-toggle="tooltip"
                                                            data-placement="top" title="ເບິ່ງລາຍລະອຽດ">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('thesis.edit', $row->id) }}" type="button"
                                                            class="btn btn-outline-secondary btn-sm {{ !in_array(Auth::user()->role, ['headUnit', 'admin']) ? 'd-none' : '' }}"
                                                            data-toggle="tooltip" data-placement="top" title="ແກ້ໄຂຂໍ້ມູນ">
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
@endsection
