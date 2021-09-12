@extends('layouts.main')
@section('title','Tambah Dokumen Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah data Dokumen Pegawai</li>
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
                <form id="setting-form" method="POST" action="{{ route('dokumen-pegawai.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Dokumen Pegawai</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Dokumen pegawai dengan benar dan tepat.!</p>
                     
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
                        <label for="nama_dokumen" class="form-control-label col-sm-3 text-md-right">Nama Dokumen</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="nama_dokumen" name="nama_dokumen"  class="form-control @error('nama_dokumen') is-invalid @enderror" value="{{old('nama_dokumen')}}" >
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
                          <textarea name="keterangan"  class="form-control" id="" cols="30" rows="10">{{old('keterangan')}}</textarea>
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="file_dokumen" class="form-control-label col-sm-3 text-md-right">Dokumen</label>
                        <div class="col-sm-6 col-md-9">
                            <input type="file" id="file_dokumen" name="file_dokumen"  class="form-control @error('file_dokumen') is-invalid @enderror" value="{{ old('file_dokumen') }}" >
                            <span class="text-warning" style="font-size: 11px">*Maksimal file berukuran 5MB.</span>
                            @error('file_dokumen')
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