@extends('layouts.main')
@section('title',' Edit Alamat Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit data Alamat pegawai</li>
        </ol>
    </div>
    <a href="{{ route('data-pegawai.edit',$pegawai->nip_pegawai) }}" class="btn btn-sm btn-warning mb-3 ml-3">Kembali</a>
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="setting-form" method="POST" action="{{ route('data-alamat.update',$pegawai->id_alamat) }}">
                    @method('PUT')
                    @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Alamat Pegawai dengan NIP - <code>{{ $pegawai->nip_pegawai }}</code></h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Alamat pegawai dengan benar dan tepat.!</p>
                        
                        <form action="" method="POST">
                            @csrf
                            <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai }}">
                            <div class="form-group row left-items-center">
                                <label for="jalan" class="form-control-label col-sm-3 text-md-right">Jalan</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="text" id="jalan" name="jalan" value="{{ $pegawai->jalan }}"  class="form-control @error('jalan') is-invalid @enderror" >
                                    @error('jalan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row left-items-center">
                                <label for="kelurahan_desa" class="form-control-label col-sm-3 text-md-right">Kelurahan / Desa</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="text" id="kelurahan_desa" name="kelurahan_desa" value="{{ $pegawai->kelurahan_desa }}"  class="form-control @error('kelurahan_desa') is-invalid @enderror" >
                                    @error('kelurahan_desa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row left-items-center">
                                <label for="kecamatan" class="form-control-label col-sm-3 text-md-right">Kecamatan</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="text" id="kecamatan" name="kecamatan" value="{{ $pegawai->kecamatan }}"  class="form-control @error('kecamatan') is-invalid @enderror" >
                                    @error('kecamatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row left-items-center">
                                <label for="kabupaten_kota" class="form-control-label col-sm-3 text-md-right">Kabupaten / Kota</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="text" id="kabupaten_kota" name="kabupaten_kota" value="{{ $pegawai->kabupaten_kota }}" class="form-control @error('kabupaten_kota') is-invalid @enderror" >
                                    @error('kabupaten_kota')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row left-items-center">
                                <label for="provinsi" class="form-control-label col-sm-3 text-md-right">Provinsi</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="text" id="provinsi" name="provinsi" value="{{ $pegawai->provinsi }}" class="form-control @error('provinsi') is-invalid @enderror" >
                                    @error('provinsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                           
                        </form> 

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