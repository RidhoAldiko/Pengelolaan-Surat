@extends('layouts.main')
@section('title','Tambah Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="{{route('data-pegawai.index')}}">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah data pegawai</li>
        </ol>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Form Data Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('data-pegawai.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="number" id="nip_pegawai" name="nip_pegawai"  class="form-control @error('nip_pegawai') is-invalid @enderror" placeholder="Masukan NIP Pegawai" value="{{old('nip_pegawai')}}" >
                                @error('nip_pegawai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" id="nomor_karpeg" name="nomor_karpeg"  class="form-control @error('nomor_karpeg') is-invalid @enderror" placeholder="Masukan Nomor kartu Pegawai" value="{{old('nomor_karpeg')}}" >
                                @error('nomor_karpeg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" id="nama_pegawai" name="nama_pegawai"  class="form-control @error('nama_pegawai') is-invalid @enderror" placeholder="Masukan Nama Pegawai" value="{{old('nama_pegawai')}}" >
                                @error('nama_pegawai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" id="tempat_lahir" name="tempat_lahir"  class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Masukan tempat lahir" value="{{old('tempat_lahir')}}" >
                                @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" id="tanggal_lahir" name="tanggal_lahir" onfocus="(this.type='date')"  class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Masukan Tanggal Lahir" value="{{old('tanggal_lahir')}}" >
                                @error('tanggal_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                    <option selected disabled> --Pilih Jenis Kelamin-- </option>
                                    <option value="Laki-laki"> Laki-laki </option>
                                    <option value="Perempuan"> Perempuan </option>
                                </select>
                                @error('jenis_kelamin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <select class="form-control @error('agama') is-invalid @enderror" id="agama" name="agama">
                                    <option selected disabled> --Pilih Agama-- </option>
                                    <option value="Islam"> Islam </option>
                                    <option value="Katolik"> Katolik </option>
                                    <option value="Protestan">Protestan</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                                @error('agama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <select class="form-control @error('status_perkawinan') is-invalid @enderror" id="status_perkawinan" name="status_perkawinan">
                                    <option selected disabled> --Pilih Status Perkawinan-- </option>
                                    <option value="Belum kawin">Belum Kawin</option>
                                    <option value="Kawin"> Kawin </option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                                @error('status_perkawinan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select class="form-control @error('id_jabatan') is-invalid @enderror" id="id_jabatan" name="id_jabatan">
                                    <option selected disabled> --Pilih Jabatan-- </option>
                                    @foreach ($jabatan as $jb)
                                    <option value="{{$jb->id_jabatan}}">{{$jb->nama_jabatan}}</option>
                                    @endforeach
                                </select>
                                @error('id_jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection