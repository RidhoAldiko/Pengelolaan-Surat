@extends('layouts.main')
@section('title','Approval Surat')
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
                <h4>Data Approval Surat</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="disposisi-surat-masuk" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">No Surat</th>
                                <th scope="col">Tanggal Surat</th>
                                <th scope="col">Tanggal Approval </th>
                                <th scope="col">status</th>
                                <th scope="col">Diterima Oleh</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$result->nomor_surat}}</td>
                                    <td>{{date('d/m/Y',strtotime($result->tanggal_surat))}}</td>
                                    <td>{{date('d/m/Y',strtotime($result->tanggal_effort))}}</td>
                                    <td>
                                        @if ($result->status == 0)
                                            {{ 'Terdaftar' }}
                                        @elseif ($result->status == 3)
                                            {{ 'Selesai' }}
                                        @elseif ($result->status == 4)
                                            {{ 'Ditolak' }}
                                        @else
                                            {{ 'Berjalan' }}
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                        
                                        $user = DB::table('teruskan_effort_surat')
                                            ->select('teruskan_effort_surat.*', 'nama_pegawai','jabatan.id_jabatan','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
                                            ->join('pegawai', 'pegawai.nip_pegawai', '=', 'teruskan_effort_surat.id')
                                            ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
                                            ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
                                            ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
                                            ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
                                            ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
                                            ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
                                            ->where('id_effort_surat','=',$result->id_effort_surat)
                                            ->orderBy('id_teruskan_effort_surat','DESC')
                                            ->take(1)
                                            ->get();
                                        if ($user->count() == 1) {
                                            foreach ($user as $usr) {
                                                if ( $usr->id_jabatan == 1) {
                                                    echo  $usr->nama_jabatan;
                                                } elseif ( $usr->id_jabatan == 2) {
                                                    echo  $usr->nama_jabatan;
                                                } elseif ( $usr->id_jabatan == 3) {
                                                    echo $usr->nama_staf_ahli;
                                                } elseif ( $usr->id_jabatan == 4) {
                                                    echo  $usr->nama_jabatan. ' ' .$usr->nama_asisten;
                                                } elseif ( $usr->id_jabatan == 5) {
                                                    echo  $usr->nama_jabatan. ' ' .$usr->nama_bagian;
                                                } elseif ( $usr->id_jabatan == 6) {
                                                    echo  $usr->nama_jabatan. ' ' .$usr->nama_sub_bagian;
                                                } 
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        @endphp
                                    </td>
                                    <td>
                                        @if ($result->status == 0)
                                            <a href="{{route('effort-surat.show',$result->id_effort_surat)}}" class="btn btn-success text-white btn-sm">
                                                <i class="fas fa-info"></i> Detail
                                            </a>
                                            <a href="{{route('effort-surat.forward',$result->id_effort_surat)}}" class="btn btn-primary btn-sm" >
                                                <i class="fas fa-angle-right"></i> Teruskan
                                            </a>
                                            <a href="{{route('effort-surat.edit',$result->id_effort_surat)}}" class="btn btn-warning text-white btn-sm" title="Edit">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm getIdSuratKeluar" data-toggle="modal" data-target="#deleteEffort" data-id="{{$result->id_surat_keluar}}" >
                                                <i class="fas fa-trash fa-sm"></i> Hapus
                                            </a>
                                        @else
                                            <a href="{{route('effort-surat.show',$result->id_effort_surat)}}" class="btn btn-success text-white btn-sm" title="Edit">
                                                <i class="fas fa-info"></i> Detail
                                            </a>
                                            @if ($result->status == 2)
                                            @php
                                        
                                            $user = DB::table('teruskan_effort_surat')
                                                ->where('id_effort_surat','=',$result->id_effort_surat)
                                                ->orderBy('id_teruskan_effort_surat','DESC')
                                                ->take(1)
                                                ->first();
                                            @endphp
                                            <a href="{{route('effort-surat.ingatkan',$user->id)}}" class="btn btn-warning text-white btn-sm" title="Edit">
                                                <i class="fa fa-bell" aria-hidden="true"></i> Ingatkan
                                            </a>
                                            @elseif ($result->status == 4)
                                                <a href="#" class="btn btn-danger btn-sm getIdSuratKeluar" data-toggle="modal" data-target="#deleteEffort" data-id="{{$result->id_surat_keluar}}" >
                                                    <i class="fas fa-trash fa-sm"></i> Hapus
                                                </a>
                                            @elseif ($result->status == 3)
                                                <a href="{{route('effort-surat.arsipkan',$result->id_surat_keluar)}}" class="btn btn-warning text-white btn-sm" title="Edit">
                                                    <i class="fas fa-archive"></i> Arsipkan
                                                </a>
                                                <a target="_blank" href="{{route('effort-surat.cetak',$result->id_effort_surat)}}" class="btn btn-primary btn-sm" >
                                                    <i class="fas fa-print"></i> Print
                                                </a>
                                            @endif
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
<div class="modal fade" id="deleteEffort" tabindex="-1" role="dialog" aria-labelledby="deleteEffortLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
            <h4 class="modal-title h4" id="deleteEffortLabel">Ingin menghapus data ?</h4>
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
        $('#disposisi-surat-masuk').DataTable();
    } );
    //delete data unit kerja
    $('.getIdSuratKeluar').on('click',function(){
        var _id = $(this).data("id");
        $('.modal-footer form[action]').attr('action', 'approval-surat'+'/'+_id);
    })
</script>
@endpush