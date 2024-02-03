<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service_report extends Model
{
    use HasFactory;
    protected $table = 'service_report';

    protected $fillable = [
        // Tambahkan kolom-kolom lain sesuai kebutuhan
        'status_kapal_pekerjaan_id',
        'image_upload_id'
    ];
}
