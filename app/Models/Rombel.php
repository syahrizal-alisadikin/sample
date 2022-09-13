<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    use HasFactory;
    // protected $guarded = [];

    public function level()
    {
        return $this->belongsTo(level::class, 'level_id');
    }
}
