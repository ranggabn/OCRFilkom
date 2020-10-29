<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Djunehor\Number\WordToNumber;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Spatie\PdfToImage\Pdf;
use Org_Heigl\Ghostscript\Ghostscript;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf as PdfToTextPdf;

class UploadController extends Controller
{
    public function mou()
    {
        return view('mou');
    }

    public function create(Request $request)
    {
        $pdfs = $request->file('uploadPDF');
        $stored = $pdfs->store('public');
        // dd(file_get_contents($pdfs));
        $filecontent = file_get_contents($pdfs);
        if (preg_match("/\W*BaseFont/", $filecontent)) {
            $path = 'c:/Program Files/Git/mingw64/bin/pdftotext';
            $txt = PdfToTextPdf::getText(storage_path('app/public') . substr($stored, 6), $path);
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
            if (preg_match("/tanggal\s+(\w*(?:\W*\w)*)\W*, bulan/", $txt, $matches6)) {
                $date = $tr->setSource()->setTarget('en')->translate($matches6[1]);
                $tanggal = $wordTransformer->toNumber($date);
            }
            if (preg_match("/bulan\s+(\w*(?:\W*\w)*)\W*, tahun/", $txt, $matches7)) {
                $bulan = $tr->setSource()->setTarget('en')->translate($matches7[1]);
            }
            if (preg_match("/tahun\s+(\w*(?:\W*\w)*)\W*, bertempat/", $txt, $matches8)) {
                $year = $tr->setSource()->setTarget('en')->translate($matches8[1]);
                $tahun = $wordTransformer->toNumber($year);
            }
            if (preg_match("/dengan\s(.*?)\s\W/", $txt, $matches9)) { 
                $until = $tr->setSource()->setTarget('en')->translate($matches9[1]);        
                $jangka = $wordTransformer->toNumber($until);
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
            $tahunSelesai = 0;
            $tahunSelesai = $tahun + $jangka;
            $spasi = " ";
            $add = "tahun";
            return view('mou', compact('inputMitra', 'add', 'spasi', 'no1', 'no2', 'tanggal', 'bulan', 'tahunSelesai', 'tahun', 'jangka', 'jenis', 'alamat'));
        }else{
            $pdf_file = storage_path('app/public') . substr($stored, 6);
            $name = explode(".", substr($stored, 7));
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
                if (preg_match("/tanggal\s+(\w*(?:\W*\w)*)\W*, bulan/", $txt, $matches6)) {
                    $date = $tr->setSource()->setTarget('en')->translate($matches6[1]);
                    $tanggal = $wordTransformer->toNumber($date);
                }
                if (preg_match("/bulan\s+(\w*(?:\W*\w)*)\W*, tahun/", $txt, $matches7)) {
                    $bulan = $tr->setSource()->setTarget('en')->translate($matches7[1]);
                }
                if (preg_match("/tahun\s+(\w*(?:\W*\w)*)\W*, bertempat/", $txt, $matches8)) {
                    $year = $tr->setSource()->setTarget('en')->translate($matches8[1]);
                    $tahun = $wordTransformer->toNumber($year);
                }
                if (preg_match("/dengan\s(.*?)\s\W/", $txt, $matches9)) { 
                    $until = $tr->setSource()->setTarget('en')->translate($matches9[1]);        
                    $jangka = $wordTransformer->toNumber($until);
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
            $tahunSelesai = 0;
            $tahunSelesai = $tahun + $jangka;
            $spasi = " ";
            $add = "tahun";
            return view('mou', compact('inputMitra', 'add', 'spasi', 'no1', 'no2', 'tanggal', 'bulan', 'tahunSelesai', 'tahun', 'jangka', 'jenis', 'alamat'));
        }
    }

    public function save(Request $request)
    {
        $mitra_kerjasama = $request->inputMitra;
        $nomor_mou_filkom = $request->mouFilkom;
        $nomor_mou_mitra = $request->mouMitra;
        $tanggal_mulai = $request->tglMulai;
        $tanggal_selesai = $request->tglSelesai;
        $bidang_kerjasama = $request->bidangKerja;
        $biaya = $request->biaya;
        $alamat = $request->alamatMitra;
        $tindak_lanjut = $request->tindakLanjut;
        $data = array('mitra_kerjasama' => $mitra_kerjasama, 'nomor_mou_filkom' => $nomor_mou_filkom, 'nomor_mou_mitra' => 
        $nomor_mou_mitra, 'tanggal_mulai' => $tanggal_mulai, 'tanggal_selesai' => $tanggal_selesai, 'bidang_kerjasama' => 
        $bidang_kerjasama, 'biaya' => $biaya, 'alamat' => $alamat, 'tindak_lanjut' => $tindak_lanjut);
        DB::table('mou')->insert($data);
        return view ('mou');
    }
}