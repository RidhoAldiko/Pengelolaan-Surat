@extends('layouts.main')
@section('title','Edit Unit Kerja')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Unit Kerja</h1>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Edit Data Unit Kerja</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('data-UnitKerja.update',$item->id_unit) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input type="text" id="nama_unit" name="nama_unit"  class="form-control @error('nama_unit') is-invalid @enderror" placeholder="Masukan Nama Unit Kerja" value="{{ $item->nama_unit }}" >
                                @error('nama_unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="{{ $item->status }}"> {{ $item->status == '0' ? 'Aktif' : 'Nonaktif' }} </option>
                                    <option value="0"> Aktif </option>
                                    <option value="1"> Nonaktif </option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <a href="{{ route('data-UnitKerja.index') }}" class="btn btn-warning">Kembali</a>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
