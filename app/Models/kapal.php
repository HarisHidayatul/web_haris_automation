<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kapal extends Model
{
    use HasFactory;
    protected $table = 'kapal';

    protected $fillable = [
        // Tambahkan kolom-kolom lain sesuai kebutuhan
        'nama_kapal',
    ];
}
