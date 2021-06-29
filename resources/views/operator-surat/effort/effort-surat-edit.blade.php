@extends('layouts.main')
@section('title','Disposisi Surat masuk - Edit')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Approval Surat Keluar</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('effort-surat.index')}}">Approval Surat Keluar</a></div>
            <div class="breadcrumb-item">Approval Surat Keluar</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Ubah Approval Surat Keluar</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('effort-surat.update',$result->id_surat_keluar)}}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="nomor_surat">Nomor Surat</label>
                                <input type="text" id="nomor_surat" name="nomor_surat"  class="form-control @error('nomor_surat') is-invalid @enderror" placeholder="Masukan nomor surat" value="{{$result->nomor_surat}}" >
                                @error('nomor_surat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_surat">Tanggal Surat</label>
                                <input type="text" id="tanggal_surat" name="tanggal_surat" onfocus="(this.type='date')"  class="form-control @error('tanggal_surat') is-invalid @enderror" placeholder="Masukan tanggal surat" value="{{$result->tanggal_surat}}" >
                                @error('tanggal_surat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="indeks">indeks</label>
                                <input type="text" id="indeks" name="indeks"  class="form-control @error('indeks') is-invalid @enderror" placeholder="Masukan indeks" value="{{$result->indeks}}" >
                                @error('indeks')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_effort">Tanggal Approval</label>
                                <input type="text" id="tanggal_effort" name="tanggal_effort" onfocus="(this.type='date')"  class="form-control @error('tanggal_effort') is-invalid @enderror" placeholder="Masukan tanggal disposisi" value="{{$result->tanggal_effort}}" >
                                @error('tanggal_effort')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="perihal">Perihal Surat</label>
                                <input type="text" id="perihal" name="perihal"  class="form-control @error('perihal') is-invalid @enderror" placeholder="Masukan Perihal Surat" value="{{$result->perihal}}" >
                                @error('perihal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="isi_ringkasan">Isi Ringkasan</label>
                                <textarea class="form-control @error('isi_ringkasan') is-invalid @enderror" id="isi_ringkasan" name="isi_ringkasan" rows="3">{{$result->isi_ringkasan}}</textarea>
                                @error('isi_ringkasan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{$result->alamat}}</textarea>
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{$result->keterangan}}</textarea>
                                @error('keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="hubungan_nomor_surat">Hubungan Nomor Surat</label>
                                <input type="text" id="hubungan_nomor_surat" name="hubungan_nomor_surat"  class="form-control @error('hubungan_nomor_surat') is-invalid @enderror" placeholder="Masukan Hubungan Nomor Surat" value="{{$result->hubungan_nomor_surat}}">
                                <span class="text-info">*Jika tidak ada boleh dikosongkan</span><br>
                                @error('hubungan_nomor_surat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="file_surat">File Surat</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('file_surat') is-invalid @enderror" id="validatedCustomFile" name="file_surat" value="{{$result->file_surat}}">
                                    <label class="custom-file-label" for="validatedCustomFile">Ganti File Surat
                                    </label>
                                    <span class="text-info">*File Berformat PDF.</span><br>
                                    <span class="text-info">*Maksimal file berukuran 512 KB.</span>
                                    @error('file_surat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <a href="{{ route('effort-surat.index') }}" class="btn btn-warning">
                                <i class="fas fa-chevron-left"></i> <span>Kembali</span>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> <span>Simpan</span>
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