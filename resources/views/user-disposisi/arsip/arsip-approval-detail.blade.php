@extends('layouts.main')
@section('title','Disposisi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Histori Approval</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('arsip-approval.index')}}">Histori Approval</a></div>
            <div class="breadcrumb-item">Detail Histori Approval </div>
        </div>
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
        <div class="card shadow">
            <div class="card-header">
                <h4>Detail Histori Approval</h4>
            </div>
            <div class="card-body">
                <div class="row ">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <p class="border-bottom text-gray-800"> {{ $result->nomor_surat }}</p>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Tanggal Surat</label>
                                <div class="col-sm-9">
                                    <p class="border-bottom text-gray-800"> {{date('d-m-Y',strtotime($result->tanggal_surat))}}</p>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Indeks Surat</label>
                                <div class="col-sm-9">
                                    <p class="border-bottom text-gray-800"> {{ $result->indeks }}</p>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Tanggal Approval Surat</label>
                                <div class="col-sm-9">
                                    <p class="border-bottom text-gray-800"> {{date('d-m-Y',strtotime($result->tanggal_effort))}}</p>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Prihal Surat</label>
                                <div class="col-sm-9">
                                    <p class="border-bottom text-gray-800"> {{ $result->perihal }}</p>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Isi Ringkasan Surat</label>
                                <div class="col-sm-9">
                                    <p class="border-bottom text-gray-800"> {{ $result->isi_ringkasan }}</p>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Hubungan Nomor Surat</label>
                                <div class="col-sm-9">
                                    <p class="border-bottom text-gray-800"> 
                                        @if ($result->hubungan_nomor_surat == null )
                                            {{'Tidak ada'}}
                                        @else
                                            {{ $result->hubungan_nomor_surat}}
                                        @endif
                                    </p>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <p class="border-bottom text-gray-800"> {{ $result->alamat }}</p>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <p class="border-bottom text-gray-800"> {{ $result->keterangan }}</p>
                                </div>
                        </div>

                        @if ($result->status == 0)
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Instruksi / Informasi</label>
                                <div class="col-sm-9">
                                    <p class="border-bottom text-gray-800"> 
                                        {{"-"}}
                                    </p>
                                </div>
                        </div>
                        @else
                        <div class="form-group row mb-0">
                            <label for="staticEmail" class="col-sm-5 col-form-label">Instruksi / Informasi</label>
                            <label for="staticEmail" class="col-sm-7 col-form-label">Dilihat dan Disetujui Oleh</label>
                        </div>
                        @php
                        $user = DB::table('teruskan_effort_surat')
                                ->select('teruskan_effort_surat.*','jabatan.id_jabatan','nama_pegawai','jabatan.id_jabatan','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
                                ->join('pegawai', 'pegawai.nip_pegawai', '=', 'teruskan_effort_surat.id')
                                ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
                                ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
                                ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
                                ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
                                ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
                                ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
                                ->where('id_effort_surat','=',$result->id_effort_surat)
                                ->orderBy('id_teruskan_effort_surat','ASC')
                                ->get();
                        foreach ($user as $usr) {
                            $label = "
                            <div class='form-group row my-0'>
                                <label for='staticEmail' class='col-sm-5 col-form-label'>
                            ";
                            $label .= $usr->instruksi;
                            $label .= "</label>";
                            $label .= "<div class='col-sm-7'>
                                        <p class='border-bottom text-gray-800'> 
                                        ";
                            if ($usr->id_jabatan == 1) {
                                $label .= $usr->nama_jabatan;
                            } elseif ( $usr->id_jabatan == 2) {
                                $label .= $usr->nama_jabatan;
                            } elseif ( $usr->id_jabatan == 3) {
                                $label .= $usr->nama_jabatan. ' - ' .$usr->nama_staf_ahli;
                            } elseif ( $usr->id_jabatan == 4) {
                                $label .= $usr->nama_jabatan. ' - ' .$usr->nama_asisten;
                            } elseif ( $usr->id_jabatan == 5) {
                                $label .= $usr->nama_jabatan. ' - ' .$usr->nama_bagian;
                            } elseif ( $usr->id_jabatan == 6) {
                                $label .= $usr->nama_jabatan. ' - ' .$usr->nama_sub_bagian;
                            }
                            $label .= "</p>
                                    </div>
                            </div>";

                            echo $label;
                        }

                        
                        @endphp
                        @endif

                    </div>

                    

                    <div class="col-md-4 ">
                        <div class="row justify-content-center">
                            <div class="card shadow ">
                                <div class="card-body">
                                    <i class="fa fa-file-pdf text-primary fa-6x"></i>
                                    
                                </div>
                                <a href="{{Storage::url($result->file_surat)}}" target="_blank" class="btn btn-primary d-block"><i class="fas fa-cloud-download-alt"></i> File Surat</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <a href="{{ route('arsip-approval.index') }}" class="btn btn-warning">
                    <i class="fas fa-chevron-left"></i> <span>Kembali</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
@push('custom-js')
<script>
    $(document).ready( function () {
        $('#arsip-surat-keluar').DataTable();
    } );
</script>
@endpush