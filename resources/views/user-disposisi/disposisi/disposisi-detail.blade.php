@extends('layouts.main')
@section('title','Disposisi')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Disposisi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('data-disposisi.index')}}">Disposisi Surat Masuk</a></div>
            <div class="breadcrumb-item">Detail Disposisi Surat</div>
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
                <h4>Detail Disposisi Surat Masuk</h4>
            </div>
            <div class="card-body">
                <div class="row ">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Pengirim Surat</label>
                                <div class="col-sm-9">
                                    <p class="border-bottom text-gray-800"> {{ $result->pengirim }}</p>
                                </div>
                        </div>
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
                            <label for="staticEmail" class="col-sm-3 col-form-label">Tanggal Disposisi Surat</label>
                                <div class="col-sm-9">
                                    <p class="border-bottom text-gray-800"> {{ $result->tanggal_disposisi }}</p>
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
                            <label for="staticEmail" class="col-sm-3 col-form-label">Instruksi / Informasi</label>
                                <div class="col-sm-9">
                                    <p class="border-bottom text-gray-800">
                                        @php
                                        
                                        $user = DB::table('teruskan_disposisi_masuk')
                                            ->where('id_disposisi_surat_masuk','=',$result->id_disposisi_surat_masuk)
                                            ->orderBy('id_teruskan_surat_masuk','DESC')
                                            ->take(1)
                                            ->first();
                                        echo $user->instruksi;
                                        @endphp
                                    </p>
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
                <a href="{{ route('data-disposisi.index') }}" class="btn btn-warning">
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