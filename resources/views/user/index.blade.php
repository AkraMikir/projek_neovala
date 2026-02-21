@extends('layouts.app')

@section('title', 'Neovala - Premium Apartment Rental')

@section('content')
    <!-- Header dengan Carousel -->
    <header class="header" id="home">
        <x-carousel 
            :images="[
                asset('images/images/home pages/Copy of DJI_20260102114259_0581_D.webp'),
                asset('images/images/home pages/DJI_20250307171433_0096_D.webp'),
                asset('images/images/home pages/DJI_20250321175315_0129_D.webp'),
                asset('images/images/home pages/DJI_20250327155326_0216_D.webp'),
                asset('images/images/home pages/DJI_20250403160456_0254_D.webp'),
                asset('images/images/home pages/DJI_20250404164436_0280_D.webp'),
                asset('images/images/home pages/DJI_20250405123913_0309_D.webp'),
                asset('images/images/home pages/DJI_20250827130441_0466_D.webp'),
                asset('images/images/home pages/DJI_20250905143026_0543_D.webp')
            ]"
            overlay-text="Inovasi akomodasi modern dengan kenyamanan premium, layanan istimewa, dan desain elegan. Hadir untuk memberikan pengalaman menginap yang berkesan dan solusi hunian terbaik."
        />
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="service-container" data-scroll-animate="fade-up">
            <div class="service-item">
                <img src="{{ asset('images/logo/icon1 1.webp') }}" alt="Layanan 1">
                <p>BISA BAYAR DI TEMPAT</p>
            </div>
            <div class="service-item">
                <img src="{{ asset('images/logo/icon2 1.webp') }}" alt="Layanan 2">
                <p>BANYAK PROMO MENARIK</p>
            </div>
            <div class="service-item">
                <img src="{{ asset('images/logo/calendar 1.webp') }}" alt="Layanan 3">
                <p>PERUBAHAN JADWAL CHECK-IN MUDAH</p>
            </div>
            <div class="service-item">
                <img src="{{ asset('images/logo/bed 1.webp') }}" alt="Layanan 4">
                <p>KAMAR BERSIH DAN NYAMAN</p>
            </div>
            <div class="service-item">
                <img src="{{ asset('images/logo/24-hour-service 1.webp') }}" alt="Layanan 5">
                <p>BUKA 24 JAM</p>
            </div>
            <div class="service-item">
                <img src="{{ asset('images/logo/hugeicons_shampoo.webp') }}" alt="Layanan 6">
                <p>AMENITIS LENGKAP</p>
            </div>
        </div>
    </main>
    <!-- main contant selesai -->

    <!-- Book Now Button -->
    <div class="book-now-container">
        <a href="{{ route('bookNow') }}" class="book-now-btn">
            <div class="book-now-icon"><img src="{{ asset('images/logo/book-now.webp') }}" alt=""></div>
            <span>BOOK NOW</span>
        </a>
    </div>

    <!-- Apartment Section -->
    <section class="apartment-section" id="apartment-section" data-scroll-animate="fade-up">
        <h2 class="apartment-title">WE ARE AVAILABLE AT</h2>
        <div class="apartment-container">

            <!-- Apartment Cards -->
            <x-apartment-card 
                image="{{ asset('images/images/home pages/IMG_0020 (Copy).webp') }}"
                name="TRANSPARK JUANDA"
                :route="route('discoverTPJ')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/home pages/IMG_9497.webp') }}"
                name="TRANSPARK CIBUBUR"
                :route="route('discoverTPC')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/home pages/IMG_0117 (Copy).webp') }}"
                name="GRAND KAMALA LAGOON"
                :route="route('discoverGKL')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/home pages/IMG_1073.webp') }}"
                name="PATRALAND URBANO"
                :route="route('discoverPLU')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/home pages/IMG_3976.webp') }}"
                name="GATEWAY CICADAS"
                :route="route('discoverGWC')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/home pages/IMG_0362.webp') }}"
                name="PODOMORO GOLF VIEW"
                :route="route('discoverPGV')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/discover-GPC/IMG_0646.webp') }}"
                name="GREEN PRAMUKA CITY"
                :route="route('discoverGPC')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/discover-BSC/IMG_1882.webp') }}"
                name="BASSURA CITY"
                :route="route('discoverBSC')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/discover-SPL/IMG_9338.webp') }}"
                name="SPRINGLAKE SUMMARECON"
                :route="route('discoverSPL')"
            />
        </div>
    </section>

    <!-- NEOVRIENDS + Guest Service Cards (compact, modern) -->
    <section class="cta-cards-wrapper" data-scroll-animate="fade-up">
        <!-- NEOVRIENDS / Booking CTA Card - hot deal -->
        <div class="neovriends-cta-section" data-scroll-animate="fade-up">
            <div class="neovriends-cta-card">
                <div class="neovriends-cta-corner-fire" aria-hidden="true">
                    <i class="bi bi-fire"></i>
                </div>
                <div class="neovriends-cta-gradient"></div>
                <div class="neovriends-cta-fire-glow" aria-hidden="true"></div>
                <div class="neovriends-cta-content">
                    <div class="neovriends-cta-badge">
                        <i class="bi bi-fire"></i>
                        <span>Hot Deal</span>
                    </div>
                    <p class="neovriends-cta-text">
                        Booking sekarang! Daftar jadi member <strong>NEOVRIENDS</strong>, dan segera dapatkan potongan harga dan cashback
                        <span class="fire-emoji" aria-label="hot">🔥</span><br>
                        Sewa apartemen murah, nyaman, dan privacy hanya di NEOVALA.
                    </p>
                    <a href="{{ route('bookNow') }}" class="neovriends-cta-btn">
                        <span>BOOKING SEKARANG</span>
                        <i class="bi bi-arrow-right-circle-fill neovriends-cta-btn-icon"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Guest Service Card -->
        <section class="guest-service-section" id="guest-service-section" data-scroll-animate="fade-up">
            <div class="guest-service-container">
                <div class="guest-service-gradient" aria-hidden="true"></div>
                <div class="guest-service-content">
                    <div class="guest-service-left">
                        <div class="guest-service-icon-wrapper">
                            <i class="bi bi-headset"></i>
                        </div>
                        <a href="{{ route('guestService') }}" class="guest-service-btn">
                            <i class="bi bi-arrow-right-short"></i>
                            <span>LEARN MORE</span>
                        </a>
                    </div>
                    <div class="guest-service-right">
                        <h2 class="guest-service-title">
                            <i class="bi bi-telephone-outbound"></i>
                            GUEST SERVICE
                        </h2>
                        <p class="guest-service-text">
                            Layanan pelanggan 24/7 untuk membantu kebutuhan Anda. Tim kami siap membantu dengan profesional dan ramah.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!-- Titip Kunci Section -->
    <section class="titip-kunci-section" id="titip-kunci-section" data-scroll-animate="fade-up">
        <div class="titip-kunci-container">
            <img src="{{ asset('images/images/home pages/IMG_5703.webp') }}" alt="Background" class="titip-kunci-bg">
            <div class="titip-kunci-gradient" aria-hidden="true"></div>
            <div class="titip-kunci-content">
                <h2 class="titip-kunci-title">JASA TITIP KUNCI SEWA APARTEMEN</h2>
                <div class="content-wrapper">
                    <div class="text-button-wrapper">
                        <p class="titip-kunci-text">
                            Unit Apartemen Tidak Ditinggali? Ubah Jadi Penghasilan! Solusi Praktis Untuk Pemilik Unit
                            Apartemen yang Tidak Tinggal di Tempat dan ingin jadi lebih bermanfaat.
                        </p>
                        <a href="{{ route('titipKunci') }}" class="view-more-btn">
                            <i class="bi bi-arrow-right-short"></i>
                            <span>VIEW MORE</span>
                        </a>
                    </div>
                    <img src="{{ asset('images/logo/handshake-icon.webp') }}" alt="Handshake Icon"
                        class="handshake-icon">
                </div>
            </div>
        </div>
    </section>

    <section class="promo-section" id="promo-section" data-scroll-animate="fade-up">
        <h2 class="promo-title">PROMO CHECK-IN NEOVALA</h2>

        <div class="slider-container">
            @forelse($promos as $promo)
            <div class="card" data-scroll-animate="fade-up">
                <h3 class="card-title">{{ $promo->title }}</h3>
                <div class="card-image-wrapper">
                    <img src="{{ asset('storage/' . $promo->image) }}" alt="{{ $promo->title }}" class="card-image">
                </div>
                @if($promo->download_link)
                <a href="{{ asset('storage/' . $promo->download_link) }}" class="download-btn" target="_blank">
                    <i class="bi bi-download"></i>
                    <span>DOWNLOAD PROMO</span>
                </a>
                @else
                <a href="#" class="download-btn" onclick="return false;">
                    <i class="bi bi-download"></i>
                    <span>Download Promo</span>
                </a>
                @endif
            </div>
            @empty
            <p>Tidak ada promo tersedia.</p>
            @endforelse
        </div>


        <p class="promo-text">
            Nikmati Promo Eksklusif dengan Mudah!
            Kami di Neovala selalu berkomitmen untuk memberikan pengalaman terbaik bagi pelanggan kami. Kini, kami
            menghadirkan promo eksklusif yang lebih mudah dan cepat untuk diakses. Tidak perlu repot – cukup download
            gambar promo yang sudah kami sediakan di website ini, dan Anda langsung dapat mengajukan promo yang
            diinginkan.
        </p>
        <div style="text-align:center; margin-top: 30px;">
            <a href="#" class="view-more-btn-promo">
                <span>Selengkapnya</span>
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>
    </section>

    <!-- Popup Modal Cara Apply Promo -->
    <div id="promoModal" class="promo-modal" style="display:none;">
        <div class="promo-modal-overlay"></div>
        <div class="promo-modal-content">
            <button class="promo-modal-close" id="closePromoModal" aria-label="Tutup">&times;</button>
            <h2 class="promo-modal-title">CARA DOWNLOAD PROMO DI WEBSITE NEOVALA</h2>
            <div class="promo-modal-body">
                <p>Kami telah membuat proses mendapatkan promo lebih mudah dan praktis bagi Anda. Ikuti langkah-langkah
                    berikut untuk menikmati promo eksklusif kami:</p>
                <b>Langkah 1: Kunjungi Halaman Promo</b>
                <ol>
                    <li>Buka website Neovala dan temukan halaman Promo yang kami sediakan.</li>
                    <li>Di halaman tersebut, Anda akan melihat berbagai gambar promo yang dapat diunduh.</li>
                </ol>
                <b>Langkah 2: Pilih Promo yang Anda Inginkan</b>
                <ol>
                    <li>Telusuri gambar promo yang tersedia di halaman.</li>
                    <li>Pilih promo yang sesuai dengan kebutuhan Anda. Setiap gambar promo mewakili penawaran khusus
                        yang dapat Anda nikmati.</li>
                </ol>
                <b>Langkah 3: Klik dan Download Gambar Promo</b>
                <ol>
                    <li>Setelah Anda memilih gambar promo, klik pada gambar tersebut.</li>
                    <li>Gambar promo akan terbuka dalam ukuran penuh.</li>
                    <li>Klik tombol Download yang terletak di bagian bawah gambar atau klik kanan pada gambar dan pilih
                        Save As untuk menyimpan gambar promo ke perangkat Anda.</li>
                </ol>
                <b>Langkah 4: Kirim Gambar Promo ke Admin</b>
                <ol>
                    <li>Setelah gambar promo berhasil diunduh, buka aplikasi pesan atau email di perangkat Anda.</li>
                    <li>Kirim gambar yang sudah Anda download ke admin apartemen Neovala yang tertera di halaman promo.
                    </li>
                    <li>Sertakan informasi yang diperlukan (misalnya, nama, unit apartemen, atau tanggal pengajuan)
                        untuk mempercepat proses verifikasi.</li>
                </ol>
                <b>Langkah 5: Admin Proses dan Verifikasi</b>
                <ol>
                    <li>Tim admin kami akan menerima gambar promo yang Anda kirimkan dan memprosesnya.</li>
                    <li>Anda akan segera mendapatkan konfirmasi dan instruksi lebih lanjut mengenai cara menikmati promo
                        tersebut.</li>
                </ol>
                <p>Dengan langkah-langkah ini, Anda bisa dengan mudah mendapatkan promo eksklusif dari Neovala. Jangan
                    lewatkan kesempatan luar biasa ini untuk menikmati penawaran spesial kami!</p>
                <p>Jika ada pertanyaan lebih lanjut atau kesulitan, tim kami siap membantu Anda kapan saja.</p>
            </div>
        </div>
    </div>

    <!-- Our Story Section -->
    <section class="our-story-section" id="our-story-section" data-scroll-animate="fade-up">
        <div class="story-container">
            <div class="story-container-gradient" aria-hidden="true"></div>
            <div class="story-content">
                <h2 class="story-title">OUR STORY</h2>
                <p class="story-text">
                    Neovala
                    Rooms adalah
                    penyedia akomodasi mewah
                    di Indonesia yang berfokus
                    pada kualitas, kenyamanan,
                    dan layanan istimewa.

                    Kami menawarkan hunian
                    modern dengan desain
                    elegan
                    dan
                    fasilitas
                    premium, tersedia untuk
                    jangka pendek maupun
                    panjang.
                </p>
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon-wrapper">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <span>telp. 0896-6964-9690</span>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon-wrapper">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <span>Jl. Insinyur H. Juanda No.19, RT.003/RW.011, Margahayu, Kec. Bekasi Tim., Kota Bks, Jawa
                            Barat 17113</span>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon-wrapper">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <span>Email. neovalaofficial@gmail.com</span>
                    </div>
                </div>
            </div>
            <div class="story-image-container">
                <div class="story-image">
                    <img src="{{ asset('images/logo/story.webp') }}" alt="Neovala Building">
                </div>
                <a href="{{ route('ourStory') }}" class="read-more-btn">
                    <span>READ MORE</span>
                    <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Comment Section -->
    <section class="comment-section" id="comment-section" data-scroll-animate="fade-up">
        <h2 class="comment-title">WHAT THEY SAY?</h2>
        <div class="comment-container">
            @foreach ($komentars as $komentar)
                <x-comment-card :komentar="$komentar" />
            @endforeach
        </div>
    </section>
