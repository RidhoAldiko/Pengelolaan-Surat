@extends('layouts.main')
@section('title','Disposisi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Approval Surat Keluar</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('effort-surat.index')}}">Approval Surat Keluar</a></div>
            <div class="breadcrumb-item">Detail Approval Surat keluar</div>
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
                <h4>Detail Approval Surat Keluar</h4>
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
                                    <p class="border-bottom text-gray-800"> {{ $result->tanggal_surat }}</p>
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
                                    <p class="border-bottom text-gray-800"> {{ $result->tanggal_effort }}</p>
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
                <a href="{{ route('effort-surat.index') }}" class="btn btn-warning">
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
        $('#disposisi-surat-masuk').DataTable();
    } );
</script>
@endpush