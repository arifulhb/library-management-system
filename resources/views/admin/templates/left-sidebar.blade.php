<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ URL::to('/assets/img/user-admin.png') }}" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->getFullName() }}</p>
                <!-- Status -->
                <a href="javascript:void(0)"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search Book...">
        <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
        </div>
    </form>
    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Request::is('admin') ? 'active' : '' }}">
                <a href="{{ url('/admin') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview ">
                <a href="#"><i class="fa fa-book"></i> <span>Books</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/book/add-new') ? 'active' : '' }}">
                        <a href="{{ url('/admin/book/add-new') }}"><i class="fa fa-plus"></i>Add New Book</a>
                    </li>
                    <li class="{{ Request::is('admin/book/list') ? 'active' : '' }}">
                        <a href="{{ URL::to('/admin/book/list') }}"><i class="fa fa-book"></i> Book List</a>
                    </li>

                </ul>
            </li>

            <li class="treeview {{ Request::is('admin/author*') ? 'active' : '' }}">
                <a href="#"><i class="fa fa-language"></i> <span>Authors</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/author/add-new') ? 'active' : '' }}">
                        <a href="{{ url('/admin/author/add-new') }}"><i class="fa fa-plus"></i>Add New Author</a>
                    </li>
                    <li class="{{ Request::is('admin/author/list') ? 'active' : '' }}">
                        <a href="{{ URL::to('/admin/author/list') }}"><i class="fa fa-language"></i> Author List</a>
                    </li>

                </ul>
            </li>

            <li class="treeview {{ Request::is('admin/publisher*') ? 'active' : '' }}">
                <a href="#"><i class="fa fa-building-o"></i> <span>Publisher</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/publisher/add-new') ? 'active' : '' }}">
                        <a href="{{ url('/admin/publisher/add-new') }}"><i class="fa fa-plus"></i>Add New Publisher</a>
                    </li>
                    <li class="{{ Request::is('admin/publisher/list') ? 'active' : '' }}">
                        <a href="{{ URL::to('/admin/publisher/list') }}"><i class="fa fa-building-o"></i> Publisher List</a>
                    </li>

                </ul>
            </li>
            <li class="treeview {{ Request::is('admin/member*') ? 'active' : '' }}">
                <a href="#"><i class="fa fa-users"></i> <span>Members</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/member/add-new') ? 'active' : '' }}">
                        <a href="{{ url('/admin/member/add-new') }}"><i class="fa fa-plus"></i>Add New Member</a>
                    </li>
                    <li class="{{ Request::is('admin/member/list') ? 'active' : '' }}">
                        <a href="{{ URL::to('/admin/member/list') }}"><i class="fa fa-users"></i> Member List</a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ Request::is('admin/report*') ? 'active' : '' }}">
                <a href="#"><i class="fa fa-pie-chart"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/report/loan') ? 'active' : '' }}">
                        <a href="{{ url('/admin/report/loan') }}">Loan</a>
                    </li>
                    <li class="{{ Request::is('admin/report/return') ? 'active' : '' }}">
                        <a href="{{ URL::to('/admin/report/return') }}">Book Return</a>
                    </li>
                    <li class="{{ Request::is('admin/report/balance') ? 'active' : '' }}">
                        <a href="{{ URL::to('/admin/report/balance') }}">Balance Quantity</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
