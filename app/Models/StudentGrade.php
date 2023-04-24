<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'assign_id',
        'grade',
        'student_id',
        'old_grade',
        'upgrade_date',
        'description',
        'deleted',
        'modified_by'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function assign()
    {
        return $this->belongsTo(Assign::class, 'assign_id', 'id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }
}
