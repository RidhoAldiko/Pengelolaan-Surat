@extends('layouts.main')
@section('title','Tambah Pengguna')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Pengguna</h1>
    </div>

    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Masukan NIP / Nama Pegawai" >
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control"  id="email" name="email" placeholder="Masukan Email Pengguna">
                            </div>
                            <div class="form-group">
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option> --Pilih Hak Akses-- </option>
                                <option>1</option>
                            </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection