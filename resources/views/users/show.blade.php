@extends('layouts.panel.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-right">
                        <h2> کاربر</h2>
                    </div>
                    <div class="pull-left">
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> بازگشت</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>نام کاربری:</strong>
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>ایمیل:</strong>
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>نقش:</strong>
                            @if(!empty($roles))
                                @foreach($roles as $v)
                                    <label class="label label-success">{{ $v->display_name }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>دسترسی:</strong>
                            @if(!empty($permissions))
                                @foreach($permissions as $p)
                                    <label class="label label-success">{{ $p->display_name }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection