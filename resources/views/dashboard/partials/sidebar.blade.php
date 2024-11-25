<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
         <!-- Dark Logo-->
         <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/../assets/images/{{ env('APP_LOGO') }}.webp" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/../assets/images/{{ env('APP_LOGO_NAME') }}.webp" alt="" height="40">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="/../assets/images/{{ env('APP_LOGO') }}.webp" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/../assets/images/{{ env('APP_LOGO_NAME') }}.webp" alt="" height="40">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">


            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Dashboard</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('dashboard') ? 'active fw-bold' : '' }}" href="{{ route('dashboard') }}">
                        <i class="ri-dashboard-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('admin*') || Request::is('tambah-admin') ? 'active fw-bold' : '' }}" href="#sidebarAdmins" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdmins">
                        <i class="ri-user-2-line"></i> <span data-key="t-admins">Admin</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAdmins">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('tambah-admin') }}" class="nav-link" data-key="t-tambah-admin">Tambah Admin</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin') }}" class="nav-link" data-key="t-kelola-admin">Kelola Admin</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('user') ? 'active fw-bold' : '' }}" href="{{ route('user') }}">
                        <i class="ri-team-line"></i> <span data-key="t-users">User</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('koperasi') ? 'active fw-bold' : '' }}" href="{{ route('koperasi') }}">
                        <i class="ri-building-line"></i> <span data-key="t-koperasis">Koperasi</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>