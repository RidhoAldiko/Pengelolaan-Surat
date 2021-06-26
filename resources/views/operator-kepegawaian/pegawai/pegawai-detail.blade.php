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
                    <a class="nav-link" id="alamat-tab" data-toggle="tab" href="#alamat" role="tab" aria-controls="alamat" aria-selected="false">Alamat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="keterangan-tab" data-toggle="tab" href="#keterangan" role="tab" aria-controls="keterangan" aria-selected="false">Keterangan Badan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="riwayat-tab" data-toggle="tab" href="#riwayat" role="tab" aria-controls="riwayat" aria-selected="false">Pendidikan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="keluarga-tab" data-toggle="tab" href="#keluarga" role="tab" aria-controls="keluarga" aria-selected="false">Keluarga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="kepegawaian-tab" data-toggle="tab" href="#kepegawaian" role="tab" aria-controls="kepegawaian" aria-selected="false">Kepegawaian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="mutasi-tab" data-toggle="tab" href="#mutasi" role="tab" aria-controls="mutasi" aria-selected="false">Mutasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="dokumen-tab" data-toggle="tab" href="#dokumen" role="tab" aria-controls="dokumen" aria-selected="false">Dokumen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pangkat_cpns-tab" data-toggle="tab" href="#pangkat_cpns" role="tab" aria-controls="pangkat_cpns" aria-selected="false">Pangkat CPNS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pangkat_pns-tab" data-toggle="tab" href="#pangkat_pns" role="tab" aria-controls="pangkat_pns" aria-selected="false">Pangkat PNS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pangkat-tab" data-toggle="tab" href="#pangkat" role="tab" aria-controls="pangkat" aria-selected="false">Riwayat Pangkat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="kgb-tab" data-toggle="tab" href="#kgb" role="tab" aria-controls="kgb" aria-selected="false">Kenaikan Gaji Berkala</a>
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
                                                {{ $pegawai->nomor_karpeg }}
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
                                            <label>Jabatan</label>
                                            <p class="border-bottom text-gray-800">
                                                {{ $pegawai->jabatan->nama_jabatan }}
                                            </p>
                                        </div>
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane fade" id="hobi" role="tabpanel" aria-labelledby="hobi-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Hobi  - <code>{{ $pegawai->nama_pegawai }}</code></label>
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
                            
                            @if ($pegawai->alamat !=null)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <Label>Alamat Rumah - <code>{{ $pegawai->nama_pegawai }}</code></Label>
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
                                                    
                                                        <tr class="text-center">
                                                            <td>{{ $pegawai->alamat->jalan }}</td>
                                                            <td>{{ $pegawai->alamat->kelurahan_desa }}</td>
                                                            <td>{{ $pegawai->alamat->kecamatan }}</td>
                                                            <td>{{ $pegawai->alamat->kabupaten_kota }}</td>
                                                            <td>{{ $pegawai->alamat->provinsi }}</td>
                                                        </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Alamat - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Alamat belum diisi, lengkapi di menu edit -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="keterangan" role="tabpanel" aria-labelledby="keterangan-tab">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @if ($pegawai->keterangan_badan != null)
                                <div class="form-group mb-2">
                                    <label>Keterangan Badan  - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                </div>
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
                                <div class="form-group">
                                    <label>Keterangan Badan  - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                <p class="border-bottom text-gray-800">
                                    - Keterangan Badan belum diisi, lengkapi di menu edit -
                                </p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
                        <div class="row justify-content-center">
                            @if ($pegawai->riwayat_pendidikan->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat Pendidikan - <code>{{ $pegawai->nama_pegawai }}</code></label>
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
                                                        <tr class="text-center">
                                                            <td>{{ $item->jenis_pendidikan }}</td>
                                                            <td>{{ $item->nama_pendidikan }}</td>
                                                            <td>{{ $item->jurusan }}</td>
                                                            <td>{{ $item->no_sttb }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->tgl_sttb)) }}</td>
                                                            <td>{{ $item->tempat }}</td>
                                                            <td>{{ $item->nama_kepsek }}</td>
                                                            <td> {{ $item->mulai == null ? '-' : date('d/m/Y', strtotime($item->mulai)) }}</td>
                                                            <td> {{ $item->sampai == null ? '-' : date('d/m/Y', strtotime($item->sampai)) }}</td>
                                                            <td>{{ $item->tanda_lulus }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Riwayat Pendidikan - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat Pendidikan belum diisi, lengkapi di menu Riwayat pendidikan -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row justify-content-center">
                            @if ($pegawai->kursusataupelatihan->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat Kursus/ Pelatihan - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Nama Kursus/Pelatihan</th>
                                                            <th scope="col">Mulai s/d Selesai</th>
                                                            <th scope="col">Tanda Lulus</th>
                                                            <th scope="col">Tempat</th>
                                                            <th scope="col">Keterangan</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pegawai->kursusataupelatihan as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->nama_kursus }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->mulai)) }} s/d {{ date('d/m/Y', strtotime($item->selesai)) }}</td>
                                                            <td>{{ $item->tanda_lulus }}</td>
                                                            <td>{{ $item->tempat }}</td>
                                                            <td>{{ $item->keterangan }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Riwayat Kursus/ Pelatihan - <code> {{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat Kursus/ Pelatihan belum diisi, lengkapi di menu Riwayat Kursus/ Pelatihan -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row justify-content-center">
                            @if ($pegawai->organisasi->count() > 0)
                                @if ($organisasi1->count() > 0)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Riwayat Organisasi - <code>Semasa SLTA ke bawah</code></label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                    <thead>
                                                            <tr class="text-center">
                                                                <th scope="col">Nama Organisasi</th>
                                                                <th scope="col">Kedudukan dalam Organisasi</th>
                                                                <th scope="col">Tahun Mulai</th>
                                                                <th scope="col">Tahun Selesai</th>
                                                                <th scope="col">Tempat</th>
                                                                <th scope="col">Pimpinan Organisasi</th>
                                                            </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($organisasi1 as $item)
                                                            <tr class="text-center">
                                                                <td>{{ $item->nama }}</td>
                                                                <td>{{ $item->kedudukan }}</td>
                                                                <td>{{ $item->tahun_mulai }}</td>
                                                                <td>{{ $item->tahun_selesai }}</td>
                                                                <td>{{ $item->tempat }}</td>
                                                                <td>{{ $item->pimpinan }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Riwayat Organisasi - <code>Semasa SLTA ke bawah</code></label>
                                            <p class="border-bottom text-gray-800">
                                                - Organisasi Semasa SLTA ke bawah belum diisi, lengkapi dimenu Riwayat pendidikan -
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                @if ($organisasi2->count() > 0)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Riwayat Organisasi - <code>Semasa Perguruan Tinggi</code></label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                    <thead>
                                                            <tr class="text-center">
                                                                <th scope="col">Nama Organisasi</th>
                                                                <th scope="col">Kedudukan dalam Organisasi</th>
                                                                <th scope="col">Tahun Mulai</th>
                                                                <th scope="col">Tahun Selesai</th>
                                                                <th scope="col">Tempat</th>
                                                                <th scope="col">Pimpinan Organisasi</th>
                                                            </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($organisasi2 as $item)
                                                            <tr class="text-center">
                                                                <td>{{ $item->nama }}</td>
                                                                <td>{{ $item->kedudukan }}</td>
                                                                <td>{{ $item->tahun_mulai }}</td>
                                                                <td>{{ $item->tahun_selesai }}</td>
                                                                <td>{{ $item->tempat }}</td>
                                                                <td>{{ $item->pimpinan }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Riwayat Organisasi - <code>Semasa Perguruan Tinggi</code></label>
                                            <p class="border-bottom text-gray-800">
                                                - Organisasi Semasa Perguruan Tinggi belum diisi, lengkapi dimenu Riwayat pendidikan -
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                
                                @if ($organisasi3->count() > 0)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Riwayat Organisasi - <code>Selesai Pendidikan atau Selama Menjadi PNS</code></label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                    <thead>
                                                            <tr class="text-center">
                                                                <th scope="col">Nama Organisasi</th>
                                                                <th scope="col">Kedudukan dalam Organisasi</th>
                                                                <th scope="col">Tahun Mulai</th>
                                                                <th scope="col">Tahun Selesai</th>
                                                                <th scope="col">Tempat</th>
                                                                <th scope="col">Pimpinan Organisasi</th>
                                                            </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($organisasi3 as $item)
                                                            <tr class="text-center">
                                                                <td>{{ $item->nama }}</td>
                                                                <td>{{ $item->kedudukan }}</td>
                                                                <td>{{ $item->tahun_mulai }}</td>
                                                                <td>{{ $item->tahun_selesai }}</td>
                                                                <td>{{ $item->tempat }}</td>
                                                                <td>{{ $item->pimpinan }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Riwayat Organisasi - <code>Selesai Pendidikan atau Selama Menjadi PNS</code></label>
                                            <p class="border-bottom text-gray-800">
                                                - Organisasi Selesai Pendidikan atau Selama Menjadi PNS belum diisi, lengkapi dimenu Riwayat pendidikan -
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Riwayat Organisasi - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat Organisasi belum diisi, lengkapi dimenu Riwayat pendidikan -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="keluarga" role="tabpanel" aria-labelledby="keluarga-tab">
                        <div class="row justify-content-center">
                            @if ($pegawai->keterangan_keluarga->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keterangan Keluarga - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Nama</th>
                                                            <th scope="col">Jenis Kelamin</th>
                                                            <th scope="col">Tempat Lahir</th>
                                                            <th scope="col">Tanggal Lahir</th>
                                                            <th scope="col">Tanggal Nikah</th>
                                                            <th scope="col">Pekerjaan</th>
                                                            <th scope="col">Keterangan</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pegawai->keterangan_keluarga as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->status }}</td>
                                                            <td>{{ $item->nama }}</td>
                                                            <td>{{ $item->jenis_kelamin }}</td>
                                                            <td>{{ $item->tempat_lahir }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->tgl_lahir)) }}</td>
                                                            <td>@if ($item->tgl_nikah == null)
                                                                -
                                                                @else
                                                                   {{ date('d/m/Y', strtotime($item->tgl_nikah)) }} 
                                                                @endif</td>
                                                            <td>{{ $item->pekerjaan }}</td>
                                                            <td>{{ $item->keterangan }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Keterangan Keluarga - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Keterangan keluarga belum diisi, lengkapi terlebih dahulu dimenu riwayat keluarga -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row justify-content-center">
                            @if ($pegawai->orangtua_kandung->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Orang Tua Kandung - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Nama</th>
                                                            <th scope="col">Tanggal Lahir</th>
                                                            <th scope="col">Pekerjaan</th>
                                                            <th scope="col">Keterangan</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pegawai->orangtua_kandung as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->status }}</td>
                                                            <td>{{ $item->nama }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->tgl_lahir)) }}</td>
                                                            <td>{{ $item->pekerjaan }}</td>
                                                            <td>{{ $item->keterangan }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Orang Tua Kandung - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Orang Tua Kandung belum diisi, lengkapi terlebih dahulu dimenu riwayat keluarga -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row justify-content-center">
                            @if ($pegawai->saudara_kandung->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Saudara Kandung - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Nama</th>
                                                            <th scope="col">Jenis Kelamin</th>
                                                            <th scope="col">Tanggal Lahir</th>
                                                            <th scope="col">Pekerjaan</th>
                                                            <th scope="col">Keterangan</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pegawai->saudara_kandung as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->nama }}</td>
                                                            <td>{{ $item->jenis_kelamin }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->tgl_lahir)) }}</td>
                                                            <td>{{ $item->pekerjaan }}</td>
                                                            <td>{{ $item->keterangan }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Saudara Kandung - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Saudara Kandung belum diisi, lengkapi terlebih dahulu dimenu riwayat keluarga -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row justify-content-center">
                            @if ($pegawai->mertua->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Mertua - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Nama</th>
                                                            <th scope="col">Tanggal Lahir</th>
                                                            <th scope="col">Pekerjaan</th>
                                                            <th scope="col">Keterangan</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pegawai->mertua as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->status }}</td>
                                                            <td>{{ $item->nama }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->tgl_lahir)) }}</td>
                                                            <td>{{ $item->pekerjaan }}</td>
                                                            <td>{{ $item->keterangan }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Mertua - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Mertua belum diisi, lengkapi terlebih dahulu dimenu riwayat keluarga -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kepegawaian" role="tabpanel" aria-labelledby="kepegawaian-tab">
                        <div class="row justify-content-center">
                            @if ($pegawai->diklat_penjenjangan->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat Diklat Penjenjangan - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Nama Diklat</th>
                                                            <th scope="col">Tahun</th>
                                                            <th scope="col">Nomor</th>
                                                            <th scope="col">Tanggal</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pegawai->diklat_penjenjangan as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->nama_diklat }}</td>
                                                            <td>{{ $item->tahun }}</td>
                                                            <td>{{ $item->nomor }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Riwayat Diklat Penjenjangan - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat Diklat Penjenjangan belum diisi, lengkapi dimenu Kepegawaian -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row justify-content-center">
                            @if ($pegawai->penghargaan->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat Bintang/Penghargaan - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Nama Bintang/ Penghargaan</th>
                                                            <th scope="col">Tahun Perolehan</th>
                                                            <th scope="col">Nama Negara/ Instansi</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pegawai->penghargaan as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->nama_penghargaan }}</td>
                                                            <td>{{ $item->tahun }}</td>
                                                            <td>{{ $item->negara_instansi }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Riwayat Bintang/Penghargaan - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat Bintang/Penghargaan belum diisi, lengkapi dimenu Kepegawaian -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row justify-content-center">
                            @if ($pegawai->pengalaman_keluar_negeri->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat Pengalaman Keluar Negeri - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Negara</th>
                                                            <th scope="col">Tujuan Kunjungan</th>
                                                            <th scope="col">Lama Kunjungan</th>
                                                            <th scope="col">Yang Membiayai</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pegawai->pengalaman_keluar_negeri as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->negara }}</td>
                                                            <td>{{ $item->tujuan }}</td>
                                                            <td>{{ $item->lama }}</td>
                                                            <td>{{ $item->membiayai }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Riwayat Pengalaman Keluar Negeri - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat Pengalaman Keluar Negeri belum diisi, lengkapi dimenu Kepegawaian -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row justify-content-center">
                            @if ($pegawai->keterangan_lain->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat Keterangan lain - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Jenis</th>
                                                            <th scope="col">Pejabat</th>
                                                            <th scope="col">Nomor</th>
                                                            <th scope="col">Tanggal</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pegawai->keterangan_lain as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->jenis }}</td>
                                                            <td>{{ $item->penjabat }}</td>
                                                            <td>{{ $item->nomor }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Riwayat Keterangan lain - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat Keterangan lain belum diisi, lengkapi dimenu Kepegawaian -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="mutasi" role="tabpanel" aria-labelledby="mutasi-tab">
                        <div class="row justify-content-center">
                            @if ($pegawai->mutasi->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat Mutasi - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Jenis Mutasi</th>
                                                            <th scope="col">Asal</th>
                                                            <th scope="col">Tujuan Mutasi</th>
                                                            <th scope="col">Tanggal</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pegawai->mutasi as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->jenis_mutasi }}</td>
                                                            <td>{{ $item->asal }}</td>
                                                            <td>{{ $item->tujuan }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Riwayat Mutasi - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat Mutasi belum diisi, lengkapi dimenu Mutasi -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="dokumen" role="tabpanel" aria-labelledby="dokumen-tab">
                        <div class="row justify-content-center">
                            @if ($pegawai->dokumen_pegawai->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat File Dokumen - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Nama Pegawai</th>
                                                            <th scope="col">Keterangan</th>
                                                            <th scope="col">File Dokumen</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pegawai->dokumen_pegawai as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->nama_dokumen }}</td>
                                                            <td>{{ $item->keterangan }}</td>
                                                            <td><a href='{{ asset('/storage/file_dokumen/'.$item->file_dokumen)}}' target='_blank' title='download'><h4><i class='fa fa-file'></i></h4></a></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Riwayat File Dokumen - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat File Dokumen belum diisi, lengkapi dimenu Dokumen Kepegawaian -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pangkat_cpns" role="tabpanel" aria-labelledby="pangkat_cpns-tab">
                        <div class="row justify-content-center">
                            @if ($pegawai->pangkat_cpns !=null)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat Pangkat CPNS Pegawai - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Pangkat Golongan</th>
                                                            <th scope="col">TMT</th>
                                                            <th scope="col">Gaji Pokok</th>
                                                            <th scope="col">Pejabat</th>
                                                            <th scope="col">Nomor</th>
                                                            <th scope="col">Tanggal</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <tr class="text-center">
                                                            <td>{{ $pangkat_cpns->golongan->pangkat }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($pangkat_cpns->tmt)) }}</td>
                                                            <td>{{ $pangkat_cpns->gaji_pokok }}</td>
                                                            <td>{{ $pangkat_cpns->penjabat }}</td>
                                                            <td>{{ $pangkat_cpns->nomor }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($pangkat_cpns->tanggal)) }}</td>
                                                        </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Riwayat Pangkat CPNS Pegawai - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat Pangkat CPNS Pegawai belum diisi, lengkapi dimenu Kepegawaian -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>   
                    </div>
                    <div class="tab-pane fade" id="pangkat_pns" role="tabpanel" aria-labelledby="pangkat_pns-tab">
                        <div class="row justify-content-center">
                            @if ($pegawai->pangkat_pns !=null)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat Pangkat PNS Pegawai - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Pangkat Golongan</th>
                                                            <th scope="col">TMT</th>
                                                            <th scope="col">Pejabat</th>
                                                            <th scope="col">Nomor</th>
                                                            <th scope="col">Tanggal</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <tr class="text-center">
                                                            <td>{{ $pangkat_pns->golongan->pangkat }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($pangkat_pns->tmt)) }}</td>
                                                            <td>{{ $pangkat_pns->penjabat }}</td>
                                                            <td>{{ $pangkat_pns->nomor }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($pangkat_pns->tanggal)) }}</td>
                                                        </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Riwayat Pangkat PNS Pegawai - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat Pangkat PNS Pegawai belum diisi, lengkapi dimenu Kepegawaian -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>   
                    </div>
                    <div class="tab-pane fade" id="pangkat" role="tabpanel" aria-labelledby="pangkat-tab">
                        <div class="row justify-content-center">
                            @if ($pegawai->riwayat_pangkat->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat Pangkat Pegawai - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Pangkat Golongan</th>
                                                            <th scope="col">TMT</th>
                                                            <th scope="col">Pejabat</th>
                                                            <th scope="col">Nomor</th>
                                                            <th scope="col">Tanggal</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pegawai->riwayat_pangkat as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->golongan->pangkat }} - {{ $item->golongan->nama_golongan }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->tmt)) }}</td>
                                                            <td>{{ $item->penjabat }}</td>
                                                            <td>{{ $item->nomor }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Riwayat Pangkat Pegawai - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat Pangkat Pegawai belum diisi, lengkapi dimenu Kepegawaian -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>   
                    </div>
                    <div class="tab-pane fade" id="kgb" role="tabpanel" aria-labelledby="kgb-tab">
                        <div class="row justify-content-center">
                            @if ($pegawai->riwayat_kgb->count() > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat Kenaikan Gaji Berkala - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">Gol</th>
                                                            <th scope="col">Gaji</th>
                                                            <th scope="col">Dari-Sampai</th>
                                                            <th scope="col">Pejabat</th>
                                                            <th scope="col">Nomor</th>
                                                            <th scope="col">Tanggal</th>
                                                            <th scope="col">Peraturan</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($kgb as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $item->golongan->nama_golongan }}</td>
                                                            <td>{{ $item->jumlah_gaji }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->mulai_berlaku)) }} - {{ date('d/m/Y', strtotime($item->batas_berlaku)) }}</td>
                                                            <td>{{ $item->penjabat }}</td>
                                                            <td>{{ $item->nomor }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                                                            <td>{{ $item->peraturan }}</td>
                                                            <td> {{ $item->status == '0' ? 'Aktif' : 'Nonaktif' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Riwayat Kenaikan Gaji Berkala - <code>{{ $pegawai->nama_pegawai }}</code></label>
                                    <p class="border-bottom text-gray-800">
                                        - Riwayat Kenaikan Gaji Berkala belum diisi, lengkapi dimenu Dokumen Kepegawaian -
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
    </div>
</section>
@endsection