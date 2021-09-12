@extends('layouts.main')
@section('title','Tambah Mutasi Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah data Mutasi Pegawai</li>
        </ol>
    </div>
    <a href="{{ route('pegawai-mutasi.index') }}" class="btn btn-sm btn-warning ml-4">Kembali</a>
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
                <form id="setting-form" method="POST" action="{{ route('pegawai-mutasi.store') }}">
                  @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Mutasi Pegawai</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Mutasi pegawai dengan benar dan tepat.!</p>
                     
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
                        <label for="jenis_mutasi" class="form-control-label col-sm-3 text-md-right">Jenis Mutasi</label>
                        <div class="col-sm-6 col-md-9">
                          <select class="form-control selectric @error('jenis_mutasi') is-invalid @enderror" name="jenis_mutasi" id="jenis_mutasi">
                            <option selected disabled>-Pilih-</option>
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
                          <input type="text" id="asal" name="asal"  class="form-control @error('asal') is-invalid @enderror" value="{{old('asal')}}" >
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
                          <input type="text" id="tujuan" name="tujuan"  class="form-control @error('tujuan') is-invalid @enderror" value="{{old('tujuan')}}" >
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
                            <input type="text" id="tanggal" name="tanggal" autocomplete="off" class="form-control datepicker @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" >
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