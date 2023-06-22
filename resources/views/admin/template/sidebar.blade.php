        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">Dashboard <sup>Admin</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Admin
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/kuota*') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard/kuota">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Kuota</span></a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/user*') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard/user">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span></a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/order*') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard/order">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Order</span></a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/report*') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard/report">
                    <i class="fas fa-fw fa-file-pdf"></i>
                    <span>Laporan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <li class="nav-item {{ Request::is('dashboard/interface/slide*') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard/interface/slide">
                    <i class="fas fa-fw fa-images"></i>
                    <span>Image Slide</span></a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/interface/about*') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard/interface/about">
                    <i class="fas fa-fw fa-info"></i>
                    <span>About Ciremai</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->