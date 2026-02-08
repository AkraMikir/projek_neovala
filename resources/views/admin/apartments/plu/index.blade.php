<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $apartmentName }} - Neovala Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=42dot+Sans:wght@300..800&family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/plu.css') }}">
</head>
<body>
    @include('admin.partials.sidebar')

    <div class="main-wrapper">
        <div class="main-content">
            <!-- Header -->
            <div class="header-admin">
                <header>
                    <h1>{{ strtoupper($apartmentName) }} ADMIN PANEL</h1>
                </header>
            </div>

            <!-- Navigation Tabs -->
            <div class="admin-tabs">
                <button class="tab-btn active" onclick="switchTab('carousel')">
                    <i class="fas fa-images"></i> Slide Show
                </button>
                <button class="tab-btn" onclick="switchTab('rooms')">
                    <i class="fas fa-door-open"></i> Rooms
                </button>
                <button class="tab-btn" onclick="switchTab('comments')">
                    <i class="fas fa-comments"></i> Comments
                </button>
                <button class="tab-btn" onclick="switchTab('form-data')">
                    <i class="fas fa-file-alt"></i> Form Data
                </button>
            </div>

            <!-- Messages -->
            @if(session('success'))
            <div class="alert-old success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="alert-old error">{{ session('error') }}</div>
            @endif

            <!-- Content Sections -->
            <div id="carousel-section" class="tab-content active">
                @include('admin.apartments.plu.carousel')
            </div>

            <div id="rooms-section" class="tab-content">
                @include('admin.apartments.plu.rooms')
            </div>

            <div id="comments-section" class="tab-content">
                @include('admin.apartments.plu.comments')
            </div>

            <div id="form-data-section" class="tab-content">
                @include('admin.apartments.plu.form_data')
            </div>
            
            <!-- Hidden Sections (Modals/Overlays) -->
            @include('admin.partials.confirmation_modal')
            @include('admin.apartments.plu.create_room')
            @include('admin.apartments.plu.edit_room')
            @include('admin.apartments.plu.change_carousel')
            @include('admin.apartments.plu.detail_form')
        </div>
    </div>

    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script src="{{ asset('js/admin/plu.js') }}"></script>
</body>
</html>
