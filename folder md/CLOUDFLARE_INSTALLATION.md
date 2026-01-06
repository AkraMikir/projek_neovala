# 🚀 Panduan Instalasi Cloudflare Tunnel untuk Windows

## Metode 1: Instalasi Otomatis (Paling Mudah) ⭐

### Langkah-langkah:

1. **Jalankan Script Instalasi:**
   ```powershell
   powershell -ExecutionPolicy Bypass -File install-cloudflare-tunnel.ps1
   ```

2. **Tunggu sampai selesai** - Script akan:
   - ✅ Membuat folder `C:\cloudflared`
   - ✅ Download cloudflared dari GitHub
   - ✅ Test instalasi
   - ✅ Membuat script helper

3. **Selesai!** Cloudflare Tunnel sudah terinstall.

---

## Metode 2: Instalasi Manual

### Langkah 1: Download Cloudflare Tunnel

1. Buka browser dan kunjungi:
   ```
   https://github.com/cloudflare/cloudflared/releases/latest
   ```

2. Download file:
   - **Windows 64-bit:** `cloudflared-windows-amd64.exe`
   - Atau langsung: https://github.com/cloudflare/cloudflared/releases/latest/download/cloudflared-windows-amd64.exe

### Langkah 2: Setup Folder

1. Buat folder baru:
   ```
   C:\cloudflared
   ```

2. Pindahkan file yang sudah didownload ke folder tersebut

3. Rename file menjadi:
   ```
   cloudflared.exe
   ```

   **Jadi path lengkapnya:** `C:\cloudflared\cloudflared.exe`

### Langkah 3: Test Instalasi

Buka PowerShell atau Command Prompt dan jalankan:

```bash
C:\cloudflared\cloudflared.exe --version
```

Jika muncul versi, berarti instalasi berhasil! ✅

---

## 🎯 Cara Menggunakan Cloudflare Tunnel

### Quick Start:

1. **Jalankan Laravel Server** (Terminal 1):
   ```bash
   php artisan serve
   ```

2. **Jalankan Cloudflare Tunnel** (Terminal 2):
   ```bash
   C:\cloudflared\cloudflared.exe tunnel --url http://localhost:8000
   ```

3. **Copy URL yang Diberikan:**
   ```
   +--------------------------------------------------------------------------------------------+
   |  Your quick Tunnel has been created! Visit it at:
   |  https://random-name-1234.trycloudflare.com
   +--------------------------------------------------------------------------------------------+
   ```

4. **Akses Website:**
   - Buka browser
   - Akses URL yang diberikan (misalnya: `https://random-name-1234.trycloudflare.com`)
   - ✅ Website Anda sekarang bisa diakses dari internet!

---

## 📝 Membuat Shortcut/Helper Script

### Opsi A: Double-Click Script (Paling Mudah)

Buat file `C:\cloudflared\run-tunnel.bat` dengan isi:

```batch
@echo off
echo ========================================
echo   Cloudflare Tunnel - Neovala Project
echo ========================================
echo.
echo Memastikan Laravel server berjalan di http://localhost:8000
echo.
pause
echo.
echo Menjalankan Cloudflare Tunnel...
echo.
C:\cloudflared\cloudflared.exe tunnel --url http://localhost:8000
pause
```

**Cara pakai:** Double-click file `run-tunnel.bat` untuk menjalankan tunnel!

### Opsi B: Tambahkan ke PATH (Advanced)

1. Buka **System Properties** → **Environment Variables**
2. Edit **Path** di **System variables**
3. Tambahkan: `C:\cloudflared`
4. Klik **OK**

Sekarang bisa langsung jalankan:
```bash
cloudflared tunnel --url http://localhost:8000
```

---

## 🔍 Verifikasi Instalasi

Jalankan perintah berikut untuk memastikan instalasi berhasil:

```bash
# Test versi
C:\cloudflared\cloudflared.exe --version

# Test help
C:\cloudflared\cloudflared.exe --help
```

Jika kedua perintah berhasil, instalasi sudah benar! ✅

---

## 🆘 Troubleshooting

### Error: "cloudflared: command not found"
**Solusi:**
- Pastikan file ada di `C:\cloudflared\cloudflared.exe`
- Gunakan full path: `C:\cloudflared\cloudflared.exe tunnel --url http://localhost:8000`

### Error: "Access Denied" atau "Permission Denied"
**Solusi:**
- Jalankan PowerShell/CMD sebagai Administrator
- Atau pindahkan folder ke lokasi yang tidak perlu admin (misalnya `D:\cloudflared`)

### Download Gagal
**Solusi:**
- Download manual dari: https://github.com/cloudflare/cloudflared/releases/latest
- Pilih `cloudflared-windows-amd64.exe`
- Simpan ke `C:\cloudflared\cloudflared.exe`

### Tunnel Tidak Bisa Diakses
**Solusi:**
1. Pastikan Laravel server berjalan: `php artisan serve`
2. Pastikan server berjalan di `http://localhost:8000`
3. Cek firewall Windows tidak memblokir
4. Restart tunnel dan coba lagi

---

## ✅ Checklist Instalasi

- [ ] Folder `C:\cloudflared` dibuat
- [ ] File `cloudflared.exe` ada di folder tersebut
- [ ] Test `cloudflared.exe --version` berhasil
- [ ] Script helper `run-tunnel.bat` dibuat (opsional)
- [ ] ✅ Siap digunakan!

---

## 🎉 Selesai!

Cloudflare Tunnel sudah terinstall dan siap digunakan!

**Langkah selanjutnya:**
1. Jalankan `php artisan serve`
2. Jalankan `C:\cloudflared\cloudflared.exe tunnel --url http://localhost:8000`
3. Copy URL yang diberikan
4. Akses di browser!

**Selamat! Website Anda sekarang bisa diakses dari internet tanpa batas bandwidth! 🚀**



