<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran_pekerjaan extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran_pekerjaan';

    protected $fillable = [
        // Tambahkan kolom-kolom lain sesuai kebutuhan
        'item_pengeluaran_id',
        'status_kapal_pekerjaan_id',
        'jumlah_pengeluaran',
        'tanggal_pengeluaran'
    ];
}
