@extends('layouts.main')
@section('title','Edit Keterangan lain Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit data Keterangan lain Pegawai</li>
        </ol>
    </div>
    <a href="{{ route('data-pegawai.edit',$pegawai->nip_pegawai) }}" class="btn btn-sm btn-warning mb-3 ml-3">Kembali</a>
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="setting-form" method="POST" action="{{ route('pegawai-keterangan-lain.update', $pegawai->id_ketlain) }}">
                  @method('PUT')
                  @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Keterangan lain Pegawai - <code>{{ $pegawai->nip_pegawai }}</code></h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Keterangan lain pegawai dengan benar dan tepat.!</p>

                      <div class="form-group row align-items-center">
                          <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai }}">
                        <label for="jenis" class="form-control-label col-sm-3 text-md-right">Jenis</label>
                        <div class="col-sm-6 col-md-9">
                          <select class="form-control selectric @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
                            <option value="{{ $pegawai->jenis }}">{{ $pegawai->jenis }}</option>
                            <option value="Surat Keterangan Berkelakuan Baik">Surat Keterangan Berkelakuan Baik</option>
                            <option value="Surat Keterangan Berbadan Sehat">Surat Keterangan Berbadan Sehat</option>
                          </select>
                          @error('jenis')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="penjabat" class="form-control-label col-sm-3 text-md-right">Penjabat</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="penjabat" name="penjabat"  class="form-control @error('penjabat') is-invalid @enderror" value="{{ $pegawai->penjabat }}" >
                            @error('penjabat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="nomor" class="form-control-label col-sm-3 text-md-right">Nomor</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="nomor" name="nomor"  class="form-control @error('nomor') is-invalid @enderror" value="{{ $pegawai->nomor }}" >
                            @error('nomor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tanggal" class="form-control-label col-sm-3 text-md-right">Tanggal</label>
                        <div class="col-sm-6 col-md-9">
                            <input type="date" id="tanggal" name="tanggal"  class="form-control @error('tanggal') is-invalid @enderror" value="{{ $pegawai->tanggal }}" >
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