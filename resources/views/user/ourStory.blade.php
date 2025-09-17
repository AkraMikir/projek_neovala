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
    <title>Our Story Neovala</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ourstory.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
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
                <li><a href="{{ route('titipKunci') }}" onclick="window.location=this.href"><i class="bi bi-key"></i> Titip Kunci</a></li> 
                <li><a href="{{ route('home') }}#promo-section" onclick="window.location=this.href"><i class="bi bi-gift"></i> Promo</a></li>
                <li><a href="#footer" onclick="window.location=this.href"><i class="bi bi-geo-alt"></i> Find Us</a></li>
            </ul>
            <div class="logo-right"><a href="{{ route('home') }}">NEOVALA</a></div>
        </div>
    </nav>
    <div class="nav-overlay"></div>


    <!-- Header dengan Carousel -->
    <header class="header">
        <div class="carousel" >
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
                    <img src="{{ asset('images/images/our-story/IMG_3120.png') }}" alt="Slide 4">
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

    <section class="our-story">
        <h2 class="apartment-title">OUR STORY</h2>
        <!-- Vision -->
        <div class="story-item">
            <div class="story-story-image">
                <img src="{{ asset('images/images/our-story/IMG_3358.png') }}" alt="Vision">
                <div class="image-overlay">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
            <div class="story-story-content">
                <h2>Our Vision</h2>
                <p> Menjadi penyedia akomodasi terbaik yang memberikan pengalaman menginap yang menyenangkan, efisien, dan memuaskan bagi setiap tamu, dengan konsep hunian yang modern dan fungsional.</p>
            </div>
        </div>

        <!-- Ethics -->
        <div class="story-item reverse">
            <div class="story-story-image">
                <img src="{{ asset('images/images/our-story/IMG_0722.png') }}" alt="Ethics">
                <div class="image-overlay">
                    <i class="fas fa-bullseye"></i>
                </div>
            </div>
            <div class="story-story-content">
                <h2>Mission</h2>
                <p>1. Menyediakan akomodasi berkualitas tinggi dengan harga yang bersaing.</p>
                <p>2. Memastikan kenyamanan dan kepuasan tamu melalui layanan pelanggan yang ramah dan responsif.</p>
                <p>3.Menawarkan fleksibilitas dalam pemesanan dengan pilihan penginapan harian, mingguan, dan transit</p>
                <p>4. Menjaga kebersihan dan keamanan setiap unit untuk memberikan pengalaman menginap yang tenang dan nyaman.</p>
            </div>
        </div>

        <!-- Founder Section Baru -->
        <div class="founder-section">
            <div class="founder-left">
                <div class="founder-photo">
                    <img src="{{ asset('images/images/our-story/Bang Farhan.png') }}" alt="Farhan Saadillah">
                    <div class="founder-card overlap">
                        <span class="founder-name">Farhan Saadillah</span>
                        <span class="founder-role">Owner and Director of Neovala Rooms</span>
                    </div>
                </div>
            </div>
            <div class="founder-right">
                <h2 class="founder-title">Founder</h2>
                <div class="founder-desc">
                    <p>Saya, Farhan Saadillah, memperkenalkan Neovala, yang berdiri sejak 2020 di bawah PT. LAVANAA DEVA PERKASA.</p>
                    <p>Neovala menyediakan akomodasi nyaman, mewah, dan dapat dipercaya, dengan komitmen pada kualitas dan layanan terbaik. Kami mengelola 6 properti unggulan di lokasi strategis, dengan lebih dari 80 unit, memastikan fasilitas lengkap dan kenyamanan maksimal bagi tamu. Neovala selalu berinovasi untuk memberikan pengalaman staycation yang sempurna.</p>
                </div>
            </div>
            <div class="founder-bg">
                <img src="{{ asset('images/images/our-story/DJI_20250325044612_0190_D.JPG') }}" alt="Tim Neovala">
            </div>
        </div>

        <!-- History Section -->
        <div class="story-item history-section">
            <div class="history-content">
                <h2 class="history-title">History</h2>
                <p>Neovala lahir dari visi untuk menciptakan solusi inovatif dalam dunia akomodasi dan properti. Nama Neovala merupakan gabungan dari dua kata dengan makna mendalam: "Neo" dari bahasa Yunani yang berarti baru, dan "Vala" dari bahasa Jerman yang berarti pemecah solusi.</p>
                <p>Dengan filosofi ini, Neovala hadir sebagai gaya baru dalam menghadirkan solusi hunian yang modern, nyaman, dan berkualitas, baik untuk kebutuhan jangka pendek maupun panjang.</p>
                <p>Logo Neovala dirancang dengan konsep ambigram, sebuah tipografi unik yang memungkinkan huruf "N" tetap terlihat dalam berbagai arah, melambangkan konsistensi, inovasi, dan keteguhan visi kami.</p>
                <p>Huruf "N" juga menjadi simbol semangat Neovala dalam memberikan pengalaman menginap yang berkesan dan penuh kenyamanan.</p>
                <p>Dengan kombinasi makna yang mendalam dan desain yang unik, Neovala terus berkembang menjadi pilihan utama dalam dunia akomodasi, menghadirkan hunian yang cerdas, modern, dan bernilai estetik tinggi.</p>
            </div>
            <div class="history-images">
                <div class="history-logo">
                    <img src="{{ asset('images/images/our-story/NEOVALA FIX.jpg') }}" alt="Neovala Rooms Logo">
                </div>
                <div class="history-room">
                    <img src="{{ asset('images/images/discover-TPJ/J3118 👒✅/1.jpeg') }}" alt="Kamar Neovala">
                </div>
                <div class="history-building">
                    <img src="{{ asset('images/images/home pages/home_utama.png') }}" alt="Gedung Neovala">
                </div>
            </div>
        </div>

        <!-- Organization Section -->
        <section class="organization-section">
            <h2 class="organization-title">Organization Structure</h2>
            <div class="organization-img-wrapper">
                <img src="{{ asset('images/images/our-story/organization fix.png') }}" alt="Organization Structure Neovala" class="organization-img">
            </div>
        </section>

        <div class="book-now-container visible">
            <a href="{{ route('bookNow') }}" class="book-now-btn">
                <div class="book-now-icon"><img src="{{ asset('images/logo/book-now.png') }}" alt=""></div>
                <span>BOOK NOW</span>
            </a>
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
<script src="../js/script.js"></script>
</html>