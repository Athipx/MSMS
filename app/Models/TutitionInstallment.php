<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutitionInstallment extends Model
{
    use HasFactory;

    public function tutition()
    {
        return $this->belongsTo(Tutition::class);
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }
}
