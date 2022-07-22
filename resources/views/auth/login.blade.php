@extends('layouts.app')

@section('content')
<div class="text-center mb-3">
    <h1 class="mb-2">Log In</h1>
</div>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="input-group mb-4{{ $errors->has('username') ? ' has-error' : '' }}">
        <div class="input-group-text">
            <i class="fe fe-user"></i>
        </div>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-group mb-4 {{ $errors->has('password') ? ' has-error' : '' }}">
        <div class="input-group" id="Password-toggle1">
            <a href="" class="input-group-text">
                <i class="fe fe-eye" aria-hidden="true"></i>
            </a>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group text-center mb-3">
        <button type="submit" class="btn btn-blue btn-lg w-100 br-7" data-loading-text="Sedang Proses...">
            {{ __('Login') }}
        </button>
    </div>
</form>
@endsection