@endsection

@push('scripts')
    <script>
    // Ensure body scroll is restored on page load if modal is not active
    document.addEventListener('DOMContentLoaded', function() {
        const promoModal = document.getElementById('promoModal');
        if (promoModal && promoModal.style.display !== 'block') {
            // Check if any popup is active
            const activePopups = document.querySelectorAll('.popup-overlay[style*="flex"], .popup-overlay.active');
            const promoPopup = document.getElementById('popup-overlay');
            const promoPopupActive = promoPopup && promoPopup.classList.contains('active');
            
            if (activePopups.length === 0 && !promoPopupActive) {
                document.body.style.overflow = 'auto';
            }
        }
    });

    // Promo Modal Script
    document.querySelectorAll('.view-more-btn-promo').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const promoModal = document.getElementById('promoModal');
            if (promoModal) {
                promoModal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
        });
    });

    // Function to close promo modal and restore scroll
    function closePromoModal() {
        const promoModal = document.getElementById('promoModal');
        if (promoModal) {
            promoModal.style.display = 'none';
            
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

    const closePromoModalBtn = document.getElementById('closePromoModal');
    if (closePromoModalBtn) {
        closePromoModalBtn.onclick = closePromoModal;
    }

    const promoModalOverlay = document.querySelector('.promo-modal-overlay');
    if (promoModalOverlay) {
        promoModalOverlay.onclick = closePromoModal;
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const promoModal = document.getElementById('promoModal');
            if (promoModal && promoModal.style.display === 'block') {
                closePromoModal();
            }
        }
    });

    // Smooth scrolling to hash
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1); // get the section id
            document.getElementById(targetId).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    </script>
@endpush
