@extends('layouts.master')

@section('content')
    <title>ພາບລວມລະບົບ</title>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ຖັງຂີ້ເຫຍື້ອ ການຮຽນ-ສອນ</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">ການສຶກສາ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('assigns.view') }}">ການຮຽນ-ສອນ</a></li>
                            <li class="breadcrumb-item active">ຖັງຂີ້ເຫຍື້ອ ການຮຽນ-ສອນ</li>
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
                                    <a href="{{ route('assigns.view') }}" class="btn btn-light btn-rounded btn-sm mb-1">
                                        <i class="fas fa-arrow-left mr-2"></i> ກັບຄືນ</a>
                                    <hr>
                                </div>
                                <table id="datatable" class="table dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">ລະຫັດ</th>
                                            {{-- <th style="width: 20%;">ອາຈານສອນ</th> --}}
                                            <th>ວິຊາ</th>
                                            <th>ສາຂາວິຊາ</th>
                                            <th>ຮຸ່ນການສຶກສາ</th>
                                            <th>ພາກ / ເທີມການສຶກສາ</th>
                                            <th>ຫ້ອງຮຽນ</th>
                                            <th></th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                {{-- <td><img class="rounded-circle mr-2"
                                                        src="{{ !empty($row->teacher->user->profile) ? asset($row->teacher->user->profile) : asset('assets/images/profiles/profile.jpg') }}"
                                                        width="70" height="70">
                                                    {{ $row->teacher->user->fname_lo }}
                                                    {{ $row->teacher->user->lname_lo }}
                                                </td> --}}
                                                <td>{{ $row->subject->subject }}</td>
                                                <td>{{ $row->major->major }}</td>
                                                <td>{{ $row->gen->gen }}</td>
                                                <td>{{ $row->semister->semister }}</td>
                                                <td>{{ $row->classroom->classroom }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('assign.restore', $row->id) }}" type="button"
                                                            class="btn btn-outline-primary wave-effect wave-light"
                                                            data-toggle="tooltip" data-placement="top" title="ກູ້ຄືນ">
                                                            <i class="fas fa-undo"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

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
