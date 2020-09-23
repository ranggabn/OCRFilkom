<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\PdfToImage\Pdf;
use Org_Heigl\Ghostscript\Ghostscript;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function mou()
    {
        return view('mou');
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
        $inputMitra = "";
        $no1 = "";
        $no2 = "";
        $jenis = "";
        $alamat = "";
        foreach($sorted as $images){
            $tesseract = new TesseractOCR(storage_path("app/images/").$images);
            $txt = $tesseract->run();
            if (preg_match("/dengan\s+(\w*(?:\W*\w)*)\W*Nomor:/", $txt, $matches1)) {
                $inputMitra = $matches1[1];
            }
            if (preg_match("/Nomor:\s(.*?)\sdengan/", $txt, $matches2)) {
                $no1 = $matches2[1];
            }else if (preg_match("/Nomur:\s(.*?)\sdengan/", $txt, $matches2)) {
                $no1 = $matches2[1];
            }
            if (preg_match("/Nomor\W*(.*?)\;/", $txt, $matches3)) {                
                $no2 = $matches3[1];
            }
            if (preg_match("/penyelenggaraan\s(.*)\:/", $txt, $matches4)) {
                $jenis = $matches4[1];                
            }else if (preg_match("/penyelenggaraan\s(.*)\;/", $txt, $matches4)) {
                $jenis = $matches4[1];
            }if (preg_match("/berkedudukan di\s+(\w*(?:\W*\w)*)\W*selanjutnya disebut sebagai PIHAK\W*KESATU/", $txt, $matches5)) {
                $alamat = $matches5[1];
            }else if (preg_match("/berkedudukan di\s+(\w*(?:\W*\w)*)\W*selanjutnya disebut sebagaj PIHAK\W*KESATU/", $txt, $matches5)) {
                $alamat = $matches5[1];
            }
        }       
        return view('mou', compact('inputMitra', 'no1', 'no2', 'jenis', 'alamat'));
    }
}