@extends('layouts.main')
@section('title','Golongan | Tambah')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Golongan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('data-golongan.index')}}">Data Golongan</a></div>
            <div class="breadcrumb-item">Tambah Data Golongan</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Tambah Data Golongan</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('data-golongan.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" id="nama_golongan" name="nama_golongan"  class="form-control @error('nama_golongan') is-invalid @enderror" placeholder="Masukan Nama Golongan" value="{{old('nama_golongan')}}" >
                                @error('nama_golongan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <a href="{{ route('data-golongan.index') }}" class="btn btn-warning">
                                <i class="fas fa-chevron-left"></i> <span>Kembali</span>
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