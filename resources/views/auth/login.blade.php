@extends('layouts.auth.app')

@section('content')
    <div class="container container-table">
        <div class="row vertical-center-row">
            <div class="col-md-4 col-md-offset-4">
                <h2 style="text-align: center;">سامانه مک</h2>
                <div class="login-box">
                    <img style="width: 30%;" src="{{asset('img/logo-ap-01.png')}}">
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="email">ایمیل</label>
                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password">کلمه عبور</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> مرا به خاطر بسپار
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                ورود
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                کلمه عبور خود را فراموش کرده اید؟
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
