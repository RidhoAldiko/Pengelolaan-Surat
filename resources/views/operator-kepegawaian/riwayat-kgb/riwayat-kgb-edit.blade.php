@extends('layouts.main')
@section('title','Edit Kenaikan Gaji Berkala Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit data Kenaikan Gaji Berkala Pegawai</li>
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
                <form id="setting-form" method="POST" action="{{ route('pegawai-riwayat-kgb.update', $pegawai->id_riwayat_kgb) }}">
                    @method('PUT')
                    @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Kenaikan Gaji Berkala Pegawai - <code>{{ $pegawai->nip_pegawai }}</code></h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Kenaikan Gaji Berkala Pegawai dengan benar dan tepat.!</p>

                          <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai }}">
                          <div class="form-group row align-items-center">
                            <label for="nomor" class="form-control-label col-sm-3 text-md-right">KGB YAD Dari- Sampai</label>
                            <div class="col-sm-3 col-md-4">
                              <input type="date" id="mulai_berlaku" name="mulai_berlaku" class="form-control @error('mulai_berlaku') is-invalid @enderror" value="{{$pegawai->mulai_berlaku}}" >
                                  @error('mulai_berlaku')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
                            <div class="col-sm-3 col-md-4">
                              <input type="date" id="batas_berlaku" name="batas_berlaku" onfocus="(this.type='date')"  class="form-control @error('batas_berlaku') is-invalid @enderror" value="{{$pegawai->batas_berlaku}}" >
                                  @error('batas_berlaku')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
                          </div>
    
                          <div class="form-group row align-items-center">
                            <label for="penjabat" class="form-control-label col-sm-3 text-md-right">Penjabat</label>
                            <div class="col-sm-6 col-md-9">
                              <input type="text" id="penjabat" name="penjabat"  class="form-control @error('penjabat') is-invalid @enderror" value="{{$pegawai->penjabat}}" >
                                @error('penjabat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                          </div>
    
                          <div class="form-group row align-items-center">
                            <label for="nomor" class="form-control-label col-sm-3 text-md-right">Nomor dan Tanggal</label>
                            <div class="col-sm-3 col-md-5">
                              <input type="text" id="nomor" name="nomor"  class="form-control @error('nomor') is-invalid @enderror" placeholder="nomor" value="{{$pegawai->nomor}}" >
                                  @error('nomor')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                            </div>
                            <div class="col-sm-3 col-md-4">
                              <input type="text" id="tanggal" name="tanggal" onfocus="(this.type='date')"  class="form-control @error('tanggal') is-invalid @enderror" placeholder="tanggal" value="{{$pegawai->tanggal}}" >
                                  @error('tanggal')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row align-items-center">
                            <label for="peraturan" class="form-control-label col-sm-3 text-md-right">Peraturan yang dijadikan dasar</label>
                            <div class="col-sm-6 col-md-9">
                              <input type="text" id="peraturan" name="peraturan"  class="form-control @error('peraturan') is-invalid @enderror" value="{{$pegawai->peraturan}}" >
                                @error('peraturan')
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