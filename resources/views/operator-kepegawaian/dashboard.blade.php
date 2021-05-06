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
          
      </div>
    </div>
</section>
@endsection