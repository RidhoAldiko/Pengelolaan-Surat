@extends('layouts.main')
@section('title','Edit Organisasi Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit data Organisasi Pegawai</li>
        </ol>
    </div>
    <a href="{{ route('data-pegawai.edit',$pegawai->nip_pegawai) }}" class="btn btn-sm btn-warning mb-3 ml-3">Kembali</a>
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="setting-form" method="POST" action="{{ route('pegawai-organisasi.update',$pegawai->id_organisasi) }}">
                    @method('PUT')
                    @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Organisasi Pegawai - <code>{{ $pegawai->nip_pegawai }}</code></h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Organisasi Pegawai dengan benar dan tepat.!</p>

                      <div class="form-group row align-items-center">
                          <input type="hidden" value="{{ $pegawai->nip_pegawai }}" name="nip_pegawai">
                        <label for="waktu" class="form-control-label col-sm-3 text-md-right">Waktu Organisasi</label>
                        <div class="col-sm-6 col-md-9">
                          <select class="form-control selectric @error('waktu') is-invalid @enderror" id="waktu" name="waktu">
                            <option value="{{ $pegawai->waktu }}">{{$pegawai->waktu}}</option>
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
                          <input type="text" id="nama" name="nama"  class="form-control @error('nama') is-invalid @enderror" value="{{$pegawai->nama}}" >
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
                            <input type="text" id="kedudukan" name="kedudukan"  class="form-control @error('kedudukan') is-invalid @enderror" value="{{ $pegawai->kedudukan }}" >
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
                          <input type="number" id="tahun_mulai" name="tahun_mulai"  class="form-control @error('tahun_mulai') is-invalid @enderror" placeholder="tahun mulai" value="{{ $pegawai->tahun_mulai }}" >
                              @error('tahun_mulai')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                        </div>
                        <div class="col-sm-3 col-md-4">
                          <input type="number" id="tahun_selesai" name="tahun_selesai"  class="form-control @error('tahun_selesai') is-invalid @enderror" placeholder="tahun selesai" value="{{ $pegawai->tahun_selesai }}" >
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
                          <textarea name="tempat"  class="form-control" id="" cols="30" rows="10">{{ $pegawai->tempat }}</textarea>
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="pimpinan" class="form-control-label col-sm-3 text-md-right">Pimpinan Organisasi</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="pimpinan" name="pimpinan"  class="form-control @error('pimpinan') is-invalid @enderror" value="{{ $pegawai->pimpinan}}" >
                            @error('pimpinan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                    </div>
                    <div class="card-footer bg-whitesmoke">
                      <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah data ini ingin diubah?')"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
        </div>
    </div>
</section>
@endsection