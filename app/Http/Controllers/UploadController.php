<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\PdfToImage\Pdf;
use Org_Heigl\Ghostscript\Ghostscript;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create(Request $request)
    {
        $pdfs = $request->file('uploadPDF')->store('public');
        $pdf_file = storage_path('app/public') . substr($pdfs, 6);
        $name = explode(".", substr($pdfs, 7));
        $output_path = storage_path("app/images//$name[0]-%d");

        Ghostscript::setGsPath("C:\Program Files\gs\gs9.52\bin\gswin64c.exe");
        $pdf = new Pdf($pdf_file);
        $pdf->setOutputFormat('png')->saveImage($output_path);

        $files = scandir(storage_path('app/images'));
        $sorted = array();
        foreach ($files as $file) {
            $exploded = explode("-", $file);
            if($exploded[0] == $name[0]){
                array_push($sorted,$file);
            }
        }
        foreach($sorted as $text){
            $tesseract = new TesseractOCR(storage_path("app/images/").$text);
            print($tesseract->run());
        }
    }
}