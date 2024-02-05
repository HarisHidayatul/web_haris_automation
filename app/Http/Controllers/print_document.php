<?php

namespace App\Http\Controllers;

use App\Models\jenis_pengeluaran;
use App\Models\status_kapal_pekerjaan;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Spatie\PdfToImage\Pdf;

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
        $total_pengeluaran = 0;
        $pdfFiles = [];
        $pdfContents = [];

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
                        array_push($total_jenis_pengeluaran, 0);
                    }
                }
            }
        }

        // Mencari Gambar PDF
        foreach ($all_pengeluaran as $each_tanggal) {
            # code...
            foreach ($each_tanggal as $loop_jenis) {
                foreach ($loop_jenis as $each_jenis) {
                    // if ($this->isPdfContent($each_jenis->link_image)) {
                    array_push($pdfFiles, $each_jenis->link_image);
                    // }
                    // @dd($each_jenis->link_image);
                }
            }
        }
        // Menyaring array untuk mempertahankan hanya elemen-elemen yang memenuhi kriteria
        $filteredDataPDF = array_filter($pdfFiles, function ($url) {
            return !is_null($url) && strpos($url, '.pdf') !== false;
        });

        foreach ($filteredDataPDF as $loopPDF) {
            # code...
            // $pdfContents[] = $this->generateDynamicPdf($loopPDF);
            $pdfContents[] = $this->convertPdfToImage($loopPDF);
        }
        // @dd($pdfContents);
        // @dd($filteredDataPDF);

        // Menjumlahkan semua pengeluaran
        $indexThisLoop = 0;
        foreach ($jenis_pengeluaran as $loop_pengeluaran) {
            $totalThisLoop = 0;
            foreach ($all_pengeluaran as $each_tanggal) {
                foreach ($each_tanggal as $loop_jenis) {
                    foreach ($loop_jenis as $each_items) {
                        if ($each_items->jenis_pengeluaran == $loop_pengeluaran) {
                            $totalThisLoop = $totalThisLoop + $each_items->jumlah_pengeluaran;
                        }
                        // @dd($each_items);
                    }
                }
            }
            $total_jenis_pengeluaran[$indexThisLoop] = $totalThisLoop;
            $indexThisLoop = $indexThisLoop + 1;
        }

        foreach ($total_jenis_pengeluaran as $loop_jenis_pengeluaran) {
            $total_pengeluaran = $total_pengeluaran + $loop_jenis_pengeluaran;
        }

        // @dd($total_jenis_pengeluaran);

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
        // return view(
        //     'print.laporan_pekerjaan',
        //     [
        //         'kapal' => $kapal,
        //         'status_pekerjaan' => $status_pekerjaan,
        //         'pekerjaan' => $pekerjaan,
        //         'users' => $users,
        //         'lokasi_pekerjaan' => $lokasi_pekerjaan,
        //         'jenis_pengeluaran' => $jenis_pengeluaran,
        //         'total_jenis_pengeluaran' => $total_jenis_pengeluaran,
        //         'all_pengeluaran' => $all_pengeluaran,
        //         'total_pengeluaran' => $total_pengeluaran
        //     ]
        // );
        return view('print.laporan_pekerjaan', compact(
            'kapal',
            'status_pekerjaan',
            'pekerjaan',
            'users',
            'lokasi_pekerjaan',
            'jenis_pengeluaran',
            'total_jenis_pengeluaran',
            'all_pengeluaran',
            'total_pengeluaran',
            'pdfContents'
        ));

    }

    private function convertPdfToImage($pdfContent)
    {
        // Simpan PDF ke file sementara
        $pdfPath = tempnam(sys_get_temp_dir(), 'pdf');
        file_put_contents($pdfPath, $pdfContent);

        // Konversi PDF menjadi gambar menggunakan spatie/pdf-to-image
        $pdf = new Pdf($pdfPath);
        $imagePath = $pdf->saveImage(sys_get_temp_dir());

        // Hapus file PDF sementara
        unlink($pdfPath);

        return $imagePath;
    }
}
