<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'major_id',
        'gen_id',
        'fee_type_id',
        'status',
        'due_date',
        'modified_by',
        'deleted',
    ];

    public function feeType()
    {
        return $this->belongsTo(FeeType::class, 'fee_type_id', 'id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'modified_by');
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
}
