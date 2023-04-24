<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'subject',
        'description',
        'credit',
        'hours',
        'deleted'
    ];

    public function assigns()
    {
        return $this->hasMany(Assign::class, 'subject_id', 'id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }

    public function majors()
    {
        return $this->belongsToMany(Major::class, 'subject_major')->withTimestamps();
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }
}
