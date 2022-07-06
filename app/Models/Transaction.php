<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nominal',
        'student_id',
        'midtran_id',
        'cost_id',
        'jenis_pembayaran',
        'status',
        'tanggal_bayar',
    ];
}
