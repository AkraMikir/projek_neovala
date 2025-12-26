# 🚀 ACTION PLAN - IMPLEMENTASI PERBAIKAN FRONTEND NEOVALA

## 📋 OVERVIEW

Dokumen ini berisi langkah-langkah konkret untuk memperbaiki frontend proyek Neovala agar lebih efektif, maintainable, dan menggunakan best practices.

---

## 🎯 TUJUAN

1. ✅ Menggunakan Vite untuk development & build
2. ✅ Mengurangi duplikasi kode dengan layout & components
3. ✅ Memperbaiki struktur CSS/JS
4. ✅ Meningkatkan developer experience
5. ✅ Memudahkan maintenance

---

## 📅 RENCANA IMPLEMENTASI (Phase by Phase)

### **PHASE 1: FOUNDATION (Prioritas Tertinggi)**

#### **Step 1.1: Setup Vite dengan Benar** ⏱️ 2-3 jam

**Tujuan**: Mengaktifkan Vite untuk HMR dan optimasi build

**Langkah-langkah**:

1. **Buat direktori resources jika belum ada**:
```bash
mkdir -p resources/css
mkdir -p resources/js
```

2. **Buat `resources/css/app.css`**:
```css
/* Import semua CSS yang ada di public/css */
@import '../../public/css/global.css';
@import '../../public/css/index.css';
@import '../../public/css/apartment.css';
@import '../../public/css/booknow.css';
@import '../../public/css/titipkunci.css';
@import '../../public/css/ourstory.css';
@import '../../public/css/admin.css';
```

3. **Buat `resources/js/app.js`**:
```javascript
// Import semua JS yang ada
import '../../public/js/script.js';
import '../../public/js/form-checkin.js';
import '../../public/js/admin.js';
import '../../public/js/tracking.js';
```

4. **Test Vite**:
```bash
npm run dev
```

5. **Update 1 view sebagai test** (misalnya `welcome.blade.php`):
```blade
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

**✅ Checklist**:
- [ ] File `resources/css/app.css` dibuat
- [ ] File `resources/js/app.js` dibuat
- [ ] `npm run dev` berjalan tanpa error
- [ ] HMR bekerja (ubah CSS, browser auto-reload)

---

#### **Step 1.2: Buat Layout System** ⏱️ 2-3 jam

**Tujuan**: Menghilangkan duplikasi HTML structure

**Langkah-langkah**:

1. **Buat `resources/views/layouts/app.blade.php`**:
```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tambahkan font lainnya sesuai kebutuhan -->
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/footer-logo.png') }}">
    
    <!-- Title -->
    <title>@yield('title', 'Neovala')</title>
    
    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])
    
    <!-- Additional CSS jika ada -->
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    @include('components.navbar')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('components.footer')
    
    <!-- Vite JS -->
    @vite(['resources/js/app.js'])
    
    <!-- Additional JS jika ada -->
    @stack('scripts')
</body>
</html>
```

2. **Buat `resources/views/layouts/head.blade.php`** (optional, untuk memisahkan head section):
```blade
<!-- Extract head section jika terlalu panjang -->
```

**✅ Checklist**:
- [ ] File `layouts/app.blade.php` dibuat
- [ ] Layout bisa digunakan di 1 view sebagai test

---

#### **Step 1.3: Componentize Navbar** ⏱️ 1-2 jam

**Tujuan**: Single source of truth untuk navbar

**Langkah-langkah**:

1. **Copy navbar code dari `index.blade.php`**
2. **Buat `resources/views/components/navbar.blade.php`**:
```blade
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
            <a href="{{ route('home') }}#home">
                <img src="{{ asset('images/logo/NEOVALA TRANSPARENT 1.png') }}" 
                     alt="Logo Neovala Light" class="logo-light">
            </a>
            <a href="{{ route('home') }}#home">
                <img src="{{ asset('images/logo/NEOVALA-DARK.png') }}" 
                     alt="Logo Neovala Dark" class="logo-dark">
            </a>
        </div>
        <ul class="nav-links">
            @yield('nav-links')
            <!-- Default nav links -->
            <li><a href="#apartment-section"><i class="bi bi-building"></i> Apartment</a></li>
            <li><a href="#titip-kunci-section"><i class="bi bi-key"></i> Titip Kunci</a></li>
            <li><a href="#promo-section"><i class="bi bi-gift"></i> Promo</a></li>
            <li><a href="#our-story-section"><i class="bi bi-people"></i> About Us</a></li>
            <li><a href="#comment-section"><i class="bi bi-chat-dots"></i> Testimoni</a></li>
            <li><a href="#footer"><i class="bi bi-geo-alt"></i> Find Us</a></li>
            <div class="sidebar-footer">
                <p><img src="{{ asset('images/logo/NEOVALA-DARK.png') }}" 
                        alt="Logo Neovala Dark" class="logo-sidebar">NEOVALA</p>
            </div>
        </ul>
        <div class="logo-right">
            <a href="{{ route('home') }}">NEOVALA</a>
        </div>
    </div>
