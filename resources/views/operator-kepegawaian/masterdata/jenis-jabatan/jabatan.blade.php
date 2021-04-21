@extends('layouts.main')
@section('title','Jabatan')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Jabatan</h1>
    </div>
    <a href="{{ route('data-jabatan.create') }}" class="btn btn-success mb-3">Tambah Data Jabatan</a>
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
                <h4>Tabel Data Jabatan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table table-bordered table-hover table-striped" id="datajabatan" width="100%" cellspacing="0">
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
                              <td><a href="{{ route('data-jabatan.edit',$item->id_jabatan) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit fa-sm"></i></a>
                                <form action="{{ route('data-jabatan.delete',$item->id_jabatan) }}" method="post"  class="d-inline">
                                  @csrf
                                  @method('delete')
                                  <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Ingin menghapus data ini?')" type="submit"><i class="fas fa-trash fa-sm"></i></button>
                              </form> </td>
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
@endsection