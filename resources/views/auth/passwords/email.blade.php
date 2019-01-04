@extends('layouts.app')

@section('content')
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1>Vali</h1>
    </div>
    <div class="main-box" style="height: {{ session('status') ? '350px' : '320px' }};">
        <form method="POST" class="forget-form" action="{{ route('password.email') }}">
            <h3 class="login-head">
                <i class="fa fa-lg fa-fw fa-lock"></i>{{ __('Reset Password') }}
            </h3>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @csrf
            <div class="form-group">
                <label class="control-label">{{ __('E-Mail Address') }}</label>
                <input class="form-control" type="email" name="email">
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group btn-container">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-unlock fa-lg fa-fw"></i>{{ __('Send Password Reset Link') }}
                </button>
            </div>
            <div class="form-group mt-3">
                <p class="semibold-text mb-0">
                    <a href="{{ route('login') }}">
                        <i class="fa fa-angle-double-left fa-fw"></i> Regresar al inicio de sesión
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection
