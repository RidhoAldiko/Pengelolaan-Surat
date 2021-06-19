@extends('layouts.main')
@section('title','Disposisi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Disposisi</h1>
    </div>
    <a href="{{ route('disposisi-surat-masuk.cetak') }}" target="_blank" class="btn btn-primary mb-3"><i class="fas fa-print"></i> Print Disposisi</a>
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
                                    <td>{{$result->nomor_surat}}</td>
                                    <td>{{date('d-m-Y',strtotime($result->tanggal_surat))}}</td>
                                    <td>{{date('d-m-Y',strtotime($result->tanggal_disposisi))}}</td>
                                    <td>
                                        @if ($result->status == 0)
                                            {{ 'Terdaftar' }} 
                                        @else
                                            {{ 'Berjalan' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($result->status == 0)
                                            <a href="{{route('disposisi-surat-masuk.show',$result->id_disposisi_surat_masuk)}}" class="btn btn-success text-white btn-sm">
                                                <i class="fas fa-info"></i> Detail
                                            </a>
                                            <a href="{{route('disposisi-surat-masuk.forward',$result->id_disposisi_surat_masuk)}}" class="btn btn-primary btn-sm" >
                                                <i class="fas fa-angle-right"></i> Teruskan
                                            </a>
                                            <a href="{{route('disposisi-surat-masuk.edit',$result->id_disposisi_surat_masuk)}}" class="btn btn-warning text-white btn-sm" title="Edit">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm getIdSurat" data-toggle="modal" data-target="#deleteDisposisi" data-id="{{$result->id_surat_masuk}}" >
                                                <i class="fas fa-trash fa-sm"></i> Hapus
                                            </a>
                                        @else
                                            <a href="{{route('disposisi-surat-masuk.show',$result->id_disposisi_surat_masuk)}}" class="btn btn-success text-white btn-sm" title="Edit">
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

<!-- delete Modal-->
<div class="modal fade" id="deleteDisposisi" tabindex="-1" role="dialog" aria-labelledby="deleteDisposisiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h4 class="modal-title h4" id="deleteDisposisiLabel">Ingin menghapus data ?</h4>
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
@push('script-disposisi-surat-masuk')
<script>
    $(document).ready( function () {
        $('#disposisi-surat-masuk').DataTable();
    } );
</script>
@endpush

@push('script-delete-disposisi')
<script>
    //delete data unit kerja
    $('.getIdSurat').on('click',function(){
        var _id = $(this).data("id");
        $('.modal-footer form[action]').attr('action', 'disposisi-surat-masuk'+'/'+_id);
    })
</script>
@endpush