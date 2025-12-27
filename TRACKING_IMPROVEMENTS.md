# Perbaikan Sistem Tracking Neovala

## 📋 Ringkasan Perbaikan

Sistem tracking telah diperbaiki untuk mengatasi masalah:
1. ✅ **Duplicate visits** - Refresh halaman tidak lagi menambah visit baru
2. ✅ **Data tidak akurat** - Implementasi deduplication di frontend dan backend
3. ✅ **Unique visitor tracking** - Tracking pengunjung unik berdasarkan IP
4. ✅ **Improved dashboard** - Tampilan dashboard yang lebih baik dan informatif

---

## 🔧 Perubahan yang Dilakukan

### 1. Frontend (tracking.js)

**Perbaikan:**
- ✅ Session-based tracking menggunakan `sessionStorage`
- ✅ Visit hanya di-track sekali per URL per session
- ✅ Session ID persisten selama 30 menit
- ✅ Mencegah duplicate tracking saat refresh

**Cara Kerja:**
- Setiap session memiliki ID unik yang tersimpan di `sessionStorage`
- Visit hanya di-track jika URL belum pernah di-track dalam session ini
- Session berlaku selama 30 menit

### 2. Backend (EventController.php)

**Perbaikan:**
- ✅ Deduplication window: 30 detik untuk visit, 10 detik untuk event lainnya
- ✅ Cek duplicate berdasarkan IP + URL + waktu
- ✅ Unique visitor tracking berdasarkan IP address
- ✅ Statistik yang lebih akurat

**Deduplication Logic:**
```php
// Visit: Cek duplicate dalam 30 detik terakhir
// Event lain: Cek duplicate dalam 10 detik terakhir
// Jika ada event yang sama (IP + URL + waktu), skip tracking
```

### 3. Dashboard (tracking.blade.php)

**Perbaikan:**
- ✅ Menampilkan **Unique Visitors** (pengunjung unik berdasarkan IP)
- ✅ Menampilkan **Total Visits** (total page views)
- ✅ Statistik hari ini yang lebih akurat
- ✅ Design yang lebih baik dengan hover effects
- ✅ Responsive untuk mobile

**Statistik Baru:**
- **Unique Visitors**: Jumlah IP address unik yang mengunjungi website
- **Total Visits**: Total page views (setelah deduplication)
- **Today Stats**: Statistik khusus untuk hari ini

---

## 🧹 Membersihkan Data Duplicate yang Sudah Ada

Jika Anda memiliki data duplicate dari sebelum perbaikan, gunakan command berikut:

### 1. Preview Duplicate (Dry Run)

```bash
php artisan events:clean-duplicates --days=30 --dry-run
```

Command ini akan menampilkan duplicate yang akan dihapus tanpa benar-benar menghapusnya.

### 2. Hapus Duplicate

```bash
php artisan events:clean-duplicates --days=30
```

**Parameter:**
- `--days=30`: Cek duplicate dalam 30 hari terakhir (default: 30)
- `--dry-run`: Preview saja, tidak menghapus (opsional)

**Contoh:**
```bash
# Cek duplicate 7 hari terakhir (preview)
php artisan events:clean-duplicates --days=7 --dry-run

# Hapus duplicate 7 hari terakhir
php artisan events:clean-duplicates --days=7
```

---

## 📊 Cara Membaca Statistik Baru

### Unique Visitors vs Total Visits

- **Unique Visitors**: Jumlah pengunjung unik (berdasarkan IP)
  - Contoh: 100 unique visitors berarti 100 IP address berbeda
  
- **Total Visits**: Total page views
  - Contoh: 500 total visits berarti 500 kali halaman dilihat
  - Satu visitor bisa menghasilkan multiple visits

### Conversion Rate

Conversion rate dihitung berdasarkan:
- **Booking Rate**: (Book Now / Unique Visitors) × 100%
- **Promo Engagement**: (Download Promo / Unique Visitors) × 100%
- **Form Completion**: (Form Submit / Unique Visitors) × 100%

---

## 🔍 Testing

### Test Deduplication

1. Buka website di browser
2. Refresh halaman beberapa kali
3. Cek di dashboard: Visit seharusnya hanya bertambah 1 kali per session

### Test Unique Visitors

1. Buka website dari beberapa device/IP berbeda
2. Cek di dashboard: Unique Visitors seharusnya sesuai dengan jumlah IP berbeda

### Test Event Tracking

1. Klik "Book Now" beberapa kali dalam 10 detik
2. Cek di dashboard: Event seharusnya hanya tercatat 1 kali

---

## ⚙️ Konfigurasi

### Deduplication Window

Jika ingin mengubah waktu deduplication, edit di `EventController.php`:

```php
private function getDeduplicationWindow(string $eventName): int
{
    // Visit: 30 detik (prevent refresh spam)
    // Other events: 10 detik (prevent double-click)
    return $eventName === 'visit' ? 30 : 10;
}
```

### Session Duration

Jika ingin mengubah durasi session, edit di `tracking.js`:

```javascript
const sessionExpiry = 30 * 60 * 1000; // 30 minutes (ubah sesuai kebutuhan)
```

---

## 📈 Monitoring

### Dashboard Auto-Refresh

Dashboard akan auto-refresh setiap 30 detik untuk menampilkan data terbaru.

### Log Tracking

Error tracking akan tercatat di `storage/logs/laravel.log` untuk debugging.

---

## 🚨 Troubleshooting

### Masih Ada Duplicate?

1. **Clear browser cache dan sessionStorage**
   - Buka Developer Tools (F12)
   - Application > Session Storage
   - Hapus semua data `neovala_*`

2. **Cek deduplication window**
   - Pastikan waktu deduplication sudah sesuai
   - Cek di `EventController.php`

3. **Run cleanup command**
   ```bash
   php artisan events:clean-duplicates --days=7
   ```

### Statistik Tidak Akurat?

1. **Clear config cache**
   ```bash
   php artisan config:clear
   ```

2. **Cek database**
   - Pastikan tidak ada event dengan timestamp yang sama
   - Cek IP address dan URL

3. **Verifikasi deduplication bekerja**
   - Test dengan refresh halaman
   - Cek apakah visit tidak bertambah

---

## ✅ Checklist Setelah Update

- [ ] Test deduplication dengan refresh halaman
- [ ] Cek unique visitors di dashboard
- [ ] Run cleanup command untuk hapus duplicate lama (opsional)
- [ ] Verifikasi statistik sesuai dengan ekspektasi
- [ ] Test tracking dari beberapa device/IP berbeda

---

## 📝 Catatan Penting

1. **Data Lama**: Data duplicate yang sudah ada sebelum update tidak akan otomatis terhapus. Gunakan cleanup command jika diperlukan.

2. **Session Storage**: Tracking menggunakan `sessionStorage`, jadi data akan hilang jika:
   - User menutup browser
   - Session expired (30 menit)
   - User clear browser data

3. **IP-based Tracking**: Unique visitors dihitung berdasarkan IP address. Beberapa user di belakang NAT/proxy akan terhitung sebagai 1 visitor.

4. **Privacy**: IP address disimpan untuk tracking. Pastikan sesuai dengan privacy policy.

---

**Last Updated**: {{ date('Y-m-d H:i:s') }}

