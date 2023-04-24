<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'major',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'major_id', 'id');
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'major_id', 'id');
    }

    public function assigns()
    {
        return $this->hasMany(Assign::class, 'major_id', 'id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'major_id', 'id');
    }

    public function subjects_mm()
    {
        return $this->belongsToMany(Subject::class, 'subject_major')->withTimestamps();
    }

    public function thesis()
    {
        return $this->hasMany(Thesis::class, 'major_id', 'id');
    }

    public function tutition()
    {
        return $this->hasMany(Tutition::class, 'major_id', 'id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }

    public function fee()
    {
        return $this->hasMany(StudentFee::class, 'major_id', 'id');
    }
}
