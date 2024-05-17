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

    <!-- Nav Item - Tables -->
    @if (Auth::user()->role->id === config('constants.number.one') || Auth::user()->role->id === config('constants.number.two') || Auth::user()->role->id === config('constants.number.three'))
        <li
            class="nav-item {{ request()->routeIs('dashboard.admin') || request()->routeIs('dashboard.manage') ? 'active' : config('constants.value.empty') }}">
            <a class="nav-link"
                href="{{ Auth::user()->role->id === config('constants.number.one') || Auth::user()->role->id === config('constants.number.two') ? route('dashboard.admin') : route('dashboard.manage') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Thống kê</span>
            </a>
        </li>
    @endif
    <li
        class="nav-item {{ request()->routeIs('payment-order.list') || request()->routeIs('payment-order.choose-company') || request()->routeIs('payment-order.create') ? 'active' : config('constants.value.empty') }}">
        <a class="nav-link {{ request()->routeIs('payment-order.list') || request()->routeIs('payment-order.choose-company') || request()->routeIs('payment-order.create') ? config('constants.value.empty') : 'collapsed' }}"
            data-toggle="collapse" data-target="#paymentOrder" aria-expanded="true" aria-controls="paymentOrder">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Đề nghị thanh toán</span>
        </a>
        <div id="paymentOrder"
            class="collapse {{ request()->routeIs('payment-order.list') || request()->routeIs('payment-order.choose-company') || request()->routeIs('payment-order.create') ? 'show' : config('constants.value.empty') }}"
            aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Hành động:</h6>
                <a class="collapse-item {{ request()->routeIs('payment-order.list') ? 'active' : config('constants.value.empty') }}"
                    href="{{ route('payment-order.list') }}">Danh sách</a>
                <a class="collapse-item {{ request()->routeIs('payment-order.choose-company') || request()->routeIs('payment-order.create') ? 'active' : config('constants.value.empty') }}"
                    href="{{ route('payment-order.choose-company') }}">Tạo mới</a>
            </div>
        </div>
    </li>
    @if (Auth::user()->role->id === config('constants.number.one'))
        <li class="nav-item {{ request()->routeIs('user.list') ? 'active' : config('constants.value.empty') }}">
            <a class="nav-link" href="{{ route('user.list') }}">
                <i class="fas fa-users"></i>
                <span>Quản lý người dùng</span>
            </a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
