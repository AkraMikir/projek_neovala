<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/footer-logo.png') }}">
    <title>Neovala</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
    html {
        scroll-behavior: smooth;
    }
    </style>

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
                <a href="{{ route('home') }}#home "><img src="{{ asset('images/logo/NEOVALA TRANSPARENT 1.png') }}"
                        alt="Logo Neovala Light" class="logo-light"></a>
                <a href="{{ route('home') }}#home"><img src="{{ asset('images/logo/NEOVALA-DARK.png') }}"
                        alt="Logo Neovala Dark" class="logo-dark"></a>
            </div>
            <ul class="nav-links">
                <li><a href="#apartment-section"><i class="bi bi-building"></i> Apartment</a></li>
                <li><a href="#titip-kunci-section"><i class="bi bi-key"></i> Titip Kunci</a></li>
                <li><a href="#promo-section"><i class="bi bi-gift"></i> Promo</a></li>
                <li><a href="#our-story-section"><i class="bi bi-people"></i> About Us</a></li>
                <li><a href="#comment-section"><i class="bi bi-chat-dots"></i> Testimoni</a></li>
                <li><a href="#footer"><i class="bi bi-geo-alt"></i> Find Us</a></li>
                <div class="sidebar-footer">
                    <p><img src="{{ asset('images/logo/NEOVALA-DARK.png') }}" alt="Logo Neovala Dark"
                            class="logo-sidebar">NEOVALA</p>
                </div>
            </ul>
            <div class="logo-right"><a href="{{ route('home') }}#home">NEOVALA</a></div>
        </div>
    </nav>
    <div class="nav-overlay"></div>

    <!-- Header dengan Carousel -->
    <header class="header" id="home">
        <div class="carousel">
            <!-- Tambahkan overlay text -->
            <div class="header-text-overlay">
                <p> Inovasi akomodasi modern dengan kenyamanan premium, layanan istimewa, dan
                    desain elegan. Hadir untuk memberikan pengalaman menginap yang berkesan dan
                    solusi hunian terbaik.</p>
            </div>

            <button class="carousel-button prev">&#10094;</button>
            <button class="carousel-button next">&#10095;</button>

            <div class="carousel-container">
                <div class="carousel-slide">
                    <img src="{{ asset('images/images/home pages/IMG_0115 (Copy).jpg') }}" alt="Slide 1">
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/images/home pages/IMG_0020 (Copy).jpg') }}" alt="Slide 2">
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/images/home pages/IMG_0362.png') }}" alt="Slide 3">
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/images/home pages/IMG_1073.png') }}" alt="Slide 4">
                </div>
            </div>

            <div class="carousel-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="service-container">
            <div class="service-item">
                <img src="{{ asset('images/logo/icon1 1.png') }}" alt="Layanan 1">
                <p>BISA BAYAR DI TEMPAT</p>
            </div>
            <div class="service-item">
                <img src="{{ asset('images/logo/icon2 1.png') }}" alt="Layanan 2">
                <p>BANYAK PROMO MENARIK</p>
            </div>
            <div class="service-item">
                <img src="{{ asset('images/logo/calendar 1.png') }}" alt="Layanan 3">
                <p>PERUBAHAN JADWAL CHECK-IN MUDAH</p>
            </div>
            <div class="service-item">
                <img src="{{ asset('images/logo/bed 1.png') }}" alt="Layanan 4">
                <p>KAMAR BERSIH DAN NYAMAN</p>
            </div>
            <div class="service-item">
                <img src="{{ asset('images/logo/24-hour-service 1.png') }}" alt="Layanan 5">
                <p>BUKA 24 JAM</p>
            </div>
            <div class="service-item">
                <img src="{{ asset('images/logo/hugeicons_shampoo.png') }}" alt="Layanan 6">
                <p>AMENITIS LENGKAP</p>
            </div>
        </div>
    </main>
    <!-- main contant selesai -->

    <!-- Book Now Button -->
    <div class="book-now-container">
        <a href="{{ route('bookNow') }}" class="book-now-btn">
            <div class="book-now-icon"><img src="{{ asset('images/logo/book-now.png') }}" alt=""></div>
            <span>BOOK NOW</span>
        </a>
    </div>

    <!-- Apartment Section -->
    <section class="apartment-section" id="apartment-section">
        <h2 class="apartment-title">WE ARE AVAILABLE AT</h2>
        <div class="apartment-container">

            <!-- Apartment Card 1 -->
            <div class="apartment-card">
                <div class="apartment-image">
                    <img src="{{ asset('images/images/home pages/IMG_0020 (Copy).jpg') }}" alt="Apartment 1">
                    <div class="apartment-content">
                        <h3 class="apartment-name">TRANSPARK JUANDA</h3>
                        <a href="{{ route('discoverTPJ') }}" class="view-details-btn">DISCOVER</a>
                    </div>
                </div>
            </div>

            <!-- Apartment Card 2 -->
            <div class="apartment-card">
                <div class="apartment-image">
                    <img src="{{ asset('images/images/home pages/IMG_9497.png') }}" alt="Apartment 2">
                    <div class="apartment-content">
                        <h3 class="apartment-name">TRANSPARK CIBUBUR</h3>
                        <a href="{{ route('discoverTPC') }}" class="view-details-btn">DISCOVER</a>
                    </div>
                </div>
            </div>

            <!-- Apartment Card 3 -->
            <div class="apartment-card">
                <div class="apartment-image">
                    <img src="{{ asset('images/images/home pages/IMG_0117 (Copy).jpg') }}" alt="Apartment 3">
                    <div class="apartment-content">
                        <h3 class="apartment-name">GRAND KAMALA LAGOON</h3>
                        <a href="{{ route('discoverGKL') }}" class="view-details-btn">DISCOVER</a>
                    </div>
                </div>
            </div>

            <!-- Apartment Card 4 -->
            <div class="apartment-card">
                <div class="apartment-image">
                    <img src="{{ asset('images/images/home pages/IMG_1073.png') }}" alt="Apartment 4">
                    <div class="apartment-content">
                        <h3 class="apartment-name">PATRALAND URBANO</h3>
                        <a href="{{ route('discoverPLU') }}" class="view-details-btn">DISCOVER</a>
                    </div>
                </div>
            </div>

            <!-- Apartment Card 5 -->
            <div class="apartment-card">
                <div class="apartment-image">
                    <img src="{{ asset('images/images/home pages/IMG_3976.png') }}" alt="Apartment 5">
                    <div class="apartment-content">
                        <h3 class="apartment-name">GATEWAY CICADAS</h3>
                        <a href="{{ route('discoverGWC') }}" class="view-details-btn">DISCOVER</a>
                    </div>
                </div>
            </div>

            <!-- Apartment Card 6 -->
            <div class="apartment-card">
                <div class="apartment-image">
                    <img src="{{ asset('images/images/home pages/IMG_0362.png') }}" alt="Apartment 6">
                    <div class="apartment-content">
                        <h3 class="apartment-name">PODOMORO GOLF VIEW</h3>
                        <a href="{{ route('discoverPGV') }}" class="view-details-btn">DISCOVER</a>
                    </div>
                </div>
            </div>

            <!-- Apartment Card 7 -->
            <div class="apartment-card">
                <div class="apartment-image">
                    <img src="{{ asset('images/placeholder-gpc.jpg') }}" alt="Apartment 7">
                    <div class="apartment-content">
                        <h3 class="apartment-name">GREEN PRAMUKA CITY</h3>
                        <a href="{{ route('discoverGPC') }}" class="view-details-btn">DISCOVER</a>
                    </div>
                </div>
            </div>

            <!-- Apartment Card 8 -->
            <div class="apartment-card">
                <div class="apartment-image">
                    <img src="{{ asset('images/placeholder-bsc.jpg') }}" alt="Apartment 8">
                    <div class="apartment-content">
                        <h3 class="apartment-name">BASSURA CITY</h3>
                        <a href="{{ route('discoverBSC') }}" class="view-details-btn">DISCOVER</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Titip Kunci Section -->
    <section class="titip-kunci-section" id="titip-kunci-section">
        <div class="titip-kunci-container">
            <img src="{{ asset('images/images/home pages/IMG_5703.png') }}" alt="Background" class="titip-kunci-bg">
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
                    <img src="{{ asset('images/logo/handshake-icon.png') }}" alt="Handshake Icon"
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
    <script>
    document.querySelectorAll('.view-more-btn-promo').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('promoModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    });
    document.getElementById('closePromoModal').onclick = function() {
        document.getElementById('promoModal').style.display = 'none';
        document.body.style.overflow = '';
    };
    document.querySelector('.promo-modal-overlay').onclick = function() {
        document.getElementById('promoModal').style.display = 'none';
        document.body.style.overflow = '';
    };
    </script>

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
                        <img src="{{ asset('images/logo/ic_baseline-phone.png') }}" alt="Phone Icon"
                            class="contact-icon">
                        <span>telp. 0878-1593-3353</span>
                    </div>
                    <div class="contact-item">
                        <img src="{{ asset('images/logo/bxs_map.png') }}" alt="Location Icon" class="contact-icon">
                        <span>Jl. Insinyur H. Juanda No.19, RT.003/RW.011, Margahayu, Kec. Bekasi Tim., Kota Bks, Jawa
                            Barat 17113</span>
                    </div>
                    <div class="contact-item">
                        <img src="{{ asset('images/logo/ic_outline-email.png') }}" alt="Email Icon"
                            class="contact-icon">
                        <span>Email. neovalaofficial@gmail.com</span>
                    </div>
                </div>
            </div>
            <div class="story-image-container">
                <div class="story-image">
                    <img src="{{ asset('images/logo/story.png') }}" alt="Neovala Building">
                </div>
                <a href="{{ route('ourStory') }}" class="read-more-btn">READ MORE</a></button>
            </div>
        </div>
    </section>

    <!-- Comment Section -->
    <section class="comment-section" id="comment-section">
        <h2 class="comment-title">WHAT THEY SAY?</h2>
        <div class="comment-container">
            @foreach ($komentars as $komentar)
            <div class="comment-card">
                <div class="comment-header">
                    <span class="quote-icon">"</span>
                    <h3 class="comment-location">{{ strtoupper($komentar->apartmen) }}</h3>
                </div>
                <p class="comment-text">
                    {{ $komentar->isi }}
                </p>
                <div class="comment-footer">
                    <span class="comment-user">{{ '@' . $komentar->instagram }}</span>
                    <div class="star-rating">
                        @for ($i = 0; $i < $komentar->bintang; $i++)
                            <img src="{{ asset('images/logo/star-filled.png') }}" alt="Star"
                                class="star-icon star-filled">
                            @endfor
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>


    <!-- Footer -->
    <footer class="footer" id="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>GUEST SERVICE</h3>
                <p>0878-1593-3353</p>

                <h3>CONNECT WITH US</h3>
                <ul>
                    <li><a href="https://www.instagram.com/neovalaofficial/" target="_blank">INSTAGRAM</a></li>
                    <li><a href="https://www.facebook.com/people/Neovala-Official/61573750236974"
                            target="_blank">FACEBOOK</a></li>
                    <li><a href="https://www.tiktok.com/@neovalaofficial" target="_blank">TIKTOK</a></li>
                    <li><a href="https://twitter.com/neovalaofficial" target="_blank">TWITTER</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>FOLLOW US</h3>
                <div class="social-icons">
                    <a href="mailto:neovalaofficial@gmail.com" target="_blank"><i class="bi bi-envelope"
                            style="font-size: 2rem;"></i></a>
                    <a href="https://instagram.com/neovalaofficial" target="_blank"><i class="bi bi-instagram"
                            style="font-size: 2rem;"></i></a>
                </div>

                <h3>PAYMENT WITH</h3>
                <ul>
                    <li>BCA</li>
                    <li>MANDIRI</li>
                    <li>QRIS</li>
                    <li>BAYAR DI TEMPAT</li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>AVAILABLE AT:</h3>
                <ul class="footer-section-available">
                    <li><a class="footer-section-available" href="{{ route('discoverTPJ') }}">TRANSPARK JUANDA</a></li>
                    <li><a class="footer-section-available" href="{{ route('discoverTPC') }}">TRANSPARK CIBUBUR</a></li>
                    <li><a class="footer-section-available" href="{{ route('discoverGKL') }}">GRAND KAMALA LAGOON</a>
                    </li>
                    <li><a class="footer-section-available" href="{{ route('discoverPLU') }}">PATRAJAND URBANO</a></li>
                    <li><a class="footer-section-available" href="{{ route('discoverGWC') }}">GATEWAY CICADAS</a></li>
                    <li><a class="footer-section-available" href="{{ route('discoverPGV') }}">PODOMORO GOLF VIEW</a>
                    </li>
                    <li><a class="footer-section-available" href="{{ route('discoverGPC') }}">GREEN PRAMUKA CITY</a>
                    </li>
                    <li><a class="footer-section-available" href="{{ route('discoverBSC') }}">BASSURA CITY</a>
                    </li>
                    <div class="footer-logo">
                        <h2>NEOVALA</h2><img src="{{ asset('images/logo/NEOVALA TRANSPARENT 1.png') }}" alt="">
                    </div>
                </ul>
            </div>

        </div>
        <!-- <a href="{{ url('/admin/login') }}">
            Admin Login
        </a> -->
        <div class="footer-bottom">
            <p>© Copyright Neovala from 2023. All right reserved Your Level Information</p>
        </div>
    </footer>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
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

</body>

</html>