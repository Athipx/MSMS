<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class UsersReportController extends Controller
{
    public function UsersReport(Request $request)
    {
        $role = $request->role;

        if ($role && $role !== '') {
            $users = DB::table('users')
                ->select('id', 'fname_lo', 'lname_lo', 'role', 'created_at', 'updated_at')
                ->where('role', $role)
                ->get();
        } else {
            $users = DB::table('users')
                ->select('id', 'fname_lo', 'lname_lo', 'role', 'created_at', 'updated_at')
                ->whereNotIn('role', ['student', 'teacher'])
                ->get();
        }

        $count = $users->count();

        return view('reports.users_report.users_report.users_report', compact('users', 'role', 'count'));
    }

    public function exportFilteredUsers(Request $request)
    {
        $role = $request->input('role');

        $date = Carbon::now()->format('d-m-Y-H-i-s');
        $filename = 'users-' . $date . '.xlsx';

        // Export the data to Excel
        return Excel::download(new UsersExport($role), $filename);
    }
}
