@extends('layouts.main')
@section('title','Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <ol class="breadcrumb justify-content-end h4">
            <li class="breadcrumb-item active text-bold" aria-current="page">Pegawai</li>
        </ol>
    </div>
    <a href="{{ route('print-pegawai.cetakdata') }}" target="_blank" class="btn btn-primary mb-3"><i class="fas fa-print"></i> Print Data Pegawai</a>
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
                <h4>Tabel Data Pegawai</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table table-bordered table-hover table-striped" id="dataPegawai" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                            {{-- js ajax get data pegawai ada di view/layouts/main.blade.php --}}
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
 <!-- delete Modal-->
 <div class="modal fade" id="deletePegawai" tabindex="-1" role="dialog" aria-labelledby="deletePegawaiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h4 class="modal-title h4" id="deletePegawaiLabel">Ingin menghapus data ?</h4>
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

@push('script-delete-pegawai')
<script>
    //detele untuk data pegawai bagian operator kepegawaian
    $(document).on('click', '.getIdPegawai', function() {
        var _id = $(this).data("id");
        $('.modal-footer form[action]').attr('action', 'data-pegawai'+'/'+_id);
    })
</script>
@endpush

@push('script-server-side_pegawai')
<script>
    $(function() {
        $('#dataPegawai').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('pegawai.serverside')}}",
            columns: [
                {
                    data: 'nip',
                    name: 'nip',
                },
                {
                    data: 'nama',
                    name: 'nama',
                },
                {
                    data: 'jabatan',
                    name: 'jabatan',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                },
                ],
            });
    } );
    </script>
@endpush
