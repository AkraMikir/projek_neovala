# Panduan Port Forwarding untuk Proyek Neovala

## Opsi 1: Menggunakan ngrok (Paling Mudah untuk Testing)

### Instalasi ngrok:
1. Download dari https://ngrok.com/download
2. Atau install via package manager:
   ```bash
   # Windows (dengan Chocolatey)
   choco install ngrok
   
   # Atau download manual dan extract
   ```

### Cara Menggunakan:
1. Jalankan Laravel development server:
   ```bash
   php artisan serve
   ```
   (Server akan berjalan di `http://localhost:8000`)

2. Di terminal baru, jalankan ngrok:
   ```bash
   ngrok http 8000
   ```

3. ngrok akan memberikan URL publik seperti:
   ```
   Forwarding: https://abc123.ngrok.io -> http://localhost:8000
   ```

4. URL `https://abc123.ngrok.io` bisa diakses dari internet!

### Keuntungan ngrok:
- ✅ Gratis untuk penggunaan dasar
- ✅ HTTPS otomatis
- ✅ Tidak perlu konfigurasi router
- ✅ URL tetap selama ngrok berjalan
- ✅ Cocok untuk testing dan demo

### Keterbatasan:
- ⚠️ **URL berubah setiap kali restart** (kecuali pakai plan berbayar)
- ⚠️ **Batas bandwidth terbatas** untuk free plan (sekitar 1GB/bulan)
- ⚠️ **Error "Network bandwidth exceeded"** jika limit tercapai
- ⚠️ Harus menunggu reset bulanan atau upgrade ke plan berbayar

---

## Opsi 2: Cloudflare Tunnel (Gratis & Permanen) ⭐ RECOMMENDED

### ⚠️ Solusi untuk ngrok Bandwidth Limit!

Cloudflare Tunnel adalah alternatif terbaik jika ngrok sudah melebihi limit bandwidth.

