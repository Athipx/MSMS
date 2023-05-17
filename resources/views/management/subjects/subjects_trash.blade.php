@extends('layouts.master')

@section('content')
    <title>ຖັງຂີ້ເຫຍື້ອ ຫ້ອງຮຽນ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ຖັງຂີ້ເຫຍື້ອ ຫ້ອງຮຽນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ວິຊາການ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('classroom.view') }}">ຫ້ອງຮຽນ</a></li>
                            <li class="breadcrumb-item active">ຖັງຂີ້ເຫຍື້ອ ຫ້ອງຮຽນ</li>
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
                                    <a href="{{ route('subjects.view') }}" class="btn btn-light btn-rounded btn-sm mb-1"><i
                                            class="fas fa-arrow-left"></i> ກັບຄືນ</a>
                                    <hr>
                                </div>
                                <div>
                                    <div class="row">
                                        @foreach ($trash as $item)
                                            <div class="col-md-6">
                                                <div class="card card-body" style="background: #f4f8f9;">
                                                    <div class="d-flex justify-content-between align-items-center"
                                                        style="height: 50px;">
                                                        <div>
                                                            <h5 class="card-title text-primary mb-3"
                                                                style="margin: 0; padding:0;">
                                                                {{ $item->subject }}</h5>
                                                            <p style="padding: 0; margin: 0;">ລະຫັດວິຊາ:
                                                                {{ $item->subject_id }} |
                                                                {{ $item->credit }} ໜ່ວຍກິດ
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('subject.restore', $item->id) }}"
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
                                        {{ $trash->links() }}
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
