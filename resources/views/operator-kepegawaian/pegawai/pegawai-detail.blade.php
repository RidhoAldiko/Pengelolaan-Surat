@extends('layouts.main')
@section('title','Detail Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item"><a href="{{route('data-pegawai.index')}}">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pegawai</li>
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
                        <a class="nav-link" id="riwayat-tab" data-toggle="tab" href="#riwayat" role="tab" aria-controls="riwayat" aria-selected="false">Riwayat Pendidikan</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pegawai" role="tabpanel" aria-labelledby="pegawai-tab">
                            <div class="text-center my-3">
                                <img src="{{asset('img/avatar/avatar-1.png')}}" class="rounded-circle shadow" alt="Profil" width="100px">
                                <h4 class="mt-2 text-primary font-weight-bold">Ridho Aldiko</h4>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <p class="border-bottom text-gray-800">
                                                19850330-200312-1-002
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Kartu Pegawai</label>
                                            <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Perkawinan</label>
                                            <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Unit Kerja</label>
                                            <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Golongan</label>
                                            <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                        </div>
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane fade" id="hobi" role="tabpanel" aria-labelledby="hobi-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Hobi</label>
                                        <p class="border-bottom text-gray-800">
                                            19850200312100211
                                        </p>
                                    </div>
                            </div>
                        </div>            
                    </div>
                    <div class="tab-pane fade" id="alamat" role="tabpanel" aria-labelledby="alamat-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Jalan</label>
                                        <p class="border-bottom text-gray-800">
                                            19850200312100211
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelurahan/Desa</label>
                                        <p class="border-bottom text-gray-800">
                                            19850200312100211
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <p class="border-bottom text-gray-800">
                                            19850200312100211
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Kabupaten/Kota</label>
                                        <p class="border-bottom text-gray-800">
                                            19850200312100211
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <p class="border-bottom text-gray-800">
                                            19850200312100211
                                        </p>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="keterangan" role="tabpanel" aria-labelledby="keterangan-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Tinggi Badan</label>
                                        <p class="border-bottom text-gray-800">
                                            19850200312100211
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Berat Badan</label>
                                        <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>                                  
                                        </div>
                                    <div class="form-group">
                                        <label>Rambut</label>
                                        <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>                                  
                                        </div>
                                    <div class="form-group">
                                        <label>Bentuk Muka</label>
                                        <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>                                  
                                    </div>
                                    <div class="form-group">
                                        <label>Warna Kulit</label>
                                        <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>                                  
                                    </div>
                                    <div class="form-group">
                                        <label>Ciri-ciri Khas</label>
                                        <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Cacat Tubuh</label>
                                        <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Jalan</label>
                                        <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                        
                                        </div>
                                    <div class="form-group">
                                        <label>Kelurahan/Desa</label>
                                        <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                        </div>
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                        </div>
                                    <div class="form-group">
                                        <label>Kabupaten/Kota</label>
                                        <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>
                                        </div>
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <p class="border-bottom text-gray-800">
                                                19850200312100211
                                            </p>                                  
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
    </div>
</section>
@endsection