@extends('layouts.app')

@section('content')
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
      <h1>Vali</h1>
    </div>
    <div class="main-box" style="height: 405px;">
        <form method="POST" class="login-form" action="{{ route('login') }}">
            <h3 class="login-head">
              <i class="fa fa-lg fa-fw fa-user"></i>{{ __('Login') }}
            </h3>
            @csrf
            <div class="form-group">
                <label class="control-label">{{ __('E-Mail Address') }}</label>
                <input class="form-control {{ $errors->any() ? 'is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" autofocus>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label class="control-label">{{ __('Password') }}</label>
                <input class="form-control {{ $errors->any() ? 'is-invalid' : '' }}" type="password" name="password">
            </div>
            <div class="form-group">
                <div class="utility">
                    <div class="animated-checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="label-text">{{ __('Remember Me') }}</span>
                        </label>
                    </div>
                    <p class="semibold-text mb-2">
                        <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    </p>
                </div>
            </div>
            <div class="form-group btn-container">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-sign-in fa-lg fa-fw"></i>{{ __('Login') }}
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
