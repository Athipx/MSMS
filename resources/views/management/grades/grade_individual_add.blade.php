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


                <div class="form-group">
                    <label for="">ສາຂາວິຊາ</label>
                    <div class="controls">
                        <select name="major_id" id="major_id" required="" class="form-control">
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
                <div class="form-group">
                    <label for="">ຮຸ່ນການສຶກສາ</label>
                    <div class="controls">
                        <select name="gen_id" id="gen_id" required=""class="form-control">
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
                <div class="form-group">
                    <label for="">ວິຊາ</label>
                    <div class="controls">
                        <select name="subject_id" id="subject_id" required="" class="form-control">
                            <option value="" selected="" disabled="">
                                -- ເລືອກ ວິຊາ --
                            </option>
                        </select>
                    </div>
                </div>


            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>

    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            var major_id = $('#major_id').val();
            var gen_id = $('#gen_id').val();
            $.ajax({
                url: "{{ route('grades.getStudents') }}",
                type: "GET",
                data: {
                    'major_id': major_id,
                    'gen_id': gen_id
                },
                success: function(data) {
                    $('#marks-entry').removeClass('d-none');
                    $('#message').addClass('d-none')
                    var html = '';
                    $.each(data, function(key, v) {
                        html +=
                            '<tr>' +
                            '<td>' + v.student_id +
                            '<input type="hidden" name="student_id[]" value="' + v.id +
                            '"></td>' +
                            '<td>' + "<span class='mr-2'>" + v.user.fname_lo + '</span>' + v
                            .user.lname_lo + '</td>' +
                            '<td>' +
                            "<select name='grade[]' class='form-control'>" +
                            "<option value='A'>A</option>" +
                            "<option value='B+'>B+</option>" +
                            "<option value='B'>B</option>" +
                            "<option value='C+'>C+</option>" +
                            "<option value='C'>C</option>" +
                            "<option value='D+'>D+</option>" +
                            "<option value='D'>D</option>" +
                            "<option value='F'>F</option>" +
                            "<option value='I'>I</option>" +
                            '</select>' +
                            '</td>' +
                            // '<td>' +
                            // "<select name='old_grade[]' class='form-control'>" +
                            // "<option value='ບໍ່ໄດ້ອັບເກຣດ'>ບໍ່ໄດ້ອັບເກຣດ</option>" +
                            // "<option value='A'>A</option>" +
                            // "<option value='B+'>B+</option>" +
                            // "<option value='B'>B</option>" +
                            // "<option value='C+'>C+</option>" +
                            // "<option value='C'>C</option>" +
                            // "<option value='D+'>D+</option>" +
                            // "<option value='D'>D</option>" +
                            // "<option value='F'>F</option>" +
                            // "<option value='I'>I</option>" +
                            // '</select>' +
                            // '</td>' +
                            // "<td><input name='upgrade_date[]' type='date' class='form-control datepicker-here' data-language='en' placeholder='ວັນທີອັບເກຣດ...'></td>" +
                            // "<td><textarea name='description[]' class='form-control' id='description' rows='2'></textarea></td>" +
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
