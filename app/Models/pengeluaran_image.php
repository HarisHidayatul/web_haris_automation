<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran_image extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran_image';

    protected $fillable = [
        // Tambahkan kolom-kolom lain sesuai kebutuhan
        'image_upload_id',
        'pengeluaran_pekerjaan_id'
    ];
}
