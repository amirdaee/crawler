@extends('layouts.panel.master')
@include('news::categories.incloudes.categoryCreateModal')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
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
                            <h2>مدیریت دسته بندی ها</h2>
                        </div>
                        @permission('category-create')
                        <div class="pull-left">
                            <a class="btn btn-success" id="create-agent" href="javascript:void(0)">دسته جدید</a>
                        </div>
                        @endpermission
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>شماره</th>
                            <th>نام دسته</th>
                            <th width="280px"></th>
                        </tr>
                        </thead>
                        @foreach ($categories as $category)
                        <tbody>
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ str_repeat(" - ",$category->depth) }}{{ $category->name }}</td>
                                <td>
                                    @permission('agent-show')
                                    <a class="btn btn-info" href="{{ route('categories.show',$category->id) }}">مشاهده</a>
                                    @endpermission
                                    @permission('agent-edit')
                                    <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">اصلاح</a>
                                    @endpermission
                                    @permission('agent-delete')
                                    <form method="POST" action="{{ route('categories.destroy', $category->id) }}" style="display: inline">
                                        @method("DELETE")
                                        <input type="submit" class="btn btn-danger" value="حذف">
                                        {{csrf_field()}}
                                    </form>
                                    @endpermission
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection

@section('script')
    <script>
        $('.table').dynatable();

        var appUrl = '{{ URL::to('/') }}';

        $('#create-agent').on('click',function (event) {
            $('#create-category-modal').modal();
        })

        $( "[name='parent_id']" ).chosen({width:"100%"});
    </script>
@endsection
