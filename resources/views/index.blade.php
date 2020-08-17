@extends('layout/main')

@section('title', 'Web Programming')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-10">
            <div class="input-group mb-3 mt-5">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile02">
                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                </div>
            <div class="input-group-append">
                <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
            </div>
        </div>

        <form>
            <div class="form-group mt-5">
                <label for="exampleInputEmail1">Nama</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Jenis Kerjasama</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
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


