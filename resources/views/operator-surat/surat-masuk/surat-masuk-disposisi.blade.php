@extends('layouts.main')
@section('title','Surat Masuk - Disposisi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Disposisi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('surat-masuk.index')}}">Surat Masuk</a></div>
            <div class="breadcrumb-item">Disposisi Surat</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Disposisi Surat masuk</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('disposisi-surat-masuk.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="indeks">indeks</label>
                                <input type="hidden" name="id_surat_masuk" id="id_surat_masuk" value="{{$id}}">
                                <input type="text" id="indeks" name="indeks"  class="form-control @error('indeks') is-invalid @enderror" placeholder="Masukan indeks" value="{{old('indeks')}}" >
                                @error('indeks')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_disposisi">Tanggal Disposisi</label>
                                <input type="text" id="tanggal_disposisi" name="tanggal_disposisi" onfocus="(this.type='date')"  class="form-control @error('tanggal_disposisi') is-invalid @enderror" placeholder="Masukan tanggal penyelesaian" value="{{old('tanggal_disposisi')}}" >
                                @error('tanggal_disposisi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <a href="{{ route('surat-masuk.index') }}" class="btn btn-warning">
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