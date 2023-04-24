<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="row">


                    <div class="col-12">
                        <div class="box bb-3 border-warning">
                            <div class="box-header">
                                <h4 class="box-title">Student <strong>Marsk Entry</strong></h4>
                            </div>

                            <div class="box-body">

                                <form method="post" action="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Year <span class="text-danger"> </span></h5>
                                                <div class="controls">
                                                    <select name="major_id" id="major_id" required=""
                                                        class="form-control">
                                                        <option value="" selected="" disabled="">Select
                                                            Major
                                                        </option>
                                                        @foreach ($majors as $majors)
                                                            <option value="{{ $majors->id }}">{{ $majors->major }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                        </div> <!-- End Col md 3 -->




                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Class <span class="text-danger"> </span></h5>
                                                <div class="controls">
                                                    <select name="gen_id" id="gen_id"
                                                        required=""class="form-control">
                                                        <option value="" selected="" disabled="">Select
                                                            Gen
                                                        </option>
                                                        @foreach ($gen as $gen)
                                                            <option value="{{ $gen->id }}">{{ $gen->gen }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                        </div> <!-- End Col md 3 -->


                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Subject <span class="text-danger"> </span></h5>
                                                <div class="controls">
                                                    <select name="subject_id" id="subject_id" required=""
                                                        class="form-control">
                                                        <option selected="">Select Subject</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div> <!-- End Col md 3 -->






                                        <div class="col-md-3">

                                            <a id="search" class="btn btn-primary" name="search"> Search</a>

                                        </div> <!-- End Col md 3 -->
                                    </div><!--  end row -->


                                    <!--  ////////////////// Mark Entry table /////////////  -->


                                    <div class="row d-none" id="marks-entry">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID No</th>
                                                        <th>Student Name </th>
                                                        <th>Father Name </th>
                                                        <th>Gender</th>
                                                        <th>Marks</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="marks-entry-tr">

                                                </tbody>

                                            </table>
                                            <input type="submit" class="btn btn-rounded btn-primary" value="Submit">

                                        </div>

                                    </div>


                                </form>


                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
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
                    var html = '';
                    $.each(data, function(key, v) {
                        html +=
                            '<tr>' +
                            '<td>' + v.student_id +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"></td>' +
                            '<td>' + v.user.fname_lo + '</td>' +
                            '<td><input type="text" class="form-control form-control-sm" name="marks[]" ></td>' +
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
</body>

</html>
