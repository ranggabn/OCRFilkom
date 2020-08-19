<?php

namespace App\Http\Controllers;
use Spatie\PdfToImage\Pdf;
use Org_Heigl\Ghostscript\Ghostscript;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Http\Request;

class PDFController extends Controller{
    public function index()
    {
        $pdf_file = public_path() . "\pdf\\file.pdf";
        $output_path = public_path() . "\images\\foto2.png";
        
        Ghostscript::setGsPath("C:\Program Files\gs\gs9.52\bin\gswin64c.exe");
        $pdf = new Pdf($pdf_file);
        $pdf->setOutputFormat('png')->saveImage($output_path);

        $tesseract = new TesseractOCR(public_path("\images\\foto2.png"));
        $text =  $tesseract->run();
        echo $text;
    }

    public function create()
    {
        return view('index');
    }
}