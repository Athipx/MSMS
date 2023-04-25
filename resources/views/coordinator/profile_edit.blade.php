@extends('layouts.master')

@section('content')
    <title>ແກ້ໄຂຂໍ້ມູນສ່ວນຕົວ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ແກ້ໄຂຂໍ້ມູນສ່ວນຕົວ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">ໜ້າຫຼັກ</a></li>
                            <li class="breadcrumb-item active">ແກ້ໄຂຂໍ້ມູນສ່ວນຕົວ</li>
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
                                <div>
                                    <a href="{{ route('coordinator.profile') }}"
                                        class="btn btn-light btn-rounded btn-sm mb-1"><i class="fas fa-arrow-left"></i>
                                        ກັບຄືນ</a>
                                    <hr>
                                </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-justified nav-tabs-custom" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#custom-home" role="tab"
                                            aria-selected="true" style="font-size: 20px !important;">
                                            <i class="fas fa-user mr-1 align-middle"></i> <span
                                                class="d-none d-md-inline-block">ແກ້ໄຂຂໍ້ມູນ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#custom-profile" role="tab"
                                            aria-selected="false" style="font-size: 20px !important;">
                                            <i class="fas fa-unlock-alt align-middle"></i></i> <span
                                                class="d-none d-md-inline-block">ປ່ຽນລະຫັດຜ່ານ</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content p-3">
                                    {{-- Tab Content 1 --}}
                                    <div class="tab-pane active" id="custom-home" role="tabpanel">
                                        <form method="post" action="{{ route('coordinator.profileUpdate') }}"
                                            class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fname_lo">ຊື່ແທ້ ພາສາລາວ</label>
                                                                <div>
                                                                    <input value="{{ $editData->fname_lo }}" name="fname_lo"
                                                                        class="form-control @error('fname_lo') is-invalid @enderror"
                                                                        type="text" id="fname_lo"
                                                                        placeholder="ປ້ອນຊື່ແທ້...">
                                                                    @error('fname_lo')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="lname_lo">ນາມສະກຸນ ພາສາລາວ</label>
                                                                <div>
                                                                    <input value="{{ $editData->lname_lo }}" name="lname_lo"
                                                                        class="form-control @error('lname_lo') is-invalid @enderror"
                                                                        type="text" id="lname_lo"
                                                                        placeholder="ປ້ອນຊື່ແທ້...">
                                                                    @error('lname_lo')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fname_en">ຊື່ແທ້ ພາສາອັງກິດ</label>
                                                                <div>
                                                                    <input value="{{ $editData->fname_en }}" name="fname_en"
                                                                        class="form-control @error('fname_en') is-invalid @enderror"
                                                                        type="text" id="fname_en"
                                                                        placeholder="ປ້ອນຊື່ແທ້...">
                                                                    @error('fname_en')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="lname_en">ນາມສະກຸນ ພາສາອັງກິດ</label>
                                                                <div>
                                                                    <input value="{{ $editData->lname_en }}"
                                                                        name="lname_en"
                                                                        class="form-control @error('lname_en') is-invalid @enderror"
                                                                        type="text" id="lname_en"
                                                                        placeholder="ປ້ອນຊື່ແທ້...">
                                                                    @error('lname_en')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="username">ຊື່ຜູ້ໃຊ້ (Username)</label>
                                                                <div>
                                                                    <input value="{{ $editData->username }}" id="username"
                                                                        name="username"
                                                                        class="form-control @error('username') is-invalid @enderror"
                                                                        type="text" placeholder="ປ້ອນຊື່ຜູ້ໃຊ້...">
                                                                    @error('username')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="role"
                                                                value="{{ $editData->role }}">
                                                            <input type="hidden" name="status"
                                                                value="{{ $editData->status }}">
                                                            <div class="form-group">
                                                                <label for="email">ອີເມວ</label>
                                                                <div>
                                                                    <input value="{{ $editData->email }}" id="email"
                                                                        name="email"
                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                        type="email" placeholder="ປ້ອນອີເມວ...">
                                                                    @error('email')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>ຮູບໂປຣໄຟລ</label>
                                                                <div>
                                                                    <input name="profile"
                                                                        class="form-control @error('profile') is-invalid @enderror"
                                                                        type="file" id="image"
                                                                        value="{{ $editData->profile }}">
                                                                    @error('profile')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mt-3">
                                                                    <input type="hidden" name="old_profile"
                                                                        value="{{ $editData->profile }}">
                                                                    <img id="showImage" class="rounded-circle"
                                                                        src="{{ !empty($editData->profile) ? url($editData->profile) : url('assets/images/profiles/profile.jpg') }}"
                                                                        data-holder-rendered="true"
                                                                        style="object-fit: cover;" width="200"
                                                                        height="200">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-lg" type="submit"
                                                style="float: right;"><i class="fas fa-save mr-2"></i> ບັນທຶກ</button>
                                        </form>
                                    </div>

                                    {{-- Tab Content 2 --}}
                                    <div class="tab-pane" id="custom-profile" role="tabpanel">
                                        {{-- ------------------------------ ຣີເຊັດລະຫັດຜ່ານ ------------------------------ --}}
                                        <div class="row pt-3">
                                            <div class="col-12">
                                                <h4 class="mb-3">ປ່ຽນລະຫັດຜ່ານ</h4>
                                                <form action="{{ route('coordinator.updatePwd') }}" method="post">
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
                                                            <button class="btn btn-primary btn-lg float-right"
                                                                type="submit"><i
                                                                    class="fas fa-save mr-2"></i>ບັນທຶກ</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
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
    <script>
        function showPass1() {
            const togglePassword = document.querySelector('#toggleOldPassword');
            const password = document.querySelector('#old_password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye-slash');
        }

        function showPass2() {
            const togglePassword = document.querySelector('#toggleNewPassword');
            const password = document.querySelector('#new_password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye-slash');
        }

        function showPass3() {
            const togglePassword = document.querySelector('#toggleConfirmPassword');
            const password = document.querySelector('#confirm_password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye-slash');
        }
    </script>
@endsection
