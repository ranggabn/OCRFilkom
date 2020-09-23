@extends('layout/main')

@section('title', 'FORM MOA')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-10">
        <form method="POST" action="/upload2" enctype="multipart/form-data" name="uploadForm">
        {{ csrf_field() }}
            <div class="form-group mt-5">
                <label for="upload">Masukkan Dokumen Kerjasama MOA(PDF File)</label>
                <input type="file" class="form-control-file" id="uploadPDF" name="uploadPDF">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <form method="GET" action="/getData2" name="getForm">
                <div class="form-group mt-5">
                    <label for="tanggalMou">Tanggal PKS MOA</label>
                    <input type="text" class="form-control" id="tglMulai" placeholder="Tanggal PKS Mulai">
                    <input type="text" class="form-control mt-2" id="tglSelesai" placeholder="Tanggal PKS Selesai">
                    <input type="text" class="form-control mt-2" id="jangkaWaktu" placeholder="Jangka Waktu PKS">
                </div>
                <div class="form-group">
                    <label for="mouFilkom">Nomor PKS MOA</label>
                    <input type="text" class="form-control" id="mouFilkom" placeholder="Nomor PKS FILKOM" value="{{ isset($no1) ? $no1 : '' }}">
                    <input type="text" class="form-control mt-2" id="mouMitra" placeholder="Nomor PKS Mitra Kerjasama" value="{{ isset($no2) ? $no2 : '' }}">
                </div>
                <div class="form-group">
                    <label for="bidangKerja">Bidang Kerjasama</label>
                    <input type="text" class="form-control" id="bidangKerja" placeholder="Bidang Kerja Sama" value="{{ isset($bidang) ? $bidang : '' }}">
                </div>
                <div class="form-group">
                    <label for="biaya">Sub Bidang Kerjasama</label>
                    <input type="text" class="form-control" id="biaya" placeholder="Sub Bidang Kerjasama">
                </div>
                <div class="form-group">
                    <label for="alamatMitra">Alamat Mitra</label>
                    <input type="text" class="form-control" id="alamatMitra" placeholder="PKS" value="{{ isset($alamat) ? $alamat : '' }}">
                </div>
                <div class="form-group">
                    <label for="tindakLanjut">Tindak Lanjut PKS</label>
                    <input type="text" class="form-control" id="tindakLanjut" placeholder="Tindak Lanjut PKS">
                </div>
            <button type="submit" class="btn btn-primary mt-2 mb-5">Submit</button>
        </form>
    </div>
</div>
</div>
@endsection


