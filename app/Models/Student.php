<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
        'gen_id',
        'major_id',
        'gender',
        'dob',
        'phone',
        'born_village',
        'born_district',
        'born_province',
        'current_village',
        'current_district',
        'current_province',
        'occupation',
        'position',
        'working_place',
        'status',
        'modified_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }

    public function gen()
    {
        return $this->belongsTo(Generation::class, 'gen_id', 'id');
    }

    public function studentGrades()
    {
        return $this->hasMany(StudentGrade::class, 'student_id', 'id');
    }

    public function thesis()
    {
        return $this->hasMany(Thesis::class, 'student_id', 'id');
    }

    public function tutition()
    {
        return $this->hasMany(Tutition::class, 'student_id', 'id');
    }

    public function fee()
    {
        return $this->hasMany(StudentFee::class, 'student_id', 'id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }
}
