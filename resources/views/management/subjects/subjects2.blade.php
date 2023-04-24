@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ວິຊາຮຽນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ວິຊາການ</a></li>
                            <li class="breadcrumb-item active">ວິຊາຮຽນ</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <button type="button" class="btn btn-light btn-rounded waves-effect waves-light"
                                    data-toggle="modal" data-target="#myModal"><i class="fas fa-plus mr-1"></i>
                                    ເພີ່ມຂໍ້ມູນ</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <!-- Modal Add classroom Form -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">ເພີ່ມວິຊາຮຽນ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('subject.add') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="subject">ຊື່ວິຊາຮຽນ</label>
                                <input name="subject" class="form-control" type="text" id="subject"
                                    placeholder="ປ້ອນຊື່ວິຊາຮຽນ..." required>
                            </div>
                            <div class="form-group">
                                <label for="subject">ສາຂາວິຊາ</label>
                                <select name="major" id="major" class="form-control">
                                    @foreach ($major as $item)
                                        <option value="{{ $item->id }}">{{ $item->major }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="credit">ຈຳນວນໜ່ວຍກິດ</label>
                                <input name="credit" class="form-control" type="number" id="credit"
                                    placeholder="ປ້ອນຈຳນວນໜ່ວຍກິດ..." required>
                            </div>
                            <div class="form-group">
                                <label for="description">ລາຍລະອຽດ</label>
                                <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">ຍົກເລີກ</button>
                            <button type="submite" class="btn btn-primary waves-effect waves-light">ບັນທຶກ</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5>ຄົ້ນຫາ</h5>
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <select name="major_id" id="major_id" class="form-control">
                                                <option value="">--ສະແດງທັງໝົດ--</option>
                                                @foreach ($major as $item)
                                                    <option value="{{ $item->id }}">{{ $item->major }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-primary w-100">ຄົ້ນຫາ</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @error('subject')
                                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div>

                                    <div class="{{ Auth::user()->role !== 'admin' ? 'invisible' : 'visible' }}">
                                        <a href="{{ route('subjects.trash') }}"
                                            class="btn btn-light btn-rounded btn-sm mb-1">
                                            ຖັງຂີ້ເຫຍື້ອ</a>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        @foreach ($data as $item)
                                            <div class="col-md-4">
                                                <div class="card card-body" style="background: #f4f8f9;">
                                                    <div class="d-flex justify-content-between align-items-center"
                                                        style="height: 50px;">
                                                        <div>
                                                            <h4 class="card-title text-primary mb-2"
                                                                style="margin: 0; padding:0;">
                                                                {{ $item->subject }}</h4>
                                                            <p style="padding: 0; margin: 0;">{{ $item->major }} |
                                                                {{ $item->credit }} ໜ່ວຍກິດ
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('subject.edit', $item->id) }}"
                                                                type="button"
                                                                class="btn btn-outline-secondary btn-sm waves-effect waves-light">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{ route('subject.remove', $item->id) }}"
                                                                class="btn btn-outline-danger waves-effect waves-light btn-sm"
                                                                id="remove">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div>
                                        {{ $data->links() }}
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
