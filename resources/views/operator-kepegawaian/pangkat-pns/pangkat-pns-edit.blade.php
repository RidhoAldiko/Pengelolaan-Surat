@extends('layouts.main')
@section('title','Edit Pangkat PNS Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit data Pangkat PNS Pegawai</li>
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
                <form id="setting-form" method="POST" action="{{ route('pegawai-pangkat-pns.update', $pegawai->id_pangkat_pns) }}">
                  @method('PUT')
                    @csrf
                  <div class="card shadow" id="settings-card">
                    <div class="card-header">
                      <h4>Riwayat Pangkat PNS Pegawai</h4>
                    </div>
                    <div class="card-body">
                      <p class="text-muted">Masukan data Pangkat PNS pegawai dengan benar dan tepat.!</p>

                      <div class="form-group row align-items-center">
                          <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai }}">
                        <label for="id_golongan" class="form-control-label col-sm-3 text-md-right">Pangkat Golongan</label>
                        <div class="col-sm-6 col-md-9">
                            <select class="form-control @error('id_golongan') is-invalid @enderror" id="id_golongan" name="id_golongan">
                                <option value="{{ $pegawai->id_golongan }}"> {{ $pegawai->golongan->pangkat }} - {{ $pegawai->golongan->nama_golongan }} </option>
                                @foreach ($golongan as $gl)
                                <option value="{{$gl->id_golongan}}"> {{ $gl->pangkat }} - {{$gl->nama_golongan}}</option>
                                @endforeach
                            </select>
                            @error('id_golongan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tmt" class="form-control-label col-sm-3 text-md-right">TMT</label>
                        <div class="col-sm-6 col-md-9">
                            <input type="date" id="tmt" name="tmt"  class="form-control @error('tmt') is-invalid @enderror" value="{{ $pegawai->tmt }}" >
                            @error('tmt')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="penjabat" class="form-control-label col-sm-3 text-md-right">Pejabat yang Mengesahkan</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="penjabat" name="penjabat"  class="form-control @error('penjabat') is-invalid @enderror" value="{{ $pegawai->penjabat}}" >
                            @error('penjabat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="nomor" class="form-control-label col-sm-3 text-md-right">Nomor</label>
                        <div class="col-sm-6 col-md-9">
                          <input type="text" id="nomor" name="nomor"  class="form-control @error('nomor') is-invalid @enderror" value="{{ $pegawai->nomor }}" >
                            @error('nomor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row align-items-center">
                        <label for="tanggal" class="form-control-label col-sm-3 text-md-right">Tanggal</label>
                        <div class="col-sm-6 col-md-9">
                            <input type="date" id="tanggal" name="tanggal"  class="form-control @error('tanggal') is-invalid @enderror" value="{{ $pegawai->tanggal }}" >
                            @error('tanggal')
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