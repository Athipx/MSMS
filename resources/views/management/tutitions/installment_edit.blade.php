@extends('layouts.master')

@section('content')
    @php
        $status = ['in_progress' => 'ກຳລັງດຳເນີນການ', 'pass' => 'ຜ່ານ', 'not_pass' => 'ບໍ່ຜ່ານ'];
        $type = ['proposal' => 'ປ້ອງກັນຫົວຂໍ້ (Proposal)', 'thesis' => 'ປ້ອງກັນບົດຈົບ'];
    @endphp

    <title>ແກ້ໄຂຂໍ້ມູນປະຫວັດການຜ່ອນຊຳລະຄ່າຮຽນ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ແກ້ໄຂຂໍ້ມູນປະຫວັດການຜ່ອນຊຳລະຄ່າຮຽນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຄ່າທຳນຽມ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tutitions.view') }}">ຊຳລະຄ່າຮຽນ</a></li>
                            <li class="breadcrumb-item active">ແກ້ໄຂຂໍ້ມູນປະຫວັດການຜ່ອນຊຳລະຄ່າຮຽນ</li>
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
                                    <a href="{{ route('tutition.detail', $data->tutition_id) }}"
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
                                        <form action="{{ route('installment.update', $data->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="tutition_id" value="{{ $data->tutition_id }}">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="">ງວດທີຊຳລະ</label>
                                                    <input type="number" name="installment" class="form-control"
                                                        placeholder="ປ້ອນງວດທີຊຳລະ..." required min="1"
                                                        value="{{ old('installment', $data->installment) }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">ວັນທີຊຳລະ</label>
                                                    <input type="date" name="due_date" class="form-control" required
                                                        value="{{ old('due_date', $data->due_date) }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="">ຈຳນວນເງິນ</label>
                                                    <input type="number" name="amount" class="form-control"
                                                        placeholder="ປ້ອນຈຳນວນເງິນ..." required
                                                        value="{{ old('amount', $data->amount) }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="">ຈຳນວນເງິນ (ຕົວອັກສອນ)</label>
                                                    <input type="text" name="txt_amount" class="form-control"
                                                        placeholder="ປ້ອນຈຳນວນເງິນ (ຕົວອັກສອນ)..." required
                                                        value="{{ old('txt_amount', $data->txt_amount) }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="">ສະຖານະການຊຳລະ</label>
                                                    <select name="status" class="form-control">
                                                        <option value="paid"
                                                            {{ $data->status == 'paid' ? 'selected' : '' }}>
                                                            ຊຳລະແລ້ວ</option>
                                                        <option value="unpaid"
                                                            {{ $data->status == 'unpaid' ? 'selected' : '' }}>ຍັງບໍ່ທັນຊຳລະ
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">ລາຍລະອຽດການຊຳລະ</label>
                                                    <textarea class="form-control" name="comment" id="" cols="30" rows="5" required>{{ $data->comment }}</textarea>
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light btn-lg float-right">ບັນທຶກ</button>
                                        </form>
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
