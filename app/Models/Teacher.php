<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'major_id',
        'phone',
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

    public function assigns()
    {
        return $this->hasMany(Assign::class, 'teacher_id', 'id');
    }

    public function assigns_mm()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_assigns', 'teacher_id', 'assign_id')->withTimestamps();
    }

    public function thesis()
    {
        return $this->hasMany(Thesis::class, 'teacher_id', 'id');
    }

    public function theses()
    {
        return $this->belongsToMany(Thesis::class, 'thesis_advisers')->withTimestamps();
    }

    public function presentationLogs()
    {
        return $this->belongsToMany(PresentationLog::class, 'committees', 'teacher_id', 'presentation_log_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }
}
