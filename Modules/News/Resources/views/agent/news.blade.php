@extends('layouts.panel.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2>بررسی خبر</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('agent.index') }}"> بازگشت</a>
            </div>
        </div>
    </div>
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
                <div class="box-body table-responsive">
                    <form method="GET" action="{{ route('agent.news') }}">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="task_url">لینک صفحه خبر:</label>
                                <textarea name="url" class="form-control" rows="2">{{!empty($agent) ? $agent['url']: ""}}</textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="title_filter">مسیر عنوان خبر:</label>
                                <textarea name="title_filter" class="form-control" rows="2">{{!empty($agent) ? $agent['title_filter']: ""}}</textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="content_filter">مسیر متن خبر:</label>
                                <textarea name="content_filter" class="form-control" rows="2">{{!empty($agent) ? $agent['content_filter']: ""}}</textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="content_filter">مسیر دسته خبر:</label>
                                <textarea name="category_filter" class="form-control" rows="2">{{!empty($agent) ? $agent['category_filter']: ""}}</textarea>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary" name="news">ارسال</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    @if(!empty($title))
                    <div class="col-md-12">
                        عنوان: {{$title}}
                    </div>
                    @endif
                    @if(!empty($category))
                        <div class="col-md-12">
                            دسته: {{$category}}
                        </div>
                    @endif
                    @if(!empty($content))
                    <div class="col-md-12">
                        {{$content}}
                    </div>
                    @endif

                </div>

            </div>
        </div>
    </div>

@endsection
