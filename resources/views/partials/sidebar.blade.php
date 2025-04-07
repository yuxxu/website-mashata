

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-text mx-3">MasHata</div>
    </a>

    <div class="sidebar-heading">Dashboard</div>

    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

     <hr class="sidebar-divider">
    <div class="sidebar-heading">Data Management</div>

    @if(Auth::user()->role === 'admin')
        <li class="nav-item {{ request()->is('/admin/users') ? 'active' : '' }}">
            <a class="nav-link" href="/admin/users">
                <i class="fas fa-fw fa-table"></i>
                <span>Users</span>
            </a>
        </li>
        
        <li class="nav-item {{ request()->is('admin/poli*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('poli.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Poli</span>
            </a>
        </li>
    @endif

    <li class="nav-item {{ request()->is('/admin/antrian') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/antrian">
            <i class="fas fa-fw fa-table"></i>
            <span>Antrian</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
