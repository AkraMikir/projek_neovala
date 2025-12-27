# Setup Meta Ads & Google Ads Tracking untuk Neovala

Dokumentasi ini menjelaskan cara setup dan menggunakan tracking Meta Ads (Facebook Pixel) dan Google Ads di aplikasi Laravel Neovala.

## 📋 Daftar Isi

1. [Overview](#overview)
2. [Persiapan](#persiapan)
3. [Setup Meta Ads (Facebook Pixel)](#setup-meta-ads-facebook-pixel)
4. [Setup Google Ads](#setup-google-ads)
5. [Konfigurasi Environment](#konfigurasi-environment)
6. [Event Tracking](#event-tracking)
7. [Testing](#testing)
8. [Troubleshooting](#troubleshooting)

---

## 🎯 Overview

Sistem tracking ini terintegrasi dengan sistem event tracking yang sudah ada di Neovala. Setiap event yang di-track (visit, download_promo, book_now, form_submit) akan otomatis dikirim ke:

1. **Database internal** (melalui EventController)
2. **Meta Pixel** (Facebook Ads)
3. **Google Ads** (Conversion Tracking)

### Event yang Di-track

| Event Name | Meta Pixel Event | Google Ads Event | Deskripsi |
|------------|------------------|------------------|-----------|
| `visit` | `PageView` | Custom Event | Setiap kunjungan halaman |
| `download_promo` | `Lead` | Conversion | Download promo |
| `book_now` | `InitiateCheckout` | Conversion | Klik tombol Book Now |
| `form_submit` | `CompleteRegistration` | Conversion | Submit form booking |

---

## 🔧 Persiapan

### 1. Dapatkan Meta Pixel ID

1. Login ke [Facebook Business Manager](https://business.facebook.com/)
2. Buka **Events Manager**
3. Pilih atau buat Pixel baru
4. Copy **Pixel ID** (format: angka 15-16 digit)

### 2. Dapatkan Google Ads Conversion ID & Labels

1. Login ke [Google Ads](https://ads.google.com/)
2. Buka **Tools & Settings** > **Conversions**
3. Buat conversion action baru atau gunakan yang sudah ada
4. Copy **Conversion ID** (format: AW-XXXXXXXXX)
5. Untuk setiap conversion action, copy **Conversion Label**

---

## 📱 Setup Meta Ads (Facebook Pixel)

### Langkah 1: Dapatkan Pixel ID

1. Buka [Facebook Events Manager](https://business.facebook.com/events_manager2)
2. Pilih Pixel yang ingin digunakan
3. Copy Pixel ID (contoh: `123456789012345`)

### Langkah 2: Tambahkan ke Environment

Tambahkan ke file `.env`:

```env
META_PIXEL_ID=123456789012345
META_ADS_ENABLED=true
```

### Langkah 3: Verifikasi Setup

1. Install [Facebook Pixel Helper](https://chrome.google.com/webstore/detail/facebook-pixel-helper/fdgfkebogiimcoedlicjlajpkdmockpc) di Chrome
2. Kunjungi website Anda
3. Cek apakah Pixel terdeteksi dan mengirim event `PageView`

---

## 🔍 Setup Google Ads

### Langkah 1: Buat Conversion Actions

Buat conversion action untuk setiap event penting:

#### 1. Book Now Conversion
- **Name**: Book Now Click
- **Category**: Purchase/Sign-up
- **Value**: Set sesuai kebutuhan
- **Count**: One
- **Conversion window**: 30 days

#### 2. Download Promo Conversion
- **Name**: Download Promo
- **Category**: Lead
- **Value**: Set sesuai kebutuhan
- **Count**: One
- **Conversion window**: 30 days

#### 3. Form Submit Conversion
- **Name**: Form Submit
- **Category**: Sign-up
- **Value**: Set sesuai kebutuhan
- **Count**: One
- **Conversion window**: 30 days

### Langkah 2: Dapatkan Conversion ID & Labels

Setelah membuat conversion actions:

1. Buka setiap conversion action
2. Copy **Conversion ID** (sama untuk semua, format: `AW-XXXXXXXXX`)
3. Copy **Conversion Label** untuk masing-masing action (format: `AbCdEfGhIj`)

### Langkah 3: Tambahkan ke Environment

Tambahkan ke file `.env`:

```env
GOOGLE_ADS_CONVERSION_ID=AW-XXXXXXXXX
GOOGLE_ADS_ENABLED=true

# Conversion Labels (opsional, jika berbeda per event)
GOOGLE_ADS_BOOK_NOW_LABEL=AbCdEfGhIj
GOOGLE_ADS_DOWNLOAD_PROMO_LABEL=KlMnOpQrSt
GOOGLE_ADS_FORM_SUBMIT_LABEL=UvWxYzAbCd
GOOGLE_ADS_VISIT_LABEL=EfGhIjKlMn

# Default conversion label (jika tidak ada label spesifik per event)
GOOGLE_ADS_CONVERSION_LABEL=AbCdEfGhIj
```

---

## ⚙️ Konfigurasi Environment

Tambahkan semua konfigurasi berikut ke file `.env`:

```env
# ============================================
# META ADS (FACEBOOK PIXEL) CONFIGURATION
# ============================================
META_PIXEL_ID=123456789012345
META_ADS_ENABLED=true
META_ACCESS_TOKEN=your_access_token_here  # Optional, untuk Conversions API

# ============================================
# GOOGLE ADS CONFIGURATION
# ============================================
GOOGLE_ADS_CONVERSION_ID=AW-XXXXXXXXX
GOOGLE_ADS_ENABLED=true

# Default conversion label
GOOGLE_ADS_CONVERSION_LABEL=AbCdEfGhIj

# Specific conversion labels per event (opsional)
GOOGLE_ADS_BOOK_NOW_LABEL=AbCdEfGhIj
GOOGLE_ADS_DOWNLOAD_PROMO_LABEL=KlMnOpQrSt
GOOGLE_ADS_FORM_SUBMIT_LABEL=UvWxYzAbCd
GOOGLE_ADS_VISIT_LABEL=EfGhIjKlMn
```

### Catatan Penting:

- **META_ADS_ENABLED** dan **GOOGLE_ADS_ENABLED**: Set ke `false` untuk menonaktifkan tracking tanpa menghapus konfigurasi
- **Conversion Labels**: Jika tidak di-set, akan menggunakan `GOOGLE_ADS_CONVERSION_LABEL` sebagai default
- **META_ACCESS_TOKEN**: Hanya diperlukan jika ingin menggunakan Conversions API (server-side tracking)

---

## 📊 Event Tracking

### Event Otomatis

Sistem akan otomatis track event berikut:

1. **Page Visit** (`visit`)
   - Terjadi saat halaman dimuat
   - Meta: `PageView`
   - Google: Custom event

2. **Download Promo** (`download_promo`)
   - Terjadi saat user klik tombol "DOWNLOAD PROMO"
   - Meta: `Lead`
   - Google: Conversion

3. **Book Now** (`book_now`)
   - Terjadi saat user klik tombol "BOOK NOW" atau "VIEW DETAILS"
   - Meta: `InitiateCheckout`
   - Google: Conversion

4. **Form Submit** (`form_submit`)
   - Terjadi saat user submit form booking
   - Meta: `CompleteRegistration`
   - Google: Conversion

### Manual Tracking (Opsional)

Jika ingin track event custom, gunakan:

```javascript
// Track custom event
window.neovalaTracker.trackEvent('custom_event_name', {
    custom_param: 'value',
    value: 1000
});
```

---

## 🧪 Testing

### Test Meta Pixel

1. Install [Facebook Pixel Helper](https://chrome.google.com/webstore/detail/facebook-pixel-helper/fdgfkebogiimcoedlicjlajpkdmockpc)
2. Buka website
3. Lakukan aksi (klik Book Now, Download Promo, dll)
4. Cek di Pixel Helper apakah event terkirim

### Test Google Ads

1. Install [Google Tag Assistant](https://tagassistant.google.com/)
2. Buka website
3. Lakukan aksi (klik Book Now, Download Promo, dll)
4. Cek di Tag Assistant apakah conversion event terkirim
5. Atau cek di Google Ads > Tools & Settings > Conversions > lihat "Recent conversions"

### Test di Browser Console

Buka browser console dan cek:

```javascript
// Cek apakah Meta Pixel loaded
console.log(typeof fbq); // Should return "function"

// Cek apakah Google Ads loaded
console.log(typeof gtag); // Should return "function"

// Cek conversion labels
console.log(window.googleAdsConversionLabels);
```

---

## 🔍 Troubleshooting

### Meta Pixel tidak terdeteksi

**Problem**: Pixel Helper tidak mendeteksi Pixel

**Solusi**:
1. Cek apakah `META_PIXEL_ID` sudah di-set di `.env`
2. Cek apakah `META_ADS_ENABLED=true`
3. Clear cache: `php artisan config:clear`
4. Hard refresh browser (Ctrl+Shift+R)
5. Cek browser console untuk error JavaScript

### Google Ads conversion tidak terkirim

**Problem**: Conversion tidak muncul di Google Ads

**Solusi**:
1. Cek apakah `GOOGLE_ADS_CONVERSION_ID` sudah di-set
2. Cek apakah `GOOGLE_ADS_ENABLED=true`
3. Pastikan conversion label format benar (tanpa `AW-CONVERSION_ID/`)
4. Cek di Google Tag Assistant
5. Tunggu beberapa menit (conversion bisa delay)

### Event tidak ter-track

**Problem**: Event tidak muncul di database atau ads platform

**Solusi**:
1. Cek browser console untuk error
2. Cek network tab untuk request ke `/api/track`
3. Cek log Laravel: `storage/logs/laravel.log`
4. Pastikan `tracking.js` sudah di-load
5. Cek apakah ada ad blocker yang memblokir script

### Conversion label tidak ditemukan

**Problem**: Error "Conversion label not found"

**Solusi**:
1. Pastikan format label benar di `.env`
2. Jangan sertakan `AW-CONVERSION_ID/` di label, hanya label saja
3. Clear cache: `php artisan config:clear`
4. Hard refresh browser

---

## 📁 File yang Terlibat

### Backend
- `config/services.php` - Konfigurasi Meta & Google Ads
- `app/Services/AdsTrackingService.php` - Service untuk manage tracking
- `app/Http/Controllers/EventController.php` - Controller untuk track event

### Frontend
- `resources/views/components/ads-tracking.blade.php` - Component untuk script tracking
- `resources/views/layouts/app.blade.php` - Layout utama (include ads-tracking)
- `public/js/tracking.js` - JavaScript untuk track event

---

## 🚀 Next Steps (Advanced)

### 1. Server-Side Tracking (Conversions API)

Untuk tracking yang lebih akurat dan tidak terpengaruh ad blocker:

1. Setup Meta Conversions API
2. Setup Google Ads Enhanced Conversions
3. Implementasi server-side tracking di `AdsTrackingService`

### 2. Custom Parameters

Tambahkan custom parameters untuk tracking lebih detail:

```javascript
window.neovalaTracker.trackEvent('book_now', {
    apartment_name: 'Grand Kamala Lagoon',
    value: 500000,
    currency: 'IDR'
});
```

### 3. A/B Testing Integration

Integrasikan dengan platform A/B testing untuk optimize conversion.

---

## 📞 Support

Jika ada pertanyaan atau masalah:

1. Cek dokumentasi resmi:
   - [Meta Pixel Documentation](https://developers.facebook.com/docs/meta-pixel)
   - [Google Ads Conversion Tracking](https://support.google.com/google-ads/answer/1727054)

2. Cek log Laravel: `storage/logs/laravel.log`

3. Cek browser console untuk error JavaScript

---

## ✅ Checklist Setup

- [ ] Meta Pixel ID sudah di-set di `.env`
- [ ] Google Ads Conversion ID sudah di-set di `.env`
- [ ] Conversion Labels sudah di-set (jika menggunakan label berbeda per event)
- [ ] `META_ADS_ENABLED=true` dan `GOOGLE_ADS_ENABLED=true`
- [ ] Clear cache: `php artisan config:clear`
- [ ] Test dengan Facebook Pixel Helper
- [ ] Test dengan Google Tag Assistant
- [ ] Verifikasi event muncul di database
- [ ] Verifikasi conversion muncul di Google Ads (tunggu beberapa menit)

---

**Last Updated**: {{ date('Y-m-d') }}

