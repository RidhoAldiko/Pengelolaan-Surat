@extends('layouts.main')
@section('title','Unit Kerja')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Unit Kerja</h1>
    </div>
    <a href="{{ route('data-unit_kerja.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Data Unit Kerja</a>
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
                <h4>Tabel Data Unit Kerja</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table table-bordered table-hover table-striped" id="dataUnitKerja" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Unit Kerja</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>                            
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr class="text-center">
                                <td>{{ $item->nama_unit }}</td>
                                <td>{{ $item->status == '0' ? 'Aktif' : 'Nonaktif' }}</td>
                                <td><a href="{{ route('data-unit_kerja.edit',$item->id_unit) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit fa-sm"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm getIdUnitKerja" data-toggle="modal" data-target="#deleteUnitKerja" data-id="{{$item->id_unit}}" >
                                        <i class="fas fa-trash fa-sm"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="3">Data Tidak Ada!</td>
                                </tr>
                            @endforelse
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- modal delete --}}
<div class="modal fade" id="deleteUnitKerja" tabindex="-1" role="dialog" aria-labelledby="deleteUnitKerjaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h4 class="modal-title h4" id="deleteUnitKerjaLabel">Ingin menghapus data ?</h4>
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
@push('script-delete-unit_kerja')
<script>
    //delete data unit kerja
    $('.getIdUnitKerja').on('click',function(){
        var _id = $(this).data("id");
        $('.modal-footer form[action]').attr('action', 'data-unit_kerja'+'/'+_id);
    })
</script>
@endpush