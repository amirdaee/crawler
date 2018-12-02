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
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-right">
                        <h2>ویرایش نقش</h2>
                    </div>
                    <div class="pull-left">
                        <a class="btn btn-primary" href="{{ route('roles.index') }}"> بازگشت</a>
                    </div>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>نام:</strong>
                <input name="display_name" type="text" placeholder="نام نمایشی" class="form-control" value="{{ $role->display_name}}">
            </div>
        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>توضحیات:</strong>
                <textarea name="description" placeholder="توضیحات" class="form-control" style="height:100px">{{ $role->description}}</textarea>
            </div>
        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>دسترسی ها:</strong>
                <br/>
                @foreach($permission->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $value)
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" name="permission[]" value="{{ $value->id }}" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }} class="name">
                            {{ $value->display_name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">به روز رسانی</button>
        </div>

                        {{csrf_field()}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
