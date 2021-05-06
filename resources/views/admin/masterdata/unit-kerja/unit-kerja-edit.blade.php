@extends('layouts.main')
@section('title','Unit Kerja | Edit')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Unit Kerja</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{route('data-unit_kerja.index')}}">Data Unit Kerja</a>
            </div>
            <div class="breadcrumb-item">Ubah Data Unit Kerja</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Ubah Data Unit Kerja</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('data-unit_kerja.update',$item->id_unit) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="text" id="nama_unit" name="nama_unit"  class="form-control @error('nama_unit') is-invalid @enderror" placeholder="Masukan Nama Unit Kerja" value="{{ $item->nama_unit }}" >
                                @error('nama_unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="{{ $item->status }}"> {{ $item->status == '0' ? 'Aktif' : 'Nonaktif' }} </option>
                                    <option value="0"> Aktif </option>
                                    <option value="1"> Nonaktif </option>
                                </select>
                                @error('status')
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
