@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ແກ້ໄຂຂໍ້ມູນວິຊາ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ການສຶກສາ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('subjects.view') }}">ການຮຽນ-ການສອນ</a></li>
                            <li class="breadcrumb-item active">ແກ້ໄຂຂໍ້ມູນວິຊາ</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('subjects.view') }}" class="btn"><i
                                        class="fas fa-arrow-left mr-2"></i>ກັບຄືນ</a>
                                <hr>
                                <form action="{{ route('subject.update', $editData->id) }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="subject_id">ລະຫັດວິຊາ</label>
                                                <input name="subject_id" class="form-control" type="text" id="subject_id"
                                                    placeholder="ປ້ອນລະຫັດວິຊາ..." required
                                                    value="{{ old('subject_id', $editData->subject_id) }}">
                                            </div>
                                            <label for="subject">ຊື່ວິຊາຮຽນ</label>
                                            <input name="subject" class="form-control" type="text" id="subject"
                                                placeholder="ປ້ອນຊື່ວິຊາຮຽນ..." required
                                                value="{{ old('subject', $editData->subject) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="major">ສາຂາວິຊາ</label>
                                            <select name="major[]" class="selectize" multiple required>
                                                <option value="">ເລືອກ ສາຂາວິຊາ...</option>
                                                @foreach ($majors as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if (in_array($item->id, $selectedMajorIds)) selected @endif>
                                                        {{ $item->major }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="credit">ຈຳນວນໜ່ວຍກິດ</label>
                                            <input name="credit" class="form-control" type="number" id="credit"
                                                placeholder="ປ້ອນຈຳນວນໜ່ວຍກິດ..." required
                                                value="{{ old('credit', $editData->credit) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">ລາຍລະອຽດ</label>
                                            <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $editData->description) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button name="submit" type="submit" class="btn btn-lg btn-primary mt-4">
                                            <i class="fas fa-save mr-2"></i>ບັນທຶກ
                                        </button>
                                    </div>
                                </form>
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
