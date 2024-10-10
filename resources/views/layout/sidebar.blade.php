<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('welcome') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/images/logo-vmed-white.png') }}" alt="">
        </div>
        <div class="sidebar-brand-text mx-2">Vmed <sup>Group</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Tables -->
    <li
        class="nav-item {{ request()->routeIs('suggestion.statistical') ||
        request()->routeIs('suggestion.list') ||
        request()->routeIs('suggestion.choose-company-list') ||
        request()->routeIs('suggestion.choose-company-create') ||
        request()->routeIs('suggestion.payment-order') ||
        request()->routeIs('suggestion.requests-for-advances') ||
        request()->routeIs('suggestion.edit-payment-order') ||
        request()->routeIs('suggestion.edit-requests-for-advances') ||
        request()->routeIs('suggestion.suggested-per-diem')
            ? 'active'
            : config('constants.value.empty') }}">
        <a class="nav-link {{ request()->routeIs('suggestion.statistical') ||
        request()->routeIs('suggestion.list') ||
        request()->routeIs('suggestion.choose-company-list') ||
        request()->routeIs('suggestion.choose-company-create') ||
        request()->routeIs('suggestion.payment-order') ||
        request()->routeIs('suggestion.requests-for-advances') ||
         request()->routeIs('suggestion.edit-payment-order') ||
         request()->routeIs('suggestion.edit-requests-for-advances') ||
        request()->routeIs('suggestion.suggested-per-diem')
            ? config('constants.value.empty')
            : 'collapsed' }}"
            data-toggle="collapse" data-target="#paymentOrder" aria-expanded="true" aria-controls="paymentOrder">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Đề nghị</span>
        </a>
        <div id="paymentOrder"
            class="collapse {{ request()->routeIs('suggestion.statistical') ||
            request()->routeIs('suggestion.list') ||
            request()->routeIs('suggestion.choose-company-list') ||
            request()->routeIs('suggestion.choose-company-create') ||
            request()->routeIs('suggestion.payment-order') ||
            request()->routeIs('suggestion.requests-for-advances') ||
             request()->routeIs('suggestion.edit-payment-order') ||
             request()->routeIs('suggestion.edit-requests-for-advances') ||
             request()->routeIs('suggestion.suggested-per-diem')
                ? 'show'
                : config('constants.value.empty') }}"
            aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Hành động:</h6>
                @if (Auth::user()->role->id === config('constants.number.one') || Auth::user()->role->id === config('constants.number.two') || Auth::user()->role->id === config('constants.number.three') || Auth::user()->role->id === config('constants.number.four'))
                    <a class="collapse-item {{ request()->routeIs('suggestion.statistical') ? 'active' : config('constants.value.empty') }}"
                        href="{{ route('suggestion.statistical') }}">Thống kê</a>
                @endif
                <a class="collapse-item {{ request()->routeIs('suggestion.choose-company-list') || request()->routeIs('suggestion.list') || request()->routeIs('suggestion.edit-requests-for-advances') || request()->routeIs('suggestion.edit-payment-order')  ? 'active' : config('constants.value.empty') }}"
                    href="{{ route('suggestion.choose-company-list') }}">Danh sách</a>
                <a class="collapse-item {{ request()->routeIs('suggestion.choose-company-create') || request()->routeIs('suggestion.payment-order') || request()->routeIs('suggestion.requests-for-advances') || request()->routeIs('suggestion.suggested-per-diem') ? 'active' : config('constants.value.empty') }}"
                    href="{{ route('suggestion.choose-company-create') }}">Tạo mới</a>
            </div>
        </div>
    </li>
    @if (Auth::user()->role->id === config('constants.number.one') || Auth::user()->role->id === config('constants.number.two'))
        <li class="nav-item {{ request()->routeIs('warehouse.look-up-inventory') || request()->routeIs('warehouse.data-look-up-inventory') ? 'active' : config('constants.value.empty') }}">
            <a class="nav-link {{ request()->routeIs('warehouse.look-up-inventory') || request()->routeIs('warehouse.data-look-up-inventory') ? config('constants.value.empty') : 'collapsed' }}"
                data-toggle="collapse" data-target="#warehouseManagement" aria-expanded="true" aria-controls="warehouseManagement">
                <i class="fas fa-warehouse"></i>
                <span>Quản lý kho</span>
            </a>
            <div id="warehouseManagement"
                class="collapse {{ request()->routeIs('warehouse.look-up-inventory') || request()->routeIs('warehouse.data-look-up-inventory') ? 'show' : config('constants.value.empty') }}"
                aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Hành động:</h6>
                    <a class="collapse-item {{ request()->routeIs('warehouse.look-up-inventory') || request()->routeIs('warehouse.data-look-up-inventory') ? 'active' : config('constants.value.empty') }}"
                        href="{{ route('warehouse.look-up-inventory') }}">Tra cứu tồn</a>
                </div>
            </div>
        </li>
    @endif
    <li
        class="nav-item {{ request()->routeIs('on-leave.list') ||
        request()->routeIs('additional-work.list') ||
        request()->routeIs('on-leave.calendar') ||
        request()->routeIs('additional-work.calendar')
            ? 'active'
            : config('constants.value.empty') }}">
        <a class="nav-link {{ request()->routeIs('on-leave.list') ||
        request()->routeIs('additional-work.list') ||
        request()->routeIs('on-leave.calendar') ||
        request()->routeIs('additional-work.calendar')
            ? config('constants.value.empty')
            : 'collapsed' }}"
            data-toggle="collapse" data-target="#supplementsAndLeave" aria-expanded="true"
            aria-controls="supplementsAndLeave">
            <i class="fas fa-pencil-alt"></i>
            <span>Nghỉ phép/bổ sung</span>
        </a>
        <div id="supplementsAndLeave"
            class="collapse {{ request()->routeIs('on-leave.list') ||
            request()->routeIs('additional-work.list') ||
            request()->routeIs('on-leave.calendar') ||
            request()->routeIs('additional-work.calendar')
                ? 'show'
                : config('constants.value.empty') }}"
            aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Hành động:</h6>
                @if (Auth::user()->role->id === config('constants.number.one') ||
                    Auth::user()->role->id === config('constants.number.two') ||
                    Auth::user()->role->id === config('constants.number.three') ||
                    Auth::user()->role->id === config('constants.number.four')||
                    Auth::user()->role->id === config('constants.number.five') ||
                    Auth::user()->role->id === config('constants.number.six'))
                    <a class="collapse-item {{ request()->routeIs('on-leave.list') ? 'active' : config('constants.value.empty') }}"
                        href="{{ route('on-leave.list') }}">Danh sách nghỉ phép</a>
                    <a class="collapse-item {{ request()->routeIs('additional-work.list') ? 'active' : config('constants.value.empty') }}"
                        href="{{ route('additional-work.list') }}">Danh sách bổ sung</a>
                @endif
                <a class="collapse-item {{ request()->routeIs('on-leave.calendar') ? 'active' : config('constants.value.empty') }}"
                    href="{{ route('on-leave.calendar') }}">Lịch nghỉ phép tập đoàn</a>
                <a class="collapse-item {{ request()->routeIs('additional-work.calendar') ? 'active' : config('constants.value.empty') }}"
                    href="{{ route('additional-work.calendar') }}">Lịch bổ sung tập đoàn</a>
            </div>
        </div>
    </li>
    @if (Auth::user()->role->id === config('constants.number.one') ||
        Auth::user()->role->id === config('constants.number.two') ||
        Auth::user()->role->id === config('constants.number.nine'))
            
        <li
            class="nav-item {{ request()->routeIs('user.list') || request()->routeIs('user.edit') ? 'active' : config('constants.value.empty') }}">
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
