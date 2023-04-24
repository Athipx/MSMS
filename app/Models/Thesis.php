<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'thesis_advisers')->withTimestamps();
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }

    public function gen()
    {
        return $this->belongsTo(Generation::class, 'gen_id', 'id');
    }

    public function presentationLogs()
    {
        return $this->hasMany(PresentationLog::class);
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }
}
