<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Preconnect for external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <!-- Fonts: load async agar tidak blocking render -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=42dot+Sans:wght@300..800&family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=42dot+Sans:wght@300..800&family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"></noscript>

    <!-- Icons: Bootstrap blocking (critical), Font Awesome async (bawah fold) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/title-web.webp') }}">
    
    <!-- Title -->
    <title>@yield('title', 'Neovala')</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional CSS -->
    @stack('styles')
    
    <!-- Inline Styles -->
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <!-- Navbar (hidden on review detail pages) -->
    @if(empty($hideNavbar))
        @include('components.navbar')
    @endif

    <!-- Main Content -->
    @yield('content')
    
    <!-- Footer -->
    @hasSection('skip-footer')
        {{-- Skip footer jika ada section skip-footer --}}
    @else
        @include('components.footer')
    @endif
    
    <!-- Popup -->
    <div id="popup-overlay" class="popup-overlay">
        <div class="popup-wrapper">
            <!-- Popup Content -->
            <div class="popup-container">
                <button id="popup-close" class="popup-close" aria-label="Close popup">
                    <i class="bi bi-x-lg"></i>
                </button>
                <img id="popup-image" src="{{ asset('images/logo/new-popup-dekstop.jpeg') }}" alt="Neovala Promo" class="popup-image popup-image-desktop" loading="lazy">
                <img src="{{ asset('images/logo/new-popup-tablet.jpeg') }}" alt="Neovala Promo" class="popup-image popup-image-tablet" loading="lazy">
                <img src="{{ asset('images/logo/new-popup-mobile.jpeg') }}" alt="Neovala Promo" class="popup-image popup-image-mobile" loading="lazy">
            </div>
            <!-- Order Online Button (di bawah popup, sedikit naik) -->
            <a href="{{ route('orderOnline') }}" target="_blank" rel="noopener noreferrer" class="popup-order-online-btn">
                <i class="bi bi-calendar2-check"></i>
                <span>Order Online</span>
                <i class="bi bi-arrow-right-circle-fill popup-order-arrow"></i>
            </a>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/review-likes.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ asset('js/tracking.js') }}" defer></script>
    <script src="{{ asset('js/popup.js') }}" defer></script>
    
    <!-- Additional JavaScript -->
    @stack('scripts')
</body>

</html>

