<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>ເຂົ້າສູ່ລະບົບ MSMS</title>
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
                <div class="col-xl-5 col-sm-8">
                    <div class="card" style="border-radius: 20px; box-shadow: 0px 0px 100px #ffffff33;">
                        <div class="card-body p-4">

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="p-2">
                                <h5 class="mb-5 text-center text-primary">ເຂົ້າໃຊ້ງານລະບົບ MSMS | CEIT</h5>

                                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label for="login">ຊື່ຜູ້ໃຊ້ (Username) ຫຼື ອີເມວ</label>
                                        <input type="text" id="login"
                                            class="form-control @error('login') is-invalid @enderror" name="login"
                                            value="{{ old('login') }}" autocomplete="login" required
                                            placeholder="ປ້ອນຊື່ຜູ້ໃຊ້ ຫຼື ອີເມວ...">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="userpassword">ລະຫັດຜ່ານ</label>
                                        <input id="password" type="password"
                                            class="form-control form-control-prepended @error('password') is-invalid @enderror"
                                            name="password" autocomplete="current-password"
                                            placeholder="ປ້ອນລະຫັດຜ່ານ...">
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember">ຈື່ຂ້ອຍໄວ້</label>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="text-md-right">
                                                <a href="auth-recoverpw.html" class="text-muted"><i
                                                        class="mdi mdi-lock"></i> ລືມລະຫັດຜ່ານ?</a>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-primary btn-lg btn-block waves-effect waves-light"
                                            type="submit"
                                            style="background: #3051d3 !important; border: none; border-radius: 10px;">ເຂົ້າສູ່ລະບົບ</button>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <a href="{{ route('stdRegister') }}" class="text-muted"><i
                                                class="mdi mdi-account-circle mr-1"></i> ສ້າງບັນຊີຜູ້ໃຊ້</a>
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
