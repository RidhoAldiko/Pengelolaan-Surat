@extends('layouts.main')
@section('title','Tambah Pengguna')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pengguna</h1>
    </div>

    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Tambah Data Pengguna</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="form-group">
                                <input type="text" name="nip_pegawai" id="nip_pegawai" class="form-control search-input" placeholder="Masukan NIP Pegawai" >
                                <div class="row">
                                    <div class="col-md-8 search-result">
                                    </div>
                                </div>
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