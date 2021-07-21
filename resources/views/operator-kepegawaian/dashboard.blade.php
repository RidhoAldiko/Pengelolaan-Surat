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
              <div class="card shadow card-statistic-1">
                  <div class="card-header">
                    <h4>Total Pegawai</h4>
                  </div>
                  <div class="card-body mt-1 mb-4">
                      {{ $total_pegawai }}
                  </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card shadow card-statistic-1">
                  <div class="card-header">
                    <h4>Total Dokumen Pegawai</h4>
                  </div>
                  <div class="card-body mt-1 mb-4">
                    {{ $total_dokumen }}
                  </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card shadow card-statistic-1">
                  <div class="card-header">
                    <h4>Total Mutasi</h4>
                  </div>
                  <div class="card-body mt-1 mb-4">
                   {{ $total_mutasi }}
                  </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card shadow card-statistic-1">
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
                    <p style="font-size: 11px">Berikut daftar pegawai yang harus mengurus KGB pada 2 bulan ini.</p>
                      <div class="table-responsive">
                          <table  class="table table-bordered table-hover table-striped" id="dataPegawai" width="100%" style="font-size: 12px" cellspacing="0">
                              <thead>
                                  <tr>
                                      <th scope="col">Nama</th>
                                      <th scope="col">NIP</th>
                                      <th scope="col">Waktu Mulai</th>
                                      <th scope="col">Batas Waktu</th>
                                  </tr>
                              </thead>
                              <tbody>
                              @if ($data_kgb->count() > 0)
                                @php
                                    $datakgb = [];
                                    $akhir =strtotime(now());
                                @endphp
                                  @foreach ($data_kgb as $key => $value)
                                      @if ($value->pegawai->status == 0)
                                        @php
                                        $awal = strtotime($value->batas_berlaku); 
                                        $selisih =floor(($awal-$akhir ) / (60 * 60 * 24 * 30));
                                    @endphp
                                        {{-- jika tanggal batas berlaku <= 2 bulan maka tampilkan siapa saja --}}
                                        @if ($selisih <= 2 && $selisih >= 0)
                                        @php
                                          $datakgb[] = $value->pegawai->nip_pegawai;
                                        @endphp
                                        <tr>
                                          <td>{{ $value->pegawai->nama_pegawai }}</td>
                                          <td>{{ $value->pegawai->nip_pegawai }}</td>
                                          <td>{{ date('d/m/Y',strtotime($value->mulai_berlaku)) }}</td>
                                          <td>{{ date('d/m/Y',strtotime($value->batas_berlaku)) }}</td>
                                        </tr>
                                        @endif
                                      @endif
                                  @endforeach

                                      @if (count($datakgb) < 1)
                                      <tr>
                                        <td colspan="4" class="text-center" style="font-size: 11px">-Tidak Ada-</td>
                                      </tr> 
                                      @endif
                              @else
                              <tr>
                                <td colspan="4" class="text-center" style="font-size: 11px">--Data KGB Pegawai Belum Ada Dinputkan--</td>
                              </tr>
                              @endif
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
            </div>
{{-- --------------------------------------Untuk kenaikan pangkat----------------------------- --}}
              <div class="col-md-6">
                <div class="card shadow">
                  <div class="card-header">
                      <h4>Pemberitahuan Kenaikan Pangkat 4 Bulan Kedepan</h4>
                  </div>
                  <div class="card-body">
                    <p style="font-size: 11px">Berikut daftar pegawai yang harus mengurus kenaikan pangkat pada 4 bulan ini.</p>
                      <div class="table-responsive">
                          <table  class="table table-bordered table-hover table-striped" id="dataPegawai" width="100%" cellspacing="0" style="font-size: 12px">
                              <thead>
                                  <tr>
                                      <th scope="col">Nama</th>
                                      <th scope="col">NIP</th>
                                      <th scope="col">TMT</th>
                                      <th scope="col">Nomor</th>
                                      <th scope="col">Batas Waktu</th>
                                  </tr>
                              </thead>
                              <tbody>
                              @if ($data_pangkat->count() > 0)
                                @php
                                    $datapangkat = [];
                                    $akhir =strtotime(now());
                                @endphp
                                @foreach ($data_pangkat as $key => $value)
                                    @if ($value->pegawai->status == 0)
                                      @php
                                          $awal = strtotime($value->batas_berlaku); 
                                          $selisih =floor(($awal-$akhir) / (60 * 60 * 24 * 30));
                                      @endphp
                                      {{-- jika tanggal batas berlaku <= 2 bulan maka tampilkan siapa saja --}}
                                      @if ($selisih <= 4 && $selisih >= 0)
                                      @php
                                          $datapangkat[] = $value->pegawai->nama_pegawai;
                                      @endphp
                                      <tr>
                                        <td>{{ $value->pegawai->nama_pegawai }}</td>
                                        <td>{{ $value->pegawai->nip_pegawai }}</td>
                                        <td>{{ date('d/m/Y',strtotime($value->tmt)) }}</td>
                                        <td>{{ $value->nomor }}</td>
                                        <td>{{ date('d/m/Y',strtotime($value->batas_berlaku)) }}</td>
                                      </tr>
                                      @endif
                                    @endif
                                @endforeach
                                    @if (count($datapangkat) < 1)
                                    <tr>
                                      <td colspan="5" class="text-center" style="font-size: 11px">--Tidak Ada--</td>
                                    </tr>
                                    @endif
                              @else
                              <tr>
                                <td colspan="5" class="text-center" style="font-size: 11px">--Data Pangkat Pegawai Belum Ada Dinputkan--</td>
                              </tr>
                              @endif
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