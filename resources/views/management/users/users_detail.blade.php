@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ລາຍລະອຽດຜູ້ໃຊ້</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຜູ້ໃຊ້ງານລະບົບ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.view') }}">ຜູ້ໃຊ້ອື່ນໆ</a></li>
                            <li class="breadcrumb-item active">ລາຍລະອຽດນັກສຶກສາ</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('users.edit', $UserData->id) }}"
                                    class="btn btn-light btn-rounded dropdown-toggle" type="button">
                                    <i class="fas fa-edit mr-1"></i> ແກ້ໄຂຂໍ້ມູນຜູ້ໃຊ້
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
                                    <a href="{{ route('users.view') }}" class="btn btn-light btn-rounded btn-sm mb-1"><i
                                            class="fas fa-arrow-left"></i>
                                        ກັບຄືນ</a>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 d-flex justify-content-center mb-5">
                                        <img class="rounded-circle"
                                            src="{{ !empty($UserData->profile) ? asset($UserData->profile) : asset('assets/images/profiles/profile.jpg') }}"
                                            width="200" height="200">
                                    </div>
                                    <div class="col-md-8">
                                        <h5>ລາຍລະອຽດຜູ້ໃຊ້</h5>
                                        <div class="table-responsive mt-4">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຊື່-ນາມສະກຸນ ພາສາລາວ:</th>
                                                        <td>{{ $UserData->fname_lo }} {{ $UserData->lname_lo }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຊື່-ນາມສະກຸນ ພາສາອັງກິດ:</th>
                                                        <td>{{ $UserData->fname_en }} {{ $UserData->lname_en }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ອີເມວ:</th>
                                                        <td>{{ $UserData->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ເບີໂທລະສັບ:</th>
                                                        <td>{{ $UserData->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ສິດທິ</th>
                                                        <td>
                                                            @if ($UserData->role == 'coordinator')
                                                                ຜູ້ປະສານງານ
                                                            @elseif($UserData->role == 'headUnit')
                                                                ຫົວໜ້າໜ່ວຍວິຊາ
                                                            @elseif($UserData->role == 'headDept')
                                                                ຫົວໜ້າພາກວິຊາ
                                                            @else
                                                                ຜູ້ຄຸ້ມຄອງລະບົບ
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ສະຖານະບັນຊີໃຊ້ງານ</th>
                                                        <td>
                                                            @if ($UserData->status == 'active')
                                                                <h4><span class="badge badge-soft-success">ເປີດໃຊ້ງານ</span>
                                                                </h4>
                                                            @else
                                                                <h4><span class="badge badge-soft-danger">ປິດໃຊ້ງານ</span>
                                                                </h4>
                                                            @endif
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
                </div> <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
@endsection
