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
                        <form action="{{route('data-pengguna.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="nip_pegawai">NIP Pegawai</label>
                                <input type="number" name="nip_pegawai" id="nip_pegawai" class="form-control search-input" placeholder="Masukan NIP Pegawai" >
                                <div class="row">
                                    <div class="col-md-8 search-result">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email Pegawai</label>
                                <input type="email" class="form-control "  id="email" name="email" placeholder="Masukan Email Pegawai">
                            </div>
                            <div class="form-group">
                            <label for="nip_pegawai">Pilih Role Akses</label>
                            <select class="form-control role-user" id="role" name="role">
                                <option value="0"> Super Admin</option>
                                <option value="1"> Operator Surat</option>
                                <option value="2"> Operator Pegawai</option>
                                <option value="3"> User Disposisi</option>
                            </select>
                            </div>

                            <div class="form-group level-surat">
                                
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