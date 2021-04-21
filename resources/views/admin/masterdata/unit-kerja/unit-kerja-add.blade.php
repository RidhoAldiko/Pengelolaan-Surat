@extends('layouts.main')
@section('title','Tambah Unit Kerja')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Unit Kerja</h1>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Tambah Data Unit Kerja</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('data-unit_kerja.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" id="nama_unit" name="nama_unit"  class="form-control @error('nama_unit') is-invalid @enderror" placeholder="Masukan Nama Unit Kerja" value="{{old('nama_unit')}}" >
                                @error('nama_unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <a href="{{ route('data-unit_kerja.index') }}" class="btn btn-warning">Kembali</a>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection