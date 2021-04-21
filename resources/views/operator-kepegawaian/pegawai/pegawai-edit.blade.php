@extends('layouts.main')
@section('title','Edit Pegawai')
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
                        <h4>Edit Data Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('data-pegawai.update',$pegawai->nip_pegawai) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="number" id="nip_pegawai" name="nip_pegawai"  class="form-control @error('nip_pegawai') is-invalid @enderror" placeholder="Masukan NIP Pegawai" value="{{ $pegawai->nip_pegawai }}" >
                                @error('nip_pegawai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" id="nama_pegawai" name="nama_pegawai"  class="form-control @error('nama_pegawai') is-invalid @enderror" placeholder="Masukan Nama Pegawai" value="{{ $pegawai->nama_pegawai }}" >
                                @error('nama_pegawai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="{{ $pegawai->jenis_kelamin }}"> {{ $pegawai->jenis_kelamin }} </option>
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
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukan Alamat" rows="3">{{ $pegawai->alamat }}</textarea>
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select class="form-control @error('id_unit') is-invalid @enderror" id="id_unit" name="id_unit">
                                    
                                    @foreach ($unit as $un)
                                    @if ($pegawai->id_unit == $un->id_unit)
                                    <option value="{{$pegawai->id_unit}}">Unit Kerja - {{$un->nama_unit}}</option>
                                    @endif 
                                    <option value="{{$un->id_unit}}">{{$un->nama_unit}}</option>
                                    @endforeach
                                </select>
                                @error('id_unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select class="form-control @error('id_golongan') is-invalid @enderror" id="id_golongan" name="id_golongan">
                                    @foreach ($golongan as $gl)
                                    @if ($pegawai->id_golongan == $gl->id_golongan)
                                    <option value="{{$pegawai->id_golongan}}">Golongan - {{$gl->nama_golongan}}</option>
                                    @endif
                                    <option value="{{$gl->id_golongan}}">{{$gl->nama_golongan}}</option>
                                    @endforeach
                                </select>
                                @error('id_golongan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select class="form-control @error('id_jabatan') is-invalid @enderror" id="id_jabatan" name="id_jabatan">
                                    @foreach ($jabatan as $jb)
                                    @if ($pegawai->id_jabatan == $jb->id_jabatan)
                                    <option value="{{$pegawai->id_jabatan}}">Jabatan - {{$jb->nama_jabatan}}</option>
                                    @endif
                                    <option value="{{$jb->id_jabatan}}">{{$jb->nama_jabatan}}</option>
                                    @endforeach
                                </select>
                                @error('id_jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <a href="{{ route('data-pegawai.index') }}" class="btn btn-warning">Kembali</a>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection