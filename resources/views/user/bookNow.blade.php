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
                <a href="{{ route('home') }}"><img src="{{ asset('images/logo/NEOVALA TRANSPARENT 1.png') }}" alt="Logo Neovala Light" class="logo-light"></a>
                <a href="{{ route('home') }}"><img src="{{ asset('images/logo/NEOVALA-DARK.png') }}" alt="Logo Neovala Dark" class="logo-dark"></a>
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
        <!-- Booking Transpark Juanda -->
        <div class="booking-section">
            <h2>BOOKING TRANSPARK JUANDA</h2>
            <div class="booking-images">    
                <a href="https://wa.me/6287874176270" target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Group 105 (2).png') }}" alt="WhatsApp Icon">
                    </div>
                    <img src="{{ asset('images/images/home pages/home_utama.png') }}" alt="WhatsApp Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via WhatsApp</span>
                    </div>
                </a>
                <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-transpark-juanda" target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Tiket.com_logo 2 (1).png') }}" alt="Tiket.com Icon">
                    </div>
                    <img src="{{ asset('images/images/home pages/home_utama.png') }}" alt="Tiket.com Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via Tiket.com</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Booking Transpark Cibubur -->
        <div class="booking-section">
            <h2>BOOKING TRANSPARK CIBUBUR</h2>
            <div class="booking-images">
                <a href="https://wa.me/6281805191817" target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Group 105 (2).png') }}" alt="WhatsApp Icon">
                    </div>
                    <img src="{{ asset('images/images/discover-TPC/IMG_9440.jpg') }}" alt="WhatsApp Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via WhatsApp</span>
                    </div>
                </a>
                <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-transpark-cibubur" target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Tiket.com_logo 2 (1).png') }}" alt="Tiket.com Icon">
                    </div>
                    <img src="{{ asset('images/images/discover-TPC/IMG_9440.jpg') }}" alt="Tiket.com Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via Tiket.com</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Booking Grand Kamala Lagoon -->
        <div class="booking-section">
            <h2>BOOKING GRAND KAMALA LAGOON</h2>
            <div class="booking-images">
                <a href="https://wa.me/6285161518151" target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Group 105 (2).png') }}" alt="WhatsApp Icon">
                    </div>
                    <img src="{{ asset('images/images/discover-gkl/IMG_0143 (Copy).jpg') }}" alt="WhatsApp Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via WhatsApp</span>
                    </div>
                </a>
                <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-grand-kamala-lagoon-802001739869526174 " target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Tiket.com_logo 2 (1).png') }}" alt="Tiket.com Icon">
                    </div>
                    <img src="{{ asset('images/images/discover-gkl/IMG_0143 (Copy).jpg') }}" alt="Tiket.com Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via Tiket.com</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Booking Patraland Urbano -->
        <div class="booking-section">
            <h2>BOOKING PATRALAND URBANO</h2>
            <div class="booking-images">
                <a href="https://wa.me/6287852624656" target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Group 105 (2).png') }}" alt="WhatsApp Icon">
                    </div>
                    <img src="{{ asset('images/images/discover-PLU/IMG_8300.jpg') }}" alt="WhatsApp Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via WhatsApp</span>
                    </div>
                </a>
                <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartment-patraland-urbano " target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Tiket.com_logo 2 (1).png') }}" alt="Tiket.com Icon">
                    </div>
                    <img src="{{ asset('images/images/discover-PLU/IMG_8300.jpg') }}" alt="Tiket.com Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via Tiket.com</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Booking Gateway Cicadas -->
        <div class="booking-section">
            <h2>BOOKING GATEWAY CICADAS</h2>
            <div class="booking-images">
                <a href="https://wa.me/6289630253533" target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Group 105 (2).png') }}" alt="WhatsApp Icon">
                    </div>
                    <img src="{{ asset('images/images/discover-GWC/IMG_6088.jpg') }}" alt="WhatsApp Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via WhatsApp</span>
                    </div>
                </a>
                <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-gateway-cicadas " target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Tiket.com_logo 2 (1).png') }}" alt="Tiket.com Icon">
                    </div>
                    <img src="{{ asset('images/images/discover-GWC/IMG_6088.jpg') }}" alt="Tiket.com Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via Tiket.com</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Booking Podomoro Golf View -->
        <div class="booking-section">
            <h2>BOOKING PODOMORO GOLF VIEW</h2>
            <div class="booking-images">
                <a href="https://wa.me/6281220391217" target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Group 105 (2).png') }}" alt="WhatsApp Icon">
                    </div>
                    <img src="{{ asset('images/images/discover-PGV/IMG_0416.jpg') }}" alt="WhatsApp Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via WhatsApp</span>
                    </div>
                </a>
                <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-podomoro-golf-view " target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Tiket.com_logo 2 (1).png') }}" alt="Tiket.com Icon">
                    </div>
                    <img src="{{ asset('images/images/discover-PGV/IMG_0416.jpg') }}" alt="Tiket.com Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via Tiket.com</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Booking Grand Pramuka City -->
        <div class="booking-section">
            <h2>BOOKING GRAND PRAMUKA CITY</h2>
            <div class="booking-images">
                <a href="https://wa.me/6281234567890" target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Group 105 (2).png') }}" alt="WhatsApp Icon">
                    </div>
                    <img src="{{ asset('images/placeholder-gpc.jpg') }}" alt="WhatsApp Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via WhatsApp</span>
                    </div>
                </a>
                <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-grand-pramuka-city" target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Tiket.com_logo 2 (1).png') }}" alt="Tiket.com Icon">
                    </div>
                    <img src="{{ asset('images/placeholder-gpc.jpg') }}" alt="Tiket.com Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via Tiket.com</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Booking Bassura City -->
        <div class="booking-section">
            <h2>BOOKING BASSURA CITY</h2>
            <div class="booking-images">
                <a href="https://wa.me/6281234567891" target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Group 105 (2).png') }}" alt="WhatsApp Icon">
                    </div>
                    <img src="{{ asset('images/placeholder-bsc.jpg') }}" alt="WhatsApp Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via WhatsApp</span>
                    </div>
                </a>
                <a href="https://www.tiket.com/homes/indonesia/neovala-at-apartemen-bassura-city" target="_blank" class="booking-image">
                    <div class="small-image">
                        <img src="{{ asset('images/images/book now/Tiket.com_logo 2 (1).png') }}" alt="Tiket.com Icon">
                    </div>
                    <img src="{{ asset('images/placeholder-bsc.jpg') }}" alt="Tiket.com Booking" class="main-image">
                    <div class="booking-overlay">
                        <span class="booking-text">Book via Tiket.com</span>
                    </div>
                </a>
            </div>
        </div>
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
                <li><a class="footer-section-available" href="{{ route('discoverGPC') }}">GRAND PRAMUKA CITY</a></li>
                <li><a class="footer-section-available" href="{{ route('discoverBSC') }}">BASSURA CITY</a></li>
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