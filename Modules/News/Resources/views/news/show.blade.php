@extends('layouts.panel.master')

@section('content')
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                {{--<i class="fa fa-text-width"></i>--}}

                <h3 class="box-title">{{ $news->title }}</h3>
                <div class="pull-left">
                    <a class="btn btn-primary" href="{{ route('news.index') }}"> بازگشت</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                خبرگزاری:<a href="{{$news->crawlTask()->first()->task_url}}" target="_blank"> {{ $news->agent->name }}</a>
                <br>
                <div style="direction: rtl;float: right"> تاریخ انتشار: </div>
                <div style="direction: ltr;float: right"> {{ \Morilog\Jalali\Jalalian::fromDateTime($news->crawlTask->first()->created_at)}} </div>
                <br>
                {{ $news->content,0,150 }}
            </div>
            <!-- /.box-body -->
        </div>

        <!-- /.box -->
    </div>
@endsection
