@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ເພີ່ມນັກອາຈານ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຜູ້ໃຊ້ງານລະບົບ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('teachers.view') }}">ອາຈານ</a></li>
                            <li class="breadcrumb-item active">ເພີ່ມນັກອາຈານ</li>
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
                                    <a href="{{ route('teachers.view') }}" class="btn btn-light btn-rounded btn-sm mb-1"><i
                                            class="fas fa-arrow-left"></i>
                                        ກັບຄືນ</a>
                                    <hr>
                                </div>
                                <form method="post" action="{{ route('teachers.store') }}" class="needs-validation"
                                    novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="row">
                                                <div class="col-md-3"
                                                    style="display:flex; flex-direction: row; justify-content: center;">
                                                    <div class="rounded-circle" id="image_preview"></div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fname_lo">ຊື່ແທ້ ພາສາລາວ<span
                                                                        class="text-danger">*</span></label>
                                                                <div>
                                                                    <input name="fname_lo"
                                                                        class="form-control @error('fname_lo') is-invalid @enderror"
                                                                        type="text" id="fname_lo"
                                                                        placeholder="ປ້ອນຊື່ແທ້..."
                                                                        value="{{ old('fname_lo') }}">
                                                                    @error('fname_lo')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="lname_lo">ນາມສະກຸນ ພາສາລາວ<span
                                                                        class="text-danger">*</span></label>
                                                                <div>
                                                                    <input name="lname_lo"
                                                                        class="form-control @error('lname_lo') is-invalid @enderror"
                                                                        type="text" id="lname_lo"
                                                                        placeholder="ປ້ອນຊື່ແທ້..."
                                                                        value="{{ old('lname_lo') }}">
                                                                    @error('lname_lo')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fname_en">ຊື່ແທ້ ພາສາອັງກິດ<span
                                                                        class="text-danger">*</span></label>
                                                                <div>
                                                                    <input name="fname_en"
                                                                        class="form-control @error('fname_en') is-invalid @enderror"
                                                                        type="text" id="fname_en"
                                                                        placeholder="ປ້ອນຊື່ແທ້..."
                                                                        value="{{ old('fname_en') }}">
                                                                    @error('fname_en')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="lname_en">ນາມສະກຸນ ພາສາອັງກິດ<span
                                                                        class="text-danger">*</span></label>
                                                                <div>
                                                                    <input name="lname_en"
                                                                        class="form-control @error('lname_en') is-invalid @enderror"
                                                                        type="text" id="lname_en"
                                                                        placeholder="ປ້ອນຊື່ແທ້..."
                                                                        value="{{ old('lname_en') }}">
                                                                    @error('lname_en')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="username">ຊື່ຜູ້ໃຊ້ (Username)<span
                                                                        class="text-danger">*</span></label>
                                                                <div>
                                                                    <input id="username" name="username"
                                                                        class="form-control @error('username') is-invalid @enderror"
                                                                        type="text" placeholder="ປ້ອນຊື່ຜູ້ໃຊ້..."
                                                                        value="{{ old('username') }}">
                                                                    @error('username')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>ຮູບໂປຣໄຟລ</label>
                                                                <div>
                                                                    <div>
                                                                        <input name="profile"
                                                                            class="form-control @error('profile') is-invalid @enderror"
                                                                            type="file" id="profile_image">
                                                                        @error('profile')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>ປະຈຳສາຂາວິຊາ</label>
                                                                <div>
                                                                    <select id="major" name="major"
                                                                        class="form-control">
                                                                        @foreach ($major as $key)
                                                                            <option value="{{ $key->id }}">
                                                                                {{ $key->major }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fname_en">ຕຳແໜ່ງ<span
                                                                        class="text-danger">*</span></label>
                                                                <div>
                                                                    <input name="position"
                                                                        class="form-control @error('position') is-invalid @enderror"
                                                                        type="text" id="position"
                                                                        placeholder="ປ້ອນຕຳແໜ່ງ..."
                                                                        value="{{ old('position') }}">
                                                                    @error('position')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>ສະຖານະ</label>
                                                                <div>
                                                                    <select id="status" name="status"
                                                                        class="form-control">
                                                                        <option value="active">ເປີດໃຊ້ງານ</option>
                                                                        <option value="inactive">ປິດໃຊ້ງານ</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fname_en">ເບີໂທລະສັບ</label>
                                                                <div>
                                                                    <input name="phone"
                                                                        class="form-control @error('phone') is-invalid @enderror"
                                                                        type="number" id="phone"
                                                                        placeholder="ປ້ອນເບີໂທລະສັບ..."
                                                                        value="{{ old('phone') }}">
                                                                    @error('position')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">ອີເມວ<span
                                                                        class="text-danger">*</span></label>
                                                                <div>
                                                                    <input id="email" name="email"
                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                        type="email" placeholder="ປ້ອນອີເມວ..."
                                                                        value="{{ old('email') }}">
                                                                    @error('email')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password">ລະຫັດຜ່ານ<span
                                                                        class="text-danger">*</span></label>
                                                                <div style="position: relative;">
                                                                    <input name="password"
                                                                        class="form-control  @error('email') is-invalid @enderror"
                                                                        type="password" placeholder="ປ້ອນລະຫັດຜ່ານ..."
                                                                        id="password">
                                                                    <i class="fas fa-eye" id="togglePassword"
                                                                        style="position:absolute; right:3%; top:35%; cursor: pointer;"></i>
                                                                    @error('password')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">ຄວາມຊ່ຽວຊານ</label>
                                                                <textarea class="form-control" name="expert" id="" rows="5"></textarea>
                                                            </div>
                                                            <input type="hidden" name="role" value="teacher">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-lg" type="submit" style="float: right;"><i
                                            class="fas fa-save mr-2"></i> ບັນທຶກ</button>
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

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', () => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
