@extends('layouts.main')
@section('title','Kursus Atau Pelatihan di dalam dan Luar Negeri')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit data Kursus atau pelatihan di dalam dan luar negeri</li>
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
    <a href="{{ route('data-pegawai.edit',$pegawai->nip_pegawai) }}" class="btn btn-sm btn-warning mb-3 ml-3">Kembali</a>
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="setting-form" method="POST" action="{{ route('kursus-atau-pelatihan.update',$pegawai->id_kursus) }}">
                  @method('PUT')
                  @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Kursus/ Latihan di dalam dan luar negeri - <code>{{ $pegawai->nip_pegawai }}</code></h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data kursus atau latihan di dalam dan luar negeri pegawai dengan benar dan tepat.!</p>

                      <div class="form-group row align-items-center">
                        <label for="nama_kursus" class="form-control-label col-sm-3 text-md-right">Nama Kursus/ Pelatihan</label>
                        <div class="col-sm-6 col-md-9">
                        <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai }}">
                          <input type="text" id="nama_kursus" name="nama_kursus"  class="form-control @error('nama_kursus') is-invalid @enderror" value="{{ $pegawai->nama_kursus }}" >
                            @error('nama_kursus')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="mulai" class="form-control-label col-sm-3 text-md-right">Mulai s/d Selesai</label>
                        <div class="col-sm-3 col-md-4">
                          <input type="text" id="mulai" name="mulai" class="form-control datepicker @error('mulai') is-invalid @enderror" value="{{ date('d-m-Y',strtotime($pegawai->mulai)) }}" >
                              @error('mulai')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                        </div>
                        <div class="col-sm-3 col-md-4">
                          <input type="text" id="selesai" name="selesai" class="form-control datepicker @error('selesai') is-invalid @enderror"  value="{{ date('d-m-Y',strtotime($pegawai->selesai)) }}" >
                              @error('selesai')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tanda_lulus" class="form-control-label col-sm-3 text-md-right">Tanda Lulus</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="tanda_lulus" name="tanda_lulus"  class="form-control @error('tanda_lulus') is-invalid @enderror" value="{{ $pegawai->tanda_lulus }}" >
                            @error('tanda_lulus')
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
                          @error('tempat')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="keterangan" class="form-control-label col-sm-3 text-md-right">Keterangan</label>
                        <div class="col-sm-6 col-md-9">
                          <textarea name="keterangan"  class="form-control" id="" cols="30" rows="10">{{ $pegawai->keterangan }}</textarea>
                          @error('keterangan')
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