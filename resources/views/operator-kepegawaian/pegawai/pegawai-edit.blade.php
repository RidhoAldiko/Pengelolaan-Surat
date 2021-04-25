@extends('layouts.main')
@section('title','Edit Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="{{route('data-pegawai.index')}}">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit data pegawai</li>
        </ol>
    </div>
    @if (session('status'))
    <div class="alert shadow alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <a href="{{ route('data-pegawai.index') }}" class="btn btn-sm btn-warning mt-1 mb-3 ml-3">Kembali</a>
    <div class="section-body ">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="pegawai-tab" data-toggle="tab" href="#pegawai" role="tab" aria-controls="pegawai" aria-selected="true">Pegawai</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="hobi-tab" data-toggle="tab" href="#hobi" role="tab" aria-controls="hobi" aria-selected="false">Hobi</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="alamat-tab" data-toggle="tab" href="#alamat" role="tab" aria-controls="alamat" aria-selected="false">Alamat Rumah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="keterangan-tab" data-toggle="tab" href="#keterangan" role="tab" aria-controls="keterangan" aria-selected="false">Keterangan Badan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="riwayat-tab" data-toggle="tab" href="#riwayat" role="tab" aria-controls="riwayat" aria-selected="false">Keterangan Badan</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pegawai" role="tabpanel" aria-labelledby="pegawai-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card shadow ">
                                    <div class="card-header">
                                        <h4>Edit Data Pegawai - <code>{{ $pegawai->nama_pegawai }}</code></h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('data-pegawai.update',$pegawai->nip_pegawai) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group row left-items-center">
                                                <label for="nip_pegawai" class="form-control-label col-sm-3 text-md-right">Nip pegawai</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="number" id="nip_pegawai" name="nip_pegawai"  class="form-control @error('nip_pegawai') is-invalid @enderror"  value="{{ $pegawai->nip_pegawai }}" >
                                                    @error('nip_pegawai')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="nomor_karpeg" class="form-control-label col-sm-3 text-md-right">Nomor kartu pegawai</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="number" id="nomor_karpeg" name="nomor_karpeg"  class="form-control @error('nomor_karpeg') is-invalid @enderror" placeholder="Masukan Nomor kartu Pegawai" value="{{ $pegawai->nomor_karpeg}}" >
                                                    @error('nomor_karpeg')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="nama_pegawai" class="form-control-label col-sm-3 text-md-right">Nama pegawai</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" id="nama_pegawai" name="nama_pegawai"  class="form-control @error('nama_pegawai') is-invalid @enderror"  value="{{ $pegawai->nama_pegawai }}" >
                                                    @error('nama_pegawai')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="tempat_lahir" class="form-control-label col-sm-3 text-md-right">Tempat, Tgl Lahir</label>
                                                <div class="col-sm-3 col-md-5">
                                                    <input type="text" id="tempat_lahir" name="tempat_lahir"  class="form-control @error('tempat_lahir') is-invalid @enderror"  value="{{ $pegawai->tempat_lahir }}" >
                                                    @error('tempat_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-3 col-md-4">
                                                    <input type="text" id="tanggal_lahir" name="tanggal_lahir" onfocus="(this.type='date')"  class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ date('d F Y', strtotime($pegawai->tanggal_lahir))}}" >
                                                        @error('tanggal_lahir')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                </div>
                                            </div> 
                                            <div class="form-group row left-items-center">
                                                <label for="jenis_kelamin" class="form-control-label col-sm-3 text-md-right">Jenis Kelamin</label>
                                                <div class="col-sm-6 col-md-9">
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
                                            </div> 
                                            <div class="form-group row left-items-center">
                                                <label for="agama" class="form-control-label col-sm-3 text-md-right">Agama</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <select class="form-control @error('agama') is-invalid @enderror" id="agama" name="agama">
                                                        <option value="{{ $pegawai->agama }}"> {{ $pegawai->agama }} </option>
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
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="status_perkawinan" class="form-control-label col-sm-3 text-md-right">Status Perkawinan</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <select class="form-control @error('status_perkawinan') is-invalid @enderror" id="status_perkawinan" name="status_perkawinan">
                                                        <option value="{{ $pegawai->status_perkawinan }}"> {{ $pegawai->status_perkawinan }} </option>
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
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="id_unit" class="form-control-label col-sm-3 text-md-right">Unit Kerja</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <select class="form-control @error('id_unit') is-invalid @enderror" id="id_unit" name="id_unit">
                                                        <option value="{{$pegawai->id_unit}}">{{$pegawai->unit_kerja->nama_unit}}</option>
                                                        @foreach ($unit as $un)
                                                        <option value="{{$un->id_unit}}">{{$un->nama_unit}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_unit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="id_golongan" class="form-control-label col-sm-3 text-md-right">Golongan</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <select class="form-control @error('id_golongan') is-invalid @enderror" id="id_golongan" name="id_golongan">
                                                        <option value="{{$pegawai->id_golongan}}">{{$pegawai->golongan->nama_golongan}}</option>
                                                        @foreach ($golongan as $gl)
                                                        <option value="{{$gl->id_golongan}}">{{$gl->nama_golongan}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_golongan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="id_jabatan" class="form-control-label col-sm-3 text-md-right">Jabatan</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <select class="form-control @error('id_jabatan') is-invalid @enderror" id="id_jabatan" name="id_jabatan">
                                                        <option value="{{$pegawai->id_jabatan}}">{{$pegawai->jabatan->nama_jabatan}}</option>
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
                                            </div>
                                            <a href="{{ route('data-pegawai.index') }}" class="btn btn-warning">Kembali</a>
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="hobi" role="tabpanel" aria-labelledby="hobi-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4>Hobi - <code>{{ $pegawai->nama_pegawai }}</code></h4>
                                    </div>
                                    <div class="card-body">
                                        @if ($pegawai->hobi->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Hobi</th>
                                                            <th scope="col">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pegawai->hobi as $item)
                                                            <tr class="text-center">
                                                                <td>{{ $item->hobi }}</td>
                                                                <td>
                                                                    <form action="{{ route('data-hobi.destroy',$item->id_hobi) }}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus hobi ini?')" type="submit"> <i class="fas fa-trash fa-sm"></i> Hapus</button>
                                                                    </form> 
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            @else
                                            <p class="text-muted">Anda belum inputkan Hobi, Inputkan Hobi dengan BENAR.!</p>
                                            <form action="{{route('data-hobi.store')}}" method="POST">
                                                @csrf
                                                <div class="form-group row left-items-center">
                                                    <label for="Hobi" class="form-control-label col-sm-3 text-md-right">Hobi</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai }}">
                                                        <input type="text" id="hobi" name="hobi[]"  class="form-control @error('hobi') is-invalid @enderror" >
                                                        @error('hobi')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group text-right">
                                                    <a href="#" class="tambahhobi btn bt-sm btn-primary text-right"><i class="fa fa-plus"></i></a>
                                                </div>
                                                <div class="hobii"></div>
                                                <button type="submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                            </form> 
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="alamat" role="tabpanel" aria-labelledby="alamat-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4>Alamat - <code>{{ $pegawai->nama_pegawai }} </code></h4>
                                    </div>
                                    <div class="card-body">
                                        @if ($pegawai->alamat->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Jalan</th>
                                                            <th scope="col">Kelurahan / Desa</th>
                                                            <th scope="col">Kecamatan</th>
                                                            <th scope="col">Kabupaten Kota</th>
                                                            <th scope="col">Provinsi</th>
                                                            <th scope="col">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pegawai->alamat as $item)
                                                                <tr class="text-center">
                                                                    <td>{{ $item->jalan }}</td>
                                                                    <td>{{ $item->kelurahan_desa }}</td>
                                                                    <td>{{ $item->kecamatan }}</td>
                                                                    <td>{{ $item->kabupaten_kota }}</td>
                                                                    <td>{{ $item->provinsi }}</td>
                                                                    <td>
                                                                        <form action="{{ route('data-alamat.destroy',$item->id_alamat) }}" method="post">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus hobi ini?')" type="submit"> <i class="fas fa-trash fa-sm"></i> Hapus</button>
                                                                        </form> 
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                        @else
                                        <p class="text-muted">Anda belum inputkan alamat, Inputkan Alamat dengan BENAR.!</p>
                                            <form action="{{route('data-alamat.store')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai }}">
                                                <div class="form-group row left-items-center">
                                                    <label for="jalan" class="form-control-label col-sm-3 text-md-right">Jalan</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <input type="text" id="jalan" name="jalan[]"  class="form-control @error('jalan') is-invalid @enderror" >
                                                        @error('jalan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row left-items-center">
                                                    <label for="kelurahan_desa" class="form-control-label col-sm-3 text-md-right">Kelurahan / Desa</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <input type="text" id="kelurahan_desa" name="kelurahan_desa[]"  class="form-control @error('kelurahan_desa') is-invalid @enderror" >
                                                        @error('kelurahan_desa')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row left-items-center">
                                                    <label for="kecamatan" class="form-control-label col-sm-3 text-md-right">Kecamatan</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <input type="text" id="kecamatan" name="kecamatan[]"  class="form-control @error('kecamatan') is-invalid @enderror" >
                                                        @error('kecamatan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row left-items-center">
                                                    <label for="kabupaten_kota" class="form-control-label col-sm-3 text-md-right">Kabupaten / Kota</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <input type="text" id="kabupaten_kota" name="kabupaten_kota[]"  class="form-control @error('kabupaten_kota') is-invalid @enderror" >
                                                        @error('kabupaten_kota')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row left-items-center">
                                                    <label for="provinsi" class="form-control-label col-sm-3 text-md-right">Provinsi</label>
                                                    <div class="col-sm-6 col-md-9">
                                                        <input type="text" id="provinsi" name="provinsi[]"  class="form-control @error('provinsi') is-invalid @enderror" >
                                                        @error('provinsi')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group text-right">
                                                    <a href="#" class="tambahalamat btn bt-sm btn-primary text-right"><i class="fa fa-plus"></i></a>
                                                </div>
                                                <div class="alamatt"></div>
                                                <button type="submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                            </form> 
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="keterangan" role="tabpanel" aria-labelledby="keterangan-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card shadow ">
                                    <div class="card-header">
                                        <h4>Keterangan Badan - <code>{{ $pegawai->nama_pegawai }}</code></h4>
                                    </div>
                                    <div class="card-body">
                                        @if ($pegawai->keterangan_badan != null)
                                        <form action="{{ route('data-keterangan-badan.update',$pegawai->keterangan_badan->id_ketbadan) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="nip_pegawai" value="{{ $pegawai->keterangan_badan->nip_pegawai }}">
                                            <div class="form-group row left-items-center">
                                                <label for="tinggi" class="form-control-label col-sm-3 text-md-right">Tingggi Badan</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="number" id="tinggi" name="tinggi"  class="form-control @error('tinggi') is-invalid @enderror"  value="{{ $pegawai->keterangan_badan->tinggi }}" >
                                                    @error('tinggi')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="berat_badan" class="form-control-label col-sm-3 text-md-right">Berat Badan</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="number" id="berat_badan" name="berat_badan"  class="form-control @error('berat_badan') is-invalid @enderror"  value="{{ $pegawai->keterangan_badan->berat_badan }}" >
                                                    @error('berat_badan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="rambut" class="form-control-label col-sm-3 text-md-right">Tipe Rambut</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" id="rambut" name="rambut"  class="form-control @error('rambut') is-invalid @enderror"  value="{{ $pegawai->keterangan_badan->rambut }}" >
                                                    @error('rambut')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div> 
                                            <div class="form-group row left-items-center">
                                                <label for="bentuk_muka" class="form-control-label col-sm-3 text-md-right">Bentuk Muka</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <select class="form-control @error('bentuk_muka') is-invalid @enderror" id="bentuk_muka" name="bentuk_muka">
                                                        <option value="{{ $pegawai->keterangan_badan->bentuk_muka }}"> {{ $pegawai->keterangan_badan->bentuk_muka }} </option>
                                                        <option value="Bulat"> Bulat </option>
                                                        <option value="Persegi"> Persegi </option>
                                                        <option value="Diamond">Diamond</option>
                                                        <option value="Oval">Oval</option>
                                                        <option value="Hati">Hati</option>
                                                        <option value="Persegi Panjang">Persegi Panjang</option>
                                                        <option value="Segi Tiga">Segi Tiga</option>
                                                    </select>
                                                    @error('bentuk_muka')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="warna_kulit" class="form-control-label col-sm-3 text-md-right">Warna Kulit</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" id="warna_kulit" name="warna_kulit"  class="form-control @error('warna_kulit') is-invalid @enderror"  value="{{ $pegawai->keterangan_badan->warna_kulit }}" >
                                                    @error('warna_kulit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="ciri_khas" class="form-control-label col-sm-3 text-md-right">Ciri Khas</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" id="ciri_khas" name="ciri_khas"  class="form-control @error('ciri_khas') is-invalid @enderror"  value="{{ $pegawai->keterangan_badan->ciri_khas }}" >
                                                    @error('ciri_khas')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="cacat_tubuh" class="form-control-label col-sm-3 text-md-right">Cacat Tubuh</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" id="cacat_tubuh" name="cacat_tubuh"  class="form-control @error('cacat_tubuh') is-invalid @enderror"  value="{{ $pegawai->keterangan_badan->cacat_tubuh }}" >
                                                    @error('cacat_tubuh')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Edit</button>
                                        </form>
                                        @else
                                        <p class="text-muted">Anda belum inputkan Keterangan Badan, Inputkan Keterangan Badan dengan BENAR.!</p>
                                        <form action="{{ route('data-keterangan-badan.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="nip_pegawai" value="{{ $pegawai->nip_pegawai }}">
                                            <div class="form-group row left-items-center">
                                                <label for="tinggi" class="form-control-label col-sm-3 text-md-right">Tingggi Badan</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="number" id="tinggi" name="tinggi"  class="form-control @error('tinggi') is-invalid @enderror"  value="{{ old('tinggi') }}" >
                                                    @error('tinggi')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="berat_badan" class="form-control-label col-sm-3 text-md-right">Berat Badan</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="number" id="berat_badan" name="berat_badan"  class="form-control @error('berat_badan') is-invalid @enderror"  value="{{ old('berat_badan') }}" >
                                                    @error('berat_badan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="rambut" class="form-control-label col-sm-3 text-md-right">Tipe Rambut</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" id="rambut" name="rambut"  class="form-control @error('rambut') is-invalid @enderror"  value="{{ old('rambut') }}" >
                                                    @error('rambut')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div> 
                                            <div class="form-group row left-items-center">
                                                <label for="bentuk_muka" class="form-control-label col-sm-3 text-md-right">Bentuk Muka</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <select class="form-control @error('bentuk_muka') is-invalid @enderror" id="bentuk_muka" name="bentuk_muka">
                                                        <option selected disabled> --Pilih-- </option>
                                                        <option value="Bulat"> Bulat </option>
                                                        <option value="Persegi"> Persegi </option>
                                                        <option value="Diamond">Diamond</option>
                                                        <option value="Oval">Oval</option>
                                                        <option value="Hati">Hati</option>
                                                        <option value="Persegi Panjang">Persegi Panjang</option>
                                                        <option value="Segi Tiga">Segi Tiga</option>
                                                    </select>
                                                    @error('bentuk_muka')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="warna_kulit" class="form-control-label col-sm-3 text-md-right">Warna Kulit</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" id="warna_kulit" name="warna_kulit"  class="form-control @error('warna_kulit') is-invalid @enderror"  value="{{ old('warna_kulit') }}" >
                                                    @error('warna_kulit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="ciri_khas" class="form-control-label col-sm-3 text-md-right">Ciri Khas</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" id="ciri_khas" name="ciri_khas"  class="form-control @error('ciri_khas') is-invalid @enderror"  value="{{ old('ciri_khas') }}" >
                                                    @error('ciri_khas')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row left-items-center">
                                                <label for="cacat_tubuh" class="form-control-label col-sm-3 text-md-right">Cacat Tubuh</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" id="cacat_tubuh" name="cacat_tubuh"  class="form-control @error('cacat_tubuh') is-invalid @enderror"  value="{{ old('cacat_tubuh') }}" >
                                                    @error('cacat_tubuh')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                        </form> 
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
                        Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script-tambahanakhir')
    <script type="text/javascript">
    //javascript untuk tambah hobi
        $('.tambahhobi').on('click',function(e){
            console.log('ok');
            tambahHobi();
            e.preventDefault();
        });
        function tambahHobi(){
            var hobii = '<div class="datahobi"><div class="form-group row left-items-center"><label for="Hobi" class="form-control-label col-sm-3 text-md-right"></label><div class="col-sm-6 col-md-9"><input type="text" id="hobi" name="hobi[]"  class="form-control @error('hobi') is-invalid @enderror" placeholder="Masukan hobi" value="{{old('hobi')}}" >@error('hobi')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div><div class="form-group text-right"><a href="#" class="remove btn bt-sm btn-warning text-right"><i class="fa fa-minus"></i></a></div></div>';
            $('.hobii').append(hobii);
        };
        $(document).on('click', '.remove', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        })

    //javascript untuk tambah alamat
    $('.tambahalamat').on('click',function(e){
            console.log('ok');
            
            tambahAlamat();
            e.preventDefault();
        });
        function tambahAlamat(){
            var alamatt = '<div class="dataalamat"><div class="form-group row left-items-center"><label for="jalan" class="form-control-label col-sm-3 text-md-right">Jalan</label><div class="col-sm-6 col-md-9"><input type="text" id="jalan" name="jalan[]"  class="form-control @error('jalan') is-invalid @enderror" > @error('jalan')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div><div class="form-group row left-items-center"><label for="kelurahan_desa" class="form-control-label col-sm-3 text-md-right">Kelurahan / Desa</label><div class="col-sm-6 col-md-9"><input type="text" id="kelurahan_desa" name="kelurahan_desa[]"  class="form-control @error('kelurahan_desa') is-invalid @enderror" >@error('kelurahan_desa')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div><div class="form-group row left-items-center"><label for="kecamatan" class="form-control-label col-sm-3 text-md-right">Kecamatan</label><div class="col-sm-6 col-md-9"><input type="text" id="kecamatan" name="kecamatan[]"  class="form-control @error('kecamatan') is-invalid @enderror" >@error('kecamatan')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div><div class="form-group row left-items-center"><label for="kabupaten_kota" class="form-control-label col-sm-3 text-md-right">Kabupaten / Kota</label><div class="col-sm-6 col-md-9"><input type="text" id="kabupaten_kota" name="kabupaten_kota[]"  class="form-control @error('kabupaten_kota') is-invalid @enderror" >@error('kabupaten_kota')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div><div class="form-group row left-items-center"><label for="provinsi" class="form-control-label col-sm-3 text-md-right">Provinsi</label><div class="col-sm-6 col-md-9"><input type="text" id="provinsi" name="provinsi[]"  class="form-control @error('provinsi') is-invalid @enderror" >@error('provinsi')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div><div class="form-group text-right"><a href="#" class="hapusalamat btn bt-sm btn-warning text-right"><i class="fa fa-minus"></i></a></div></div>';
            $('.alamatt').append(alamatt);
        };
        $(document).on('click', '.hapusalamat', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        })
    </script>
@endpush