@extends('student.master')

@section('content')
    <!-- Page-Title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">ປ່ຽນລະຫັດຜ່ານ</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">ຍິນດີຕ້ອນຮັບສູ່ລະບົບ MSMS, ພາກວິຊາ ວິສະວະກຳຄອມພິມເຕີ ແລະ
                            ເຕັກໂນໂລຊີຂໍ້ມູນຂ່າວສານ.</li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-light btn-rounded dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-settings-outline mr-1"></i> ແກ້ໄຂຂໍ້ມູນ
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                <a class="dropdown-item" href="{{ route('studentProfile.edit') }}">ແກ້ໄຂຂໍ້ມູນສ່ວນຕົວ</a>
                                <a class="dropdown-item" href="{{ route('student.changePwd') }}">ປ່ຽນລະຫັດຜ່ານ</a>
                            </div>
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
                    <div class="card p-3">
                        <div class="card-body">
                            <div>
                                <a href="{{ route('student.dashboard') }}" class="btn btn-light btn-rounded btn-sm mb-1"><i
                                        class="fas fa-arrow-left"></i>
                                    ກັບຄືນ</a>
                                <hr>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h4 class="mb-3">ປ່ຽນລະຫັດຜ່ານ</h4>

                            <form action="{{ route('student.updatePwd') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">ລະຫັດຜ່ານເກົ່າ</label>
                                            <input name="old_pwd" type="password"
                                                class="form-control @error('old_pwd') is-invalid @enderror"
                                                placeholder="ປ້ອນລະຫັດຜ່ານເກົ່າ...">
                                            @error('old_pwd')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">ລະຫັດຜ່ານໃໝ່</label>
                                            <input name="new_pwd" type="password"
                                                class="form-control @error('new_pwd') is-invalid @enderror"
                                                placeholder="ປ້ອນລະຫັດຜ່ານໃໝ່...">
                                            @error('new_pwd')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">ຢືນຢັນລະຫັດຜ່ານໃໝ່</label>
                                            <input name="confirm_pwd" type="password"
                                                class="form-control @error('confirm_pwd') is-invalid @enderror"
                                                placeholder="ປ້ອນຢືນຢັນລະຫັດຜ່ານໃໝ່...">
                                            @error('confirm_pwd')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-lg float-right" type="submit"><i
                                                class="fas fa-save mr-2"></i>ບັນທຶກ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- end page-content-wrapper -->
@endsection
