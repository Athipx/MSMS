<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    use HasFactory;

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }

    public function gen()
    {
        return $this->belongsTo(Generation::class, 'gen_id', 'id');
    }

    public function semister()
    {
        return $this->belongsTo(Semister::class, 'semister_id', 'id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }

    public function studentGrades()
    {
        return $this->hasMany(StudentGrade::class, 'assign_id', 'id');
    }

    public function teachers_mm()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_assigns')->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_assigns', 'assign_id', 'teacher_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'teacher_assigns')
            ->join('teachers', 'users.id', '=', 'teachers.user_id')
            ->join('teacher_assigns', 'teachers.id', '=', 'teacher_assigns.teacher_id')
            ->where('teacher_assigns.assign_id', $this->id)
            ->select('users.*')
            ->distinct();
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }
}
