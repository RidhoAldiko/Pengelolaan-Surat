@extends('layouts.main')
@section('title','Tambah Pengguna')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pengguna Sistem</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('data-pengguna.index')}}">Pengguna Sistem</a></div>
            <div class="breadcrumb-item">Tambah Pengguna Sistem</div>
        </div>
    </div>

    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Tambah Pengguna Sistem</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('data-pengguna.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="nip_pegawai">NIP Pegawai</label>
                                <input type="text" name="nip_pegawai" id="nip_pegawai" class="form-control search-input-admin @error('nip_pegawai') is-invalid @enderror" placeholder="Masukan NIP / Nama Pegawai" value="{{old('nip_pegawai')}}">
                                <div class="row">
                                    <div class="col-md-8 search-result-admin">
                                    </div>
                                </div>
                                @error('nip_pegawai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email Pegawai</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"  id="email" name="email" placeholder="Masukan Email Pegawai" value="{{old('email')}}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <a href="{{ route('data-pengguna.index') }}" class="btn btn-warning"><i class="fas fa-chevron-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i><span> Simpan</span></button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

