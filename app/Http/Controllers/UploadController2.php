<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\PdfToText\Pdf;
use Illuminate\Http\Request;

class UploadController2 extends Controller
{

    public function moa()
    {
        return view('moa');
    }

    public function create2(Request $request)
    {
        $pdfs = $request->file('uploadPDF')->store('public');
        $path = 'c:/Program Files/Git/mingw64/bin/pdftotext';
        $teks = Pdf::getText(storage_path('app/public') . substr($pdfs, 6), $path);

        $no1 = "";
        $no2 = "";
        $jenis = "";
        $alamat = "";
        if (preg_match("/Nomor :\s+(\w*(?:\W*\w)*)\W*Nomor/", $teks, $matches2)) {
            $no1 = $matches1[1];
        }else if (preg_match("/Nomor\s+(\w*(?:\W*\w)*)\W*Nomor/", $teks, $matches2)) {
            $no1 = $matches1[1];
        }
        if (preg_match("/Nomor:\s+(\w*(?:\W*\w)*)\W*Pada/", $teks, $matches3)) {                
            $no2 = $matches2[1];
        }
        if (preg_match("/Penyelenggaraan\s(.*)\,/", $teks, $matches4)) {
            $bidang = $matches3[1];                
        }
        if (preg_match("/berkedudukan di\s\w*(?:\W*\w)*\W*berkedudukan di\s+(\w*(?:\W*\w)*)\W*selanjutnya disebut sebagai PIHAK\W*KEDUA/", $teks, $matches5)) {
            $alamat = $matches4[1];
        }else if (preg_match("/berkedudukan di\s\w*(?:\W*\w)*\W*berkedudukan di\s+(\w*(?:\W*\w)*)\W*selanjutnya\W*disebut sebagai PIHAK\W*KEDUA/", $teks, $matches5)) {
            $alamat = $matches4[1];
        }
        return view('moa', compact('inputMitra', 'no1', 'no2', 'bidang', 'alamat'));
    }
}