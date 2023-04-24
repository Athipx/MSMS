@extends('layouts.master')

@section('content')
    @php
        $status = ['in_progress' => 'ກຳລັງດຳເນີນການ', 'pass' => 'ຜ່ານ', 'not_pass' => 'ບໍ່ຜ່ານ'];
        $type = ['proposal' => 'ປ້ອງກັນຫົວຂໍ້ (Proposal)', 'thesis' => 'ປ້ອງກັນບົດຈົບ'];
    @endphp

    <title>ແກ້ໄຂຂໍ້ມູນການຊຳລະຄ່າຮຽນ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ແກ້ໄຂຂໍ້ມູນການຊຳລະຄ່າຮຽນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຄ່າທຳນຽມ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tutitions.view') }}">ຊຳລະຄ່າຮຽນ</a></li>
                            <li class="breadcrumb-item active">ແກ້ໄຂຂໍ້ມູນການຊຳລະຄ່າຮຽນ</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-7">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <a href="{{ route('tutition.detail', $data->id) }}"
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

                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{ route('tutition.update', $data->id) }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">ສະຖານະການຊຳລະ</label>
                                                <select name="status" id="" class="form-control">
                                                    <option value="paid"
                                                        {{ old('status', $data->status) == 'paid' ? 'selected' : '' }}>
                                                        ຊຳລະແລ້ວ
                                                    </option>
                                                    <option value="unpaid"
                                                        {{ old('status', $data->status) == 'unpaid' ? 'selected' : '' }}>
                                                        ຍັງບໍ່ທັນຊຳລະ
                                                    </option>
                                                    <option value="installment"
                                                        {{ old('status', $data->status) == 'installment' ? 'selected' : '' }}>
                                                        ຜ່ອນຊຳລະ
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">ວັນທີຊຳລະ</label>
                                                <input type="date" class="form-control"
                                                    name="due_date"value="{{ old('due_date', $data->due_date) }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">ລາຍລະອຽດການຊຳລະ</label>
                                                <textarea name="comment" id="" rows="5" class="form-control">{{ old('comment', $data->comment) }}</textarea>
                                            </div>
                                            <button name="submit" type="submit"
                                                class="btn btn-lg btn-primary mt-4 float-right">
                                                <i class="fas fa-save mr-2"></i>ບັນທຶກ
                                            </button>
                                        </form>
                                    </div>
                                </div>
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
