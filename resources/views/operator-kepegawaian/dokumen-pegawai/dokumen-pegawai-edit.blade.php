@extends('layouts.main')
@section('title','Edit Dokumen Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit data Dokumen Pegawai</li>
        </ol>
    </div>
    <a href="{{ route('data-pegawai.edit',$pegawai->nip_pegawai) }}" class="btn btn-sm btn-warning mb-3 ml-3">Kembali</a>
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="setting-form" method="POST" action="{{ route('dokumen-pegawai.update',$pegawai->id_dokpegawai) }}" enctype="multipart/form-data">
                 @method('PUT')
                    @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Dokumen Pegawai</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Dokumen pegawai dengan benar dan tepat.!</p>

                      <div class="form-group row align-items-center">
                          <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai }}">
                        <label for="nama_dokumen" class="form-control-label col-sm-3 text-md-right">Nama Dokumen</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="nama_dokumen" name="nama_dokumen"  class="form-control @error('nama_dokumen') is-invalid @enderror" value="{{ $pegawai->nama_dokumen }}" >
                            @error('nama_dokumen')
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
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="file_dokumen" class="form-control-label col-sm-3 text-md-right">Bukti Lulus</label>
                        <div class="col-sm-6 col-md-9">
                            <input type="file" id="file_dokumen" name="file_dokumen"  class="form-control @error('file_dokumen') is-invalid @enderror" value="{{ $pegawai->file_dokumen }}" >
                            @error('file_dokumen')
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