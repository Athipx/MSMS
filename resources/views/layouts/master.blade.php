<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- spectrum colorpicker -->
    <link href="{{ asset('theme/assets/libs/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet" type="text/css" />
    <!-- Selectize -->
    <link href="{{ asset('theme/assets/libs/selectize/css/selectize.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('theme/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- datepicker -->
    <link href="{{ asset('theme/assets/libs/air-datepicker/css/datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- jvectormap -->
    <link href="{{ asset('theme/assets/libs/jqvmap/jqvmap.min.css') }}" rel="stylesheet" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('theme/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('theme/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('theme/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('theme/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="{{ asset('theme/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('theme/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/vendor/toastr.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alerts js -->
    <script src="{{ asset('theme/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('theme/assets/js/pages/sweet-alerts.init.js') }}"></script>

    <link href="{{ asset('assets/css/my-style.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('theme/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</head>

<body data-topbar="colored">

    <!-- Begin page -->
    <div id="layout-wrapper">

        @if (Auth::user()->role == 'admin')
            @include('admin.body.header')
        @endif

        @if (Auth::user()->role == 'teacher')
            @include('teacher.body.header')
        @endif

        @if (Auth::user()->role == 'coordinator')
            @include('coordinator.body.header')
        @endif

        @if (Auth::user()->role == 'headUnit')
            @include('headUnit.body.header')
        @endif

        @if (Auth::user()->role == 'headDept')
            @include('headDept.body.header')
        @endif

        <!-- ========== Left Sidebar Start ========== -->
        @if (Auth::user()->role == 'admin')
            @include('admin.body.sidebar')
        @endif

        @if (Auth::user()->role == 'teacher')
            @include('teacher.body.sidebar')
        @endif

        @if (Auth::user()->role == 'coordinator')
            @include('coordinator.body.sidebar')
        @endif

        @if (Auth::user()->role == 'headUnit')
            @include('headUnit.body.sidebar')
        @endif

        @if (Auth::user()->role == 'headDept')
            @include('headDept.body.sidebar')
        @endif
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('content')
            <!-- End Page-content -->


            @include('admin.body.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('theme/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>

    <!-- Spectrum colorpicker -->
    <script src="{{ asset('theme/assets/libs/spectrum-colorpicker/spectrum.js') }}"></script>

    <!-- Selectize -->
    <script src="{{ asset('theme/assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>

    <!-- datepicker -->
    <script src="{{ asset('theme/assets/libs/air-datepicker/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/air-datepicker/js/i18n/datepicker.en.js') }}"></script>

    <!-- apexcharts -->
    {{-- <script src="{{ asset('theme/assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}

    {{-- <script src="{{ asset('theme/assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

    <script src="{{ asset('theme/assets/js/pages/dashboard.init.js') }}"></script> --}}

    <!-- Required datatable js -->
    <script src="{{ asset('theme/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('theme/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('theme/assets/libs/jszip/jszip.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script> --}}
    <script src="{{ asset('theme/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('theme/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('theme/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('theme/assets/js/pages/datatables.init.js') }}"></script>

    <script src="{{ asset('assets/vendor/toastr.min.js') }}"></script>

    <!-- Form Advanced init -->
    <script src="{{ asset('theme/assets/js/pages/form-advanced.init.js') }}"></script>

    <script src="{{ asset('theme/assets/js/app.js') }}"></script>

    {{-- <!-- Sweet Alerts js -->
    <script src="{{asset('theme/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <!-- Sweet alert init js-->
    <script src="{{asset('theme/assets/js/pages/sweet-alerts.init.js')}}"></script> --}}

    <script src="{{ asset('assets/js/my-script.js') }}"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>

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

    <script>
        $(function() {
            $(document).on('click', '#remove', function(e) {
                e.preventDefault();
                var link = $(this).attr('href');
                Swal.fire({
                    title: 'ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ແທ້ ຫຼື ບໍ່?',
                    // text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6d7b87',
                    confirmButtonText: 'ຢືນຢັນ',
                    cancelButtonText: 'ຍົກເລີກ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                    }
                })
            });
        });
    </script>
</body>

</html>
