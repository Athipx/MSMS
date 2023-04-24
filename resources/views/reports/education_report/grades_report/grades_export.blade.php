@extends('layouts.master')

@section('content')
    <div>
        <h3>ລາຍຄະແນນການສຶກສາ</h3>
        {{-- <h5>ວິຊາ: {{ $grades->subject }}</h5> --}}
        {{-- <h5>ສາຂາວິຊາ: {{ $grades->major }}</h5> --}}
        {{-- <h5>ຮຸ່ນການສຶກສາ: {{ $grades->gen }}</h5> --}}
    </div>
    <div class="table-responsive">
        <table class="table my-table">
            <thead>
                <tr>
                    <th>ລະຫັດນັກສຶກສາ</th>
                    <th>ຊື່-ນາມສະກຸນ ລາວ</th>
                    <th>ຮຸ່ນການສຶກສາ</th>
                    <th>ສາຂາວິຊາ</th>
                    <th>ວິຊາ</th>
                    <th>ເກຣດ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $key => $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->assign_id }}</td>
                        <td>{{ $row->student_id }}</td>
                        <td>{{ $row->grade }}</td>
                        <td>{{ $row->old_grade }}</td>
                        <td>{{ $row->old_grade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
