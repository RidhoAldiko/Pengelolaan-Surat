@extends('layouts.main')
@section('title','Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pegawai</h1>
    </div>
    @if (session('status'))
    <div class="alert shadow alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="section-body">
        <div class="card shadow">
            <div class="card-header">
                <h4>Tabel Data Pegawai</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table table-bordered table-hover table-striped" id="dataPegawai" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Unit Kerja</th>
                                <th scope="col">Golongan</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            {{-- js ajax get data pegawai ada di view/layouts/main.blade.php --}}
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection