@extends('layouts.master')

@section('content')
    <title>Import ນັກສຶກສາ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">Import ນັກສຶກສາ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຜູ້ໃຊ້ງານລະບົບ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('students.view') }}">ນັກສຶກສາ</a></li>
                            <li class="breadcrumb-item active">Import ນັກສຶກສາ</li>
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
                                <a href="{{ route('students.view') }}" class="btn btn-light btn-rounded btn-sm mb-1">
                                    <i class="fas fa-arrow-left mr-2"></i>ກັບຄືນ
                                </a>
                                <hr>
                                <p><span class="text-danger">*</span> ໃນການ Import(ນຳເຂົ້າ) ຂໍ້ມູນນັກສຶກສາ
                                    ຮອງຮັບສະເພາະໄຟລນາມສະກຸນ <b>xlsx,csv,xls</b> ເທົ່ານັ້ນ.</p>
                                <form action="{{ route('students.import') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" required class="form-control mb-3">
                                    <button type="submit" class="btn btn-lg btn-primary"><i
                                            class="fas fa-file-import mr-2"></i>
                                        ນຳເຂົ້າ</button>
                                </form>
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
