<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\form;
use Djunehor\Number\WordToNumber;
use Stichoza\GoogleTranslate\GoogleTranslate;
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

        $tanggal = "";
        $bulan = "";
        $tahun = "";
        $no1 = "";
        $no2 = "";
        $jangka = "";
        $subBidang = "";
        $alamat = "";    
        $tr = new GoogleTranslate();
        $wordToNumber = new WordToNumber();
        $wordTransformer = $wordToNumber->getWordTransformer('en');
        print $teks;
        if (preg_match("/tanggal\s(.*?)\sbulan/", $teks, $matches6)) {
            // $tanggal = $matches6[1];
            $date = $tr->setSource()->setTarget('en')->translate($matches6[1]);
            $tanggal = $wordTransformer->toNumber($date);
        }
        if (preg_match("/bulan\s(.*?)\stahun/", $teks, $matches7)) {
            $bulan = $tr->setSource()->setTarget('en')->translate($matches7[1]);
        }else if (preg_match("/bulan\s(.*?)\stahgn/", $teks, $matches7)){
            $bulan = $tr->setSource()->setTarget('en')->translate($matches7[1]);
        }
        if (preg_match("/tahun\s(.*?)\sdi/", $teks, $matches8)) {
            $year = $tr->setSource()->setTarget('en')->translate($matches8[1]);
            $tahun = $wordTransformer->toNumber($year);
        }else if (preg_match("/tahgn\s(.*?)\sdi/", $teks, $matches8)){
            $year = $tr->setSource()->setTarget('en')->translate($matches8[1]);
            $tahun = $wordTransformer->toNumber($year);
        }
        if (preg_match("/dengan\s(.*?)\stahun/", $teks, $matches9)) {
            $until = $tr->setSource()->setTarget('en')->translate($matches9[1]);        
            $jangka = $wordTransformer->toNumber($until);
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
        if (preg_match("/berkedudukan di\s\w*(?:\W*\w)*\W*berkedudukan di\s+(\w*(?:\W*\w)*)\W*selanjutnya disebut sebagai PIHAK\W*KEDUA/", $teks, $matches4)) {
            $alamat = $matches4[1];
        }else if (preg_match("/berkedudukan di\s\w*(?:\W*\w)*\W*berkedudukan di\s+(\w*(?:\W*\w)*)\W*selanjutnya\W*disebut sebagai PIHAK\W*KEDUA/", $teks, $matches4)) {
            $alamat = $matches4[1];
        }
        $tahunSelesai = $tahun + $jangka;
        return view('moa', compact('tanggal', 'bulan', 'tahun', 'tahunSelesai', 'no1', 'no2', 'jangka', 'subBidang', 'alamat'));
    }
    public function save(Request $request)
    {
        $form = new form;
        $form->tgl_mulai = $request->tglMulai;
        $form->tgl_selesai = $request->tglSelesai;
        $form->jangka_waktu = $request->jangkaWaktu;
        $form->pks_fikom = $request->pksFilkom;
        $form->pks_mitra = $request->pksMitra;
        $form->bidang = $request->bidangKerja;
        $form->sub_bidang = $request->subBidang;
        $form->alamat = $request->alamatMitra;
        $form->tindak_lanjut = $request->tindakLanjut;
        $form->save();
        return view ('moa');
    }
}