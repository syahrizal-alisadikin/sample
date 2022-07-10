<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominal',
        'student_id',
        'midtran_id',
        'cost_id',
        'jenis_pembayaran',
        'status',
        'tanggal_bayar',
    ];

    public function cost()
    {
        return $this->belongsTo(Cost::class);
    }
}
