# Blueprint: Rombak Sistem Analytics & Activity Tracking User

## 1. Analisis & Masalah Sistem Lama (Current State)
Sistem yang berjalan saat ini menggunakan `events_table` dan `tracking.js` yang memiliki beberapa kelemahan fundamental:

1.  **Duplicate Counting:** Script Frontend mengirim request `visit` setiap kali halaman direload atau navigasi *back/forward*. Tidak ada validasi sesi yang kuat di Backend.
2.  **Struktur Data:** Tabel `events` terlalu generic. Metadata disimpan dalam JSON yang sulit di-query secara spesifik untuk dashboard (misal: membedakan 'Booking' vs 'Visit' harus parsing JSON atau string matching).
3.  **No Session Debouncing:** Tidak ada pengecekan "apakah user ini baru saja mengunjungi halaman ini 5 detik yang lalu?".
4.  **Admin Disconnect:** Data tracking tersimpan tapi tidak ditampilkan di dashboard admin karena Controller admin masih menggunakan data *dummy* (kosong).

## 2. Solusi & Arsitektur Baru

Kita akan membuat sistem baru yang berfokus pada **Akurasi** dan **Kinerja**. Tidak perlu menginstall *kit/package* eksternal (seperti Google Analytics atau Spatie) agar sistem tetap ringan dan kita punya kontrol penuh atas datanya via Laravel Eloquent.

### A. Tabel Database Baru: `user_activities`
Kita akan meninggalkan tabel `events` dan membuat tabel baru yang lebih terstruktur.

```php
Schema::create('user_activities', function (Blueprint $table) {
    $table->id();
    $table->string('session_id')->index(); // ID unik dari browser user (localStorage)
    $table->string('ip_address', 45)->nullable();
    $table->string('user_agent')->nullable(); // Info device/browser
    
    // Tipe aktivitas: 'visit', 'click_book_now', 'click_download', 'submit_form', 'comment'
    $table->string('activity_type')->index(); 
    
    // Halaman tempat kejadian
    $table->string('page_url');
    $table->string('page_path'); // contoh: /discover-tpj (untuk filtering mudah)
    
    // Metadata spesifik (Nullable columns lebih cepat dari JSON untuk indexing sederhana)
    $table->string('apartment_type')->nullable(); // TPJ, GKL, dll
    $table->string('target_name')->nullable(); // Nama promo yg didownload / room yg dibooking
    
    $table->json('extra_data')->nullable(); // Data tambahan jika mendesak
    $table->timestamps();
});
```

### B. Prevention Logic (Anti-Double)
Di Backend (`ActivityController`), kita akan menerapkan logika **Debouncing**:

1.  **Untuk 'visit':** Jika `session_id` yang sama mengunjungi `page_url` yang sama dalam waktu **30 menit terakhir**, jangan simpan data baru (anggap 1 sesi kunjungan).
2.  **Untuk 'click' & 'submit':** Simpan setiap aksi, namun Frontend akan kita beri *delay* agar tombol tidak bisa diklik bar-bar (double click protection).

### C. Admin Dashboard Data
Sesuai request, Admin akan bisa melihat:
1.  **Total Visits (All Time)**
2.  **Visit Trends (Harian/Periode)**
3.  **Action Counters:** 
    *   Click Book Now
    *   Click Download Promo
    *   Form Data Submit (Actual submission log)
    *   Comment Posted (Events log)

---

## 3. Tahap Eksekusi (Step-by-Step)

### Tahap 1: Migration & Model
Membuat tabel baru dan Model Eloquent dengan *Scopes* untuk mempermudah query di Admin.

### Tahap 2: Backend Logic (Controller Baru)
Membuat `UserActivityController` untuk menangani API request dari Frontend.
Logika:
```php
// Pseudo-code logic
if ($type == 'visit') {
    $exists = UserActivity::where('session_id', $session)
        ->where('activity_type', 'visit')
        ->where('page_url', $currentUrl)
        ->where('created_at', '>=', now()->subMinutes(30))
        ->exists();
        
    if ($exists) return response()->json(['status' => 'ignored']);
}
```

### Tahap 3: Frontend Script Refactor
Update `tracking.js` untuk:
1.  Generate `session_id` yang persisten (simpan di LocalStorage).
2.  Mengirim parameter yang sesuai dengan tabel baru.
3.  Mencegah pengiriman data berulang saat reload cepat.

### Tahap 4: Admin Dashboard Integration
Menghubungkan `AdminDashboard\TrackingController` dengan model `UserActivity` baru.

---

## 4. Query Sheet (Panduan Query untuk Admin)

Berikut adalah syntax Eloquent yang akan kita gunakan untuk memenuhi fitur yang diminta:

**1. Total Kunjungan (Semua Hari)**
```php
$totalVisits = UserActivity::where('activity_type', 'visit')->count();
```

**2. Total Kunjungan (Periode Tertentu)**
```php
$periodVisits = UserActivity::where('activity_type', 'visit')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->count();
```

**3. Total Kunjungan Hari Ini**
```php
$todayVisits = UserActivity::where('activity_type', 'visit')
    ->whereDate('created_at', Carbon::today())
    ->count();
```

**4. Breakdown Aktivitas (Book Now, Download, Submit, Comment)**
```php
$actions = UserActivity::whereIn('activity_type', [
        'click_book_now', 
        'click_download', 
        'submit_form', 
        'comment'
    ])
    ->whereBetween('created_at', [$startDate, $endDate])
    ->select('activity_type', DB::raw('count(*) as total'))
    ->groupBy('activity_type')
    ->get();
```

---

## 5. Instruksi Selanjutnya
Jika Anda setuju dengan rencana ini, saya akan mulai melakukan eksekusi berurutan dari Tahap 1 sampai Tahap 4.
