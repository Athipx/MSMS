<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function collection()
    {
        if ($this->role && $this->role !== '') {
            $users = DB::table('users')
                ->select('id', 'fname_lo', 'lname_lo', 'role', 'created_at', 'updated_at')
                ->where('role', $this->role)
                ->get();
        } else {
            $users = DB::table('users')
                ->select('id', 'fname_lo', 'lname_lo', 'role', 'created_at', 'updated_at')
                ->whereNotIn('role', ['student', 'teacher'])
                ->get();
        }
        return $users;
    }

    public function headings(): array
    {
        return [
            'ລະຫັດບັນຊີຜູ້ໃຊ້',
            'ຊື່',
            'ນາມສະກຸນ',
            'ສິດທິຜູ້ໃຊ້',
            'ວັນທີສ້າງ',
            'ວັນທີແກ້ໄຂຫຼ້າສຸດ'
        ];
    }
}
