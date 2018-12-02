@extends('layouts.panel.master')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong>نام خبرگزاری:</strong>
                        <span>{{$agent->name}}</span>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="comment">لینک پایه:</label>
                        <span>{{$agent->base_url}}</span>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong>لینک صفحه اخبار جدید:</strong>
                        <span>{{$agent->task_url}}</span>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong>مسیر لینک ها:</strong>
                        <span>{{$agent->task_filter}}</span>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong>مسیر عنوان خبر:</strong>
                        <span>{{$agent->title_filter}}</span>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong>مسیر متن خبر:</strong>
                        <span>{{$agent->content_filter}}</span>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong>مسیر دسته:</strong>
                        <span>{{$agent->category_filter}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
