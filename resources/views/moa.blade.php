@extends('layout/main')

@section('title', 'FORM MOA')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-10">
        <form method="POST" action="upload2" enctype="multipart/form-data" name="uploadForm">
        {{ csrf_field() }}
            <div class="form-group mt-5">
                <label for="upload">Masukkan Dokumen Kerjasama MOA(PDF File)</label>
                <input type="file" class="form-control-file" id="uploadPDF" name="uploadPDF">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <form method="POST" action="submit2" name="FormMOA">
                <div class="form-group mt-5">
                    <label for="tanggalMoa">Tanggal PKS MOA</label>
                    <input type="text" class="form-control" name="tglMulai" id="tglMulai" placeholder="Tanggal PKS Mulai" value="{{ isset($tanggal) ? $tanggal : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($bulan) ? $bulan : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($tahun) ? $tahun : '' }}">
                    <input type="text" class="form-control mt-2" name="tglSelesai" id="tglSelesai" placeholder="Tanggal PKS Selesai" value="{{ isset($tanggal) ? $tanggal : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($bulan) ? $bulan : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($tahunSelesai) ? $tahunSelesai : '' }}">
                    <input type="text" class="form-control mt-2" name="jangkaWaktu" id="jangkaWaktu" placeholder="Jangka Waktu PKS" value="{{ isset($jangka) ? $jangka : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($add) ? $add : '' }}">
                </div>
                <div class="form-group">
                    <label for="noPks">Nomor PKS MOA</label>
                    <input type="text" class="form-control" name="pksFilkom" id="pksFilkom" placeholder="Nomor PKS FILKOM" value="{{ isset($no1) ? $no1 : '' }}">
                    <input type="text" class="form-control mt-2" name="pksMitra" id="pksMitra" placeholder="Nomor PKS Mitra Kerjasama" value="{{ isset($no2) ? $no2 : '' }}">
                </div>
                <label for="bidangKerja">Bidang Kerjasama</label>
                <select name="bidangKerja" id="bidangKerja" class="form-control">                    
                    <option value="" disabled selected>Bidang Kerjasama</option>
                    <option>Default select</option>
                    <option>Default select</option>
                    <option>Default select</option>
                    <option>Default select</option>
                </select>
                <div class="form-group mt-3">
                    <label for="subBidang">Sub Bidang Kerjasama</label>
                    <input type="text" class="form-control" name="subBidang" id="subBidang" placeholder="Sub Bidang Kerjasama" value="{{ isset($subBidang) ? $subBidang : '' }}">
                </div>
                <div class="form-group">
                    <label for="contact">Contact Person</label>
                    <input type="text" class="form-control" name="contactFilkom" id="contactFilkom" placeholder="FILKOM UB" value="{{ isset($cp1) ? $cp1 : '' }}">
                    <input type="text" class="form-control mt-2" name="contactMitra" id="contactMitra" placeholder="Mitra Kerja Sama" value="{{ isset($cp2) ? $cp2 : '' }}">
                </div>
                <div class="form-group">
                    <label for="alamatMitra">Alamat Mitra</label>
                    <input type="text" class="form-control" name="alamatMitra" id="alamatMitra" placeholder="PKS" value="{{ isset($alamat) ? $alamat : '' }}">
                </div>
                <div class="form-group">
                    <label for="tindakLanjut">Tindak Lanjut PKS</label>
                    <input type="text" class="form-control" name="tindakLanjut" id="tindakLanjut" placeholder="Tindak Lanjut PKS">
                </div>
            <button type="submit" class="btn btn-primary mt-2 mb-5">Submit</button>
        </form>
    </div>
</div>
</div>
@endsection


