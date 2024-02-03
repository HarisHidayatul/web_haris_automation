<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

class DomPdfController extends Controller
{
    //
    public function getPdf(){
        $data = [
            
        ];
        $pdf = FacadePdf::loadView('tesprint');
        $pdf->setPaper('A4', 'potrait');
        // @ddd($pdf->download('TesDownload.pdf'));
        return $pdf->download('TesDownload.pdf');
    }
}
