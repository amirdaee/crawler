@extends('layouts.auth.app')

@section('content')
    <div class="container">
        @foreach($news->chunk(3) as $chunk)
        <div class="row">
           @foreach($chunk as $new)
            <div class="col-md-4">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        {{--<i class="fa fa-text-width"></i>--}}

                        <a href="{{$new->crawlTask()->first()->task_url}}" target="_blank" rel="nofollow"><h3 class="box-title">{{ $new->title }}</h3></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        خبرگزاری: {{ $new->agent->name }}
                        <br>
                        @if(!empty($new->categories()->first()))
                            دسته: <a href="#">{{$new->categories()->first()->name}}</a>
                        @endif
                        <br>
                        <div style="direction: rtl;float: right"> تاریخ انتشار: </div>
                        <div style="direction: ltr;float: right"> {{ \Morilog\Jalali\Jalalian::fromDateTime($new->crawlTask->created_at)}} </div>
                        <br>
                        {{ mb_substr($new->content,0,300) }} .....
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
    </div>
@endsection