### Instalasi:
1. Download Cloudflare Tunnel dari: https://developers.cloudflare.com/cloudflare-one/connections/connect-apps/install-and-setup/installation/
   - Windows: Download dari https://github.com/cloudflare/cloudflared/releases
   - Extract `cloudflared.exe` ke folder yang mudah diakses (misalnya `C:\cloudflared\`)

2. **Cara Cepat (Tanpa Login - Paling Mudah):**
   ```bash
   # Langsung jalankan, akan dapat URL random
   cloudflared tunnel --url http://localhost:8000
   ```
   Akan memberikan URL seperti: `https://random-name.trycloudflare.com`

3. **Cara dengan Login (Lebih Stabil):**
   ```bash
   # Login ke Cloudflare (akan buka browser)
   cloudflared tunnel login
   
   # Jalankan tunnel
   cloudflared tunnel --url http://localhost:8000
   ```

### Keuntungan:
- ✅ **Gratis tanpa batas bandwidth!**
- ✅ HTTPS otomatis
- ✅ Tidak ada limit seperti ngrok
- ✅ Lebih stabil
- ✅ Bisa setup domain custom (opsional)
- ✅ Lebih aman

---

## Opsi 3: Router Port Forwarding (Manual)

### Langkah-langkah:

1. **Cari IP Address Komputer Anda:**
   ```bash
   # Windows PowerShell
   ipconfig
   ```
   Catat IP Address (misalnya: `192.168.1.100`)

2. **Cari IP Publik Router:**
   - Buka browser, kunjungi: https://whatismyipaddress.com/
   - Catat IP Address yang muncul

3. **Akses Router Admin:**
   - Buka browser, ketik: `192.168.1.1` atau `192.168.0.1`
   - Login dengan username/password router

4. **Setup Port Forwarding:**
   - Cari menu: "Port Forwarding" / "Virtual Server" / "NAT"
   - Tambah rule baru:
     - **External Port:** 8080 (atau port lain)
     - **Internal IP:** 192.168.1.100 (IP komputer Anda)
     - **Internal Port:** 8000 (port Laravel)
     - **Protocol:** TCP
   - Save/Apply

5. **Buka Firewall Windows:**
   ```powershell
   # Buka PowerShell sebagai Administrator
   New-NetFirewallRule -DisplayName "Laravel App" -Direction Inbound -LocalPort 8000 -Protocol TCP -Action Allow
   ```

6. **Jalankan Laravel:**
   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```

7. **Akses dari Internet:**
   ```
   http://[IP_PUBLIK_ANDA]:8080
   ```

### Catatan Penting:
- ⚠️ IP publik bisa berubah jika menggunakan DHCP
- ⚠️ ISP mungkin memblokir port tertentu
- ⚠️ Tidak aman untuk produksi tanpa HTTPS
- ⚠️ Komputer harus selalu menyala

---

## Opsi 4: Menggunakan serveo.net (SSH Tunnel)

### Cara Menggunakan:
```bash
# Pastikan SSH client terinstall (Windows 10+ sudah include)
ssh -R 80:localhost:8000 serveo.net
```

Akan memberikan URL seperti: `https://randomname.serveo.net`

---

## Rekomendasi untuk Proyek Neovala

### Untuk Testing/Demo:
✅ **Gunakan ngrok** - Paling mudah dan cepat

### Untuk Production:
✅ **Gunakan Cloudflare Tunnel** atau **Hosting tradisional** dengan:
- Domain name
- SSL Certificate
- Database hosting
- Backup system

---

## Konfigurasi Laravel untuk External Access

### 1. Update .env (OPSIONAL - Sudah Auto-detect):
```env
APP_URL=http://localhost:8000
# Tidak perlu diubah, sudah auto-detect untuk ngrok!
```

**✅ FIX SUDAH DITERAPKAN:** Aplikasi sudah dikonfigurasi untuk auto-detect ngrok URL dan menggunakan URL yang benar untuk asset (CSS/JS/images).

### 2. Trust Proxy (jika pakai ngrok/cloudflare):
Sudah di-handle otomatis oleh `AppServiceProvider`.

### 3. Jalankan dengan host binding:
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

### 4. Clear Cache (Jika Masih Ada Masalah):
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

---

## Keamanan

⚠️ **PENTING:** Jika menggunakan port forwarding manual:
1. Jangan expose port admin panel tanpa autentikasi kuat
2. Gunakan HTTPS jika memungkinkan
3. Batasi akses jika perlu
4. Jangan gunakan untuk data sensitif tanpa enkripsi

---

## Troubleshooting

### ❌ Style/CSS/JS Tidak Ter-load (Masalah Umum dengan ngrok)

**Gejala:** Halaman tampil tapi tanpa styling, hanya HTML polos.

**Solusi:**
1. ✅ **Sudah diperbaiki!** Aplikasi sudah auto-detect ngrok URL
2. Clear cache Laravel:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```
3. Restart Laravel server:
   ```bash
   # Stop server (Ctrl+C)
   php artisan serve
   ```
4. Restart ngrok:
   ```bash
   # Stop ngrok (Ctrl+C)
   ngrok http 8000
   ```
5. Hard refresh browser: `Ctrl+Shift+R` atau `Ctrl+F5`

**Jika masih bermasalah:**
- Cek di browser console (F12) apakah ada error 404 untuk CSS/JS
- Pastikan file CSS/JS ada di `public/css/` dan `public/js/`
- Cek URL asset di browser: `https://your-ngrok-url.ngrok-free.dev/css/style.css`

### Port sudah digunakan:
```bash
# Windows - Cek port yang digunakan
netstat -ano | findstr :8000

# Kill process jika perlu
taskkill /PID [PID_NUMBER] /F
```

### Tidak bisa diakses dari luar:
- Pastikan firewall Windows mengizinkan port
- Pastikan router port forwarding sudah benar
- Cek apakah ISP memblokir port
- Coba gunakan ngrok sebagai alternatif

### ngrok Warning Page:
- ngrok free plan menampilkan warning page pertama kali
- Klik "Visit Site" untuk melanjutkan
- Atau gunakan ngrok dengan authtoken untuk menghilangkan warning

---

## Quick Start (ngrok)

```bash
# Terminal 1: Jalankan Laravel
php artisan serve

# Terminal 2: Jalankan ngrok
ngrok http 8000
```

Copy URL dari ngrok dan share ke orang lain! 🚀

