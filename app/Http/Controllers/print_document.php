<?php

namespace App\Http\Controllers;

use App\Models\jenis_pengeluaran;
use App\Models\status_kapal_pekerjaan;
use Illuminate\Http\Request;

class print_document extends Controller
{
    //
    public function show_print_status_pekerjaan(Request $request)
    {

        $id_status_kapal_pekerjaan = $request->id_status_kapal_pekerjaan;
        $status_kapal_pekerjaan = status_kapal_pekerjaan::find($id_status_kapal_pekerjaan);


        $statusKapalPekerjaan = new status_kapal_pekerjaan();
        $all_pengeluaran = $statusKapalPekerjaan->all_pengeluaran($id_status_kapal_pekerjaan);
        // $semua_pengeluaran = $all_pengeluaran->toArray();
        $jenis_pengeluaran = [];
        $total_jenis_pengeluaran = [];

        // Mencari Semua Jenis Pengeluaran
        foreach ($all_pengeluaran as $each_tanggal) {
            # code...
            foreach ($each_tanggal as $loop_jenis) {
                foreach ($loop_jenis as $each_jenis) {
                    $foundJenis = false;
                    foreach ($jenis_pengeluaran as $loop_pengeluaran) {
                        if ($loop_pengeluaran == $each_jenis->jenis_pengeluaran) {
                            $foundJenis = true;
                        }
                    }
                    if (!$foundJenis) {
                        array_push($jenis_pengeluaran, $each_jenis->jenis_pengeluaran);
                    }
                }
            }
        }

        // foreach(){

        // }

        // @dd($jenis_pengeluaran);

        $kapal = $status_kapal_pekerjaan->kapals->nama_kapal;
        $pekerjaan = $status_kapal_pekerjaan->pekerjaans->nama_pekerjaan;
        $status_pekerjaan = $status_kapal_pekerjaan->status_pekerjaans->status;
        $lokasi_pekerjaan = $status_kapal_pekerjaan->lokasi_pekerjaan;

        $users = $status_kapal_pekerjaan->users;
        // @dd($all_pengeluaran);
        // @dd($all_pengeluaran->keys()[0]);
        // @dd($all_pengeluaran->values()[1]->keys());

        // @dd($all_pengeluaran['2024-01-31']['Hotel'][0]);

        // @dd($users);
        return view(
            'print.laporan_pekerjaan',
            [
                'kapal' => $kapal,
                'status' => $status_pekerjaan,
                'pekerjaan' => $pekerjaan,
                'users' => $users,
                'lokasi' => $lokasi_pekerjaan,
                'jenis_pengeluaran' => $jenis_pengeluaran,
                'all_pengeluaran' => $all_pengeluaran
            ]
        );
        // @dd($result);

    }
}
