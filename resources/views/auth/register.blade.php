<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>ລົງທະບຽນນັກສຶກສາເຂົ້າໃຊ້ງານລະບົບ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('theme/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('theme/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('theme/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/my-style.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="my-background">
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="index.html" class="logo"><img src="{{ asset('assets/images/FEN-Logo.png') }}"
                                height="100" alt="logo"></a><br><br>
                        <h5 class="font-size-16 text-white">ພາກວິຊາ ວິສະວະກຳຄອມພິວເຕີ ແລະ
                            ເຕັກໂນໂລຊີຂໍ້ມູນຂ່າວສານ, ຄວສ</h5>
                    </div>
                </div>
            </div>
            <!-- end row -->

            @if (session()->has('error'))
                <div class="row justify-content-center mb-3">
                    <div class="col-xl-5 col-sm-8">
                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ session()->get('error') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-xl-12 col-sm-8">
                    <div class="card" style="border-radius: 20px; box-shadow: 0px 0px 100px #ffffff33;">
                        <div class="card-body p-4">
                            <div class="p-2">
                                <h5 class="mb-5 text-center text-primary">ລົງທະບຽນນັກສຶກສາເຂົ້າໃຊ້ງານລະບົບ MSMS | CEIT
                                </h5>

                                <form class="form-horizontal" method="POST" action="{{ route('register.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="fname_lo" class="col-form-label text-md-end">ຊື່ແທ້
                                                (ພາສາລາວ)<span class="text-danger">*</span></label>
                                            <input id="name" type="text"
                                                class="form-control @error('fname_lo') is-invalid @enderror"
                                                name="fname_lo" value="{{ old('fname_lo') }}" required
                                                autocomplete="fname_lo" autofocus placeholder="ປ້ອນຊື່ ພາສາລາວ...">
                                            @error('fname_lo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lname_lo" class="col-form-label text-md-end">ນາມສະກຸນ
                                                (ພາສາລາວ)<span class="text-danger">*</span></label>
                                            <input id="lname_lo" type="text"
                                                class="form-control @error('lname_lo') is-invalid @enderror"
                                                name="lname_lo" value="{{ old('lname_lo') }}" required
                                                autocomplete="lname_lo" autofocus placeholder="ປ້ອນນາມສະກຸນ ພາສາລາວ...">
                                            @error('lname_lo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="fname_en" class="col-form-label text-md-end">ຊື່ແທ້
                                                (ພາສາອັງກິດ)<span class="text-danger">*</span></label>
                                            <input id="fname_en" type="text"
                                                class="form-control @error('fname_en') is-invalid @enderror"
                                                name="fname_en" value="{{ old('fname_en') }}" required
                                                autocomplete="fname_en" autofocus placeholder="ປ້ອນຊື່ ພາສາອັງກິດ...">
                                            @error('fname_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lname_en" class="col-form-label text-md-end">ນາມສະກຸນ
                                                (ພາສາອັງກິດ)<span class="text-danger">*</span></label>
                                            <input id="lname_en" type="text"
                                                class="form-control @error('lname_en') is-invalid @enderror"
                                                name="lname_en" value="{{ old('lname_en') }}" required
                                                autocomplete="lname_en" autofocus
                                                placeholder="ປ້ອນນາມສະກຸນ ພາສາອັງກິດ...">
                                            @error('lname_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="username" class="col-form-label text-md-end">ຊື່ຜູ້ໃຊ້
                                                (Username)<span class="text-danger">*</span></label>
                                            <input id="username" type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                name="username" value="{{ old('username') }}" required
                                                autocomplete="username" placeholder="ປ້ອນຊື່ຜູ້ໃຊ້...">
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label text-md-end">ເພດ<span
                                                    class="text-danger">*</span></label>
                                            <div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input value="male" type="radio" id="male"
                                                        name="gender" class="custom-control-input">
                                                    <label class="custom-control-label" for="male">ຊາຍ</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input value="female" type="radio" id="female"
                                                        name="gender"class="custom-control-input">
                                                    <label class="custom-control-label" for="female">ຍິງ</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label text-md-end">ສາຂາວິຊາ<span
                                                    class="text-danger">*</span></label>
                                            <div>
                                                <select id="major" name="major_id" class="form-control">
                                                    @foreach ($major as $key)
                                                        <option value="{{ $key->id }}"
                                                            @if (old('major') == $key->id) selected @endif>
                                                            {{ $key->major }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-form-label text-md-end">ຮຸ່ນການສຶກສາ<span
                                                    class="text-danger">*</span></label>
                                            <div>
                                                <select id="gen" name="gen_id" class="form-control">
                                                    @foreach ($gen as $key)
                                                        <option value="{{ $key->id }}">
                                                            {{ $key->gen }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="email" class="col-form-label text-md-end">ອີເມວ<span
                                                    class="text-danger">*</span></label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required
                                                autocomplete="email" placeholder="ປ້ອນອີເມວ...">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="password" class="col-form-label text-md-end">ລະຫັດຜ່ານ<span
                                                    class="text-danger">*</span></label>
                                            <input id="password" type="password"
                                                class="form-control form-control-prepended @error('password') is-invalid @enderror"
                                                name="password" autocomplete="new-password"
                                                placeholder="ປ້ອນລະຫັດຜ່ານ..." required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="password-confirm"
                                                class="col-form-label text-md-end">ຢືນຢັນລະຫັດຜ່ານ<span
                                                    class="text-danger">*</span></label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="ປ້ອນຢືນຢັນລະຫັດຜ່ານ...">
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-primary btn-lg btn-block waves-effect waves-light"
                                            type="submit"
                                            style="background: #3051d3 !important; border: none; border-radius: 10px;">ລົງທະບຽນ</button>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <a href="{{ route('login') }}" class="text-muted"><i
                                                class="mdi mdi-account-circle mr-1"></i> ມີບັນຊີຜູ້ໃຊ້ແລ້ວ?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end Account pages -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('theme/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/node-waves/waves.min.js') }}"></script>

    {{-- <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script> --}}

    <script src="{{ asset('theme/assets/js/app.js') }}"></script>

</body>

</html>
