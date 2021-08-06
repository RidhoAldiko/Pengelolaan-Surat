@extends('layouts.main')
@section('title','Pengguna Sistem')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pengguna Sistem</h1>
    </div>
    <a href="{{ route('data-pengguna.add') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Pengguna Sistem</a>
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
                <h4>Data Pengguna Sistem</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="data-pengguna" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$result->id}}</td>
                                <td>{{$result->nama_pegawai}}</td>
                                <td>{{$result->email}}</td>
                                <td>{{$result->nama_jabatan}}</td>
                                <td>
                                    @if ($result->status == 0)
                                        {{'Aktif'}}
                                    @else
                                        {{'Tidak Aktif'}}
                                    @endif
                                </td>
                                <td>
                                        <a href="#" class="btn btn-warning text-white btn-sm" title="Edit">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('custom-js')
    <script>
        $(document).ready( function () {
            $('#data-pengguna').DataTable();
        } );
    </script>
@endpush