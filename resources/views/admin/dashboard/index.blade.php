<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Neovala Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/title-web.webp') }}">    
</head>
<body>
    @include('admin.partials.sidebar')

    <div class="main-wrapper">
        <div class="main-content">
            <!-- Header -->
            <header class="dashboard-header">
                <h1>Welcome to Neovala Admin Panel</h1>
                <p class="subtitle">Manage your apartment listings, testimonials, and promotions</p>
            </header>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $stats['apartments'] ?? 8 }}</h3>
                        <p>Apartments</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $stats['rooms'] ?? 0 }}</h3>
                        <p>Total Rooms</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="fas fa-comment-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $stats['testimonials'] ?? 0 }}</h3>
                        <p>Testimonials</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $stats['promos'] ?? 0 }}</h3>
                        <p>Active Promos</p>
                    </div>
                </div>
            </div>

            <!-- Admin Sections Grid -->
            <div class="sections-header">
                <!-- Quick Access Cards - Old Style -->
            <section class="quick-access">
                <div class="admin-cards">
                    <div class="admin-card" style="background-image: url('../../images/images/Admin-page/IMG_0030 (Copy).webp');">
                        <div class="card-content">
                            <h2>TESTIMONI HOME ADMIN PANEL</h2>
                            <a href="{{ route('admin.dashboard1.komentar') }}" class="card-button">Lihat Komentar</a>
                        </div>
                    </div>
                    
                    <div class="admin-card" style="background-image: url('../../images/images/Admin-page/IMG_0115 (Copy).webp');">
                        <div class="card-content">
                            <h2>PROMO ADMIN PANEL</h2>
                            <a href="{{ route('admin.dashboard1.promo') }}" class="card-button">Lihat Promo</a>
                        </div>
                    </div>
                    
                    <div class="admin-card" style="background-image: url('../../images/images/Admin-page/IMG_0115 (Copy) copy.webp');">
                        <div class="card-content">
                            <h2>JUANDA ROOM ADMIN PANEL</h2>
                            <a href="{{ route('admin.dashboard1.tpj') }}" class="card-button">Click here to go to Admin Panel</a>
                        </div>
                    </div>
                    
                    <div class="admin-card" style="background-image: url('../../images/images/Admin-page/IMG_8672.webp');">
                        <div class="card-content">
                            <h2>CIBUBUR ROOM ADMIN PANEL</h2>
                            <a href="{{ route('admin.dashboard1.tpc') }}" class="card-button">Click here to go to Admin Panel</a>
                        </div>
                    </div>
                    
                    <div class="admin-card" style="background-image: url('../../images/images/Admin-page/IMG_0117 (Copy).webp');">
                        <div class="card-content">
                            <h2>LAGOON ROOM ADMIN PANEL</h2>
                            <a href="{{ route('admin.dashboard1.gkl') }}" class="card-button">Click here to go to Admin Panel</a>
                        </div>
                    </div>
                    
                    <div class="admin-card" style="background-image: url('../../images/images/Admin-page/IMG_1073.webp');">
                        <div class="card-content">
                            <h2>URBANO ROOM ADMIN PANEL</h2>
                            <a href="{{ route('admin.dashboard1.plu') }}" class="card-button">Click here to go to Admin Panel</a>
                        </div>
                    </div>
                    
                    <div class="admin-card" style="background-image: url('../../images/images/Admin-page/IMG_3976.webp');">
                        <div class="card-content">
                            <h2>GATEWAY CICADAS ROOM ADMIN PANEL</h2>
                            <a href="{{ route('admin.dashboard1.gwc') }}" class="card-button">Click here to go to Admin Panel</a>
                        </div>
                    </div>
                    
                    <div class="admin-card" style="background-image: url('../../images/images/Admin-page/IMG_0333.webp');">
                        <div class="card-content">
                            <h2>PODOMORO ROOM ADMIN PANEL</h2>
                            <a href="{{ route('admin.dashboard1.pgv') }}" class="card-button">Click here to go to Admin Panel</a>
                        </div>
                    </div>
                    
                    <div class="admin-card" style="background-image: url('../../images/images/discover-BSC/img_1882.webp');">
                        <div class="card-content">
                            <h2>BASSURA ROOM ADMIN PANEL</h2>
                            <a href="{{ route('admin.dashboard1.bsr') }}" class="card-button">Click here to go to Admin Panel</a>
                        </div>
                    </div>
                    
                    <div class="admin-card" style="background-image: url('../../images/images/discover-GPC/IMG_0646.webp');">
                        <div class="card-content">
                            <h2>GREEN PRAMUKA CITY ROOM ADMIN PANEL</h2>
                            <a href="{{ route('admin.dashboard1.gpc') }}" class="card-button">Click here to go to Admin Panel</a>
                        </div>
                    </div>

                    <div class="admin-card" style="background-image: url('../../images/images/discover-SPL/IMG_9470.webp');">
                        <div class="card-content">
                            <h2>SPRINGLAKE SUMMARECON ROOM ADMIN PANEL</h2>
                            <a href="{{ route('admin.dashboard1.spl') }}" class="card-button">Click here to go to Admin Panel</a>
                        </div>
                    </div>
                    
                    <div class="admin-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="card-content">
                            <h2>EVENT TRACKING</h2>
                            <a href="{{ route('admin.dashboard1.tracking') }}" class="card-button">View Analytics</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script src="{{ asset('js/admin/session-timeout.js') }}"></script>
</body>
</html>
