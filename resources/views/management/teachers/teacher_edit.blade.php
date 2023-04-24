@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ເພີ່ມນັກອາຈານ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຜູ້ໃຊ້ງານລະບົບ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('teachers.view') }}">ອາຈານ</a></li>
                            <li class="breadcrumb-item active">ເພີ່ມນັກອາຈານ</li>
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
                                    <a href="{{ route('teacher.detail', $editData->id) }}"
                                        class="btn btn-light btn-rounded btn-sm mb-1"><i class="fas fa-arrow-left"></i>
                                        ກັບຄືນ</a>
                                    <hr>
                                </div>
                                <form method="post" action="{{ route('teacher.update', $editData->user->id) }}"
                                    class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
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
                                                                <label for="fname_lo">ຊື່ແທ້ ພາສາລາວ</label>
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
                                                                <label for="username">ຊື່ຜູ້ໃຊ້ (Username)</label>
                                                                <div>
                                                                    <input id="username" name="username"
                                                                        class="form-control @error('username') is-invalid @enderror"
                                                                        type="text" placeholder="ປ້ອນຊື່ຜູ້ໃຊ້..."
                                                                        value="{{ old('username', $editData->user->username) }}">
                                                                    @error('username')
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
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>ປະຈຳສາຂາວິຊາ</label>
                                                                <div>
                                                                    <select name="major" class="form-control mb-2">
                                                                        @foreach ($major as $item)
                                                                            <option value="{{ $item->id }}"
                                                                                {{ $item->id == $editData->major_id ? 'selected' : '' }}>
                                                                                {{ $item->major }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fname_en">ຕຳແໜ່ງ</label>
                                                                <div>
                                                                    <input name="position"
                                                                        class="form-control @error('position') is-invalid @enderror"
                                                                        type="text" id="position"
                                                                        placeholder="ປ້ອນຕຳແໜ່ງ..."
                                                                        value="{{ old('position', $editData->position) }}">
                                                                    @error('position')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>ສະຖານະ</label>
                                                                <span
                                                                    class="badge badge-success {{ $editData->user->status == 'active' ? 'badge-success' : 'badge-danger' }}">{{ $editData->user->status == 'active' ? 'ເປີດໃຊ້ງານ' : 'ປິດໃຊ້ງານ' }}</span>
                                                                <div>
                                                                    <select name="status" class="form-control mb-2">
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
                                                                <label for="fname_en">ເບີໂທລະສັບ</label>
                                                                <div>
                                                                    <input name="phone"
                                                                        class="form-control @error('phone') is-invalid @enderror"
                                                                        type="number" id="phone"
                                                                        placeholder="ປ້ອນເບີໂທລະສັບ..."
                                                                        value="{{ old('phone', $editData->phone) }}">
                                                                    @error('position')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">ອີເມວ<span
                                                                        class="text-danger">*</span></label>
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
                                                            <input type="hidden" name="role" value="teacher">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-lg" type="submit" style="float: right;"><i
                                            class="fas fa-save mr-2"></i> ບັນທຶກ</button>
                                </form>
                            </div>
                        </div>
                        {{-- ------------------------------ ຣີເຊັດລະຫັດຜ່ານ ------------------------------ --}}
                        <div class="card">
                            <div class="card-body">
                                <a data-toggle="collapse" href="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    <h4 class="header-title"><i class="fas fa-lock-open mr-2"></i>ຣີເຊັດລະຫັດຜ່ານ</h4>
                                </a>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body mt-3 mb-0">
                                        <form action="{{ route('teacher.resetPwd', $editData->user->id) }}"
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
