@extends('layouts.main')
@section('title','Pengguna Sistem')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Surat Masuk</h1>
    </div>
    <a href="{{ route('surat-masuk.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Data Surat Masuk</a>
    @if (session('status'))
    <div class="alert shadow alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Tabel Data Surat Masuk</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataSuratMasuk" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Pengirim</th>
                                <th scope="col">No Surat</th>
                                <th scope="col">Tgl Surat</th>
                                <th scope="col">FIle</th>
                                <th scope="col">Disposisi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script-server-side_surat-masuk')
<script>
    $(function() {
        $('#dataSuratMasuk').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('surat-masuk.serverside')}}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'pengirim',
                    name: 'pengirim'
                },
                {
                    data: 'nomor_surat',
                    name: 'nomor_surat'
                },
                {
                    data: 'tanggal_surat',
                    name: 'tanggal_surat'
                },
                {
                    data: 'file_surat',
                    name: 'file_surat'
                },
                {
                    data: 'disposisi',
                    name: 'disposisi'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
                ],
            });
    } );
    </script>
@endpush