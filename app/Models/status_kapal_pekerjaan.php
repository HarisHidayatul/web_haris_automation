<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Facades\DB;

class status_kapal_pekerjaan extends Model
{
    use HasFactory;
    protected $table = 'status_kapal_pekerjaan';
    protected $fillable = [
        // Tambahkan kolom-kolom lain sesuai kebutuhan
        'kapal_pekerjaan_id',
        'status_pekerjaan_id',
        'tanggal_berangkat',
        'tanggal_pulang',
        'deposit_uang'
    ];
    public function kapals()
    {
        return $this->hasOneThrough(
            kapal::class,
            kapal_pekerjaan::class,
            'id',
            'id',
            'kapal_pekerjaan_id',
            'kapal_id'
        );
    }
    public function pekerjaans()
    {
        return $this->hasOneThrough(
            pekerjaan::class,
            kapal_pekerjaan::class,
            'id',
            'id',
            'kapal_pekerjaan_id',
            'pekerjaan_id'
        );
    }
    public function status_pekerjaans(){
        return $this->belongsTo(status_pekerjaan::class,'status_pekerjaan_id','id');
    }
    public function all_pengeluaran($id){
        $result = DB::table('pengeluaran_pekerjaan')
            ->join('item_pengeluaran', 'pengeluaran_pekerjaan.item_pengeluaran_id', '=', 'item_pengeluaran.id')
            ->join('jenis_pengeluaran', 'item_pengeluaran.jenis_pengeluaran_id', '=', 'jenis_pengeluaran.id')
            ->leftJoin('pengeluaran_image', 'pengeluaran_pekerjaan.id', '=', 'pengeluaran_image.pengeluaran_pekerjaan_id')
            ->leftJoin('image_upload', 'pengeluaran_image.image_upload_id', '=', 'image_upload.id')
            ->where('pengeluaran_pekerjaan.status_kapal_pekerjaan_id', $id)
            ->select(
                'jenis_pengeluaran.jenis_pengeluaran',
                'item_pengeluaran.item',
                'pengeluaran_pekerjaan.jumlah_pengeluaran',
                'pengeluaran_pekerjaan.tanggal_pengeluaran',
                'image_upload.nama_image',
                'image_upload.link_image'
            )
            ->orderBy('pengeluaran_pekerjaan.tanggal_pengeluaran')
            ->orderBy('jenis_pengeluaran.jenis_pengeluaran')
            ->get();

        $groupedResult = $result->groupBy('tanggal_pengeluaran')->map(function ($items) {
            return $items->groupBy('jenis_pengeluaran');
        });

        return $groupedResult;
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, team_keberangkatan::class, 'status_kapal_pekerjaan_id', 'id', 'id', 'user_id');
    }
}
