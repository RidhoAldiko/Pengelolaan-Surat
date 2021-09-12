@extends('layouts.main')
@section('title','Tambah Pengalaman Keluar Negeri')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah data Pengalaman Keluar Negeri</li>
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
                <form id="setting-form" method="POST" action="{{ route('pegawai-pengalaman-keluar-negeri.store') }}">
                  @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Pengalaman Keluar Negeri</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Pengalaman Keluar Negeri dengan benar dan tepat.!</p>
                     
                      <div class="form-group row align-items-center">
                        <label for="nip_pegawai" class="form-control-label col-sm-3 text-md-right">Pegawai</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" name="nip_pegawai" id="nip_pegawai" class="form-control search-input  @error('nip_pegawai') is-invalid @enderror" placeholder="Masukan NIP Pegawai" autocomplete="off">
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
                        <label for="negara" class="form-control-label col-sm-3 text-md-right">Negara</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="negara" name="negara"  class="form-control @error('negara') is-invalid @enderror" value="{{old('negara')}}" >
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
                            <input type="text" id="tujuan" name="tujuan"  class="form-control @error('tujuan') is-invalid @enderror" value="{{ old('tujuan') }}" >
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
                          <input type="text" id="lama" name="lama"  class="form-control @error('lama') is-invalid @enderror" value="{{old('lama')}}" >
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
                          <input type="text" id="membiayai" name="membiayai"  class="form-control @error('membiayai') is-invalid @enderror" value="{{old('membiayai')}}" >
                            @error('membiayai')
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