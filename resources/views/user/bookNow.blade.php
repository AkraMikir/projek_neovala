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
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/title-web.webp') }}">    
    <title>Book now Neovala</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar booknow-navbar">
        <div class="nav-content">
            <div class="burger-menu">
                <div class="burger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="logo-left">
                <a href="{{ route('home') }}"><img src="{{ asset('images/logo/NEOVALA TRANSPARENT 1.webp') }}" alt="Logo Neovala Light" class="logo-light"></a>
                <a href="{{ route('home') }}"><img src="{{ asset('images/logo/NEOVALA-DARK.webp') }}" alt="Logo Neovala Dark" class="logo-dark"></a>
            </div>
                <ul class="nav-links">
                <a href="{{ route('home') }}#apartment-section" onclick="window.location=this.href"><i class="bi bi-building"></i> Apartment</a>
                <a href="{{ route('home') }}#titip-kunci-section" onclick="window.location=this.href"><i class="bi bi-key"></i> Titip Kunci</a>
                <a href="{{ route('home') }}#promo-section" onclick="window.location=this.href"><i class="bi bi-gift"></i> Promo</a>
                <a href="{{ route('ourStory') }}" onclick="window.location=this.href"><i class="bi bi-people"></i> About Us</a>
                <a href="#footer" onclick="window.location=this.href"><i class="bi bi-geo-alt"></i> Find Us</a>

                </ul>
            <div class="logo-right"><a href="{{ route('home') }}">NEOVALA</a></div>
        </div>
    </nav>
    <div class="nav-overlay"></div>

    <div class="booking-container">
        <h1 class="page-title">CHOOSE YOUR APARTMENT</h1>
        <div class="booking-grid">
            <!-- Booking Transpark Juanda -->
            <div class="booking-card">
                <div class="card-image-wrapper">
                    <img src="{{ asset('images/images/home pages/home_utama.webp') }}" alt="Transpark Juanda" class="card-image">
                    <div class="card-overlay">
                        <h3>TRANSPARK JUANDA</h3>
                    </div>
                </div>
                <div class="card-content">
                    <p class="wa-number"><i class="fab fa-whatsapp"></i> +62 878-7417-6270</p>
                    <div class="booking-buttons">
                        <a href="https://wa.me/6287874176270" target="_blank" class="booking-btn whatsapp-btn">
                            <i class="fab fa-whatsapp"></i>
                            <span class="whatsapp-text">WhatsApp</span>
                        </a>
                        <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-transpark-juanda" target="_blank" class="booking-btn tiket-btn">
                            <span class="tiket-text">tiket</span>
                            <div class="tiket-element"></div><span class="tiket-text">com</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Booking Transpark Cibubur -->
            <div class="booking-card">
                <div class="card-image-wrapper">
                    <img src="{{ asset('images/images/discover-TPC/IMG_9440.webp') }}" alt="Transpark Cibubur" class="card-image">
                    <div class="card-overlay">
                        <h3>TRANSPARK CIBUBUR</h3>
                    </div>
                </div>
                <div class="card-content">
                    <p class="wa-number"><i class="fab fa-whatsapp"></i> +62 818-0519-1817</p>
                    <div class="booking-buttons">
                        <a href="https://wa.me/6281805191817" target="_blank" class="booking-btn whatsapp-btn">
                            <i class="fab fa-whatsapp"></i>
                            <span class="whatsapp-text">WhatsApp</span>
                        </a>
                        <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-transpark-cibubur" target="_blank" class="booking-btn tiket-btn">
                            <span class="tiket-text">tiket</span>
                            <div class="tiket-element"></div><span class="tiket-text">com</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Booking Grand Kamala Lagoon -->
            <div class="booking-card">
                <div class="card-image-wrapper">
                    <img src="{{ asset('images/images/discover-GKL/IMG_3011.webp') }}" alt="Grand Kamala Lagoon" class="card-image">
                    <div class="card-overlay">
                        <h3>GRAND KAMALA LAGOON</h3>
                    </div>
                </div>
                <div class="card-content">
                    <p class="wa-number"><i class="fab fa-whatsapp"></i> +62 851-6151-8151</p>
                    <div class="booking-buttons">
                        <a href="https://wa.me/6285161518151" target="_blank" class="booking-btn whatsapp-btn">
                            <i class="fab fa-whatsapp"></i>
                            <span class="whatsapp-text">WhatsApp</span>
                        </a>
                        <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-grand-kamala-lagoon-802001739869526174" target="_blank" class="booking-btn tiket-btn">
                            <span class="tiket-text">tiket</span>
                            <div class="tiket-element"></div><span class="tiket-text">com</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Booking Patraland Urbano -->
            <div class="booking-card">
                <div class="card-image-wrapper">
                    <img src="{{ asset('images/images/discover-PLU/IMG_8300.webp') }}" alt="Patraland Urbano" class="card-image">
                    <div class="card-overlay">
                        <h3>PATRALAND URBANO</h3>
                    </div>
                </div>
                <div class="card-content">
                    <p class="wa-number"><i class="fab fa-whatsapp"></i> +62 877-6854-5010</p>
                    <div class="booking-buttons">
                        <a href="https://wa.me/6287768545010" target="_blank" class="booking-btn whatsapp-btn">
                            <i class="fab fa-whatsapp"></i>
                            <span class="whatsapp-text">WhatsApp</span>
                        </a>
                        <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartment-patraland-urbano" target="_blank" class="booking-btn tiket-btn">
                            <span class="tiket-text">tiket</span>
                            <div class="tiket-element"></div><span class="tiket-text">com</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Booking Gateway Cicadas -->
            <div class="booking-card">
                <div class="card-image-wrapper">
                    <img src="{{ asset('images/images/discover-GWC/IMG_6088.webp') }}" alt="Gateway Cicadas" class="card-image">
                    <div class="card-overlay">
                        <h3>GATEWAY CICADAS</h3>
                    </div>
                </div>
                <div class="card-content">
                    <p class="wa-number"><i class="fab fa-whatsapp"></i> +62 896-3025-3533</p>
                    <div class="booking-buttons">
                        <a href="https://wa.me/6289630253533" target="_blank" class="booking-btn whatsapp-btn">
                            <i class="fab fa-whatsapp"></i>
                            <span class="whatsapp-text">WhatsApp</span>
                        </a>
                        <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-gateway-cicadas" target="_blank" class="booking-btn tiket-btn">
                            <span class="tiket-text">tiket</span>
                            <div class="tiket-element"></div><span class="tiket-text">com</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Booking Podomoro Golf View -->
            <div class="booking-card">
                <div class="card-image-wrapper">
                    <img src="{{ asset('images/images/discover-PGV/IMG_0416.webp') }}" alt="Podomoro Golf View" class="card-image">
                    <div class="card-overlay">
                        <h3>PODOMORO GOLF VIEW</h3>
                    </div>
                </div>
                <div class="card-content">
                    <p class="wa-number"><i class="fab fa-whatsapp"></i> +62 812-2039-1217</p>
                    <div class="booking-buttons">
                        <a href="https://wa.me/6281220391217" target="_blank" class="booking-btn whatsapp-btn">
                            <i class="fab fa-whatsapp"></i>
                            <span class="whatsapp-text">WhatsApp</span>
                        </a>
                        <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-podomoro-golf-view" target="_blank" class="booking-btn tiket-btn">
                            <span class="tiket-text">tiket</span>
                            <div class="tiket-element"></div><span class="tiket-text">com</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Booking Green Pramuka City -->
            <div class="booking-card">
                <div class="card-image-wrapper">
                    <img src="{{ asset('images/images/discover-GPC/IMG_0646.webp') }}" alt="Green Pramuka City" class="card-image">
                    <div class="card-overlay">
                        <h3>GREEN PRAMUKA CITY</h3>
                    </div>
                </div>
                <div class="card-content">
                    <p class="wa-number"><i class="fab fa-whatsapp"></i> +62 857-1903-5729</p>
                    <div class="booking-buttons">
                        <a href="https://wa.me/6285719035729" target="_blank" class="booking-btn whatsapp-btn">
                            <i class="fab fa-whatsapp"></i>
                            <span class="whatsapp-text">WhatsApp</span>
                        </a>
                        <a href="https://www.tiket.com/homes/indonesia/studio-room-gpc-1-malam-by-neovala-809001759225711910?checkin=2025-11-16&checkout=2025-11-17&adult=1&room=1&utm_external=organic&utm_medium=nha_pdp%3Bshare_button" target="_blank" class="booking-btn tiket-btn">
                            <span class="tiket-text">tiket</span>
                            <div class="tiket-element"></div><span class="tiket-text">com</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Booking Bassura City -->
            <div class="booking-card">
                <div class="card-image-wrapper">
                    <img src="{{ asset('images/images/discover-BSC/IMG_1882.webp') }}" alt="Bassura City" class="card-image">
                    <div class="card-overlay">
                        <h3>BASSURA CITY</h3>
                    </div>
                </div>
                <div class="card-content">
                    <p class="wa-number"><i class="fab fa-whatsapp"></i> +62 878-5262-4656</p>
                    <div class="booking-buttons">
                        <a href="https://wa.me/6287852624656" target="_blank" class="booking-btn whatsapp-btn">
                            <i class="fab fa-whatsapp"></i>
                            <span class="whatsapp-text">WhatsApp</span>
                        </a>
                        <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-bassura-city" target="_blank" class="booking-btn tiket-btn">
                            <span class="tiket-text">tiket</span>
                            <div class="tiket-element"></div><span class="tiket-text">com</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Booking Springlake Summarecon -->
            <div class="booking-card">
                <div class="card-image-wrapper">
                    <img src="{{ asset('images/images/discover-SPL/IMG_9344.webp') }}" alt="Springlake Summarecon" class="card-image">
                    <div class="card-overlay">
                        <h3>SPRINGLAKE SUMMARECON</h3>
                    </div>
                </div>
                <div class="card-content">
                    <p class="wa-number"><i class="fab fa-whatsapp"></i> +62 813-9553-939</p>
                    <div class="booking-buttons">
                        <a href="https://wa.me/628139553939" target="_blank" class="booking-btn whatsapp-btn">
                            <i class="fab fa-whatsapp"></i>
                            <span class="whatsapp-text">WhatsApp</span>
                        </a>
                        <a href="#" target="_blank" class="booking-btn tiket-btn">
                            <span class="tiket-text">tiket</span>
                            <div class="tiket-element"></div><span class="tiket-text">com</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
   <footer class="footer" id="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>GUEST SERVICE</h3>
            <p>0896-6964-9690</p>
            
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
                <li><a class="footer-section-available" href="{{ route('discoverGPC') }}">GREEN PRAMUKA CITY</a></li>
                <li><a class="footer-section-available" href="{{ route('discoverBSC') }}">BASSURA CITY</a></li>
                <li><a class="footer-section-available" href="{{ route('discoverSPL') }}">SPRINGLAKE SUMMARECON</a></li>
                <div class="footer-logo">
                    <h2>NEOVALA</h2><img src="{{ asset('images/logo/NEOVALA TRANSPARENT 1.webp') }}" alt="">
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
<script src="{{ asset('js/tracking.js') }}"></script>
</html>