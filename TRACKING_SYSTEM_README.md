# Neovala Event Tracking System

## Overview
Sistem tracking event untuk website Neovala yang memungkinkan admin untuk memantau aktivitas pengunjung secara real-time.

## Fitur Tracking
1. **Dikunjungi (Visit)** - Mencatat setiap kunjungan ke halaman website
2. **Unduh Promo (Download Promo)** - Mencatat klik tombol download promo
3. **Click Book Now** - Mencatat klik tombol booking
4. **Click Form Data** - Mencatat submit form data

## Komponen Sistem

### 1. Database
- **Tabel**: `events`
- **Kolom**:
  - `id` - Primary key
  - `event_name` - Nama event (visit, download_promo, book_now, form_submit)
  - `ip_address` - Alamat IP pengunjung
  - `user_agent` - Informasi browser/device
  - `url` - URL halaman saat event terjadi
  - `referrer` - Halaman referrer
  - `metadata` - Data tambahan (JSON)
  - `created_at`, `updated_at` - Timestamp

### 2. Backend (Laravel)
- **Model**: `App\Models\Event`
- **Controller**: `App\Http\Controllers\EventController`
- **Routes**:
  - `POST /api/track` - Track event
  - `GET /api/dashboard-stats` - Get statistics
  - `GET /api/event-details` - Get event details
  - `GET /admin/tracking` - Admin dashboard

### 3. Frontend (JavaScript)
- **File**: `public/js/tracking.js`
- **Class**: `NeovalaTracker`
- **Fitur**:
  - Auto track page visits
  - Track download promo clicks
  - Track book now clicks
  - Track form submissions
  - Track apartment discovery
  - Track time on page

### 4. Admin Dashboard
- **File**: `resources/views/admin/tracking.blade.php`
- **Fitur**:
  - Statistik real-time
  - Filter berdasarkan waktu
  - Aktivitas terbaru
  - Auto refresh setiap 30 detik

## Cara Penggunaan

### 1. Akses Admin Dashboard
1. Login ke admin panel
2. Klik menu "Analytics" di sidebar
3. Pilih "Event Tracking"

### 2. Melihat Statistik
- **Total Kunjungan**: Jumlah kunjungan ke website
- **Download Promo**: Jumlah klik download promo
- **Click Book Now**: Jumlah klik tombol booking
- **Form Data Submit**: Jumlah form yang disubmit

### 3. Filter Data
- Pilih periode waktu (7, 30, atau 90 hari)
- Klik tombol "Refresh" untuk update data

## Integrasi dengan Halaman

### Halaman yang Sudah Terintegrasi:
- `index.blade.php` - Homepage
- `discover-TPJ.blade.php` - Transpark Juanda
- `discover-TPC.blade.php` - Transpark Cibubur
- `discover-GKL.blade.php` - Grand Kamala Lagoon
- `discover-PLU.blade.php` - Patraland Urbano
- `discover-GWC.blade.php` - Gateway Cicadas
- `discover-PGV.blade.php` - Podomoro Golf View
- `discover-GPC.blade.php` - Green Pramuka City
- `discover-BSC.blade.php` - Bassura City
- `bookNow.blade.php` - Book Now page
- `ourStory.blade.php` - Our Story page
- `titipKunci.blade.php` - Titip Kunci page

### Cara Menambahkan Tracking ke Halaman Baru:
1. Tambahkan CSRF token di `<head>`:
   ```html
   <meta name="csrf-token" content="{{ csrf_token() }}">
   ```

2. Tambahkan script tracking sebelum `</body>`:
   ```html
   <script src="{{ asset('js/tracking.js') }}"></script>
   ```

3. Untuk tracking khusus (opsional):
   ```javascript
   <script>
   document.addEventListener('DOMContentLoaded', function() {
       if (window.neovalaTracker) {
           window.neovalaTracker.trackEvent('custom_event', {
               custom_data: 'value'
           });
       }
   });
   </script>
   ```

## API Endpoints

### Track Event
```
POST /api/track
Content-Type: application/json

{
    "event_name": "visit|download_promo|book_now|form_submit",
    "url": "https://example.com/page",
    "referrer": "https://example.com/referrer",
    "metadata": {
        "custom_data": "value"
    }
}
```

### Get Dashboard Stats
```
GET /api/dashboard-stats?days=30
```

### Get Event Details
```
GET /api/event-details?event_name=visit&days=30&page=1&per_page=20
```

## Styling
- Menggunakan warna konsisten: `#674c1d`
- Icon menggunakan Bootstrap Icons outline
- Responsive design untuk mobile dan desktop
- Auto refresh setiap 30 detik

## Keamanan
- CSRF protection untuk semua API calls
- Validasi input di backend
- Rate limiting (dapat ditambahkan jika diperlukan)

## Monitoring
- Real-time tracking tanpa page refresh
- Error handling untuk network issues
- Console logging untuk debugging

## Pengembangan Selanjutnya
1. **Grafik**: Tambahkan chart.js untuk visualisasi data
2. **Export**: Fitur export data ke Excel/CSV
3. **Filter**: Filter berdasarkan IP, user agent, dll
4. **Alerts**: Notifikasi untuk event tertentu
5. **Analytics**: Integrasi dengan Google Analytics
6. **Heatmap**: Visualisasi klik pengunjung

## Troubleshooting

### Event Tidak Tercatat
1. Periksa console browser untuk error
2. Pastikan CSRF token tersedia
3. Periksa network tab untuk request ke `/api/track`
4. Pastikan JavaScript tracking.js dimuat

### Dashboard Tidak Update
1. Periksa koneksi internet
2. Refresh halaman manual
3. Periksa console untuk error JavaScript
4. Pastikan route `/admin/tracking` dapat diakses

### Data Tidak Muncul
1. Pastikan migration sudah dijalankan
2. Periksa database connection
3. Pastikan ada aktivitas pengunjung
4. Periksa log Laravel untuk error
