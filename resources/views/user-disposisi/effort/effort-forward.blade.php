@extends('layouts.main')
@section('title','Approval Surat | Teruskan')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Approval Surat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('data-effort.index')}}">Approval Surat</a></div>
            <div class="breadcrumb-item">Teruskan Approval Surat Keluar</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Teruskan Approval Surat Keluar</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('data-effort.store-forward')}}" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label for="id_disposisi_surat_masuk">Tujuan Approval</label>
                                @if (Auth::user()->id_level_surat==6)
                                    <input type="text" autocomplete="off" name="id" id="id" class="form-control search-input-surat-user @error('id') is-invalid @enderror" placeholder="Masukan Nama / Unit Bagian" value="{{old('id')}}">
                                    <div class="row">
                                        <div class="col-md-8 search-result-surat-user">
                                        </div>
                                    </div>
                                    @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                @elseif (Auth::user()->id_level_surat==5)
                                    <input type="text" autocomplete="off" name="id" id="id" class="form-control search-input-surat-user @error('id') is-invalid @enderror" placeholder="Masukan Nama / Unit Asisten / Unit Staf Ahli" value="{{old('id')}}">
                                    <div class="row">
                                        <div class="col-md-8 search-result-surat-user">
                                        </div>
                                    </div>
                                    @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                @elseif (Auth::user()->id_level_surat==4 || Auth::user()->id_level_surat== 3)
                                    <div class="form-group">
                                        <select class="form-control data-id @error('id') is-invalid @enderror" id="id" name="id">
                                            <option selected disabled> --Pilih Tujuan Approval-- </option>
                                            @foreach ($result as $item)
                                            <option value="{{$item->nip_pegawai}}" > {{$item->nama_jabatan}} </option>
                                            @endforeach
                                        </select>
                                        @error('id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                @endif
                                
                                <input type="hidden" name="id_effort_surat" id="id_effort_surat" value="{{$id}}">
                            </div>

                            <div class="form-group">
                                <label for="instruksi">Instruksi / Informasi</label>
                                <textarea  class="form-control @error('instruksi') is-invalid @enderror" id="instruksi" name="instruksi" rows="3">{{old('instruksi')}}</textarea>
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

                            <a href="{{ route('data-effort.index') }}" class="btn btn-warning">
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