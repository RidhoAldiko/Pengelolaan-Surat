@extends('layouts.main')
@section('title','Jabatan')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Jabatan</h1>
    </div>
    <a href="{{ route('data-jabatan.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Data Jabatan</a>
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
                <h4>Data Jabatan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Jabatan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>                            
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr class="text-center">
                                <td>{{ $item->nama_jabatan }}</td>
                                <td>{{ $item->status == '0' ? 'Aktif' : 'Nonaktif' }}</td>
                                <td><a href="{{ route('data-jabatan.edit',$item->id_jabatan) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit fa-sm"></i> <span>Ubah</span></a>
                                    {{-- <a href="#" class="btn btn-danger btn-sm getIdJabatan" data-toggle="modal" data-target="#deleteJabatan" data-id="{{$item->id_jabatan}}" >
                                        <i class="fas fa-trash fa-sm"> <span>Hapus</span></i>
                                    </a> </td> --}}
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

<!-- delete Modal-->
<div class="modal fade" id="deleteJabatan" tabindex="-1" role="dialog" aria-labelledby="deleteJabatanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h4 class="modal-title h4" id="deleteJabatanLabel">Ingin menghapus data ?</h4>
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
@push('custom-js')
<script>
    //delete data jabatan
    $('.getIdJabatan').on('click',function(){
        var _id = $(this).data("id");
        $('.modal-footer form[action]').attr('action', 'data-jabatan'+'/'+_id);
    })
</script>
@endpush