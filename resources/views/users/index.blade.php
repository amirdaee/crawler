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
                        <h2>مدیریت کاربران سیستم</h2>
                    </div>
                    <div class="pull-left">
                        <a class="btn btn-success" href="{{ route('users.create') }}"> ثبت کاربر جدید</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>شماره</th>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>نقش ها</th>
                            <th width="280px"></th>
                        </tr>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(!empty($user->roles))
                                        @foreach($user->roles as $v)
                                            <label class="label label-success">{{ $v->display_name }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">مشاهده</a>
                                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">اصلاح</a>
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input type="submit" class="btn btn-danger" value="حذف">
                                        {{csrf_field()}}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $data->render() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
