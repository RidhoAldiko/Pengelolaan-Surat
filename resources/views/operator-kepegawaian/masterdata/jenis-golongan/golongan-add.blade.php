@extends('layouts.main')
@section('title','Tambah Golongan')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Golongan</h1>
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
                            <a href="{{ route('data-golongan.index') }}" class="btn btn-warning">Kembali</a>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection