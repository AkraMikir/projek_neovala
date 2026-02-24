<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Online - Neovala</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/title-web.webp') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/order-online.css') }}">

    <style>
        html { scroll-behavior: smooth; }
    </style>
</head>

<body class="order-online-page">

    <!-- Header -->
    <header class="oo-header">
        <a href="{{ route('home') }}" class="oo-logo">
            <img src="{{ asset('images/logo/logo-light.webp') }}" alt="Neovala Logo" onerror="this.style.display='none'">
            <span class="oo-logo-text">NEOVALA</span>
        </a>
        <a href="{{ route('home') }}" class="oo-back-btn">
            <i class="bi bi-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </header>

    <!-- Hero + Carousel -->
    <section class="oo-hero">
        <div class="oo-hero-bg"></div>

        <!-- Hero Text -->
        <div class="oo-hero-content">
            <div class="oo-badge">
                <i class="bi bi-stars"></i>
                Booking Mudah &amp; Cepat
            </div>
            <h1 class="oo-title">
                Pilih Apartemen,<br>
                <span>Book Sekarang</span>
            </h1>
            <p class="oo-subtitle">
                Tersedia 8 apartemen premium di lokasi strategis. Booking online langsung dan dapatkan penawaran terbaik dari Neovala.
            </p>
        </div>

        <!-- Carousel -->
        <div class="oo-carousel-section">
            <!-- clip wrapper: mencegah scroll horizontal tanpa memotong vertical scale -->
            <div class="oo-carousel-clip">
            <div class="oo-carousel-track-wrapper">
                <!-- Prev Button -->
                <button class="oo-nav-btn oo-nav-prev" id="oo-prev" aria-label="Previous">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <!-- Track -->
                <div class="oo-carousel-track" id="oo-track">

                    {{-- Card 1: Transpark Juanda --}}
                    <div class="oo-card" data-index="0">
                        <img
                            class="oo-card-img"
                            src="{{ asset('images/images/drone_photo/TPJ/DJI_20250404164446_0282_D.webp') }}"
                            alt="Transpark Juanda"
                            loading="lazy"
                        >
                        <div class="oo-card-overlay"></div>
                        <div class="oo-card-content">
                            <span class="oo-card-badge"><i class="bi bi-star-fill"></i> Neovala</span>
                            <h3 class="oo-card-name">Transpark Juanda</h3>
                            <p class="oo-card-location"><i class="bi bi-geo-alt-fill"></i> Bekasi, Jawa Barat</p>
                            <a
                                href="https://be.dip.id/booking/cekrooms?keyid=0c852d588be29c4fa736fae16c877bd5"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="oo-card-btn"
                            >
                                <i class="bi bi-calendar2-check"></i>
                                Booking Sekarang
                            </a>
                        </div>
                    </div>

                    {{-- Card 2: Transpark Cibubur --}}
                    <div class="oo-card" data-index="1">
                        <img
                            class="oo-card-img"
                            src="{{ asset('images/images/drone_photo/TPC/DJI_20250405123929_0314_D.webp') }}"
                            alt="Transpark Cibubur"
                            loading="lazy"
                        >
                        <div class="oo-card-overlay"></div>
                        <div class="oo-card-content">
                            <span class="oo-card-badge"><i class="bi bi-star-fill"></i> Neovala</span>
                            <h3 class="oo-card-name">Transpark Cibubur</h3>
                            <p class="oo-card-location"><i class="bi bi-geo-alt-fill"></i> Cibubur, Jakarta Timur</p>
                            <a
                                href="https://be.dip.id/booking/cekrooms?keyid=b78ffaf7036db64ce2437ec13dfebd44"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="oo-card-btn"
                            >
                                <i class="bi bi-calendar2-check"></i>
                                Booking Sekarang
                            </a>
                        </div>
                    </div>

                    {{-- Card 3: Patraland Urbano --}}
                    <div class="oo-card" data-index="2">
                        <img
                            class="oo-card-img"
                            src="{{ asset('images/images/drone_photo/PLU/DJI_20250321180704_0146_D.webp') }}"
                            alt="Patraland Urbano"
                            loading="lazy"
                        >
                        <div class="oo-card-overlay"></div>
                        <div class="oo-card-content">
                            <span class="oo-card-badge"><i class="bi bi-star-fill"></i> Neovala</span>
                            <h3 class="oo-card-name">Patraland Urbano</h3>
                            <p class="oo-card-location"><i class="bi bi-geo-alt-fill"></i> Bekasi, Jawa Barat</p>
                            <a
                                href="https://be.dip.id/booking/cekrooms?keyid=e57d71fa4ee77bf374f103f2eecabbe6"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="oo-card-btn"
                            >
                                <i class="bi bi-calendar2-check"></i>
                                Booking Sekarang
                            </a>
                        </div>
                    </div>

                    {{-- Card 4: Podomoro Golf View --}}
                    <div class="oo-card" data-index="3">
                        <img
                            class="oo-card-img"
                            src="{{ asset('images/images/drone_photo/PGV/DJI_20250307171441_0098_D.webp') }}"
                            alt="Podomoro Golf View"
                            loading="lazy"
                        >
                        <div class="oo-card-overlay"></div>
                        <div class="oo-card-content">
                            <span class="oo-card-badge"><i class="bi bi-star-fill"></i> Neovala</span>
                            <h3 class="oo-card-name">Podomoro Golf View</h3>
                            <p class="oo-card-location"><i class="bi bi-geo-alt-fill"></i> Cimanggis, Depok</p>
                            <a
                                href="https://be.dip.id/booking/cekrooms?keyid=02206fd5278c6653c3f27463a166eed7"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="oo-card-btn"
                            >
                                <i class="bi bi-calendar2-check"></i>
                                Booking Sekarang
                            </a>
                        </div>
                    </div>

                    {{-- Card 5: Bassura City --}}
                    <div class="oo-card" data-index="4">
                        <img
                            class="oo-card-img"
                            src="{{ asset('images/images/drone_photo/BSC/DJI_20250827131627_0494_D.webp') }}"
                            alt="Bassura City"
                            loading="lazy"
                        >
                        <div class="oo-card-overlay"></div>
                        <div class="oo-card-content">
                            <span class="oo-card-badge"><i class="bi bi-star-fill"></i> Neovala</span>
                            <h3 class="oo-card-name">Bassura City</h3>
                            <p class="oo-card-location"><i class="bi bi-geo-alt-fill"></i> Cipinang, Jakarta Timur</p>
                            <a
                                href="https://be.dip.id/booking/cekrooms?keyid=f438f8f13b7899819d135e13e2adb645"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="oo-card-btn"
                            >
                                <i class="bi bi-calendar2-check"></i>
                                Booking Sekarang
                            </a>
                        </div>
                    </div>

                    {{-- Card 6: Grand Kamala Lagoon --}}
                    <div class="oo-card" data-index="5">
                        <img
                            class="oo-card-img"
                            src="{{ asset('images/images/drone_photo/GKL/DJI_20250327155321_0214_D.webp') }}"
                            alt="Grand Kamala Lagoon"
                            loading="lazy"
                        >
                        <div class="oo-card-overlay"></div>
                        <div class="oo-card-content">
                            <span class="oo-card-badge"><i class="bi bi-star-fill"></i> Neovala</span>
                            <h3 class="oo-card-name">Grand Kamala Lagoon</h3>
                            <p class="oo-card-location"><i class="bi bi-geo-alt-fill"></i> Bekasi, Jawa Barat</p>
                            <a
                                href="https://be.dip.id/booking/cekrooms?keyid=7e73df926be03c53f0f02fda4eb8730a"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="oo-card-btn"
                            >
                                <i class="bi bi-calendar2-check"></i>
                                Booking Sekarang
                            </a>
                        </div>
                    </div>

                    {{-- Card 7: Green Pramuka City --}}
                    <div class="oo-card" data-index="6">
                        <img
                            class="oo-card-img"
                            src="{{ asset('images/images/drone_photo/GPC/DJI_20250905143045_0548_D.webp') }}"
                            alt="Green Pramuka City"
                            loading="lazy"
                        >
                        <div class="oo-card-overlay"></div>
                        <div class="oo-card-content">
                            <span class="oo-card-badge"><i class="bi bi-star-fill"></i> Neovala</span>
                            <h3 class="oo-card-name">Green Pramuka City</h3>
                            <p class="oo-card-location"><i class="bi bi-geo-alt-fill"></i> Rawasari, Jakarta Pusat</p>
                            <a
                                href="https://be.dip.id/booking/cekrooms?keyid=beaf6f26422ed69cd8e4d7a0398d6da1"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="oo-card-btn"
                            >
                                <i class="bi bi-calendar2-check"></i>
                                Booking Sekarang
                            </a>
                        </div>
                    </div>

                    {{-- Card 8: Springlake Summarecon --}}
                    <div class="oo-card" data-index="7">
                        <img
                            class="oo-card-img"
                            src="{{ asset('images/images/drone_photo/SPL/DJI_20260102114312_0582_D.webp') }}"
                            alt="Springlake Summarecon"
                            loading="lazy"
                        >
                        <div class="oo-card-overlay"></div>
                        <div class="oo-card-content">
                            <span class="oo-card-badge"><i class="bi bi-star-fill"></i> Neovala</span>
                            <h3 class="oo-card-name">Springlake Summarecon</h3>
                            <p class="oo-card-location"><i class="bi bi-geo-alt-fill"></i> Bekasi, Jawa Barat</p>
                            <a
                                href="https://be.dip.id/booking/cekrooms?keyid=eff54e59745a24240872b623a49a1dc1"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="oo-card-btn"
                            >
                                <i class="bi bi-calendar2-check"></i>
                                Booking Sekarang
                            </a>
                        </div>
                    </div>

                </div><!-- end track -->

                <!-- Next Button -->
                <button class="oo-nav-btn oo-nav-next" id="oo-next" aria-label="Next">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div><!-- end track-wrapper -->
            </div><!-- end carousel-clip -->

            <!-- Dot Indicators -->
            <div class="oo-dots" id="oo-dots">
                <button class="oo-dot" data-index="0" aria-label="Go to slide 1"></button>
                <button class="oo-dot" data-index="1" aria-label="Go to slide 2"></button>
                <button class="oo-dot" data-index="2" aria-label="Go to slide 3"></button>
                <button class="oo-dot" data-index="3" aria-label="Go to slide 4"></button>
                <button class="oo-dot" data-index="4" aria-label="Go to slide 5"></button>
                <button class="oo-dot" data-index="5" aria-label="Go to slide 6"></button>
                <button class="oo-dot" data-index="6" aria-label="Go to slide 7"></button>
                <button class="oo-dot" data-index="7" aria-label="Go to slide 8"></button>
            </div>

            <!-- Counter -->
            <p class="oo-counter">
                Apartemen <span id="oo-current">1</span> dari <span>8</span>
            </p>
        </div>
    </section>

    <script>
        (function () {
            const track = document.getElementById('oo-track');
            const cards = Array.from(track.querySelectorAll('.oo-card'));
            const dots = Array.from(document.querySelectorAll('.oo-dot'));
            const prevBtn = document.getElementById('oo-prev');
            const nextBtn = document.getElementById('oo-next');
            const counterEl = document.getElementById('oo-current');
            const total = cards.length;

            let current = 0;
            let isDragging = false;
            let startX = 0;
            let startScrollLeft = 0;

            function getCardWidth() {
                if (cards[0]) {
                    const gap = parseFloat(window.getComputedStyle(track).gap) || 20;
                    return cards[0].offsetWidth + gap;
                }
                return 280;
            }

            function updateCarousel(index, smooth = true) {
                current = Math.max(0, Math.min(index, total - 1));

                // Update active states
                cards.forEach((card, i) => {
                    card.classList.remove('active', 'adjacent');
                    if (i === current) {
                        card.classList.add('active');
                    } else if (Math.abs(i - current) === 1) {
                        card.classList.add('adjacent');
                    }
                });

                // Update dots
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === current);
                });

                // Update counter
                if (counterEl) counterEl.textContent = current + 1;

                // --- Centering calculation ---
                // Referensi: clip container (area visible user)
                const clipEl = document.querySelector('.oo-carousel-clip');
                const wrapperEl = document.querySelector('.oo-carousel-track-wrapper');

                const clipRect = clipEl
                    ? clipEl.getBoundingClientRect()
                    : { left: 0, width: window.innerWidth };
                const wrapperRect = wrapperEl
                    ? wrapperEl.getBoundingClientRect()
                    : { left: 0 };

                const paddingLeft = parseFloat(window.getComputedStyle(wrapperEl).paddingLeft) || 0;
                const cardW      = getCardWidth();
                const cardWidth  = cards[current].offsetWidth;

                // Titik tengah area clip
                const clipCenter = clipRect.left + clipRect.width / 2;

                // Posisi natural (tanpa transform) titik tengah card[current]
                const cardNaturalCenter = wrapperRect.left + paddingLeft + current * cardW + cardWidth / 2;

                // translateX yang dibutuhkan agar card[current] tepat di tengah clip
                const translateX = clipCenter - cardNaturalCenter;

                track.style.transition = smooth
                    ? 'transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)'
                    : 'none';
                track.style.transform = `translateX(${translateX}px)`;

                // Update button states
                prevBtn.disabled = current === 0;
                nextBtn.disabled = current === total - 1;
            }

            // Nav buttons
            prevBtn.addEventListener('click', () => updateCarousel(current - 1));
            nextBtn.addEventListener('click', () => updateCarousel(current + 1));

            // Dot clicks
            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    updateCarousel(parseInt(dot.dataset.index));
                });
            });

            // Card click to focus
            cards.forEach((card, i) => {
                card.addEventListener('click', (e) => {
                    if (i !== current) {
                        e.preventDefault();
                        updateCarousel(i);
                    }
                });
            });

            // Touch / drag support
            track.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                isDragging = true;
            }, { passive: true });

            track.addEventListener('touchend', (e) => {
                if (!isDragging) return;
                const diff = startX - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 50) {
                    updateCarousel(diff > 0 ? current + 1 : current - 1);
                }
                isDragging = false;
            });

            // Mouse drag
            track.addEventListener('mousedown', (e) => {
                startX = e.clientX;
                isDragging = true;
                track.style.cursor = 'grabbing';
            });

            track.addEventListener('mouseup', (e) => {
                if (!isDragging) return;
                const diff = startX - e.clientX;
                if (Math.abs(diff) > 50) {
                    updateCarousel(diff > 0 ? current + 1 : current - 1);
                }
                isDragging = false;
                track.style.cursor = '';
            });

            track.addEventListener('mouseleave', () => {
                isDragging = false;
                track.style.cursor = '';
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') updateCarousel(current - 1);
                if (e.key === 'ArrowRight') updateCarousel(current + 1);
            });

            // Resize recalculate
            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => updateCarousel(current, false), 100);
            });

            // Initial render
            updateCarousel(0, false);
        })();
    </script>

</body>
</html>
