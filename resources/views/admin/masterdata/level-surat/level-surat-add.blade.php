@extends('layouts.main')
@section('title','Tambah Level Surat')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Level Surat</h1>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Tambah Data Level Surat</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('data-level_surat.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" id="nama_level" name="nama_level"  class="form-control @error('nama_level') is-invalid @enderror" placeholder="Masukan Nama Level Surat" value="{{old('nama_level')}}" >
                                @error('nama_level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="number" id="urutan_level" name="urutan_level"  class="form-control @error('urutan_level') is-invalid @enderror" placeholder="Masukan Urutan Level Surat" value="{{old('urutan_level')}}" >
                                @error('urutan_level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <a href="{{ route('data-level_surat.index') }}" class="btn btn-warning">Kembali</a>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection