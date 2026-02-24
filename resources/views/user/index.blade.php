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
            :mobile-images="[
                asset('images/images/drone_photo/SPL/DJI_20260102114312_0582_D.webp'),
                asset('images/images/drone_photo/PGV/DJI_20250307171441_0098_D.webp'),
                asset('images/images/drone_photo/PLU/DJI_20250321180704_0146_D.webp'),
                asset('images/images/drone_photo/GKL/DJI_20250327155321_0214_D.webp'),
                asset('images/images/drone_photo/GWC/gwc mobile.webp'),
                asset('images/images/drone_photo/TPJ/DJI_20250404164446_0282_D.webp'),
                asset('images/images/drone_photo/TPC/DJI_20250405123929_0314_D.webp'),
                asset('images/images/drone_photo/BSC/DJI_20250827131627_0494_D.webp'),
                asset('images/images/drone_photo/GPC/DJI_20250905143045_0548_D.webp')
            ]"
            hero-badge="Neovala ΓÇö Premium Apartment Rental"
            hero-title="Hunian Premium,<br><em>Pengalaman Istimewa</em>"
            hero-subtitle="Inovasi akomodasi modern dengan kenyamanan premium, layanan istimewa, dan desain elegan. Hadir di 9 lokasi strategis terbaik."
            hero-cta-text="Lihat Apartemen"
            hero-cta-url="#apartment-section"
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
                image="{{ asset('images/images/drone_photo/TPJ/DJI_20250404164408_0277_D.webp') }}"
                name="TRANSPARK JUANDA"
                :route="route('discoverTPJ')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/drone_photo/TPC/DJI_20250405123918_0311_D.webp') }}"
                name="TRANSPARK CIBUBUR"
                :route="route('discoverTPC')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/drone_photo/GKL/DJI_20250327153843_0201_D.webp') }}"
                name="GRAND KAMALA LAGOON"
                :route="route('discoverGKL')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/drone_photo/PLU/DJI_20250321180632_0140_D.webp') }}"
                name="PATRALAND URBANO"
                :route="route('discoverPLU')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/drone_photo/GWC/gwc desktop.webp') }}"
                name="GATEWAY CICADAS"
                :route="route('discoverGWC')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/drone_photo/PGV/DJI_20250307171436_0097_D.webp') }}"
                name="PODOMORO GOLF VIEW"
                :route="route('discoverPGV')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/drone_photo/GPC/DJI_20250905143026_0543_D.webp') }}"
                name="GREEN PRAMUKA CITY"
                :route="route('discoverGPC')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/drone_photo/BSC/DJI_20250827131520_0491_D.webp') }}"
                name="BASSURA CITY"
                :route="route('discoverBSC')"
            />
            <x-apartment-card 
                image="{{ asset('images/images/drone_photo/SPL/DJI_20260102114257_0580_D.webp') }}"
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
                        ORDER SEKARANG! Daftar jadi member <strong>NEOVRIENDS</strong>, dan segera dapatkan potongan harga dan cashback
                        <span class="fire-emoji" aria-label="hot">≡ƒöÑ</span><br>
                    </p>
                    <a href="{{ route('orderOnline') }}" target="_blank" rel="noopener noreferrer" class="neovriends-cta-btn">
                        <span>ORDER SEKARANG</span>
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
            menghadirkan promo eksklusif yang lebih mudah dan cepat untuk diakses. Tidak perlu repot ΓÇô cukup download
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

