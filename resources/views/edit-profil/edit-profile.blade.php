@extends('layouts.main')
@section('title','Edit Profile')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Profile</h1>
    </div>
    @if (session('status'))
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="alert shadow alert-success alert-dismissible fade show" role="alert">
          {{ session('status') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      </div>
    </div>
    @endif
    <div class="section-body ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        Edit Profile
                    </div>
                    <div class="card-body">
                        <form action="{{ route('edit_profil.update') }}" method="POST">
                            @method('PATCH')
                            @csrf
                              <div class="form-group row align-items-center">
                                <label for="password_lama" class="form-control-label col-sm-3 text-md-right">Password lama</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="password" autocomplete="off" id="password_lama" name="password_lama"  class="form-control @error('password_lama') is-invalid @enderror" value="{{ old('password_lama') }}">
                                    @error('password_lama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                              </div>

                              <div class="form-group row align-items-center">
                                <label for="password" class="form-control-label col-sm-3 text-md-right">Password baru</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="password" autocomplete="off" id="password" name="password"  class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                              </div>

                              <div class="form-group row align-items-center">
                                <label for="password-confirm" class="form-control-label col-sm-3 text-md-right">Ulangi password baru</label>
                                <div class="col-sm-6 col-md-9">
                                    <input type="password" autocomplete="off" id="password-confirm" name="password_confirmation"  class="form-control @error('password-confirm') is-invalid @enderror">
                                    @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                              </div>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection