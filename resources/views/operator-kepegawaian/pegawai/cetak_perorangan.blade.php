<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @media print {
            .jarak {
                clear: both;
                page-break-after: always;
            }
        }
        table.static{
            position: relative;
            border: 1px solid black;
        }
        td {
            padding: 10px;
            text-align: left;
        }
    </style>
    <title>Cetak Pegawai - {{ $pegawai->nama_pegawai }}</title>
</head>
<body>
    <div class="jarak">
        <div class="form-group">
            <p style="margin-left: 34%;line-height: 5px"><b>LAMPIRAN : KEPUTUSAN BADAN KEPEGAWAIAN NEGARA</b></p>
            <p style="margin-left: 48%;line-height: 5px"><b>NOMOR    : 11 TAHUN 2012</b></p>
            <p style="margin-left: 48%;line-height: 5px"><b>TANGGAL  : 17 JUNI 2012</b></p>
        </div>
        <div class="form-group">
            <center style="margin-top: 40px"><h3><u>DAFTAR RIWAYAT HIDUP</u></h3></center>
            <p style="margin-top:40px; margin-left:5%"><strong>I. KETERANGAN PERORANGAN</strong></p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
            <tr>
                <td>1</td>
                <td colspan="2">NAMA LENGKAP</td>
                <td colspan="2">{{ $pegawai->nama_pegawai }}</td>
            </tr>
    
            <tr>
                <td>2</td>
                <td colspan="2">NIP</td>
                <td colspan="2">{{ $pegawai->nip_pegawai }}</td>
            </tr>
    
            <tr>
                <td>3</td>
                <td colspan="2">PANGKAT DAN GOLONGAN RUANG</td>
                <td colspan="2">@if ($pangkatgolongan != null)
                    {{ $pangkatgolongan->golongan->pangkat }}  {{ $pangkatgolongan->golongan->nama_golongan }}
                @else
                    -
                @endif</td>
            </tr>
    
            <tr>
                <td>4</td>
                <td colspan="2">TEMPAT / TANGGAL LAHIR</td>
                <td colspan="2">{{ date('d-m-Y',strtotime($pegawai->tanggal_lahir)) }} / {{ $pegawai->tempat_lahir }}</td>
            </tr>
    
            <tr>
                <td>5</td>
                <td colspan="2">JENIS KELAMIN</td>
                <td colspan="2">{{ $pegawai->jenis_kelamin }}</td>
            </tr>
    
            <tr>
                <td>6</td>
                <td colspan="2">AGAMA</td>
                <td colspan="2">{{ $pegawai->agama }}</td>
            </tr>
    
            <tr>
                <td>7</td>
                <td colspan="2">STATUS PERKAWINAN</td>
                <td colspan="2">{{ $pegawai->status_perkawinan }}</td>
            </tr>
    
            @if ($pegawai->alamat != null)
                <tr>
                    <td rowspan="5">8</td>
                    <td rowspan="5">ALAMAT RUMAH</td>
                    <td>a. Jalan</td>
                    <td>{{ $pegawai->alamat->jalan }}</td>
                </tr>
                <tr>
                    <td>b. Kelurahan/Desa</td>
                    <td>{{ $pegawai->alamat->kelurahan_desa }}</td>
                </tr>
                <tr>
                    <td>c. Kecamatan</td>
                    <td>{{ $pegawai->alamat->kecamatan }}</td>
                </tr>
                <tr>
                    <td>d. Kabupaten/Kota</td>
                    <td>{{ $pegawai->alamat->kabupaten_kota }}</td>
                </tr>
                <tr>
                    <td>e. Propinsi</td>
                    <td>{{ $pegawai->alamat->provinsi }}</td>
                </tr>
            @else
                <tr>
                    <td rowspan="5">8</td>
                    <td rowspan="5">ALAMAT RUMAH</td>
                    <td>a. Jalan</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>b. Kelurahan/Desa</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>c. Kecamatan</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>d. Kabupaten/Kota</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>e. Propinsi</td>
                    <td>-</td>
                </tr>
            @endif
    
            @if ($pegawai->keterangan_badan != null)
                <tr>
                    <td rowspan="7">9</td>
                    <td rowspan="7">KETERANGAN BADAN</td>
                    <td>a. Tinggi</td>
                    <td>{{ $pegawai->keterangan_badan->tinggi }}</td>
                </tr>
                <tr>
                    <td>b. Berat Badan</td>
                    <td>{{ $pegawai->keterangan_badan->berat_badan }}</td>
                </tr>
                <tr>
                    <td>c. Rambut</td>
                    <td>{{ $pegawai->keterangan_badan->rambut }}</td>
                </tr>
                <tr>
                    <td>d. Bentuk Muka</td>
                    <td>{{ $pegawai->keterangan_badan->bentuk_muka }}</td>
                </tr>
                <tr>
                    <td>e. Warna Kulit</td>
                    <td>{{ $pegawai->keterangan_badan->warna_kulit }}</td>
                </tr>
                <tr>
                    <td>e. Ciri Khas</td>
                    <td>{{ $pegawai->keterangan_badan->ciri_khas }}</td>
                </tr>
                <tr>
                    <td>e. Cacat Tubuh</td>
                    <td>{{ $pegawai->keterangan_badan->cacat_tubuh }}</td>
                </tr>
            @else
                <tr>
                    <td rowspan="7">9</td>
                    <td rowspan="7">KETERANGAN BADAN</td>
                    <td>a. Tinggi</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>b. Berat Badan</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>c. Rambut</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>d. Bentuk Muka</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>e. Warna Kulit</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>e. Ciri Khas</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>e. Cacat Tubuh</td>
                    <td>-</td>
                </tr>
            @endif
    
            <tr>
                <td>10</td>
                <td colspan="2">Hobi</td>
                <td colspan="2">
                   @forelse ($pegawai->hobi as $item)
                       {{ $item->hobi }} 
                   @empty
                       -
                   @endforelse
                </td>
            </tr>
            <caption align="bottom" style="text-align: left">x) Coret yang tidak perlu</caption>
            </table>
        </div>
    </div>
    <div class="jarak">
        <div class="form-group">
            <p style="margin-left:5%;"><strong>II. PENDIDIKAN</strong></p>
            <p style="margin-left:10%;">1. Pendidikan Dalan dan Luar Negeri</p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <tr>
                    <td>NO</td>
                    <td>TINGKAT</td>
                    <td>NAMA PENDIDIKAN</td>
                    <td>JURUSAN</td>
                    <td>STTB/ TANDA LULUS/ IJAZAH TAHUN</td>
                    <td>TEMPAT</td>
                    <td>NAMA KEPALA SEKOLAH/ DIREKTUR/ DEKAN/ PROMOTOR</td>
                </tr>
                @if ($pegawai->riwayat_pendidikan->count() > 0)
                    @php
                        $no =1;
                    @endphp
                    @foreach ($pendidikan as $item)
                        <tr>
                           <td>{{ $no++ }}</td>
                           <td>{{ $item->jenis_pendidikan }}</td>
                           <td>{{ $item->nama_pendidikan }}</td>
                           <td>{{ $item->jurusan }}</td>
                           <td>{{ $item->no_sttb }}/{{ $item->tanda_lulus }}/{{ date('Y',strtotime($item->ptgl_sttb)) }}</td>
                           <td>{{ $item->tempat }}</td>
                           <td>{{ $item->nama_kepsek }}</td> 
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> 
                @endif
            </table>

            <p style="margin-left:10%;margin-top:20px">2. Kursus/ Latihan di dalam luar negeri</p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <tr>
                    <td>NO</td>
                    <td>NAMA KURSUS DAN LATIHAN</td>
                    <td>LAMANYA TGL/BLN/s/d TGL/BLN/THN</td>
                    <td>IJAZAH/ TANDA LULUS/ SURAT/ KETERANGAN/ TAHUN</td>
                    <td>TEMPAT</td>
                    <td>KET</td>
                </tr>
                @if ($pegawai->kursusataupelatihan->count() > 0)
                @php
                    $nok=1;
                @endphp
                    @foreach ($pegawai->kursusataupelatihan as $item)
                        <tr>
                            <td>{{ $nok++ }}</td>
                            <td>{{ $item->nama_kursus }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->mulai)) }} s/d {{ date('d/m/Y', strtotime($item->selesai)) }}</td>
                            <td>{{ $item->tanda_lulus }}</td>
                            <td>{{ $item->tempat }}</td>
                            <td>{{ $item->keterangan }}</td>
                        </tr>
                    @endforeach
                @else 
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                @endif
                 
            </table>
        </div>
    </div>
    <div class="jarak">
        <div class="form-group">
            <p style="margin-left:5%;"><strong>III. RIWAYAT PEKERJAAN</strong></p>
            <p style="margin-left:10%;">1. Riwayat Kepangkatan Golongan Ruang dan Penggajian</p>
            <table class="static" align="center" rules="all" border="1px" style="width:90%;">
                <tr>
                    <td rowspan="2">NO</td>
                    <td rowspan="2">PANGKAT</td>
                    <td rowspan="2">GOL RUANG PENGGAJIAN</td>
                    <td rowspan="2">BERLAKU TERHITUNG MULAI TANGGAL</td>
                    <td colspan="3" style="text-align: center">SURAT KEPUTUSAN</td>
                    <td rowspan="2">PERATURAN YANG DIJADIKAN DASAR</td>
                </tr>
                <tr>
                    <td>PENJABAT</td>
                    <td>NOMOR</td>
                    <td>TGL</td>
                </tr>
                @php
                    $no_pangkat= 1;
                @endphp
                @if ($pegawai->riwayat_kgb->count() > 0)
                    @foreach ($riwayat_kenaikan_gaji as $item)
                    <tr>
                        <td>{{ $no_pangkat++ }}</td>
                        <td>{{ $item->golongan->pangkat }}</td>
                        <td>{{ $item->golongan->nama_golongan }}</td>
                        <td>{{ $item->jumlah_gaji }}</td>
                        <td>{{ $item->penjabat }}</td>
                        <td>{{ $item->nomor }}</td>
                        <td>{{ date('d m Y', strtotime($item->tanggal)) }}</td>
                        <td>{{ $item->peraturan }}</td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>  
                @endif
                
            </table>
        </div>
    </div>
    <div class="jarak">
        <div class="form-group">
            <p style="margin-left:5%;"><strong>IV. TANDA JASA/ PENGHARGAAN</strong></p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <tr>
                    <td>NO</td>
                    <td>NAMA BINTANG/ STYA LENCANA PENGHARGAAN</td>
                    <td>TAHUN PEROLEHAN</td>
                    <td>NAMA NEGARA/ INSTANSI YANG MEMBERI</td>
                </tr>
                @if ($pegawai->penghargaan->count() > 0)
                    @php
                        $no_penghargaan =1;
                    @endphp
                    @foreach ($pegawai->penghargaan as $item)
                        <tr>
                           <td>{{ $no_penghargaan++ }}</td>
                           <td>{{ $item->nama_penghargaan }}</td>
                           <td>{{ $item->tahun }}</td>
                           <td>{{ $item->negara_instansi }}</td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> 
                @endif
            </table>

            <p style="margin-left:5%;margin-top:30px;"><strong>V. PENGALAMAN KUNJUNGAN KE LUAR NEGERI</strong></p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <tr>
                    <td>NO</td>
                    <td>NEGARA</td>
                    <td>TUJUAN KUNJUNGAN</td>
                    <td>LAMANYA</td>
                    <td>YANG MEMBIAYAI</td>
                </tr>
                @if ($pegawai->pengalaman_keluar_negeri->count() > 0)
                    @php
                        $no_luarnegeri =1;
                    @endphp
                    @foreach ($pegawai->pengalaman_keluar_negeri as $item)
                        <tr>
                           <td>{{ $no_luarnegeri++ }}</td>
                           <td>{{ $item->negara }}</td>
                           <td>{{ $item->tujuan }}</td>
                           <td>{{ $item->lama }}</td>
                           <td>{{ $item->membiayai }}</td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> 
                @endif
            </table>

            <p style="margin-left:5%;margin-top:30px;"><strong>VI. KETERANGAN KELUARGA</strong></p>
            <p style="margin-left:10%;margin-top:20px">1. Suami/ Isteri</p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <tr>
                    <td>NO</td>
                    <td>NAMA</td>
                    <td>TEMPAT LAHIR</td>
                    <td>TANGGAL LAHIR</td>
                    <td>TANGGAL NIKAH</td>
                    <td>PEKERJAAN</td>
                    <td>KET</td>
                </tr>
                @if ($pegawai->keterangan_keluarga->count() > 0)
                    @php
                        $no_nikah =1;
                    @endphp

                    @foreach ($pegawai->keterangan_keluarga as $item)
                        @if ($item->status != 'Anak')
                        <tr>
                            <td>{{ $no_nikah++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->tempat_lahir }}</td>
                            <td>{{ $item->tgl_lahir }}</td>
                            <td>{{ $item->tgl_nikah }}</td>
                            <td>{{ $item->pekerjaan }}</td>
                            <td>{{ $item->keterangan }}</td>
                         </tr>
                         @else
                         <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        @endif
                    @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> 
                @endif 
            </table>

            <p style="margin-left:10%;margin-top:20px">2. Anak</p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <tr>
                    <td>NO</td>
                    <td>NAMA</td>
                    <td>JENIS KELAMIN</td>
                    <td>TEMPAT LAHIR</td>
                    <td>TANGGAL LAHIR</td>
                    <td>PEKERJAAN</td>
                    <td>KET</td>
                </tr>
                @if ($pegawai->keterangan_keluarga->count() > 0)
                    @php
                        $no_nikah =1;
                    @endphp

                    @foreach ($pegawai->keterangan_keluarga as $item)
                        @if ($item->status == 'Anak')
                        <tr>
                            <td>{{ $no_nikah++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->tempat_lahir }}</td>
                            <td>{{ $item->tgl_lahir }}</td>
                            <td>{{ $item->pekerjaan }}</td>
                            <td>{{ $item->keterangan }}</td>
                         </tr>
                         @else
                         <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr> 
                        @endif
                    @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> 
                @endif 
            </table>
        </div>
    </div>
    <div class="jarak">
        <div class="form-group">
            <p style="margin-left:10%;margin-top:20px">3. Bapak dan Ibu Kandung</p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <tr>
                    <td>NO</td>
                    <td>NAMA</td>
                    <td>TANGGAL LAHIR/ UMUR</td>
                    <td>PEKERJAAN</td>
                    <td>KET</td>
                </tr>
                @if ($pegawai->orangtua_kandung->count() > 0)
                    @php
                        $no_orangtua =1;
                    @endphp

                    @foreach ($pegawai->orangtua_kandung as $item)
                    @php
                        $diff = abs(strtotime(now()) - strtotime($item->tgl_lahir));
                        $umur = floor($diff / (365*60*60*24));

                    @endphp
                        <tr>
                            <td>{{ $no_orangtua++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ date('d m Y',strtotime($item->tgl_lahir)) }} / {{ $umur }} Tahun </td>
                            <td>{{ $item->pekerjaan }}</td>
                            <td>{{ $item->keterangan }}</td>
                         </tr>
                    @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> 
                @endif 
            </table>

            <p style="margin-left:10%;margin-top:20px">4. Bapak dan Ibu Mertua</p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <tr>
                    <td>NO</td>
                    <td>NAMA</td>
                    <td>TANGGAL LAHIR/ UMUR</td>
                    <td>PEKERJAAN</td>
                    <td>KET</td>
                </tr>
                @if ($pegawai->mertua->count() > 0)
                    @php
                        $no_mertua =1;
                    @endphp

                    @foreach ($pegawai->mertua as $item)
                    @php
                        $diff = abs(strtotime(now()) - strtotime($item->tgl_lahir));
                        $umur = floor($diff / (365*60*60*24));

                    @endphp
                        <tr>
                            <td>{{ $no_mertua++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ date('d m Y',strtotime($item->tgl_lahir)) }} / {{ $umur }} Tahun </td>
                            <td>{{ $item->pekerjaan }}</td>
                            <td>{{ $item->keterangan }}</td>
                         </tr>
                    @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> 
                @endif 
            </table>

            <p style="margin-left:10%;margin-top:20px">5. Saudara Kandung</p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <tr>
                    <td>NO</td>
                    <td>NAMA</td>
                    <td>JENIS KELAMIN</td>
                    <td>TANGGAL LAHIR/ UMUR</td>
                    <td>PEKERJAAN</td>
                    <td>KET</td>
                </tr>
                @if ($pegawai->saudara_kandung->count() > 0)
                    @php
                        $no_saudarakandung =1;
                    @endphp

                    @foreach ($pegawai->saudara_kandung as $item)
                    @php
                        $diff = abs(strtotime(now()) - strtotime($item->tgl_lahir));
                        $umur = floor($diff / (365*60*60*24));

                    @endphp
                        <tr>
                            <td>{{ $no_saudarakandung++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ date('d m Y',strtotime($item->tgl_lahir)) }} / {{ $umur }} Tahun </td>
                            <td>{{ $item->pekerjaan }}</td>
                            <td>{{ $item->keterangan }}</td>
                         </tr>
                    @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> 
                @endif 
            </table>

            <p style="margin-left:5%;margin-top:30px;"><strong>VI. KETERANGAN ORGANISASI</strong></p>
            <p style="margin-left:10%;margin-top:20px">1. Semasa mengikuti pendidikan pada SLTA ke bawah</p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <tr>
                    <td>NO</td>
                    <td>NAMA ORGANISASI</td>
                    <td>KEDUDUKAN DALAM ORGANISASI</td>
                    <td>DALAM TAHUN S/D TAHUN</td>
                    <td>TEMPAT</td>
                    <td>NAMA PIMPINAN ORGANISASI</td>
                </tr>
                @if ($pegawai->organisasi->count() > 0)
                    @php
                        $no_organisasi =1;
                    @endphp

                    @foreach ($pegawai->organisasi as $item)
                        @if ($item->waktu=="Semasa SLTA ke bawah")
                        <tr>
                            <td>{{ $no_organisasi++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kedudukan }}</td>
                            <td>{{ $item->tahun_mulai }} s/d {{ $item->tahun_selesai }}</td>
                            <td>{{ $item->tempat }}</td>
                            <td>{{ $item->pimpinan }}</td>
                         </tr>
                         @else
                         <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr> 
                        @endif
                    @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> 
                @endif 
            </table>

            <p style="margin-left:10%;margin-top:20px">2. Semasa mengikuti pendidikan pada Perguruan Tinggi</p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <tr>
                    <td>NO</td>
                    <td>NAMA ORGANISASI</td>
                    <td>KEDUDUKAN DALAM ORGANISASI</td>
                    <td>DALAM TAHUN S/D TAHUN</td>
                    <td>TEMPAT</td>
                    <td>NAMA PIMPINAN ORGANISASI</td>
                </tr>
                @if ($pegawai->organisasi->count() > 0)
                    @php
                        $no_organisasii =1;
                    @endphp

                    @foreach ($pegawai->organisasi as $item)
                        @if ($item->waktu=="Semasa Perguruan Tinggi")
                        <tr>
                            <td>{{ $no_organisasii++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kedudukan }}</td>
                            <td>{{ $item->tahun_mulai }} s/d {{ $item->tahun_selesai }}</td>
                            <td>{{ $item->tempat }}</td>
                            <td>{{ $item->pimpinan }}</td>
                         </tr>
                         @else
                         <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr> 
                        @endif
                    @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> 
                @endif 
            </table>
        </div>
    </div>
    
    <div class="jarak">
        <div class="form-group">
            <p style="margin-left:10%;margin-top:20px">3. Sesudah selesai pendidikan atau selama menjadi pegawai</p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <tr>
                    <td>NO</td>
                    <td>NAMA ORGANISASI</td>
                    <td>KEDUDUKAN DALAM ORGANISASI</td>
                    <td>DALAM TAHUN S/D TAHUN</td>
                    <td>TEMPAT</td>
                    <td>NAMA PIMPINAN ORGANISASI</td>
                </tr>
                @if ($pegawai->organisasi->count() > 0)
                    @php
                        $no_organisasiii =1;
                    @endphp

                    @foreach ($pegawai->organisasi as $item)
                        @if ($item->waktu=="Selesai Pendidikan atau Selama Menjadi PNS")
                        <tr>
                            <td>{{ $no_organisasiii++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kedudukan }}</td>
                            <td>{{ $item->tahun_mulai }} s/d {{ $tahun_selesai }}</td>
                            <td>{{ $item->tempat }}</td>
                            <td>{{ $item->pimpinan }}</td>
                         </tr>
                         @else
                         <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr> 
                        @endif
                    @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> 
                @endif 
            </table>

            <p style="margin-left:5%;margin-top:30px"><strong>VIII. KETERANGAN LAIN-LAIN</strong></p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <tr>
                    <td rowspan="2">NO</td>
                    <td rowspan="2">NAMA KETERANGAN</td>
                    <td colspan="3" style="text-align: center">SURAT KETERANGAN</td>
                </tr>
                <tr>
                    <td>PENJABAT</td>
                    <td>NOMOR</td>
                    <td>TANGGAL</td>
                </tr>
                @if ($pegawai->keterangan_lain->count() > 0)
                    @php
                        $no_ketlain =1;
                    @endphp
                    @foreach ($pegawai->keterangan_lain as $item)
                        <tr>
                           <td>{{ $no_ketlain++ }}</td>
                           <td>{{ $item->jenis }}</td>
                           <td>{{ $item->penjabat }}</td>
                           <td>{{ $item->nomor }}</td>
                           <td>{{ $item->tanggal }}</td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr> 
                @endif
            </table>
            <div align="center">
                <p style="width: 95%;text-align: justify;text-indent: 45px;">Demikian daftar riwayat hidup ini saya buat dengan sebenarnya dan apabila dikemudian hari terdapat keterangan yang tidak benar saya bersedia di tuntut dimuka pengadilan serta bersedia menerima segala tindakan yang diambil oleh pemerintah.</p>
            </div>
            <p style="margin-left: 50%;"">Bangkinang,</p>
            <table border="0"  align="right" style="width:80%;">
                <tr>
                    <td>Mengetahui</td>
                    <td>Yang membuat,</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding:0px;padding-left:10px"><u>Nama:</u></td>
                    <td style="padding:0px;padding-left:10px"><u>Nama:</u> {{ $pegawai->nama_pegawai }}</td>
                </tr>
                <tr>
                    <td style="padding:0px;padding-left:10px">NIP:</td>
                    <td style="padding:0px;padding-left:10px">NIP: {{ $pegawai->nip_pegawai }}</td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>