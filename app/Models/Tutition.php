<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutition extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'major_id',
        'gen_id',
        'status',
        'due_date',
        'comment',
        'modified_by',
    ];

    public function TutitionInstallments()
    {
        return $this->hasMany(TutitionInstallment::class);
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

    public function editor()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }
}
