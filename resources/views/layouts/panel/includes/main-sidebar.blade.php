<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-right image">
                <img src="{{route('avatar.show',Auth::user()->avatar)}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="">
                <a href="#">
                    <i class="fa fa-magic"></i>
                    <span>مدیریت</span>
                    <i class="fa fa-angle-left pull-left icon-left-center pull-left-container"></i>
                    @if(!(Auth::user()->hasRole('admin')))
                        <span class="label label-danger"> (محدودیت!)</span>
                    @endif
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-share"></i>
                            <span>کاربران</span>
                            <i class="fa fa-angle-left pull-left icon-left-center pull-left-container"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('users.index') }}">
                                    <i class="fa fa-users"></i> <span> همه کاربران</span>
                                    @if(!(Auth::user()->can('user-list')))
                                        <span class="label label-danger"> (محدودیت!)</span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.create') }}">
                                    <i class="fa fa-users"></i> <span>ایجاد کاربر</span>
                                    @if(!(Auth::user()->can('user-create')))
                                        <span class="label label-danger"> (محدودیت!)</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-share"></i>
                            <span>نقش ها</span>
                            <i class="fa fa-angle-left pull-left icon-left-center pull-left-container"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('roles.index') }}">
                                    <i class="fa fa-users"></i> <span> همه نقش ها</span>
                                    @if(!(Auth::user()->can('role-list')))
                                        <span class="label label-danger"> (محدودیت!)</span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('roles.create') }}">
                                    <i class="fa fa-users"></i> <span>ایجاد نقش</span>
                                    @if(!(Auth::user()->can('role-create')))
                                        <span class="label label-danger"> (محدودیت!)</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li class="">
                <a href="#">
                    <i class="fa fa-magic"></i>
                    <span>خبرگزاری ها</span>
                    <i class="fa fa-angle-left pull-left icon-left-center pull-left-container"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('agent.index') }}">
                            <i class="fa fa-share"></i>
                            <span>همه خبرگزاری ها</span>
                            @if(!(Auth::user()->can('agent-list')))
                                <span class="label label-danger"> (محدودیت!)</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('agent.task') }}">
                            <i class="fa fa-share"></i>
                            <span>بررسی خبرهای جدید</span>
                            @if(!(Auth::user()->can('agent-create')))
                                <span class="label label-danger"> (محدودیت!)</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('agent.news') }}">
                            <i class="fa fa-share"></i>
                            <span>بررسی صفحه خبر</span>
                            @if(!(Auth::user()->can('agent-create')))
                                <span class="label label-danger"> (محدودیت!)</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li class="">
                <a href="#">
                    <i class="fa fa-magic"></i>
                    <span>دسته بندی اخبار</span>
                    <i class="fa fa-angle-left pull-left icon-left-center pull-left-container"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('categories.index') }}">
                            <i class="fa fa-share"></i>
                            <span>همه دسته ها</span>
                            @if(!(Auth::user()->can('category-list')))
                                <span class="label label-danger"> (محدودیت!)</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.crawl') }}">
                            <i class="fa fa-share"></i>
                            <span>ساخت گروهی دسته ها</span>
                            @if(!(Auth::user()->can('category-create')))
                                <span class="label label-danger"> (محدودیت!)</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
