@extends('layouts.main')
@section('title','Edit Saudara Kandung Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit data Saudara Kandung Pegawai</li>
        </ol>
    </div>
    <a href="{{ route('data-pegawai.edit',$pegawai->nip_pegawai) }}" class="btn btn-sm btn-warning mb-3 ml-3">Kembali</a>
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="setting-form" method="POST" action="{{ route('pegawai-saudara-kandung.update',$pegawai->id_saudarakandung) }}">
                  @method('PUT')
                    @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Saudara Kandung Pegawai</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data saudara kandung pegawai dengan benar dan tepat.!</p>
                     
                      <div class="form-group row align-items-center">
                          <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai }}">
                        <label for="nama" class="form-control-label col-sm-3 text-md-right">Nama</label>
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
                        <label for="jenis_kelamin" class="form-control-label col-sm-3 text-md-right">Jenis Kelamin</label>
                        <div class="col-sm-6 col-md-9">
                          <select class="form-control selectric @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="{{ $pegawai->jenis_kelamin }}">{{$pegawai->jenis_kelamin}}</option>
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
                            <input type="text" id="tgl_lahir" name="tgl_lahir" autocomplete="off" class="form-control datepicker @error('tgl_lahir') is-invalid @enderror" value="{{ date('d-m-Y',strtotime($pegawai->tgl_lahir)) }}" >
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
                          <input type="text" id="pekerjaan" name="pekerjaan"  class="form-control @error('pekerjaan') is-invalid @enderror" value="{{$pegawai->pekerjaan}}" >
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
                          <textarea name="keterangan"  class="form-control" id="" cols="30" rows="10">{{$pegawai->keterangan}}</textarea>
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