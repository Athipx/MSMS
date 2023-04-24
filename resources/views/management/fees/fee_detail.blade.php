@extends('layouts.master')

@section('content')
    @php
        $status = ['in_progress' => 'ກຳລັງດຳເນີນການ', 'pass' => 'ຜ່ານ', 'not_pass' => 'ບໍ່ຜ່ານ'];
        $type = ['proposal' => 'ປ້ອງກັນຫົວຂໍ້ (Proposal)', 'thesis' => 'ປ້ອງກັນບົດຈົບ'];
    @endphp

    <title>
        ລາຍລະອຽດການຊຳລະຄ່າທຳນຽມ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ລາຍລະອຽດການຊຳລະຄ່າທຳນຽມ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຄ່າທຳນຽມ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('fees.view') }}">ຊຳລະຄ່າທຳນຽມ</a></li>
                            <li class="breadcrumb-item active">ລາຍລະອຽດການຊຳລະຄ່າທຳນຽມ</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('fee.edit', $data->id) }}"
                                    class="btn btn-light btn-rounded dropdown-toggle" type="button">
                                    <i class="fas fa-edit mr-1"></i> ແກ້ໄຂຂໍ້ມູນ
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
                                <div>
                                    <a href="{{ route('fees.view') }}" class="btn btn-light btn-rounded btn-sm mb-1"><i
                                            class="fas fa-arrow-left"></i>
                                        ກັບຄືນ</a>
                                    <hr>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <ul class="ml-3">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>ລາຍລະອຽດການຊຳລະຄ່າທຳນຽມ
                                        </h5>
                                        <div class="table-responsive mt-4">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ລະຫັດນັກສຶກສາ:</th>
                                                        <td>{{ $data->student->student_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຊື່-ນາມສະກຸນ
                                                            ນັກສຶກສາ:</th>
                                                        <td>{{ $data->student->user->fname_lo }}
                                                            {{ $data->student->user->lname_lo }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ສາຂາວິຊາ</th>
                                                        <td>{{ $data->major->major }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຮຸ່ນການສຶກສາ</th>
                                                        <td>{{ $data->gen->gen }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ລະຫັດການຊຳລະ:</th>
                                                        <td>{{ $data->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ປະເພດຄ່າທຳນຽມ:</th>
                                                        <td>{{ $data->feeType->type }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ສະຖານະການຊຳລະ:</th>
                                                        <td>
                                                            @if ($data->status == 'paid')
                                                                <h4><span class="badge badge-success">ຊຳລະແລ້ວ</span>
                                                                </h4>
                                                            @else
                                                                <h4><span class="badge badge-danger">ຍັງບໍ່ທັນຊຳລະ</span>
                                                                </h4>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ວັນທີຊຳລະ:</th>
                                                        <td>
                                                            {{ $data->due_date !== null ? date('d/m/Y', strtotime($data->due_date)) : '-' }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                ຜູ້ແກ້ໄຂຂໍ້ມູນຫຼ້າສຸດ:<span class="ml-3">{{ $data->editor->fname_lo }}
                                </span><span class="mx-4">|</span>ວັນທີແກ້ໄຂຂໍ້ມູນຫຼ້າສຸດ: <span
                                    class="ml-3">{{ date('d/m/Y h:i', strtotime($data->updated_at)) }}</span>
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
