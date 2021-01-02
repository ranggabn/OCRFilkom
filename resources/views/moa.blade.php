@extends('layout/main')

@section('title', 'FORM MOA')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-10">
            <form method="POST" id="form2" action="upload2" enctype="multipart/form-data" name="uploadForm" id="uploadForm">
                {{ csrf_field() }}
                <div class="form-group mt-5">
                    <label for="upload">Masukkan Dokumen Kerjasama MOA(PDF File)</label>
                    <input type="file" class="form-control-file" id="uploadPDF" name="uploadPDF" required>
                </div>
                <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                <!-- <br>
                <br>
                <div class="progress">
                    <div class="bar"></div>
                    <div class="percent">0%</div>
                </div> -->
            </form>
            <form method="POST" action="submit2" name="FormMOA">
                <div class="form-group mt-3">
                    <label for="tanggalMoa">Tanggal PKS MOA</label>
                    <input type="text" class="form-control" name="tglMulai" id="tglMulai" placeholder="Tanggal PKS Mulai" value="{{ isset($tanggal) ? $tanggal : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($bulan) ? $bulan : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($tahun) ? $tahun : '' }}" required>
                    <input type="text" class="form-control mt-2" name="tglSelesai" id="tglSelesai" placeholder="Tanggal PKS Selesai" value="{{ isset($tanggal) ? $tanggal : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($bulan) ? $bulan : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($tahunSelesai) ? $tahunSelesai : '' }}" required>
                    <input type="text" class="form-control mt-2" name="jangkaWaktu" id="jangkaWaktu" placeholder="Jangka Waktu PKS" value="{{ isset($jangka) ? $jangka : '' }}{{ isset($spasi) ? $spasi : '' }}{{ isset($add) ? $add : '' }}" required>
                </div>
                <div class="form-group">
                    <label for="noPks">Nomor PKS MOA</label>
                    <input type="text" class="form-control" name="pksFilkom" id="pksFilkom" placeholder="Nomor PKS FILKOM" value="{{ isset($no1) ? $no1 : '' }}" required>
                    <input type="text" class="form-control mt-2" name="pksMitra" id="pksMitra" placeholder="Nomor PKS Mitra Kerjasama" value="{{ isset($no2) ? $no2 : '' }}" required>
                </div>
                <label for="bidangKerja">Bidang Kerjasama</label>
                <select name="bidangKerja" id="bidangKerja" class="form-control" required>
                    <option value="" disabled selected>Bidang Kerjasama</option>
                    <option>Akademik</option>
                    <option>Kemahasiswaan</option>
                    <option>Pengabdian</option>
                    <option>Penelitian</option>
                </select>
                <div class="form-group mt-3">
                    <label for="subBidang">Sub Bidang Kerjasama</label>
                    <input type="text" class="form-control" name="subBidang" id="subBidang" placeholder="Sub Bidang Kerjasama" value="{{ isset($subBidang) ? $subBidang : '' }}">
                </div>
                <div class="form-group">
                    <label for="contact">Contact Person</label>
                    <input type="text" class="form-control" name="contactFilkom" id="contactFilkom" placeholder="FILKOM UB" value="{{ isset($cp1) ? $cp1 : '' }}">
                    <input type="text" class="form-control mt-2" name="contactMitra" id="contactMitra" placeholder="Mitra Kerja Sama" value="{{ isset($cp2) ? $cp2 : '' }}" required>
                </div>
                <div class="form-group">
                    <label for="alamatMitra">Alamat Mitra</label>
                    <input type="text" class="form-control" name="alamatMitra" id="alamatMitra" placeholder="PKS" value="{{ isset($alamat) ? $alamat : '' }}" required>
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


<!-- <script type="text/javascript">
    $("#form2").on("submit", function(event) {
        // event.preventDefault();
        console.log($(this).serialize());
        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();

                xhr.upload.addEventListener("progress", function(evt) {
                    console.log(evt);
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        console.log(percentComplete);
                        bar.width(percentComplete + "%");
                        percent.html(percentComplete);
                        if (percentComplete === 100) {

                        }

                    }
                }, false);

                return xhr;
            },
            url: "upload2",
            type: "POST",
            data: document.getElementById("uploadPDF").value,
            contentType: "multipart/form-data",
            success: function(result) {
                console.log(result);
            }
        });
    });
</script> -->
@endsection