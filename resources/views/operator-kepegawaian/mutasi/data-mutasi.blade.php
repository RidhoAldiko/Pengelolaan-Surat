@extends('layouts.main')
@section('title','Mutasi')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item active text-bold" aria-current="page">Mutasi</li>
        </ol>
    </div>
    <a href="{{ route('pegawai-mutasi.create') }}"class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Mutasi</a>
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
                <h4>Tabel Data Mutasi</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table table-bordered table-hover table-striped" id="dataPegawai" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama Pegawai</th>
                                <th scope="col">Jenis Mutasi</th>
                                <th scope="col">Asal</th>
                                <th scope="col">Tujuan</th>
                                <th scope="col">Tanggal Mutasi</th>
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

@push('custom-js')
<script>
    $(function() {
        $('#dataPegawai').DataTable({
            processing: true,
            serverSide: true,
            // order: [[ 0, 'ASC' ]],
            ajax: "{{route('mutasi.serverside')}}",
            columns: [
                {
                    data: 'nip',
                    name: 'nip',
                },
                {
                    data: 'nama',
                    name: 'nama',
                },
                {
                    data: 'jenis_mutasi',
                    name: 'jenis_mutasi',
                },
                {
                    data: 'asal',
                    name: 'asal',
                },
                {
                    data: 'tujuan',
                    name: 'tujuan',
                },
                {
                    data: 'tanggal',
                    name: 'tanggal',
                },
                ],
            });
    } );
    </script>
@endpush
