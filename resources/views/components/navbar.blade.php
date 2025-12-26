<!-- Navbar -->
<nav class="navbar">
    <div class="nav-content">
        <div class="burger-menu">
            <div class="burger-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="logo-left">
            <a href="{{ route('home') }}#home">
                <img src="{{ asset('images/logo/NEOVALA TRANSPARENT 1.png') }}"
                    alt="Logo Neovala Light" class="logo-light">
            </a>
            <a href="{{ route('home') }}#home">
                <img src="{{ asset('images/logo/NEOVALA-DARK.png') }}"
                    alt="Logo Neovala Dark" class="logo-dark">
            </a>
        </div>
        <ul class="nav-links">
            @hasSection('nav-links')
                @yield('nav-links')
            @else
                <!-- Default nav links untuk homepage -->
                <li><a href="#apartment-section"><i class="bi bi-building"></i> Apartment</a></li>
                <li><a href="#titip-kunci-section"><i class="bi bi-key"></i> Titip Kunci</a></li>
                <li><a href="#promo-section"><i class="bi bi-gift"></i> Promo</a></li>
                <li><a href="#our-story-section"><i class="bi bi-people"></i> About Us</a></li>
                <li><a href="#comment-section"><i class="bi bi-chat-dots"></i> Testimoni</a></li>
                <li><a href="#footer"><i class="bi bi-geo-alt"></i> Find Us</a></li>
            @endif
            <div class="sidebar-footer">
                <p><img src="{{ asset('images/logo/NEOVALA-DARK.png') }}" alt="Logo Neovala Dark"
                        class="logo-sidebar">NEOVALA</p>
            </div>
        </ul>
        <div class="logo-right">
            <a href="{{ route('home') }}#home">NEOVALA</a>
        </div>
    </div>
</nav>
<div class="nav-overlay"></div>

