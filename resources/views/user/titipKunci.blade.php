<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=42dot+Sans:wght@300..800&family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/footer-logo.png') }}">    
    <title>Titip Kunci Neovala</title>
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
                <a href="{{ route('home') }}"><img src="{{ asset('images/logo/NEOVALA TRANSPARENT 1.png') }}" alt="Logo Neovala Light" class="logo-light"></a>
                <a href="{{ route('home') }}"><img src="{{ asset('images/logo/NEOVALA-DARK.png') }}" alt="Logo Neovala Dark" class="logo-dark"></a>
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}#apartment-section" onclick="window.location=this.href"><i class="bi bi-building"></i> Apartment</a></li>
                <li><a href="{{ route('home') }}#promo-section" onclick="window.location=this.href"><i class="bi bi-gift"></i> Promo</a></li>
                <li><a href="{{ route('ourStory') }}" onclick="window.location=this.href"><i class="bi bi-people"></i> About Us</a></li>
                <li><a href="#footer" onclick="window.location=this.href"><i class="bi bi-geo-alt"></i> Find Us</a></li>
            </ul>
            <div class="logo-right"><a href="{{ route('home') }}">NEOVALA</a></div>
        </div>
    </nav>
    <div class="nav-overlay"></div>

    <!-- Header dengan Carousel -->
    <header class="header" id="home">
        <div class="carousel" >

            <div class="titip-kunci-header-text-overlay">
                <img src="{{ asset('images/logo/titip-kunci.png') }}" alt="Logo Neovala Light" class="logo-light">
                <p>JASA TITIP KUNCI</p>
            </div>
            <!-- Tambahkan overlay text -->

            <button class="carousel-button prev">&#10094;</button>
            <button class="carousel-button next">&#10095;</button>
            
            <div class="carousel-container" >
                <div class="carousel-slide">
                    <img src="{{ asset('images/images/our-story/IMG_3358.png') }}" alt="Slide 1">
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/images/our-story/IMG_3125.png') }}" alt="Slide 2">
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/images/our-story/IMG_0722.png') }}" alt="Slide 3">
                </div>
                <div class="carousel-slide">
                    <img src="{{ asset('images/images/our-story/IMG_3358.png') }}" alt="Slide 4">
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

    <!-- Tambahkan section ini di file ourStory.html -->
