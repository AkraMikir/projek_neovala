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
        <div class="service-container">
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
    <section class="apartment-section" id="apartment-section">
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

    <!-- Guest Service Section -->
    <section class="guest-service-section" id="guest-service-section">
        <div class="guest-service-container">
            <div class="guest-service-content">
                <div class="guest-service-left">
                    <div class="guest-service-icon-wrapper">
                        <i class="bi bi-headset"></i>
                    </div>
                    <a href="{{ route('guestService') }}" class="guest-service-btn">LEARN MORE</a>
                </div>
                <div class="guest-service-right">
                    <h2 class="guest-service-title">GUEST SERVICE</h2>
                    <p class="guest-service-text">
                        Layanan pelanggan 24/7 untuk membantu kebutuhan Anda. Tim kami siap membantu dengan profesional dan ramah.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Titip Kunci Section -->
    <section class="titip-kunci-section" id="titip-kunci-section">
        <div class="titip-kunci-container">
            <img src="{{ asset('images/images/home pages/IMG_5703.webp') }}" alt="Background" class="titip-kunci-bg">
            <div class="titip-kunci-content">
                <h2 class="titip-kunci-title">JASA TITIP KUNCI SEWA APARTEMEN</h2>
                <div class="content-wrapper">
                    <div class="text-button-wrapper">
                        <p class="titip-kunci-text">
                            Unit Apartemen Tidak Ditinggali? Ubah Jadi Penghasilan! Solusi Praktis Untuk Pemilik Unit
                            Apartemen yang Tidak Tinggal di Tempat dan ingin jadi lebih bermanfaat.
                        </p>
                        <a href="{{ route('titipKunci') }}" class="view-more-btn">VIEW MORE</a>
                    </div>
                    <img src="{{ asset('images/logo/handshake-icon.webp') }}" alt="Handshake Icon"
                        class="handshake-icon">
                </div>
            </div>
        </div>
    </section>

    <section class="promo-section" id="promo-section">
        <h2 class="promo-title">PROMO CHECK-IN NEOVALA</h2>

        <div class="slider-container">
            @forelse($promos as $promo)
            <div class="card">
                <h3 class="card-title">{{ $promo->title }}</h3>
                <div class="card-image-wrapper">
                    <img src="{{ asset('storage/' . $promo->image) }}" alt="{{ $promo->title }}" class="card-image">
                </div>
                @if($promo->download_link)
                <a href="{{ asset('storage/' . $promo->download_link) }}" class="download-btn" target="_blank">DOWNLOAD
                    PROMO</a>
                @else
                <a href="#" class="download-btn" onclick="return false;">Download Promo</a>
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
            <a href="#" class="view-more-btn-promo">Selengkapnya</a>
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
    <section class="our-story-section" id="our-story-section">
        <div class="story-container">
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
                <a href="{{ route('ourStory') }}" class="read-more-btn">READ MORE</a>
            </div>
        </div>
    </section>

    <!-- Reviews Section (Tailwind) - sama seperti discover: carousel 90%, kartu ringkas, bintang coklat, tanpa media. Hanya tampil is_featured=1 & status=accepted -->
    <section id="comment-section" class="py-12 px-4 bg-stone-50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold text-amber-900 text-center mb-2">WHAT THEY SAY?</h2>
            <div class="border-b-2 border-amber-800 w-24 mx-auto mb-8"></div>

            <div id="reviews-aggregate" class="flex flex-wrap items-center justify-center gap-4 mb-6">
                <div class="text-center px-4">
                    <span class="text-3xl font-bold text-amber-800">{{ number_format($reviewAggregate['avg'] ?? 0, 1) }}</span>
                    <p class="text-sm text-stone-600">Rating rata-rata</p>
                </div>
                <div class="text-center px-4 border-l border-stone-300">
                    <span class="text-2xl font-semibold text-amber-800">{{ number_format($reviewAggregate['count'] ?? 0) }}</span>
                    <p class="text-sm text-stone-600">Ulasan</p>
                </div>
            </div>

            <div class="reviews-filter-bar flex flex-wrap gap-2 justify-center mb-6" data-location="">
                <span class="text-stone-600 text-sm">Filter:</span>
                @php
                    $sort = request('sort', 'latest');
                    $ratingFilter = request('rating');
                    $isTerbaru = !$ratingFilter && $sort === 'latest';
                    $isLongest = $sort === 'longest' && !$ratingFilter;
                @endphp
                <button type="button" class="reviews-filter-btn px-3 py-1 rounded {{ $isTerbaru ? 'bg-amber-800 text-white' : 'bg-stone-200 text-stone-700' }}" data-sort="latest" data-rating="">Terbaru</button>
                <button type="button" class="reviews-filter-btn px-3 py-1 rounded {{ $isLongest ? 'bg-amber-800 text-white' : 'bg-stone-200 text-stone-700' }}" data-sort="longest" data-rating="">Waktu terlama</button>
                @for ($r = 5; $r >= 1; $r--)
                    <button type="button" class="reviews-filter-btn px-3 py-1 rounded {{ $ratingFilter == $r ? 'bg-amber-800 text-white' : 'bg-stone-200 text-stone-700' }}" data-sort="latest" data-rating="{{ $r }}">{{ $r }} Bintang</button>
                @endfor
            </div>

            <div class="text-center mb-4">
                <a href="{{ route('reviews.detail') }}" class="text-[#674c1d] font-medium hover:underline">Lihat semua ulasan</a>
            </div>

            <div class="w-[90%] max-w-6xl mx-auto">
                <div class="reviews-slider-outer relative mb-10">
                    <button type="button" class="reviews-slider-btn reviews-slider-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 z-10 w-10 h-10 rounded-full bg-amber-800 text-white shadow-md hover:bg-amber-900 items-center justify-center transition-opacity disabled:pointer-events-none" style="display:none;" aria-label="Lihat ulasan sebelumnya">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button type="button" class="reviews-slider-btn reviews-slider-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-1 z-10 w-10 h-10 rounded-full bg-amber-800 text-white shadow-md hover:bg-amber-900 flex items-center justify-center transition-opacity disabled:opacity-0 disabled:pointer-events-none" aria-label="Lihat ulasan berikutnya">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <div id="reviews-list" class="reviews-slider-track flex gap-3 overflow-x-auto overflow-y-hidden py-2 px-1 scroll-smooth snap-x snap-mandatory" style="scrollbar-width: thin;">
                        @forelse($reviews as $review)
                            <div class="reviews-card relative flex-shrink-0 w-64 max-w-[85vw] snap-start bg-white rounded-lg shadow-sm p-3 border border-stone-100 flex flex-col justify-center min-h-[140px]">
                                <div class="reviews-card-inner">
                                    <p class="text-amber-900 font-semibold uppercase text-xs mb-0.5">{{ $review->location }}</p>
                                    <p class="text-stone-800 text-xs leading-snug line-clamp-4 mb-1.5">{{ $review->content }}</p>
                                    <div class="flex items-center gap-1 mb-0.5">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $review->rating ? 'text-[#674c1d]' : 'text-stone-200' }} text-xs"></i>
                                        @endfor
                                    </div>
                                    <p class="text-stone-500 text-[11px] truncate">{{ $review->hide_identity ? 'Anonymous' : '@' . ($review->instagram ?? '') }} · {{ $review->created_at->format('d M Y') }}</p>
                                    @if($review->replies->count() > 0)
                                        <div class="mt-2 relative">
                                            <button type="button" class="review-reply-toggle w-full text-left text-[11px] text-[#674c1d] font-medium flex items-center gap-1 hover:underline focus:outline-none" aria-expanded="false">
                                                <i class="fas fa-chevron-down review-reply-chevron text-[10px] transition-transform duration-200"></i>
                                                Balasan admin ({{ $review->replies->count() }})
                                            </button>
                                            <div class="review-reply-dropdown hidden absolute left-0 right-0 top-full mt-1 z-[50] pl-3 border-l-2 border-stone-400 bg-stone-100 rounded-r py-2 pr-2 shadow-lg min-w-[200px]">
                                                @foreach($review->replies as $reply)
                                                    <p class="text-[11px] text-[#674c1d] font-medium">{{ $reply->admin->name ?? 'Admin' }}</p>
                                                    <p class="text-[11px] text-stone-600 leading-tight">{{ $reply->content }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="flex-shrink-0 text-center text-stone-500 py-8 w-full text-sm">Belum ada ulasan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
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

    // Reviews filter (no refresh) + slider seperti discover
    (function() {
        const bar = document.querySelector('.reviews-filter-bar');
        const listEl = document.getElementById('reviews-list');
        const aggEl = document.getElementById('reviews-aggregate');
        if (!bar || !listEl || !aggEl) return;

        function renderCard(r) {
            const identity = r.hide_identity ? 'Anonymous' : ('@' + (r.instagram || ''));
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                stars += '<i class="fas fa-star ' + (i <= r.rating ? 'text-[#674c1d]' : 'text-stone-200') + ' text-xs"></i>';
            }
            let repliesHtml = '';
            if (r.replies && r.replies.length) {
                const replyBlocks = r.replies.map(function(rep) {
                    return '<p class="text-[11px] text-[#674c1d] font-medium">' + (rep.admin_name || 'Admin') + '</p><p class="text-[11px] text-stone-600 leading-tight">' + (rep.content || '') + '</p>';
                }).join('');
                repliesHtml = '<div class="mt-2 relative">' +
                    '<button type="button" class="review-reply-toggle w-full text-left text-[11px] text-[#674c1d] font-medium flex items-center gap-1 hover:underline focus:outline-none" aria-expanded="false">' +
                    '<i class="fas fa-chevron-down review-reply-chevron text-[10px] transition-transform duration-200"></i> Balasan admin (' + r.replies.length + ')</button>' +
                    '<div class="review-reply-dropdown hidden absolute left-0 right-0 top-full mt-1 z-[50] pl-3 border-l-2 border-stone-400 bg-stone-100 rounded-r py-2 pr-2 shadow-lg min-w-[200px]">' + replyBlocks + '</div></div>';
            }
            return '<div class="reviews-card relative flex-shrink-0 w-64 max-w-[85vw] snap-start bg-white rounded-lg shadow-sm p-3 border border-stone-100 flex flex-col justify-center min-h-[140px]">' +
                '<div class="reviews-card-inner">' +
                '<p class="text-amber-900 font-semibold uppercase text-xs mb-0.5">' + (r.location || '').toUpperCase() + '</p>' +
                '<p class="text-stone-800 text-xs leading-snug line-clamp-4 mb-1.5">' + (r.content || '') + '</p>' +
                '<div class="flex items-center gap-1 mb-0.5">' + stars + '</div>' +
                '<p class="text-stone-500 text-[11px] truncate">' + identity + ' · ' + (r.created_at || '') + '</p>' + repliesHtml + '</div></div>';
        }

        function setActiveBtn(activeBtn) {
            bar.querySelectorAll('.reviews-filter-btn').forEach(function(btn) {
                btn.classList.remove('bg-amber-800', 'text-white');
                btn.classList.add('bg-stone-200', 'text-stone-700');
            });
            activeBtn.classList.remove('bg-stone-200', 'text-stone-700');
            activeBtn.classList.add('bg-amber-800', 'text-white');
        }

        bar.querySelectorAll('.reviews-filter-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                setActiveBtn(this);
                const location = (bar.getAttribute('data-location') || '').trim();
                const sort = this.getAttribute('data-sort') || 'latest';
                const rating = (this.getAttribute('data-rating') || '').trim();

                const params = new URLSearchParams();
                if (location) params.set('location', location);
                params.set('sort', sort);
                if (rating) params.set('rating', rating);

                if (window.closeReviewsReplyDropdown) window.closeReviewsReplyDropdown();
                listEl.innerHTML = '<p class="flex-shrink-0 text-center text-stone-500 py-8 w-full text-sm">Memuat...</p>';
                fetch('/api/reviews?' + params.toString())
                    .then(function(res) { return res.json(); })
                    .then(function(data) {
                        aggEl.querySelector('.text-3xl').textContent = Number(data.aggregate.avg).toFixed(1);
                        aggEl.querySelector('.text-2xl').textContent = data.aggregate.count;
                        if (!data.reviews || data.reviews.length === 0) {
                            listEl.innerHTML = '<p class="flex-shrink-0 text-center text-stone-500 py-8 w-full text-sm">Belum ada ulasan.</p>';
                        } else {
                            listEl.innerHTML = data.reviews.map(renderCard).join('');
                        }
                        if (typeof updateReviewsSliderButtons === 'function') updateReviewsSliderButtons();
                    })
                    .catch(function() {
                        listEl.innerHTML = '<p class="flex-shrink-0 text-center text-stone-500 py-8 w-full text-sm">Gagal memuat ulasan.</p>';
                        if (typeof updateReviewsSliderButtons === 'function') updateReviewsSliderButtons();
                    });
            });
        });
    })();

    // Slider ulasan (utama): prev/next, sembunyikan tombol saat tidak ada overflow
    (function() {
        const sliderTrack = document.getElementById('reviews-list');
        const sliderPrev = document.querySelector('#comment-section .reviews-slider-prev');
        const sliderNext = document.querySelector('#comment-section .reviews-slider-next');
        if (!sliderTrack || !sliderPrev || !sliderNext) return;
        var CARD_GAP = 16;
        function getCardWidth() {
            var card = sliderTrack.querySelector('.reviews-card');
            return card ? card.offsetWidth + CARD_GAP : 304;
        }
        window.updateReviewsSliderButtons = function() {
            var hasCards = sliderTrack.querySelectorAll('.reviews-card').length > 0;
            if (!hasCards) {
                sliderPrev.style.setProperty('display', 'none');
                sliderNext.style.setProperty('display', 'none');
                return;
            }
            var tw = sliderTrack.scrollWidth;
            var cw = sliderTrack.clientWidth;
            var sl = Math.round(sliderTrack.scrollLeft);
            if (tw <= cw + 2) {
                sliderPrev.style.setProperty('display', 'none');
                sliderNext.style.setProperty('display', 'none');
                sliderPrev.disabled = true;
                sliderNext.disabled = true;
            } else {
                sliderPrev.style.setProperty('display', sl <= 2 ? 'none' : 'flex');
                sliderPrev.disabled = sl <= 2;
                sliderNext.style.setProperty('display', (sl + cw >= tw - 2) ? 'none' : 'flex');
                sliderNext.disabled = sl + cw >= tw - 2;
            }
        };
        sliderTrack.addEventListener('scroll', updateReviewsSliderButtons);
        sliderPrev.addEventListener('click', function() {
            sliderTrack.scrollBy({ left: -getCardWidth(), behavior: 'smooth' });
        });
        sliderNext.addEventListener('click', function() {
            sliderTrack.scrollBy({ left: getCardWidth(), behavior: 'smooth' });
        });
        updateReviewsSliderButtons();
        setTimeout(updateReviewsSliderButtons, 100);
        window.addEventListener('resize', updateReviewsSliderButtons);
    })();

    // Toggle balasan admin (utama): sama seperti discover, pindah ke slider-outer + position absolute
    (function() {
        var reviewsList = document.getElementById('reviews-list');
        var sliderOuter = document.querySelector('#comment-section .reviews-slider-outer');
        var openReplyDropdown = null;
        var openReplyBtn = null;
        window.closeReviewsReplyDropdown = function() { closeReplyDropdown(); };

        function closeReplyDropdown() {
            if (openReplyDropdown) {
                var parent = openReplyDropdown._originalParent;
                if (parent && document.body.contains(parent)) {
                    parent.appendChild(openReplyDropdown);
                } else if (openReplyDropdown.parentNode) {
                    openReplyDropdown.parentNode.removeChild(openReplyDropdown);
                }
                openReplyDropdown.classList.add('hidden');
                openReplyDropdown.style.cssText = '';
                if (openReplyBtn && document.body.contains(openReplyBtn)) {
                    openReplyBtn.setAttribute('aria-expanded', 'false');
                    var ch = openReplyBtn.querySelector('.review-reply-chevron');
                    if (ch) ch.style.transform = 'rotate(0deg)';
                }
                openReplyDropdown = null;
                openReplyBtn = null;
            }
            document.removeEventListener('click', closeReplyOnClickOutside);
        }

        function closeReplyOnClickOutside(ev) {
            if (openReplyDropdown && openReplyBtn && !openReplyDropdown.contains(ev.target) && !openReplyBtn.contains(ev.target)) {
                closeReplyDropdown();
            }
        }

        if (reviewsList && sliderOuter) {
            reviewsList.addEventListener('click', function(e) {
                var btn = e.target.closest('.review-reply-toggle');
                if (!btn) return;
                e.preventDefault();
                if (openReplyBtn === btn) {
                    closeReplyDropdown();
                    return;
                }
                var card = btn.closest('.reviews-card');
                var dropdown = card ? card.querySelector('.review-reply-dropdown') : null;
                if (!dropdown) return;
                closeReplyDropdown();
                var btnRect = btn.getBoundingClientRect();
                var outerRect = sliderOuter.getBoundingClientRect();
                dropdown._originalParent = dropdown.parentNode;
                sliderOuter.appendChild(dropdown);
                dropdown.classList.remove('hidden');
                var topPx = btnRect.bottom - outerRect.top + 4;
                var leftPx = btnRect.left - outerRect.left;
                dropdown.style.cssText = 'position:absolute;left:' + leftPx + 'px;top:' + topPx + 'px;width:' + Math.max(btnRect.width, 200) + 'px;min-width:200px;z-index:9999;';
                btn.setAttribute('aria-expanded', 'true');
                var chevron = btn.querySelector('.review-reply-chevron');
                if (chevron) chevron.style.transform = 'rotate(180deg)';
                openReplyDropdown = dropdown;
                openReplyBtn = btn;
                setTimeout(function() { document.addEventListener('click', closeReplyOnClickOutside); }, 0);
            });
        }
    })();
    </script>
@endpush
