@extends('layouts.main')
@section('title','Surat Masuk - Disposisi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Teruskan Disposisi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('disposisi-surat-masuk.index')}}">Disposisi Surat Masuk</a></div>
            <div class="breadcrumb-item">Teruskan Disposisi Surat</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Teruskan Disposisi Surat masuk</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('disposisi-surat-masuk.store-forward')}}" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label for="id_disposisi_surat_masuk">Tujuan Disposisi</label>
                                <input type="text" name="id" id="id" class="form-control search-input-surat @error('id') is-invalid @enderror" placeholder="Masukan Nama / Unit Kerja" value="{{old('id')}}">
                                <div class="row">
                                    <div class="col-md-8 search-result-surat">
                                    </div>
                                </div>
                                @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input type="hidden" name="id_disposisi_surat_masuk" id="id_disposisi_surat_masuk" value="{{$id}}">
                            </div>

                            <div class="form-group">
                                <label for="instruksi">Instruksi / Informasi</label>
                                <textarea class="form-control @error('instruksi') is-invalid @enderror" id="instruksi" name="instruksi" rows="3">{{old('instruksi')}}</textarea>
                                @error('instruksi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <a href="{{ route('disposisi-surat-masuk.index') }}" class="btn btn-warning">
                                <i class="fas fa-chevron-left"></i> <span>Kembali</span>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> <span>Disposisi</span>
                            </button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection