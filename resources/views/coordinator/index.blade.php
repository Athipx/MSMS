@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ພາບລວມລະບົບ MSMS</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Master Student Management System</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title mb-4">ນັກສຶກສາທັງໝົດ</h5>
                                <div class="media">
                                    <div class="media-body">
                                        <h4>{{ count($allStudents) }}</h4>
                                    </div>
                                    <div dir="ltr" class="ml-2">
                                        <i class="fas fa-user-graduate" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title mb-4">ບໍ່ທັນຊຳລະຄ່າທຳນຽມ</h5>
                                <div class="media">
                                    <div class="media-body">
                                        <h4>{{ count($allUnpaidFees) }}</h4>
                                    </div>
                                    <div dir="ltr" class="ml-2">
                                        <i class="fas fa-exclamation-circle" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title mb-4">ບໍ່ທັນຊຳລະຄ່າຮຽນ</h5>
                                <div class="media">
                                    <div class="media-body">
                                        <h4>{{ count($allUnpaidTutitions) }}</h4>
                                    </div>
                                    <div dir="ltr" class="ml-2">
                                        <i class="fas fa-exclamation-circle" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title mb-4">ຜ່ອນຊຳລະຄ່າຮຽນ</h5>
                                <div class="media">
                                    <div class="media-body">
                                        <h4>{{ count($allInstallments) }}</h4>
                                    </div>
                                    <div dir="ltr" class="ml-2">
                                        <i class="fas fa-money-bill" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right ml-2">
                                    <a href="{{ route('fees.view') }}">ເບິ່ງເພີ່ມຕື່ມ</a>
                                </div>
                                <h5 class="header-title mb-4">ການເຄື່ອນໄຫວຄ່າທຳນຽມຫຼ້າສຸດ</h5>

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
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
@endsection
