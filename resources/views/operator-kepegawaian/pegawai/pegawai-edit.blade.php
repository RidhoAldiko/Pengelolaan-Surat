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
        <div class="col-12">
            <div class="card">
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
                    <div class="tab-pane fade" id="hobi" role="tabpanel" aria-labelledby="hobi-tab">
                    Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam convallis neque eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis velit. Donec hendrerit venenatis justo, eget scelerisque tellus pharetra a.
                    </div>
                    <div class="tab-pane fade" id="alamat" role="tabpanel" aria-labelledby="alamat-tab">
                    Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                    </div>
                    <div class="tab-pane fade" id="keterangan" role="tabpanel" aria-labelledby="keterangan-tab">
                        Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
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