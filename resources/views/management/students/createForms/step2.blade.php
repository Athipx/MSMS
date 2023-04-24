@extends('management.students.students_add')

@section('form')
    <form method="post" action="" class="needs-validation" novalidate="" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 mb-3">
                <h5>ລາຍລະອຽດນັກສຶກສາ</h5>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname_lo">ລະຫັດນັກສຶກສາ</label>
                                    <div>
                                        <input name="student_id"
                                            class="form-control @error('student_id') is-invalid @enderror" type="text"
                                            id="student_id" placeholder="ປ້ອນລະຫັດນັກສຶກສາ..."
                                            value="{{ old('student_id') }}">
                                        @error('student_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fname_lo">ຊື່ແທ້ ພາສາລາວ</label>
                                    <div>
                                        <input name="fname_lo" class="form-control @error('fname_lo') is-invalid @enderror"
                                            type="text" id="fname_lo" placeholder="ປ້ອນຊື່ແທ້..."
                                            value="{{ old('fname_lo') }}">
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
                                        <input name="lname_lo" class="form-control @error('lname_lo') is-invalid @enderror"
                                            type="text" id="lname_lo" placeholder="ປ້ອນຊື່ແທ້..."
                                            value="{{ old('lname_lo') }}">
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
                                        <input name="fname_en" class="form-control @error('fname_en') is-invalid @enderror"
                                            type="text" id="fname_en" placeholder="ປ້ອນຊື່ແທ້..."
                                            value="{{ old('fname_en') }}">
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
                                        <input name="lname_en" class="form-control @error('lname_en') is-invalid @enderror"
                                            type="text" id="lname_en" placeholder="ປ້ອນຊື່ແທ້..."
                                            value="{{ old('lname_en') }}">
                                        @error('lname_en')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="username">ຊື່ຜູ້ໃຊ້ (Username)</label>
                                    <div>
                                        <input id="username" name="username"
                                            class="form-control @error('username') is-invalid @enderror" type="text"
                                            placeholder="ປ້ອນຊື່ຜູ້ໃຊ້..." value="{{ old('username') }}">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ສິດທິ</label>
                                    <div>
                                        <select id="role" name="role" class="form-control">
                                            <option value="admin" @if (old('role') == 'admin') selected @endif>
                                                ຜູ້ຄຸ້ມຄອງລະບົບ</option>
                                            <option value="coordinator" @if (old('role') == 'coordinator') selected @endif>
                                                ຜູ້ປະສານງານ</option>
                                            <option value="headUnit" @if (old('role') == 'headUnit') selected @endif>
                                                ຫົວໜ້າໜ່ວຍວິຊາ</option>
                                            <option value="headDept" @if (old('role') == 'headDept') selected @endif>
                                                ຫົວໜ້າພາກວິຊາ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>ສະຖານະ</label>
                                    <div>
                                        <select id="status" name="status" class="form-control">
                                            <option value="active" @if (old('status') == 'active') selected @endif>
                                                ເປີດໃຊ້ງານ</option>
                                            <option value="inactive" @if (old('status') == 'inactive') selected @endif>
                                                ປິດໃຊ້ງານ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">ອີເມວ</label>
                                    <div>
                                        <input id="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror" type="email"
                                            placeholder="ປ້ອນອີເມວ..." value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">ລະຫັດຜ່ານ</label>
                                    <div style="position: relative;">
                                        <input name="password" class="form-control  @error('email') is-invalid @enderror"
                                            type="password" placeholder="ປ້ອນລະຫັດຜ່ານ..." id="password">
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
        <div class="d-flex justify-content-between">
            <button class="btn btn-secondary btn-lg" type="button"
                onclick="window.location='{{ route('create-student.step1') }}'"><i class="fas fa-arrow-left mr-2"></i>
                ກັບຄືນ</button>
            <button class="btn btn-primary btn-lg" type="submit"><i class="fas fa-save mr-2"></i>
                ບັນທຶກ</button>
        </div>
    </form>
@endsection
