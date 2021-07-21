@extends('layouts.auth')
@section('title','Masuk')
@section('content')
<div class="card card-primary mt-5">
    <div class="card-header"><h4>Masuk</h4></div>
        <div class="card-body">
            {{-- form --}}
            <form method="POST" action="{{route('login')}}" class="needs-validation">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name='email' type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" tabindex="1" required autofocus >
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                        <div class="float-right">
                            @if (Route::has('password.request'))
                                <a class="text-small" href="{{ route('password.request') }}">
                                    {{ __('Lupa Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2" required autocomplete="current-password>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox my-2">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Ingat Saya</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Masuk
                    </button>
                </div>
            </form>
            {{-- endform --}}
        </div>
    </div>
    {{-- footer --}}
    <div class="simple-footer">
        Copyright &copy; UMSETKPR 2021
    </div>
    {{-- endfooter --}}
</div>
@endsection