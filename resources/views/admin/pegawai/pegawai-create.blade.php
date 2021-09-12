@extends('layouts.main')
@section('title','Tambah Pegawai')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Pegawai</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin-pegawai.index')}}">Data Pegawai</a></div>
            <div class="breadcrumb-item">Tambah Data pegawai</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Form Tambah Data Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin-pegawai.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nip_pegawai">NIP Pegawai</label>
                                <input type="number" autocomplete="off" id="nip_pegawai" name="nip_pegawai"  class="form-control @error('nip_pegawai') is-invalid @enderror" placeholder="Masukan NIP Pegawai" value="{{old('nip_pegawai')}}" >
                                @error('nip_pegawai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nomor_karpeg">Nomor Kartu Pegawai</label>
                                <input type="text" autocomplete="off" id="nomor_karpeg" name="nomor_karpeg"  class="form-control @error('nomor_karpeg') is-invalid @enderror" placeholder="Masukan Nomor kartu Pegawai" value="{{old('nomor_karpeg')}}" >
                                @error('nomor_karpeg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_pegawai">Nama Pegawai</label>
                                <input type="text" autocomplete="off" id="nama_pegawai" name="nama_pegawai"  class="form-control  @error('nama_pegawai') is-invalid @enderror" placeholder="Masukan Nama Pegawai" value="{{old('nama_pegawai')}}" >
                                @error('nama_pegawai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" autocomplete="off" id="tempat_lahir" name="tempat_lahir"  class="form-control  @error('tempat_lahir') is-invalid @enderror" placeholder="Masukan tempat lahir" value="{{old('tempat_lahir')}}" >
                                @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="text" autocomplete="off" id="tanggal_lahir" name="tanggal_lahir" class="form-control datepicker @error('tanggal_lahir') is-invalid @enderror" placeholder="Masukan Tanggal Lahir" value="{{old('tanggal_lahir')}}" >
                                @error('tanggal_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                    <option selected disabled> --Pilih Jenis Kelamin-- </option>
                                    <option value="Laki-laki"> Laki-laki </option>
                                    <option value="Perempuan"> Perempuan </option>
                                </select>
                                @error('jenis_kelamin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <select class="form-control @error('agama') is-invalid @enderror" id="agama" name="agama">
                                    <option selected disabled> --Pilih Agama-- </option>
                                    <option value="Islam"> Islam </option>
                                    <option value="Katolik"> Katolik </option>
                                    <option value="Protestan">Protestan</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                                @error('agama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status_perkawinan">Status Perkawinan</label>
                                <select class="form-control @error('status_perkawinan') is-invalid @enderror" id="status_perkawinan" name="status_perkawinan">
                                    <option selected disabled> --Pilih Status Perkawinan-- </option>
                                    <option value="Belum kawin">Belum Kawin</option>
                                    <option value="Kawin"> Kawin </option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                                @error('status_perkawinan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <select class="form-control data-jabatan @error('id_jabatan') is-invalid @enderror" id="id_jabatan" name="id_jabatan">
                                    <option selected disabled> --Pilih Jabatan-- </option>
                                    @foreach ($jabatan as $jb)
                                    <option value="{{$jb->id_jabatan}}">{{$jb->nama_jabatan}}</option>
                                    @endforeach
                                </select>
                                @error('id_jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div id="field-staf" class="form-group d-none">
                                <label for="staf_ahli">Staf Ahli</label>
                                <select class="form-control data-staf" id="id_staf_ahli" name="id_staf_ahli">
                                    <option selected disabled> --Pilih Staf Ahli-- </option>
                                </select>
                            </div>

                            <div id="field-asisten" class="form-group d-none">
                                <label for="asisten">Asisten</label>
                                <select class="form-control data-asisten" id="id_asisten" name="id_asisten">
                                    <option selected disabled> --Pilih Asisten-- </option>
                                </select>
                            </div>

                            <div id="field-bagian" class="form-group d-none">
                                <label for="bagian">Bagian</label>
                                <select class="form-control data-bagian" id="id_bagian" name="id_bagian">
                                    <option selected disabled> --Pilih Bagian-- </option>
                                </select>
                            </div>

                            <div id="field-sub-bagian" class="form-group d-none">
                                <label for="sub_bagian">Sub Bagian</label>
                                <select class="form-control data-sub-bagian" id="id_sub_bagian" name="id_sub_bagian">
                                    <option selected disabled> --Pilih Sub Bagian-- </option>
                                </select>
                            </div>
                            
                            <a href="{{ route('admin-pegawai.index') }}" class="btn btn-warning"><i class="fas fa-chevron-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
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

//menampilkan field sesuai dengan jabatan
$('.data-jabatan').on('change',function(){
    //ambil nilai id jabatan
    var _id = $(this).val();
    //sembunyikan field jika id jabatan kecil dari 3
    if (_id < 3) {
        $('#field-staf').hide();
        $('#field-asisten').hide();
        $('#field-asisten').hide();
        $('#field-bagian').hide();
        $('#field-sub-bagian').hide();
    } else 
    //jika id jabatan = 3 tampilkan field staf ahli
    if (_id == 3) {
        var element = document.getElementById("field-staf");
        element.classList.remove("d-none");
        $.ajax({
                url: '{{route('data-unit_kerja.staf-ahli')}}',
                data:{
                    data:_id
                },
                method : 'GET',
                beforeSend:function(){
                    $('.data-staf').html('mohon tunggu');
                },
                success:function(res){
                    // tampilkan field staf
                    $('#field-staf').show();
                    $('.data-staf').html(res);
                    //sembunyikan field asisten
                    $('#field-asisten').hide();
                    //sembunyikan field bagian
                    $('#field-bagian').hide();
                    //sembunyikan field sub bagian
                    $('#field-sub-bagian').hide();
                    
                },
            })
    } else 
    //jika id jabatan besar dari 3
    if(_id > 3){
        //tampilkan filed asisten
        var element = document.getElementById("field-asisten");
        element.classList.remove("d-none");
        //jika id jabatan 5 tampilkan field bagian
        if (_id == 6 || _id == 7) {
            $('#field-bagian').show();
            var element = document.getElementById("field-bagian");
            element.classList.remove("d-none");
            $('#field-sub-bagian').show();
            var element = document.getElementById("field-sub-bagian");
            element.classList.remove("d-none");
        } else 
        if (_id == 5) {
            $('#field-sub-bagian').hide();
            $('#field-bagian').show();
            var element = document.getElementById("field-bagian");
            element.classList.remove("d-none");

        } else 
        if(_id == 4){
            //sembunyikan field staf bagian
            $('#field-bagian').hide();
            //sembunyikan field sub bagian
            $('#field-sub-bagian').hide();
        }
        var _id = 4;
        $.ajax({
                url: '{{route('data-unit_kerja.asisten')}}',
                data:{
                    data:_id
                },
                method : 'GET',
                beforeSend:function(){
                    $('.data-asisten').html('mohon tunggu');
                },
                success:function(res){
                    // tampilkan filed asiseten
                    $('#field-asisten').show();
                    $('.data-asisten').html(res);
                    //sembunyikan field staf ahli
                    $('#field-staf').hide();
                    
                },
            })
    }
})
//tampilkan unit bagian berdasarkan data asisten
$('.data-asisten').on('change',function(){
    var element = document.getElementById("field-bagian");
        element.classList.remove("d-none");
    var _id = $(this).val();
    // console.log(_id);
    $.ajax({
        url: '{{route('data-unit_kerja.bagian')}}',
        data:{
            data:_id
        },
        method : 'GET',
        beforeSend:function(){
            $('.data-bagian').html('mohon tunggu');
        },
        success:function(res){
            // console.log(res);
            // $('#field-asisten').fadeIn();
            $('.data-bagian').html(res);
            // $('#field-staf').fadeOut();
        },
    })
    
})

$('.data-bagian').on('change',function(){
    var _id = $(this).val();
    $.ajax({
        url: '{{route('data-unit_kerja.sub-bagian')}}',
        data:{
            data:_id
        },
        method : 'GET',
        beforeSend:function(){
            $('.data-sub-bagian').html('mohon tunggu');
        },
        success:function(res){
            console.log(res);
            // $('#field-asisten').fadeIn();
            $('.data-sub-bagian').html(res);
            // $('#field-staf').fadeOut();
        },
    })
})
</script>
@endpush