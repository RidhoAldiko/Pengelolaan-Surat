@extends('layouts.main')
@section('title','Edit Diklat Penjenjangan Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit data Diklat Penjenjangan Pegawai</li>
        </ol>
    </div>
    <a href="{{ route('data-pegawai.edit',$pegawai->nip_pegawai) }}" class="btn btn-sm btn-warning mb-3 ml-3">Kembali</a>
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="setting-form" method="POST" action="{{ route('pegawai-diklat-penjenjangan.update',$pegawai->id_diklat) }}" enctype="multipart/form-data">
                  @method('PUT')
                    @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Diklat Penjenjangan Pegawai</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Diklat Penjenjangan pegawai dengan benar dan tepat.!</p>

                      <div class="form-group row align-items-center">
                          <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai  }}">
                        <label for="nama_diklat" class="form-control-label col-sm-3 text-md-right">Nama Diklat Penjenjangan</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="nama_diklat" name="nama_diklat"  class="form-control @error('nama_diklat') is-invalid @enderror" value="{{ $pegawai->nama_diklat}}" >
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
                          <input type="text" id="tahun" name="tahun"  class="form-control @error('tahun') is-invalid @enderror" value="{{ $pegawai->tahun }}" >
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
                          <input type="text" id="nomor" name="nomor"  class="form-control @error('nomor') is-invalid @enderror" placeholder="nomor" value="{{ $pegawai->nomor }}" >
                              @error('nomor')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                        </div>
                        <div class="col-sm-3 col-md-4">
                          <input type="text" id="tanggal" name="tanggal" onfocus="(this.type='date')"  class="form-control @error('tanggal') is-invalid @enderror" placeholder="tanggal" value="{{ $pegawai->tanggal }}" >
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