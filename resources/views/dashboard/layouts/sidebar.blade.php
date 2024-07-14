<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand">
        <a class="navbar-brand fs-5 fw-bold" href="/">
            PREDICT JAGUNG APP
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        {{-- Dashboard --}}
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="fa-duotone fa-grid-2 me-3"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('dashboard/prediksi') ? 'active' : '' }}">
            <a href="/dashboard/prediksi" class="menu-link">
                <i class="fa-solid fa-chart-mixed me-3"></i>
                <div data-i18n="Analytics">Prediksi Jagung</div>
            </a>
        </li>


        <li class="menu-item">
            <hr>
        </li>

        @if (auth()->user()->role != 2)
            <li class="menu-item">
                <p class="menu-link">Master Data</p>
            </li>

            <li class="menu-item {{ Request::is('dashboard/produksi*') ? 'active' : '' }}">
                <a href="/dashboard/produksi" class="menu-link">
                    <i class="fa-duotone fa-industry-windows me-3"></i>
                    <div data-i18n="Analytics">Produksi</div>
                </a>
            </li>

            <li class="menu-item {{ Request::is('dashboard/kecamatan*') ? 'active' : '' }}">
                <a href="/dashboard/kecamatan" class="menu-link">
                    <i class="fa-duotone fa-map-location-dot me-3"></i>
                    <div data-i18n="Analytics">Kecamatan</div>
                </a>
            </li>

            <li class="menu-item {{ Request::is('dashboard/user*') ? 'active' : '' }}">
                <a href="/dashboard/user" class="menu-link">
                    <i class="fa-duotone fa-users me-3"></i>
                    <div data-i18n="Analytics">User</div>
                </a>
            </li>
        @endif


    </ul>
</aside>