<!-- Reviews Section (Tailwind) - sama seperti discover: carousel 90%, kartu ringkas, bintang coklat, tanpa media. Hanya tampil is_featured=1 & status=accepted -->
<section id="comment-section" class="py-12 px-4 bg-stone-50">
    <div class="max-w-7xl mx-auto">
        {{-- Form ulasan halaman utama: desain sama discover + pilih apartemen --}}
        <div class="grid grid-cols-1 md:grid-cols-4 w-full gap-6 md:gap-9 max-w-6xl mx-auto items-stretch mb-12">
            <div class="col-span-4 md:col-span-3 flex flex-col min-w-0">
                <div
                    class="flex flex-col p-6 md:p-9 bg-white rounded-tr-[64px] rounded-es-[64px] shadow-lg border border-[#674c1d]/10 min-h-0">
                    <h2 class="text-xl font-semibold text-[#674c1d] mb-1" style="font-family: 'Georgia', serif;">GIVE US
                        FEEDBACK</h2>
                    <p class="text-[12px] text-[#674c1d]/70 mb-6">Bagikan cerita dan pendapatmu agar kami bisa
                        berkembang.</p>
                    <form action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data"
                        id="reviewFormHome">
                        @csrf
                        <div class="space-y-2 mb-4">
                            <label for="locationHome" class="text-[12px] font-semibold text-[#674c1d]">Pilih apartemen
                                *</label>
                            <select name="location" id="locationHome" required
                                class="w-full rounded-[8px] border border-[#674c1d]/35 py-2 px-3 text-sm text-[#674c1d] bg-white focus:outline-none focus:ring-1 focus:ring-[#674c1d]/30">
                                @foreach($locations ?? [] as $loc)
                                <option value="{{ $loc }}">
                                    {{ $loc === 'keseluruhan' ? 'Keseluruhan' : strtoupper($loc) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col md:flex-row md:space-x-6 md:gap-6">
                            <div class="flex flex-col w-full md:w-1/2 space-y-4">
                                <div class="space-y-2">
                                    <div class="flex flex-row justify-between items-center">
                                        <label class="text-[12px] font-semibold text-[#674c1d]">Instagram</label>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[12px] text-[#CFC3B7]">Samarkan</span>
                                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                                <input id="hideIdentityToggleHome" type="checkbox" name="hide_identity"
                                                    value="on" class="sr-only peer">
                                                <div
                                                    class="w-6 h-3.5 bg-gray-200 rounded-full peer-checked:bg-[#674c1d] transition-colors">
                                                </div>
                                                <span
                                                    class="absolute left-0.5 top-[1.5px] w-2.5 h-2.5 bg-white rounded-full border border-gray-300 transition-transform peer-checked:translate-x-[11px] pointer-events-none"
                                                    style="margin-left: 0;"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex rounded-[8px] border border-[#674c1d]/35 overflow-hidden">
                                        <span class="inline-flex items-center pl-3 text-[#674c1d]/80 text-sm">@</span>
                                        <input type="text" name="instagram"
                                            class="flex-1 min-w-0 py-2 pr-3 pl-1 text-sm text-[#674c1d] placeholder-[#CFC3B7] border-0 bg-transparent focus:outline-none focus:ring-0"
                                            placeholder="Username instagram Anda" maxlength="50">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[12px] font-semibold text-[#674c1d]">Gambar (max 5)</label>
                                    <div class="flex flex-wrap gap-3 items-center">
                                        <button type="button" id="addPhotoBtnHome"
                                            class="flex items-center justify-center w-12 h-12 rounded-[8px] border-2 border-dashed border-[#674c1d]/45 text-[#674c1d] hover:bg-stone-50 hover:border-[#674c1d]/65 transition-colors"
                                            title="Tambah foto">
                                            <i class="fas fa-plus text-lg"></i>
                                        </button>
                                        <span id="photoCountHome" class="text-[12px] text-[#674c1d]/60">0/5 foto</span>
                                    </div>
                                    <div id="photoSlotsHome" class="flex flex-wrap gap-2"></div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[12px] font-semibold text-[#674c1d]">Video (max 1)</label>
                                    <input type="file" name="video" id="videoInputHome" accept="video/*" class="hidden">
                                    <button type="button" id="addVideoBtnHome"
                                        class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-[8px] border-2 border-dashed border-[#674c1d]/45 text-[#674c1d] hover:bg-stone-50 hover:border-[#674c1d]/65 transition-colors text-sm">
                                        <i class="fas fa-video"></i>
                                        <span id="videoLabelHome">Tambah video</span>
                                    </button>
                                </div>
                            </div>
                            <div class="flex flex-col w-full md:w-1/2 space-y-4">
                                <div class="space-y-2">
                                    <label class="text-[12px] font-semibold text-[#674c1d]">Rating *</label>
                                    <input type="hidden" name="rating" id="ratingInputHome" value="0" required>
                                    <div class="flex gap-1.5" id="starSelectHome">
                                        @for ($i = 1; $i <= 5; $i++) <i
                                            class="far fa-star text-2xl cursor-pointer transition-colors text-[#674c1d] hover:text-[#5a4218]"
                                            data-rating="{{ $i }}"></i>
                                            @endfor
                                    </div>
                                </div>
                                <div class="space-y-2 flex-1 flex flex-col">
                                    <label class="text-[12px] font-semibold text-[#674c1d]">Bagaimana pengalaman anda?
                                        *</label>
                                    <textarea name="content" id="contentTextareaHome" rows="6"
                                        class="w-full rounded-[8px] border border-[#674c1d]/35 p-2 text-sm text-[#674c1d] placeholder-[#CFC3B7] focus:outline-none focus:ring-1 focus:ring-[#674c1d]/30 resize-y min-h-[120px]"
                                        placeholder="Bagikan pengalaman Anda dengan kami" required
                                        maxlength="2000"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-6">
                            <button type="submit" id="reviewSubmitBtnHome"
                                class="hidden py-3 px-6 rounded-[8px] bg-[#674c1d] text-white font-medium hover:bg-[#5a4218] transition-colors border border-[#674c1d]">Kirim</button>
                            <button type="button" id="reviewSubmitBtnDisabledHome" disabled
                                class="py-3 px-6 rounded-[8px] bg-[#F6EFE9] text-[#CFC3B7] font-medium cursor-not-allowed border border-[#CFC3B7]/50">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="feedbackCarouselOuterHome"
                class="col-span-1 hidden md:block min-h-[280px] md:min-h-0 h-full overflow-hidden rounded-tl-[96px] rounded-br-[96px] border border-[#674c1d]/10 shadow-lg bg-stone-100 relative">
                <div class="flex h-full min-h-[280px] md:min-h-full">
                    <img src="{{ asset('images/images/home pages/DJI_20250307171433_0096_D.webp') }}" alt=""
                        class="h-full w-full object-cover">
                </div>
            </div>
        </div>

        {{-- Loading overlay saat kirim ulasan (form home) --}}
        <div id="reviewLoadingOverlayHome"
            class="fixed inset-0 z-[9999] hidden flex items-center justify-center bg-black/30 backdrop-blur-sm transition-opacity duration-200"
            aria-hidden="true">
            <div
                class="bg-white rounded-2xl shadow-2xl px-8 py-6 flex flex-col items-center gap-4 min-w-[200px] border border-[#674c1d]/20">
                <i class="fas fa-circle-notch fa-spin text-3xl text-[#674c1d]"></i>
                <p class="text-[#674c1d] font-medium text-center">Mengirim ulasan...</p>
                <p class="text-stone-500 text-sm text-center">Mohon tunggu sebentar</p>
            </div>
        </div>

        <h2 class="text-2xl md:text-3xl font-bold text-amber-900 text-center mb-2">WHAT THEY SAY?</h2>
        <div class="border-b-2 border-amber-800 w-24 mx-auto mb-8"></div>

        <div id="reviews-aggregate" class="flex flex-wrap items-center justify-center gap-4 mb-6">
            <div class="text-center px-4">
                <span
                    class="text-3xl font-bold text-amber-800">{{ number_format($reviewAggregate['avg'] ?? 0, 1) }}</span>
                <p class="text-sm text-stone-600">Rating rata-rata</p>
            </div>
            <div class="text-center px-4 border-l border-stone-300">
                <span
                    class="text-2xl font-semibold text-amber-800">{{ number_format($reviewAggregate['count'] ?? 0) }}</span>
                <p class="text-sm text-stone-600">Ulasan</p>
            </div>
        </div>

        <div class="reviews-widget-filter-container bg-white rounded-xl border border-stone-200 shadow-sm p-4 md:p-5 mb-6" data-current-location="">
            <div class="reviews-widget-filter-row flex flex-wrap gap-3 items-center">
                <div class="flex items-center gap-2 w-full md:w-auto">
                    <label class="text-stone-600 text-sm font-medium shrink-0">Lokasi:</label>
                    <select id="reviews-widget-location" class="rounded-lg border border-[#674c1d]/40 px-3 py-2 text-sm text-[#674c1d] bg-white focus:ring-2 focus:ring-[#674c1d]/30 focus:border-[#674c1d]">
                        <option value="">Semua</option>
                        @foreach($locations ?? [] as $loc)
                            @if($loc !== 'keseluruhan')
                            <option value="{{ $loc }}" {{ request('location') === $loc ? 'selected' : '' }}>{{ strtoupper($loc) }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[180px]">
                    <input type="text" id="reviews-widget-search" class="w-full rounded-lg border border-[#674c1d]/40 px-3 py-2 text-sm text-[#674c1d] placeholder-stone-400 bg-white focus:ring-2 focus:ring-[#674c1d]/30 focus:border-[#674c1d]" placeholder="Cari dalam ulasan..." value="{{ request('q', '') }}" autocomplete="off">
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-stone-200 flex flex-wrap gap-3 justify-center md:justify-start items-center">
                <span class="text-stone-600 text-sm font-medium shrink-0">Filter:</span>
                @php
                    $isSemuaActive = !request('rating') && !request('has_media') && !request('keyword');
                    $isTerbaruActive = !$isSemuaActive && request('sort', 'latest') === 'latest' && !request('rating');
                @endphp
                <button type="button" class="reviews-widget-filter-btn px-3 py-1.5 rounded-lg text-sm {{ $isSemuaActive ? 'bg-amber-800 text-white reviews-widget-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="latest" data-rating="" data-filter-type="all">Semua</button>
                <button type="button" class="reviews-widget-filter-btn px-3 py-1.5 rounded-lg text-sm {{ $isTerbaruActive ? 'bg-amber-800 text-white reviews-widget-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="latest" data-rating="">Terbaru</button>
                <button type="button" class="reviews-widget-filter-btn px-3 py-1.5 rounded-lg text-sm {{ request('sort') === 'popular' ? 'bg-amber-800 text-white reviews-widget-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="popular" data-rating=""><i class="fas fa-thumbs-up text-xs mr-1"></i>Terpopuler</button>
                <button type="button" class="reviews-widget-filter-btn px-3 py-1.5 rounded-lg text-sm {{ request('sort') === 'longest' ? 'bg-amber-800 text-white reviews-widget-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="longest" data-rating="">Waktu terlama</button>
                @for ($r = 5; $r >= 1; $r--)
                <button type="button" class="reviews-widget-filter-btn px-3 py-1.5 rounded-lg text-sm {{ request('rating') == $r ? 'bg-amber-800 text-white reviews-widget-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-sort="latest" data-rating="{{ $r }}">{{ $r }} Bintang</button>
                @endfor
                <button type="button" class="reviews-widget-filter-btn reviews-widget-has-media px-3 py-1.5 rounded-lg text-sm {{ request('has_media') ? 'bg-amber-800 text-white reviews-widget-active' : 'bg-stone-200 text-stone-700 hover:bg-stone-300' }}" data-has-media="1">Foto/Video ({{ $reviewAggregate['count_has_media'] ?? 0 }})</button>
                <div id="reviews-widget-keywords" class="flex flex-wrap gap-2 items-center"></div>
            </div>
        </div>

        <div class="text-center mb-4">
            <a href="{{ route('reviews.detail') }}" class="text-[#674c1d] font-medium hover:underline">Lihat semua
                ulasan</a>
        </div>

        <div class="w-[100%] max-w-7xl mx-auto">
            <div class="reviews-slider-outer relative mb-10">
                <button type="button"
                    class="reviews-slider-btn reviews-slider-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 z-10 w-10 h-10 rounded-full bg-amber-800 text-white shadow-md hover:bg-amber-900 items-center justify-center transition-opacity disabled:pointer-events-none"
                    style="display:none;" aria-label="Lihat ulasan sebelumnya">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button"
                    class="reviews-slider-btn reviews-slider-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-1 z-10 w-10 h-10 rounded-full bg-amber-800 text-white shadow-md hover:bg-amber-900 flex items-center justify-center transition-opacity disabled:opacity-0 disabled:pointer-events-none"
                    aria-label="Lihat ulasan berikutnya">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div id="reviews-list"
                    class="reviews-slider-track flex gap-3 overflow-x-auto overflow-y-hidden py-2 pl-3 pr-2 scroll-smooth snap-x snap-mandatory"
                    style="scrollbar-width: thin;">
                    @forelse($reviews as $review)
                    <div class="reviews-card reviews-card-clickable relative flex-shrink-0 w-64 max-w-[85vw] snap-start bg-white rounded-lg shadow-sm pt-1 px-3 pb-3 border border-stone-100 flex flex-col justify-center min-h-[140px]" data-review-id="{{ $review->id }}">
                        <a href="{{ route('reviews.detail') }}?pin={{ $review->id }}" class="reviews-card-link block h-full min-h-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#674c1d]/40 focus:ring-offset-1">
                            <div class="reviews-card-inner h-[100%]">
                                <p
                                    class="text-amber-900 font-semibold uppercase text-xs mb-0.5 text-center min-h-[2rem] flex items-center justify-center leading-tight">
                                    {{ \App\Models\Review::locationDisplay($review->location) }}</p>
                                <p class="text-stone-800 text-xs leading-snug line-clamp-4 mb-1.5">{{ $review->content }}
                                </p>
                                <div class="flex items-center gap-1 mb-0.5">
                                    @for ($i = 1; $i <= 5; $i++) <i
                                        class="fas fa-star {{ $i <= $review->rating ? 'text-[#674c1d]' : 'text-stone-200' }} text-xs">
                                        </i>
                                        @endfor
                                </div>
                                <div class="flex items-center justify-between mt-0.5">
                                    <p class="text-stone-500 text-[11px] truncate">
                                        {{ $review->hide_identity ? 'Anonymous' : '@' . ($review->instagram ?? '') }} ·
                                        {{ $review->created_at->format('d M Y') }}</p>
                                    <button type="button"
                                        class="review-like-btn flex items-center gap-1 text-[10px] text-stone-400 hover:text-[#674c1d] transition-colors focus:outline-none flex-shrink-0 ml-1"
                                        data-review-id="{{ $review->id }}"
                                        title="Suka">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span class="review-like-count">{{ $review->likes ?? 0 }}</span>
                                    </button>
                                </div>
                                @if($review->replies->count() > 0)
                                <div class="mt-2 relative">
                                    <button type="button"
                                        class="review-reply-toggle w-full text-left text-[11px] text-[#674c1d] font-medium flex items-center gap-1 hover:underline focus:outline-none"
                                        aria-expanded="false">
                                        <i
                                            class="fas fa-chevron-down review-reply-chevron text-[10px] transition-transform duration-200"></i>
                                        Balasan admin ({{ $review->replies->count() }})
                                    </button>
                                    <div
                                        class="review-reply-dropdown hidden absolute left-0 right-0 top-full mt-1 z-[50] pl-3 border-l-2 border-stone-400 bg-stone-100 rounded-r py-2 pr-2 shadow-lg min-w-[200px]">
                                        @foreach($review->replies as $reply)
                                        <p class="text-[11px] text-[#674c1d] font-medium">
                                            {{ $reply->admin->name ?? 'Admin' }}</p>
                                        <p class="text-[11px] text-stone-600 leading-tight">{{ $reply->content }}</p>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if($review->media->count() > 0)
                                <div class="reviews-card-media mt-2 flex flex-wrap gap-1">
                                    @foreach($review->media->where('type', 'image') as $m)
                                    @php $url = asset('storage/' . $m->file_path); @endphp
                                    <button type="button" class="review-widget-media-preview w-9 h-9 rounded border border-[#674c1d]/30 overflow-hidden flex-shrink-0 focus:outline-none focus:ring-2 focus:ring-[#674c1d]/50" data-src="{{ $url }}" data-type="image" aria-label="Perbesar gambar">
                                        <img src="{{ $url }}" alt="" class="w-full h-full object-cover">
                                    </button>
                                    @endforeach
                                    @php $video = $review->media->where('type', 'video')->first(); @endphp
                                    @if($video)
                                    @php $videoUrl = asset('storage/' . $video->file_path); @endphp
                                    <button type="button" class="review-widget-media-preview relative w-9 h-9 rounded border border-[#674c1d]/30 overflow-hidden flex-shrink-0 bg-stone-100 focus:outline-none focus:ring-2 focus:ring-[#674c1d]/50" data-src="{{ $videoUrl }}" data-type="video" aria-label="Putar video">
                                        <video src="{{ $videoUrl }}" class="w-full h-full object-cover pointer-events-none" preload="metadata" muted></video>
                                        <span class="absolute inset-0 flex items-center justify-center bg-black/30"><i class="fas fa-play text-white text-xs"></i></span>
                                    </button>
                                    @endif
                                </div>
                                @endif
                            </div>
                            <span class="reviews-card-more absolute right-2 bottom-2 text-[10px] font-medium bg-gradient-to-r from-amber-600 to-[#674c1d] bg-clip-text text-transparent lg:hidden">Lihat selengkapnya &gt;</span>
                        </a>
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
    </script>
@endpush
