@extends('layouts.main')
@section('title','Surat masuk')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Surat Keluar</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('surat-keluar.index')}}">Surat Keluar</a></div>
            <div class="breadcrumb-item">Tambah Surat Keluar</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Tambah Data Surat Keluar</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('surat-keluar.store')}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                <label for="nomor_surat">Nomor Surat</label>
                                <input type="text" id="nomor_surat" name="nomor_surat"  class="form-control @error('nomor_surat') is-invalid @enderror" placeholder="Masukan nomor surat" value="{{old('nomor_surat')}}" >
                                @error('nomor_surat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_surat">Tanggal Surat</label>
                                <input type="text" id="tanggal_surat" name="tanggal_surat" onfocus="(this.type='date')"  class="form-control @error('tanggal_surat') is-invalid @enderror" placeholder="Masukan tanggal surat" value="{{old('tanggal_surat')}}" >
                                @error('tanggal_surat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="perihal">Perihal Surat</label>
                                <input type="text" id="perihal" name="perihal"  class="form-control @error('perihal') is-invalid @enderror" placeholder="Masukan Perihal Surat" value="{{old('perihal')}}" >
                                @error('perihal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="isi_ringkasan">Isi Ringkasan</label>
                                <textarea class="form-control @error('isi_ringkasan') is-invalid @enderror" id="isi_ringkasan" name="isi_ringkasan" rows="3">{{old('isi_ringkasan')}}</textarea>
                                @error('isi_ringkasan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="hubungan_nomor_surat">Hubungan Nomor Surat</label>
                                <input type="text" id="hubungan_nomor_surat" name="hubungan_nomor_surat"  class="form-control @error('hubungan_nomor_surat') is-invalid @enderror" placeholder="Masukan Hubungan Nomor Surat" value="{{old('hubungan_nomor_surat')}}" >
                                <span class="text-info">*Jika tidak ada boleh dikosongkan</span><br>
                                @error('hubungan_nomor_surat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{old('alamat')}}</textarea>
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{old('keterangan')}}</textarea>
                                @error('keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file_surat">File Surat</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('file_surat') is-invalid @enderror" id="validatedCustomFile" name="file_surat" value="{{old('file_surat')}}">
                                    <label class="custom-file-label" for="validatedCustomFile">Pilih File Surat
                                    </label>
                                    <span class="text-info">*File Berformat PDF.</span><br>
                                    <span class="text-info">*Maksimal file berukuran 5MB</span>
                                    @error('file_surat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <a href="{{ route('surat-masuk.index') }}" class="btn btn-warning">
                                <i class="fas fa-chevron-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('custom-js')
    <script>
        $(document).on('change', '.custom-file-input', function (event) {
        $(this).next('.custom-file-label').html(event.target.files[0].name);
        })
    </script>
@endpush