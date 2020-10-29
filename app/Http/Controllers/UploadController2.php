<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Djunehor\Number\WordToNumber;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Org_Heigl\Ghostscript\Ghostscript;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Spatie\PdfToText\Pdf;
use Illuminate\Http\Request;
use Spatie\PdfToImage\Pdf as PdfToImagePdf;

class UploadController2 extends Controller
{

    public function moa()
    {
        return view('moa');
    }

    public function create2(Request $request)
    {
        $pdfs = $request->file('uploadPDF');
        $stored = $pdfs->store('public');
        $filecontent = file_get_contents($pdfs);
        if (preg_match("/\W*BaseFont/", $filecontent)) {
            $path = 'c:/Program Files/Git/mingw64/bin/pdftotext';
            $teks = Pdf::getText(storage_path('app/public') . substr($stored, 6), $path);

            $tanggal = "";
            $bulan = "";
            $tahun = "";
            $no1 = "";
            $no2 = "";
            $jangka = "";
            $subBidang = "";
            $alamat = "";
            $cp1 = " " ;
            $cp2 = " ";
            $tr = new GoogleTranslate();
            $wordToNumber = new WordToNumber();
            $wordTransformer = $wordToNumber->getWordTransformer('en');
            if (preg_match("/tanggal\s(.*?)\sbulan/", $teks, $matches6)) {
                $date = $tr->setSource()->setTarget('en')->translate($matches6[1]);
                $tanggal = $wordTransformer->toNumber($date);
            }
            if (preg_match("/bulan\s(.*?)\stahun/", $teks, $matches7)) {
                $bulan = $tr->setSource()->setTarget('en')->translate($matches7[1]);
            }else if (preg_match("/bulan\s(.*?)\stahgn/", $teks, $matches7)){
                $bulan = $tr->setSource()->setTarget('en')->translate($matches7[1]);
            }else if (preg_match("/bulan\s(.*?)\sTahun/", $teks, $matches7)) {
                $bulan = $tr->setSource()->setTarget('en')->translate($matches7[1]);
            }
            if (preg_match("/tahun\s(.*?)\sdi/", $teks, $matches8)) {
                $year = $tr->setSource()->setTarget('en')->translate($matches8[1]);
                $tahun = $wordTransformer->toNumber($year);
            }else if (preg_match("/tahgn\s(.*?)\sdi/", $teks, $matches8)){
                $year = $tr->setSource()->setTarget('en')->translate($matches8[1]);
                $tahun = $wordTransformer->toNumber($year);
            }else if (preg_match("/Tahun\s+(\w*(?:\W*\w)*)\W*di Malang/", $teks, $matches8)){
                $year = $tr->setSource()->setTarget('en')->translate($matches8[1]);
                $tahun = $wordTransformer->toNumber($year);
            }else {
                $tahun = 0;
            }
            if (preg_match("/dengan\s(.*?)\stahun/", $teks, $matches9)) {
                $until = $tr->setSource()->setTarget('en')->translate($matches9[1]);        
                $jangka = $wordTransformer->toNumber($until);
            }else {
                $jangka = 0;
            }
            if (preg_match("/Nomor :\s+(\w*(?:\W*\w)*)\W*Nomor/", $teks, $matches1)) {
                $no1 = $matches1[1];
            }else if (preg_match("/Nomor\s+(\w*(?:\W*\w)*)\W*Nomor/", $teks, $matches1)) {
                $no1 = $matches1[1];
            }
            if (preg_match("/Nomor:\s+(\w*(?:\W*\w)*)\W*Pada/", $teks, $matches2)) {                
                $no2 = $matches2[1];
            }
            if (preg_match("/Penyelenggaraan\s(.*)\,/", $teks, $matches3)) {
                $subBidang = $matches3[1];                
            }
            if (preg_match("/Telpon\W*(\w*(?:\W*\w*))\W*Faksimili/", $teks, $matches10)) {
                $cp1 = $matches10[1];
            }
            if (preg_match("/Telpon\W*\w*(?:\W*\w)*\W*Telpon\W*(\w*(?:\W*\w)*)\W*Faksimili/", $teks, $matches11)) {
                $cp2 = $matches11[1];
            }   
            if (preg_match("/berkedudukan di\s\w*(?:\W*\w)*\W*berkedudukan di\s+(\w*(?:\W*\w)*)\W*selanjutnya disebut sebagai PIHAK\W*KEDUA/", $teks, $matches4)) {
                $alamat = $matches4[1];
            }else if (preg_match("/berkedudukan di\s\w*(?:\W*\w)*\W*berkedudukan di\s+(\w*(?:\W*\w)*)\W*selanjutnya\W*disebut sebagai PIHAK\W*KEDUA/", $teks, $matches4)) {
                $alamat = $matches4[1];
            }
            $tahunSelesai = $tahun + $jangka;
            $spasi = " ";
            $add = "tahun";
            return view('moa', compact('cp1', 'cp2', 'tahunSelesai', 'spasi', 'add', 'tanggal', 'bulan', 'tahun', 'no1', 'no2', 'jangka', 'subBidang', 'alamat'));
        }else {
            $pdf_file = storage_path('app/public') . substr($stored, 6);
            $name = explode(".", substr($stored, 7));
            $output_path = storage_path("app/images//$name[0]-%d");

            Ghostscript::setGsPath("C:\Program Files\gs\gs9.52\bin\gswin64c.exe");
            $pdf = new PdfToImagePdf($pdf_file);
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
            $tanggal = " ";
            $bulan = " ";
            $tahun = " ";
            $jangka = " ";
            $alamat = "";
            $tr = new GoogleTranslate();
            $wordToNumber = new WordToNumber();
            $wordTransformer = $wordToNumber->getWordTransformer('en');        
            foreach($sorted as $images){
                $tesseract = new TesseractOCR(storage_path("app/images/").$images);
                $teks = $tesseract->run();
                if (preg_match("/tanggal\s(.*?)\sbulan/", $teks, $matches6)) {
                    $date = $tr->setSource()->setTarget('en')->translate($matches6[1]);
                    $tanggal = $wordTransformer->toNumber($date);
                }
                if (preg_match("/bulan\s(.*?)\stahun/", $teks, $matches7)) {
                    $bulan = $tr->setSource()->setTarget('en')->translate($matches7[1]);
                }else if (preg_match("/bulan\s(.*?)\stahgn/", $teks, $matches7)){
                    $bulan = $tr->setSource()->setTarget('en')->translate($matches7[1]);
                }else if (preg_match("/bulan\s(.*?)\sTahun/", $teks, $matches7)) {
                    $bulan = $tr->setSource()->setTarget('en')->translate($matches7[1]);
                }
                if (preg_match("/tahun\s(.*?)\sdi/", $teks, $matches8)) {
                    $year = $tr->setSource()->setTarget('en')->translate($matches8[1]);
                    $tahun = $wordTransformer->toNumber($year);
                }else if (preg_match("/tahgn\s(.*?)\sdi/", $teks, $matches8)){
                    $year = $tr->setSource()->setTarget('en')->translate($matches8[1]);
                    $tahun = $wordTransformer->toNumber($year);
                }else if (preg_match("/Tahun\s+(\w*(?:\W*\w)*)\W*di Malang/", $teks, $matches8)){
                    $year = $tr->setSource()->setTarget('en')->translate($matches8[1]);
                    $tahun = $wordTransformer->toNumber($year);
                }else {
                    $tahun = 0;
                }
                if (preg_match("/dengan\s(.*?)\stahun/", $teks, $matches9)) {
                    $until = $tr->setSource()->setTarget('en')->translate($matches9[1]);        
                    $jangka = $wordTransformer->toNumber($until);
                }else {
                    $jangka = 0;
                }
                if (preg_match("/Nomor :\s+(\w*(?:\W*\w)*)\W*Nomor/", $teks, $matches1)) {
                    $no1 = $matches1[1];
                }else if (preg_match("/Nomor\s+(\w*(?:\W*\w)*)\W*Nomor/", $teks, $matches1)) {
                    $no1 = $matches1[1];
                }
                if (preg_match("/Nomor:\s+(\w*(?:\W*\w)*)\W*Pada/", $teks, $matches2)) {                
                    $no2 = $matches2[1];
                }
                if (preg_match("/Penyelenggaraan\s(.*)\,/", $teks, $matches3)) {
                    $subBidang = $matches3[1];                
                }
                if (preg_match("/Telpon\W*(\w*(?:\W*\w*))\W*Faksimili/", $teks, $matches10)) {
                    $cp1 = $matches10[1];
                }
                if (preg_match("/Telpon\W*\w*(?:\W*\w)*\W*Telpon\W*(\w*(?:\W*\w)*)\W*Faksimili/", $teks, $matches11)) {
                    $cp2 = $matches11[1];
                }   
                if (preg_match("/berkedudukan di\s\w*(?:\W*\w)*\W*berkedudukan di\s+(\w*(?:\W*\w)*)\W*selanjutnya disebut sebagai PIHAK\W*KEDUA/", $teks, $matches4)) {
                    $alamat = $matches4[1];
                }else if (preg_match("/berkedudukan di\s\w*(?:\W*\w)*\W*berkedudukan di\s+(\w*(?:\W*\w)*)\W*selanjutnya\W*disebut sebagai PIHAK\W*KEDUA/", $teks, $matches4)) {
                    $alamat = $matches4[1];
                }
                $tahunSelesai = $tahun + $jangka;
                $spasi = " ";
                $add = "tahun";
                return view('moa', compact('cp1', 'cp2', 'tahunSelesai', 'spasi', 'add', 'tanggal', 'bulan', 'tahun', 'no1', 'no2', 'jangka', 'subBidang', 'alamat'));
            }
        }
    }
    public function save(Request $request)
    {
        $tanggal_mulai = $request->tglMulai;
        $tanggal_selesai = $request->tglSelesai;
        $nomor_moa_fikom = $request->pksFilkom;
        $nomor_moa_mitra = $request->pksMitra;
        $bidang_kerjasama = $request->bidangKerja;
        $sub_bidang_kerjasama = $request->subBidang;
        $cp_filkom = $request->contactFilkom;
        $cp_mitra = $request->contactMitra;
        $alamat_mitra = $request->alamatMitra;
        $tindak_lanjut = $request->tindakLanjut;
        $data = array('nomor_moa_filkom' => $nomor_moa_fikom, 'nomor_moa_mitra' => 
        $nomor_moa_mitra, 'tanggal_mulai' => $tanggal_mulai, 'tanggal_selesai' => $tanggal_selesai, 'bidang_kerjasama' => 
        $bidang_kerjasama, 'sub_bidang_kerjasama' => $sub_bidang_kerjasama, 'cp_filkom' => $cp_filkom, 'cp_mitra' => 
        $cp_mitra, 'alamat_mitra' => $alamat_mitra, 'tindak_lanjut' => $tindak_lanjut);
        DB::table('moa')->insert($data);
        return view ('moa');
    }
}