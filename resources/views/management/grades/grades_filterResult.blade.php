<table id="datatable" class="table dt-responsive nowrap"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>ລະຫັດນັກສຶກສາ</th>
            <th>ຊື່-ນາມສະກຸນ ລາວ</th>
            <th>ຮຸ່ນການສຶກສາ</th>
            <th>ສາຂາວິຊາ</th>
            <th>ວິຊາ</th>
            <th>ເກຣດ</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grades as $key => $row)
            <tr>
                <td>{{ $row->student_id }}</td>
                <td>{{ $row->fname }} {{ $row->lname }}</td>
                <td>{{ $row->gen }}</td>
                <td>{{ $row->major }}</td>
                <td>{{ $row->subject }}</td>
                <td>{{ $row->grade }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('grade.detail', $row->id) }}" type="button"
                            class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top"
                            title="ເບິ່ງລາຍລະອຽດ">
                            <i class="mdi mdi-eye"></i>
                        </a>
                        <a href="{{ route('grade.edit', $row->id) }}" type="button"
                            class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top"
                            title="ແກ້ໄຂຂໍ້ມູນ">
                            <i class="mdi mdi-pencil"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
