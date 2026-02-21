@extends('layouts.app')

@section('title', 'Discover ' . ($apartmentName ?? 'Apartment'))

@section('nav-links')
    <li><a href="#facilities-section"><i class="bi bi-building"></i> Facilities</a></li>
    <li><a href="#room-section"><i class="bi bi-door-open"></i> Room</a></li>
    <li><a href="#location-section"><i class="bi bi-geo-alt"></i> Location</a></li>
    <li><a href="#booking-section"><i class="bi bi-cash-coin"></i> Sewa Apartemen</a></li>
    <li><a href="#testimoni-section"><i class="bi bi-chat-dots"></i> Testimoni</a></li>
    <li><a href="#footer"><i class="bi bi-geo-alt"></i> Find Us</a></li>
@endsection

@section('content')
    <!-- Header dengan Carousel -->
    <header class="header" id="home">
        @php
            // Extract images from carouselImagesBySection
            $carouselImages = [];
            if (isset($carouselImagesBySection) && is_array($carouselImagesBySection)) {
                foreach ($carouselImagesBySection as $section => $images) {
                    if (is_array($images)) {
                        $carouselImages = array_values(array_filter($images));
                        break;
                    }
                }
            }
        @endphp
        <x-carousel 
            :images="$carouselImages"
            :overlay-text="$apartmentName ?? null"
            overlay-class="header-text-overlay-discover"
        />
    </header>

    <!-- Book Now Button -->
    <div class="book-now-container visible">
        <a href="{{ route('bookNow') }}" class="book-now-btn">
            <div class="book-now-icon"><img src="{{ asset('images/logo/book-now.webp') }}" alt=""></div>
            <span>BOOK NOW</span>
        </a>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Facilities Section -->
        @hasSection('facilities')
            @yield('facilities')
        @else
            <section class="facilities-section" id="facilities-section" data-scroll-animate="fade-up">
                <h2 class="facilities-title">OUR FACILITIES</h2>
                <!-- Facilities content akan di-override di view spesifik jika perlu -->
            </section>
        @endif

        <!-- Room Section -->
        <section class="room-section" id="room-section" data-scroll-animate="fade-up">
            <h2 class="room-title">ROOM {{ $apartmentName ?? 'APARTMENT' }}</h2>

            <div class="room-slider-container">
                @if(isset($roomsFormatted) && count($roomsFormatted) > 0)
                    @foreach ($roomsFormatted as $room)
                    <div class="room-card" data-scroll-animate="fade-up">
                        <div class="room-card-header">
                            <div class="left-text">NEOVALA <span class="room-type">ROOMS</span></div>
                            <img src="{{ asset('images/logo/room-title.webp') }}" alt="Neovala Logo" class="room-logo">
                            <div class="right-text">{{ strtoupper(str_replace(' ', ' ', $apartmentName ?? 'APARTMENT')) }} <span class="room-type">ROOMS</span></div>
                        </div>
                        <div class="room-card-image">
                            <img src="{{ $room['main_photo'] }}" alt="Room {{ $room['room_name'] }}">
                        </div>
                        <button class="more-btn" data-room-id="{{ $room['id'] }}">MORE</button>
                    </div>
                    @endforeach
                @endif
            </div>
        </section>

        <!-- Room Popups -->
        @if(isset($roomsFormatted) && count($roomsFormatted) > 0)
            @foreach ($roomsFormatted as $room)
            <div class="popup-overlay" id="roomPopup{{ $room['id'] }}">
                <div class="popup-container">
                    <button class="popup-close"><i class="fas fa-times"></i></button>

                    <div class="popup-carousel">
                        <div class="popup-carousel-container">
                            @foreach ($room['popup_photos'] as $photo)
                            <div class="popup-carousel-slide">
                                <img src="{{ $photo }}" alt="Room {{ $room['room_name'] }} View">
                            </div>
                            @endforeach
                        </div>
                        <button class="popup-carousel-nav popup-carousel-prev"><i class="fas fa-chevron-left"></i></button>
                        <button class="popup-carousel-nav popup-carousel-next"><i class="fas fa-chevron-right"></i></button>

                        <div class="popup-carousel-dots">
                            @foreach ($room['popup_photos'] as $index => $photo)
                            <span class="popup-carousel-dot {{ $index === 0 ? 'active' : '' }}"></span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif

        <!-- Form Checkin -->
        @hasSection('form-checkin')
            @yield('form-checkin')
        @endif

        <!-- Location Section -->
        @hasSection('location')
            @yield('location')
        @endif

        <!-- Booking Section -->
        @hasSection('booking')
            @yield('booking')
        @endif

        <!-- Testimoni Section -->
        @hasSection('testimoni')
            @yield('testimoni')
        @else
            <section class="testimoni-section" id="testimoni-section" data-scroll-animate="fade-up">
                <h2 class="testimoni-title">WHAT THEY SAY?</h2>
                @if(isset($komentars) && count($komentars) > 0)
                    <div class="comment-container">
                        @foreach ($komentars as $komentar)
                            <x-comment-card :komentar="$komentar" />
                        @endforeach
                    </div>
                @endif
            </section>
        @endif
    </main>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/apartment.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/form-checkin.js') }}"></script>
    <script>
        // Force restore scroll immediately and on page load
        // This ensures scroll works even if popup.js sets overflow hidden
        document.body.style.overflow = 'auto';
        
        // Ensure body scroll is restored on page load if no popups are active
        document.addEventListener('DOMContentLoaded', function() {
            // Force restore scroll
            document.body.style.overflow = 'auto';
            
            // Check if any popup is active
            const activePopups = document.querySelectorAll('.popup-overlay[style*="flex"], .popup-overlay.active');
            const promoPopup = document.getElementById('popup-overlay');
            const promoPopupActive = promoPopup && promoPopup.classList.contains('active');
            
            if (activePopups.length === 0 && !promoPopupActive) {
                document.body.style.overflow = 'auto';
            }
            
            // Force restore after a delay to override popup.js
            setTimeout(function() {
                const activeRoomPopups = document.querySelectorAll('.popup-overlay:not(#popup-overlay)[style*="flex"], .popup-overlay:not(#popup-overlay).active');
                if (activeRoomPopups.length === 0) {
                    document.body.style.overflow = 'auto';
                }
            }, 600);
        });
        
        // Also restore on window load
        window.addEventListener('load', function() {
            const activeRoomPopups = document.querySelectorAll('.popup-overlay:not(#popup-overlay)[style*="flex"], .popup-overlay:not(#popup-overlay).active');
            if (activeRoomPopups.length === 0) {
                document.body.style.overflow = 'auto';
            }
        });

        // Room popup functionality
        document.querySelectorAll('.more-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const roomId = this.getAttribute('data-room-id');
                const popup = document.getElementById('roomPopup' + roomId);
                if (popup) {
                    popup.style.display = 'flex';
                    popup.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        // Function to close popup and restore scroll
        function closeRoomPopup(popup) {
            if (popup) {
                popup.style.display = 'none';
                popup.classList.remove('active');
                
                // Check if any other popup is still active
                const activePopups = document.querySelectorAll('.popup-overlay[style*="flex"], .popup-overlay.active');
                const promoPopup = document.getElementById('popup-overlay');
                const promoPopupActive = promoPopup && promoPopup.classList.contains('active');
                
                // Only restore scroll if no popups are active
                if (activePopups.length === 0 && !promoPopupActive) {
                    document.body.style.overflow = 'auto';
                }
            }
        }

        document.querySelectorAll('.popup-close').forEach(btn => {
            btn.addEventListener('click', function() {
                const popup = this.closest('.popup-overlay');
                closeRoomPopup(popup);
            });
        });

        // Close popup when clicking outside (on overlay)
        document.querySelectorAll('.popup-overlay').forEach(popup => {
            // Skip promo popup (handled by popup.js)
            if (popup.id === 'popup-overlay') return;
            
            popup.addEventListener('click', function(e) {
                if (e.target === popup) {
                    closeRoomPopup(popup);
                }
            });
        });

        // Close popup with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const activeRoomPopups = document.querySelectorAll('.popup-overlay:not(#popup-overlay)[style*="flex"], .popup-overlay:not(#popup-overlay).active');
                if (activeRoomPopups.length > 0) {
                    activeRoomPopups.forEach(popup => {
                        closeRoomPopup(popup);
                    });
                }
            }
        });

        // Popup carousel navigation
        document.querySelectorAll('.popup-carousel').forEach(carousel => {
            const container = carousel.querySelector('.popup-carousel-container');
            const slides = carousel.querySelectorAll('.popup-carousel-slide');
            const prevBtn = carousel.querySelector('.popup-carousel-prev');
            const nextBtn = carousel.querySelector('.popup-carousel-next');
            const dots = carousel.querySelectorAll('.popup-carousel-dot');
            let currentSlide = 0;

            if (prevBtn && nextBtn) {
                prevBtn.addEventListener('click', () => {
                    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                    updateCarousel();
                });

                nextBtn.addEventListener('click', () => {
                    currentSlide = (currentSlide + 1) % slides.length;
                    updateCarousel();
                });
            }

            function updateCarousel() {
                slides.forEach((slide, index) => {
                    slide.style.display = index === currentSlide ? 'block' : 'none';
                });
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentSlide);
                });
            }

            if (slides.length > 0) updateCarousel();
        });
    </script>
@endpush

