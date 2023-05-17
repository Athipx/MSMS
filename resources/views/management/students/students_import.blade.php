@extends('layouts.master')

@section('content')
    <!-- Lightbox css -->
    <link href="{{ asset('theme/assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />

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
                                {{-- @if (session('errors'))
                                    <div class="alert alert-danger">
                                        <ul style="list-style-type: none;">
                                            @foreach (session('errors') as $error)
                                                <li>ແຖວທີ່: {{ $error->row() }}, ຖັນ: "{{ $error->attribute() }}", ຜິດພາດ:
                                                    {{ $error->errors()[0] }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <a href="{{ route('students.view') }}" class="btn btn-light btn-rounded btn-sm mb-1">
                                    <i class="fas fa-arrow-left mr-2"></i>ກັບຄືນ
                                </a>
                                <hr>
                                <span class="text-danger">*</span> ໃນການ Import(ນຳເຂົ້າ)
                                ຂໍ້ມູນນັກສຶກສາຮອງຮັບສະເພາະໄຟລນາມສະກຸນ <b>xlsx,csv,xls</b> ເທົ່ານັ້ນ. <a
                                    href="{{ asset('/upload/files/student_import_sample.xlsx') }}"
                                    class="btn btn-outline-secondary ml-3"><i class="fas fa-file-download mr-2"></i>
                                    ດາວໂຫຼດຕົວຢ່າງ</a>
                                {{-- <div class="mb-3">
                                    <h5 class="font-size-14">ຕົວຢ່າງຕາຕະລາງໄຟລ xlsx,csv,xls</h5>
                                    <a class="image-popup-vertical-fit"
                                        href="{{ asset('theme/assets/images/small/img-2.jpg') }}"
                                        title="ຂັ້ນຕອນການກຽມໄຟລ excel">
                                        <img class="img-fluid" alt=""
                                            src="{{ asset('theme/assets/images/small/img-2.jpg') }}" width="145">
                                    </a>
                                </div> --}}
                                <form class="mt-3" action="{{ route('students.import') }}" method="post"
                                    enctype="multipart/form-data">
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

    <!-- Magnific Popup-->
    <script src="{{ asset('theme/assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!-- Tour init js-->
    <script src="{{ asset('theme/assets/js/pages/lightbox.init.js') }}"></script>
@endsection
