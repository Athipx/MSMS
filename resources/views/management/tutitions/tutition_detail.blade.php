@extends('layouts.master')

@section('content')
    @php
        $status = ['in_progress' => 'ກຳລັງດຳເນີນການ', 'pass' => 'ຜ່ານ', 'not_pass' => 'ບໍ່ຜ່ານ'];
        $type = ['proposal' => 'ປ້ອງກັນຫົວຂໍ້ (Proposal)', 'thesis' => 'ປ້ອງກັນບົດຈົບ'];
    @endphp

    <title>ລາຍລະອຽດການຊຳລະຄ່າຮຽນ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ລາຍລະອຽດການຊຳລະຄ່າຮຽນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຄ່າທຳນຽມ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tutitions.view') }}">ຊຳລະຄ່າຮຽນ</a></li>
                            <li class="breadcrumb-item active">ລາຍລະອຽດການຊຳລະຄ່າຮຽນ</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('tutition.edit', $data->id) }}"
                                    class="btn btn-light btn-rounded dropdown-toggle" type="button">
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
                                <div>
                                    <a href="{{ route('tutitions.view') }}" class="btn btn-light btn-rounded btn-sm mb-1"><i
                                            class="fas fa-arrow-left"></i>
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
                                        <h5>ລາຍລະອຽດການຊຳລະຄ່າຮຽນ</h5>
                                        <div class="table-responsive mt-4">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ລະຫັດນັກສຶກສາ:</th>
                                                        <td>{{ $data->student->student_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຊື່-ນາມສະກຸນ
                                                            ນັກສຶກສາ:</th>
                                                        <td>{{ $data->student->user->fname_lo }}
                                                            {{ $data->student->user->lname_lo }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ສາຂາວິຊາ</th>
                                                        <td>{{ $data->major->major }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ຮຸ່ນການສຶກສາ</th>
                                                        <td>{{ $data->gen->gen }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ສະຖານະການຊຳລະ:</th>
                                                        <td>
                                                            @if ($data->status == 'paid')
                                                                <h4><span class="badge badge-success">ຊຳລະແລ້ວ</span>
                                                                </h4>
                                                            @elseif($data->status == 'unpaid')
                                                                <h4><span class="badge badge-danger">ຍັງບໍ່ທັນຊຳລະ</span>
                                                                </h4>
                                                            @else
                                                                <h4><span class="badge badge-warning">ຜ່ອນຊຳລະ</span>
                                                                </h4>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ວັນທີຊຳລະ:</th>
                                                        <td>
                                                            {{ $data->due_date !== null ? date('d/m/Y', strtotime($data->due_date)) : '-' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">ລາຍລະອຽດການຊຳລະ:</th>
                                                        <td>
                                                            {{ $data->comment }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
                                        <h5 class="mb-3">ປະຫວັດການຜ່ອນຊຳລະຄ່າຮຽນ</h5>
                                        <p>ຈຳນວນເງິນຕົ້ນ: <span class="badge badge-primary"
                                                style="font-size: 14px;">{{ number_format($tutition_price->amount) }}
                                                ກີບ </span><span class="mx-2">|</span>
                                            ຈຳນວນເງິນທີ່ຈ່າຍແລ້ວ: <span class="badge badge-success"
                                                style="font-size: 14px;">{{ number_format($total_paid) }} ກີບ
                                            </span><span class="mx-2">|</span>
                                            ຈຳນວນເງິນທີ່ຕ້ອງຈ່າຍ: <span class="badge badge-secondary"
                                                style="font-size: 14px;">{{ number_format($total_left) }} ກີບ</span>
                                        </p>
                                        {{-- <div>
                                            <div class="table-responsive mt-4">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" style="width: 20%;">ຈຳນວນເງິນຕົ້ນ:
                                                            </th>
                                                            <td>{{ number_format($tutition_price->amount) }} ກີບ</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width: 20%;">ຈຳນວນເງິນທີ່ຈ່າຍແລ້ວ:
                                                            </th>
                                                            <td>{{ number_format($total_paid) }} ກີບ</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width: 20%;">ຈຳນວນເງິນທີ່ຕ້ອງຈ່າຍ:
                                                            </th>
                                                            <td>{{ number_format($total_left) }} ກີບ</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="col-md-4">
                                        <div class="float-right d-none d-md-block">
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-rounded dropdown-toggle px-3"
                                                    type="button" data-toggle="modal" data-target="#myModal"
                                                    {{ $data->status !== 'installment' ? 'disabled' : '' }}>
                                                    <i class="fas fa-plus mr-1"></i>ເພີ່ມຂໍ້ມູນ
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
                                                    <th>ງວດທີຊຳລະ</th>
                                                    <th>ຈຳນວນເງິນ</th>
                                                    <th>ຈຳນວນເງິນ ຕົວອັກສອນ</th>
                                                    <th>ວັນທີຊຳລະ</th>
                                                    <th>ສະຖານະການຊຳລະ</th>
                                                    <th>ລາຍລະອຽດການຊຳລະ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($installments as $row)
                                                    <tr>
                                                        <td>{{ $row->installment }}</td>
                                                        <td>{{ number_format($row->amount) }} ກີບ</td>
                                                        <td>{{ $row->txt_amount }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($row->due_date)) }}</td>
                                                        <td>
                                                            @if ($row->status == 'paid')
                                                                <h4><span class="badge badge-success">ຊຳລະແລ້ວ</span>
                                                                </h4>
                                                            @else
                                                                <h4><span class="badge badge-danger">ຍັງບໍ່ທັນຊຳລະ</span>
                                                                </h4>
                                                            @endif
                                                        </td>
                                                        <td>{{ $row->comment }}</td>
                                                        <td>
                                                            <a href="{{ route('installment.edit', $row->id) }}"
                                                                type="button"
                                                                class="btn btn-outline-secondary btn-sm {{ !in_array(Auth::user()->role, ['admin', 'coordinator']) ? 'd-none' : '' }}"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="ແກ້ໄຂຂໍ້ມູນ">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
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
                                ຜູ້ແກ້ໄຂຂໍ້ມູນຫຼ້າສຸດ:<span class="ml-3">{{ $data->editor->fname_lo }}
                                </span><span class="mx-4">|</span>ວັນທີແກ້ໄຂຂໍ້ມູນຫຼ້າສຸດ: <span
                                    class="ml-3">{{ date('d/m/Y h:i', strtotime($data->updated_at)) }}</span>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    <!-- sample modal content -->
                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">ເພີ່ມຂໍ້ມູນການຜ່ອນຊຳລະຄ່າຮຽນ</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('installment.store', $data->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="tutition_id" value="{{ $data->id }}">
                                        <div class="form-group">
                                            <label for="">ງວດທີຊຳລະ</label>
                                            <input type="number" name="installment" class="form-control"
                                                placeholder="ປ້ອນງວດທີຊຳລະ..." required min="1"
                                                value="{{ old('installment') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">ຈຳນວນເງິນ</label>
                                            {{-- <input type="text" name="amount" class="form-control"
                                                placeholder="ປ້ອນຈຳນວນເງິນ..." required
                                                value="{{ old('amount') ? old('amount') : '' }}"
                                                oninput="formatAmount(this)"> --}}
                                            <input type="number" name="amount" class="form-control"
                                                placeholder="ປ້ອນຈຳນວນເງິນ..." required value="{{ old('amount') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">ຈຳນວນເງິນ (ຕົວອັກສອນ)</label>
                                            <input type="text" name="txt_amount" class="form-control"
                                                placeholder="ປ້ອນຈຳນວນເງິນ (ຕົວອັກສອນ)..." required
                                                value="{{ old('txt_amount') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">ວັນທີຊຳລະ</label>
                                            <input type="date" name="date" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">ສະຖານະການຊຳລະ</label>
                                            <select name="status" class="form-control">
                                                <option value="paid">ຊຳລະແລ້ວ</option>
                                                <option value="unpaid">ຍັງບໍ່ທັນຊຳລະ</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">ລາຍລະອຽດການຊຳລະ</label>
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
    {{-- <script>
        function formatAmount(input) {
            // Remove any non-numeric characters from the input value
            let value = input.value.replace(/[^0-9\.]/g, '');
            // Convert the value to a number
            let number = parseFloat(value);
            // Format the number with commas and set the input value
            input.value = number.toLocaleString('en-US');
        }
    </script> --}}
@endsection
