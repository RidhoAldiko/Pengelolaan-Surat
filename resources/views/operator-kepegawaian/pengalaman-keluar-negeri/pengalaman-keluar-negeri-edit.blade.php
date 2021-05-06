@extends('layouts.main')
@section('title','Edit Pengalaman Keluar Negeri')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit data Pengalaman Keluar Negeri</li>
        </ol>
    </div>
    <a href="{{ route('data-pegawai.edit',$pegawai->nip_pegawai) }}" class="btn btn-sm btn-warning mb-3 ml-3">Kembali</a>
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="setting-form" method="POST" action="{{ route('pegawai-pengalaman-keluar-negeri.update',$pegawai->id_keluarnegri) }}">
                  @method('PUT')
                    @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Pengalaman Keluar Negeri - <code>{{ $pegawai->nip_pegawai }}</code></h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Pengalaman Keluar Negeri dengan benar dan tepat.!</p>

                      <div class="form-group row align-items-center">
                          <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai }}">
                        <label for="negara" class="form-control-label col-sm-3 text-md-right">Negara</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="negara" name="negara"  class="form-control @error('negara') is-invalid @enderror" value="{{ $pegawai->negara }}" >
                            @error('negara')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tujuan" class="form-control-label col-sm-3 text-md-right">Tujuan Kunjungan</label>
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
                        <label for="lama" class="form-control-label col-sm-3 text-md-right">Lama Kunjungan</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="lama" name="lama"  class="form-control @error('lama') is-invalid @enderror" value="{{ $pegawai->lama }}" >
                            @error('lama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="membiayai" class="form-control-label col-sm-3 text-md-right">Yang Membiayai</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="membiayai" name="membiayai"  class="form-control @error('membiayai') is-invalid @enderror" value="{{ $pegawai->membiayai }}" >
                            @error('membiayai')
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