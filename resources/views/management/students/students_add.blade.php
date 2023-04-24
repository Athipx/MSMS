@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ເພີ່ມນັກສຶກສາ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຜູ້ໃຊ້ງານລະບົບ</a></li>
                            <li class="breadcrumb-item active">ເພີ່ມນັກສຶກສາ</li>
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
                                <a href="#" class="btn btn-light btn-rounded btn-sm mb-1"
                                    onclick="window.history.back();">
                                    <i class="fas fa-arrow-left mr-2"></i>ກັບຄືນ
                                </a>
                                <hr>
                                <form method="post" action="{{ route('students.store') }}" class="needs-validation"
                                    novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-justified nav-tabs-custom" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#custom-home" role="tab"
                                                aria-selected="false">
                                                <span class="d-none d-md-inline-block">ຂໍ້ມູນບັນຊີນັກສຶກສາ</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#custom-profile"
                                                role="tab"aria-selected="true">
                                                <span class="d-none d-md-inline-block">ລາຍລະອຽດນັກສຶກສາ</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content p-3">
                                        <div class="tab-pane active" id="custom-home" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="row">
                                                        <div class="col-md-3"
                                                            style="display:flex; flex-direction: row; justify-content: center;">
                                                            <div class="rounded-circle" id="image_preview"></div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="student_id">ລະຫັດນັກສຶກສາ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <input name="student_id"
                                                                                class="form-control @error('student_id') is-invalid @enderror"
                                                                                type="text" id="student_id"
                                                                                placeholder="ປ້ອນລະຫັດນັກສຶກສາ..."
                                                                                value="{{ old('student_id') }}">
                                                                            @error('student_id')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="fname_lo">ຊື່ແທ້
                                                                            ພາສາລາວ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <input name="fname_lo"
                                                                                class="form-control @error('fname_lo') is-invalid @enderror"
                                                                                type="text" id="fname_lo"
                                                                                placeholder="ປ້ອນຊື່ແທ້..."
                                                                                value="{{ old('fname_lo') }}">
                                                                            @error('fname_lo')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="lname_lo">ນາມສະກຸນ ພາສາລາວ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <input name="lname_lo"
                                                                                class="form-control @error('lname_lo') is-invalid @enderror"
                                                                                type="text" id="lname_lo"
                                                                                placeholder="ປ້ອນຊື່ແທ້..."
                                                                                value="{{ old('lname_lo') }}">
                                                                            @error('lname_lo')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="fname_en">ຊື່ແທ້ ພາສາອັງກິດ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <input name="fname_en"
                                                                                class="form-control @error('fname_en') is-invalid @enderror"
                                                                                type="text" id="fname_en"
                                                                                placeholder="ປ້ອນຊື່ແທ້..."
                                                                                value="{{ old('fname_en') }}">
                                                                            @error('fname_en')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="lname_en">ນາມສະກຸນ ພາສາອັງກິດ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <input name="lname_en"
                                                                                class="form-control @error('lname_en') is-invalid @enderror"
                                                                                type="text" id="lname_en"
                                                                                placeholder="ປ້ອນຊື່ແທ້..."
                                                                                value="{{ old('lname_en') }}">
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
                                                                                value="{{ old('username') }}">
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
                                                                                    class="custom-control-input" checked>
                                                                                <label class="custom-control-label"
                                                                                    for="male">ຊາຍ</label>
                                                                            </div>
                                                                            <div
                                                                                class="custom-control custom-radio custom-control-inline">
                                                                                <input value="female" type="radio"
                                                                                    id="female"
                                                                                    name="gender"class="custom-control-input">
                                                                                <label class="custom-control-label"
                                                                                    for="female">ຍິງ</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>ຮຸ່ນການສຶກສາ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <select id="gen" name="gen"
                                                                                class="form-control">
                                                                                @foreach ($gen as $key)
                                                                                    <option value="{{ $key->id }}">
                                                                                        {{ $key->gen }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>ສາຂາວິຊາ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <select id="major" name="major"
                                                                                class="form-control">
                                                                                @foreach ($major as $key)
                                                                                    <option value="{{ $key->id }}"
                                                                                        @if (old('major') == $key->id) selected @endif>
                                                                                        {{ $key->major }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>ວັນ, ເດືອນ, ປີເຂົ້າເປັນນັກສຶກສາ</label>
                                                                        <div class="" style="position: relative;">
                                                                            <input name="begin_date" type="text"
                                                                                class="form-control datepicker-here"
                                                                                data-language="en"
                                                                                placeholder="ເລືອກວັນທີ...">
                                                                            <i class="fas fa-calendar-alt"
                                                                                style="position:absolute; right:3%; top:35%;"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>ວັນ, ເດືອນ, ປີສຳເລັດການສຶກສາ</label>
                                                                        <div style="position: relative;">
                                                                            <input name="graduated_date" type="text"
                                                                                class="form-control datepicker-here"
                                                                                data-language="en"
                                                                                placeholder="ເລືອກວັນທີ...">
                                                                            <i class="fas fa-calendar-alt"
                                                                                style="position:absolute; right:3%; top:35%;"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>ສະຖານະບັນຊີໃຊ້ງານ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <select id="status" name="status"
                                                                                class="form-control">
                                                                                <option value="active"
                                                                                    @if (old('status') == 'active') selected @endif>
                                                                                    ເປີດໃຊ້ງານ</option>
                                                                                <option value="inactive"
                                                                                    @if (old('status') == 'inactive') selected @endif>
                                                                                    ປິດໃຊ້ງານ</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>ສະຖານະພາບການສຶກສາ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <select id="student_status"
                                                                                name="student_status"
                                                                                class="form-control">
                                                                                <option value="pending"
                                                                                    {{ old('student_status') == 'pending' ? 'selected' : '' }}>
                                                                                    ລໍຖ້າອະນຸມັດ
                                                                                </option>
                                                                                <option value="studying"
                                                                                    {{ old('student_status') == 'studying' ? 'selected' : '' }}>
                                                                                    ກຳລັງສຶກສາ
                                                                                </option>
                                                                                <option value="graduated"
                                                                                    {{ old('student_status') == 'graduated' ? 'selected' : '' }}>
                                                                                    ສຳເລັດການສຶກສາ
                                                                                </option>
                                                                                <option value="drop"
                                                                                    {{ old('student_status') == 'drop' ? 'selected' : '' }}>
                                                                                    ຢຸດຕິຊົ່ວຄາວ
                                                                                </option>
                                                                                <option value="quit"
                                                                                    {{ old('student_status') == 'quit' ? 'selected' : '' }}>
                                                                                    ໂຈະການສຶກສາ</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email">ອີເມວ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div>
                                                                            <input id="email" name="email"
                                                                                class="form-control @error('email') is-invalid @enderror"
                                                                                type="email" placeholder="ປ້ອນອີເມວ..."
                                                                                value="{{ old('email') }}">
                                                                            @error('email')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="password">ລະຫັດຜ່ານ<span
                                                                                class="text-danger">*</span></label>
                                                                        <div style="position: relative;">
                                                                            <input name="password"
                                                                                class="form-control  @error('email') is-invalid @enderror"
                                                                                type="password"
                                                                                placeholder="ປ້ອນລະຫັດຜ່ານ..."
                                                                                id="password">
                                                                            <i class="fas fa-eye" id="togglePassword"
                                                                                style="position:absolute; right:3%; top:35%; cursor: pointer;"></i>
                                                                            @error('password')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>ຮູບໂປຣໄຟລ</label>
                                                                        <div>
                                                                            <div>
                                                                                <input name="profile"
                                                                                    class="form-control @error('profile') is-invalid @enderror"
                                                                                    type="file" id="profile_image">
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
                                        </div>
                                        <div class="tab-pane" id="custom-profile" role="tabpanel">
                                            <div class="row">
                                                {{-- ----------------- ປະຫວັດນັກສຶກສາ ---------------- --}}
                                                <div class="col-12">
                                                    <h4>ປະຫວັດນັກສຶກສາ</h4>
                                                    <hr>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>ວັນ, ເດືອນ, ປີເກີດ</label>
                                                        {{-- <input name="dob" type="text"
                                                            class="form-control datepicker-here" data-language="en"
                                                            placeholder="ເລືອກວັນທີ..."> --}}
                                                        <div style="position: relative;">
                                                            <input name="dob" type="text"
                                                                class="form-control datepicker-here" data-language="en"
                                                                placeholder="ເລືອກວັນທີ...">
                                                            <i class="fas fa-calendar-alt"
                                                                style="position:absolute; right:3%; top:35%;"></i>
                                                        </div>
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
                                                                value="{{ old('phone') }}">
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
                                                                value="{{ old('born_village') }}">
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
                                                                value="{{ old('born_district') }}">
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
                                                                    {{ old('born_province') == 'ນະຄອນຫຼວງວຽງຈັນ' ? 'selected' : '' }}>
                                                                    ນະຄອນຫຼວງວຽງຈັນ</option>
                                                                <option value="ຜົ້ງສາລີ"
                                                                    {{ old('born_province') == 'ຜົ້ງສາລີ' ? 'selected' : '' }}>
                                                                    ຜົ້ງສາລີ</option>
                                                                <option value="ຫຼວງນໍ້າທາ"
                                                                    {{ old('born_province') == 'ຫຼວງນໍ້າທາ' ? 'selected' : '' }}>
                                                                    ຫຼວງນໍ້າທາ</option>
                                                                <option value="ບໍ່ແກ້ວ"
                                                                    {{ old('born_province') == 'ບໍ່ແກ້ວ' ? 'selected' : '' }}>
                                                                    ບໍ່ແກ້ວ</option>
                                                                <option value="ອຸດົມໄຊ"
                                                                    {{ old('born_province') == 'ອຸດົມໄຊ' ? 'selected' : '' }}>
                                                                    ອຸດົມໄຊ</option>
                                                                <option value="ໄຊຍະບູລີ"
                                                                    {{ old('born_province') == 'ໄຊຍະບູລີ' ? 'selected' : '' }}>
                                                                    ໄຊຍະບູລີ</option>
                                                                <option value="ຫົວພັນ"
                                                                    {{ old('born_province') == 'ຫົວພັນ' ? 'selected' : '' }}>
                                                                    ຫົວພັນ</option>
                                                                <option value="ຊຽງຂວາງ"
                                                                    {{ old('born_province') == 'ຊຽງຂວາງ' ? 'selected' : '' }}>
                                                                    ຊຽງຂວາງ</option>
                                                                <option value="ຫຼວງພະບາງ"
                                                                    {{ old('born_province') == 'ຫຼວງພະບາງ' ? 'selected' : '' }}>
                                                                    ຫຼວງພະບາງ</option>
                                                                <option value="ໄຊສົມບູນ"
                                                                    {{ old('born_province') == 'ໄຊສົມບູນ' ? 'selected' : '' }}>
                                                                    ໄຊສົມບູນ</option>
                                                                <option value="ວຽງຈັນ"
                                                                    {{ old('born_province') == 'ວຽງຈັນ' ? 'selected' : '' }}>
                                                                    ວຽງຈັນ</option>
                                                                <option value="ບໍລິຄຳໄຊ"
                                                                    {{ old('born_province') == 'ບໍລິຄຳໄຊ' ? 'selected' : '' }}>
                                                                    ບໍລິຄຳໄຊ</option>
                                                                <option value="ຄຳມ່ວນ"
                                                                    {{ old('born_province') == 'ຄຳມ່ວນ' ? 'selected' : '' }}>
                                                                    ຄຳມ່ວນ</option>
                                                                <option value="ສະຫວັນນະເຂດ"
                                                                    {{ old('born_province') == 'ສະຫວັນນະເຂດ' ? 'selected' : '' }}>
                                                                    ສະຫວັນນະເຂດ</option>
                                                                <option value="ສາລະວັນ"
                                                                    {{ old('born_province') == 'ສາລະວັນ' ? 'selected' : '' }}>
                                                                    ສາລະວັນ</option>
                                                                <option value="ຈຳປາສັກ"
                                                                    {{ old('born_province') == 'ຈຳປາສັກ' ? 'selected' : '' }}>
                                                                    ຈຳປາສັກ</option>
                                                                <option value="ເຊກອງ"
                                                                    {{ old('born_province') == 'ເຊກອງ' ? 'selected' : '' }}>
                                                                    ເຊກອງ</option>
                                                                <option value="ອັດຕະປື"
                                                                    {{ old('born_province') == 'ອັດຕະປື' ? 'selected' : '' }}>
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
                                                                value="{{ old('current_village') }}">
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
                                                                value="{{ old('current_district') }}">
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
                                                                    {{ old('current_province') == 'ນະຄອນຫຼວງວຽງຈັນ' ? 'selected' : '' }}>
                                                                    ນະຄອນຫຼວງວຽງຈັນ</option>
                                                                <option value="ຜົ້ງສາລີ"
                                                                    {{ old('current_province') == 'ຜົ້ງສາລີ' ? 'selected' : '' }}>
                                                                    ຜົ້ງສາລີ</option>
                                                                <option value="ຫຼວງນໍ້າທາ"
                                                                    {{ old('current_province') == 'ຫຼວງນໍ້າທາ' ? 'selected' : '' }}>
                                                                    ຫຼວງນໍ້າທາ</option>
                                                                <option value="ບໍ່ແກ້ວ"
                                                                    {{ old('current_province') == 'ບໍ່ແກ້ວ' ? 'selected' : '' }}>
                                                                    ບໍ່ແກ້ວ</option>
                                                                <option value="ອຸດົມໄຊ"
                                                                    {{ old('current_province') == 'ອຸດົມໄຊ' ? 'selected' : '' }}>
                                                                    ອຸດົມໄຊ</option>
                                                                <option value="ໄຊຍະບູລີ"
                                                                    {{ old('current_province') == 'ໄຊຍະບູລີ' ? 'selected' : '' }}>
                                                                    ໄຊຍະບູລີ</option>
                                                                <option value="ຫົວພັນ"
                                                                    {{ old('current_province') == 'ຫົວພັນ' ? 'selected' : '' }}>
                                                                    ຫົວພັນ</option>
                                                                <option value="ຊຽງຂວາງ"
                                                                    {{ old('current_province') == 'ຊຽງຂວາງ' ? 'selected' : '' }}>
                                                                    ຊຽງຂວາງ</option>
                                                                <option value="ຫຼວງພະບາງ"
                                                                    {{ old('current_province') == 'ຫຼວງພະບາງ' ? 'selected' : '' }}>
                                                                    ຫຼວງພະບາງ</option>
                                                                <option value="ໄຊສົມບູນ"
                                                                    {{ old('current_province') == 'ໄຊສົມບູນ' ? 'selected' : '' }}>
                                                                    ໄຊສົມບູນ</option>
                                                                <option value="ວຽງຈັນ"
                                                                    {{ old('current_province') == 'ວຽງຈັນ' ? 'selected' : '' }}>
                                                                    ວຽງຈັນ</option>
                                                                <option value="ບໍລິຄຳໄຊ"
                                                                    {{ old('current_province') == 'ບໍລິຄຳໄຊ' ? 'selected' : '' }}>
                                                                    ບໍລິຄຳໄຊ</option>
                                                                <option value="ຄຳມ່ວນ"
                                                                    {{ old('current_province') == 'ຄຳມ່ວນ' ? 'selected' : '' }}>
                                                                    ຄຳມ່ວນ</option>
                                                                <option value="ສະຫວັນນະເຂດ"
                                                                    {{ old('current_province') == 'ສະຫວັນນະເຂດ' ? 'selected' : '' }}>
                                                                    ສະຫວັນນະເຂດ</option>
                                                                <option value="ສາລະວັນ"
                                                                    {{ old('current_province') == 'ສາລະວັນ' ? 'selected' : '' }}>
                                                                    ສາລະວັນ</option>
                                                                <option value="ຈຳປາສັກ"
                                                                    {{ old('current_province') == 'ຈຳປາສັກ' ? 'selected' : '' }}>
                                                                    ຈຳປາສັກ</option>
                                                                <option value="ເຊກອງ"
                                                                    {{ old('current_province') == 'ເຊກອງ' ? 'selected' : '' }}>
                                                                    ເຊກອງ</option>
                                                                <option value="ອັດຕະປື"
                                                                    {{ old('current_province') == 'ອັດຕະປື' ? 'selected' : '' }}>
                                                                    ອັດຕະປື</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- ----------------- ປະຫວັດການສຶກສາ ---------------- --}}
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
                                                                value="{{ old('bd_graduated_year') }}">
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
                                                                value="{{ old('bd_academy') }}">
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
                                                                value="{{ old('bd_major') }}">
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
                                                                value="{{ old('bd_grade') }}">
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
                                                                    {{ old('working_org') == 'private' ? 'selected' : '' }}>
                                                                    ພະນັກງານເອກະຊົນ</option>
                                                                <option value="government"
                                                                    {{ old('working_org') == 'government' ? 'selected' : '' }}>
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
                                                                value="{{ old('working_place') }}">
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
                                                                value="{{ old('working_duration') }}">
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
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', () => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
