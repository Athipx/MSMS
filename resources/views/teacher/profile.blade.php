@extends('layouts.master')

@section('content')
    <title>ຂໍ້ມູນສ່ວນຕົວ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ຂໍ້ມູນສ່ວນຕົວ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">ອາຈານ</a></li>
                            <li class="breadcrumb-item active">ຂໍ້ມູນສ່ວນຕົວ</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('teacher.profileEdit') }}"
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
                                    <a href="{{ route('teacher.dashboard') }}"
                                        class="btn btn-light btn-rounded btn-sm mb-1"><i class="fas fa-arrow-left"></i>
                                        ກັບຄືນ</a>
                                    <hr>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-4 d-flex justify-content-center mb-5">
                                        <img class="rounded-circle"
                                            src="{{ !empty($data->user->profile) ? asset($data->user->profile) : asset('assets/images/profiles/profile.jpg') }}"
                                            width="200" height="200">
                                    </div>
                                    <div class="col-md-8">
                                        <h5>ລາຍລະອຽດຜູ້ໃຊ້</h5>
                                        <div class="table-responsive mt-4">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຊື່-ນາມສະກຸນ ພາສາລາວ:</th>
                                                        <td>{{ $data->user->fname_lo }} {{ $data->user->lname_lo }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຊື່-ນາມສະກຸນ ພາສາອັງກິດ:</th>
                                                        <td>{{ $data->user->fname_en }} {{ $data->user->lname_en }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຊື່ຜູ້ໃຊ້ (Username):</th>
                                                        <td>{{ $data->user->username }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ປະຈຳສາຂາວິຊາ:</th>
                                                        <td>{{ $data->major->major }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຕຳແໜ່ງ:</th>
                                                        <td>{{ $data->position }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຄວາມຊ່ຽວຊານ:</th>
                                                        <td>
                                                            <pre>{{ $data->expert }}</pre>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ອີເມວ:</th>
                                                        <td>{{ $data->user->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ເບີໂທລະສັບ:</th>
                                                        <td>{{ $data->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ສິດທິ</th>
                                                        <td>
                                                            {{ $data->user->role == 'teacher' ? 'ອາຈານ' : $data->user->role }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ສະຖານະບັນຊີໃຊ້ງານ</th>
                                                        <td>
                                                            @if ($data->user->status == 'active')
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
