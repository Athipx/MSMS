@extends('layouts.master')

@section('content')
    @php
        $type = ['proposal' => 'ປ້ອງກັນຫົວຂໍ້ (Proposal)', 'thesis' => 'ປ້ອງກັນບົດຈົບ'];
    @endphp

    <title>ລາຍລະອຽດການສອບຫົວຂໍ້</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ລາຍລະອຽດການສອບຫົວຂໍ້
                        </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ວິທະຍານິພົນ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('theses.view') }}">ບັນດາວິທະຍານິພົນ</a></li>
                            <li class="breadcrumb-item active"><a href="#">ລາຍລະອຽດວິທະຍານິພົນ</a></li>
                            <li class="breadcrumb-item active">ລາຍລະອຽດການສອບຫົວຂໍ້</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('log.edit', $data) }}" class="btn btn-light btn-rounded dropdown-toggle"
                                    type="button">
                                    <i class="fas fa-edit mr-1"></i> ແກ້ໄຂຂໍ້ມູນ
                                </a>
                            </div>
                        </div>
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
                                <a href="#" class="btn btn-light btn-rounded btn-sm mb-5"
                                    onclick="window.history.back();">
                                    <i class="fas fa-arrow-left mr-2"></i>ກັບຄືນ
                                </a>
                                <div class="row">
                                    <div class="col-md-3" style="font-weight: bold;">
                                        ປະເພດບົດປ້ອງກັນ
                                    </div>
                                    <div class="col-md-9">
                                        {{ $type[$data->type] }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3" style="font-weight: bold;">
                                        ປ້ອງກັນຄັ້ງທີ
                                    </div>
                                    <div class="col-md-9">
                                        {{ $data->round }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3" style="font-weight: bold;">
                                        ວັນທີປ້ອງກັນ
                                    </div>
                                    <div class="col-md-9">
                                        {{ date('d/m/Y', strtotime($data->date)) }}
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
                                        {{ $data->comment }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3" style="font-weight: bold;">
                                        ສະຖານະການປ້ອງກັນ
                                    </div>
                                    <div class="col-md-9">
                                        @if ($data->status == 'pass')
                                            <h4><span class="badge badge-success">ຜ່ານ</span>
                                            </h4>
                                        @else
                                            <h4><span class="badge badge-danger">ບໍ່ຜ່ານ</span>
                                            </h4>
                                        @endif
                                    </div>
                                </div>
                                <hr>
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
