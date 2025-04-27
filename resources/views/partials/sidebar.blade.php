<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        @if (Auth::user())

        <img width="40px" class="app-sidebar__user-avatar" src="{{ asset('images/user/'. Auth::user()->image) }}" alt="User Image">
        @endif

        <div>
            <p class="app-sidebar__user-name">
                @if (Auth::user())
                {{ Auth::user()->first_name }}
                @endif
            </p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item {{ request()->is('/') ? 'active' : ''}}" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>


        {{-- <li class="treeview"><a class="app-menu__item {{ request()->is('tax*') ? 'active' : ''}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-percent"></i><span class="app-menu__label">Tax</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('tax.create')}}"><i class="icon fa fa-circle-o"></i> Add Tax</a></li>
                <li><a class="treeview-item" href="{{route('tax.index')}}"><i class="icon fa fa-circle-o"></i> Manage Tax</a></li>
             </ul>
        </li> --}}

        <li class="treeview "><a class="app-menu__item {{ request()->is('category*') ? 'active' : ''}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th"></i><span class="app-menu__label">Category</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item " href="{{route('category.create')}}"><i class="icon fa fa-plus"></i>Create Category</a></li>
                <li><a class="treeview-item" href="{{route('category.index')}}"><i class="icon fa fa-edit"></i>Manage Category</a></li>
            </ul>
        </li>

        <li class="treeview "><a class="app-menu__item {{ request()->is('transaction*') ? 'active' : ''}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th"></i><span class="app-menu__label">Transaction</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item " href="{{route('transaction.create')}}"><i class="icon fa fa-plus"></i>Create Transaction</a></li>
                <li><a class="treeview-item" href="{{route('transaction.index')}}"><i class="icon fa fa-edit"></i>Manage Transaction</a></li>
            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item {{ request()->is('product*') ? 'active' : ''}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cube"></i><span class="app-menu__label">Product</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('product.create')}}"><i class="icon fa fa-circle-o"></i> New Product</a></li>
                <li><a class="treeview-item" href="{{route('product.index')}}"><i class="icon fa fa-circle-o"></i> Manage Products</a></li>
            </ul>
        </li>


        <li class="treeview"><a class="app-menu__item {{ request()->is('report*') ? 'active' : ''}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bars"></i><span class="app-menu__label">Report</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('report.daily')}}"><i class="icon fa fa-circle-o"></i> Daily Report</a></li>
                <li><a class="treeview-item" href="{{route('report.weekly')}}"><i class="icon fa fa-circle-o"></i> Weekly Report</a></li>
                <li><a class="treeview-item" href="{{route('report.monthly')}}"><i class="icon fa fa-circle-o"></i> Monthly Report</a></li>
                <li><a class="treeview-item" href="{{route('report.academicYear')}}"><i class="icon fa fa-circle-o"></i> Academic Year Report</a></li>
            </ul>
        </li>

        <li class="treeview "><a class="app-menu__item {{ request()->is('invoice*') ? 'active' : ''}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file"></i><span class="app-menu__label">Sales</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item " href="{{route('sales.create')}}"><i class="icon fa fa-plus"></i>Create Sales </a></li>
                <li><a class="treeview-item" href="{{route('sales.index')}}"><i class="icon fa fa-edit"></i>Manage Sales</a></li>
            </ul>
        </li>

        <li><a class="app-menu__item {{ request()->is('sales') ? 'active' : ''}}" href="/sales"><i class="app-menu__icon fa fa-dollar"></i><span class="app-menu__label">View Sales</span></a></li>

        <li class="treeview"><a class="app-menu__item {{ request()->is('supplier*') ? 'active' : ''}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-truck"></i><span class="app-menu__label">Supplier</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('supplier.create')}}"><i class="icon fa fa-circle-o"></i> Add Supplier</a></li>
                <li><a class="treeview-item" href="{{route('supplier.index')}}"><i class="icon fa fa-circle-o"></i> Manage Suppliers</a></li>
            </ul>
        </li>



        <li class="treeview"><a class="app-menu__item {{ request()->is('customer*') ? 'active' : ''}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Student</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('customer.create')}}"><i class="icon fa fa-circle-o"></i> Add Student</a></li>
                <li><a class="treeview-item" href="{{route('customer.index')}}"><i class="icon fa fa-circle-o"></i> Manage Student</a></li>
            </ul>
        </li>



    </ul>
</aside>
