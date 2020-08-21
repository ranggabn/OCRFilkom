<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Spatie\PdfToImage\Pdf;
use Org_Heigl\Ghostscript\Ghostscript;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Http\Request;

class UploadController extends Controller{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        $pdf_file = storage_path("");
        $output_path = "\images\\foto2.png";
        
        Ghostscript::setGsPath("C:\Program Files\gs\gs9.52\bin\gswin64c.exe");
        $pdf = new Pdf($pdf_file);
        $pdf->setOutputFormat('png')->saveImage($output_path);

        $tesseract = new TesseractOCR(public_path($output_path));
        $text =  $tesseract->run();
        echo $text;
    }
    public function uploadFile(Request $req)
    {
        $pdfs = $req->file('uploadPDF')->store('public');
        return "File has been uploaded successfully!";
    }
}