@extends('layouts.master')

@section('content')
    @php
        $status = ['in_progress' => 'ກຳລັງດຳເນີນການ', 'pass' => 'ຜ່ານ', 'not_pass' => 'ບໍ່ຜ່ານ'];
        $type = ['proposal' => 'ປ້ອງກັນຫົວຂໍ້ (Proposal)', 'thesis' => 'ປ້ອງກັນບົດຈົບ'];
    @endphp

    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ລາຍລະອຽດວິທະຍານິພົນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ວິທະຍານິພົນ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('theses.view') }}">ບັນດາວິທະຍານິພົນ</a></li>
                            <li class="breadcrumb-item active">ລາຍລະອຽດວິທະຍານິພົນ</li>
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
                                    <a href="{{ route('theses.view') }}" class="btn btn-light btn-rounded btn-sm mb-1"><i
                                            class="fas fa-arrow-left"></i>
                                        ກັບຄືນ</a>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <ul class="ml-3">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row pt-3">
                                    <div class="col-md-12">
                                        <div class="text-center mb-4">
                                            <p class="mb-3">ຫົວບົດວິທະຍານິພົນ</p>
                                            <h5 style="line-height: 1.6;">ລາວ: {{ $theses->title_lo }}</h5>
                                            <h5 style="line-height: 1.6;">ອັງກິດ:
                                                {{ $theses->title_en }}</h5>
                                        </div>
                                        <div class=" d-flex justify-content-center align-items-center">
                                            @switch($theses->status)
                                                @case('in_progress')
                                                    <div class="text-center">
                                                        <i class="fas fa-spinner text-warning mb-4" style="font-size: 50px;"></i>
                                                        <h6>ສະຖານະ:
                                                            <span class="text-warning">{{ $status[$theses->status] }}</span>
                                                        </h6>
                                                    </div>
                                                @break

                                                @case('pass')
                                                    <div class="text-center">
                                                        <i class="fas fa-check-circle text-success mb-4"
                                                            style="font-size: 50px;"></i>
                                                        <h6>ສະຖານະ:
                                                            <span class="text-success">{{ $status[$theses->status] }}</span>
                                                        </h6>
                                                    </div>
                                                @break

                                                @case('not_pass')
                                                    <div class="text-center">
                                                        <i class="fas fa-times-circle text-danger text-warning mb-4"
                                                            style="font-size: 50px;"></i>
                                                        <h6>ສະຖານະ:
                                                            <span class="text-da">{{ $status[$theses->status] }}</span>
                                                        </h6>
                                                    </div>
                                                @break
                                            @endswitch
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="table-responsive mt-4">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row" style="width: 30%;">ລະຫັດນັກສຶກສາ:</th>
                                                                <td>{{ $theses->student->student_id }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" style="width: 30%;">ຊື່-ນາມສະກຸນ
                                                                    ນັກສຶກສາ:</th>
                                                                <td>{{ $theses->student->user->fname_lo }}
                                                                    {{ $theses->student->user->lname_lo }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" style="width: 30%;">ສາຂາວິຊາ</th>
                                                                <td>{{ $theses->major->major }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" style="width: 30%;">ຮຸ່ນການສຶກສາ</th>
                                                                <td>{{ $theses->gen->gen }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="table-responsive mt-4">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row" style="width: 30%;">ອາຈານທີ່ປຶກສາຫຼັກ:
                                                                </th>
                                                                <td>{{ $theses->teacher->user->fname_lo }} &nbsp;
                                                                    {{ $theses->teacher->user->lname_lo }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" style="width: 30%;">ອາຈານທີ່ປຶກສາຮ່ວມ
                                                                </th>
                                                                <td>
                                                                    @if ($co_advisers->isEmpty())
                                                                        ບໍ່ມີອາຈານທີ່ປຶກສາຮ່ວມ
                                                                    @else
                                                                        @foreach ($co_advisers as $adviser)
                                                                            <li style="line-height:200%;">
                                                                                {{ $adviser->fname_lo }} &nbsp;
                                                                                {{ $adviser->lname_lo }}</li>
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" style="width: 30%;">ລາຍລະອຽດວິທະຍານິພົນ:
                                                                </th>
                                                                <td>{{ $theses->description }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h5 class="mb-1">ການສອບຫົວຂໍ້</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="float-right d-none d-md-block">
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-rounded dropdown-toggle px-3"
                                                    type="button" data-toggle="modal"
                                                    data-target="{{ $theses->status !== 'pass' ? '#myModal' : '' }}"
                                                    {{ $theses->status == 'pass' ? 'disabled' : '' }}>
                                                    ສອບຫົວຂໍ້
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="table-responsive">
                                        <table class="table mb-0 my-table">
                                            <thead>
                                                <tr>
                                                    <th>ປະເພດບົດປ້ອງກັນ</th>
                                                    <th>ປ້ອງກັນຄັ້ງທີ</th>
                                                    <th>ວັນທີປ້ອງກັນ</th>
                                                    {{-- <th>ຄະນະກຳມະການ</th> --}}
                                                    <th>ສະຖານະການປ້ອງກັນ</th>
                                                    <th>ຄຳເຫັນຈາກຄະນະກຳມະການ</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($logs as $row)
                                                    <tr>
                                                        <td>{{ $type[$row->type] }}</td>
                                                        <td>{{ $row->round }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($row->date)) }}</td>
                                                        {{-- <td>
                                                            @foreach ($committees as $item)
                                                                <li>{{ $item->fname_lo }}</li>
                                                            @endforeach
                                                        </td> --}}
                                                        <td>
                                                            @if ($row->status == 'pass')
                                                                <h4><span class="badge badge-success">ຜ່ານ</span>
                                                                </h4>
                                                            @else
                                                                <h4><span class="badge badge-danger">ບໍ່ຜ່ານ</span>
                                                                </h4>
                                                            @endif
                                                        </td>
                                                        <td>{{ $row->comment }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <a href="{{ route('log.detail', $row->id) }}"
                                                                    type="button" class="btn btn-outline-secondary btn-sm"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="ເບິ່ງລາຍລະອຽດ">
                                                                    <i class="mdi mdi-eye"></i>
                                                                </a>
                                                                <a href="{{ route('log.edit', $row->id) }}" type="button"
                                                                    class="btn btn-outline-secondary btn-sm {{ !in_array(Auth::user()->role, ['headUnit', 'admin']) ? 'd-none' : '' }}"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="ແກ້ໄຂຂໍ້ມູນ">
                                                                    <i class="mdi mdi-pencil"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    {{-- <!-- sample modal content -->
                                                    <div id="myModal-{{ $row->id }}" class="modal fade" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="myModalLabel">
                                                                        Test
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-3" style="font-weight: bold;">
                                                                            ປະເພດບົດປ້ອງກັນ
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            {{ $row->type }}
                                                                            {{ $row->id }}
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-3" style="font-weight: bold;">
                                                                            ປ້ອງກັນຄັ້ງທີ
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            {{ $row->round }}
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-3" style="font-weight: bold;">
                                                                            ວັນທີປ້ອງກັນ
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            {{ date('d/m/Y', strtotime($row->date)) }}
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-3" style="font-weight: bold;">
                                                                            ຄະນະກຳມະການ
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            @foreach ($committees as $committee)
                                                                                {{ $committee->name }}<br>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-3" style="font-weight: bold;">
                                                                            ຄຳເຫັນຈາກຄະນະກຳມະການ
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            {{ $row->comment }}
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-3" style="font-weight: bold;">
                                                                            ສະຖານະການປ້ອງກັນ
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            {{ $row->status }}
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal --> --}}
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->


                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                ຜູ້ແກ້ໄຂຂໍ້ມູນຫຼ້າສຸດ:<span class="ml-3">{{ $theses->editor->fname_lo }}
                                    {{ $theses->editor->lname_lo }}</span><span
                                    class="mx-4">|</span>ວັນທີແກ້ໄຂຂໍ້ມູນຫຼ້າສຸດ: <span
                                    class="ml-3">{{ $theses->updated_at }}</span>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    <!-- sample modal content -->
                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">ການສອບຫົວຂໍ້</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('log.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="thesis_id" value="{{ $theses->id }}">
                                        <div class="form-group">
                                            <label for="">ປ້ອງກັນຄັ້ງທີ</label>
                                            <input type="number" name="round" class="form-control"
                                                placeholder="ປ້ອນຄັ້ງທີປ້ອງກັນ..." required min="1"
                                                value="{{ old('round') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">ປະເພດບົດ</label>
                                            <select name="type" class="form-control">
                                                <option value="proposal"
                                                    {{ old('type') == 'proposal' ? 'selected' : '' }}>ປ້ອງກັນຫົວຂໍ້
                                                    (Proposal)
                                                </option>
                                                <option value="thesis" {{ old('type') == 'thesis' ? 'selected' : '' }}>
                                                    ປ້ອງກັນບົດຈົບ</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">ວັນທີປ້ອງກັນ</label>
                                            <input type="date" name="date" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">ຄະນະກຳມະການ</label>
                                            {{-- <input type="text" name="committees" id="" class="form-control"
                                                placeholder="ປ້ອນຊື່ຄະນະກຳມະການ..."> --}}
                                            <select name="committees[]" class="selectize" multiple
                                                style="border-radius: 10px;">
                                                @foreach ($teachers as $item)
                                                    <option value="{{ $item->id }}">{{ $item->user->fname_lo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">ສະຖານະການປ້ອງກັນ</label>
                                            <select name="status" class="form-control">
                                                <option value="pass">ຜ່ານ</option>
                                                <option value="not_pass">ບໍ່ຜ່ານ</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">ຄຳເຫັນຈາກຄະນະກຳມະການ</label>
                                            <textarea class="form-control" name="comment" id="" cols="30" rows="5" required></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect"
                                        data-dismiss="modal">ປິດ</button>
                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light">ບັນທຶກ</button>
                                </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div> <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
@endsection
