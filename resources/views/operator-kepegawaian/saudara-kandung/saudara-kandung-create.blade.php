@extends('layouts.main')
@section('title','Tambah Saudara Kandung Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah data Saudara Kandung Pegawai</li>
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
                <form id="setting-form" method="POST" action="{{ route('pegawai-saudara-kandung.store') }}">
                  @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Saudara Kandung Pegawai</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data saudara kandung pegawai dengan benar dan tepat.!</p>
                     
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
                        <label for="nama" class="form-control-label col-sm-3 text-md-right">Nama</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="nama" name="nama"  class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}" >
                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="jenis_kelamin" class="form-control-label col-sm-3 text-md-right">Jenis Kelamin</label>
                        <div class="col-sm-6 col-md-9">
                          <select class="form-control selectric @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                            <option selected disabled>-Pilih-</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                          </select>
                          @error('jenis_kelamin')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tgl_lahir" class="form-control-label col-sm-3 text-md-right">Tgl Lahir</label>
                        <div class="col-sm-6 col-md-9">
                            <input type="date" id="tgl_lahir" name="tgl_lahir"  class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}" >
                            @error('tgl_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="pekerjaan" class="form-control-label col-sm-3 text-md-right">Pekerjaan</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="pekerjaan" name="pekerjaan"  class="form-control @error('pekerjaan') is-invalid @enderror" value="{{old('pekerjaan')}}" >
                            @error('pekerjaan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="keterangan" class="form-control-label col-sm-3 text-md-right">Keterangan</label>
                        <div class="col-sm-6 col-md-9">
                          <textarea name="keterangan"  class="form-control" id="" cols="30" rows="10">{{old('keterangan')}}</textarea>
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