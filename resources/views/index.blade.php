@extends('layout/main')

@section('title', 'ARSIP FILKOM')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-10">
        <form method="POST" action="/upload" enctype="multipart/form-data" name="uploadForm">
        {{ csrf_field() }}
            <div class="form-group mt-5">
                <label for="upload">Masukkan Dokumen Kerjasama (PDF File)</label>
                <input type="file" class="form-control-file" id="uploadPDF" name="uploadPDF">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <form method="GET" action="/getData" name="getForm">
            <div class="form-group mt-5">
                    <label for="inputMitra">Mitra Kerjasama</label>
                    <input type="text" class="form-control" id="inputMitra" placeholder="Mitra Kerjasama">
                </div>
                <div class="form-group">
                    <label for="mouFilkom">Nomor MOU</label>
                    <input type="text" class="form-control" id="mouFilkom" placeholder="Nomor MOU Filkom">
                    <input type="text" class="form-control mt-2" id="mouMitra" placeholder="Nomor MOU Mitra Kerjasama">
                </div>
                <div class="form-group">
                    <label for="tanggalMou">Tanggal MOU</label>
                    <input type="text" class="form-control" id="tglMulai" placeholder="Tanggal Mulai">
                    <input type="text" class="form-control mt-2" id="tglSelesai" placeholder="Tanggal Selesai">
                    <input type="text" class="form-control mt-2" id="jangkaWaktu" placeholder="Tanggal Jangka Waktu">
                </div>
                <div class="form-group">
                    <label for="bidangKerja">Bidang Kerjasama</label>
                    <input type="text" class="form-control" id="bidangKerja" placeholder="Bidang Kerja Sama">
                </div>
                <div class="form-group">
                    <label for="biaya">Biaya</label>
                    <input type="text" class="form-control" id="biaya" placeholder="Biaya">
                </div>
                <div class="form-group">
                    <label for="contact">Contact Person</label>
                    <input type="text" class="form-control" id="contactFilkom" placeholder="FILKOM UB">
                    <input type="text" class="form-control mt-2" id="contactMitra" placeholder="Mitra Kerja Sama">
                </div>
                <div class="form-group">
                    <label for="alamatMitra">Alamat Mitra</label>
                    <input type="text" class="form-control" id="alamatMitra" placeholder="MOU">
                </div>
                <div class="form-group">
                    <label for="tindakLanjut">Tindak Lanjut MOU</label>
                    <input type="text" class="form-control" id="tindakLanjut" placeholder="Tindak Lanjut MOU">
                </div>
            <button type="submit" class="btn btn-primary mt-2 mb-5">Submit</button>
        </form>
    </div>
</div>
</div>
@endsection


