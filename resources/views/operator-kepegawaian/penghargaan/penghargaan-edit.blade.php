@extends('layouts.main')
@section('title','Edit Penghargaan Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit data Penghargaan Pegawai</li>
        </ol>
    </div>
    @if (session('status'))
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="alert shadow alert-success alert-dismissible fade show" role="alert">
          {{ session('status') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      </div>
    </div>
    @endif
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="setting-form" method="POST" action="{{ route('pegawai-penghargaan.update',$pegawai->id_penghargaan) }}">
                    @method('PUT')
                    @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Penghargaan Pegawai - <code>{{ $pegawai->nip_pegawai }}</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Penghargaan pegawai dengan benar dan tepat.!</p>

                      <div class="form-group row align-items-center">
                          <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai }}">
                        <label for="nama_penghargaan" class="form-control-label col-sm-3 text-md-right">Nama Bintang/ Penghargaan</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="nama_penghargaan" name="nama_penghargaan"  class="form-control @error('nama_penghargaan') is-invalid @enderror" value="{{ $pegawai->nama_penghargaan }}" >
                            @error('nama_penghargaan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tahun" class="form-control-label col-sm-3 text-md-right">Tahun Perolehan</label>
                        <div class="col-sm-6 col-md-9">
                            <input type="number" id="tahun" name="tahun"  class="form-control @error('tahun') is-invalid @enderror" value="{{ $pegawai->tahun }}" >
                            @error('tahun')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="negara_instansi" class="form-control-label col-sm-3 text-md-right">Nama Negara/ Instansi</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="negara_instansi" name="negara_instansi"  class="form-control @error('negara_instansi') is-invalid @enderror" value="{{ $pegawai->negara_instansi }}" >
                            @error('negara_instansi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                    </div>
                    <div class="card-footer bg-whitesmoke">
                      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
        </div>
    </div>
</section>
@endsection