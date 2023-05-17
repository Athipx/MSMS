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
                                <label for="subject_id">ລະຫັດວິຊາ</label>
                                <input name="subject_id" class="form-control" type="text" id="subject_id"
                                    placeholder="ປ້ອນລະຫັດວິຊາ..." required>
                            </div>
                            <div class="form-group">
                                <label for="subject">ຊື່ວິຊາຮຽນ</label>
                                <input name="subject" class="form-control" type="text" id="subject"
                                    placeholder="ປ້ອນຊື່ວິຊາຮຽນ..." required>
                            </div>
                            <div class="form-group">
                                <label for="credit">ສາຂາວິຊາ</label>
                                <select name="major[]" class="selectize" multiple required>
                                    <option value="">ເລືອກ ສາຂາວິຊາ...</option>
                                    @foreach ($majors as $item)
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
                                @error('subject')
                                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('subject_id')
                                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div>
                                    <a href="{{ route('subjects.trash') }}" class="btn btn-light btn-rounded btn-sm mb-1">
                                        {{ $trash }} ຖັງຂີ້ເຫຍື້ອ</a> <b
                                        class="{{ Auth::user()->role == 'admin' ? 'invisible' : '' }}"><i><span
                                                class="text-danger">*</span>
                                            ຖ້າທ່ານຕ້ອງການກູ້ຄືນຂໍ້ມູນ, ກະລຸນາພົວພັນກັບຜູ້ຄຸ້ມຄອງລະບົບ</i></b>
                                    <hr>
                                </div>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ລະຫັດວິຊາ</th>
                                            <th>ຊື່ວິຊາຮຽນ</th>
                                            <th>ສາຂາວິຊາ</th>
                                            <th>ໜ່ວຍກິດ</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->subject_id }}</td>
                                                <td>{{ $item->subject }}</td>
                                                <td>
                                                    <p>
                                                        @foreach ($item->subject_major as $i)
                                                            {{ $i->major }} </br>
                                                        @endforeach
                                                    </p>
                                                </td>
                                                <td>{{ $item->credit }}</td>
                                                <td>
                                                    <div
                                                        class="mt-3 {{ !in_array(Auth::user()->role, ['admin', 'headUnit']) ? 'd-none' : '' }}">
                                                        <a href="{{ route('subject.edit', $item->id) }}"
                                                            class="btn btn-outline-secondary btn-sm waves-effect waves-light">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('subject.remove', $item->id) }}"
                                                            class="btn btn-outline-danger waves-effect waves-light btn-sm"
                                                            id="remove">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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
