@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ຜູ້ໃຊ້ອື່ນໆ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຜູ້ໃຊ້ງານລະບົບ</a></li>
                            <li class="breadcrumb-item active">ຜູ້ໃຊ້ອື່ນໆ</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('users.add') }}" class="btn btn-light btn-rounded dropdown-toggle"
                                    type="button">
                                    <i class="fas fa-user-plus mr-1"></i> ເພີ່ມຜູ້ໃຊ້
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
                                    <a href="{{ route('users.trash') }}"
                                        class="btn btn-light btn-rounded btn-sm mb-1">{{ count($usersTrash) }}
                                        ຖັງຂີ້ເຫຍື້ອ</a>
                                    <hr>
                                </div>
                                <table id="datatable" class="table dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">ລະຫັດຜູ້ໃຊ້</th>
                                            <th style="width: 10%;">ຮູບໂປຣໄຟລ</th>
                                            <th>ຊື່-ນາມສະກຸນ ລາວ</th>
                                            <th>ຊື່-ນາມສະກຸນ ອັງກິດ</th>
                                            <th>ສິດທິ</th>
                                            <th>ສະຖານະ</th>
                                            <th></th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                <td><img class="rounded-circle"
                                                        src="{{ !empty($row->profile) ? asset($row->profile) : asset('assets/images/profiles/profile.jpg') }}"
                                                        width="70" height="70"></td>
                                                <td>
                                                    {{ $row->fname_lo }} <span class="ml-1">{{ $row->lname_lo }}</span>
                                                </td>
                                                <td>
                                                    {{ $row->fname_en }} <span class="ml-1">{{ $row->lname_en }}</span>
                                                </td>
                                                <td>
                                                    @if ($row->role == 'coordinator')
                                                        ຜູ້ປະສານງານ
                                                    @elseif($row->role == 'headUnit')
                                                        ຫົວໜ້າໜ່ວຍວິຊາ
                                                    @elseif($row->role == 'headDept')
                                                        ຫົວໜ້າພາກວິຊາ
                                                    @else
                                                        ຜູ້ຄຸ້ມຄອງລະບົບ
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($row->status == 'active')
                                                        <h4><span class="badge badge-soft-success">ເປີດໃຊ້ງານ</span></h4>
                                                    @else
                                                        <h4><span class="badge badge-soft-danger">ປິດໃຊ້ງານ</span></h4>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('users.detail', $row->id) }}" type="button"
                                                            class="btn btn-outline-secondary btn-sm" data-toggle="tooltip"
                                                            data-placement="top" title="ເບິ່ງລາຍລະອຽດ">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('users.edit', $row->id) }}" type="button"
                                                            class="btn btn-outline-secondary btn-sm" data-toggle="tooltip"
                                                            data-placement="top" title="ແກ້ໄຂຂໍ້ມູນ">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('users.remove', $row->id) }}" type="button"
                                                            class="btn btn-outline-secondary btn-sm {{ $row->id == Auth::user()->id ? 'invisible' : '' }}"
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
