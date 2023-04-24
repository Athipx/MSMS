@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ແກ້ໄຂຂໍ້ມູນອາຈານ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ຜູ້ໃຊ້ງານລະບົບ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('teachers.view') }}">ອາຈານ</a></li>
                            <li class="breadcrumb-item active">ແກ້ໄຂຂໍ້ມູນອາຈານ</li>
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
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="post" action="{{ route('teacher.update', $editData->user->id) }}"
                                    class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        {{-- <input type="hidden" name="id" value="{{ $editData->user->id }}"> --}}
                                        <input class="form-control mb-2" type="text" name="fname_lo"
                                            placeholder="Lao first name"
                                            value="{{ old('fname_lo', $editData->user->fname_lo) }}">
                                        <input class="form-control mb-2" type="text" name="lname_lo"
                                            placeholder="Lao last name"
                                            value="{{ old('lname_lo', $editData->user->lname_lo) }}">
                                        <input class="form-control mb-2" type="text" name="fname_en"
                                            placeholder="English first name"
                                            value="{{ old('fname_en', $editData->user->fname_en) }}">
                                        <input class="form-control mb-2" type="text" name="lname_en"
                                            placeholder="English last name"
                                            value="{{ old('lname_en', $editData->user->lname_en) }}">
                                        <input class="form-control mb-2" type="text" name="username"
                                            placeholder="username" value="{{ old('username', $editData->user->username) }}">
                                        <select name="major" class="form-control mb-2">
                                            @foreach ($major as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $editData->major_id ? 'selected' : '' }}>
                                                    {{ $item->major }}</option>
                                            @endforeach
                                        </select>
                                        <select name="status" class="form-control mb-2">
                                            <option value="active"
                                                {{ old('status', $editData->user->status) == 'active' ? 'selected' : '' }}>
                                                active</option>
                                            <option value="inactive"
                                                {{ old('status', $editData->user->status) == 'inactive' ? 'selected' : '' }}>
                                                inactive</option>
                                        </select>
                                        <input class="form-control mb-2" type="text" name="position"
                                            placeholder="position" value="{{ old('position', $editData->position) }}">
                                        <input class="form-control mb-2" type="number" name="phone" placeholder="phone"
                                            value="{{ old('phone', $editData->phone) }}">
                                        <input class="form-control mb-2" type="email" name="email" placeholder="email"
                                            value="{{ old('email', $editData->user->email) }}">
                                        <input type="hidden" name="role" value="teacher">
                                        <button class="btn btn-primary" type="submit">Update</button>
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
@endsection
