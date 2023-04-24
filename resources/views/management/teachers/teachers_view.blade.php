@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ອາຈານ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຜູ້ໃຊ້ງານລະບົບ</a></li>
                            <li class="breadcrumb-item active">ອາຈານ</li>
                        </ol>
                    </div>
                    <div class="col-md-4 {{ !in_array(Auth::user()->role, ['headUnit', 'admin']) ? 'd-none' : '' }}">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('teachers.add') }}" class="btn btn-light btn-rounded dropdown-toggle"
                                    type="button">
                                    <i class="fas fa-user-plus mr-1"></i> ເພີ່ມອາຈານ
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
                                <div class="{{ Auth::user()->role !== 'admin' ? 'invisible' : 'visible' }}">
                                    <a href="{{ route('teachers.trash') }}" class="btn btn-light btn-rounded btn-sm mb-1">
                                        {{ $countTrash }} ຖັງຂີ້ເຫຍື້ອ</a>
                                    <hr>
                                </div>
                                <table id="datatable" class="table dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">ລຳດັບ</th>
                                            <th style="width: 10%;">ຮູບໂປຣໄຟລ</th>
                                            <th>ຊື່-ນາມສະກຸນ ລາວ</th>
                                            <th>ຊື່-ນາມສະກຸນ ອັງກິດ</th>
                                            <th>ປະຈຳສາຂາວິຊາ</th>
                                            <th>ສະຖານະບັນຊີໃຊ້ງານ</th>
                                            <th></th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td><img class="rounded-circle"
                                                        src="{{ !empty($row->user->profile) ? asset($row->user->profile) : asset('assets/images/profiles/profile.jpg') }}"
                                                        width="70" height="70"></td>
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
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('teacher.detail', $row->id) }}" type="button"
                                                            class="btn btn-outline-secondary btn-sm" data-toggle="tooltip"
                                                            data-placement="top" title="ເບິ່ງລາຍລະອຽດ">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('teacher.edit', $row->id) }}" type="button"
                                                            class="btn btn-outline-secondary btn-sm {{ !in_array(Auth::user()->role, ['headUnit', 'admin']) ? 'd-none' : '' }}"
                                                            data-toggle="tooltip" data-placement="top" title="ແກ້ໄຂຂໍ້ມູນ">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('teacher.remove', $row->user->id) }}"
                                                            type="button"
                                                            class="btn btn-outline-secondary btn-sm {{ $row->user->id == Auth::user()->id ? 'invisible' : '' }} {{ !in_array(Auth::user()->role, ['headUnit', 'admin']) ? 'd-none' : '' }}"
                                                            data-toggle="tooltip" data-placement="top" title="ລຶບ"
                                                            id="remove">
                                                            <i class="mdi mdi-trash-can"></i>
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
