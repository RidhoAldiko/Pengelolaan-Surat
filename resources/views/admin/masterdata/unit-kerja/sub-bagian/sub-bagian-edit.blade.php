@extends('layouts.main')
@section('title','Unit Kerja | Tambah Staf Ahli')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Unit Kerja</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{route('data-unit_kerja.index')}}">Data Unit Kerja</a>
            </div>
            <div class="breadcrumb-item">Edit Data Sub Bagian</div>
        </div>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Edit Data Sub Bagian</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sub-bagian.update',$result->id_sub_bagian) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="id_asisten">Unit Asisten</label>
                                <select class="form-control select-asisten @error('id_asisten') is-invalid @enderror" id="id_asisten" name="id_asisten">
                                    <option selected value=" {{$result->id_asisten}} "> {{$result->nama_asisten}} </option>
                                    <option disabled> --Pilih Unit Kerja Asisten-- </option>
                                    @foreach ($asisten as $item)
                                        @if ($item->nama_asisten != '-')
                                            <option value="{{$item->id_asisten}}">{{$item->nama_asisten}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_asisten')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_bagian">Unit Bagian</label>
                                <select class="form-control select-bagian @error('id_bagian') is-invalid @enderror" id="id_bagian" name="id_bagian">
                                    <option selected value=" {{$result->id_bagian}} "> {{$result->nama_bagian}} </option>
                                    <option disabled> --Pilih Unit Kerja Bagian-- </option>
                                    @foreach ($bagian as $item)
                                        @if ($item->nama_bagian != '-')
                                            <option value="{{$item->id_bagian}}">{{$item->nama_bagian}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_bagian')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_sub_bagian">Nama Sub Bagian</label>
                                <input type="text" id="nama_sub_bagian" name="nama_sub_bagian"  class="form-control @error('nama_sub_bagian') is-invalid @enderror" placeholder="Masukan Nama Bagian" value="{{$result->nama_sub_bagian}}" >
                                @error('nama_sub_bagian')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <a href="{{ route('data-unit_kerja.index') }}" class="btn btn-warning">
                                <i class="fas fa-chevron-left"></i> <span>Kembali<span>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> <span> Simpan</span>
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
        $('.select-asisten').on('change', function(){
            var _id = $(this).val();
            $.ajax({
                url: '{{route('data-unit_kerja.bagian')}}',
                data:{
                    data:_id
                },
                method : 'GET',
                success:function(res){
                    $('.select-bagian').html(res);
                },
            })
        });
    </script>
@endpush