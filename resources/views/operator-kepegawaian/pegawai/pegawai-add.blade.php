@extends('layouts.main')
@section('title','Tambah Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pegawai</h1>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Tambah Data Pegawai</h4>
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
                                <input type="text" id="nama_pegawai" name="nama_pegawai"  class="form-control @error('nama_pegawai') is-invalid @enderror" placeholder="Masukan Nama Pegawai" value="{{old('nama_pegawai')}}" >
                                @error('nama_pegawai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option> --Pilih Jenis Kelamin-- </option>
                                    <option value="Laki-laki"> Laki-laki </option>
                                    <option value="Perempuan"> Perempuan </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="id_unit" name="id_unit">
                                    <option> --Pilih Unit Kerja-- </option>
                                    @foreach ($unit as $un)
                                    <option value="{{$un->id_unit}}">{{$un->nama_unit}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="id_golongan" name="id_golongan">
                                    <option> --Pilih Golongan-- </option>
                                    @foreach ($golongan as $gl)
                                    <option value="{{$gl->id_golongan}}">{{$gl->nama_golongan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="id_jabatan" name="id_jabatan">
                                    <option> --Pilih Jabatan-- </option>
                                    @foreach ($jabatan as $jb)
                                    <option value="{{$jb->id_jabatan}}">{{$jb->nama_jabatan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection