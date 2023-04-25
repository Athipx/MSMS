@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ລາຍລະອຽດການຮຽນ-ການສອນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ການສຶກສາ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('assigns.view') }}">ການຮຽນ-ການສອນ</a></li>
                            <li class="breadcrumb-item active">ລາຍລະອຽດການຮຽນ-ການສອນ</li>
                        </ol>
                    </div>
                    <div class="col-md-4 {{ !in_array(Auth::user()->role, ['admin', 'headUnit']) ? 'd-none' : '' }}">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('assign.edit', $data->id) }}"
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div>
                                            <a href="{{ route('assigns.view') }}"
                                                class="btn btn-light btn-rounded btn-sm mb-1"><i
                                                    class="fas fa-arrow-left"></i>
                                                ກັບຄືນ</a>
                                            <hr>
                                        </div>
                                        <h5>ລາຍລະອຽດການຮຽນ-ການສອນ</h5>
                                        <div class="table-responsive mt-4">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ອາຈານສອນ:</th>
                                                        <td>
                                                            @foreach ($teachers as $teacher)
                                                                <li style="line-height:200%;">{{ $teacher->fname_lo }} <span
                                                                        class="ml-2">{{ $teacher->lname_lo }}</span></li>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ວິຊາ:</th>
                                                        <td>{{ $data->subject->subject }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ສາຂາວິຊາ:</th>
                                                        <td>{{ $data->major->major }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຮຸ່ນການສຶກສາ:</th>
                                                        <td>{{ $data->gen->gen }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ພາກ / ເທີມການສຶກສາ:</th>
                                                        <td>{{ $data->semister->semister }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຫ້ອງຮຽນ:</th>
                                                        <td>{{ $data->classroom->classroom }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຈຳນວນຊົ່ວໂມງສອນ:</th>
                                                        <td>{{ $data->hours }}</td>
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
