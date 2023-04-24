@extends('layouts.master')

@section('content')
    @php
        $major = ['ວິສະວະກຳຊັອບແວ' => 'SW', 'ລະບົບເຄືອຂ່າຍຄອມພິວເຕີ' => 'NW'];
        $gender = ['male' => 'ທ.', 'female' => 'ນ.'];
    @endphp


    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ນັກສຶກສາ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຜູ້ໃຊ້ງານລະບົບ</a></li>
                            <li class="breadcrumb-item active">ນັກສຶກສາ</li>
                        </ol>
                    </div>
                    <div
                        class="col-md-4 {{ in_array(Auth::user()->role, ['teacher', 'headUnit', 'headDept']) ? 'd-none' : '' }}">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('students.add') }}" class="btn btn-light btn-rounded dropdown-toggle"
                                    type="button">
                                    <i class="fas fa-user-plus mr-1"></i> ເພີ່ມນັກສຶກສາ
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
                                    <a href="{{ route('students.trash') }}" class="btn btn-light btn-rounded btn-sm mb-1">
                                        {{ $trash }} ຖັງຂີ້ເຫຍື້ອ</a>
                                    <hr>
                                </div>
                                <table id="datatable" class="table dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">ລະຫັດນັກສຶກສາ</th>
                                            <th style="width: 10%;">ຮູບໂປຣໄຟລ</th>
                                            <th>ຊື່-ນາມສະກຸນ ລາວ</th>
                                            <th>ຊື່-ນາມສະກຸນ ອັງກິດ</th>
                                            <th>ສາຂາວິຊາ</th>
                                            <th>ຮຸ່ນການສຶກສາ</th>
                                            <th>ສະຖານະພາບການສຶກສາ</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studentData as $key => $row)
                                            <tr>
                                                <td>{{ $row->student_id }}</td>
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
                                                    {{ $row->gen->gen }}
                                                </td>
                                                <td>
                                                    @if ($row->status == 'studying')
                                                        <i class="fas fa-dot-circle mr-1 text-primary"></i>ກຳລັງສຶກສາ
                                                    @elseif($row->status == 'graduated')
                                                        <i class="fas fa-dot-circle mr-1 text-success"></i>ສຳເລັດການສຶກສາ
                                                    @elseif($row->status == 'drop')
                                                        <i class="fas fa-dot-circle mr-1 text-warning"></i>ຢຸດຕິຊົ່ວຄາວ
                                                    @elseif($row->status == 'pending')
                                                        <i class="fas fa-dot-circle mr-1 text-secondary"></i>ລໍຖ້າອະນຸມັດ
                                                    @else
                                                        <i class="fas fa-dot-circle mr-1 text-danger"></i>ໂຈະການສຶກສາ
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('student.detail', $row->id) }}" type="button"
                                                            class="btn btn-outline-secondary btn-sm" data-toggle="tooltip"
                                                            data-placement="top" title="ເບິ່ງລາຍລະອຽດ">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('student.edit', $row->id) }}" type="button"
                                                            class="btn btn-outline-secondary btn-sm {{ in_array(Auth::user()->role, ['teacher', 'headUnit', 'headDept']) ? 'd-none' : '' }}"
                                                            data-toggle="tooltip" data-placement="top" title="ແກ້ໄຂຂໍ້ມູນ">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('student.remove', $row->user->id) }}"
                                                            type="button"
                                                            class="btn btn-outline-secondary btn-sm {{ in_array(Auth::user()->role, ['teacher', 'headUnit', 'headDept']) ? 'd-none' : '' }}"
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


                {{-- <div class="row row-cards mt-2">
                    @foreach ($studentData as $key => $row)
                        <div class="col-md-6 col-xl-3">
                            <div class="card user-card" style="border-radius: 10px;">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <img class="rounded-circle"
                                            src="{{ !empty($row->user->profile) ? asset($row->user->profile) : asset('assets/images/profiles/profile.jpg') }}"
                                            width="70" height="70">
                                    </div>
                                    <div class="card-title mb-1">
                                        <p>{{$row->user->student->student_id}}</p>
                                        <h6 style="line-height: 2em; font-size: 18px;">{{ $gender[$row->user->student->gender] }} {{ $row->user->fname_lo }} <span class="ml-1">{{ $row->user->lname_lo }}</span></h6>
                                    </div>
                                    <div>
                                        <p style="font-size: 14px;">{{ $major[$row->major->major] }} <span class="mx-2">|</span> G{{ $row->gen->gen }} <span class="mx-2">|</span>
                                        @if ($row->status == 'studying')
                                            <i class="fas fa-dot-circle mr-1 text-primary"></i>ກຳລັງສຶກສາ
                                        @elseif($row->status == 'graduated')
                                            <i class="fas fa-dot-circle mr-1 text-success"></i>ສຳເລັດການສຶກສາ
                                        @elseif($row->status == 'drop')
                                            <i class="fas fa-dot-circle mr-1 text-warning"></i>ຢຸດຕິຊົ່ວຄາວ
                                        @else
                                            <i class="fas fa-dot-circle mr-1 text-danger"></i>ໂຈະການສຶກສາ
                                        @endif</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('student.detail', $row->id) }}" class="card-btn d-inline-block"
                                        data-toggle="tooltip" data-placement="top" title="ເບິ່ງລາຍລະອຽດ">
                                        <i class="mdi mdi-eye mdi-18px"></i>
                                    </a>
                                    <a href="{{ route('student.edit', $row->id) }}" class="card-btn d-inline-block"
                                        data-toggle="tooltip" data-placement="top" title="ແກ້ໄຂຂໍ້ມູນ">
                                        <i class="mdi mdi-pencil mdi-18px"></i>
                                    </a>
                                    <a href="{{ route('student.remove', $row->user->id) }}" class="card-btn d-inline-block"
                                        data-toggle="tooltip" data-placement="top" title="ລຶບ" id="remove">
                                        <i class="mdi mdi-trash-can mdi-18px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> --}}

            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
@endsection
