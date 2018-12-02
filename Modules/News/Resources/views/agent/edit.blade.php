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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <h2>اصلاح خبرگزاری</h2>
                        </div>
                        <div class="pull-left">
                            <a class="btn btn-primary" href="{{ route('agent.index') }}"> بازگشت</a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('agent.update' , $agent->id) }}">
                        @method('PATCH')
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <strong>نام خبرگزاری:</strong>
                                <input name="name" type="text" placeholder="نام خبرگزاری" class="form-control" value="{{$agent->name}}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="comment">لینک پایه:</label>
                                <textarea name="base_url" class="form-control" rows="2">{{$agent->base_url}}</textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="task_url">لینک صفحه اخبار جدید:</label>
                                <textarea name="task_url" class="form-control" rows="2">{{$agent->task_url}}</textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="task_filter">مسیر لینک ها</label>
                                <textarea name="task_filter" class="form-control" rows="2">{{$agent->task_filter}}</textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="title_filter">مسیر عنوان خبر:</label>
                                <textarea name="title_filter" class="form-control" rows="2">{{$agent->title_filter}}</textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="content_filter">مسیر متن خبر:</label>
                                <textarea name="content_filter" class="form-control" rows="2">{{$agent->content_filter}}</textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="content_filter">مسیر دسته:</label>
                                <textarea name="category_filter" class="form-control" rows="2">{{$agent->category_filter}}</textarea>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">ذخیره</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
