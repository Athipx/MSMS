@extends('management.students.students_add')

@section('form')
    <form method="post" action="{{ route('create-student.storeStep1') }}" class="needs-validation" novalidate=""
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="row">
                    <div class="col-md-3" style="display:flex; flex-direction: row; justify-content: center;">
                        <div class="rounded-circle" id="image_preview"></div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_id">ລະຫັດນັກສຶກສາ</label>
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
                                            value="{{ old('fname_lo', $data['fname_lo']) }}">
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
                                            value="{{ old('lname_lo', $data['lname_lo']) }}">
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
                                            value="{{ old('fname_en', $data['fname_en']) }}">
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
                                            value="{{ old('lname_en', $data['lname_en']) }}">
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
                                            placeholder="ປ້ອນຊື່ຜູ້ໃຊ້..."
                                            value="{{ old('username', $data['username']) }}">
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
                                    <label>ຮຸ່ນການສຶກສາ</label>
                                    <div>
                                        <select id="gen" name="gen" class="form-control">
                                            @foreach ($gen as $key)
                                                <option value="{{ $key->id }}"
                                                    @if (old('gen') == $key->id) selected @endif>
                                                    {{ $key->gen }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>ສາຂາວິຊາ</label>
                                    <div>
                                        <select id="major" name="major" class="form-control">
                                            @foreach ($major as $key)
                                                <option value="{{ $key->id }}"
                                                    @if (old('major') == $key->id) selected @endif>{{ $key->major }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>ສະຖານະການໃຊ້ງານບັນຊີ</label>
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
                                            placeholder="ປ້ອນອີເມວ..." value="{{ old('email', $data['email']) }}">
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
        <button class="btn btn-primary btn-lg" type="submit" style="float: right;">
            ຖັດໄປ <i class="fas fa-arrow-right ml-2"></i></button>
    </form>
@endsection
