<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kapal_pekerjaan extends Model
{
    use HasFactory;
    protected $table = 'kapal_pekerjaan';

    protected $fillable = [
        // Tambahkan kolom-kolom lain sesuai kebutuhan
        'kapal_id',
        'pekerjaan_id'
    ];
}
