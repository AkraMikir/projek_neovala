@extends('layouts.app')

@section('title', 'Discover Grand Kamala Lagoon')

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
            // Extract images from carouselImagesBySection untuk GKL
            $carouselImages = [];
            if (isset($carouselImagesBySection['GKL']) && is_array($carouselImagesBySection['GKL'])) {
                // Filter null values dan keep original keys, then get values
                $carouselImages = array_values(array_filter($carouselImagesBySection['GKL'], function($value) {
                    return !empty($value) && $value !== null;
                }));
            }
        @endphp
        <x-carousel 
            :images="$carouselImages"
            overlay-text="GRAND KAMALA LAGOON"
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
        <section class="facilities-section" id="facilities-section" data-scroll-animate="fade-up">
            <h2 class="facilities-title">OUR FACILITIES</h2>

            <div class="service-container-apart">
                <div class="service-item-apart">
                    <i class="fa-solid fa-dumbbell"></i>
                </div>
                <div class="service-item-apart">
                    <i class="fa-solid fa-person-running"></i>
                </div>
                <div class="service-item-apart">
                    <i class="fa-solid fa-tree"></i>
                </div>
                <div class="service-item-apart">
                    <i class="fa-solid fa-bridge"></i>
                </div>
                <div class="service-item-apart">
                    <i class="fa-solid fa-water-ladder"></i>
                </div>
                <div class="service-item-apart">
                    <i class="fa-solid fa-building"></i>
                </div>
            </div>

            <div class="facilities-grid">
                <div class="facility-item" data-scroll-animate="fade-up">
                    <img src="{{ asset('images/images/discover-GKL/Gym Area (1).webp') }}" alt="Gym Area">
                </div>
                <div class="facility-item" data-scroll-animate="fade-up">
                    <img src="{{ asset('images/images/discover-GKL/Infinity Pool.webp') }}" alt="Infinity Pool">
                </div>
                <div class="facility-item" data-scroll-animate="fade-up">
                    <img src="{{ asset('images/images/discover-GKL/Jogging Track (1).webp') }}" alt="Jogging Track">
                </div>
                <div class="facility-item" data-scroll-animate="fade-up">
                    <img src="{{ asset('images/images/discover-GKL/Love Bridge.webp') }}" alt="Love Bridge">
                </div>
                <div class="facility-item" data-scroll-animate="fade-up">
                    <img src="{{ asset('images/images/discover-GKL/Mall Lagoon Avenue.webp') }}" alt="Mall Lagoon Avenue">
                </div>
                <div class="facility-item" data-scroll-animate="fade-up">
                    <img src="{{ asset('images/images/discover-GKL/Pocket Garden.webp') }}" alt="Pocket Garden">
                </div>
            </div>
        </section>

        <!-- Room Section -->
        <section class="room-section" id="room-section" data-scroll-animate="fade-up">
            <h2 class="room-title">ROOM GRAND KAMALA LAGOON</h2>

            <div class="room-slider-container">
                @foreach ($roomsFormatted as $room)
                <div class="room-card" data-scroll-animate="fade-up">
                    <div class="room-card-header">
                        <div class="left-text">NEOVALA <span class="room-type">ROOMS</span></div>
                        <img src="{{ asset('images/logo/room-title.webp') }}" alt="Neovala Logo" class="room-logo">
                        <div class="right-text">KAMALA <span class="room-type">LAGOON</span></div>
                    </div>
                    <div class="room-card-image">
                        <img src="{{ $room['main_photo'] }}" alt="Room {{ $room['room_name'] }}">
                    </div>
                    <button class="more-btn" data-room-id="{{ $room['id'] }}">MORE</button>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Room Popups -->
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

        <!-- Form Checkin -->
        <x-form-checkin apartment="Grand Kamala Lagoon Via WhatsApp" />

        <section class="order-online-card-section" id="order-online-section" data-scroll-animate="fade-up">
            <div class="order-online-card">
                <div class="order-online-card-content">
                    <div class="order-online-card-label">
                        <i class="bi bi-fire"></i> Order Online
                    </div>
                    <h3 class="order-online-card-title">Order Online Kamar Di Grand Kamala Lagoon</h3>
                    <p class="order-online-card-cta">Booking sekarang! Daftar NEOVRIENDS dapat potongan & cashback. Sewa murah, nyaman, privasi—hanya di NEOVALA.</p>
                    <a href="https://be.dip.id/booking/cekrooms?keyid=7e73df926be03c53f0f02fda4eb8730a" target="_blank" rel="noopener noreferrer" class="booking-btn order-online-btn">
                        <i class="bi bi-fire"></i>
                        <span>Order Online Grand Kamala Lagoon</span>
                    </a>
                </div>
                <div class="order-online-card-image">
                    <img src="{{ asset('images/images/discover-GKL/Infinity Pool.webp') }}" alt="Infinity Pool Grand Kamala Lagoon" loading="lazy">
                    <div class="order-online-card-image-overlay"></div>
                </div>
            </div>
        </section>

        <!-- Location Section -->
        <section class="location-section" id="location-section" data-scroll-animate="fade-up">
            <h2 class="location-title">LOCATION</h2>
            <h3 class="location-subtitle">Segera kunjungi apartemen kami!</h3>
            <div class="location-container">
                <div class="location-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1056470318726!2d106.97580647378044!3d-6.249807761191391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698d3075ed8a4b%3A0x9bf9bb3fcdb1e8af!2sGrand%20Kamala%20Lagoon%20Emerald%20Dan%20Barclay%20Tower!5e0!3m2!1sid!2sid!4v1745134278481!5m2!1sid!2sid"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="location-info">
                    <div class="location-address">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Jl. H. Nur Ali No.27, RT.007/RW.003, Pekayon Jaya, Kec. Bekasi Sel., Kota Bks, Jawa Barat
                            17148</p>
                    </div>
                    <div class="location-features">
                        <div class="feature-item">
                            <i class="fa-solid fa-bus-simple"></i>
                            <p>Dekat dengan Halte Biskita</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-shopping-cart"></i>
                            <p>Dekat dengan Mall Lagoon Avenue</p>
                        </div>
                        <div class="feature-item">
                            <i class="fa-solid fa-city"></i>
                            <p>Dekat dengan GALAXY CITY</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-utensils"></i>
                            <p>Dekat dengan Food Court Lagoon Avenue</p>
                        </div>
                    </div>
                    <div class="direction-btn-wrapper">
                        <a href="https://maps.app.goo.gl/vjNQJCyqTnUerUfS9" target="_blank" class="direction-btn">
                            <i class="fas fa-directions"></i> Petunjuk Arah
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Booking Section -->
        <section class="booking-section booking-section-GKL" id="booking-section" data-scroll-animate="fade-up">
            <div class="booking-overlay"></div>
            <div class="booking-container">
                <h2 class="booking-title">SEWA APARTEMEN<br>GRAND KAMALA LAGOON</h2>
                <h3 class="booking-subtitle">DI NEOVALA ROOM</h3>
                <div class="booking-buttons">
                    <a href="https://wa.me/6285161518151" class="booking-btn whatsapp-btn">
                        <i class="fab fa-whatsapp"></i>
                        <span class="whatsapp-text">WhatsApp</span>
                    </a>
                    <a href="https://be.dip.id/booking/cekrooms?keyid=7e73df926be03c53f0f02fda4eb8730a" target="_blank" rel="noopener noreferrer" class="booking-btn order-online-btn">
                        <i class="bi bi-fire"></i>
                        <span>Order Online</span>
                    </a>
                    <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-grand-kamala-lagoon-802001739869526174"
                        class="booking-btn tiket-btn">
                        <span class="tiket-text">tiket</span>
                        <div class="tiket-element"></div><span class="tiket-text">com</span>
                    </a>
                </div>
            </div>
        </section>

        @include('user.partials.reviews-section', ['locationName' => 'Grand Kamala Lagoon', 'locationSlug' => 'gkl', 'carouselImages' => $carouselImages ?? []])
    </main>

    <!-- Footer Discover -->
    <footer class="footer-discover" id="footer">
        <div class="scroll-top-discover">
            <a href="#home" class="scroll-top-btn-discover">
                <i class="fas fa-arrow-up"></i>
            </a>
        </div>

        <div class="footer-content-discover">
            <div class="footer-logo-discover">
                <img src="{{ asset('images/logo/footer-logo.webp') }}" alt="Neovala Logo">
                <h2>Neovala Rooms</h2>
            </div>

            <div class="footer-booking-discover">
                <h3>WhatsApp Booking</h3>
                <p>0851-6151-8151</p>
                <h3>Tiket.com Booking</h3>
                <p>Tiket.com</p>
            </div>

            <div class="footer-social-discover">
                <h3>Social Media GKL Neovala</h3>
                <div class="social-icons-discover">
                    <a href="https://instagram.com/neovala.grandkamalalagoon" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://facebook.com/YourFacebook" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://tiktok.com/@neovalagrandkamalalagoon" target="_blank">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <a href="https://twitter.com/neovala_gkl" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://youtube.com/@neovalagrandkamalalagoon" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom-discover">
            <p>&copy;Copyright Neovala room 2024. All right reserved, Your Level Up Sensation</p>
        </div>
    </footer>
