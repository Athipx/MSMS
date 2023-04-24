@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ຖັງຂີ້ເຫຍື້ອ ພາກ / ເທີມການສຶກສາ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ວິຊາການ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('semisters.view') }}">ສາຂາວິຊາ</a></li>
                            <li class="breadcrumb-item active">ຖັງຂີ້ເຫຍື້ອ ພາກ / ເທີມການສຶກສາ</li>
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
                                    <a href="{{ route('semisters.view') }}" class="btn btn-light btn-rounded btn-sm mb-1"><i
                                            class="fas fa-arrow-left"></i> ກັບຄືນ</a>
                                    <hr>
                                </div>
                                <div>
                                    <div class="row">
                                        @foreach ($semisterTrash as $item)
                                            <div class="col-md-4">
                                                <div class="card card-body" style="background: #f4f8f9;">
                                                    <div class="d-flex justify-content-between align-items-center"
                                                        style="height: 50px;">
                                                        <div>
                                                            <h6 class="card-title" style="margin: 0; padding:0;">ພາກ /
                                                                ເທີມການສຶກສາ:
                                                            </h6>
                                                            <h3 class="mt-2" style="color: #3051d3;">{{ $item->semister }}
                                                            </h3>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('semister.restore', $item->id) }}"
                                                                class="btn btn-outline-primary waves-effect waves-light mt-2"
                                                                style="width: 50px;" data-toggle="tooltip"
                                                                data-placement="top" title="ກູ້ຄືນ"><i
                                                                    class="fas fa-undo"></i></a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div>
                                        {{ $semisterTrash->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
@endsection
