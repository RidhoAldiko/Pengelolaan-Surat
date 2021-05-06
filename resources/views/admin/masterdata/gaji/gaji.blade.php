@extends('layouts.main')
@section('title','Gaji')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Gaji</h1>
    </div>
    <a href="{{ route('data-gaji.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Data Gaji</a>
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
                <h4>Tabel Data Gaji</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table table-bordered table-hover table-striped" id="dataUnitKerja" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Golongan</th>
                                <th scope="col">MKG</th>
                                <th scope="col">Jumlah Gaji</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>                            
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr class="text-center">
                            <td>{{ $item->golongan->nama_golongan }}</td>
                            <td>{{ $item->mkg }}</td>
                            <td>{{ $item->jumlah_gaji }}</td>
                            <td>{{ $item->status == '0' ? 'Aktif' : 'Nonaktif' }}</td>
                            <td><a href="{{ route('data-gaji.edit',$item->id_gaji) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit fa-sm"></i></a>
                                
                                <a href="#" class="btn btn-danger btn-sm getIdgaji" data-toggle="modal" data-target="#deletegaji" data-id="{{$item->id_gaji}}" >
                                    <i class="fas fa-trash fa-sm"></i>
                                </a>
                            </td>
                            </tr>
                            @empty
                                <tr class="text-center">
                                <td colspan="5">Data Tidak Ada!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

 <!-- delete Modal-->
<div class="modal fade" id="deletegaji" tabindex="-1" role="dialog" aria-labelledby="deletegajiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h4 class="modal-title h4" id="deletegajiLabel">Ingin menghapus data ?</h4>
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

@push('script-delete-gaji')
<script>
    //delete data gaji
    $('.getIdgaji').on('click',function(){
        var _id = $(this).data("id");
        $('.modal-footer form[action]').attr('action', 'data-gaji'+'/'+_id);
    })
</script>
@endpush