<section class="titip-kunci">   
    <div class="info-box">
        <h2>APA ITU TITIP KUNCI?</h2>
        <p>
            Apakah Anda salah satu pemilik Unit Apartemen <b>Transpark Juanda, Grand Kamala Lagoon, Patraland Urbano, Transpark Cibubur, Podomoro Golf View,</b> dan <b>Gateway Cicadas</b> yang tidak tinggal di apartemen Anda sendiri karena masih memiliki rumah? Atau mungkin Anda sering bepergian dan unit apartemen Anda terbengkalai tanpa penghuni? <br><br>
            Masalah umum seperti biaya <b>IPL</b> yang terus berjalan, tagihan listrik yang tetap muncul, dan perawatan unit yang terbengkalai bisa menjadi hal yang merepotkan.<br><br>
            <b>Kami Punya Solusinya!</b> Dengan <b>Titip Kunci by Neovala</b>, Anda bisa memastikan unit apartemen Anda tetap terurus tanpa perlu khawatir tentang biaya yang terus berjalan atau kerusakan yang bisa terjadi.<br><br>
            Kami bantu kelola unit Anda dengan aman dan tim profesional dari <b>Neovala</b>.
        </p>
    </div>

    <!-- Section Fitur Utama Titip Kunci by Neovala -->
    <section class="fitur-titipkunci-section">
        <div class="fitur-titipkunci-box">
            <h2 class="fitur-title"> Fitur Utama Titip Kunci by Neovala</h2>
            <ol class="fitur-list">
                <li>
                    <span class="fitur-heading">Pengelolaan Unit Tanpa Repot</span><br>
                    <span class="fitur-desc">Neovala akan menangani semua aspek pengelolaan unit, mulai dari perawatan rutin, kebersihan, hingga pengaturan tagihan seperti IPL, listrik, dan air. Anda cukup menerima laporan berkala tanpa perlu terlibat langsung.</span>
                </li>
                <li>
                    <span class="fitur-heading">Pendapatan Pasif</span><br>
                    <span class="fitur-desc">Jika unit Anda tidak dihuni, Neovala akan membantu menyewakannya, baik untuk sewa harian, bulanan, maupun jangka panjang, sehingga unit Anda tetap menghasilkan pendapatan meskipun tidak digunakan.</span>
                </li>
                <li>
                    <span class="fitur-heading">Tim Profesional dan Terpercaya</span><br>
                    <span class="fitur-desc">Tim Neovala terdiri dari ahli yang berpengalaman dalam manajemen properti, sehingga Anda dapat merasa tenang bahwa unit Anda dikelola dengan sangat baik.</span>
                </li>
                <li>
                    <span class="fitur-heading">Keamanan dan Pemantauan</span><br>
                    <span class="fitur-desc">Keamanan unit Anda menjadi prioritas utama. Neovala memastikan pengelolaan dengan sistem pemantauan dan protokol keamanan yang ketat, menjaga unit Anda tetap terjaga.</span>
                </li>
                <li>
                    <span class="fitur-heading">Transparansi dan Laporan Berkala</span><br>
                    <span class="fitur-desc">Anda akan mendapatkan laporan terperinci tentang kondisi unit, pendapatan yang dihasilkan, dan pengeluaran terkait, sehingga Anda selalu tahu apa yang terjadi dengan properti Anda.</span>
                </li>
            </ol>
            <div class="fitur-lokasi">
                <span>Layanan ini cocok bagi pemilik unit apartemen di lokasi seperti <b>Transpark Juanda, Grand Kamala Lagoon, Patraland Urbano, Transpark Cibubur, Podomoro Golf View</b>, dan <b>Gateway Cicadas</b>, yang ingin memastikan unit mereka tetap produktif meskipun tidak dihuni.</span>
            </div>
        </div>
    </section>

    <div class="registration-info">
        <h2>Langkah Mudah Mendaftarkan Unit Anda di Titip Kunci by Neovala</h2>
        <ul class="steps-modern-list">
            <li>
                <div class="step-number">1</div>
                <div class="step-content">
                    <span class="step-title">Hubungi Tim Neovala</span>
                    <span class="step-desc">Melalui telepon, WhatsApp, email, atau formulir online di situs resmi Neovala.</span>
                </div>
            </li>
            <li>
                <div class="step-number">2</div>
                <div class="step-content">
                    <span class="step-title">Konsultasi Awal</span>
                    <span class="step-desc">Diskusikan layanan, biaya, dan proses. Berikan informasi unit seperti alamat dan status kepemilikan.</span>
                </div>
            </li>
            <li>
                <div class="step-number">3</div>
                <div class="step-content">
                    <span class="step-title">Survey dan Penilaian Unit</span>
                    <span class="step-desc">Tim Neovala menilai kondisi unit dan memberikan rekomendasi jika perlu perbaikan.</span>
                </div>
            </li>
            <li>
                <div class="step-number">4</div>
                <div class="step-content">
                    <span class="step-title">Penandatanganan Perjanjian</span>
                    <span class="step-desc">Setelah setuju, Anda menandatangani perjanjian kerja sama yang mencakup hak dan kewajiban kedua belah pihak.</span>
                </div>
            </li>
            <li>
                <div class="step-number">5</div>
                <div class="step-content">
                    <span class="step-title">Penyerahan Kunci dan Pengelolaan</span>
                    <span class="step-desc">Unit mulai dikelola oleh Neovala. Anda akan menerima laporan rutin tentang kondisi dan pendapatan unit.</span>
                </div>
            </li>
        </ul>
    </div>
</section>

<section class="form-section">
    <div class="form-container">
        <h2>Form Titip Kunci Apartemen by Neovala</h2>
        <form id="titipKunciForm">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" placeholder="Masukan Nama" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Masukan Email" required>
            </div>

            <div class="form-group">
                <label for="apartemen">Apartemen</label>
                <input type="text" id="apartemen" placeholder="Masukan Nama Apartemen" required>
            </div>

            <div class="form-group">
                <label for="tower">Nama Tower</label>
                <input type="text" id="tower" placeholder="Masukan Nama Tower" required>
            </div>

            <div class="form-group">
                <label for="lantai">Lantai</label>
                <input type="text" id="lantai" placeholder="Masukan Nomor Lantai" required>
            </div>

            <div class="form-group">
                <label for="nomor">Nomor Kamar</label>
                <input type="text" id="nomor" placeholder="Masukan Nomor Kamar" required>
            </div>

            <div class="form-group">
                <label for="tipeKamar">Ukuran Kamar</label>
                <select id="tipeKamar" required>
                    <option value="" disabled selected>Pilih Ukuran Kamar</option>
                    <option value="studio">Studio</option>
                    <option value="1br">1 Bed Room</option>
                    <option value="2br">2 Bed Room</option>
                </select>
            </div>

            <div class="form-group">
                <label for="furniture">Furniture</label>
                <select id="furniture" required>
                    <option value="" disabled selected>Pilih Tipe Furniture</option>
                    <option value="kosong">Kosong</option>
                    <option value="semi">Semi Furniture</option>
                    <option value="full">Full Furniture</option>
                </select>
            </div>

            <div class="form-group">
                <label for="catatan">Catatan Pemilik</label>
                <textarea id="catatan" placeholder="Isi data tambahan" rows="4"></textarea>
            </div>

            <div class="form-buttons">
                <button type="reset" class="cancel-btn">Batal</button>
                <button type="button" class="kirim-btn" onclick="kirimKeWhatsApp()">Kirim</button>
                <script>
                    function kirimKeWhatsApp() {
                        // Ambil nilai dari semua input
                        const nama = document.getElementById('nama').value;
                        const email = document.getElementById('email').value;
                        const apartemen = document.getElementById('apartemen').value;
                        const tower = document.getElementById('tower').value;
                        const lantai = document.getElementById('lantai').value;
                        const nomor = document.getElementById('nomor').value;
                        const tipeKamar = document.getElementById('tipeKamar').value;
                        const furniture = document.getElementById('furniture').value;
                        const catatan = document.getElementById('catatan').value;
                        
                        // Buat pesan dengan format yang diinginkan
                        let pesan = `*Saya ingin titip kunci apartemen*%0A%0A`;
                        pesan += `Nama: ${nama}%0A`;
                        pesan += `Email: ${email}%0A`;
                        pesan += `Apartemen: ${apartemen}%0A`;
                        pesan += `Tower: ${tower}%0A`;
                        pesan += `Lantai: ${lantai}%0A`;
                        pesan += `Nomor Kamar: ${nomor}%0A`;
                        pesan += `Ukuran Kamar: ${tipeKamar}%0A`;
                        pesan += `Furniture: ${furniture}%0A`;
                        pesan += `Catatan: ${catatan}%0A`;
                        
                        // Buka WhatsApp dengan pesan yang sudah disiapkan
                        window.open(`https://wa.me/6287815933353?text=${pesan}`, '_blank');
                    }
                </script>
            </div>
        </form>
    </div>
