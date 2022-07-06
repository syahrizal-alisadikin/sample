<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
    public function school_years_id()
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id', 'id');
    }
}
