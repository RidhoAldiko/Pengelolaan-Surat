@extends('layouts.main')
@section('title','Tambah Organisasi Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah data Organisasi Pegawai</li>
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
                <form id="setting-form" method="POST" action="{{ route('pegawai-organisasi.store') }}">
                  @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Organisasi Pegawai</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Organisasi Pegawai dengan benar dan tepat.!</p>
                     
                      <div class="form-group row align-items-center">
                        <label for="nip_pegawai" class="form-control-label col-sm-3 text-md-right">Pegawai</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" name="nip_pegawai" id="nip_pegawai" class="form-control search-input  @error('nip_pegawai') is-invalid @enderror" placeholder="Masukan NIP Pegawai" >
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
                        <label for="waktu" class="form-control-label col-sm-3 text-md-right">Waktu Organisasi</label>
                        <div class="col-sm-6 col-md-9">
                          <select class="form-control selectric @error('waktu') is-invalid @enderror" id="waktu" name="waktu">
                            <option selected disabled>-Pilih-</option>
                            <option value="Semasa SLTA ke bawah">Semasa SLTA ke bawah</option>
                            <option value="Semasa Perguruan Tinggi">Semasa Perguruan Tinggi</option>
                            <option value="Selesai Pendidikan atau Selama Menjadi PNS">Selesai Pendidikan atau Selama Menjadi PNS</option>
                          </select>
                          @error('waktu')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="nama" class="form-control-label col-sm-3 text-md-right">Nama Organisasi</label>
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
                        <label for="kedudukan" class="form-control-label col-sm-3 text-md-right">Kedudukan dalam Organisasi</label>
                        <div class="col-sm-6 col-md-9">
                            <input type="text" id="kedudukan" name="kedudukan"  class="form-control @error('kedudukan') is-invalid @enderror" value="{{ old('kedudukan') }}" >
                            @error('kedudukan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tahun_mulai" class="form-control-label col-sm-3 text-md-right">Tahun Mulai s/d Tahun Selesai</label>
                        <div class="col-sm-3 col-md-4">
                          <input type="number" id="tahun_mulai" name="tahun_mulai"  class="form-control @error('tahun_mulai') is-invalid @enderror" placeholder="tahun mulai" value="{{old('tahun_mulai')}}" >
                              @error('tahun_mulai')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                        </div>
                        <div class="col-sm-3 col-md-4">
                          <input type="number" id="tahun_selesai" name="tahun_selesai"  class="form-control @error('tahun_selesai') is-invalid @enderror" placeholder="tahun selesai" value="{{old('tahun_selesai')}}" >
                              @error('tahun_selesai')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tempat" class="form-control-label col-sm-3 text-md-right">Tempat</label>
                        <div class="col-sm-6 col-md-9">
                          <textarea name="tempat"  class="form-control" id="" cols="30" rows="10">{{old('tempat')}}</textarea>
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="pimpinan" class="form-control-label col-sm-3 text-md-right">Pimpinan Organisasi</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="pimpinan" name="pimpinan"  class="form-control @error('pimpinan') is-invalid @enderror" value="{{old('pimpinan')}}" >
                            @error('pimpinan')
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