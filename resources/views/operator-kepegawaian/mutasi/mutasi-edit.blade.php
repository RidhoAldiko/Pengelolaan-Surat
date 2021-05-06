@extends('layouts.main')
@section('title','Edit Mutasi Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit data Mutasi Pegawai</li>
        </ol>
    </div>
    <a href="{{ route('data-pegawai.edit',$pegawai->nip_pegawai) }}" class="btn btn-sm btn-warning mb-3 ml-3">Kembali</a>
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="setting-form" method="POST" action="{{ route('pegawai-mutasi.update',$pegawai->id_mutasi) }}">
                  @method('PUT')
                    @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Mutasi Pegawai - <code>{{ $pegawai->nip_pegawai }}</code></h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Mutasi pegawai dengan benar dan tepat.!</p>

                      <div class="form-group row align-items-center">
                          <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai }}">
                        <label for="jenis_mutasi" class="form-control-label col-sm-3 text-md-right">Jenis Mutasi</label>
                        <div class="col-sm-6 col-md-9">
                          <select class="form-control selectric @error('jenis_mutasi') is-invalid @enderror" id="jenis_mutasi" name="jenis_mutasi">
                            <option value="{{ $pegawai->jenis_mutasi }}">{{ $pegawai->jenis_mutasi }}</option>
                            <option value="Masuk">Masuk</option>
                            <option value="Keluar">Keluar</option>
                          </select>
                          @error('jenis_mutasi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="asal" class="form-control-label col-sm-3 text-md-right">Asal</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="asal" name="asal"  class="form-control @error('asal') is-invalid @enderror" value="{{ $pegawai->asal }}" >
                            @error('asal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tujuan" class="form-control-label col-sm-3 text-md-right">Tujuan Mutasi</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="tujuan" name="tujuan"  class="form-control @error('tujuan') is-invalid @enderror" value="{{ $pegawai->tujuan }}" >
                            @error('tujuan')
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