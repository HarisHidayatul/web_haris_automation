<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team_keberangkatan extends Model
{
    use HasFactory;
    protected $table = 'team_keberangkatan';

    protected $fillable = [
        // Tambahkan kolom-kolom lain sesuai kebutuhan
        'status_kapal_pekerjaan_id',
        'user_id'
    ];
}
