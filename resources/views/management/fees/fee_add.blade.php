@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ເພີ່ມການຊຳລະຄ່າທຳນຽມ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຄ່າທຳນຽມ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('fees.view') }}">ຊຳລະຄ່າທຳນຽມ</a></li>
                            <li class="breadcrumb-item active">ເພີ່ມການຊຳລະຄ່າທຳນຽມ</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <form method="post" action="{{ route('fees.store') }}" id="filter-form">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <a class="btn btn-light btn-rounded btn-sm mb-1" onclick="window.history.back()"><i
                                                class="fas fa-arrow-left"></i>
                                            ກັບຄືນ</a>
                                        <hr>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">ປະເພດຄ່າທຳນຽມ</label>
                                                <select name="feeType_id" id="feeType_id" class="form-control">
                                                    <option value="">-- ເລືອກ ສາຂາວິຊາ --</option>
                                                    @foreach ($feeTypes as $feeType)
                                                        <option value="{{ $feeType->id }}">
                                                            {{ $feeType->type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ສາຂາວິຊາ</label>
                                                <select name="major_id" id="major_id" class="form-control">
                                                    <option value="">-- ເລືອກ ສາຂາວິຊາ --</option>
                                                    @foreach ($majors as $major)
                                                        <option value="{{ $major->id }}">
                                                            {{ $major->major }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ຮຸ່ນການສຶກສາ</label>
                                                <select name="gen_id" id="gen_id" class="form-control">
                                                    <option value="">-- ເລືອກ ຮຸ່ນການສຶກສາ --</option>
                                                    @foreach ($gens as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->gen }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="" class="text-white">btn</label>
                                                <button id="search" class="btn btn-primary w-100"><i
                                                        class="fas fa-search mr-2"></i> ຄົ້ນຫາ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="filter-result">

                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </form>
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>


    <script>
        $('#filter-form').on('click', '#search', function(event) {
            event.preventDefault();
            var formData = $('#filter-form').serialize();
            // console.log(formData);
            $.ajax({
                url: "{{ route('fee.getStudents') }}",
                type: 'GET',
                data: formData,
                success: function(response) {
                    var html = response.filterResults;
                    $('#filter-result').html(response);
                    // console.log(response);
                }
            });
        });
    </script>
@endsection
