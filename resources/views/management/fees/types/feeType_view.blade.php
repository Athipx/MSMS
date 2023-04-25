@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ປະເພດຄ່າທຳນຽມ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຄ່າທຳນຽມ</a></li>
                            <li class="breadcrumb-item active">ປະເພດຄ່າທຳນຽມ</li>
                        </ol>
                    </div>
                    <div class="col-md-4 {{ !in_array(Auth::user()->role, ['admin', 'coordinator']) ? 'd-none' : '' }}">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <button type="button" class="btn btn-light btn-rounded waves-effect waves-light"
                                    data-toggle="modal" data-target="#myModal"><i class="fas fa-plus mr-1"></i>
                                    ເພີ່ມຂໍ້ມູນ</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <!-- Modal Add Fee Type Form -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">ເພີ່ມປະເພດຄ່າທຳນຽມ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('feeType.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="type">ປະເພດຄ່າທຳນຽມ</label>
                                <input name="type" class="form-control" type="text" id="type"
                                    placeholder="ປ້ອນປະເພດຄ່າທຳນຽມ..." required>
                            </div>
                            <div class="form-group">
                                <label for="type">ຈຳນວນເງິນ</label>
                                <input name="amount" class="form-control" type="number" id="type"
                                    placeholder="ປ້ອນຈຳນວນເງິນ..." required value="{{ old('amount') }}">
                            </div>
                            <div class="form-group">
                                <label for="">ຈຳນວນເງິນ (ຕົວອັກສອນ)</label>
                                <input type="text" name="txt_amount" class="form-control"
                                    placeholder="ປ້ອນຈຳນວນເງິນ (ຕົວອັກສອນ)..." required value="{{ old('txt_amount') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">ລາຍລະອຽດ</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">ຍົກເລີກ</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">ບັນທຶກ</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @error('type')
                                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div>
                                    <div>
                                        <a href="{{ route('feeType.trash') }}"
                                            class="btn btn-light btn-rounded btn-sm mb-1">
                                            {{ $trash }} ຖັງຂີ້ເຫຍື້ອ</a> <b
                                            class="{{ Auth::user()->role == 'admin' ? 'invisible' : '' }}"><i><span
                                                    class="text-danger">*</span>
                                                ຖ້າທ່ານຕ້ອງການກູ້ຄືນຂໍ້ມູນ, ກະລຸນາພົວພັນກັບຜູ້ຄຸ້ມຄອງລະບົບ</i></b>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>ປະເພດຄ່າທຳນຽມ</th>
                                                        <th>ຈຳນວນເງິນ</th>
                                                        <th>ຈຳນວນເງິນ (ຕົວອັກສອນ)</th>
                                                        <th>ລາຍລະອຽດ</th>
                                                        <th>ວັນທີແກ້ໄຂຫຼ້າສຸດ</th>
                                                        <th>ຜູ້ແກ້ໄຂຫຼ້າສຸດ</th>
                                                        <th
                                                            class="{{ !in_array(Auth::user()->role, ['admin', 'coordinator']) ? 'd-none' : '' }}">
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $item)
                                                        <tr>
                                                            <td>{{ $item->type }}</td>
                                                            <td>{{ number_format($item->amount) }}</td>
                                                            <td>{{ $item->txt_amount }}</td>
                                                            <td>{{ $item->description }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($item->updated_at)) }}</td>
                                                            <td>{{ $item->editor->fname_lo }}</td>
                                                            <td
                                                                class="{{ !in_array(Auth::user()->role, ['admin', 'coordinator']) ? 'd-none' : '' }}">
                                                                <div class="btn-group" role="group">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#myModal-{{ $item->id }}"
                                                                        title="ແກ້ໄຂຂໍ້ມູນ">
                                                                        <i class="mdi mdi-pencil"></i>
                                                                    </button>
                                                                    <a href="{{ route('feeType.remove', $item->id) }}"
                                                                        type="button"
                                                                        class="btn btn-outline-secondary btn-sm"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="ລຶບ" id="remove">
                                                                        <i class="mdi mdi-trash-can"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- sample modal content -->
                                                        <div id="myModal-{{ $item->id }}" class="modal fade"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="myModalLabel-{{ $item->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title mt-0" id="myModalLabel">
                                                                            ແກ້ໄຂຂໍ້ມູນ
                                                                            ປະເພດຄ່າທຳນຽມ {{ $item->gen }}
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('feeType.update', ['id' => $item->id]) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="type">ປະເພດຄ່າທຳນຽມ</label>
                                                                                <input name="type" class="form-control"
                                                                                    type="text" id="type"
                                                                                    placeholder="ປ້ອນປະເພດຄ່າທຳນຽມ..."
                                                                                    value="{{ old('type', $item->type) }}"
                                                                                    required
                                                                                    {{ $item->type == 'ຄ່າຮຽນ' ? 'disabled' : '' }}>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="type">ຈຳນວນເງິນ</label>
                                                                                <input name="amount" class="form-control"
                                                                                    type="number" id="type"
                                                                                    placeholder="ປ້ອນຈຳນວນເງິນ..." required
                                                                                    value="{{ old('amount', $item->amount) }}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="">ຈຳນວນເງິນ
                                                                                    (ຕົວອັກສອນ)
                                                                                </label>
                                                                                <input type="text" name="txt_amount"
                                                                                    class="form-control"
                                                                                    placeholder="ປ້ອນຈຳນວນເງິນ (ຕົວອັກສອນ)..."
                                                                                    required
                                                                                    value="{{ old('txt_amount', $item->txt_amount) }}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="description">ລາຍລະອຽດ</label>
                                                                                <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ old('description', $item->description) }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary waves-effect"
                                                                                data-dismiss="modal">ຍົກເລີກ</button>
                                                                            <button type="submite"
                                                                                class="btn btn-primary waves-effect waves-light">ບັນທຶກ</button>
                                                                        </div>
                                                                    </form>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- <div>
                                        {{ $data->links() }}
                                    </div> --}}
                                </div>
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
