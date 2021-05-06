@extends('layouts.main')
@section('title','Jabatan | Tambah')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Jabatan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('data-jabatan.index')}}">Data Jabatan</a></div>
            <div class="breadcrumb-item">Tambah Data Jabatan</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Tambah Data Jabatan</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('data-jabatan.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" id="nama_jabatan" name="nama_jabatan"  class="form-control @error('nama_jabatan') is-invalid @enderror" placeholder="Masukan Nama Jabatan" value="{{old('nama_jabatan')}}" >
                                @error('nama_jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <a href="{{ route('data-jabatan.index') }}" class="btn btn-warning">
                                <i class="fas fa-chevron-left"></i> <span>Kembali<span>                             
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> <span> Simpan</span>
                            </button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection