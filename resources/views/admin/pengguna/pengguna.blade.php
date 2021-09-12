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
                                    @if ($result->flag == 0)
                                        {{'Aktif'}}
                                    @else
                                        {{'Tidak Aktif'}}
                                    @endif
                                </td>
                                <td>
                                    @if ($result->flag == 0)
                                    <a href="#" class="btn btn-danger text-white btn-sm getIdUser" title="Edit" data-toggle="modal" data-target="#userDisable" data-id="{{$result->id}}">
                                        <i class="fas fa-ban"></i> Nonaktifkan
                                    </a>
                                    @else
                                    <a href="{{route('data-pengguna.enable',$result->id)}}" class="btn btn-success text-white btn-sm" title="Edit">
                                        <i class="far fa-check-circle"></i> Aktifkan
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
<div class="modal fade" id="userDisable" tabindex="-1" role="dialog" aria-labelledby="userDisableLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h4 class="modal-title h4" id="userDisableLabel">Ingin mengnonaktifkan pengguna ?</h4>
            {{-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button> --}}
        </div>
        <div class="modal-body">
            <h5 class="h5 text-center alert-text">Tekan "Nonaktifkan" untuk mengnonaktifkan pengguna.</h5> 
            <div class="modal-footer d-flex justify-content-center">        
                <form action="" method="post"  class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="submit">Nonaktifkan</button>
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
            $('#data-pengguna').DataTable();
        } );

        $('.getIdUser').on('click',function(){
        var _id = $(this).data("id");
        console.log(_id);
        $('.modal-footer form[action]').attr('action', 'data-pengguna'+'/'+_id);
    })
    </script>
@endpush