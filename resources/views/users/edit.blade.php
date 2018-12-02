@extends('layouts.panel.master')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>اخطار!</strong> در ورود دادهای خود دقت کنید.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <h2>اصلاح کاربر</h2>
                        </div>
                        <div class="pull-left">
                            <a class="btn btn-primary" href="{{ route('users.index') }}"> بازگشت</a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        {{csrf_field()}}
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>نام کاربری:</strong>
                                <input name="name" type="text" placeholder="نام" class="form-control" value="{{ $user->name}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>کلمه عبور:</strong>
                                <input name="password" type="text" placeholder="کلمه عبور" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>تکرار کلمه عبور:</strong>
                                <input name="confirm-password" type="text" placeholder="تکرار کلمه عبور" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <strong>آپلود تصویر:</strong>
                            <div class="form-group">
                                <input name="avatar" type="file" accept="image/*">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>نقش ها:</strong>
                                @foreach ($roles->chunk(3) as $chunk)
                                    <div class="row">
                                        @foreach ($chunk as $roleId => $role)
                                            <div class="col-xs-3">
                                                <label>
                                                    <input name="roles[]" value="{{$roleId}}" type="checkbox" class="name" {{ collect($userRole)->contains($roleId)? 'checked' : '' }}>
                                                    {{ $role }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">ذخیره</button>
                            </div>
                    </form>
                </div>
@endsection