@endsection

@section('skip-footer')
    {{-- Skip default footer karena ada footer discover khusus --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/apartment.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/form-checkin.js') }}"></script>
    <script>
    const starFilledPath = "{{ asset('images/logo/star-filled.webp') }}";
    const starEmptyPath = "{{ asset('images/logo/star-empty.webp') }}";

    document.addEventListener('DOMContentLoaded', function() {
        // Star Rating System
        const stars = document.querySelectorAll('.star-rating-select i');
        const ratingInput = document.getElementById('ratingInput');

            if (stars.length > 0 && ratingInput) {
        stars.forEach((star, index) => {
            star.addEventListener('mouseover', () => {
                for (let i = 0; i <= index; i++) {
                    stars[i].classList.remove('far');
                    stars[i].classList.add('fas');
                }
            });

            star.addEventListener('mouseout', () => {
                stars.forEach((s, i) => {
                    if (i > ratingInput.value - 1) {
                        s.classList.remove('fas');
                        s.classList.add('far');
                    }
                });
            });

            star.addEventListener('click', () => {
                ratingInput.value = index + 1;
                stars.forEach((s, i) => {
                    if (i <= index) {
                        s.classList.remove('far');
                        s.classList.add('fas');
                    } else {
                        s.classList.remove('fas');
                        s.classList.add('far');
                    }
                });
            });
        });
            }

        // Comment Slider Navigation
        const slider = document.querySelector('.testimoni-slider');
        const prevBtn = document.querySelector('.slider-nav-btn.prev');
        const nextBtn = document.querySelector('.slider-nav-btn.next');
            let cards = document.querySelectorAll('.testimoni-card');
        const indicator = document.querySelector('.slider-indicator');

            // Define functions in outer scope so they can be accessed by form handler
            let updateSliderLayout, updateButtonVisibility;

            if (slider && prevBtn && nextBtn) {
                updateSliderLayout = function() {
            const isMobile = window.innerWidth <= 768;

            if (isMobile) {
                slider.style.flexDirection = 'column';
                slider.style.height = '400px';
                slider.style.overflowY = 'auto';
                slider.style.overflowX = 'hidden';

                cards.forEach(card => {
                    card.style.width = '100%';
                    card.style.minWidth = 'unset';
                });

                prevBtn.style.display = 'none';
                nextBtn.style.display = 'none';
                        if (indicator) indicator.style.display = 'flex';
            } else {
                slider.style.flexDirection = 'row';
                slider.style.height = 'auto';
                slider.style.overflowX = 'auto';
                slider.style.overflowY = 'hidden';

                cards.forEach(card => {
                    card.style.width = '300px';
                    card.style.minWidth = '300px';
                });

                prevBtn.style.display = 'flex';
                nextBtn.style.display = 'flex';
                        if (indicator) indicator.style.display = 'none';
            }
        }

                updateButtonVisibility = function() {
            const isMobile = window.innerWidth <= 768;
            if (!isMobile) {
                        cards = document.querySelectorAll('.testimoni-card');
                        const cardWidth = cards[0] ? cards[0].offsetWidth + 30 : 330;

                if (slider.scrollLeft <= 0) {
                    prevBtn.style.opacity = '0';
                    prevBtn.style.pointerEvents = 'none';
                } else {
                    prevBtn.style.opacity = '1';
                    prevBtn.style.pointerEvents = 'auto';
                }

                        const remainingCards = Math.floor((slider.scrollWidth - slider.scrollLeft - slider.clientWidth) / cardWidth);
                if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth || remainingCards <= 0) {
                    nextBtn.style.opacity = '0';
                    nextBtn.style.pointerEvents = 'none';
                } else {
                    nextBtn.style.opacity = '1';
                    nextBtn.style.pointerEvents = 'auto';
                }
            }
        }

        window.addEventListener('resize', () => {
            updateSliderLayout();
            updateButtonVisibility();
        });

        slider.addEventListener('scroll', () => {
            updateButtonVisibility();
            if (slider.scrollTop > 50) {
                slider.classList.add('scrolled');
            } else {
                slider.classList.remove('scrolled');
            }
        });

        prevBtn.addEventListener('click', () => {
                    const cardWidth = cards[0] ? cards[0].offsetWidth + 30 : 330;
            slider.scrollBy({
                left: -cardWidth,
                behavior: 'smooth'
            });
        });

        nextBtn.addEventListener('click', () => {
                    const cardWidth = cards[0] ? cards[0].offsetWidth + 30 : 330;
            slider.scrollBy({
                left: cardWidth,
                behavior: 'smooth'
            });
        });

        updateSliderLayout();
        updateButtonVisibility();
            } else {
                // Initialize empty functions if slider doesn't exist yet
                updateSliderLayout = function() {};
                updateButtonVisibility = function() {};
            }

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

            // Room Popup Functionality
        const moreBtns = document.querySelectorAll('.more-btn');

        moreBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const roomId = btn.dataset.roomId;
                const popup = document.getElementById(`roomPopup${roomId}`);
                if (!popup) return;

                popup.style.display = 'flex';
                popup.offsetHeight;
                popup.classList.add('active');
                document.body.style.overflow = 'hidden';

                initCarousel(popup);
            });
        });

        function initCarousel(popup) {
            const carouselContainer = popup.querySelector('.popup-carousel-container');
            const slides = popup.querySelectorAll('.popup-carousel-slide');
            const prevBtn = popup.querySelector('.popup-carousel-prev');
            const nextBtn = popup.querySelector('.popup-carousel-next');
            const dots = popup.querySelectorAll('.popup-carousel-dot');

                if (!carouselContainer || slides.length === 0) return;

            let currentSlide = 0;
            const slideCount = slides.length;

            carouselContainer.style.width = `${slideCount * 100}%`;
            slides.forEach(slide => {
                slide.style.width = `${100 / slideCount}%`;
                slide.style.flexShrink = '0';
            });

            function updateCarousel() {
                carouselContainer.style.transform = `translateX(-${(100 / slideCount) * currentSlide}%)`;

                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentSlide);
                });
            }

            if (prevBtn && nextBtn) {
                prevBtn.addEventListener('click', () => {
                    currentSlide = (currentSlide - 1 + slideCount) % slideCount;
                    updateCarousel();
                });

                nextBtn.addEventListener('click', () => {
                    currentSlide = (currentSlide + 1) % slideCount;
                    updateCarousel();
                });
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    updateCarousel();
                });
            });

            // Swipe gesture
            let touchStartX = 0;
            let touchEndX = 0;

            carouselContainer.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            });

            carouselContainer.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                const threshold = 50;
                if (touchEndX < touchStartX - threshold) {
                    currentSlide = (currentSlide + 1) % slideCount;
                } else if (touchEndX > touchStartX + threshold) {
                    currentSlide = (currentSlide - 1 + slideCount) % slideCount;
                }
                updateCarousel();
            });

            currentSlide = 0;
            updateCarousel();
        }

            // Close popup
        const allPopups = document.querySelectorAll('.popup-overlay');

        allPopups.forEach(popup => {
            const closeBtn = popup.querySelector('.popup-close');

            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    closePopup(popup);
                });
            }

            popup.addEventListener('click', (e) => {
                if (e.target === popup) {
                    closePopup(popup);
                }
            });
        });

        function closePopup(popup) {
            popup.classList.add('closing');
            popup.classList.remove('active');

            setTimeout(() => {
                popup.classList.remove('closing');
                popup.style.display = 'none';
                
                // Check if any other popup is still active
                const activePopups = document.querySelectorAll('.popup-overlay[style*="flex"], .popup-overlay.active');
                const promoPopup = document.getElementById('popup-overlay');
                const promoPopupActive = promoPopup && promoPopup.classList.contains('active');
                
                // Only restore scroll if no popups are active
                if (activePopups.length === 0 && !promoPopupActive) {
                    document.body.style.overflow = 'auto';
                }
            }, 500);
        }

        // Close popup with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const activeRoomPopups = document.querySelectorAll('.popup-overlay:not(#popup-overlay)[style*="flex"], .popup-overlay:not(#popup-overlay).active');
                if (activeRoomPopups.length > 0) {
                    activeRoomPopups.forEach(popup => {
                        closePopup(popup);
                    });
                }
            }
        });

            // Handle Feedback Form Submission
            const feedbackForm = document.getElementById('feedbackForm');
            if (feedbackForm) {
                feedbackForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('.submit-feedback-btn');
                    const originalText = submitBtn.textContent;

                    // Disable submit button
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Mengirim...';

                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Add new comment to slider
                            const testimoniSlider = document.querySelector('.testimoni-slider');
                            if (testimoniSlider && data.komentar) {
                                const newCard = document.createElement('div');
                                newCard.className = 'testimoni-card';
                                
                                const instagramDisplay = data.komentar.hide_identity 
                                    ? '@*******' 
                                    : '@' + data.komentar.instagram;

                                let starsHtml = '';
                                for (let i = 1; i <= 5; i++) {
                                    const starSrc = i <= data.komentar.rating ? starFilledPath : starEmptyPath;
                                    starsHtml += `<img src="${starSrc}" alt="Star" class="star-icon">`;
                                }

                                newCard.innerHTML = `
                                    <span class="quote-icon">"</span>
                                    <p class="comment-text">${data.komentar.message}</p>
                                    <div class="comment-footer">
                                        <span class="comment-user">${instagramDisplay}</span>
                                        <div class="star-rating">${starsHtml}</div>
                                    </div>
                                `;

                                // Insert at the beginning (newest first)
                                testimoniSlider.insertBefore(newCard, testimoniSlider.firstChild);

                                // Update cards reference
                                cards = document.querySelectorAll('.testimoni-card');
                                
                                // Update slider layout if function exists
                                if (typeof updateSliderLayout === 'function') {
                                    updateSliderLayout();
                                }

                                // Update button visibility if function exists
                                if (typeof updateButtonVisibility === 'function') {
                                    updateButtonVisibility();
                                }

                                // Scroll to show new comment
                                testimoniSlider.scrollLeft = 0;
                            }

                            // Show success message
                            alert(data.message || 'Terima kasih atas feedback Anda!');

                            // Reset form
                            this.reset();
                            ratingInput.value = 0;
                            stars.forEach(star => {
                                star.classList.remove('fas');
                                star.classList.add('far');
                            });
                        } else {
                            alert('Gagal mengirim feedback. Silakan coba lagi.');
                        }
                    })
                    .catch(error => {
                        console.error('Error submitting feedback:', error);
                        alert('Terjadi kesalahan saat mengirim feedback. Silakan coba lagi.');
                    })
                    .finally(() => {
                        // Re-enable submit button
                        submitBtn.disabled = false;
                        submitBtn.textContent = originalText;
                    });
                });
            }
    });
    </script>

    <script src="{{ asset('js/tracking.js') }}"></script>
    <script>
    // Track apartment discovery
    document.addEventListener('DOMContentLoaded', function() {
        if (window.neovalaTracker) {
            window.neovalaTracker.trackApartmentDiscovery('Grand Kamala Lagoon');
        }
    });
    </script>
@endpush
