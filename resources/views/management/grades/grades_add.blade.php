@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ເພີ່ມຄະແນນວິຊາ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ການສຶກສາ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('grades.view') }}">ຄະແນນການສຶກສາ</a></li>
                            <li class="breadcrumb-item active">ເພີ່ມຄະແນນວິຊາ</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <form method="post" action="{{ route('grades.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <a class="btn btn-light btn-rounded btn-sm mb-1" onclick="window.history.back()"><i
                                                class="fas fa-arrow-left"></i>
                                            ກັບຄືນ</a>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">ສາຂາວິຊາ</label>
                                                <div class="controls">
                                                    <select name="major_id" id="major_id" required=""
                                                        class="form-control">
                                                        <option value="" selected="" disabled="">
                                                            -- ເລືອກ ສາຂາວິຊາ --
                                                        </option>
                                                        @foreach ($majors as $majors)
                                                            <option value="{{ $majors->id }}">{{ $majors->major }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 3 -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">ຮຸ່ນການສຶກສາ</label>
                                                <div class="controls">
                                                    <select name="gen_id" id="gen_id"
                                                        required=""class="form-control">
                                                        <option value="" selected="" disabled="">
                                                            -- ເລືອກ ຮຸ່ນການສຶກສາ --
                                                        </option>
                                                        @foreach ($gen as $gen)
                                                            <option value="{{ $gen->id }}">{{ $gen->gen }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 3 -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">ວິຊາ</label>
                                                <div class="controls">
                                                    <select name="subject_id" id="subject_id" required=""
                                                        class="form-control">
                                                        <option value="" selected="" disabled="">
                                                            -- ເລືອກ ວິຊາ --
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 3 -->
                                        <div class="col-md-12">
                                            <a id="search"
                                                class="btn btn-primary text-white d-flex flex-row justify-content-center px-5"
                                                name="search"><i class="fas fa-search mr-2"></i> ຄົ້ນຫາ</a>
                                        </div> <!-- End Col md 3 -->
                                    </div><!--  end row -->
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="alert alert-info alert-dismissible fade show" role="alert" id="message"
                                        style="font-size: 16px;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong><i class="far fa-hand-point-left mr-3"></i>ກະລຸນາເລືອກ!</strong> ສາຂາວິຊາ,
                                        ຮຸ່ນການສຶກສາ ແລະ
                                        ວິຊາທີ່ຕ້ອງການເພີ່ມຄະແນນທີ່ດ້ານຂ້າງຊ້າຍມືກ່ອນ.
                                    </div>
                                    <div class="d-none" id="marks-entry">
                                        <!--  ////////////////// Mark Entry table /////////////  -->
                                        {{-- <h5 class="font-italic mb-3"><span class="text-danger">*</span>ໃນການປ້ອນຄະແນນແມ່ນໃຫ້ປ້ອນເປັນເກຣດການຮຽນເຊິ່ງປະກອບ</h5> --}}
                                        <table class="table dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ລະຫັດນັກສຶກສາ</th>
                                                    <th>ຊື່-ນາມສະກຸນ</th>
                                                    <th>ເກຣດ</th>
                                                    {{-- <th>ເກຣດເກົ່າ <span class="text-danger">(ຖ້າມີ)</span></th>
                                                    <th>ວັນທີອັບເກຣດ <span class="text-danger">(ຖ້າມີ)</span></th>
                                                    <th>ລາຍລະອຽດ</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody id="marks-entry-tr">

                                            </tbody>
                                        </table>
                                        {{-- <input type="submit" class="btn btn-rounded btn-lg btn-primary mt-4" value="ບັນທຶກ"> --}}
                                        <button name="submit" type="submit"
                                            class="btn btn-rounded btn-lg btn-primary mt-4">
                                            <i class="fas fa-save mr-2"></i>ບັນທຶກ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div> <!-- end row -->
                </form>
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>

    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            var major_id = $('#major_id').val();
            var gen_id = $('#gen_id').val();
            var subject_id = $('#subject_id').val();
            $.ajax({
                url: "{{ route('grades.getStudents') }}",
                type: "GET",
                data: {
                    'major_id': major_id,
                    'gen_id': gen_id,
                    subject_id
                },
                success: function(data) {
                    $('#marks-entry').removeClass('d-none');
                    $('#message').addClass('d-none')
                    var html = '';

                    console.log(data);

                    const grades = ['N/A', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F', 'I'];
                    const old_grades = ['ບໍ່ໄດ້ອັບເກຣດ', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F',
                        'I'
                    ];

                    $.each(data, function(key, v) {

                        let grades_option = '';
                        grades.forEach((grade) => {
                            grades_option +=
                                `<option value="${grade}" ${grade == v.grade ? 'selected' : ''}>${grade}</option>`;
                        });

                        let old_grades_option = '';
                        old_grades.forEach((old_grade) => {
                            old_grades_option +=
                                `<option value="${old_grade}" ${old_grade == v.old_grade ? 'selected' : ''}>${old_grade}</option>`;
                        });

                        html +=
                            '<tr>' +
                            '<td>' + v.student_id +
                            '<input type="hidden" name="student_id[]" value="' + v.id +
                            '"></td>' +
                            '<td>' + "<span class='mr-2'>" + v.fname_lo +
                            '</span>' + v.lname_lo + '</td>' +
                            '<td>' +
                            "<select name='grade[]' class='form-control'>" +
                            grades_option +
                            '</select>' +
                            '</td>' +
                            '</tr>';
                    });
                    html = $('#marks-entry-tr').html(html);
                }
            });
        });
    </script>

    <!--   // for get Student Subject  -->
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#gen_id, #major_id', function() {
                var gen_id = $('#gen_id').val();
                var major_id = $('#major_id').val();
                $.ajax({
                    url: "{{ route('grades.getsubjects') }}",
                    type: "GET",
                    data: {
                        gen_id: gen_id,
                        major_id: major_id
                    },
                    success: function(data) {
                        var html = '<option value="">-- ເລືອກ ວິຊາຮຽນ --</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.id + '">' + v.subject
                                .subject + '</option>';
                        });
                        $('#subject_id').html(html);
                    }
                });
            });
        });
    </script>
@endsection
