<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/images/logo-vmed-white.png') }}" alt="">
        </div>
        <div class="sidebar-brand-text mx-2">Vmed <sup>Group</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    {{-- <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#paymentOrder"
            aria-expanded="true" aria-controls="paymentOrder">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="paymentOrder" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> --}}

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : config('constants.value.empty') }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Thống kê</span>
        </a>
    </li>
    <li
        class="nav-item {{ request()->routeIs('admin.payment-order.list') || request()->routeIs('admin.payment-order.create') ? 'active' : config('constants.value.empty') }}">
        <a class="nav-link {{ request()->routeIs('admin.payment-order.list') || request()->routeIs('admin.payment-order.create') ? config('constants.value.empty') : 'collapsed' }}"
            data-toggle="collapse" data-target="#paymentOrder" aria-expanded="true" aria-controls="paymentOrder">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Đề nghị thanh toán</span>
        </a>
        <div id="paymentOrder"
            class="collapse {{ request()->routeIs('admin.payment-order.list') || request()->routeIs('admin.payment-order.create') ? 'show' : config('constants.value.empty') }}"
            aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Hành động:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.payment-order.list') ? 'active' : config('constants.value.empty') }}"
                    href="{{ route('admin.payment-order.list') }}">Danh sách</a>
                <a class="collapse-item {{ request()->routeIs('admin.payment-order.create') ? 'active' : config('constants.value.empty') }}"
                    data-toggle="collapse" data-target="#paymentOrderCreate" aria-expanded="true"
                    aria-controls="paymentOrderCreate">Tạo mới</a>
                <div id="paymentOrderCreate"
                    class="bg-white rounded collapse {{ request()->routeIs('admin.payment-order.create') ? 'show' : config('constants.value.empty') }}">
                    <a class="collapse-item {{ request()->get('company') === 'A11' ? 'active' : config('constants.value.empty') }}"
                        href="{{ route('admin.payment-order.create', ['company' => 'A11']) }}">A11 TMVM</a>
                    <a class="collapse-item {{ request()->get('company') === 'A12' ? 'active' : config('constants.value.empty') }}"
                        href="{{ route('admin.payment-order.create', ['company' => 'A12']) }}">A12 PPVM</a>
                    <a class="collapse-item {{ request()->get('company') === 'A14' ? 'active' : config('constants.value.empty') }}"
                        href="{{ route('admin.payment-order.create', ['company' => 'A14']) }}">A14 VMPP</a>
                </div>
                <a class="collapse-item" href="utilities-animation.html">chỉnh sửa</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
