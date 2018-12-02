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
                            <a class="btn btn-primary" href="{{ route('categories.index') }}"> بازگشت</a>
                        </div>
                    </div>
                </div>
                <div class="box-body" style="padding-bottom: 150px;">
                    <form method="POST" action="{{ route('categories.update' , $category->id) }}">
                        @method('PATCH')
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <strong>نام دسته:</strong>
                                    <input name="name" type="text" placeholder="نام دسته" class="form-control" value="{{ $category->name }}">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="comment">مادر دسته</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="">-----</option>
                                        @foreach($categories as $cat)
                                            <option {{ $category->parent_id == $cat->id ? 'selected' : '' }} value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
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

@section('script')
    <script>
        $( "[name='parent_id']" ).chosen({width:"100%"});
    </script>
@endsection