</nav>
<div class="nav-overlay"></div>
```

3. **Update layout untuk include navbar**:
```blade
@include('components.navbar')
```

**✅ Checklist**:
- [ ] File `components/navbar.blade.php` dibuat
- [ ] Navbar bisa digunakan di layout
- [ ] Test di 1 view

---

#### **Step 1.4: Componentize Footer** ⏱️ 1-2 jam

**Tujuan**: Single source of truth untuk footer

**Langkah-langkah**:

1. **Copy footer code dari `index.blade.php`**
2. **Buat `resources/views/components/footer.blade.php`**
3. **Update layout untuk include footer**

**✅ Checklist**:
- [ ] File `components/footer.blade.php` dibuat
- [ ] Footer bisa digunakan di layout

---

#### **Step 1.5: Update Homepage untuk Menggunakan Layout** ⏱️ 2-3 jam

**Tujuan**: Refactor `index.blade.php` untuk menggunakan layout system

**Langkah-langkah**:

1. **Backup file original**:
```bash
cp resources/views/user/index.blade.php resources/views/user/index.blade.php.backup
```

2. **Refactor `index.blade.php`**:
```blade
@extends('layouts.app')

@section('title', 'Neovala - Premium Apartment Rental')

@section('content')
    <!-- Header dengan Carousel -->
    <header class="header" id="home">
        <!-- Copy content dari original, hapus <html>, <head>, <body>, navbar, footer -->
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Service container, apartment section, dll -->
    </main>

    <!-- Sections lainnya -->
@endsection

@push('scripts')
<script>
    // Script khusus untuk homepage jika ada
</script>
@endpush
```

3. **Test homepage**:
- Pastikan semua section muncul
- Pastikan styling masih benar
- Pastikan JavaScript masih bekerja

**✅ Checklist**:
- [ ] Homepage menggunakan layout
- [ ] Semua section muncul dengan benar
- [ ] Tidak ada broken styling
- [ ] JavaScript masih bekerja

---

### **PHASE 2: REFACTORING (Setelah Phase 1 Selesai)**
**Estimasi: 1-2 minggu**

#### **Step 2.1: Componentize Reusable Elements** ⏱️ 3-5 hari

**Tujuan**: Membuat components untuk elemen yang sering digunakan

**Components yang perlu dibuat**:

1. **`components/carousel.blade.php`**:
```blade
@props(['images', 'title' => null])

<div class="carousel">
    @if($title)
    <div class="header-text-overlay-discover">
        <p>{{ $title }}</p>
    </div>
    @endif
    
    <button class="carousel-button prev">&#10094;</button>
    <button class="carousel-button next">&#10095;</button>
    
    <div class="carousel-container">
        @foreach($images as $image)
        <div class="carousel-slide">
            <img src="{{ $image }}" alt="Slide">
        </div>
        @endforeach
    </div>
    
    <div class="carousel-dots">
        @foreach($images as $index => $image)
        <span class="dot {{ $index === 0 ? 'active' : '' }}"></span>
        @endforeach
    </div>
</div>
```

**Usage**:
```blade
<x-carousel :images="$carouselImages" title="GRAND KAMALA LAGOON" />
```

2. **`components/apartment-card.blade.php`**:
```blade
@props(['image', 'name', 'route'])

