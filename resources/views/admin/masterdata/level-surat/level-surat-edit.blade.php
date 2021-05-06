@extends('layouts.main')
@section('title','Level Surat | Edit ')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Level Surat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{route('data-unit_kerja.index')}}">Data Level Surat</a>
            </div>
            <div class="breadcrumb-item">Ubah Data Level Surat</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Ubah Data Level Surat</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('data-level_surat.update',$item->id_level_surat) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="text" id="nama_level" name="nama_level"  class="form-control @error('nama_level') is-invalid @enderror" placeholder="Masukan Nama Jabatan" value="{{ $item->nama_level }}" >
                                @error('nama_level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" id="urutan_level" name="urutan_level"  class="form-control @error('urutan_level') is-invalid @enderror" placeholder="Masukan Nama Jabatan" value="{{ $item->urutan_level }}" >
                                @error('urutan_level')
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
