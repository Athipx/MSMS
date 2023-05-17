@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ພາກ / ເທີມການສຶກສາ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ວິຊາການ</a></li>
                            <li class="breadcrumb-item active">ພາກການສຶກສາ</li>
                        </ol>
                    </div>
                    <div class="col-md-4 {{ !in_array(Auth::user()->role, ['admin', 'headUnit']) ? 'd-none' : '' }}">
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

        <!-- Modal Add Gen Form -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">ພາກ / ເທີມການສຶກສາ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('semister.add') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">ພາກຮຽນ / ເທີມ</label>
                                <input name="semister" class="form-control" type="number" id="semister"
                                    placeholder="ປ້ອນເລກພາກ / ເທີມ..." required>
                            </div>
                            <div class="form-group">
                                <label for="">ລາຍລະອຽດ</label>
                                <textarea class="form-control" name="description" id="" rows="5"></textarea>
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
                                @error('semister')
                                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div>

                                    <div>
                                        <a href="{{ route('semisters.trash') }}"
                                            class="btn btn-light btn-rounded btn-sm mb-1">
                                            {{ $trash }} ຖັງຂີ້ເຫຍື້ອ</a>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        @foreach ($data as $item)
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
                                                        <div
                                                            class="{{ !in_array(Auth::user()->role, ['admin', 'headUnit']) ? 'd-none' : '' }}">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary btn-sm waves-effect waves-light"
                                                                data-toggle="modal"
                                                                data-target="#myModal-{{ $item->id }}">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </button>
                                                            <a href="{{ route('semister.remove', $item->id) }}"
                                                                class="btn btn-outline-danger waves-effect waves-light btn-sm"
                                                                id="remove">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- sample modal content -->
                                            <div id="myModal-{{ $item->id }}" class="modal fade" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel-{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0" id="myModalLabel">ແກ້ໄຂຂໍ້ມູນ
                                                                ພາກ / ເທີມການສຶກສາ {{ $item->semister }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('semister.update', ['id' => $item->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="">ພາກຮຽນ / ເທີມ</label>
                                                                    <input name="semister" type="number"
                                                                        class="form-control"
                                                                        value="{{ old('semister', $item->semister) }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">ລາຍລະອຽດ</label>
                                                                    <textarea class="form-control" name="description" id="" rows="5">{{ old('semister', $item->description) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-secondary waves-effect"
                                                                    data-dismiss="modal">ຍົກເລີກ</button>
                                                                <button type="submite"
                                                                    class="btn btn-primary waves-effect waves-light">ບັນທຶກ</button>
                                                            </div>
                                                        </form>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
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
