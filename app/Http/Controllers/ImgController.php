<?php

namespace App\Http\Controllers;
use Alimranahmed\LaraOCR\Facades\OCR;
use Illuminate\Http\Request;

class ImgController extends Controller{
    public function index()
    {
        
    }

    public function create()
    {
        return view('index');
    }
}