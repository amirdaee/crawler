@extends('layouts.panel.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2>اضافه کردن دسته بندی</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> بازگشت</a>
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
    @if (!empty($names) > 0)
        <div class="alert alert-success">
            دسته های زیر با موفقیت ثبت شد<br>
            <ul>
                @foreach ($names as $na)
                    <li>{{ $na }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <form method="post" action="{{ route('categories.crawl') }}">
                        {{ csrf_field() }}
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="parent_id">مادر دسته</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">-----</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="task_url">لینک صفحه دسته:</label>
                                <textarea name="task_url" class="form-control" rows="2">{{!empty($agent) ? $agent['task_url']: ""}}</textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="task_filter">مسیر دسته ها</label>
                                <textarea name="task_filter" class="form-control" rows="2">{{!empty($agent) ? $agent['task_filter']: ""}}</textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="task_filter">کلمه اضافه شده به ابتدا:</label>
                                <textarea name="befor_text" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary" name="crawl">ذخیره</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(!empty($urls))
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    @foreach($urls as $key => $url)
                        <div class="col-md-12" style="direction: ltr">
                            <a href="{{ $url }}" target="_blank">{{$texts[$key]}}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('script')
    <script>
        $( "[name='parent_id']" ).chosen({width:"100%"});
    </script>
@endsection
