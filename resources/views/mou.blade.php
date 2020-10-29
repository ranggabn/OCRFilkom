@extends('layout/main')

@section('title', 'FORM MOU')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-10">
        <form method="POST" action="upload" enctype="multipart/form-data" name="uploadForm">
        {{ csrf_field() }}
            <div class="form-group mt-5">
                <label for="upload">Masukkan Dokumen Kerjasama MOU(PDF File)</label>
                <input type="file" class="form-control-file" id="uploadPDF" name="uploadPDF">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <form method="POST" action="submit" name="FormMOU">
        {{ csrf_field() }}
                <div class="form-group mt-5">
                    <label for="inputMitra">Mitra Kerjasama</label>
                    <input type="text" class="form-control" name="inputMitra" id="inputMitra" placeholder="Mitra Kerjasama" value="{{ isset($inputMitra) ? $inputMitra : '' }}">
                </div>
                <div class="form-group">
                    <label for="mouFilkom">Nomor MOU</label>
                    <input type="text" class="form-control" name="mouFilkom" id="mouFilkom" placeholder="Nomor MOU Filkom" value="{{ isset($no1) ? $no1 : '' }}">
                    <input type="text" class="form-control mt-2" name="mouMitra" id="mouMitra" placeholder="Nomor MOU Mitra Kerjasama" value="{{ isset($no2) ? $no2 : '' }}">
                </div>
                <div class="form-group">
                    <label for="tanggalMou">Tanggal MOU</label>
                    <input type="text" class="form-control" name="tglMulai" id="tglMulai" placeholder="Tanggal Mulai" value="{{ isset($tanggal) ? $tanggal : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($bulan) ? $bulan : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($tahun) ? $tahun : '' }}">
                    <input type="text" class="form-control mt-2" name="tglSelesai" id="tglSelesai" placeholder="Tanggal Selesai" value="{{ isset($tanggal) ? $tanggal : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($bulan) ? $bulan : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($tahunSelesai) ? $tahunSelesai : '' }}">
                    <input type="text" class="form-control mt-2" name="jangkaWaktu" id="jangkaWaktu" placeholder="Jangka Waktu" value="{{ isset($jangka) ? $jangka : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($add) ? $add : '' }}">
                </div>
                <div class="form-group">
                    <label for="bidangKerja">Bidang Kerjasama</label>
                    <input type="text" class="form-control" name="bidangKerja" id="bidangKerja" placeholder="Bidang Kerja Sama" value="{{ isset($jenis) ? $jenis : '' }}">
                </div>
                <div class="form-group">
                    <label for="biaya">Biaya</label>
                    <input type="text" class="form-control" name="biaya" id="biaya" placeholder="Biaya">
                </div>
                <div class="form-group">
                    <label for="alamatMitra">Alamat Mitra</label>
                    <input type="text" class="form-control" name="alamatMitra" id="alamatMitra" placeholder="Alamat" value="{{ isset($alamat) ? $alamat : '' }}">
                </div>
                <div class="form-group">
                    <label for="tindakLanjut">Tindak Lanjut MOU</label>
                    <input type="text" class="form-control" name="tindakLanjut" id="tindakLanjut" placeholder="Tindak Lanjut MOU">
                </div>
            <button type="submit" class="btn btn-primary mt-2 mb-5">Submit</button>
        </form>
    </div>
</div>
</div>
@endsection


