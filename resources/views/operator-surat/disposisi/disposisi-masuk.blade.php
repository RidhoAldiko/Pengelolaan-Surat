@extends('layouts.main')
@section('title','Disposisi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Disposisi</h1>
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
        <div class="card">
            <div class="card-header">
                <h4>Data Disposisi Surat Masuk</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="disposisi-surat-masuk" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Pengirim</th>
                                <th scope="col">Indeks</th>
                                <th scope="col">No Surat</th>
                                <th scope="col">Tgl Surat</th>
                                <th scope="col">Tgl Disposisi</th>
                                <th scope="col">status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$result->pengirim}}</td>
                                    <td>{{$result->indeks}}</td>
                                    <td>{{$result->nomor_surat}}</td>
                                    <td>{{$result->tanggal_surat}}</td>
                                    <td>{{$result->tanggal_disposisi}}</td>
                                    <td>
                                        @if ($result->status == 0)
                                            {{ 'Terdaftar' }} 
                                        @else
                                            {{ 'Berjalan' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($result->status == 0)
                                            <a href="#" class="btn btn-success text-white btn-sm" title="Edit">
                                                <i class="fas fa-info"></i> Detail
                                            </a>
                                            <a href="{{route('disposisi-surat-masuk.teruskan',$result->id_disposisi_surat_masuk)}}" class="btn btn-primary btn-sm" >
                                                <i class="fas fa-angle-right"></i> Teruskan
                                            </a>
                                            <a href="#" class="btn btn-warning text-white btn-sm" title="Edit">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm getIdSurat" data-toggle="modal" data-target="#deleteSurat" data-id="'.$result->id_disposisi_surat_masuk.'" >
                                                <i class="fas fa-trash fa-sm"></i> Hapus
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-success text-white btn-sm" title="Edit">
                                                <i class="fas fa-info"></i> Detail
                                            </a>
                                        @endif
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
@push('script-disposisi-surat-masuk')
<script>
    $(document).ready( function () {
        $('#disposisi-surat-masuk').DataTable();
    } );
</script>
@endpush