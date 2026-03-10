# 🎁 Analisis Section Promo — Projek Neovala (Frontend Only)

Dokumen ini menjelaskan secara lengkap cara komponen **Promo Check-In Neovala** dibuat dari sisi tampilan (*frontend*), serta kode yang diperlukan jika Anda ingin menduplikasi layout dan fungsionalitas popup promo ini ke halaman html atau blade yang lain.

---

## 🧱 Struktur Komponen

Section Promo ini ("PROMO CHECK-IN NEOVALA") pada dasarnya terdiri dari 3 bagian tampilan:
1. **Struktur HTML**: Memiliki area judul, sebuah slider horizontal untuk kumpulan kartu promo, dan sebuah area khusus *Popup Modal* tersembunyi yang akan muncul jika tombol diklik.
2. **Styling (CSS)**: Diambil dari file `index.css`. Pengaturan ini membuat warna background menjadi coklat, layout kartu agar sejajar rapi (*horizontal scroll*), efek *hover* yang lembut, serta efek layar redup (*overlay*) saat popup modal muncul.
3. **Interaktivitas (JavaScript)**: Skrip sederhana untuk menampilkan dialog panduan ("Cara Download Promo") saat tombol "Selengkapnya" ditekan, serta untuk menutup dialog tersebut.

---

## 📁 File Referensi

Semua aset tampilan ini terpusat di:
- **HTML (Blade Asli):** `resources/views/user/index.blade.php`
- **CSS Stylesheet:** `public/css/index.css`

---

## 🚀 Kode yang Dibutuhkan untuk Menduplikasi

Berikut adalah potongan kode murni *frontend* (HTML utuh beserta Dummy/Contoh Konten statik) yang perlu Anda *copy-paste* ke halaman tujuan.

### 1. Struktur HTML Promo Slider & Modal
Paste bagian ini di tempat Anda ingin section Promo ini muncul (misal: di atas footer halaman apartemen spesifik).

```html
<!-- ============================================== -->
<!-- 1. SECTION PROMO UTAMA                         -->
<!-- ============================================== -->
<section class="promo-section" id="promo-section">
    <h2 class="promo-title">PROMO CHECK-IN NEOVALA</h2>

    <!-- Area Slider (Scroll Horizontal) -->
    <div class="slider-container">
        
        <!-- MULAI: Contoh 1 Kartu Promo -->
        <!-- (Ulangi blok .card ini sebanyak jumlah promo yang ingin ditampilkan) -->
        <div class="card">
            <h3 class="card-title">Promo Longstay 30 Hari</h3>
            <div class="card-image-wrapper">
                <!-- Ganti src dengan path gambar promo Anda -->
                <img src="/path/to/gambar-promo1.jpg" alt="Promo Longstay" class="card-image" loading="lazy">
            </div>
            
            <!-- Tombol Download Promo -->
            <a href="/path/to/gambar-promo1-full.jpg" class="download-btn" target="_blank">
                <i class="bi bi-download"></i>
                <span>DOWNLOAD PROMO</span>
            </a>
        </div>
        <!-- AKHIR: Contoh 1 Kartu Promo -->

        <!-- Contoh Kartu ke-2 -->
        <div class="card">
            <h3 class="card-title">Promo Weekdays Getaway</h3>
            <div class="card-image-wrapper">
                <img src="/path/to/gambar-promo2.jpg" alt="Promo Weekdays" class="card-image" loading="lazy">
            </div>
            <a href="/path/to/gambar-promo2-full.jpg" class="download-btn" target="_blank">
                <i class="bi bi-download"></i>
                <span>DOWNLOAD PROMO</span>
            </a>
        </div>

    </div>

    <!-- Teks Penjelasan di Bawah Slider -->
    <p class="promo-text">
        Nikmati Promo Eksklusif dengan Mudah!
        Kami di Neovala selalu berkomitmen untuk memberikan pengalaman terbaik bagi pelanggan kami. Kini, kami
        menghadirkan promo eksklusif yang lebih mudah dan cepat untuk diakses. Tidak perlu repot – cukup download
        gambar promo yang sudah kami sediakan di website ini, dan Anda langsung dapat mengajukan promo yang
        diinginkan.
    </p>

    <!-- Tombol untuk Membuka Popup Panduan -->
    <div style="text-align:center; margin-top: 30px;">
        <a href="#" class="view-more-btn-promo">
            <span>Selengkapnya</span>
            <i class="bi bi-arrow-right-circle-fill"></i>
        </a>
    </div>
</section>


<!-- ============================================== -->
<!-- 2. POPUP MODAL CARA APPLY PROMO (Tersembunyi)  -->
<!-- ============================================== -->
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
```

---

### 2. Memastikan CSS Berjalan
Pastikan halaman di mana Anda menempelkan kode di atas sudah terhubung (memanggil) file `index.css`. Ciri-cirinya ada link stylesheet di tag `<head>` halaman HTML / Layout Blade seperti ini:

```html
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
```

*Catatan: Style `.promo-section`, `.card`, `.promo-modal` semuanya tersedia di file css ini.*

---

### 3. JavaScript (Logika Buka/Tutup Modal)
Letakkan kode JS ini di tag `<script>` paling bawah pada halaman target, atau di block bagian *scripts* jika menggunakan layout Laravel (`@push('scripts')`).

Fungsi JS ini memastikan tombol "Selengkapnya" dapat membuka layar peringatan (modal) dan memastikan bahwa *layer* belakangnya tidak bisa di-*scroll* sembarangan.

```html
<script>
    // ---------------------------------------------------- //
    // Script Logika Popup / Modal "Cara Download Promo"    //
    // ---------------------------------------------------- //

    // 1. Membuka Modal saat class view-more-btn-promo diklik
    document.querySelectorAll('.view-more-btn-promo').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const promoModal = document.getElementById('promoModal');
            if (promoModal) {
                promoModal.style.display = 'block';           // Tampilkan Modal
                document.body.style.overflow = 'hidden';      // Kunci scroll halaman belakang
            }
        });
    });

    // 2. Fungsi untuk Menutup Modal promo
    function closePromoModal() {
        const promoModal = document.getElementById('promoModal');
        if (promoModal) {
            promoModal.style.display = 'none';                // Sembunyikan Modal
            
            // Kembalikan kemampuan scroll (kecuali ada popup lain yang masih aktif)
            const activePopups = document.querySelectorAll('.popup-overlay[style*="flex"], .popup-overlay.active');
            if (activePopups.length === 0) {
                document.body.style.overflow = 'auto'; 
            }
        }
    }

    // 3. Trigger penutup modal: Saat tekan tombol "X"
    const closePromoModalBtn = document.getElementById('closePromoModal');
    if (closePromoModalBtn) {
        closePromoModalBtn.onclick = closePromoModal;
    }

    // 4. Trigger penutup modal: Saat klik area kosong di luar kotak popup (overlay)
    const promoModalOverlay = document.querySelector('.promo-modal-overlay');
    if (promoModalOverlay) {
        promoModalOverlay.onclick = closePromoModal;
    }

    // 5. Trigger penutup modal: Saat menekan tombol 'Escape' di keyboard
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const promoModal = document.getElementById('promoModal');
            if (promoModal && promoModal.style.display === 'block') {
                closePromoModal();
            }
        }
    });

</script>
```

---

Dengan mengikuti instruksi copy-paste blok HTML, memastikan CSS terpasang, dan meletakkan Javascript di atas, komponen section Promo akan berjalan mulus di halaman (*frontend*) manapun yang  diinginkan.
