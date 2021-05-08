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
                    <table class="table table-striped" id="surat-masuk" width="100%" cellspacing="0">
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
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$result->pengirim}}</td>
                                    <td>{{$result->nomor_surat}}</td>
                                    <td>{{date("d/m/Y", strtotime($result->tanggal_surat))}}</td>
                                    <td>
                                        <a href="{{Storage::url($result->file_surat)}}" target="_blank"> <i class="fa fa-file-pdf fa-2x"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('disposisi-surat-masuk.ignore',$result->id_surat_masuk)}}" class="btn btn-danger btn-sm" >
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <a href="{{route('disposisi-surat-masuk.create',$result->id_surat_masuk)}}" class="btn btn-success btn-sm" >
                                            <i class="fas fa-check"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-success text-white btn-sm" title="Edit">
                                        <i class="fas fa-info"></i> Detail
                                            </a>
                                        <a href="#" class="btn btn-warning text-white btn-sm" title="Edit">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm getIdSurat" data-toggle="modal" data-target="#deleteSurat" data-id="'.$data->id_surat.'" >
                                            <i class="fas fa-trash fa-sm"></i> Hapus
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
@push('script-surat-masuk')
    <script>
        $(document).ready( function () {
            $('#surat-masuk').DataTable();
        } );
    </script>
@endpush