@extends('layouts.main')
@section('title','Unit Kerja | Tambah Staf Ahli')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Unit Kerja</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{route('data-unit_kerja.index')}}">Data Unit Kerja</a>
            </div>
            <div class="breadcrumb-item">Ubah Data Asisten</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Ubah Data Asisten</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('asisten.update',$result->id_asisten) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="text" id="nama_asisten" name="nama_asisten"  class="form-control @error('nama_asisten') is-invalid @enderror" placeholder="Masukan Unit Keja Asisten" value="{{$result->nama_asisten}}" >
                                @error('nama_asisten')
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