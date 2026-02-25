@extends('layouts.app')

@section('title', 'Guest Service - Neovala')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/guestservice.css') }}">
@endpush

@section('nav-links')
    <li><a href="{{ route('home') }}#apartment-section"><i class="bi bi-building"></i> Apartment</a></li>
    <li><a href="{{ route('titipKunci') }}"><i class="bi bi-key"></i> Titip Kunci</a></li>
    <li><a href="{{ route('home') }}#promo-section"><i class="bi bi-gift"></i> Promo</a></li>
    <li><a href="{{ route('ourStory') }}"><i class="bi bi-people"></i> About Us</a></li>
    <li><a href="{{ route('home') }}#comment-section"><i class="bi bi-chat-dots"></i> Testimoni</a></li>
    <li><a href="#footer"><i class="bi bi-geo-alt"></i> Find Us</a></li>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="guest-service-hero" data-scroll-animate="fade-up">
        <div class="guest-service-hero-background">
            <img src="{{ asset('images/images/home pages/DJI_20250307171433_0096_D.webp') }}" alt="Guest Service Hero" class="hero-bg-image" fetchpriority="high">
            <div class="hero-overlay"></div>
        </div>
        <div class="guest-service-hero-content">
            <div class="hero-icon-wrapper">
                <i class="bi bi-headset"></i>
            </div>
            <h1 class="hero-title">GUEST SERVICE</h1>
            <p class="hero-subtitle">Layanan Pelanggan 24/7 - Tim profesional kami siap membantu kebutuhan Anda kapan saja</p>
            <div class="hero-features">
                <div class="hero-feature-item">
                    <i class="bi bi-clock-history"></i>
                    <span>24/7 Support</span>
                </div>
                <div class="hero-feature-item">
                    <i class="bi bi-telephone-fill"></i>
                    <span>Hotline Service</span>
                </div>
                <div class="hero-feature-item">
                    <i class="bi bi-chat-dots-fill"></i>
                    <span>Live Chat</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Guest Service Main Section -->
    <section class="guest-service-main-section" data-scroll-animate="fade-up">
        <div class="guest-service-wrapper">
            <div class="guest-service-intro">
                <h1 class="guest-service-main-title">GUEST SERVICE</h1>
                <p class="guest-service-main-subtitle">
                    Kami berkomitmen memberikan pelayanan terbaik untuk memastikan pengalaman menginap Anda berkesan dan nyaman.
                </p>
            </div>

            <!-- Service Features Grid -->
            <div class="service-features-grid">
                <div class="service-feature-card" data-scroll-animate="fade-up">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h3 class="feature-title">24/7 Support</h3>
                    <p class="feature-description">
                        Tim kami tersedia 24 jam sehari, 7 hari seminggu untuk membantu kebutuhan Anda kapan saja.
                    </p>
                </div>

                <div class="service-feature-card" data-scroll-animate="fade-up">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <h3 class="feature-title">Hotline Service</h3>
                    <p class="feature-description">
                        Hubungi kami melalui hotline untuk bantuan cepat dan responsif. Kami siap membantu dengan ramah dan profesional.
                    </p>
                </div>

                <div class="service-feature-card" data-scroll-animate="fade-up">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-chat-dots-fill"></i>
                    </div>
                    <h3 class="feature-title">Live Chat</h3>
                    <p class="feature-description">
                        Chat langsung dengan tim kami melalui WhatsApp untuk mendapatkan bantuan instan dan informasi terkini.
                    </p>
                </div>

                <div class="service-feature-card" data-scroll-animate="fade-up">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-question-circle-fill"></i>
                    </div>
                    <h3 class="feature-title">FAQ & Help</h3>
                    <p class="feature-description">
                        Akses informasi lengkap tentang layanan kami, kebijakan, dan jawaban untuk pertanyaan umum.
                    </p>
                </div>

                <div class="service-feature-card" data-scroll-animate="fade-up">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <h3 class="feature-title">Booking Assistance</h3>
                    <p class="feature-description">
                        Butuh bantuan untuk booking atau perubahan jadwal? Tim kami siap membantu proses reservasi Anda.
                    </p>
                </div>

                <div class="service-feature-card" data-scroll-animate="fade-up">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <h3 class="feature-title">Feedback & Review</h3>
                    <p class="feature-description">
                        Sampaikan masukan dan pengalaman Anda. Setiap feedback membantu kami meningkatkan kualitas layanan.
                    </p>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="contact-info-section">
                <h2 class="contact-section-title">Hubungi Kami</h2>
                <div class="contact-methods">
                    <div class="contact-method-card" data-scroll-animate="fade-up">
                        <div class="contact-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <h3 class="contact-method-title">Telepon</h3>
                        <p class="contact-method-info">0896-6964-9690</p>
                        <p class="contact-method-desc">Tersedia 24/7</p>
                    </div>

                    <div class="contact-method-card" data-scroll-animate="fade-up">
                        <div class="contact-icon whatsapp">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <h3 class="contact-method-title">WhatsApp</h3>
                        <a href="https://wa.me/6287815933353" class="contact-method-link" target="_blank">
                            Chat Sekarang
                        </a>
                        <p class="contact-method-desc">Respon cepat</p>
                    </div>

                    <div class="contact-method-card" data-scroll-animate="fade-up">
                        <div class="contact-icon email">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <h3 class="contact-method-title">Email</h3>
                        <p class="contact-method-info">neovalaofficial@gmail.com</p>
                        <p class="contact-method-desc">Respon dalam 24 jam</p>
                    </div>
                </div>
            </div>

            <!-- Service Hours Section -->
            <div class="service-hours-section">
                <div class="service-hours-card" data-scroll-animate="fade-up">
                    <h2 class="service-hours-title">
                        <i class="bi bi-clock-fill"></i> Jam Layanan
                    </h2>
                    <div class="hours-content">
                        <div class="hours-item">
                            <span class="hours-day">Senin - Minggu</span>
                            <span class="hours-time">24 Jam Non-Stop</span>
                        </div>
                        <p class="hours-note">
                            Tim Guest Service kami siap membantu Anda kapan saja, termasuk hari libur nasional.
                        </p>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="faq-section" data-scroll-animate="fade-up">
                <h2 class="faq-section-title">Pertanyaan Umum</h2>
                <div class="faq-container">
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Bagaimana cara melakukan booking?</h3>
                            <i class="bi bi-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Anda dapat melakukan booking melalui website kami, menghubungi hotline, atau chat WhatsApp. Tim kami akan membantu proses booking Anda dengan cepat dan mudah.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Apakah bisa mengubah jadwal check-in?</h3>
                            <i class="bi bi-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Ya, Anda dapat mengubah jadwal check-in. Silakan hubungi tim Guest Service kami minimal 24 jam sebelum tanggal check-in yang dijadwalkan untuk melakukan perubahan.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Metode pembayaran apa saja yang diterima?</h3>
                            <i class="bi bi-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Kami menerima pembayaran melalui BCA, Mandiri, QRIS, dan pembayaran di tempat. Informasi lebih lanjut dapat ditanyakan kepada tim Guest Service.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Bagaimana jika ada masalah selama menginap?</h3>
                            <i class="bi bi-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Jika Anda mengalami masalah selama menginap, segera hubungi tim Guest Service kami melalui hotline atau WhatsApp. Kami akan segera menangani masalah Anda dengan cepat dan profesional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Book Now Button -->
    <div class="book-now-container visible">
        <a href="{{ route('bookNow') }}" class="book-now-btn">
            <div class="book-now-icon"><img src="{{ asset('images/logo/book-now.webp') }}" alt=""></div>
            <span>BOOK NOW</span>
        </a>
    </div>
@endsection

@push('scripts')
    <script>
        // FAQ Toggle Functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                const faqItem = this.parentElement;
                const answer = faqItem.querySelector('.faq-answer');
                const icon = this.querySelector('i');
                
                // Close other open FAQs
                document.querySelectorAll('.faq-item').forEach(item => {
                    if (item !== faqItem && item.classList.contains('active')) {
                        item.classList.remove('active');
                        item.querySelector('.faq-answer').style.maxHeight = null;
                        item.querySelector('.faq-question i').style.transform = 'rotate(0deg)';
                    }
                });
                
                // Toggle current FAQ
                faqItem.classList.toggle('active');
                if (faqItem.classList.contains('active')) {
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    icon.style.transform = 'rotate(180deg)';
                } else {
                    answer.style.maxHeight = null;
                    icon.style.transform = 'rotate(0deg)';
                }
            });
        });
    </script>
@endpush

