<table id="datatable" class="table dt-responsive nowrap my-table"
    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>ລະຫັດນັກສຶກສາ</th>
            <th>ຊື່-ນາມສະກຸນນັກສຶກສາ</th>
            <th>ສາຂາວິຊາ</th>
            <th>ຮຸ່ນການສຶກສາ</th>
            <th>ສະຖານະການຊຳລະ</th>
            <th>ວັນທີຊຳລະ</th>
            <th>ລາຍລະອຽດການຊຳລະ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $item)
            <tr>
                <td>
                    {{ $item->student_id }}
                    <input type="hidden" name="student_id[]" value="{{ $item->id }}">
                </td>
                <td>{{ $item->full_name }}</td>
                <td>{{ $item->gen }}</td>
                <td>{{ $item->major }}</td>
                <td>
                    <select name="status[]" id="" class="form-control">
                        <option value="paid" {{ old('status', $item->status) == 'paid' ? 'selected' : '' }}>
                            ຊຳລະແລ້ວ
                        </option>
                        <option value="unpaid" {{ old('status', $item->status) == 'unpaid' ? 'selected' : '' }}>
                            ຍັງບໍ່ທັນຊຳລະ
                        </option>
                        <option value="installment"
                            {{ old('status', $item->status) == 'installment' ? 'selected' : '' }}>
                            ຜ່ອນຊຳລະ
                        </option>
                    </select>
                </td>
                <td><input type="date" class="form-control"
                        name="due_date[]"value="{{ old('due_date', $item->date) }}"></td>
                <td>
                    <textarea name="comment[]" id="" rows="2" class="form-control"></textarea>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<button name="submit" type="submit" class="btn btn-rounded btn-lg btn-primary mt-4">
    <i class="fas fa-save mr-2"></i>ບັນທຶກ
</button>
