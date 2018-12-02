@extends('layouts.panel.master')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-right">
                        <h2>مدیریت نقش ها</h2>
                    </div>
                    <div class="pull-left">
                        @permission('role-create')
                        <a class="btn btn-success" href="{{ route('roles.create') }}"> ایجاد نقش جدید</a>
                        @endpermission
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>شماره</th>
                            <th>نام</th>
                            <th>نام نمایشی</th>
                            <th>توضیحات</th>
                            <th width="280px"></th>
                        </tr>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">نمایش</a>
                                    @permission('role-edit')
                                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">اصلاح</a>
                                    @endpermission
                                    @permission('role-delete')
                                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display: inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input type="submit" class="btn btn-danger" value="حذف">
                                        {{csrf_field()}}
                                    </form>
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $roles->render() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection