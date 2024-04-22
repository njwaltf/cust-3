<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo mt-4">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/elements/logo.png') }}" alt="" height="50px">
            </span>

            <span class="app-brand-text demo menu-text ms-2">SMKN40 Library</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 mt-3">
        <!-- Dashboard -->
        <li class="menu-item @if (request()->segment(2) < 1) active @endif">
            <a href="/dashboard" class="menu-link">
                <div data-i18n="Analytics" class="ds custom-menu">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text sub-title">Menu Collection</span>
        </li>

        {{-- menu admin --}}
        @if (auth()->user()->role === 'admin')
            <li class="menu-item @if (request()->segment(2) != 0) open active @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <div data-i18n="Account Settings" class="cstxt">Admin Menu</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item @if (request()->segment(2) === 'books') active @endif">
                        <a href="/dashboard/books" class="menu-link">
                            <div data-i18n="Account" class="cstxts">Books</div>
                        </a>
                    </li>

                    <li class="menu-item @if (request()->segment(2) === 'bookings') active @endif">
                        <a href="/dashboard/bookings" class="menu-link">
                            <div data-i18n="Notifications" class="cstxts">Bookings</div>
                        </a>
                    </li>

                    <li class="menu-item @if (request()->segment(2) === 'users') active @endif">
                        <a href="/dashboard/users" class="menu-link">
                            <div data-i18n="Notifications" class="cstxts">Users</div>
                        </a>
                    </li>

                    <li class="menu-item @if (request()->segment(2) === 'types') active @endif">
                        <a href="/dashboard/types" class="menu-link">
                            <div data-i18n="Notifications" class="cstxts">Book Category</div>
                        </a>
                    </li>
                    {{-- @endif --}}
                </ul>
            </li>
        @endif

        {{-- menu admin --}}
        @if (auth()->user()->role === 'librarian')
            <li class="menu-item @if (request()->segment(2) != 0) open active @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings" class="cstxt">Librarian Menu</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item @if (request()->segment(2) === 'bookings') active @endif">
                        <a href="/dashboard/bookings" class="menu-link">
                            <div data-i18n="Notifications" class="cstxts">Bookings</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if (auth()->user()->role === 'member')
            <li class="menu-item @if (request()->segment(2) != 0) open active @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings" class="cstxt">Member Menu</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item @if (request()->segment(2) === 'books') active @endif">
                        <a href="/dashboard/books" class="menu-link">
                            <div data-i18n="Account" class="cstxts">Books</div>
                        </a>
                    </li>

                    <li class="menu-item @if (request()->segment(2) === 'bookings') active @endif">
                        <a href="/dashboard/bookings" class="menu-link">
                            <div data-i18n="Notifications" class="cstxts">Bookings</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
</aside>
<!-- / Menu -->
