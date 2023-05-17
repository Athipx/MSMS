@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ແກ້ໄຂຂໍ້ມູນນັກສຶກສາ: <span
                                class="ml-3">{{ $editData->user->fname_lo }}</span>
                            {{ $editData->user->lname_lo }}</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຜູ້ໃຊ້ງານລະບົບ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('students.view') }}">ນັກສຶກສາ</a></li>
                            <li class="breadcrumb-item active">ແກ້ໄຂຂໍ້ມູນນັກສຶກສາ</li>
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
                                    <a href="{{ route('student.detail', $editData->id) }}"
                                        class="btn btn-light btn-rounded btn-sm mb-1"><i class="fas fa-arrow-left"></i>
                                        ກັບຄືນ</a>
                                    <hr>
                                </div>
                                <form method="post" action="{{ route('student.update', $editData->user->id) }}"
                                    class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    @csrf
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
                                                <div class="col-md-12 mb-3">
                                                    <div class="row">
                                                        <div class="col-md-3"
                                                            style="display:flex; flex-direction: row; justify-content: center;">
                                                            {{-- <div class="rounded-circle" id="image_preview"></div> --}}
                                                            <div class="mt-3">
                                                                <input type="hidden" name="old_profile"
                                                                    value="{{ $editData->user->profile }}">
                                                                <img id="showImage" class="rounded-circle"
                                                                    src="{{ !empty($editData->user->profile) ? url($editData->user->profile) : url('assets/images/profiles/profile.jpg') }}"
                                                                    data-holder-rendered="true" style="object-fit: cover;"
                                                                    width="200" height="200">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="student_id">ລະຫັດນັກສຶກສາ</label>
                                                                        <div>
                                                                            <input name="student_id"
                                                                                class="form-control @error('student_id') is-invalid @enderror"
                                                                                type="text" id="student_id"
                                                                                placeholder="ປ້ອນລະຫັດນັກສຶກສາ..."
                                                                                value="{{ old('student_id', $editData->student_id) }}">
                                                                            @error('student_id')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="fname_lo">ຊື່ແທ້
                                                                            ພາສາລາວ</label>
                                                                        <div>
                                                                            <input name="fname_lo"
                                                                                class="form-control @error('fname_lo') is-invalid @enderror"
                                                                                type="text" id="fname_lo"
                                                                                placeholder="ປ້ອນຊື່ແທ້..."
                                                                                value="{{ old('fname_lo', $editData->user->fname_lo) }}">
                                                                            @error('fname_lo')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="lname_lo">ນາມສະກຸນ ພາສາລາວ</label>
                                                                        <div>
                                                                            <input name="lname_lo"
                                                                                class="form-control @error('lname_lo') is-invalid @enderror"
                                                                                type="text" id="lname_lo"
                                                                                placeholder="ປ້ອນຊື່ແທ້..."
                                                                                value="{{ old('lname_lo', $editData->user->lname_lo) }}">
                                                                            @error('lname_lo')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="fname_en">ຊື່ແທ້ ພາສາອັງກິດ</label>
                                                                        <div>
                                                                            <input name="fname_en"
                                                                                class="form-control @error('fname_en') is-invalid @enderror"
                                                                                type="text" id="fname_en"
                                                                                placeholder="ປ້ອນຊື່ແທ້..."
                                                                                value="{{ old('fname_en', $editData->user->fname_en) }}">
                                                                            @error('fname_en')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="lname_en">ນາມສະກຸນ ພາສາອັງກິດ</label>
                                                                        <div>
                                                                            <input name="lname_en"
                                                                                class="form-control @error('lname_en') is-invalid @enderror"
                                                                                type="text" id="lname_en"
                                                                                placeholder="ປ້ອນຊື່ແທ້..."
                                                                                value="{{ old('lname_en', $editData->user->lname_en) }}">
                                                                            @error('lname_en')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="username">ຊື່ຜູ້ໃຊ້ (Username)<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <input id="username" name="username"
                                                                                class="form-control @error('username') is-invalid @enderror"
                                                                                type="text"
                                                                                placeholder="ປ້ອນຊື່ຜູ້ໃຊ້..."
                                                                                value="{{ old('username', $editData->user->username) }}">
                                                                            @error('username')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>ເພດ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <div
                                                                                class="custom-control custom-radio custom-control-inline">
                                                                                <input value="male" type="radio"
                                                                                    id="male" name="gender"
                                                                                    class="custom-control-input"
                                                                                    {{ $editData->gender == 'male' ? 'checked' : '' }}>
                                                                                <label class="custom-control-label"
                                                                                    for="male">ຊາຍ</label>
                                                                            </div>
                                                                            <div
                                                                                class="custom-control custom-radio custom-control-inline">
                                                                                <input value="female" type="radio"
                                                                                    id="female"
                                                                                    name="gender"class="custom-control-input"
                                                                                    {{ $editData->gender == 'female' ? 'checked' : '' }}>
                                                                                <label class="custom-control-label"
                                                                                    for="female">ຍິງ</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>ຮຸ່ນການສຶກສາ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <select id="gen" name="gen"
                                                                                class="form-control">
                                                                                @foreach ($gen as $key)
                                                                                    <option value="{{ $key->id }}"
                                                                                        @if (old('gen', $editData->gen_id) == $key->id) selected @endif>
                                                                                        {{ $key->gen }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>ສາຂາວິຊາ</label>
                                                                        <div>
                                                                            <select id="major" name="major"
                                                                                class="form-control">
                                                                                @foreach ($major as $key)
                                                                                    <option value="{{ $key->id }}"
                                                                                        @if (old('major', $editData->major_id) == $key->id) selected @endif>
                                                                                        {{ $key->major }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>ສະຖານະບັນຊີໃຊ້ງານ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <select id="status" name="status"
                                                                                class="form-control">
                                                                                <option value="active"
                                                                                    {{ old('status', $editData->user->status) == 'active' ? 'selected' : '' }}>
                                                                                    ເປີດໃຊ້ງານ</option>
                                                                                <option value="inactive"
                                                                                    {{ old('status', $editData->user->status) == 'inactive' ? 'selected' : '' }}>
                                                                                    ປິດໃຊ້ງານ</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>ວັນ, ເດືອນ, ປີເຂົ້າເປັນນັກສຶກສາ</label>
                                                                        <input name="begin_date" type="text"
                                                                            class="form-control datepicker-here"
                                                                            data-language="en" placeholder="ເລືອກວັນທີ..."
                                                                            value="{{ old('begin_date', date('d-m-Y', strtotime($editData->begin_date))) }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>ວັນ, ເດືອນ, ປີສຳເລັດການສຶກສາ</label>
                                                                        <input name="graduated_date" type="text"
                                                                            class="form-control datepicker-here"
                                                                            data-language="en" placeholder="ເລືອກວັນທີ..."
                                                                            value="{{ old('graduated_date', date('d-m-Y', strtotime($editData->graduated_date))) }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>ສະຖານະພາບການສຶກສາ</label>
                                                                        <div>
                                                                            <select id="student_status"
                                                                                name="student_status"
                                                                                class="form-control">
                                                                                <option value="pending"
                                                                                    {{ old('student_status', $editData->status) == 'pending' ? 'selected' : '' }}>
                                                                                    ລໍຖ້າອະນຸມັດ
                                                                                </option>
                                                                                <option value="studying"
                                                                                    {{ old('student_status', $editData->status) == 'studying' ? 'selected' : '' }}>
                                                                                    ກຳລັງສຶກສາ
                                                                                </option>
                                                                                <option value="graduated"
                                                                                    {{ old('student_status', $editData->status) == 'graduated' ? 'selected' : '' }}>
                                                                                    ສຳເລັດການສຶກສາ
                                                                                </option>
                                                                                <option value="drop"
                                                                                    {{ old('student_status', $editData->status) == 'drop' ? 'selected' : '' }}>
                                                                                    ຢຸດຕິຊົ່ວຄາວ
                                                                                </option>
                                                                                <option value="quit"
                                                                                    {{ old('student_status', $editData->status) == 'quit' ? 'selected' : '' }}>
                                                                                    ໂຈະການສຶກສາ</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email">ອີເມວ</label>
                                                                        <div>
                                                                            <input id="email" name="email"
                                                                                class="form-control @error('email') is-invalid @enderror"
                                                                                type="email" placeholder="ປ້ອນອີເມວ..."
                                                                                value="{{ old('email', $editData->user->email) }}">
                                                                            @error('email')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>ຮູບໂປຣໄຟລ</label>
                                                                        <div>
                                                                            <input name="profile"
                                                                                class="form-control @error('profile') is-invalid @enderror"
                                                                                type="file" id="image"
                                                                                value="{{ $editData->user->profile }}">
                                                                            @error('profile')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="custom-profile" role="tabpanel">
                                            <div class="row pt-3">
                                                {{-- ----------------- ປະຫວັດນັກສຶກສາ ---------------- --}}
                                                <div class="col-12">
                                                    <h4>ປະຫວັດນັກສຶກສາ</h4>
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>ວັນ, ເດືອນ, ປີເກີດ</label>
                                                        <input name="dob" type="text"
                                                            class="form-control datepicker-here" data-language="en"
                                                            placeholder="ເລືອກວັນທີ..."
                                                            value="{{ old('dob', date('d-m-Y', strtotime($editData->dob))) }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone">ເບີໂທລະສັບ</label>
                                                        <div>
                                                            <input name="phone"
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                type="number" id="phone"
                                                                placeholder="ປ້ອນເບີໂທລະສັບ..."
                                                                value="{{ old('phone', $editData->user->phone) }}">
                                                            @error('phone')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="born_village">ບ້ານເກີດ</label>
                                                        <div>
                                                            <input name="born_village"
                                                                class="form-control @error('born_village') is-invalid @enderror"
                                                                type="text" id="born_village"
                                                                placeholder="ປ້ອນບ້ານເກີດ..."
                                                                value="{{ old('born_village', $editData->born_village) }}">
                                                            @error('born_village')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="born_district">ເມືອງເກີດ</label>
                                                        <div>
                                                            <input name="born_district"
                                                                class="form-control @error('born_district') is-invalid @enderror"
                                                                type="text" id="born_district"
                                                                placeholder="ປ້ອນເມືອງເກີດ..."
                                                                value="{{ old('born_district', $editData->born_district) }}">
                                                            @error('born_district')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="born_province">ແຂວງເກີດ</label>
                                                        <div>
                                                            <select id="born_province" name="born_province"
                                                                class="form-control">
                                                                <option value="ນະຄອນຫຼວງວຽງຈັນ"
                                                                    {{ $editData->born == 'ນະຄອນຫຼວງວຽງຈັນ' ? 'selected' : '' }}>
                                                                    ນະຄອນຫຼວງວຽງຈັນ</option>
                                                                <option value="ຜົ້ງສາລີ"
                                                                    {{ $editData->born_province == 'ຜົ້ງສາລີ' ? 'selected' : '' }}>
                                                                    ຜົ້ງສາລີ</option>
                                                                <option value="ຫຼວງນໍ້າທາ"
                                                                    {{ $editData->born_province == 'ຫຼວງນໍ້າທາ' ? 'selected' : '' }}>
                                                                    ຫຼວງນໍ້າທາ</option>
                                                                <option value="ບໍ່ແກ້ວ"
                                                                    {{ $editData->born_province == 'ບໍ່ແກ້ວ' ? 'selected' : '' }}>
                                                                    ບໍ່ແກ້ວ</option>
                                                                <option value="ອຸດົມໄຊ"
                                                                    {{ $editData->born_province == 'ອຸດົມໄຊ' ? 'selected' : '' }}>
                                                                    ອຸດົມໄຊ</option>
                                                                <option value="ໄຊຍະບູລີ"
                                                                    {{ $editData->born_province == 'ໄຊຍະບູລີ' ? 'selected' : '' }}>
                                                                    ໄຊຍະບູລີ</option>
                                                                <option value="ຫົວພັນ"
                                                                    {{ $editData->born_province == 'ຫົວພັນ' ? 'selected' : '' }}>
                                                                    ຫົວພັນ</option>
                                                                <option value="ຊຽງຂວາງ"
                                                                    {{ $editData->born_province == 'ຊຽງຂວາງ' ? 'selected' : '' }}>
                                                                    ຊຽງຂວາງ</option>
                                                                <option value="ຫຼວງພະບາງ"
                                                                    {{ $editData->born_province == 'ຫຼວງພະບາງ' ? 'selected' : '' }}>
                                                                    ຫຼວງພະບາງ</option>
                                                                <option value="ໄຊສົມບູນ"
                                                                    {{ $editData->born_province == 'ໄຊສົມບູນ' ? 'selected' : '' }}>
                                                                    ໄຊສົມບູນ</option>
                                                                <option value="ວຽງຈັນ"
                                                                    {{ $editData->born_province == 'ວຽງຈັນ' ? 'selected' : '' }}>
                                                                    ວຽງຈັນ</option>
                                                                <option value="ບໍລິຄຳໄຊ"
                                                                    {{ $editData->born_province == 'ບໍລິຄຳໄຊ' ? 'selected' : '' }}>
                                                                    ບໍລິຄຳໄຊ</option>
                                                                <option value="ຄຳມ່ວນ"
                                                                    {{ $editData->born_province == 'ຄຳມ່ວນ' ? 'selected' : '' }}>
                                                                    ຄຳມ່ວນ</option>
                                                                <option value="ສະຫວັນນະເຂດ"
                                                                    {{ $editData->born_province == 'ສະຫວັນນະເຂດ' ? 'selected' : '' }}>
                                                                    ສະຫວັນນະເຂດ</option>
                                                                <option value="ສາລະວັນ"
                                                                    {{ $editData->born_province == 'ສາລະວັນ' ? 'selected' : '' }}>
                                                                    ສາລະວັນ</option>
                                                                <option value="ຈຳປາສັກ"
                                                                    {{ $editData->born_province == 'ຈຳປາສັກ' ? 'selected' : '' }}>
                                                                    ຈຳປາສັກ</option>
                                                                <option value="ເຊກອງ"
                                                                    {{ $editData->born_province == 'ເຊກອງ' ? 'selected' : '' }}>
                                                                    ເຊກອງ</option>
                                                                <option value="ອັດຕະປື"
                                                                    {{ $editData->born_province == 'ອັດຕະປື' ? 'selected' : '' }}>
                                                                    ອັດຕະປື</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="current_village">ບ້ານ (ປັດຈຸບັນ)</label>
                                                        <div>
                                                            <input name="current_village"
                                                                class="form-control @error('current_village') is-invalid @enderror"
                                                                type="text" id="current_village"
                                                                placeholder="ປ້ອນບ້ານເກີດ..."
                                                                value="{{ old('current_village', $editData->current_village) }}">
                                                            @error('current_village')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="current_district">ເມືອງ (ປັດຈຸບັນ)</label>
                                                        <div>
                                                            <input name="current_district"
                                                                class="form-control @error('current_district') is-invalid @enderror"
                                                                type="text" id="current_district"
                                                                placeholder="ປ້ອນເມືອງເກີດ..."
                                                                value="{{ old('current_district', $editData->current_district) }}">
                                                            @error('current_district')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="current_province">ແຂວງ (ປັດຈຸບັນ)</label>
                                                        <div>
                                                            <select id="current_province" name="current_province"
                                                                class="form-control">
                                                                <option value="ນະຄອນຫຼວງວຽງຈັນ"
                                                                    {{ $editData->born == 'ນະຄອນຫຼວງວຽງຈັນ' ? 'selected' : '' }}>
                                                                    ນະຄອນຫຼວງວຽງຈັນ</option>
                                                                <option value="ຜົ້ງສາລີ"
                                                                    {{ $editData->current_province == 'ຜົ້ງສາລີ' ? 'selected' : '' }}>
                                                                    ຜົ້ງສາລີ</option>
                                                                <option value="ຫຼວງນໍ້າທາ"
                                                                    {{ $editData->current_province == 'ຫຼວງນໍ້າທາ' ? 'selected' : '' }}>
                                                                    ຫຼວງນໍ້າທາ</option>
                                                                <option value="ບໍ່ແກ້ວ"
                                                                    {{ $editData->current_province == 'ບໍ່ແກ້ວ' ? 'selected' : '' }}>
                                                                    ບໍ່ແກ້ວ</option>
                                                                <option value="ອຸດົມໄຊ"
                                                                    {{ $editData->current_province == 'ອຸດົມໄຊ' ? 'selected' : '' }}>
                                                                    ອຸດົມໄຊ</option>
                                                                <option value="ໄຊຍະບູລີ"
                                                                    {{ $editData->current_province == 'ໄຊຍະບູລີ' ? 'selected' : '' }}>
                                                                    ໄຊຍະບູລີ</option>
                                                                <option value="ຫົວພັນ"
                                                                    {{ $editData->current_province == 'ຫົວພັນ' ? 'selected' : '' }}>
                                                                    ຫົວພັນ</option>
                                                                <option value="ຊຽງຂວາງ"
                                                                    {{ $editData->current_province == 'ຊຽງຂວາງ' ? 'selected' : '' }}>
                                                                    ຊຽງຂວາງ</option>
                                                                <option value="ຫຼວງພະບາງ"
                                                                    {{ $editData->current_province == 'ຫຼວງພະບາງ' ? 'selected' : '' }}>
                                                                    ຫຼວງພະບາງ</option>
                                                                <option value="ໄຊສົມບູນ"
                                                                    {{ $editData->current_province == 'ໄຊສົມບູນ' ? 'selected' : '' }}>
                                                                    ໄຊສົມບູນ</option>
                                                                <option value="ວຽງຈັນ"
                                                                    {{ $editData->current_province == 'ວຽງຈັນ' ? 'selected' : '' }}>
                                                                    ວຽງຈັນ</option>
                                                                <option value="ບໍລິຄຳໄຊ"
                                                                    {{ $editData->current_province == 'ບໍລິຄຳໄຊ' ? 'selected' : '' }}>
                                                                    ບໍລິຄຳໄຊ</option>
                                                                <option value="ຄຳມ່ວນ"
                                                                    {{ $editData->current_province == 'ຄຳມ່ວນ' ? 'selected' : '' }}>
                                                                    ຄຳມ່ວນ</option>
                                                                <option value="ສະຫວັນນະເຂດ"
                                                                    {{ $editData->current_province == 'ສະຫວັນນະເຂດ' ? 'selected' : '' }}>
                                                                    ສະຫວັນນະເຂດ</option>
                                                                <option value="ສາລະວັນ"
                                                                    {{ $editData->current_province == 'ສາລະວັນ' ? 'selected' : '' }}>
                                                                    ສາລະວັນ</option>
                                                                <option value="ຈຳປາສັກ"
                                                                    {{ $editData->current_province == 'ຈຳປາສັກ' ? 'selected' : '' }}>
                                                                    ຈຳປາສັກ</option>
                                                                <option value="ເຊກອງ"
                                                                    {{ $editData->current_province == 'ເຊກອງ' ? 'selected' : '' }}>
                                                                    ເຊກອງ</option>
                                                                <option value="ອັດຕະປື"
                                                                    {{ $editData->current_province == 'ອັດຕະປື' ? 'selected' : '' }}>
                                                                    ອັດຕະປື</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- ----------------- ປະຫວັດການສຶກສາຜ່ານມາ ---------------- --}}
                                                <div class="col-12 mt-5">
                                                    <h4>ປະຫວັດການສຶກສາຜ່ານມາ</h4>
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="bd_graduated_year">ສົກຮຽນທີ່ຈົບການສຶກສາ</label>
                                                        <div>
                                                            <input name="bd_graduated_year"
                                                                class="form-control @error('bd_graduated_year') is-invalid @enderror"
                                                                type="text" id="bd_graduated_year"
                                                                placeholder="ເຊັ່ນ: 2015-2016..."
                                                                value="{{ old('bd_graduated_year', $editData->bd_graduated_year) }}">
                                                            @error('bd_graduated_year')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="bd_academy">ຈົບຈາກສະຖາບັນການສຶກສາ</label>
                                                        <div>
                                                            <input name="bd_academy"
                                                                class="form-control @error('bd_academy') is-invalid @enderror"
                                                                type="text" id="bd_academy"
                                                                placeholder="ປ້ອນຊື່ສະຖາບັນ..."
                                                                value="{{ old('bd_academy', $editData->bd_academy) }}">
                                                            @error('bd_academy')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="bd_major">ສາຂາທີ່ຈົບ</label>
                                                        <div>
                                                            <input name="bd_major"
                                                                class="form-control @error('bd_major') is-invalid @enderror"
                                                                type="text" id="bd_major"
                                                                placeholder="ປ້ອນສາຂາທີ່ຈົບ..."
                                                                value="{{ old('bd_major', $editData->bd_major) }}">
                                                            @error('bd_major')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="bd_major">ຄະແນນສະເລ່ຍ</label>
                                                        <div>
                                                            <input name="bd_grade"
                                                                class="form-control @error('bd_grade') is-invalid @enderror"
                                                                type="text" id="bd_grade"
                                                                placeholder="ປ້ອນຄະແນນສະເລ່ຍ..."
                                                                value="{{ old('bd_grade', $editData->bd_grade) }}">
                                                            @error('bd_grade')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- ----------------- ປະຫວັດການເຮັດວຽກ ---------------- --}}
                                                <div class="col-12 mt-5">
                                                    <h4>ປະຫວັດການເຮັດວຽກ</h4>
                                                    <hr>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="working_org">ອົງກອນ</label>
                                                        <div>
                                                            <select name="working_org" id=""
                                                                class="form-control">
                                                                <option value="private"
                                                                    {{ old('working_org', $editData->working_org) == 'private' ? 'selected' : '' }}>
                                                                    ພະນັກງານເອກະຊົນ</option>
                                                                <option value="government"
                                                                    {{ old('working_org', $editData->working_org) == 'government' ? 'selected' : '' }}>
                                                                    ລັດຖະກອນ</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="working_place">ມາຈາກພາກສ່ວນ</label>
                                                        <div>
                                                            <input name="working_place"
                                                                class="form-control @error('working_place') is-invalid @enderror"
                                                                type="text" id="working_place"
                                                                placeholder="ປ້ອນພາກສ່ວນ..."
                                                                value="{{ old('working_place', $editData->working_place) }}">
                                                            @error('working_place')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="working_duration">ໄລຍະເວລາຂອງການເປັນພະນັກງານ</label>
                                                        <div>
                                                            <input name="working_duration"
                                                                class="form-control @error('working_duration') is-invalid @enderror"
                                                                type="text" id="working_duration"
                                                                placeholder="ເຊັ່ນ: 2ປີ..."
                                                                value="{{ old('working_duration', $editData->working_duration) }}">
                                                            @error('working_duration')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-lg" type="submit"style="float: right;"><i
                                                    class="fas fa-save mr-2"></i> ບັນທຶກ</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end card-->
                        {{-- ------------------------------ ຣີເຊັດລະຫັດຜ່ານ ------------------------------ --}}
                        <div class="card">
                            <div class="card-body">
                                <a data-toggle="collapse" href="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    <h4 class="header-title"><i class="fas fa-lock-open mr-2"></i>ຣີເຊັດລະຫັດຜ່ານ</h4>
                                </a>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body mt-3 mb-0">
                                        <form action="{{ route('student.resetPwd', $editData->user->id) }}"
                                            method="post">
                                            @csrf
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="myInput" name="password">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <input class="mt-3" type="checkbox" onclick="myFunction()"> ສະແດງລະຫັດຜ່ານ
                                            <button class="d-block btn btn-primary btn-lg mt-3" type="submit"><i
                                                    class="fas fa-save mr-2"></i>ບັນທຶກ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
