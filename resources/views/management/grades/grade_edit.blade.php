@extends('layouts.master')

@section('content')
    @php
        $gender = ['male' => 'ທ້າວ', 'female' => 'ນາງ'];
        $major = ['ວິສະວະກຳຊັອບແວ' => 'SW', 'ລະບົບເຄືອຂ່າຍຄອມພິວເຕີ' => 'NW'];
    @endphp

    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ແກ້ໄຂຄະແນນ: &nbsp; {{ $gender[$editData->student->gender] }}
                            {{ $editData->student->user->fname_lo }} {{ $editData->student->user->lname_lo }},
                            &nbsp; {{ $major[$editData->student->major->major] }} | G{{ $editData->student->gen->gen }}</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ການສຶກສາ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('grades.view') }}">ຄະແນນການສຶກສາ</a></li>
                            <li class="breadcrumb-item active">ລາຍລະອຽດຄະແນນນັກສຶກສາ</li>
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
                                <div class="row d-flex justify-content-between px-2">
                                    <a href="{{ route('grade.detail', $editData->id) }}" class="btn rounded"><i
                                            class="fas fa-arrow-left mr-2"></i>ກັບຄືນ</a>
                                </div>
                                <hr>
                                <div class="row pt-3 mb-4">
                                    <div class="col-md-12 ml-3">
                                        <h5 class="mb-3">ວິຊາ: {{ $editData->assign->subject->subject }}</h5>
                                    </div>
                                </div>
                                <hr>
                                <form action="{{ route('grade.update', $editData->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="assign_id" value="{{ $editData->assign_id }}">
                                    <input type="hidden" name="student_id" value="{{ $editData->student_id }}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">ເກຣດຄະແນນວິຊາ</label>
                                                <select name='grade' class='form-control'>
                                                    <option value='A'
                                                        {{ old('grade', $editData->grade) == 'A' ? 'selected' : '' }}>
                                                        A</option>
                                                    <option value='B+'
                                                        {{ old('grade', $editData->grade) == 'B+' ? 'selected' : '' }}>B+
                                                    </option>
                                                    <option value='B'
                                                        {{ old('grade', $editData->grade) == 'B' ? 'selected' : '' }}>B
                                                    </option>
                                                    <option value='C+'
                                                        {{ old('grade', $editData->grade) == 'C+' ? 'selected' : '' }}>C+
                                                    </option>
                                                    <option value='C'
                                                        {{ old('grade', $editData->grade) == 'C' ? 'selected' : '' }}>C
                                                    </option>
                                                    <option value='D+'
                                                        {{ old('grade', $editData->grade) == 'D+' ? 'selected' : '' }}>D+
                                                    </option>
                                                    <option value='D'
                                                        {{ old('grade', $editData->grade) == 'D' ? 'selected' : '' }}>D
                                                    </option>
                                                    <option value='F'
                                                        {{ old('grade', $editData->grade) == 'F' ? 'selected' : '' }}>F
                                                    </option>
                                                    <option value='I'
                                                        {{ old('grade', $editData->grade) == 'I' ? 'selected' : '' }}>I
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">ເກຣດຄະແນນວິຊາ</label>
                                                <select name='old_grade' class='form-control'>
                                                    <option value='ບໍ່ໄດ້ອັບເກຣດ'
                                                        {{ old('old_grade', $editData->old_grade) == 'ບໍ່ໄດ້ອັບເກຣດ' ? 'selected' : '' }}>
                                                        ບໍ່ໄດ້ອັບເກຣດ</option>
                                                    <option value='A'
                                                        {{ old('old_grade', $editData->old_grade) == 'A' ? 'selected' : '' }}>
                                                        A</option>
                                                    <option value='B+'
                                                        {{ old('old_grade', $editData->old_grade) == 'B+' ? 'selected' : '' }}>
                                                        B+
                                                    </option>
                                                    <option value='B'
                                                        {{ old('old_grade', $editData->old_grade) == 'B' ? 'selected' : '' }}>
                                                        B
                                                    </option>
                                                    <option value='C+'
                                                        {{ old('old_grade', $editData->old_grade) == 'C+' ? 'selected' : '' }}>
                                                        C+
                                                    </option>
                                                    <option value='C'
                                                        {{ old('old_grade', $editData->old_grade) == 'C' ? 'selected' : '' }}>
                                                        C
                                                    </option>
                                                    <option value='D+'
                                                        {{ old('old_grade', $editData->old_grade) == 'D+' ? 'selected' : '' }}>
                                                        D+
                                                    </option>
                                                    <option value='D'
                                                        {{ old('old_grade', $editData->old_grade) == 'D' ? 'selected' : '' }}>
                                                        D
                                                    </option>
                                                    <option value='F'
                                                        {{ old('old_grade', $editData->old_grade) == 'F' ? 'selected' : '' }}>
                                                        F
                                                    </option>
                                                    <option value='I'
                                                        {{ old('old_grade', $editData->old_grade) == 'I' ? 'selected' : '' }}>
                                                        I
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">ເກຣດຄະແນນວິຊາ</label>
                                                <input name="upgrade_date" type="date" class="form-control"
                                                    value="{{ old('upgrade_date', $editData->upgrade_date) }}">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">ເກຣດຄະແນນວິຊາ</label>
                                                <textarea class="form-control" name="description" id="" cols="30" rows="5">{{ old('description', $editData->description) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary btn-lg"><i
                                                    class="fas fa-save mr-2"></i>ແກ້ໄຂ</button>
                                        </div>
                                    </div>
                                </form>
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
