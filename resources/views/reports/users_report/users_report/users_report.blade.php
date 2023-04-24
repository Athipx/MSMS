@extends('layouts.master')

@section('content')
    <title>ລາຍງານຜູ້ໃຊ້ອື່ນໆ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ລາຍງານຜູ້ໃຊ້ອື່ນໆ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ລາຍງານ</a></li>
                            <li class="breadcrumb-item active">ລາຍງານຜູ້ໃຊ້ອື່ນໆ</li>
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
                                <form method="GET" action="{{ route('users.report') }}" id="filter-form">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="">ສິດທິຜູ້ໃຊ້</label>
                                                <select name="role" id="role" class="form-control">
                                                    <option value="">-- ທັງໝົດ --</option>
                                                    <option value="admin"
                                                        {{ isset($role) && $role == 'admin' ? 'selected' : '' }}>
                                                        ຜູ້ຄຸ້ມຄອງລະບົບ
                                                    </option>
                                                    <option value="headDept"
                                                        {{ isset($role) && $role == 'headDept' ? 'selected' : '' }}>
                                                        ຫົວໜ້າພາກວິຊາ
                                                    </option>
                                                    <option value="headUnit"
                                                        {{ isset($role) && $role == 'headUnit' ? 'selected' : '' }}>
                                                        ຫົວໜ້າໜ່ວຍວິຊາ
                                                    </option>
                                                    <option value="coordinator"
                                                        {{ isset($role) && $role == 'coordinator' ? 'selected' : '' }}>
                                                        ຜູ້ປະສານງານ
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="text-white">btn</label>
                                                <button type="submit" class="btn btn-primary w-100"><i
                                                        class="fas fa-search mr-2"></i> ຄົ້ນຫາ</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div> <!-- end col -->
                    @if (isset($users))
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="filter-result">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div>
                                                <h5>ລວມທັງໝົດ: {{ $count }}</h5>
                                            </div>
                                            <form action="{{ route('users.export') }}" method="get">
                                                <input type="hidden" name="role" value="{{ request('role') }}">
                                                <button type="submit" class="btn btn-light"><i
                                                        class="fas fa-file-excel"></i> Excel</button>
                                            </form>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>ລຳດັບ</th>
                                                        <th>ລະຫັດບັນຊີຜູ້ໃຊ້</th>
                                                        <th>ຊື່-ນາມສະກຸນ</th>
                                                        <th>ສິດທິຜູ້ໃຊ້</th>
                                                        <th>ວັນທີສ້າງ</th>
                                                        <th>ວັນທີແກ້ໄຂຫຼ້າສຸດ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 1;
                                                        $role = ['admin' => 'ຜູ້ຄຸ້ມຄອງລະບົບ', 'coordinator' => 'ຜູ້ປະສານງານ', 'headUnit' => 'ຫົວໜ້າໜ່ວຍວິຊາ', 'headDept' => 'ຫົວໜ້າພາກວິຊາ'];
                                                    @endphp
                                                    @foreach ($users as $row)
                                                        <tr>
                                                            <th scope="row">{{ $i++ }}</th>
                                                            <td>{{ $row->id }}</td>
                                                            <td>{{ $row->fname_lo }} {{ $row->lname_lo }}</td>
                                                            <td>{{ $role[$row->role] }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($row->created_at)) }}
                                                            </td>
                                                            <td>{{ date('d/m/Y', strtotime($row->updated_at)) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    @endif
                </div> <!-- end row -->

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
                url: "{{ route('grades.filterResult') }}",
                type: 'GET',
                data: formData,
                success: function(response) {
                    var html = response.filterResults;
                    $('#filter-result').html(response);
                    // console.log(response);
                }
            });
        });
    </script> --}}

    <!--   // for get Student Subject  -->
    {{-- <script type="text/javascript">
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
    </script> --}}
@endsection
