@extends('layout/main')

@section('title', 'Web Programming')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-10">
        <form method="POST" action="" enctype="multipart/form-data" name="uploadForm">
            <div class="form-group mt-5">
                <label for="upload">Masukkan Dokumen Kerjasama (PDF File)</label>
                <input type="file" class="form-control-file" id="uploadPDF" name="uploadPDF">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <form>
            <div class="form-group mt-5">
                <label for="inputNama1">Nama</label>
                <input type="text" class="form-control" id="inputNama1">
            </div>
            <div class="form-group">
                <label for="inputJenis">Jenis Kerjasama</label>
                <input type="text" class="form-control" id="InputJenis">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</div>
@endsection


