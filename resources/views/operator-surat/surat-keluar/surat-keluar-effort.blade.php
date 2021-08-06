@extends('layouts.main')
@section('title','Surat Masuk - Disposisi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Approval Surat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('surat-keluar.index')}}">Surat Keluar</a></div>
            <div class="breadcrumb-item">Approval Surat</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Approval Surat Keluar</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('effort-surat.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="indeks">indeks</label>
                                <input type="hidden" name="id_surat_keluar" id="id_surat_keluar" value="{{$id}}">
                                <input type="text" id="indeks" name="indeks"  class="form-control @error('indeks') is-invalid @enderror" placeholder="Masukan indeks" value="{{old('indeks')}}" >
                                @error('indeks')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_effort">Tanggal Approval</label>
                                <input type="text" id="tanggal_effort" name="tanggal_effort"  class="form-control datepicker @error('tanggal_effort') is-invalid @enderror" placeholder="Masukan tanggal disposisi" value="{{old('tanggal_effort')}}" >
                                @error('tanggal_effort')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <a href="{{ route('surat-keluar.index') }}" class="btn btn-warning">
                                <i class="fas fa-chevron-left"></i> <span>Kembali</span>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> <span>Approve</span>
                            </button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection