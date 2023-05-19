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
                    <div class="col-xl-4">
                        <a class="card" href="{{ route('students.view') }}">
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
                        </a>
                    </div>
                    <div class="col-xl-4">
                        <a class="card" href="{{ route('teachers.view') }}">
                            <div class="card-body">
                                <h5 class="header-title mb-4">ອາຈານ</h5>
                                <div class="media">
                                    <div class="media-body">
                                        <h4>{{ count($allTeachers) }}</h4>
                                    </div>
                                    <div dir="ltr" class="ml-2">
                                        <i class="fas fa-chalkboard-teacher" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4">
                        <a class="card" href="{{ route('theses.view') }}">
                            <div class="card-body">
                                <h5 class="header-title mb-4">ວິທະຍານິພົນທັງໝົດ</h5>
                                <div class="media">
                                    <div class="media-body">
                                        <h4>{{ count($allTheses) }}</h4>
                                    </div>
                                    <div dir="ltr" class="ml-2">
                                        <i class="fas fa-book" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right ml-2">
                                    <a href="{{ route('grades.view') }}">ເບິ່ງເພີ່ມຕື່ມ</a>
                                </div>
                                <h5 class="header-title mb-4">ການເຄື່ອນໄຫວຄະແນນການສຶກສາຫຼ້າສຸດ</h5>

                                <div id="table-responsive">
                                    <table id="datatable" class="table dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ລະຫັດນັກສຶກສາ</th>
                                                <th>ຊື່-ນາມສະກຸນ ລາວ</th>
                                                <th>ຮຸ່ນການສຶກສາ</th>
                                                <th>ສາຂາວິຊາ</th>
                                                <th>ວິຊາ</th>
                                                <th>ເກຣດ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($grades as $key => $row)
                                                <tr>
                                                    <td>{{ $row->student_id }}</td>
                                                    <td>{{ $row->fname }} {{ $row->lname }}</td>
                                                    <td>{{ $row->gen }}</td>
                                                    <td>{{ $row->major }}</td>
                                                    <td>{{ $row->subject }}</td>
                                                    <td>{{ $row->grade }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('grade.detail', $row->id) }}" type="button"
                                                                class="btn btn-outline-secondary btn-sm"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="ເບິ່ງລາຍລະອຽດ">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>
                                                            <a href="{{ route('grade.edit', $row->id) }}" type="button"
                                                                class="btn btn-outline-secondary btn-sm {{ !in_array(Auth::user()->role, ['teacher', 'admin', 'headUnit']) ? 'd-none' : '' }}"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="ແກ້ໄຂຂໍ້ມູນ">
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
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
@endsection
