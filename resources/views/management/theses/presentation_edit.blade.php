@extends('layouts.master')

@section('content')
    @php
        $type = ['proposal' => 'ປ້ອງກັນຫົວຂໍ້ (Proposal)', 'thesis' => 'ປ້ອງກັນບົດຈົບ'];
    @endphp

    <title>ແກ້ໄຂຂໍ້ມູນການສອບຫົວຂໍ້</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ແກ້ໄຂຂໍ້ມູນການສອບຫົວຂໍ້
                        </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ວິທະຍານິພົນ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('theses.view') }}">ບັນດາວິທະຍານິພົນ</a></li>
                            <li class="breadcrumb-item active"><a href="#">ລາຍລະອຽດວິທະຍານິພົນ</a></li>
                            <li class="breadcrumb-item active">ລາຍການສອບຫົວຂໍ້</li>
                            <li class="breadcrumb-item active">ແກ້ໄຂຂໍ້ມູນການສອບຫົວຂໍ້</li>
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
                                    <a href="{{ route('thesis.detail', $data->id) }}"
                                        class="btn btn-light btn-rounded btn-sm mb-1"><i class="fas fa-arrow-left"></i>
                                        ກັບຄືນ</a>
                                    <hr>
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
                                <form action="{{ route('log.update', $data->id) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="thesis_id" value="{{ $data->id }}">
                                    <div class="form-group">
                                        <label for="">ປ້ອງກັນຄັ້ງທີ</label>
                                        <input type="number" name="round" class="form-control"
                                            placeholder="ປ້ອນຄັ້ງທີປ້ອງກັນ..." required min="1"
                                            value="{{ old('round', $data->round) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">ປະເພດບົດ</label>
                                        <select name="type" class="form-control">
                                            <option value="proposal"
                                                {{ old('type', $data->type) == 'proposal' ? 'selected' : '' }}>
                                                ປ້ອງກັນຫົວຂໍ້
                                                (Proposal)
                                            </option>
                                            <option value="thesis"
                                                {{ old('type', $data->type) == 'thesis' ? 'selected' : '' }}>
                                                ປ້ອງກັນບົດຈົບ</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">ວັນທີປ້ອງກັນ</label>
                                        <input name="date" type="text" class="form-control datepicker-here"
                                            data-language="en" placeholder="ເລືອກວັນທີ..."
                                            value="{{ old('date', date('d-m-Y', strtotime($data->date))) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">ຄະນະກຳມະການ</label>
                                        {{-- <input type="text" name="committees" id="" class="form-control"
                                                placeholder="ປ້ອນຊື່ຄະນະກຳມະການ..."> --}}
                                        <select name="committees[]" class="selectize" multiple style="border-radius: 10px;">
                                            @foreach ($teachers as $item)
                                                <option value="{{ $item->id }}"
                                                    @if (in_array($item->id, $selectedTeacherIds)) selected @endif>
                                                    {{ $item->user->fname_lo }} {{ $item->user->lname_lo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">ສະຖານະການປ້ອງກັນ</label>
                                        <select name="status" class="form-control">
                                            <option value="pass"
                                                {{ old('status', $data->status) == 'pass' ? 'selected' : '' }}>ຜ່ານ
                                            </option>
                                            <option value="not_pass"
                                                {{ old('status', $data->status) == 'not_pass' ? 'selected' : '' }}>
                                                ບໍ່ຜ່ານ
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">ຄຳເຫັນຈາກຄະນະກຳມະການ</label>
                                        <textarea class="form-control" name="comment" id="" cols="30" rows="5" required>{{ old('comment', $data->comment) }}</textarea>
                                    </div>
                                    <button class="btn btn-primary btn-lg" type="submit"style="float: right;"><i
                                            class="fas fa-save mr-2"></i> ບັນທຶກ</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
@endsection
