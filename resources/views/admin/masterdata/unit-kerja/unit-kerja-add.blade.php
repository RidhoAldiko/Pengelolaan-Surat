@extends('layouts.main')
@section('title','Unit Kerja | Tambah')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Unit Kerja</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{route('data-unit_kerja.index')}}">Data Unit Kerja</a>
            </div>
            <div class="breadcrumb-item">Tambah Data Unit Kerja</div>
        </div>
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
                                <label for="id_jabatan">Jabatan</label>
                                <select class="form-control @error('id_jabatan') is-invalid @enderror" id="id_jabatan" name="id_jabatan">
                                    <option selected disabled> --Pilih Jabatan Pegawai-- </option>
                                    @foreach ($results as $result)
                                    <option value="{{$result->id_jabatan}}">{{$result->nama_jabatan}}</option>
                                    @endforeach
                                </select>
                                @error('id_jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" id="nama_unit" name="nama_unit"  class="form-control @error('nama_unit') is-invalid @enderror" placeholder="Masukan Nama Unit Kerja" value="{{old('nama_unit')}}" >
                                @error('nama_unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <a href="{{ route('data-unit_kerja.index') }}" class="btn btn-warning">
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