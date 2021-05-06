@extends('layouts.main')
@section('title','Dashboard')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                  <div class="card-header">
                    <h4>Total Pegawai</h4>
                  </div>
                  <div class="card-body mt-1 mb-4">
                      {{ $total_pegawai }}
                  </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                  <div class="card-header">
                    <h4>Total Dokumen Pegawai</h4>
                  </div>
                  <div class="card-body mt-1 mb-4">
                    {{ $total_dokumen }}
                  </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                  <div class="card-header">
                    <h4>Total Mutasi</h4>
                  </div>
                  <div class="card-body mt-1 mb-4">
                   {{ $total_mutasi }}
                  </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-header">
                      <h4>Total Penghargaan</h4>
                    </div>
                    <div class="card-body mt-1 mb-4">
                     {{ $total_penghargaan }}
                    </div>
                </div>
              </div>                  
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="card shadow">
                <div class="card-header">
                    <h4>Pemberitahuan KGB 2 Bulan Kedepan</h4>
                </div>
                <div class="card-body">
                  <p>Berikut daftar pegawai yang harus mengurus KGB pada 2 bulan ini </p>
                    <div class="table-responsive">
                        <table  class="table table-bordered table-hover table-striped" id="dataPegawai" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Waktu Mulai</th>
                                    <th scope="col">Batas Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($data_kgb as $key => $value)
                             @php
                                 $akhir =strtotime(now());
                                 $awal = strtotime($value->batas_berlaku); 
                                $selisih =floor(($awal - $akhir) / (60 * 60 * 24 * 30));
                             @endphp
                                {{-- jika tanggal batas berlaku <= 2 bulan maka tampilkan siapa saja --}}
                                 @if ($selisih <= 2)
                                 <tr>
                                  <td>{{ $value->pegawai->nama_pegawai }}</td>
                                  <td>{{ $value->pegawai->nip_pegawai }}</td>
                                  <td>{{ date('d/m/Y',strtotime($value->mulai_berlaku)) }}</td>
                                  <td>{{ date('d/m/Y',strtotime($value->batas_berlaku)) }}</td>
                                </tr>
                                 @else
                                     <tr>
                                       <td colspan="4" class="text-center">--Tidak Ada--</td>
                                     </tr>
                                 @endif
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
          </div>
          
      </div>
    </div>
</section>
@endsection