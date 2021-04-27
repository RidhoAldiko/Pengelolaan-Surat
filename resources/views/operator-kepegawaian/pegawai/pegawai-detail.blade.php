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
    <a href="{{ route('data-pegawai.index') }}" class="btn btn-sm btn-warning mb-3 ml-3">Kembali</a>
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
                        <a class="nav-link" id="riwayat-tab" data-toggle="tab" href="#riwayat" role="tab" aria-controls="riwayat" aria-selected="false">Riwayat Pendidikan</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pegawai" role="tabpanel" aria-labelledby="pegawai-tab">
                            <div class="text-center my-3">
                                @if ($pegawai->foto !=null)
                                <img src="{{ asset('/storage/foto/'.$pegawai->foto)}}" class="rounded-circle shadow" alt="Profil" width="100px">
                                @else
                                <img src="{{asset('img/avatar/avatar-1.png')}}" class="rounded-circle shadow" alt="Profil" width="100px">    
                                @endif
                                <h4 class="mt-2 text-primary font-weight-bold">{{ $pegawai->nama_pegawai }}</h4>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <p class="border-bottom text-gray-800">
                                                {{ $pegawai->nip_pegawai }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Kartu Pegawai</label>
                                            <p class="border-bottom text-gray-800">
                                                {{ $pegawai->nomor_kerpeg }}
                                            </p>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Lahir, Tanggal Lahir</label>
                                            <p class="border-bottom text-gray-800">
                                                {{ $pegawai->tempat_lahir }}, {{ $pegawai->tanggal_lahir }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <p class="border-bottom text-gray-800">
                                                {{ $pegawai->jenis_kelamin }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <p class="border-bottom text-gray-800">
                                                {{ $pegawai->agama }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Perkawinan</label>
                                            <p class="border-bottom text-gray-800">
                                                {{ $pegawai->status_perkawinan }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Unit Kerja</label>
                                            <p class="border-bottom text-gray-800">
                                                {{ $pegawai->unit_kerja->nama_unit }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <p class="border-bottom text-gray-800">
                                                {{ $pegawai->jabatan->nama_jabatan }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Golongan</label>
                                            <p class="border-bottom text-gray-800">
                                                {{ $pegawai->golongan->nama_golongan }}
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
                                        @forelse ($pegawai->hobi as $item)
                                        <p class="border-bottom text-gray-800">
                                            {{ $item->hobi }}
                                        </p>
                                        @empty
                                        <p class="border-bottom text-gray-800">
                                            - Hobi Belum Diisi, lengkapi di menu edit -
                                        </p>
                                        @endforelse
                                    </div>
                            </div>
                        </div>            
                    </div>
                    <div class="tab-pane fade" id="alamat" role="tabpanel" aria-labelledby="alamat-tab">
                        <div class="row justify-content-center">
                            @if ($pegawai->alamat->count() > 0)
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">Jalan</th>
                                                    <th scope="col">Kelurahan / Desa</th>
                                                    <th scope="col">Kecamatan</th>
                                                    <th scope="col">Kabupaten Kota</th>
                                                    <th scope="col">Provinsi</th>
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
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            @else
                            <p class="border-bottom text-gray-800">
                                - Alamat belum diisi, lengkapi di menu edit -
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="keterangan" role="tabpanel" aria-labelledby="keterangan-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @if ($pegawai->keterangan_badan != null)
                                <div class="form-group">
                                    <label>Tinggi Badan</label>
                                    <p class="border-bottom text-gray-800">
                                        {{ $pegawai->keterangan_badan->tinggi }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Berat Badan</label>
                                    <p class="border-bottom text-gray-800">
                                        {{ $pegawai->keterangan_badan->berat_badan }}
                                        </p>                                  
                                    </div>
                                <div class="form-group">
                                    <label>Rambut</label>
                                    <p class="border-bottom text-gray-800">
                                        {{ $pegawai->keterangan_badan->rambut }}
                                        </p>                                  
                                    </div>
                                <div class="form-group">
                                    <label>Bentuk Muka</label>
                                    <p class="border-bottom text-gray-800">
                                        {{ $pegawai->keterangan_badan->bentuk_muka }}
                                        </p>                                  
                                </div>
                                <div class="form-group">
                                    <label>Warna Kulit</label>
                                    <p class="border-bottom text-gray-800">
                                        {{ $pegawai->keterangan_badan->warna_kulit }}
                                        </p>                                  
                                </div>
                                <div class="form-group">
                                    <label>Ciri-ciri Khas</label>
                                    <p class="border-bottom text-gray-800">
                                        {{ $pegawai->keterangan_badan->ciri_khas }}
                                        </p>
                                </div>
                                <div class="form-group">
                                    <label>Cacat Tubuh</label>
                                    <p class="border-bottom text-gray-800">
                                        {{ $pegawai->keterangan_badan->cacat_tubuh }}
                                    </p>
                                </div>
                                @else
                                <p class="border-bottom text-gray-800">
                                    - Keterangan Badan belum diisi, lengkapi di menu edit -
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Riwayat Pendidikan</label>
                                    @if ($pegawai->riwayat_pendidikan->count() > 0)
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                    <thead>
                                                            <tr class="text-center">
                                                                <th scope="col">Jenis</th>
                                                                <th scope="col">Nama</th>
                                                                <th scope="col">Jurusan</th>
                                                                <th scope="col">No STTB</th>
                                                                <th scope="col">Tgl STTB</th>
                                                                <th scope="col">Tempat</th>
                                                                <th scope="col">Kepsek/Rektor</th>
                                                                <th scope="col">Mulai</th>
                                                                <th scope="col">Sampai</th>
                                                                <th scope="col">Tanda Lulus</th>
                                                            </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pegawai->riwayat_pendidikan as $item)
                                                            <tr>
                                                                <td>{{ $item->jenis_pendidikan }}</td>
                                                                <td>{{ $item->nama_pendidikan }}</td>
                                                                <td>{{ $item->jurusan }}</td>
                                                                <td>{{ $item->no_sttb }}</td>
                                                                <td>{{ date('d/m/Y', strtotime($item->tgl_sttb)) }}</td>
                                                                <td>{{ $item->tempat }}</td>
                                                                <td>{{ $item->nama_kepsek }}</td>
                                                                <td>{{ date('d/m/Y', strtotime($item->mulai)) }}</td>
                                                                <td>{{ date('d/m/Y', strtotime($item->sampai)) }}</td>
                                                                <td>{{ $item->tanda_lulus }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @else
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat Pendidikan Belum Diisi, lengkapi di menu Riwayat pendidikan -
                                    </p>
                                    @endif
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