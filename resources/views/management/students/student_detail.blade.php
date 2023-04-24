@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ລາຍລະອຽດນັກສຶກສາ: {{ $data->gender == 'male' ? 'ທ້າວ' : 'ນາງ' }}
                            {{ $data->user->fname_lo }} {{ $data->user->lname_lo }}</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຜູ້ໃຊ້ງານລະບົບ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('students.view') }}">ນັກສຶກສາ</a></li>
                            <li class="breadcrumb-item active">ລາຍລະອຽດນັກສຶກສາ</li>
                        </ol>
                    </div>
                    <div
                        class="col-md-4 {{ in_array(Auth::user()->role, ['teacher', 'headUnit', 'headDept']) ? 'd-none' : '' }}">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('student.edit', $data->id) }}"
                                    class="btn btn-light btn-rounded dropdown-toggle" type="button">
                                    <i class="fas fa-edit mr-1"></i> ແກ້ໄຂຂໍ້ມູນນັກສຶກສາ
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
                                    <a href="{{ route('students.view') }}" class="btn btn-light btn-rounded btn-sm mb-1"><i
                                            class="fas fa-arrow-left"></i>
                                        ກັບຄືນ</a>
                                    <hr>
                                </div>
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
                                            <div class="col-md-4 d-flex justify-content-center mb-5">
                                                <img class="rounded-circle"
                                                    src="{{ !empty($data->user->profile) ? asset($data->user->profile) : asset('assets/images/profiles/profile.jpg') }}"
                                                    width="200" height="200">
                                            </div>
                                            <div class="col-md-8">
                                                <h5>ຂໍ້ມູນບັນຊີນັກສຶກສາ</h5>
                                                <div class="table-responsive mt-4">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row" style="width: 30%;">ລະຫັດນັກສຶກສາ:
                                                                </th>
                                                                <td>{{ $data->student_id }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" style="width: 30%;">ຊື່-ນາມສະກຸນ ພາສາລາວ:
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
                                                                <th scope="row" style="width: 30%;">ຊື່ຜູ້ໃຊ້ (Username):
                                                                </th>
                                                                <td>{{ $data->user->username }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" style="width: 30%;">ຮຸ່ນການສຶກສາ:</th>
                                                                <td>{{ $data->gen->gen }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" style="width: 30%;">ສາຂາວິຊາ:</th>
                                                                <td>{{ $data->major->major }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" style="width: 30%;">
                                                                    ວັນ, ເດືອນ, ປີເຂົ້າເປັນນັກສຶກສາ:</th>
                                                                <td>{{ $data->begin_date !== null ? date('d/m/Y', strtotime($data->begin_date)) : '' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" style="width: 30%;">
                                                                    ວັນ, ເດືອນ, ປີສຳເລັດການສຶກສາ:</th>
                                                                <td>{{ date('d/m/Y', strtotime($data->graduated_date)) }}
                                                                </td>
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
                                                                        @case('studying')
                                                                            <i
                                                                                class="fas fa-dot-circle mr-1 text-primary"></i>ກຳລັງສຶກສາ
                                                                        @break

                                                                        @case('graduated')
                                                                            <i
                                                                                class="fas fa-dot-circle mr-1 text-success"></i>ສຳເລັດການສຶກສາ
                                                                        @break

                                                                        @case('drop')
                                                                            <i
                                                                                class="fas fa-dot-circle mr-1 text-warning"></i>ຢຸດຕິຊົ່ວຄາວ
                                                                        @break

                                                                        @case('quit')
                                                                            <i
                                                                                class="fas fa-dot-circle mr-1 text-danger"></i>ໂຈະການສຶກສາ
                                                                        @break

                                                                        @case('pending')
                                                                            <i
                                                                                class="fas fa-dot-circle mr-1 text-secondary"></i>ລໍຖ້າອະນຸມັດ
                                                                        @break
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
                                                            <th scope="row" style="width: 30%;">ວັນ, ເດືອນ, ປີ ເກີດ:
                                                            </th>
                                                            <td>{{ $data->dob !== null ? date('d/m/Y', strtotime($data->dob)) : '' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width: 30%;">ບ້ານ, ເມືອງ, ແຂວງ ເກີດ:
                                                            </th>
                                                            <td>{{ $data->born_village }},
                                                                {{ $data->born_district }},
                                                                {{ $data->born_province }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width: 30%;">ບ້ານ, ເມືອງ, ແຂວງ
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
                                                            <th scope="row" style="width: 30%;">ສົກຮຽນທີ່ຈົບການສຶກສາ:
                                                            </th>
                                                            <td>{{ $data->bd_graduated_year }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" style="width: 30%;">ຈົບຈາກສະຖາບັນການສຶກສາ:
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
                </div> <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
@endsection
