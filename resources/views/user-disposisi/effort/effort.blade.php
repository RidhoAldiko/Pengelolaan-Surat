@extends('layouts.main')
@section('title','Disposisi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Approval Surat</h1>
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
                <h4>Data Approval</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="disposisi-surat-keluar" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">No Surat</th>
                                <th scope="col">Tgl Surat</th>
                                <th scope="col">Tgl Approval</th>
                                <th scope="col">status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                @if ($result->status_teruskan == '0')
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$result->nomor_surat}}</td>
                                    <td>{{date('d-m-Y',strtotime($result->tanggal_surat))}}</td>
                                    <td>{{date('d-m-Y',strtotime($result->tanggal_effort))}}</td>
                                    <td>
                                        @if ($result->status == 0)
                                            {{ 'Terdaftar' }} 
                                        @elseif ($result->status == 4)
                                            {{ 'Ditolak' }}
                                        @else
                                            {{ 'Berjalan' }}
                                        @endif
                                    </td>
                                    <td>
                                        
                                        <a href="{{route('data-effort.show',$result->id_effort_surat)}}" class="btn btn-success text-white btn-sm">
                                            <i class="fas fa-info"></i> Detail
                                        </a>
                                        @if (Auth::user()->id_level_surat > 2)
                                        <a href="{{route('data-effort.forward',$result->id_effort_surat)}}" class="btn btn-primary btn-sm" >
                                            <i class="fas fa-angle-right"></i> Teruskan
                                        </a>
                                        @endif
                                        @if (Auth::user()->id_level_surat==5 || Auth::user()->id_level_surat==4 || Auth::user()->id_level_surat==2)
                                        <a href="{{route('data-effort.ignore',$result->id_surat_keluar)}}" class="btn btn-danger btn-sm" >
                                            <i class="fa fa-window-close" aria-hidden="true"></i> Tolak
                                        </a>
                                        @endif
                                        <a href="{{route('data-effort.finish',$result->id_surat_keluar)}}" class="btn btn-warning btn-sm" >
                                            <i class="fas fa-check"></i> Selesaikan
                                        </a>

                                    </td>
                                </tr>
                                @endif
                                
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
@push('custom-js')
<script>
    $(document).ready( function () {
        $('#disposisi-surat-keluar').DataTable();
    } );
</script>
@endpush