<div class="apartment-card">
    <div class="apartment-image">
        <img src="{{ $image }}" alt="{{ $name }}">
        <div class="apartment-content">
            <h3 class="apartment-name">{{ $name }}</h3>
            <a href="{{ $route }}" class="view-details-btn">DISCOVER</a>
        </div>
    </div>
</div>
```

3. **`components/comment-card.blade.php`**:
```blade
@props(['komentar'])

<div class="comment-card">
    <div class="comment-header">
        <span class="quote-icon">"</span>
        <h3 class="comment-location">{{ strtoupper($komentar->apartmen) }}</h3>
    </div>
    <p class="comment-text">{{ $komentar->isi }}</p>
    <div class="comment-footer">
        <span class="comment-user">{{ '@' . $komentar->instagram }}</span>
        <div class="star-rating">
            @for ($i = 0; $i < $komentar->bintang; $i++)
                <img src="{{ asset('images/logo/star-filled.png') }}" alt="Star" class="star-icon star-filled">
            @endfor
        </div>
    </div>
</div>
```

**✅ Checklist**:
- [ ] Carousel component dibuat
- [ ] Apartment card component dibuat
- [ ] Comment card component dibuat
- [ ] Components digunakan di views

---

#### **Step 2.2: Refactor Discover Pages** ⏱️ 5-7 hari

**Tujuan**: Menggabungkan 8 halaman discover menjadi 1 template

**Langkah-langkah**:

1. **Analisis perbedaan antara discover pages**:
   - Apa yang sama? (navbar, footer, struktur)
   - Apa yang berbeda? (title, images, data)

2. **Buat template `resources/views/user/discover.blade.php`**:
```blade
@extends('layouts.app')

@section('title', 'Discover ' . $apartmentName)

@section('content')
    <!-- Header dengan Carousel -->
    <header class="header" id="home">
        <x-carousel :images="$carouselImages" :title="$apartmentName" />
    </header>

    <!-- Book Now Button -->
    <div class="book-now-container visible">
        <a href="{{ route('bookNow') }}" class="book-now-btn">
            <div class="book-now-icon">
                <img src="{{ asset('images/logo/book-now.png') }}" alt="">
            </div>
            <span>BOOK NOW</span>
        </a>
    </div>

    <!-- Facilities Section -->
    <section class="facilities-section" id="facilities-section">
        <h2 class="facilities-title">OUR FACILITIES</h2>
        <!-- Facilities content -->
    </section>

    <!-- Room Section -->
    <section class="room-section" id="room-section">
        <h2 class="room-title">ROOM {{ $apartmentName }}</h2>
        <!-- Room content -->
    </section>

    <!-- Testimoni Section -->
    <section class="testimoni-section" id="testimoni-section">
        <h2 class="testimoni-title">WHAT THEY SAY?</h2>
        @foreach($komentars as $komentar)
            <x-comment-card :komentar="$komentar" />
        @endforeach
    </section>
