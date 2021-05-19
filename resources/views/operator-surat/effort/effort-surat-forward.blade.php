@extends('layouts.main')
@section('title','Effort Surat - Teruskan')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Effort Surat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('effort-surat.index')}}">Effort Surat</a></div>
            <div class="breadcrumb-item">Teruskan Effort Surat Keluar</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Teruskan Effort Surat Keluar</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('effort-surat.store-forward')}}" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label for="id_disposisi_surat_masuk">Tujuan Effort</label>
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
                                <input type="hidden" name="id_effort_surat" id="id_effort_surat" value="{{$id}}">
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
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input @error('paraf') is-invalid @enderror" id="paraf" name="paraf" value="0">
                                <label class="form-check-label" for="paraf">Setujui Surat Keluar</label>
                                @error('paraf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <a href="{{ route('effort-surat.index') }}" class="btn btn-warning">
                                <i class="fas fa-chevron-left"></i> <span>Kembali</span>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> <span>Teruskan</span>
                            </button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection