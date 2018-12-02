<!DOCTYPE html>
<html>
<head>
@include('layouts.panel.includes.head')
</head>
<body class="skin-blue sidebar-mini wysihtml5-supported">
<div class="wrapper">
    @include('layouts.panel.includes.main-header')

    <!-- Left side column. contains the logo and sidebar -->
    @include('layouts.panel.includes.main-sidebar')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    پیشخوان
                    <small>پنل مدیریت</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>صفحه نخست</a></li>
                    {{--<li class="active"></li>--}}
                    <li class="active"></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
        </div>

        <footer class="main-footer">

        </footer>
        <div id="footer">
            Copyright © 2018 <a href="http://skillpro.ir" target="_blank">skillpro.ir</a>. All rights reserved. develop By <a href="http://amirdaee.com" target="_blank">amir daee</a>
            این سایت یک پروژه تحقیقاتی است و تمام فرایندها به صورت اتوماتیک است و عامل انسانی در جمع آوری اخبار دخیل نیست. در صورت استفاده از اخبار حتما منبع خبرگزاری را ذکر نمایید.
        </div>
        <style>
            #footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
                padding: 10px;
                background-color: #ffffff;
            }
        </style>

    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

@include('layouts.panel.includes.footer')
</body>
</html>
