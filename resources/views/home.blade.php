@extends('layouts.panel.master')

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-gear"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">تعداد خبرگزاری ها</span>
                    <span class="info-box-number">{{ $agentNumber }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">تغداد اخبار منتشر شده</span>
                    <span class="info-box-number">{{ $taskNumber }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-angellist"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">تعداد خبرهای دیتابیس</span>
                    <span class="info-box-number">{{ $newsNumber }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-adn"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">تعداد دسته ها</span>
                    <span class="info-box-number">{{ $categoryNumber }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    @foreach($news->chunk(3) as $chunk)
        <div class="row">
            @foreach($chunk as $new)
                <div class="col-md-4">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            {{--<i class="fa fa-text-width"></i>--}}

                            <a href="{{ route('news.show',$new->id)}}" target="_blank"><h3 class="box-title">{{ $new->title }}</h3></a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                        خبرگزاری:<a href="{{$new->crawlTask()->first()->task_url}}" target="_blank"> {{ $new->agent->name }}</a>
                            <br>
                            @if(!empty($new->categories()->first()))
                                دسته: <a href="#">{{$new->categories()->first()->name}}</a>
                            @endif
                            <br>
                            <div style="direction: rtl;float: right"> تاریخ انتشار: </div>
                            <div style="direction: ltr;float: right"> {{ \Morilog\Jalali\Jalalian::fromDateTime($new->crawlTask->created_at)}} </div>
                            <br>
                            {{ mb_substr($new->content,0,150) }} .....
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <!-- /.box -->
                </div>
                <!-- ./col -->
            @endforeach
        </div>
    @endforeach
    <div class="row">
        {{$news->render()}}
    </div>
@endsection
