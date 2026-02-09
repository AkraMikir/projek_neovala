<button class="sidebar-toggle" id="sidebarToggle">
    <i class="fas fa-bars"></i>
</button>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('images/logo/NEOVALA-DARK.webp') }}" alt="Neovala" class="sidebar-logo">
        <h2>NEOVALA</h2>
    </div>



    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard1') }}" class="nav-item {{ request()->routeIs('admin.dashboard1') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>

        <div class="nav-group">
            <div class="nav-group-title">
                <i class="fas fa-home"></i>
                <span>Home Management</span>
            </div>
            <a href="{{ route('admin.dashboard1.komentar') }}" class="nav-item {{ request()->routeIs('admin.dashboard1.komentar') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                <span>Testimonials</span>
            </a>
            <a href="{{ route('admin.dashboard1.promo') }}" class="nav-item {{ request()->routeIs('admin.dashboard1.promo') ? 'active' : '' }}">
                <i class="fas fa-percentage"></i>
                <span>Promotions</span>
            </a>
        </div>

        <div class="nav-group">
            <div class="nav-group-title">
                <i class="fas fa-building"></i>
                <span>Apartments</span>
            </div>
            <a href="{{ route('admin.dashboard1.tpj') }}" class="nav-item {{ request()->routeIs('admin.dashboard1.tpj') ? 'active' : '' }}">
                <i class="fas fa-door-open"></i>
                <span>TPJ</span>
            </a>
            <a href="{{ route('admin.dashboard1.tpc') }}" class="nav-item {{ request()->routeIs('admin.dashboard1.tpc') ? 'active' : '' }}">
                <i class="fas fa-door-open"></i>
                <span>TPC</span>
            </a>
            <a href="{{ route('admin.dashboard1.gkl') }}" class="nav-item {{ request()->routeIs('admin.dashboard1.gkl') ? 'active' : '' }}">
                <i class="fas fa-door-open"></i>
                <span>Lagoon</span>
            </a>
            <a href="{{ route('admin.dashboard1.plu') }}" class="nav-item {{ request()->routeIs('admin.dashboard1.plu') ? 'active' : '' }}">
                <i class="fas fa-door-open"></i>
                <span>Urbano</span>
            </a>
            <a href="{{ route('admin.dashboard1.gwc') }}" class="nav-item {{ request()->routeIs('admin.dashboard1.gwc') ? 'active' : '' }}">
                <i class="fas fa-door-open"></i>
                <span>Cicadas</span>
            </a>
            <a href="{{ route('admin.dashboard1.pgv') }}" class="nav-item {{ request()->routeIs('admin.dashboard1.pgv') ? 'active' : '' }}">
                <i class="fas fa-door-open"></i>
                <span>Podomoro</span>
            </a>
            <a href="{{ route('admin.dashboard1.bsr') }}" class="nav-item {{ request()->routeIs('admin.dashboard1.bsr') ? 'active' : '' }}">
                <i class="fas fa-door-open"></i>
                <span>Bassura</span>
            </a>
            <a href="{{ route('admin.dashboard1.gpc') }}" class="nav-item {{ request()->routeIs('admin.dashboard1.gpc') ? 'active' : '' }}">
                <i class="fas fa-door-open"></i>
                <span>Pramuka</span>
            </a>
            <a href="{{ route('admin.dashboard1.spl') }}" class="nav-item {{ request()->routeIs('admin.dashboard1.spl') ? 'active' : '' }}">
                <i class="fas fa-door-open"></i>
                <span>Springlake</span>
            </a>
        </div>

        <div class="nav-group">
            <div class="nav-group-title">
                <i class="fas fa-chart-line"></i>
                <span>Analytics</span>
            </div>
            <a href="{{ route('admin.dashboard1.tracking') }}" class="nav-item {{ request()->routeIs('admin.dashboard1.tracking') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Event Tracking</span>
            </a>
        </div>
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('admin.logout') }}" class="nav-item logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>


