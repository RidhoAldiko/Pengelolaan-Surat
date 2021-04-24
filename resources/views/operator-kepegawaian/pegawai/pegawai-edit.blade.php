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
                                <label for="tempat_lahir" class="form-control-label col-sm-3 text-md-right">Tempat,Tanggal Lahir</label>
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
                                        @foreach ($unit as $un)
                                        @if ($pegawai->id_unit == $un->id_unit)
                                        <option value="{{$pegawai->id_unit}}">{{$un->nama_unit}}</option>
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
                            </div>
                            <div class="form-group row left-items-center">
                                <label for="id_golongan" class="form-control-label col-sm-3 text-md-right">Golongan</label>
                                <div class="col-sm-6 col-md-9">
                                    <select class="form-control @error('id_golongan') is-invalid @enderror" id="id_golongan" name="id_golongan">
                                        @foreach ($golongan as $gl)
                                        @if ($pegawai->id_golongan == $gl->id_golongan)
                                        <option value="{{$pegawai->id_golongan}}">{{$gl->nama_golongan}}</option>
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
                            </div>
                            <div class="form-group row left-items-center">
                                <label for="id_jabatan" class="form-control-label col-sm-3 text-md-right">Jabatan</label>
                                <div class="col-sm-6 col-md-9">
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
                            </div>
                            <div class="form-group row left-items-center">
                                <label for="Hobi" class="form-control-label col-sm-3 text-md-right">Hobi</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="text" id="hobi" name="hobi[]"  class="form-control @error('hobi') is-invalid @enderror" placeholder="Masukan hobi" value="{{old('hobi')}}" >
                                    @error('hobi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <a href="#" class="tambahhobi btn bt-sm btn-primary text-right">Tambah Hobi</a>
                            </div>
                            <div class="hobii"></div>
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

@push('script-tambahanakhir')
    <script type="text/javascript">
        $('.tambahhobi').on('click',function(e){
            console.log('ok');
            e.preventDefault();
            tambahHobi();
        });
        function tambahHobi(){
            var hobii = '<div class="datahobi"><div class="form-group row left-items-center"><label for="Hobi" class="form-control-label col-sm-3 text-md-right"></label><div class="col-sm-6 col-md-9"><input type="text" id="hobi" name="hobi[]"  class="form-control @error('hobi') is-invalid @enderror" placeholder="Masukan hobi" value="{{old('hobi')}}" >@error('hobi')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div><div class="form-group text-right"><a href="#" class="remove btn bt-sm btn-warning text-right">Hapus Hobi</a></div></div>';
            $('.hobii').append(hobii);
        };
        $(document).on('click', '.remove', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        })
    </script>
@endpush