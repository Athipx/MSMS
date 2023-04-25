@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ການຮຽນ-ສອນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ການສຶກສາ</a></li>
                            <li class="breadcrumb-item active">ການຮຽນ-ສອນ</li>
                        </ol>
                    </div>
                    <div class="col-md-4 {{ !in_array(Auth::user()->role, ['admin', 'headUnit']) ? 'd-none' : '' }}">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('assign.add') }}" class="btn btn-light btn-rounded dropdown-toggle"
                                    type="button">
                                    <i class="fas fa-plus mr-1"></i> ເພີ່ມຂໍ້ມູນ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        {{-- <!-- Modal Add classroom Form -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">ເພີ່ມການຮຽນ-ການສອນ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> --}}

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('assigns.view') }}" id="filter-form">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">ສາຂາວິຊາ</label>
                                                <select name="major_id" id="major_id" class="form-control">
                                                    <option value="">-- ເລືອກ ສາຂາວິຊາ --</option>
                                                    @foreach ($major as $major)
                                                        <option value="{{ $major->id }}"
                                                            {{ isset($major_id) && $major_id == $major->id ? 'selected' : '' }}>
                                                            {{ $major->major }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">ຮຸ່ນການສຶກສາ</label>
                                                <select name="gen_id" id="gen_id" class="form-control">
                                                    <option value="">-- ເລືອກ ຮຸ່ນການສຶກສາ --</option>
                                                    @foreach ($gen as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ isset($gen_id) && $gen_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->gen }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="text-white">btn</label>
                                                <button type="submit" class="btn btn-primary w-100"><i
                                                        class="fas fa-search mr-2"></i> ຄົ້ນຫາ</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <a href="{{ route('assigns.trash') }}" class="btn btn-light btn-rounded btn-sm mb-1">
                                        {{ $trash }} ຖັງຂີ້ເຫຍື້ອ</a> <b
                                        class="{{ Auth::user()->role == 'admin' ? 'invisible' : '' }}"><i><span
                                                class="text-danger">*</span>
                                            ຖ້າທ່ານຕ້ອງການກູ້ຄືນຂໍ້ມູນ, ກະລຸນາພົວພັນກັບຜູ້ຄຸ້ມຄອງລະບົບ</i></b>
                                    <hr>
                                </div>
                                <table id="datatable" class="table dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">ລະຫັດ</th>
                                            <th>ວິຊາຮຽນ</th>
                                            <th>ຮຸ່ນການສຶກສາ</th>
                                            <th>ສາຂາວິຊາ</th>
                                            <th>ພາກ / ເທີມການສຶກສາ</th>
                                            <th>ຫ້ອງຮຽນ</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $row)
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->subject->subject }}</td>
                                                <td>
                                                    <div
                                                        style="color:#fff; font-weight:bold; width: 50px; height: 50px; background:#3051d3; border-radius: 50px; display: flex; justify-content: center; align-items: center;">
                                                        {{ $row->gen->gen }}</div>
                                                </td>
                                                <td>{{ $row->major->major }}</td>
                                                <td>{{ $row->semister->semister }}</td>
                                                <td>{{ $row->classroom->classroom }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('assign.detail', $row->id) }}" type="button"
                                                            class="btn btn-outline-secondary btn-sm waves-effect waves-light"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="ເບິ່ງລາຍລະອຽດ">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('assign.edit', $row->id) }}" type="button"
                                                            class="btn btn-outline-secondary btn-sm waves-effect waves-light {{ !in_array(Auth::user()->role, ['admin', 'headUnit']) ? 'd-none' : '' }}"
                                                            data-toggle="tooltip" data-placement="top" title="ແກ້ໄຂຂໍ້ມູນ">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('assign.remove', $row->id) }}" type="button"
                                                            class="btn btn-outline-danger btn-sm {{ !in_array(Auth::user()->role, ['admin', 'headUnit']) ? 'd-none' : '' }}"
                                                            data-toggle="tooltip" data-placement="top" title="ລຶບ"
                                                            id="remove">
                                                            <i class="mdi mdi-trash-can"></i>
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
