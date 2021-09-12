@extends('layouts.main')
@section('title','Tambah Diklat Penjenjangan Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah data Diklat Penjenjangan Pegawai</li>
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
                <form id="setting-form" method="POST" action="{{ route('pegawai-diklat-penjenjangan.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Diklat Penjenjangan Pegawai</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Diklat Penjenjangan pegawai dengan benar dan tepat.!</p>
                     
                      <div class="form-group row align-items-center">
                        <label for="nip_pegawai" class="form-control-label col-sm-3 text-md-right">Pegawai</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" name="nip_pegawai" id="nip_pegawai" class="form-control search-input @error('nip_pegawai') is-invalid @enderror" placeholder="Masukan NIP Pegawai" autocomplete="off">
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
                        <label for="nama_diklat" class="form-control-label col-sm-3 text-md-right">Nama Diklat Penjenjangan</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="nama_diklat" name="nama_diklat"  class="form-control @error('nama_diklat') is-invalid @enderror" value="{{old('nama_diklat')}}" >
                            @error('nama_diklat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tahun" class="form-control-label col-sm-3 text-md-right">Tahun</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="tahun" name="tahun"  class="form-control @error('tahun') is-invalid @enderror" value="{{old('tahun')}}" >
                            @error('tahun')
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
                          <input type="text" id="tanggal" name="tanggal" autocomplete="off" class="form-control datepicker @error('tanggal') is-invalid @enderror" placeholder="tanggal" value="{{old('tanggal')}}" >
                              @error('tanggal')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                      </div>

                    </div>
                    <div class="card-footer bg-whitesmoke">
                      <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah data ini ingin disimpan?')"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
        </div>
    </div>
</section>
@endsection