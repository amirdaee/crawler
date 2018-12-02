@extends('layouts.auth.app')

@section('content')
    <div class="container container-table">
        <div class="row vertical-center-row">
            <div class="col-md-4 col-md-offset-4">
                <h2 style="text-align: center;">سامانه مک</h2>
                <div class="login-box">
                {{--<div class="card-header">{{ __('Register') }}</div>--}}
                    <img style="width: 30%;" src="{{asset('img/logo-ap-01.png')}}">
                    <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label text-md-right">نام</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-form-label text-md-right">آدرس ایمیل</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-form-label text-md-right">کلمه عبور</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-form-label text-md-right">تکرار کلمه عبور</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            ثبت نام
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
