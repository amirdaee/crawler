@extends('layouts.auth.app')

@section('content')
<div class="container container-table">
    <div class="row vertical-center-row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-box">
                <img style="width: 30%;" src="{{asset('img/logo-ap-01.png')}}">
            @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="col-form-label text-md-right">آدرس ایمیل</label>

                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                ارسال لینک بازیابی
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
