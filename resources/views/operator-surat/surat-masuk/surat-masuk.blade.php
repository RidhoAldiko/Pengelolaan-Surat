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
                                        <a href="{{route('disposisi-surat-masuk.ignore',$result->id_surat_masuk)}}" class="btn btn-danger btn-sm" >
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <a href="{{route('disposisi-surat-masuk.create',$result->id_surat_masuk)}}" class="btn btn-success btn-sm" >
                                            <i class="fas fa-check"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('surat-masuk.show',$result->id_surat_masuk)}}" class="btn btn-success text-white btn-sm" title="Edit">
                                        <i class="fas fa-info"></i> Detail
                                            </a>
                                        <a href="{{route('surat-masuk.edit',$result->id_surat_masuk)}}" class="btn btn-warning text-white btn-sm" title="Edit">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm getIdSuratMasuk" data-toggle="modal" data-target="#deleteSurat" data-id="{{$result->id_surat_masuk}}" >
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

<!-- delete Modal-->
<div class="modal fade" id="deleteSurat" tabindex="-1" role="dialog" aria-labelledby="deleteSuratLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h4 class="modal-title h4" id="deleteSuratLabel">Ingin menghapus data ?</h4>
            {{-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button> --}}
        </div>
        <div class="modal-body">
            <h5 class="h5 text-center alert-text">Tekan "hapus" untuk menghapus.</h5> 
            <div class="modal-footer d-flex justify-content-center">        
                <form action="" method="post"  class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form> </td>
                
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
@push('script-surat-masuk')
    <script>
        $(document).ready( function () {
            $('#surat-masuk').DataTable();
        } );
    </script>
@endpush
@push('script-delete-button')
<script>
    //delete data unit kerja
    $('.getIdSuratMasuk').on('click',function(){
        var _id = $(this).data("id");
        $('.modal-footer form[action]').attr('action', 'surat-masuk'+'/'+_id);
    })
</script>
@endpush