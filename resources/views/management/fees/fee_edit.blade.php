@extends('layouts.master')

@section('content')

    @php
        $gender = ['male' => 'ທ້າວ', 'female' => 'ນາງ'];
    @endphp

    <title>ແກ້ໄຂຂໍ້ມູນການຊຳລະຄ່າທຳນຽມ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ແກ້ໄຂຂໍ້ມູນການຊຳລະຄ່າທຳນຽມ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຄ່າທຳນຽມ</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('fees.view') }}">ຊຳລະຄ່າທຳນຽມ</a></li>
                            <li class="breadcrumb-item active">ແກ້ໄຂຂໍ້ມູນການຊຳລະຄ່າທຳນຽມ</li>
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
                                    <a href="{{ route('fee.detail', $editData->id) }}"
                                        class="btn btn-light btn-rounded btn-sm mb-1"><i class="fas fa-arrow-left"></i>
                                        ກັບຄືນ</a>
                                    <hr>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show mb-3 pl-5" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (session()->has('jsAlert'))
                                    <script>
                                        alert({{ session()->get('jsAlert') }});
                                    </script>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ລະຫັດນັກສຶກສາ:</th>
                                                        <td>{{ $editData->student->student_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຊື່-ນາມສະກຸນ
                                                            ນັກສຶກສາ:</th>
                                                        <td>{{ $editData->student->user->fname_lo }}
                                                            {{ $editData->student->user->lname_lo }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ສາຂາວິຊາ</th>
                                                        <td>{{ $editData->major->major }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຮຸ່ນການສຶກສາ</th>
                                                        <td>{{ $editData->gen->gen }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ປະເພດຄ່າທຳນຽມ:</th>
                                                        <td>{{ $editData->feeType->type }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ສະຖານະການຊຳລະ:</th>
                                                        <td>
                                                            @if ($editData->status == 'paid')
                                                                <h4><span class="badge badge-success">ຊຳລະແລ້ວ</span>
                                                                </h4>
                                                            @else
                                                                <h4><span class="badge badge-danger">ຍັງບໍ່ທັນຊຳລະ</span>
                                                                </h4>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="{{ route('fee.update', $editData->id) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="{{ $editData->id }}">
                                                        <label for="">ສະຖານະການຊຳລະ</label>
                                                        <select name="status" id="" class="form-control">
                                                            <option value="paid"
                                                                {{ old('status', $editData->status) == 'paid' ? 'selected' : '' }}>
                                                                ຊຳລະແລ້ວ
                                                            </option>
                                                            <option value="unpaid"
                                                                {{ old('status', $editData->status) == 'unpaid' ? 'selected' : '' }}>
                                                                ຍັງບໍ່ທັນຊຳລະ</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">ວັນທີຊຳລະ</label>
                                                        <input type="date" class="form-control"
                                                            name="due_date"value="{{ old('due_date', $editData->due_date) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <button class="btn btn-primary btn-lg float-right" type="submit"><i
                                                    class="fas fa-save mr-2"></i>ບັນທຶກ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
@endsection
