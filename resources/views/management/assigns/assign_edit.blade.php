@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ແກ້ໄຂຂໍ້ມູນການຮຽນ-ການສອນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ການສຶກສາ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('assigns.view') }}">ການຮຽນ-ການສອນ</a></li>
                            <li class="breadcrumb-item active">ແກ້ໄຂຂໍ້ມູນການຮຽນ-ການສອນ</li>
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
                                    <a href="{{ route('assign.detail', $editData->id) }}"
                                        class="btn btn-light btn-rounded btn-sm mb-1"><i class="fas fa-arrow-left"></i>
                                        ກັບຄືນ</a>
                                    <hr>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li style="list-style: none;">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('assign.update', $editData->id) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="major">ສາຂາວິຊາ</label>
                                                <select name="major" class="form-control" id="major_id">
                                                    <option value="">-- ເລືອກ ສາຂາວິຊາ--</option>
                                                    @foreach ($major as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ old('major', $editData->major_id) == $item->id ? 'selected' : '' }}>
                                                            {{ $item->major }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="gen">ຮຸ່ນການສຶກສາ</label>
                                                <select name="gen" class="form-control">
                                                    @foreach ($gen as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ old('gen', $editData->gen_id) == $item->id ? 'selected' : '' }}>
                                                            {{ $item->gen }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="semister">ພາກ / ເທີມການສຶກສາ</label>
                                                <select name="semister" class="form-control">
                                                    @foreach ($semister as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ old('semister', $editData->semister_id) == $item->id ? 'selected' : '' }}>
                                                            {{ $item->semister }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="teacher">ອາຈານສອນ</label>
                                                <select name="teacher[]" class="selectize" multiple
                                                    style="border-radius: 10px;">
                                                    @foreach ($teacher as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if (in_array($item->id, $selectedTeacherIds)) selected @endif>
                                                            {{ $item->user->fname_lo }} {{ $item->user->lname_lo }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="subject">ວິຊາ: <span
                                                        class="ml-3 badge-info px-2 rounded">{{ $editData->subject->subject }}</span></label>
                                                <input type="hidden" name="old_subject"
                                                    value="{{ $editData->subject_id }}">
                                                <select name="subject" class="form-control" id="subject_id">
                                                    {{-- @foreach ($subject as $item)
                                                        <option value="{{ $item->id }}" {{ $editData->subject_id == $item->id ? 'selected' : '' }}> {{ $item->subject }} </option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="hours">ຈຳນວນຊົ່ວໂມງສອນ</label>
                                                <input type="number" name="hours" required class="form-control"
                                                    value="{{ old('hours', $editData->hours) }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="semister">ຫ້ອງຮຽນ</label>
                                                <select name="classroom" class="form-control">
                                                    @foreach ($classroom as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ old('classroom', $editData->classroom_id) == $item->id ? 'selected' : '' }}>
                                                            {{ $item->classroom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">ລາຍລະອຽດ</label>
                                                <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $editData->description) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-end">
                                        <button class="btn btn-primary btn-lg mt-3">
                                            <i class="fas fa-save mr-2"></i>ບັນທຶກ
                                        </button>
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
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#major_id', function() {
                var major_id = $('#major_id').val();
                $.ajax({
                    url: "{{ route('assign.getSubjects') }}",
                    type: "GET",
                    data: {
                        major_id: major_id
                    },
                    success: function(data) {
                        console.log(data)
                        var html = '<option value="">-- ເລືອກ ວິຊາ--</option>';
                        data.forEach(function(subject) {
                            html += '<option value="' + subject.id + '">' + subject
                                .subject + '</option>';
                        });
                        $('#subject_id').html(html);
                    }
                });
            });
        });
    </script>
@endsection
