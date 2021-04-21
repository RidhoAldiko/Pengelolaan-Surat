@extends('layouts.main')
@section('title','Unit Kerja')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Unit Kerja</h1>
    </div>
    <a href="{{ route('data-UnitKerja.create') }}" class="btn btn-success mb-3">Tambah Data Unit Kerja</a>
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
                              <td><a href="{{ route('data-UnitKerja.edit',$item->id_unit) }}" class="btn btn-warning "><i class="fas fa-edit fa-sm"></i></a>
                                <form action="{{ route('data-UnitKerja.delete',$item->id_unit) }}" method="post"  class="d-inline">
                                  @csrf
                                  @method('delete')
                                  <button class="btn btn-danger" onclick="return confirm('Apakah Anda Ingin menghapus data ini?')" type="submit"><i class="fas fa-trash fa-sm"></i></button>
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