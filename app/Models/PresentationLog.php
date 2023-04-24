<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'thesis_id',
        'round',
        'type',
        'date',
        'status',
        'comment'
    ];

    public function thesis()
    {
        return $this->belongsTo(Thesis::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'committees', 'presentation_log_id', 'teacher_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }
}
