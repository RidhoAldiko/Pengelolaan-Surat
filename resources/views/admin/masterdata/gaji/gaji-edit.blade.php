@extends('layouts.main')
@section('title','Edit Gaji')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Gaji</h1>
    </div>
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h4>Edit Data Gaji</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('data-gaji.update',$item->id_gaji) }}" method="POST">
                           @method('PUT')
                            @csrf
                            <div class="form-group">
                                <select class="form-control @error('id_golongan') is-invalid @enderror" id="id_golongan" name="id_golongan">
                                    <option value="{{ $item->id_golongan }}"> {{$item->golongan->nama_golongan}} </option>
                                    @foreach ($golongan as $gl)
                                    <option value="{{$gl->id_golongan}}">{{$gl->nama_golongan}}</option>
                                    @endforeach
                                </select>
                                @error('id_golongan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" id="mkg" name="mkg"  class="form-control @error('mkg') is-invalid @enderror" placeholder="Masukan MKG" value="{{$item->mkg}}" >
                                @error('mkg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="number" id="jumlah_gaji" name="jumlah_gaji"  class="form-control @error('jumlah_gaji') is-invalid @enderror" placeholder="Masukan Jumlah Gaji" value="{{$item->jumlah_gaji}}" >
                                @error('jumlah_gaji')
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

                            <a href="{{ route('data-gaji.index') }}" class="btn btn-warning">Kembali</a>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection