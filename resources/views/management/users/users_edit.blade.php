@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ແກ້ໄຂຂໍ້ມູນຜູ້ໃຊ້</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຜູ້ໃຊ້ງານລະບົບ</a></li>
                            <li class="breadcrumb-item active">ແກ້ໄຂຂໍ້ມູນຜູ້ໃຊ້</li>
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
                                <div>
                                    <a href="{{ route('users.detail', $editData->id) }}"
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
                                                class="d-none d-md-inline-block">ແກ້ໄຂຂໍ້ມູນທົ່ວໄປ</span>
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
                                        <form method="post" action="{{ route('users.update', $editData->id) }}"
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
                                                                    <input value="{{ $editData->lname_en }}" name="lname_en"
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
                                                            <div class="form-group">
                                                                <label>ສິດທິ</label>
                                                                <div>
                                                                    <select id="role" name="role"
                                                                        class="form-control">
                                                                        <option value="admin"
                                                                            {{ $editData->role == 'admin' ? 'selected' : '' }}>
                                                                            ຜູ້ຄຸ້ມຄອງລະບົບ</option>
                                                                        <option value="coordinator"
                                                                            {{ $editData->role == 'coordinator' ? 'selected' : '' }}>
                                                                            ຜູ້ປະສານງານ</option>
                                                                        <option value="headUnit"
                                                                            {{ $editData->role == 'headUnit' ? 'selected' : '' }}>
                                                                            ຫົວໜ້າໜ່ວຍວິຊາ</option>
                                                                        <option value="headDept"
                                                                            {{ $editData->role == 'headDept' ? 'selected' : '' }}>
                                                                            ຫົວໜ້າພາກວິຊາ</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>ສະຖານະ</label>
                                                                <span
                                                                    class="badge badge-success {{ $editData->status == 'active' ? 'badge-success' : 'badge-danger' }}">{{ $editData->status == 'active' ? 'ເປີດໃຊ້ງານ' : 'ປິດໃຊ້ງານ' }}</span>
                                                                <div>
                                                                    <select id="status" name="status"
                                                                        class="form-control">
                                                                        <option value="active"
                                                                            {{ $editData->status == 'active' ? 'selected' : '' }}>
                                                                            ເປີດໃຊ້ງານ</option>
                                                                        <option value="inactive"
                                                                            {{ $editData->status == 'inactive' ? 'selected' : '' }}>
                                                                            ປິດໃຊ້ງານ</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="form-group">
                                                                <label>ຮູບໂປຣໄຟລ</label>
                                                                <div>
                                                                    <div class="custom-file">
                                                                        <input name="profile" type="file" class="custom-file-input"
                                                                            id="validationCustomFile" required="">
                                                                        <label class="custom-file-label"
                                                                            for="validationCustomFile">ເລືອກຮູບ...</label>
                                                                        <div class="invalid-feedback">
                                                                            Example invalid custom file feedback
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
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
                                        <form action="{{ route('teacher.resetPwd', $editData->id) }}" method="post">
                                            @csrf
                                            <label for="">ລະຫັດຜ່ານໃໝ່</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="myInput" name="password">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <input class="mt-3" type="checkbox" onclick="myFunction()">
                                            ສະແດງລະຫັດຜ່ານ
                                            <button class="d-block btn btn-primary btn-lg mt-3" type="submit"><i
                                                    class="fas fa-save mr-2"></i>ບັນທຶກ</button>
                                        </form>
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
            // togglePassword.addEventListener('click', () => {
            //     const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            //     password.setAttribute('type', type);
            //     togglePassword.classList.toggle('fa-eye-slash');
            // });
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye-slash');
        }

        function showPass2() {
            const togglePassword = document.querySelector('#toggleNewPassword');
            const password = document.querySelector('#new_password');
            // togglePassword.addEventListener('click', () => {
            //     const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            //     password.setAttribute('type', type);
            //     togglePassword.classList.toggle('fa-eye-slash');
            // });
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye-slash');
        }

        function showPass3() {
            const togglePassword = document.querySelector('#toggleConfirmPassword');
            const password = document.querySelector('#confirm_password');
            // togglePassword.addEventListener('click', () => {
            //     const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            //     password.setAttribute('type', type);
            //     togglePassword.classList.toggle('fa-eye-slash');
            // });
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye-slash');
        }
    </script>
@endsection
