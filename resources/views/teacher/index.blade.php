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
                    <div class="col-xl-6">
                        <a class="card" href="{{ route('students.view') }}">
                            <div class="card-body">
                                <h5 class="header-title mb-4">ນັກສຶກສາທັງໝົດ</h5>
                                <div class="media">
                                    <div class="media-body">
                                        <h4>{{ $students }}</h4>
                                    </div>
                                    <div dir="ltr" class="ml-2">
                                        <i class="fas fa-user-graduate" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-6">
                        <a class="card" href="{{ route('teacher.assigns.view') }}">
                            <div class="card-body">
                                <h5 class="header-title mb-4">ການຮຽນ-ສອນ</h5>
                                <div class="media">
                                    <div class="media-body">
                                        <h4>{{ $count_assign }}</h4>
                                    </div>
                                    <div dir="ltr" class="ml-2">
                                        <i class="fas fa-book" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right ml-2">
                                    <a href="{{ route('teacher.assigns.view') }}">ເບິ່ງເພີ່ມຕື່ມ</a>
                                </div>
                                <h5 class="header-title mb-4">ການຮຽນ-ສອນ</h5>

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
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
@endsection
