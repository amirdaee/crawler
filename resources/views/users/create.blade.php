@extends('layouts.panel.master')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>خطا!</strong> در ورود داده ها دقت کنید.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @if($user_id = Session::get('user_id'))
                <a href="{{ route('users.show' ,$user_id)}}">مشاهده کاربر</a>
            @endif
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">ایجاد کاربر جدید</h3>
                    <div class="pull-left">
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> بازگشت</a>
                    </div>
                </div>
                <!-- /.box-header -->

                <form class="form-horizontal" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                    <div class="box-body">
                        {{ csrf_field() }}
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>نام</strong>
                                <input name="name" type="text" placeholder="نام" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>ایمیل</strong>
                                <input name="email" type="text" placeholder="نام" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>کلمه عبور:</strong>
                                <input name="password" type="password" placeholder="پسورد" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>تکرار پسورد:</strong>
                                <input name="confirm-password" type="password" placeholder="تکرار پسورد" class="form-control">
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
                                <strong>نقش:</strong>
                                @foreach ($roles->chunk(3) as $chunk)
                                    <div class="row">
                                        @foreach ($chunk as $id => $role)
                                            <div class="col-xs-4">
                                                <label>
                                                    <input name="roles[]" value="{{$id}}" type="checkbox" class="name">
                                                    {{ $role }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="submit" class="btn btn-primary">ذخیره</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
