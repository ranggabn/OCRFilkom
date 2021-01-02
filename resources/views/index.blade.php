@extends('layout/main')

@section('title', 'FILKOM ARSIP')

@section('container')
<div class="jumbotron">
    <h1 class="text-center display-4">SISTEM ARSIP SURAT</h1>
    <p class=" text-center lead">FAKULTAS ILMU KOMPUTER</p>
    <hr class="my-3">
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-4 d-flex justify-content-center text-center">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
            <div class="card-header">MOU</div>
                <div class="media">
                <img src="{{ URL::to('/asset/img/form.png') }}" class="align-self-center mr-3" alt="...">
                    <div class="media-body"> 
                        <p class="mb-0 text-monospace text-left">UNTUK BEKERJA SAMA DENGAN FAKULTAS ILMU KOMPUTER MELALUI MOU SILAHKAN MENGISI FORMULIR YANG DISEDIAKAN</p>
                    </div>
                </div>            
                <a href="/mou" class="btn btn-outline-secondary mt-3">ISI FORMULIR</a>
            </div>
        </div>
    </div>
    <div class="col-4 d-flex justify-content-center text-center">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
            <div class="card-header">MOA</div>
                <div class="media">
                <img src="{{ URL::to('/asset/img/form.png') }}" class="align-self-center mr-3" alt="...">
                    <div class="media-body"> 
                        <p class="mb-0 text-monospace text-left">UNTUK BEKERJA SAMA DENGAN FAKULTAS ILMU KOMPUTER MELALUI MOA SILAHKAN MENGISI FORMULIR YANG DISEDIAKAN</p>
                    </div>
                </div>
                <a href="/moa" class="btn btn-outline-secondary mt-3">ISI FORMULIR</a>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection