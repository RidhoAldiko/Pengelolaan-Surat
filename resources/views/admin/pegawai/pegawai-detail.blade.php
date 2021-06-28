
@extends('layouts.main')
@section('title','Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Pegawai</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin-pegawai.index')}}">Data Pegawai</a></div>
            <div class="breadcrumb-item">Detail Data pegawai</div>
        </div>
    </div>
   
    <div class="section-body">
        <div class="card shadow">
            <div class="card-header">
                <h4>Detail Data Pegawai</h4>
            </div>
            <div class="card-body">
                <div class="text-center my-3">
                    @if ($result->foto !=null)
                    <img src="{{ asset('/storage/foto/'.$result->foto)}}" class="rounded-circle shadow" alt="Profil" width="100px">
                    @else
                    <img src="{{asset('img/avatar/avatar-1.png')}}" class="rounded-circle shadow" alt="Profil" width="100px">    
                    @endif
                    <h4 class="mt-2 text-primary font-weight-bold">{{ $result->nama_pegawai }}</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                            <div class="form-group">
                                <label>NIP</label>
                                <p class="border-bottom text-gray-800">
                                    {{ $result->nip_pegawai }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Nomor Kartu Pegawai</label>
                                <p class="border-bottom text-gray-800">
                                    {{ $result->nomor_karpeg }}
                                </p>
                                
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir, Tanggal Lahir</label>
                                <p class="border-bottom text-gray-800">
                                    {{ $result->tempat_lahir }}, {{ $result->tanggal_lahir }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <p class="border-bottom text-gray-800">
                                    {{ $result->jenis_kelamin }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Agama</label>
                                <p class="border-bottom text-gray-800">
                                    {{ $result->agama }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Status Perkawinan</label>
                                <p class="border-bottom text-gray-800">
                                    {{ $result->status_perkawinan }}
                                </p>
                            </div>
                            
                            <div class="form-group">
                                <label>Jabatan</label>
                                <p class="border-bottom text-gray-800">
                                    {{ $result->nama_jabatan }}
                                </p>
                            </div>

                            <div class="form-group">
                                <label>Unit Kerja</label>
                                <p class="border-bottom text-gray-800">
                                @if ($result->id_jabatan < 3)
                                    {{ '-' }}
                                @elseif($result->id_jabatan == 3)
                                    {{ $result->nama_staf_ahli }}
                                @elseif($result->id_jabatan == 4)
                                    {{ $result->nama_asisten }}
                                @elseif($result->id_jabatan == 5)
                                    {{ $result->nama_bagian }}
                                @endif

                                    
                                </p>
                            </div>
                            <a href="{{ route('admin-pegawai.index') }}" class="btn btn-warning"><i class="fas fa-chevron-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- delete Modal-->
<div class="modal fade" id="deletePegawai" tabindex="-1" role="dialog" aria-labelledby="deletePegawaiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h4 class="modal-title h4" id="deletePegawaiLabel">Ingin menghapus data ?</h4>
            {{-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button> --}}
        </div>
        <div class="modal-body">
            <h5 class="h5 text-center alert-text">Tekan "hapus" untuk menghapus.</h5> 
            <div class="modal-footer d-flex justify-content-center">        
                <form action="" method="post"  class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form> </td>
                
            </div>
        </div>
        </div>
    </div>
</div>
@endsection









