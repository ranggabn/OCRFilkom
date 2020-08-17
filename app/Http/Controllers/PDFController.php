<?php

namespace App\Http\Controllers;
use Spatie\PdfToImage\Pdf;
use Org_Heigl\Ghostscript\Ghostscript;
use Illuminate\Http\Request;

class PDFController extends Controller{
    public function index()
    {
        $pdf_file = public_path() . "\pdf\\file.pdf";
        $output_path = public_path() . "\images\\foto%d";
        
        Ghostscript::setGsPath("C:\Program Files\gs\gs9.52\bin\gswin64c.exe");
        $pdf = new Pdf($pdf_file);
        $pdf->setOutputFormat('png')->saveImage($output_path);
    }

    public function create()
    {
        return view('index');
    }
}