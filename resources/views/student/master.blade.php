<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>ລະບົບ MSMS | CEIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- datepicker -->
    <link href="{{ asset('theme/assets/libs/air-datepicker/css/datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- jvectormap -->
    <link href="{{ asset('theme/assets/libs/jqvmap/jqvmap.min.css') }}" rel="stylesheet" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('theme/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('theme/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('theme/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/my-style.css') }}" rel="stylesheet" type="text/css" />

</head>

<body data-topbar="colored" data-layout="horizontal" data-layout-size="boxed">

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('student.body.header')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">

                @yield('content')

            </div>
            <!-- End Page-content -->


            @include('student.body.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('theme/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

    <!-- datepicker -->
    <script src="{{ asset('theme/assets/libs/air-datepicker/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/air-datepicker/js/i18n/datepicker.en.js') }}"></script>


    <script src="{{ asset('theme/assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

    <script src="{{ asset('theme/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image_preview').css('background-image', 'url(' + e.target.result + ')');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#profile_image").change(function() {
            previewImage(this);
        });
    </script>

</body>

</html>