@endsection
```

3. **Update Controller untuk mengirim data yang sama**:
```php
// TampilanApartmentController.php
public function gkl() {
    return view('user.discover', [
        'apartmentName' => 'GRAND KAMALA LAGOON',
        'carouselImages' => $this->getCarouselImages('gkl'),
        'roomsFormatted' => $this->getRooms('gkl'),
        'komentars' => $this->getKomentars('gkl'),
        // ... data lainnya
    ]);
}
```

4. **Update routes (optional, bisa tetap pakai route terpisah)**:
```php
// Tetap pakai route terpisah, tapi semua return view yang sama
Route::get('/discover-gkl', [TampilanApartmentController::class, 'gkl'])->name('discoverGKL');
Route::get('/discover-gwc', [TampilanApartmentController::class, 'gwc'])->name('discoverGWC');
// ... dll
```

5. **Test setiap discover page**:
- Pastikan semua data muncul dengan benar
- Pastikan styling masih benar
- Pastikan tidak ada broken links

**✅ Checklist**:
- [ ] Template `discover.blade.php` dibuat
- [ ] Controller diupdate untuk semua apartment
- [ ] Semua 8 discover pages menggunakan template yang sama
- [ ] Semua halaman di-test dan bekerja dengan benar

---

#### **Step 2.3: Update Semua Views untuk Menggunakan Layout** ⏱️ 2-3 hari

**Tujuan**: Konsistensi di semua halaman

**Langkah-langkah**:

1. **Update `bookNow.blade.php`**
2. **Update `ourStory.blade.php`**
3. **Update `titipKunci.blade.php`**
4. **Update admin views (jika perlu)**

**✅ Checklist**:
- [ ] Semua user-facing views menggunakan layout
- [ ] Tidak ada broken styling
- [ ] Semua JavaScript masih bekerja

---

### **PHASE 3: ENHANCEMENT (Optional, Setelah Phase 2)**
**Estimasi: 1-2 minggu**

#### **Step 3.1: Organisasi CSS** ⏱️ 2-3 hari

**Tujuan**: Struktur CSS yang lebih terorganisir

**Langkah-langkah**:

1. **Reorganisasi CSS berdasarkan komponen**:
```
resources/css/
├── app.css (main file)
├── base/
│   ├── reset.css
│   ├── typography.css
│   └── variables.css
├── components/
│   ├── navbar.css
│   ├── footer.css
│   ├── carousel.css
│   └── card.css
└── pages/
    ├── home.css
    ├── discover.css
    └── admin.css
```

2. **Update `resources/css/app.css`**:
```css
/* Base */
@import './base/reset.css';
@import './base/typography.css';
@import './base/variables.css';

/* Components */
@import './components/navbar.css';
@import './components/footer.css';
@import './components/carousel.css';

/* Pages */
@import './pages/home.css';
@import './pages/discover.css';
```

---

#### **Step 3.2: JavaScript Modularization** ⏱️ 2-3 hari

**Tujuan**: JavaScript yang lebih terorganisir

**Langkah-langkah**:

1. **Buat struktur modules**:
```
resources/js/
├── app.js (main file)
├── modules/
│   ├── navbar.js
│   ├── carousel.js
│   ├── form-validation.js
│   └── tracking.js
```

2. **Update `resources/js/app.js`**:
```javascript
// Import modules
import './modules/navbar.js';
import './modules/carousel.js';
import './modules/form-validation.js';
import './modules/tracking.js';
```

---

## 🎯 PRIORITAS IMPLEMENTASI

### **MINGGU 1: Foundation**
- ✅ Day 1-2: Setup Vite
- ✅ Day 3-4: Layout System + Navbar/Footer Components
- ✅ Day 5: Update Homepage

### **MINGGU 2-3: Refactoring**
- ✅ Week 2: Componentize reusable elements
- ✅ Week 3: Refactor discover pages + update semua views

### **MINGGU 4: Enhancement (Optional)**
- ✅ Organisasi CSS/JS
- ✅ Testing & bug fixes

---

## ✅ CHECKLIST AKHIR

Setelah semua phase selesai, pastikan:

- [ ] Vite bekerja dengan baik (HMR, build)
- [ ] Semua views menggunakan layout system
- [ ] Navbar & footer di-componentize
- [ ] Discover pages menggunakan 1 template
- [ ] Tidak ada duplikasi kode
- [ ] Semua halaman di-test dan bekerja
- [ ] Tidak ada broken styling
- [ ] JavaScript masih bekerja dengan baik
- [ ] Performance tidak menurun

---

## 🚨 PENTING: BACKUP & TESTING

**Sebelum memulai**:
1. ✅ Commit semua perubahan saat ini ke Git
2. ✅ Buat branch baru: `git checkout -b refactor/frontend-improvements`
3. ✅ Test setiap perubahan sebelum lanjut ke step berikutnya

**Setelah setiap step**:
1. ✅ Test di browser
2. ✅ Commit perubahan
3. ✅ Pastikan tidak ada breaking changes

---

## 📝 CATATAN

- **Jangan refactor semua sekaligus**: Lakukan step by step, test setiap step
- **Backup penting**: Selalu backup sebelum perubahan besar
- **Test terus**: Test di browser setelah setiap perubahan
- **Git commit**: Commit setiap step yang berhasil

---

**Status**: Ready to Implement  
**Created**: 2025-01-XX  
**Version**: 1.0

