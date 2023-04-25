@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ສາຂາວິຊາ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ວິຊາການ</a></li>
                            <li class="breadcrumb-item active">ສາຂາວິຊາ</li>
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
                        <h5 class="modal-title mt-0" id="myModalLabel">ເພີ່ມສາຂາວິຊາ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('major.add') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input name="major" class="form-control @error('major') is-invalid @enderror" type="text"
                                id="major" placeholder="ປ້ອນສາຂາວິຊາ..." required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">ຍົກເລີກ</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">ບັນທຶກ</button>
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
                                @error('major')
                                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div>
                                    <div>
                                        <a href="{{ route('majors.trash') }}" class="btn btn-light btn-rounded btn-sm mb-1">
                                            {{ $trash }} ຖັງຂີ້ເຫຍື້ອ</a> <b
                                            class="{{ Auth::user()->role == 'admin' ? 'invisible' : '' }}"><i><span
                                                    class="text-danger">*</span>
                                                ຖ້າທ່ານຕ້ອງການກູ້ຄືນຂໍ້ມູນ, ກະລຸນາພົວພັນກັບຜູ້ຄຸ້ມຄອງລະບົບ</i></b>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        @foreach ($data as $item)
                                            <div class="col-md-4">
                                                <div class="card card-body" style="background: #f4f8f9;">
                                                    <div class="d-flex justify-content-between align-items-center"
                                                        style="height: 50px;">
                                                        <h5 class="card-title" style="margin: 0; padding:0;">
                                                            {{ $item->major }}</h5>
                                                        <div
                                                            class="{{ !in_array(Auth::user()->role, ['admin', 'headUnit']) ? 'd-none' : '' }}">
                                                            <button
                                                                class="btn btn-outline-secondary btn-sm waves-effect waves-light mt-2"
                                                                data-toggle="modal"
                                                                data-target="#myModal-{{ $item->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <a href="{{ route('major.remove', $item->id) }}"
                                                                class="btn btn-outline-danger btn-sm waves-effect waves-light mt-2"
                                                                data-toggle="tooltip" data-placement="top" title="ລຶບ"
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
                                                                ສາຂາວິຊາ: {{ $item->gen }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('major.update', ['id' => $item->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input name="major" type="text" class="form-control"
                                                                    value="{{ old('major', $item->major) }}">
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
