@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ຖັງຂີ້ເຫຍື້ອ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຜູ້ໃຊ້ງານລະບົບ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.view') }}">ຜູ້ໃຊ້ອື່ນໆ</a></li>
                            <li class="breadcrumb-item active">ຖັງຂີ້ເຫຍື້ອ</li>
                        </ol>
                    </div>
                    {{-- <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('users.add') }}" class="btn btn-light btn-rounded dropdown-toggle"
                                    type="button">
                                    <i class="fas fa-user-plus mr-1"></i> ເພີ່ມຜູ້ໃຊ້
                                </a>
                            </div>
                        </div>
                    </div> --}}
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
                                    <a href="{{ route('teachers.view') }}" class="btn btn-light btn-rounded btn-sm mb-1"><i
                                            class="fas fa-arrow-left"></i> ກັບຄືນ</a>
                                    <hr>
                                </div>
                                <table id="datatable" class="table dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">ຮູບໂປຣໄຟລ</th>
                                            <th>ຊື່-ນາມສະກຸນ ລາວ</th>
                                            <th>ຊື່-ນາມສະກຸນ ອັງກິດ</th>
                                            <th>ປະຈຳສາຂາວິຊາ</th>
                                            <th>ສະຖານະ</th>
                                            <th>ວັນທີລຶບ</th>
                                            <th></th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @foreach ($trash as $key => $row)
                                            <tr>
                                                <td><img class="rounded-circle"
                                                        src="{{ !empty($row->user->profile) ? asset($row->user->profile) : asset('assets/images/profiles/profile.jpg') }}"
                                                        width="60" height="60"></td>
                                                <td>
                                                    {{ $row->user->fname_lo }} <span
                                                        class="ml-1">{{ $row->user->lname_lo }}</span>
                                                </td>
                                                <td>
                                                    {{ $row->user->fname_en }} <span
                                                        class="ml-1">{{ $row->user->lname_en }}</span>
                                                </td>
                                                <td>
                                                    {{ $row->major->major }}
                                                </td>
                                                <td>
                                                    @if ($row->user->status == 'active')
                                                        <h4><span class="badge badge-soft-success">ເປີດໃຊ້ງານ</span></h4>
                                                    @else
                                                        <h4><span class="badge badge-soft-danger">ປິດໃຊ້ງານ</span></h4>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $row->updated_at }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('student.restore', $row->user->id) }}" type="button"
                                                        class="btn btn-outline-primary wave-effect wave-light"
                                                        data-toggle="tooltip" data-placement="top" title="ກູ້ຄືນ">
                                                        <i class="fas fa-undo"></i>
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
