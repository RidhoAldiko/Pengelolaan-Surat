@extends('layouts.main')
@section('title','Tambah Riwayat Pendidikan')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah data riwayat pendidikan</li>
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
                <form id="setting-form" method="POST" action="{{ route('riwayat-pendidikan.store') }}">
                  @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Pendidikan Pegawai</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Pendidikan pegawai dengan benar dan tepat.!</p>
                     
                      <div class="form-group row align-items-center">
                        <label for="nip_pegawai" class="form-control-label col-sm-3 text-md-right">Pegawai</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" name="nip_pegawai" id="nip_pegawai" class="form-control search-input" placeholder="Masukan NIP Pegawai" >
                          <div class="row">
                              <div class="col-md-8 search-result">
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
                        <label for="jenis_pendidikan" class="form-control-label col-sm-3 text-md-right">Jenis Pendidikan</label>
                        <div class="col-sm-6 col-md-9">
                          <select class="form-control selectric @error('jenis_pendidikan') is-invalid @enderror" id="jenis_pendidikan" name="jenis_pendidikan">
                            <option selected disabled>-Pilih-</option>
                            <option value="TK">TK</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA/SMK">SMA/SMK</option>
                            <option value="Diploma">Diploma</option>
                            <option value="Sarjana">Sarjana</option>
                            <option value="Magister">Magister</option>
                            <option value="Doktor">Doktor</option>
                          </select>
                          @error('jenis_pendidikan')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="nama_pendidikan" class="form-control-label col-sm-3 text-md-right">Nama Sekolah/Universitas</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="nama_pendidikan" name="nama_pendidikan"  class="form-control @error('nama_pendidikan') is-invalid @enderror" value="{{old('nama_pendidikan')}}" >
                            @error('nama_pendidikan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="jurusan" class="form-control-label col-sm-3 text-md-right">Jurusan</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="jurusan" name="jurusan"  class="form-control @error('jurusan') is-invalid @enderror" value="{{old('jurusan')}}" >
                            @error('jurusan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="no_sttb" class="form-control-label col-sm-3 text-md-right">Nomor STTB</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="no_sttb" name="no_sttb"  class="form-control @error('no_sttb') is-invalid @enderror" value="{{old('no_sttb')}}" >
                            @error('no_sttb')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tgl_sttb" class="form-control-label col-sm-3 text-md-right">Tanggal STTB</label>
                        <div class="col-sm-6 col-md-9">
                          <div class="form-group">
                            <input type="date" id="tgl_sttb" name="tgl_sttb" onfocus="(this.type='date')"  class="form-control @error('tgl_sttb') is-invalid @enderror" value="{{old('tgl_sttb')}}" >
                                @error('tgl_sttb')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                           </div>
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tempat" class="form-control-label col-sm-3 text-md-right">Tempat</label>
                        <div class="col-sm-6 col-md-9">
                          <textarea name="tempat"  class="form-control @error('tempat') is-invalid @enderror" id="" cols="30" rows="10">{{old('tempat')}}</textarea>
                            @error('tempat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="nama_kepsek" class="form-control-label col-sm-3 text-md-right">Nama Kepsek / Rektor</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="nama_kepsek" name="nama_kepsek"  class="form-control @error('nama_kepsek') is-invalid @enderror" value="{{old('nama_kepsek')}}" >
                            @error('nama_kepsek')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="mulai" class="form-control-label col-sm-3 text-md-right">Mulai s/d Tanggal</label>
                        <div class="col-sm-3 col-md-4">
                          <input type="text" id="mulai" name="mulai" onfocus="(this.type='date')"  class="form-control @error('mulai') is-invalid @enderror" placeholder="Mulai" value="{{old('mulai')}}" >
                              @error('mulai')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                        </div>
                        <div class="col-sm-3 col-md-4">
                          <input type="text" id="sampai" name="sampai" onfocus="(this.type='date')"  class="form-control @error('sampai') is-invalid @enderror" placeholder="Sampai" value="{{old('sampai')}}" >
                              @error('sampai')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tanda_lulus" class="form-control-label col-sm-3 text-md-right">Tanda Lulus</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="tanda_lulus" name="tanda_lulus"  class="form-control @error('tanda_lulus') is-invalid @enderror" value="{{old('tanda_lulus')}}" >
                            @error('tanda_lulus')
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