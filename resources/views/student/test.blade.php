@extends('student.master')

@section('content')
    @php
        $status = ['in_progress' => 'ກຳລັງດຳເນີນການ', 'pass' => 'ຜ່ານ', 'not_pass' => 'ບໍ່ຜ່ານ'];
        $type = ['proposal' => 'ປ້ອງກັນຫົວຂໍ້ (Proposal)', 'thesis' => 'ປ້ອງກັນບົດຈົບ'];
    @endphp
    <!-- Page-Title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">ສະບາຍດີ!... {{ $data->user->fname_lo }} {{ $data->user->lname_lo }}</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">ຍິນດີຕ້ອນຮັບສູ່ລະບົບ MSMS, ພາກວິຊາ ວິສະວະກຳຄອມພິມເຕີ ແລະ
                            ເຕັກໂນໂລຊີຂໍ້ມູນຂ່າວສານ.</li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-light btn-rounded dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-settings-outline mr-1"></i> ແກ້ໄຂຂໍ້ມູນ
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                <a class="dropdown-item" href="{{ route('studentProfile.edit') }}">ແກ້ໄຂຂໍ້ມູນສ່ວນຕົວ</a>
                                <a class="dropdown-item" href="{{ route('student.changePwd') }}">ປ່ຽນລະຫັດຜ່ານ</a>
                            </div>
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
                <div class="col-xl-12">
                    <div class="card p-3">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <h4>ຂໍ້ມູນນັກສຶກສາ</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div>
                                        <img class="rounded-circle"
                                            src="{{ !empty($data->user->profile) ? asset($data->user->profile) : asset('assets/images/profiles/profile.jpg') }}"
                                            width="200" height="200">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-justified nav-tabs-custom" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#custom-home" role="tab"
                                                aria-selected="false">
                                                <i class="fas fa-user mr-1 align-middle"></i> <span
                                                    class="d-none d-md-inline-block tab-font">ຂໍ້ມູນບັນຊີນັກສຶກສາ</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#custom-profile" role="tab"
                                                aria-selected="true">
                                                <i class="fas fa-list"></i> <span
                                                    class="d-none d-md-inline-block tab-font">ລາຍລະອຽດນັກສຶກສາ</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content p-3">
                                        <div class="tab-pane active" id="custom-home" role="tabpanel">
                                            <div class="row pt-3">
                                                <div class="col-md-12">
                                                    <div class="table-responsive mt-4">
                                                        <table class="table mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ລະຫັດນັກສຶກສາ:
                                                                    </th>
                                                                    <td>{{ $data->student_id }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ຊື່-ນາມສະກຸນ
                                                                        ພາສາລາວ:
                                                                    </th>
                                                                    <td>{{ $data->gender == 'male' ? 'ທ້າວ' : 'ນາງ' }}.
                                                                        {{ $data->user->fname_lo }}
                                                                        {{ $data->user->lname_lo }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ຊື່-ນາມສະກຸນ
                                                                        ພາສາອັງກິດ:</th>
                                                                    <td>{{ $data->gender == 'male' ? 'Mr' : 'Ms' }}.
                                                                        {{ $data->user->fname_en }}
                                                                        {{ $data->user->lname_en }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ຊື່ຜູ້ໃຊ້
                                                                        (Username):
                                                                    </th>
                                                                    <td>{{ $data->user->username }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ຮຸ່ນການສຶກສາ:
                                                                    </th>
                                                                    <td>{{ $data->gen->gen }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ສາຂາວິຊາ:</th>
                                                                    <td>{{ $data->major->major }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ສະຖານະພາບການສຶກສາ
                                                                    </th>
                                                                    <td>
                                                                        @switch($data->status)
                                                                            @case('graduated')
                                                                                ສຳເລັດການສຶກສາ
                                                                            @break

                                                                            @case('drop')
                                                                                ຢຸດຕິຊົ່ວຄາວ
                                                                            @break

                                                                            @case('quit')
                                                                                ໂຈະການສຶກສາ
                                                                            @break

                                                                            @default
                                                                                ກຳລັງສຶກສາ
                                                                        @endswitch
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ສະຖານະບັນຊີໃຊ້ງານ
                                                                    </th>
                                                                    <td>
                                                                        @if ($data->user->status == 'active')
                                                                            <h4><span
                                                                                    class="badge badge-soft-success">ເປີດໃຊ້ງານ</span>
                                                                            </h4>
                                                                        @else
                                                                            <h4><span
                                                                                    class="badge badge-soft-danger">ປິດໃຊ້ງານ</span>
                                                                            </h4>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="custom-profile" role="tabpanel">
                                            <div class="row pt-3">
                                                <div class="col-md-12">
                                                    {{-- ---------------- ປະຫວັດນັກສຶກສາ ---------------- --}}
                                                    <h5 class="text-primary">ລາຍລະອຽດນັກສຶກສາ</h5>
                                                    <div class="table-responsive mt-4">
                                                        <table class="table mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ອີເມວ:
                                                                    </th>
                                                                    <td>{{ $data->user->email }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ເບີໂທລະສັບ:</th>
                                                                    <td>{{ $data->phone }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ວັນ, ເດືອນ, ປີ
                                                                        ເກີດ:
                                                                    </th>
                                                                    <td>{{ $data->dob !== null ? date('d/m/Y', strtotime($data->dob)) : '' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ບ້ານ, ເມືອງ,
                                                                        ແຂວງ ເກີດ:
                                                                    </th>
                                                                    <td>{{ $data->born_village }},
                                                                        {{ $data->born_district }},
                                                                        {{ $data->born_province }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ບ້ານ, ເມືອງ,
                                                                        ແຂວງ
                                                                        ປັດຈຸບັນ:</th>
                                                                    <td>{{ $data->current_village }},
                                                                        {{ $data->current_district }},
                                                                        {{ $data->current_province }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    {{-- ---------------- ປະຫວັດການສຶກສາ ---------------- --}}
                                                    <h5 class="mt-5 text-primary">ປະຫວັດການສຶກສາຜ່ານມາ</h5>
                                                    <div class="table-responsive mt-4">
                                                        <table class="table mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">
                                                                        ສົກຮຽນທີ່ຈົບການສຶກສາ:
                                                                    </th>
                                                                    <td>{{ $data->bd_graduated_year }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">
                                                                        ຈົບຈາກສະຖາບັນການສຶກສາ:
                                                                    </th>
                                                                    <td>{{ $data->bd_academy }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ສາຂາທີ່ຈົບ:
                                                                    </th>
                                                                    <td>{{ $data->bd_major }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ຄະແນນສະເລ່ຍ:
                                                                    </th>
                                                                    <td>{{ $data->bd_grade }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    {{-- ---------------- ປະຫວັດການເຮັດວຽກ ---------------- --}}
                                                    <h5 class="mt-5 text-primary">ປະຫວັດການເຮັດວຽກ</h5>
                                                    <div class="table-responsive mt-4">
                                                        <table class="table mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ອົງກອນ:
                                                                    </th>
                                                                    <td>
                                                                        @if ($data->working_org == 'private')
                                                                            ພະນັກງານເອກະຊົນ
                                                                        @else
                                                                            ລັດຖະກອນ
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">ມາຈາກພາກສ່ວນ:
                                                                    </th>
                                                                    <td>{{ $data->working_place }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" style="width: 30%;">
                                                                        ໄລຍະເວລາຂອງການເປັນພະນັກງານ:
                                                                    </th>
                                                                    <td>{{ $data->working_duration }}
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
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-justified nav-tabs-custom" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#grade" role="tab"
                                                aria-selected="false">
                                                <i class="fas fa-graduation-cap"></i> <span
                                                    class="d-none d-md-inline-block tab-font ml-2">ຄະແນນການສຶກສາ
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#thesis" role="tab"
                                                aria-selected="true">
                                                <i class="fas fa-book"></i> <span
                                                    class="d-none d-md-inline-block tab-font ml-2">ວິທະຍານິພົນ
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content p-3">
                                        {{-- ------------------------------ Grade Tab ------------------------------ --}}
                                        <div class="tab-pane active" id="grade" role="tabpanel">
                                            <div class="row pt-3">
                                                <div class="col-md-12">
                                                    <h5 class="mb-3" style="color:#3051d3;">ຄະແນນການສຶກສາ</h5>
                                                    <div id="accordion">
                                                        <div class="card mb-0">
                                                            <div class="card-header" id="headingOne">
                                                                <h5 class="m-0 font-size-14">
                                                                    <a data-toggle="collapse" data-parent="#accordion"
                                                                        href="#collapseOne" aria-expanded="true"
                                                                        aria-controls="collapseOne" class="text-dark">
                                                                        ເທີມ 1
                                                                    </a>
                                                                </h5>
                                                            </div>

                                                            <div id="collapseOne" class="collapse show"
                                                                aria-labelledby="headingOne" data-parent="#accordion"
                                                                style="">
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table mb-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>ວິຊາ</th>
                                                                                    <th>ເກຣດ</th>
                                                                                    <th>ລາຍລະອຽດ</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($grades_term1 as $item)
                                                                                    <tr>
                                                                                        <td>{{ $item->subject }}</td>
                                                                                        <td>{{ $item->grade }}</td>
                                                                                        <td>{{ $item->description }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card mb-0">
                                                            <div class="card-header" id="headingTwo">
                                                                <h5 class="m-0 font-size-14">
                                                                    <a class="text-dark collapsed" data-toggle="collapse"
                                                                        data-parent="#accordion" href="#collapseTwo"
                                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                                        ເທີມ 2
                                                                    </a>
                                                                </h5>
                                                            </div>
                                                            <div id="collapseTwo" class="collapse"
                                                                aria-labelledby="headingTwo" data-parent="#accordion"
                                                                style="">
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table mb-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>ວິຊາ</th>
                                                                                    <th>ເກຣດ</th>
                                                                                    <th>ລາຍລະອຽດ</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($grades_term2 as $item)
                                                                                    <tr>
                                                                                        <td>{{ $item->subject }}</td>
                                                                                        <td>{{ $item->grade }}</td>
                                                                                        <td>{{ $item->description }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card mb-0">
                                                            <div class="card-header" id="headingThree">
                                                                <h5 class="m-0 font-size-14">
                                                                    <a class="text-dark collapsed" data-toggle="collapse"
                                                                        data-parent="#accordion" href="#collapseThree"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseThree">
                                                                        ເທີມ 3
                                                                    </a>
                                                                </h5>
                                                            </div>
                                                            <div id="collapseThree" class="collapse"
                                                                aria-labelledby="headingThree" data-parent="#accordion"
                                                                style="">
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table mb-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>ວິຊາ</th>
                                                                                    <th>ເກຣດ</th>
                                                                                    <th>ລາຍລະອຽດ</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($grades_term3 as $item)
                                                                                    <tr>
                                                                                        <td>{{ $item->subject }}</td>
                                                                                        <td>{{ $item->grade }}</td>
                                                                                        <td>{{ $item->description }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card mb-0">
                                                            <div class="card-header" id="headingThree">
                                                                <h5 class="m-0 font-size-14">
                                                                    <a class="text-dark collapsed" data-toggle="collapse"
                                                                        data-parent="#accordion" href="#collapseThree"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseThree">
                                                                        ເທີມ 4
                                                                    </a>
                                                                </h5>
                                                            </div>
                                                            <div id="collapseThree" class="collapse"
                                                                aria-labelledby="headingThree" data-parent="#accordion"
                                                                style="">
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table mb-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>ວິຊາ</th>
                                                                                    <th>ເກຣດ</th>
                                                                                    <th>ລາຍລະອຽດ</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($grades_term4 as $item)
                                                                                    <tr>
                                                                                        <td>{{ $item->subject }}</td>
                                                                                        <td>{{ $item->grade }}</td>
                                                                                        <td>{{ $item->description }}</td>
                                                                                    </tr>
                                                                                @endforeach
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
                                        {{-- ------------------------------ Thesis Tab ------------------------------ --}}
                                        <div class="tab-pane" id="thesis" role="tabpanel">
                                            <div class="row pt-3">
                                                <div class="col-md-12">
                                                    <h5 style="color:#3051d3;">ວິທະຍານິພົນ</h5>
                                                    <div>
                                                        <div class="table-responsive mt-4">
                                                            <table class="table mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row" style="width: 20%;">
                                                                            ຊື່ຫົວບົດວິທະຍານິພົນ
                                                                            ພາສາລາວ:</th>
                                                                        <td>{{ $thesis == null ? '-' : $thesis->title_lo }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" style="width: 20%;">
                                                                            ຊື່ຫົວບົດວິທະຍານິພົນ
                                                                            ພາສາອັງກິດ:</th>
                                                                        <td>{{ $thesis == null ? '-' : $thesis->title_en }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" style="width: 20%;">
                                                                            ອາຈານທີ່ປຶກສາຫຼັກ:</th>
                                                                        <td>{{ $thesis == null ? '-' : $thesis->teacher->user->fname_lo }}
                                                                            {{ $thesis == null ? '-' : $thesis->teacher->user->lname_lo }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" style="width: 20%;">
                                                                            ອາຈານທີ່ປຶກສາຮ່ວມ:</th>
                                                                        <td>
                                                                            @if ($co_advisers !== null)
                                                                                -
                                                                                @if ($co_advisers->isEmpty())
                                                                                    ບໍ່ມີອາຈານທີ່ປຶກສາຮ່ວມ
                                                                                @else
                                                                                    @foreach ($co_advisers as $adviser)
                                                                                        <li style="line-height:200%;">
                                                                                            {{ $adviser->fname_lo }} &nbsp;
                                                                                            {{ $adviser->lname_lo }}</li>
                                                                                    @endforeach
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" style="width: 20%;">
                                                                            ສະຖານະວິທະຍານິພົນ:</th>
                                                                        <td>{{ $thesis == null ? '-' : $status[$thesis->status] }}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-5">
                                                    <h5 style="color:#3051d3;">ການສອບຫົວຂໍ້</h5>
                                                    <div>
                                                        <div class="table-responsive">
                                                            <table class="table mb-0 my-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ປະເພດບົດປ້ອງກັນ</th>
                                                                        <th>ປ້ອງກັນຄັ້ງທີ</th>
                                                                        <th>ວັນທີປ້ອງກັນ</th>
                                                                        <th>ສະຖານະການປ້ອງກັນ</th>
                                                                        <th>ຄະນະກຳມະການ</th>
                                                                        <th>ຄຳເຫັນຈາກຄະນະກຳມະການ</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ($logs !== null)
                                                                        @foreach ($logs as $row)
                                                                            <tr>
                                                                                <td>{{ $type[$row->type] }}</td>
                                                                                <td>{{ $row->round }}</td>
                                                                                <td>{{ date('d/m/Y', strtotime($row->date)) }}
                                                                                </td>
                                                                                <td>
                                                                                    @if ($row->status == 'pass')
                                                                                        <h4><span
                                                                                                class="badge badge-success">ຜ່ານ</span>
                                                                                        </h4>
                                                                                    @else
                                                                                        <h4><span
                                                                                                class="badge badge-danger">ບໍ່ຜ່ານ</span>
                                                                                        </h4>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @foreach ($row->committees as $teacher)
                                                                                        {{ $teacher->fname_lo }}
                                                                                        {{ $teacher->lname_lo }} </br>
                                                                                    @endforeach
                                                                                </td>
                                                                                <td>{{ $row->comment }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- end page-content-wrapper -->
@endsection
