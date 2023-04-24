<table id="datatable" class="table dt-responsive nowrap my-table"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>ລະຫັດນັກສຶກສາ</th>
            <th>ຊື່-ນາມສະກຸນ ລາວ</th>
            <th>ຮຸ່ນການສຶກສາ</th>
            <th>ສາຂາວິຊາ</th>
            <th>ປະເພດຄ່າທຳນຽມ</th>
            <th>ສະຖານະການຊຳລະ</th>
            <th>ວັນທີຊຳລະ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $item)
            <tr>
                <td>
                    {{ $item->student_id }}
                    <input type="hidden" name="student_id[]" value="{{ $item->id }}">
                </td>
                <td>{{ $item->fname }} {{ $item->lname }}</td>
                <td>{{ $item->gen }}</td>
                <td>{{ $item->major }}</td>
                <td>{{ $item->type }}</td>
                <td>
                    <select name="status[]" id="" class="form-control">
                        <option value="paid" {{ old('status', $item->status) == 'paid' ? 'selected' : '' }}>ຊຳລະແລ້ວ
                        </option>
                        <option value="unpaid" {{ old('status', $item->status) == 'unpaid' ? 'selected' : '' }}>
                            ຍັງບໍ່ທັນຊຳລະ</option>
                    </select>
                </td>
                <td><input type="date" class="form-control"
                        name="due_date[]"value="{{ old('due_date', $item->date) }}"></td>
            </tr>
        @endforeach
    </tbody>
</table>
<button name="submit" type="submit" class="btn btn-rounded btn-lg btn-primary mt-4">
    <i class="fas fa-save mr-2"></i>ບັນທຶກ
</button>
