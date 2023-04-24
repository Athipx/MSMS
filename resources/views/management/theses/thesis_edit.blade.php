@extends('layouts.master')

@section('content')

    @php
        $gender = ['male' => 'ທ້າວ', 'female' => 'ນາງ'];
    @endphp

    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ເພີ່ມຂໍ້ມູນວິທະຍານິພົນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ວິທະຍານິພົນ</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('theses.view') }}">ບັນດາວິທະຍານິພົນ</a></li>
                            <li class="breadcrumb-item active">ເພີ່ມຂໍ້ມູນວິທະຍານິພົນ</li>
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
                                    <div class="alert alert-danger alert-dismissible fade show mb-3 pl-5" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (session()->has('jsAlert'))
                                    <script>
                                        alert({{ session()->get('jsAlert') }});
                                    </script>
                                @endif
                                <form action="{{ route('thesis.update', $editData->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">ສາຂາວິຊາ</label>
                                                <select name="major" id="major_id" class="form-control">
                                                    <option value="">-- ເລືອກ ສາຂາວິຊາ --</option>
                                                    @foreach ($majors as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if (old('major', $editData->major_id) == $item->id) selected @endif>
                                                            {{ $item->major }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">ຮຸ່ນການສຶກສາ</label>
                                                <select name="gen" id="gen_id" class="form-control">
                                                    <option value="">-- ເລືອກ ຮຸ່ນການສຶກສາ --</option>
                                                    @foreach ($gens as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if (old('gen', $editData->gen_id) == $item->id) selected @endif>
                                                            {{ $item->gen }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">ນັກສຶກສາ <span
                                                        class="ml-3 badge-info px-2 rounded">{{ $gender[$editData->student->gender] }}.
                                                        {{ $editData->student->user->fname_lo }}
                                                        {{ $editData->student->user->lname_lo }}</span></label>
                                                <input type="hidden" name="old_student"
                                                    value="{{ $editData->student_id }}">
                                                <select name="student" id="student_id" class="form-control">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="title_lo">ຊື່ຫົວບົດ (ລາວ)</label>
                                                <input name="title_lo" type="text"
                                                    class="form-control @error('title_lo') is-invalid @enderror"
                                                    placeholder="ປ້ອນຊື່ຫົວບົດ ພາສາລາວ..."
                                                    value="{{ old('title_lo', $editData->title_lo) }}">
                                                @error('title_lo')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">ຊື່ຫົວບົດ (English)</label>
                                                <input name="title_en" type="text"
                                                    class="form-control @error('title_en') is-invalid @enderror"
                                                    placeholder="ປ້ອນຊື່ຫົວບົດ ພາສາອັງກິດ..."
                                                    value="{{ old('title_en', $editData->title_en) }}">
                                                @error('title_en')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="main_adviser">ອາຈານທີ່ປຶກສາຫຼັກ</label>
                                                <select name="main_adviser" id="main_adviser" class="form-control">
                                                    <option value="">-- ເລືອກ ອາຈານທີ່ປຶກສາຫຼັກ --</option>
                                                    @foreach ($teachers as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if (old('main_adviser', $editData->teacher_id) == $item->id) selected @endif>
                                                            {{ $item->user->fname_lo }} <span
                                                                class="ml-2">{{ $item->user->lname_lo }}</span></option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="co_adviser">ອາຈານທີ່ປຶກສາຮ່ວມ (ຖ້າມີ)</label>
                                                <select name="co_adviser[]" class="selectize" multiple
                                                    style="border-radius: 10px;">
                                                    @foreach ($teachers as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if (in_array($item->id, $selectedTeacherIds)) selected @endif>
                                                            {{ $item->user->fname_lo }} {{ $item->user->lname_lo }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">ສະຖານະ</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="in_progress"
                                                        @if (old('status', $editData->status) == 'in_progress') selected @endif>ກຳລັງດຳເນີນການ
                                                    </option>
                                                    <option value="pass"
                                                        @if (old('status', $editData->status) == 'pass') selected @endif>ຜ່ານ</option>
                                                    <option value="not_pass"
                                                        @if (old('status', $editData->status) == 'not_pass') selected @endif>ບໍ່ຜ່ານ</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">ລາຍລະອຽດ</label>
                                                <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <button class="btn btn-primary btn-lg float-right" type="submit"><i
                                            class="fas fa-save mr-2"></i>ບັນທຶກ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
    {{-- <script>
        $('#filter-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $('#filter-form').serialize();
            // console.log(formData);
            $.ajax({
                url: "{{ route('thesis.getStudents') }}",
                type: 'GET',
                data: formData,
                success: function(response) {
                    var html = response.filterResults;
                    $('#result').html(response);
                    // console.log(response);
                }
            });
        });
    </script> --}}
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#gen_id, #major_id', function() {
                var gen_id = $('#gen_id').val();
                var major_id = $('#major_id').val();
                $.ajax({
                    url: "{{ route('thesis.getStudents') }}",
                    type: "GET",
                    data: {
                        gen: gen_id,
                        major: major_id
                    },
                    success: function(data) {
                        var html = '<option value="">-- ເລືອກ ນັກສຶກສາ --</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.id + '">' + v.user.fname_lo +
                                '&nbsp;&nbsp;' + v.user.lname_lo + '</option>';
                        });
                        //
                        $('#student_id').html(html);
                    }
                });
            });
        });
    </script>
@endsection
