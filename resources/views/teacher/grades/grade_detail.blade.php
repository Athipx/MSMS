@extends('layouts.master')

@section('content')
    @php
        $gender = ['male' => 'ທ້າວ', 'female' => 'ນາງ'];
    @endphp

    <title>ລາຍລະອຽດຄະແນນນັກສຶກສາ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ລາຍລະອຽດຄະແນນນັກສຶກສາ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ການສຶກສາ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('teacher.grades.view') }}">ຄະແນນການສຶກສາ</a></li>
                            <li class="breadcrumb-item active">ລາຍລະອຽດຄະແນນນັກສຶກສາ</li>
                        </ol>
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
                                <div class="row d-flex justify-content-between px-2">
                                    <a href="{{ route('teacher.grades.view') }}" class="btn rounded"><i
                                            class="fas fa-arrow-left mr-2"></i>ກັບຄືນ</a>
                                    <a href="{{ route('teacher.grade.edit', $data->id) }}" type="button"
                                        class="btn btn-light btn-rounded waves-effect waves-light">
                                        <i class="fas fa-edit mr-2"></i>ແກ້ໄຂຂໍ້ມູນ
                                    </a>
                                </div>
                                <hr>
                                <div class="row pt-3">
                                    <div class="col-md-4 mb-5 text-center">
                                        <h4 class="mb-3">ວິຊາ {{ $data->assign->subject->subject }}</h4>
                                        <h5 class="mb-3 text-secondary">ເກຣດຄະແນນວິຊາ</h5>
                                        <h1 class="text-primary" style="font-size: 80px;">{{ $data->grade }}</h1>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody style="font-size: 16px;">
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ລະຫັດນັກສຶກສາ:</th>
                                                        <td>{{ $data->student->student_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຊື່-ນາມສະກຸນ ນັກສຶກສາ:</th>
                                                        <td><span
                                                                class="mr-2">{{ $gender[$data->student->gender] }}</span>
                                                            {{ $data->student->user->fname_lo }}
                                                            {{ $data->student->user->lname_lo }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ສາຂາວິຊາ:</th>
                                                        <td>{{ $data->assign->major->major }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຮຸ່ນການສຶກສາ:</th>
                                                        <td>{{ $data->assign->gen->gen }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ພາກ /ເທີມການສຶກສາ:</th>
                                                        <td>{{ $data->assign->semister->semister }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ວິຊາ:</th>
                                                        <td>{{ $data->assign->subject->subject }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ອາຈານສອນ:</th>
                                                        {{-- <td>{{ $data->assign->teacher->user->fname_lo }}
                                                            {{ $data->assign->teacher->user->lname_lo }}</td> --}}
                                                        <td>
                                                            @foreach ($teachers as $teacher)
                                                                <li style="line-height:200%;">{{ $teacher->fname_lo }}
                                                                    <span class="ml-2">{{ $teacher->lname_lo }}</span>
                                                                </li>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ວັນທີປ້ອນເກຣດ:</th>
                                                        <td>{{ $data->created_at }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ເກຣດປັດຈຸບັນ:</th>
                                                        <td>{{ $data->grade }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ເກຣດເກົ່າ:</th>
                                                        <td>{{ $data->old_grade }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ວັນທີອັບເກຣດ:</th>
                                                        <td>{{ $data->upgrade_date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ລາຍລະອຽດ:</th>
                                                        <td>{{ $data->description }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-4 px-2">
                                    <p>ຜູ້ແກ້ໄຂຂໍ້ມູນຫຼ້າສຸດ:<span class="ml-3">{{ $modified_by }}</span><span
                                            class="mx-4">|</span>ວັນທີແກ້ໄຂຂໍ້ມູນຫຼ້າສຸດ: <span
                                            class="ml-3">{{ $data->updated_at }}</span></p>
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
