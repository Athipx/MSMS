<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    use HasFactory;

    protected $fillable = [
        'gen',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'gen_id', 'id');
    }

    public function assigns()
    {
        return $this->hasMany(Assign::class, 'gen_id', 'id');
    }

    public function thesis()
    {
        return $this->hasMany(Thesis::class, 'major_id', 'id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }

    public function fee()
    {
        return $this->hasMany(StudentFee::class, 'gen_id', 'id');
    }
}
