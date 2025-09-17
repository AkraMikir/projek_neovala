<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=42dot+Sans:wght@300..800&family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=42dot+Sans:wght@300..800&family=Allura&family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=National+Park:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/footer-logo.png') }}">
    <title>Discover Gate Way Cicadas</title>
    <link rel="stylesheet" href="{{ asset('css/apartment.css') }}">
</head>

<body>
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
                <a href="{{ route('home') }}"><img src="{{ asset('images/logo/NEOVALA TRANSPARENT 1.png') }}"
                        alt="Logo Neovala Light" class="logo-light"></a>
                <a href="{{ route('home') }}"><img src="{{ asset('images/logo/NEOVALA-DARK.png') }}"
                        alt="Logo Neovala Dark" class="logo-dark"></a>
            </div>
            <ul class="nav-links">
                <li><a href="#facilities-section"><i class="bi bi-building"></i> Facilities</a></li>
                <li><a href="#room-section"><i class="bi bi-door-open"></i> Room</a></li>
                <li><a href="#location-section"><i class="bi bi-geo-alt"></i> Location</a></li>
                <li><a href="#booking-section"><i class="bi bi-cash-coin"></i> Sewa Apartemen</a></li>
                <li><a href="#testimoni-section"><i class="bi bi-chat-dots"></i> Testimoni</a></li>
                <li><a href="#footer"><i class="bi bi-geo-alt"></i> Find Us</a></li>
            </ul>
            <div class="logo-right"><a href="{{ route('home') }}">NEOVALA</a></div>
        </div>
    </nav>
    <div class="nav-overlay"></div>

    <!-- Header dengan Carousel -->
    <header class="header" id="home">
        <div class="carousel">
            <!-- Tambahkan overlay text -->
            <div class="header-text-overlay-discover">
                <p>GATEWAY CICADAS</p>
            </div>

            <button class="carousel-button prev">&#10094;</button>
            <button class="carousel-button next">&#10095;</button>

            @foreach($carouselImagesBySection as $section => $images)
            <div class="carousel-container">
                @if(!empty($images))
                @for($i = 1; $i <= 4; $i++) @if(!empty($images[$i])) <div class="carousel-slide">
                    <img src="{{ $images[$i] }}" alt="Slide {{ $i }} {{ $section }}">
            </div>
            @endif
            @endfor
            @else
            <p>Tidak ada gambar untuk {{ $section }}.</p>
            @endif
        </div>
        @endforeach

        <div class="carousel-dots">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
        </div>
    </header>

    <!-- Book Now Button -->
    <div class="book-now-container visible">
        <a href="{{ route('bookNow') }}" class="book-now-btn">
            <div class="book-now-icon"><img src="{{ asset('images/logo/book-now.png') }}" alt=""></div>
            <span>BOOK NOW</span>
        </a>
    </div>


    <!-- our facilities -->
    <main class="main-content">

        <section class="facilities-section" id="facilities-section">
            <h2 class="facilities-title">OUR FACILITIES</h2>

            <div class="service-container-apart">
                <div class="service-item-apart">
                    <i class="fa-solid fa-basketball"></i>
                </div>
                <div class="service-item-apart">
                    <i class="fa-solid fa-swimming-pool"></i>
                </div>
                <div class="service-item-apart">
                    <i class="fa-solid fa-couch"></i>
                </div>
                <div class="service-item-apart">
                    <i class="fa-solid fa-mosque"></i>
                </div>
                <div class="service-item-apart">
                    <i class="fa-solid fa-store"></i>
                </div>
                <div class="service-item-apart">
                    <i class="fa-solid fa-umbrella-beach"></i>
                </div>
            </div>


            <div class="facilities-grid">
                <div class="facility-item">
                    <img src="{{ asset('images/images/discover-GWC/Basketball Court.jpg') }}" alt="Siteplan">
                </div>
                <div class="facility-item">
                    <img src="{{ asset('images/images/discover-GWC/Childrens Swimming Pool.jpg') }}"
                        alt="Swimming Pool">
                </div>
                <div class="facility-item">
                    <img src="{{ asset('images/images/discover-GWC/Indomaret Fresh.jpg') }}" alt="Lobby Area">
                </div>
                <div class="facility-item">
                    <img src="{{ asset('images/images/discover-GWC/Lobby Area (1).jpg') }}" alt="Playground">
                </div>
                <div class="facility-item">
                    <img src="{{ asset('images/images/discover-GWC/Masjid.jpg') }}" alt="Lobby Area">
                </div>
                <div class="facility-item">
                    <img src="{{ asset('images/images/discover-GWC/Rooftop.jpg') }}" alt="Garden">
                </div>
            </div>
        </section>

        <section class="room-section" id="room-section">
            <h2 class="room-title">ROOM GATEWAY CICADAS</h2>

            <div class="room-slider-container">
                @foreach ($roomsFormatted as $room)
                <div class="room-card">
                    <div class="room-card-header">
                        <div class="left-text">NEOVALA <span class="room-type">ROOMS</span></div>
                        <img src="{{ asset('images/logo/room-title.png') }}" alt="Neovala Logo" class="room-logo">
                        <div class="right-text">GATEWAY <span class="room-type">CICADAS</span></div>
                    </div>
                    <div class="room-card-image">
                        <img src="{{ $room['main_photo'] }}" alt="Room {{ $room['room_name'] }}">
                    </div>
                    <button class="more-btn" data-room-id="{{ $room['id'] }}">MORE</button>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Popups --}}
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

        <x-form-checkin apartment="Gateway Cicadas by Neovala" />

        <section class="location-section" id="location-section">
            <h2 class="location-title">LOCATION</h2>
            <h3 class="location-subtitle">Segera kunjungi apartemen kami!</h3>
            <div class="location-container">
                <div class="location-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.863493051343!2d107.64290597379046!3d-6.906922067593474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7aaa728eccd%3A0x1dc9568b59e35f7a!2sNOII%201.0%20(Gateway%20Apartemen%20Cicadas)!5e0!3m2!1sen!2sid!4v1745391689167!5m2!1sen!2sid"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="location-info">
                    <div class="location-address">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Apartemen GATEWAY CICADAS, Jl. Alternatif Cibubur, Harjamukti, Cimanggis, Depok City, West
                            Java 16454</p>
                    </div>
                    <div class="location-features">
                        <div class="feature-item">
                            <i class="fas fa-bus"></i>
                            <p>Dekat dengan Halte Gateway Cicadas</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-shopping-cart"></i>
                            <p>Dekat dengan Pasar Cicadas</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-hospital"></i>
                            <p>Dekat dengan RS Santo yusup</p>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-university"></i>
                            <p>Dekat dengan ATM center</p>
                        </div>
                    </div>
                    <div class="direction-btn-wrapper">
                        <a href="https://maps.app.goo.gl/mEP4YWdkiuhfJpJV7" target="_blank" class="direction-btn">
                            <i class="fas fa-directions"></i> Petunjuk Arah
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="booking-section booking-section-GWC" id="booking-section">
            <div class="booking-overlay"></div>
            <div class="booking-container">
                <h2 class="booking-title">SEWA APARTEMEN<br>GATEWAY CICADAS</h2>
                <h3 class="booking-subtitle">DI NEOVALA ROOM</h3>
                <div class="booking-buttons">
                    <a href="https://wa.me/6289630253533" class="booking-btn whatsapp-btn">
                        <i class="fab fa-whatsapp"></i>
                        <span class="whatsapp-text">WhatsApp</span>
                    </a>
                    <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-gateway-cicadas"
                        class="booking-btn tiket-btn">
                        <span class="tiket-text">tiket</span>
                        <div class="tiket-element"></div><span class="tiket-text">com</span>

                    </a>
                </div>
            </div>
        </section>

        <section class="testimoni-section" id="testimoni-section">
            <div class="testimoni-comments">
                <h2 class="testimoni-title">WHAT THEY SAY?</h2>
                <div class="testimoni-slider-container">
                    <button class="slider-nav-btn prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="slider-nav-btn next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <div class="testimoni-slider">
                        <!-- Comment Card 1 -->
                        @foreach (\App\Models\KomentarGwc::where('status', 'accepted')->where('section',
                        'Gwc')->latest()->get() as $komen)
                        <div class="testimoni-card">
                            <span class="quote-icon">"</span>
                            <p class="comment-text">{{ $komen->message }}</p>
                            <div class="comment-footer">
                                <span class="comment-user">
                                    {{ $komen->hide_identity ? '@*******' : '@' . $komen->instagram }}
                                </span>
                                <div class="star-rating">
                                    @for ($i = 1; $i <= 5; $i++) <img
                                        src="{{ asset('images/logo/' . ($i <= $komen->rating ? 'star-filled' : 'star-empty') . '.png') }}"
                                        alt="Star" class="star-icon">
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="slider-indicator">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <div class="feedback-section">
                <h2 class="feedback-title">GIVE US FEEDBACK</h2>
                <form class="feedback-form" id="feedbackForm" method="POST" action="{{ route('komentar-gwc.store') }}">
                    @csrf

                    <!-- Rating Stars -->
                    <div class="rating-input">
                        <input type="hidden" name="rating" id="ratingInput" value="0">
                        <div class="star-rating-select">
                            <i class="far fa-star" data-rating="1"></i>
                            <i class="far fa-star" data-rating="2"></i>
                            <i class="far fa-star" data-rating="3"></i>
                            <i class="far fa-star" data-rating="4"></i>
                            <i class="far fa-star" data-rating="5"></i>
                        </div>
                    </div>

                    <!-- Instagram Input -->
                    <div class="form-group">
                        <label for="instagramHandle">Instagram:</label>
                        <div class="instagram-input-wrapper">
                            <span class="instagram-text">@</span>
                            <input type="text" id="instagramHandle" name="instagram" placeholder="your instagram"
                                maxlength="18" required>
                        </div>
                    </div>

                    <!-- Hide Identity Checkbox -->
                    <div class="form-group-hide-identity">
                        <div class="hide-identity-container">
                            <label for="hideIdentity" class="hide-identity-label">hide</label>
                            <input type="checkbox" id="hideIdentity" class="hide-identity-toggle" name="hideIdentity">
                        </div>
                    </div>

                    <!-- Message Input -->
                    <div class="form-group">
                        <label for="feedbackMessage">Pesan:</label>
                        <textarea id="feedbackMessage" name="message" placeholder="Silakan tulis pesanmu di sini..."
                            required maxlength="72"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-feedback-btn">Kirim</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="footer-discover" id="footer">
        <div class="scroll-top-discover">
            <a href="#home" class="scroll-top-btn-discover">
                <i class="fas fa-arrow-up"></i>
            </a>
        </div>

        <div class="footer-content-discover">
            <div class="footer-logo-discover">
                <img src="{{ asset('images/logo/footer-logo.png')    }}" alt="Neovala Logo">
                <h2>Neovala Rooms</h2>
            </div>

            <div class="footer-booking-discover">
                <h3>WhatsApp Booking</h3>
                <p>0896-3025-3533</p>
                <h3>Tiket.com Booking</h3>
                <p>Tiket.com</p>
            </div>

            <div class="footer-social-discover">
                <h3>Social Media GWC Neovala</h3>
                <div class="social-icons-discover">
                    <a href="https://instagram.com/neovala.gatewaycicadas" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.facebook.com/people/Cicadas-Gateway-Apartement/pfbid0XoaDEcQgcYnrZa6eujLuYjNLRoKH1n3U5wesUixzYzE1SKS5XMG5FxunbWQvFC5Ml/"
                        target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://tiktok.com/@neovala.gatewaycicadas" target="_blank">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <a href="https://twitter.com/neovala_gwc" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://youtube.com/@neovalagatewaycicadas" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom-discover">
            <p>&copy;Copyright Neovala room 2024. All right reserved, Your Level Up Sensation</p>
        </div>
    </footer>

    <!-- main contant selesai -->
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="../js/form-checkin.js"></script>
    <script>
    const starFilledPath = "{{ asset('images/logo/star-filled.png') }}";
    const starEmptyPath = "{{ asset('images/logo/star-empty.png') }}";

    document.addEventListener('DOMContentLoaded', function() {
        // Star Rating System
        const stars = document.querySelectorAll('.star-rating-select i');
        const ratingInput = document.getElementById('ratingInput');

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

        // Comment Slider Navigation
        const slider = document.querySelector('.testimoni-slider');
        const prevBtn = document.querySelector('.slider-nav-btn.prev');
        const nextBtn = document.querySelector('.slider-nav-btn.next');
        const cards = document.querySelectorAll('.testimoni-card');
        const indicator = document.querySelector('.slider-indicator');

        function updateSliderLayout() {
            const isMobile = window.innerWidth <= 768;

            if (isMobile) {
                // Mode mobile - vertical scroll
                slider.style.flexDirection = 'column';
                slider.style.height = '400px';
                slider.style.overflowY = 'auto';
                slider.style.overflowX = 'hidden';

                cards.forEach(card => {
                    card.style.width = '100%';
                    card.style.minWidth = 'unset';
                });

                // Sembunyikan tombol navigasi horizontal
                prevBtn.style.display = 'none';
                nextBtn.style.display = 'none';

                // Tampilkan indikator scroll vertikal
                indicator.style.display = 'flex';
            } else {
                // Mode desktop - horizontal scroll
                slider.style.flexDirection = 'row';
                slider.style.height = 'auto';
                slider.style.overflowX = 'auto';
                slider.style.overflowY = 'hidden';

                cards.forEach(card => {
                    card.style.width = '300px';
                    card.style.minWidth = '300px';
                });

                // Tampilkan tombol navigasi horizontal
                prevBtn.style.display = 'flex';
                nextBtn.style.display = 'flex';

                // Sembunyikan indikator scroll vertikal
                indicator.style.display = 'none';
            }
        }

        // Fungsi untuk mengecek posisi scroll dan menampilkan/menyembunyikan tombol
        function updateButtonVisibility() {
            const isMobile = window.innerWidth <= 768;

            if (!isMobile) {
                const cardWidth = cards[0].offsetWidth + 30; // Including gap

                // Sembunyikan tombol prev jika scroll berada di awal
                if (slider.scrollLeft <= 0) {
                    prevBtn.style.opacity = '0';
                    prevBtn.style.pointerEvents = 'none';
                } else {
                    prevBtn.style.opacity = '1';
                    prevBtn.style.pointerEvents = 'auto';
                }

                // Sembunyikan tombol next jika scroll berada di akhir
                const remainingCards = Math.floor((slider.scrollWidth - slider.scrollLeft - slider
                    .clientWidth) / cardWidth);
                if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth || remainingCards <= 0) {
                    nextBtn.style.opacity = '0';
                    nextBtn.style.pointerEvents = 'none';
                } else {
                    nextBtn.style.opacity = '1';
                    nextBtn.style.pointerEvents = 'auto';
                }
            }
        }

        // Event listeners
        window.addEventListener('resize', () => {
            updateSliderLayout();
            updateButtonVisibility();
        });

        slider.addEventListener('scroll', () => {
            updateButtonVisibility();
            // Tambahkan class 'scrolled' ketika slider di-scroll
            if (slider.scrollTop > 50) {
                slider.classList.add('scrolled');
            } else {
                slider.classList.remove('scrolled');
            }
        });

        prevBtn.addEventListener('click', () => {
            const cardWidth = cards[0].offsetWidth + 30;
            slider.scrollBy({
                left: -cardWidth,
                behavior: 'smooth'
            });
        });

        nextBtn.addEventListener('click', () => {
            const cardWidth = cards[0].offsetWidth + 30;
            slider.scrollBy({
                left: cardWidth,
                behavior: 'smooth'
            });
        });

        // Inisialisasi
        updateSliderLayout();
        updateButtonVisibility();


    });
    </script>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
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

            let currentSlide = 0;
            const slideCount = slides.length;

            // Set dynamic width container & slides
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

        // Tutup popup
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
                document.body.style.overflow = '';
            }, 500);
        }
    });
    </script>
</body>

</html>
