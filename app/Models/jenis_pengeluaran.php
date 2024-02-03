<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'jenis_pengeluaran';

    protected $fillable = [
        // Tambahkan kolom-kolom lain sesuai kebutuhan
        'jenis_pengeluaran',
    ];
    
}
