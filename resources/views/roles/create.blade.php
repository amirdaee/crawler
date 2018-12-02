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
        </div>
    @endif
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">ایجاد نقش جدید</h3>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> بازگشت</a>
            </div>
        </div>

        <form method="POST" class="form-horizontal" action="{{ route('roles.store') }}">
            <div class="box-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>نام:</strong>
                        <input name="name" type="text" placeholder="نام" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>نام نمایشی:</strong>
                        <input name="display_name" type="text" placeholder="نام نمایشی" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>توضیحات:</strong>
                        <textarea name="description" placeholder="توضیحات" class="form-control" style="height:100px"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <strong>دسترسی ها:</strong>
                    <br/>
                    @foreach ($permission->chunk(4) as $chunk)
                        <div class="row">
                            @foreach ($chunk as $permisionId => $perm)
                                <div class="col-xs-3">
                                    <label>
                                        <input name="permission[]" value="{{$perm->id}}" type="checkbox" class="name">
                                        {{ $perm->display_name }}
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
        {{csrf_field()}}
    </form>
    </div>
@endsection
