@extends('layouts.main')
@section('title','Tambah Kenaikan Gaji Berkala Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah data Kenaikan Gaji Berkala Pegawai</li>
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
                <form id="setting-form" method="POST" action="{{ route('pegawai-riwayat-kgb.store') }}">
                  @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Kenaikan Gaji Berkala Pegawai</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Kenaikan Gaji Berkala Pegawai dengan benar dan tepat.!</p>
                     
                      <div class="form-group row align-items-center">
                        <label for="nip_pegawai" class="form-control-label col-sm-3 text-md-right">Pegawai</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" name="nip_pegawai" id="nip_pegawai" class="form-control search-input @error('nip_pegawai') is-invalid @enderror" placeholder="Masukan NIP Pegawai" >
                          <div class="row">
                              <div class="col-md-12 search-result">
                              </div>
                          </div>
                          @error('nip_pegawai')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="nomor" class="form-control-label col-sm-3 text-md-right">KGB YAD</label>
                        <div class="col-sm-3 col-md-4">
                          <input type="text" id="mulai_berlaku" name="mulai_berlaku" onfocus="(this.type='date')"  class="form-control @error('mulai_berlaku') is-invalid @enderror" placeholder="Dari" value="{{old('mulai_berlaku')}}" >
                              @error('mulai_berlaku')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                        <div class="col-sm-3 col-md-4">
                          <input type="text" id="batas_berlaku" name="batas_berlaku" onfocus="(this.type='date')"  class="form-control @error('batas_berlaku') is-invalid @enderror" placeholder="Sampai" value="{{old('batas_berlaku')}}" >
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
                          <input type="text" id="penjabat" name="penjabat"  class="form-control @error('penjabat') is-invalid @enderror" value="{{old('penjabat')}}" >
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
                          <input type="text" id="nomor" name="nomor"  class="form-control @error('nomor') is-invalid @enderror" placeholder="nomor" value="{{old('nomor')}}" >
                              @error('nomor')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                        </div>
                        <div class="col-sm-3 col-md-4">
                          <input type="text" id="tanggal" name="tanggal" onfocus="(this.type='date')"  class="form-control @error('tanggal') is-invalid @enderror" placeholder="tanggal" value="{{old('tanggal')}}" >
                              @error('tanggal')
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