</section>

<!-- Section Penutup Titip Kunci by Neovala -->
<section class="closing-titipkunci-section">
    <div class="closing-titipkunci-box">
        <h2 class="closing-title"><i class="fa fa-check-circle"></i> Keuntungan Bergabung dengan Titip Kunci by Neovala</h2>
        <ul class="closing-benefit-list">
            <li><span class="benefit-icon"><i class="fa fa-coins"></i></span><b>Pendapatan Pasif</b> tanpa perlu terlibat langsung.</li>
            <li><span class="benefit-icon"><i class="fa fa-users"></i></span><b>Pengelolaan profesional</b> dengan tim berpengalaman.</li>
            <li><span class="benefit-icon"><i class="fa fa-file-alt"></i></span><b>Transparansi laporan</b> dan pengelolaan biaya secara teratur.</li>
            <li><span class="benefit-icon"><i class="fa fa-shield-alt"></i></span><b>Keamanan unit terjamin</b> dengan sistem monitoring yang ketat.</li>
        </ul>
        <div class="closing-desc">
            Jika Anda siap untuk memaksimalkan potensi unit Anda dan menghindari kerugian karena unit yang tidak dihuni, langkah pertama adalah <b>menghubungi tim Neovala</b> dan melakukan pendaftaran.<br><br>
            <a href="https://wa.me/6287815933353" class="closing-cta-btn"><i class="bi bi-whatsapp"></i> Hubungi Neovala Sekarang</a>
        </div>
    </div>
</section>

<div class="book-now-container visible">
    <a href="{{ route('bookNow') }}" class="book-now-btn">
        <div class="book-now-icon"><img src="{{ asset('images/logo/book-now.png') }}" alt=""></div>
        <span>BOOK NOW</span>
    </a>
</div>  

   <!-- Footer -->
   <footer class="footer" id="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>GUEST SERVICE</h3>
            <p>0878-1593-3353</p>
            
            <h3>CONNECT WITH US</h3>
            <ul>
                <li><a href="https://www.instagram.com/neovalaofficial/" target="_blank">INSTAGRAM</a></li>
                <li><a href="https://www.facebook.com/people/Neovala-Official/61573750236974" target="_blank">FACEBOOK</a></li>
                <li><a href="https://www.tiktok.com/@neovalaofficial" target="_blank">TIKTOK</a></li>
                <li><a href="https://twitter.com/neovalaofficial" target="_blank">TWITTER</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>FOLLOW US</h3>
            <div class="social-icons">
                <a href="neovalaofficial@gmail.com"><i class="bi bi-envelope" style="font-size: 2rem;"></i></a>
                <a href="https://instagram.com/neovalaofficial"><i class="bi bi-instagram" style="font-size: 2rem;"></i></a>
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
                <li><a class="footer-section-available" href="{{ route('discoverGKL') }}">GRAND KAMALA LAGOON</a></li>
                <li><a class="footer-section-available" href="{{ route('discoverPLU') }}">PATRAJAND URBANO</a></li>
                <li><a class="footer-section-available" href="{{ route('discoverGWC') }}">GATEWAY CICADAS</a></li>
                <li><a class="footer-section-available" href="{{ route('discoverPGV') }}">PODOMORO GOLF VIEW</a></li>
                <div class="footer-logo">
                    <h2>NEOVALA</h2><img src="{{ asset('images/logo/NEOVALA TRANSPARENT 1.png') }}" alt="">
                </div>
            </ul>
        </div>

    </div>
    <div class="footer-bottom">
        <p>© Copyright Neovala from 2023. All right reserved Your Level Information</p>
    </div>
</footer>   
</body>
<script src="{{ asset('js/script.js') }}"></script> 
</html>