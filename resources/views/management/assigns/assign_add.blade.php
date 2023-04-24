@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ເພີ່ມການຮຽນ-ການສອນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ການສຶກສາ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('assigns.view') }}">ການຮຽນ-ການສອນ</a></li>
                            <li class="breadcrumb-item active">ເພີ່ມການຮຽນ-ການສອນ</li>
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
                                    <a href="{{ route('assigns.view') }}" class="btn btn-light btn-rounded btn-sm mb-1"><i
                                            class="fas fa-arrow-left"></i>
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
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('assign.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="major">ສາຂາວິຊາ</label>
                                                <select name="major" class="form-control" id="major_id">
                                                    <option value="">-- ເລືອກ ສາຂາວິຊາ--</option>
                                                    @foreach ($major as $item)
                                                        <option value="{{ $item->id }}">{{ $item->major }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="gen">ຮຸ່ນການສຶກສາ</label>
                                                <select name="gen" class="form-control">
                                                    @foreach ($gen as $item)
                                                        <option value="{{ $item->id }}">{{ $item->gen }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="subject">ວິຊາ</label>
                                                <select name="subject" class="form-control" id="subject_id">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="semister">ພາກ / ເທີມການສຶກສາ</label>
                                                <select name="semister" class="form-control">
                                                    @foreach ($semister as $item)
                                                        <option value="{{ $item->id }}">{{ $item->semister }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="teacher">ອາຈານສອນ</label>
                                                <select name="teacher[]" class="selectize" multiple
                                                    style="border-radius: 10px;">
                                                    @foreach ($teacher as $item)
                                                        <option value="{{ $item->id }}">{{ $item->user->fname_lo }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="hours">ຈຳນວນຊົ່ວໂມງສອນ</label>
                                                <input type="number" name="hours" required class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="classroom">ຫ້ອງຮຽນ</label>
                                                <select name="classroom" class="form-control">
                                                    @foreach ($classroom as $item)
                                                        <option value="{{ $item->id }}">{{ $item->classroom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">ລາຍລະອຽດ</label>
                                                <textarea name="description" class="form-control" id="description" rows="3"></textarea>
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

    <!--   // for get Student Subject  -->
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
