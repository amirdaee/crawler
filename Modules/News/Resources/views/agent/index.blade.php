@extends('layouts.panel.master')
@include('news::agent.incloudes.agentCreateModal')

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
                            <h2>مدیریت خبرگزاری ها</h2>
                        </div>
                        @permission('agent-create')
                        <div class="pull-left">
                            <a class="btn btn-success" id="create-agent" href="javascript:void(0)">خبرگزاری جدید</a>
                        </div>
                        @endpermission
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>شماره</th>
                            <th>نام خبرگزاری</th>
                            <th>صفحه اصلی</th>
                            <th width="280px"></th>
                        </tr>
                        </thead>
                        @foreach ($agents as $agent)
                        <tbody>
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $agent->name }}</td>
                                <td><a href="{{ $agent->base_url }}" target="_blank">{{ $agent->base_url }}</a></td>
                                <td>
                                    @permission('agent-show')
                                    <a class="btn btn-info" href="{{ route('agent.show',$agent->id) }}">مشاهده</a>
                                    @endpermission
                                    @permission('agent-edit')
                                    <a class="btn btn-primary" href="{{ route('agent.edit',$agent->id) }}">اصلاح</a>
                                    @endpermission
                                    @permission('agent-delete')
                                    <form method="POST" action="{{ route('agent.destroy', $agent->id) }}" style="display: inline">
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
            $('#create-agent-modal').modal();
        });

        $('.edit-employee').on('click',function (event) {
            getEmployee(event);
        });
        function getEmployee(event) {
            event.preventDefault();
            $('.detail').empty();
            $('.edit-modal-title').empty();

            $.get(event.target.getAttribute("data-ajax--url"), function(res){

                $('.edit-modal-title').append(res['party']['first_name'] + ' ' + res['party']['last_name']);
                $('form#employee-edit').attr('action',event.target.getAttribute("data-ajax--url"));
                $('#edit-employee-modal input[name = insurance_number]').attr('value',res['insurance_number']);
                $("#edit-employee-modal input[name='departments[]']:checkbox" ).each(function( index ) {
                    this.removeAttribute('checked');
                    if ($.inArray(parseInt($( this ).val()),res['departments']) !== -1){
                        this.setAttribute('checked','true');
                    }
                });
                $("#edit-employee-modal input[name='task_departments[]']:checkbox" ).each(function( index ) {
                    this.removeAttribute('checked');
                    if ($.inArray(parseInt($( this ).val()),res['task_departments']) !== -1){
                        this.setAttribute('checked','true');
                    }
                });

                $("#edit-employee-modal input[name='work_day[]']:checkbox" ).each(function( index ) {
                    this.removeAttribute('checked');
                    if ($.inArray(parseInt($( this ).val()),res['Attendance_role_workday']) !== -1){
                        this.setAttribute('checked','true');
                    }
                });
                $('#edit-employee-modal input[name = vacation_day]').attr('value',res['Attendance_role_vacation'][1]);

                $('#edit-employee-modal input[name = end_work]').attr('value',res['Attendance_role_end_work'][1]);

                $('#edit-employee-modal input[name = start_work]').attr('value',res['Attendance_role_start_work'][1]);


                console.log(res);
                $('#edit-employee-modal').modal();


            })
                .done(function() {
                    console.log( "second success" );
                })
                .fail(function() {
                    console.log( "error" );
                })
                .always(function() {
                    console.log( "finished" );
                });
            $('#edit-worklist-modal').modal();
        }

        $('.show-employee-detail').on('click',function (event) {
            getEmployeeDetail(event);
        });

        function getEmployeeDetail(event) {
            event.preventDefault();
            $.get(event.target.getAttribute("data-ajax--url"), function(res){
                $('.detail').empty();
                $('.show-modal-title').empty();

                $('.show-modal-title').append(res['party']['first_name'] + ' ' + res['party']['last_name']);
                $.each(res['departments_name'],function (index, value) {
                    $('#show-employee-department').append('<label class="label label-success"> '+ value +' </label>');
                });
                $.each(res['task_departments_name'],function (index, value) {
                    $('#show-employee-task-department').append('<label class="label label-success"> '+ value +' </label>');
                });
                $('#show-employee-insurance_number').append(res['insurance_number']);
                $('#show-employee-nationalID').append(res['party']['nationalID']);
                if (res['party']['gender'] == 2)
                {
                    var gender = 'female';
                    var color = '#F43D8F';
                }
                else
                {
                    var gender = 'male';
                    var color = '#3983FC';
                }
                $('#show-employee-gender').append("<i class='fa fa-" + gender +" fa-2x' style='color:" + color + "'"+" aria-hidden='true'></i>");
                $('#show-employee-mobile').append(res['party']['mobile']);
                $('#show-employee-phone').append(res['party']['phone']);
                $('#show-employee-emergency_phone').append(res['party']['emergency_phone']);
                $('#show-employee-father_name').append(res['party']['father_name']);

                $('#show-employee-age').append(res['party']['age']);


            })
                .done(function() {
                    console.log( "second success" );
                })
                .fail(function() {
                    console.log( "error" );
                })
                .always(function() {
                    console.log( "finished" );
                });
            $('#show-employee-modal').modal();
        }
    </script>
@endsection
