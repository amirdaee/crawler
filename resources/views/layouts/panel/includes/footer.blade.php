<!-- jQuery 3 -->
<script src="{{URL::asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.4 -->
<script src="{{URL::asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('bootstrap/js/jquery.bootstrap.wizard.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{URL::asset('plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{URL::asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>

<script src="{{URL::asset('dist/js/app.js')}}"></script>

<script src="{{URL::asset('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{URL::asset('bower_components/chart.js/Chart.js')}}"></script>

<script src="{{URL::asset('bower_components/echart/dist/echarts.js')}}"></script>

<script src="{{URL::asset('bower_components/chosen/chosen.jquery.js')}}" type="text/javascript"></script>
{{--<script src="{{URL::asset('bower_components/chosen/docsupport/init.js')}}" type="text/javascript" charset="utf-8"></script>--}}

{{--<script src="{{URL::asset('dist/js/pages/dashboard.js')}}"></script>--}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{URL::asset('dist/js/pages/dashboard2.js')}}"></script>--}}
<!-- Bootstrap WYSIHTML5 -->

<script src="{{URL::asset('bower_components/PersianDate/dist/persian-date.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('bower_components/pwt.datepicker/dist/js/persian-datepicker.js')}}" type="text/javascript"></script>

<!-- jquery-dynatable -->
<script src="{{URL::asset('bower_components/jquery-dynatable/jquery.dynatable.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('bower_components/bootstrap-filestyle/src/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>

<!-- jquery-UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    {{-- time picker for vacation set time --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $(document).ready(function (e) {


        $('.end-day').click(function (e) {
            $('#scoreModal').modal('show');
        });

        $('#store_ev').click(function (e) {
            var submit = 0;
            $('.select-score').each(function () {
              //console.log($(element).text());
              if($(this).find(':selected').text() != 'انتخاب'){
                  $(this).css('borderColor' , 'rgb(210, 214, 222)');
                  submit = 1;
              }else{
                  $(this).css('borderColor' , '#ff0010');
                   submit = 0;
              }
            });

            if(submit == 1){
                $(this).parents('form').trigger('submit');
           }
        });
    });
</script>
@yield('script')
