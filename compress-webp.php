<?php
/**
 * compress-webp.php
 * Mengkonversi JPG/JPEG/PNG ke format WebP tanpa memutar gambar.
 *
 * Cara pakai:
 *   php compress-webp.php <folder> [kualitas] [--delete]
 *
 * Contoh:
 *   php compress-webp.php public/images/images/drone_photo 82
 *   php compress-webp.php public/images/images/drone_photo 82 --delete
 *
 * Argumen:
 *   <folder>    : folder yang ingin diproses (rekursif ke subfolder)
 *   [kualitas]  : 1-100, default 82
 *   [--delete]  : hapus file asli setelah berhasil dikonversi
 */

// ─── Fungsi: terapkan EXIF orientation ke piksel ──────────────────────────────
/**
 * Rotasi/flip gambar GD sesuai nilai EXIF orientation sehingga piksel WebP
 * sudah benar tanpa perlu EXIF tag tambahan.
 *
 * Nilai EXIF:
 *  1 = Normal            5 = Flip H + Rotate 90° CCW
 *  2 = Flip Horizontal   6 = Rotate 90° CW   ← paling umum (foto portrait)
 *  3 = Rotate 180°       7 = Flip H + Rotate 90° CW
 *  4 = Flip Vertical     8 = Rotate 90° CCW
 */
function applyExifOrientation($img, int $orientation)
{
    switch ($orientation) {
        case 2: // Flip horizontal
            imageflip($img, IMG_FLIP_HORIZONTAL);
            break;
        case 3: // Rotate 180°
            $img = imagerotate($img, 180, 0);
            break;
        case 4: // Flip vertical
            imageflip($img, IMG_FLIP_VERTICAL);
            break;
        case 5: // Flip horizontal lalu rotate 90° CCW
            imageflip($img, IMG_FLIP_HORIZONTAL);
            $img = imagerotate($img, 90, 0);
            break;
        case 6: // Rotate 90° CW → kita putar -90° (270°) agar piksel portrait
            $img = imagerotate($img, -90, 0);
            break;
        case 7: // Flip horizontal lalu rotate 90° CW
            imageflip($img, IMG_FLIP_HORIZONTAL);
            $img = imagerotate($img, -90, 0);
            break;
        case 8: // Rotate 90° CCW
            $img = imagerotate($img, 90, 0);
            break;
        // case 1 = normal, tidak perlu apa-apa
    }
    return $img;
}

// ─── Konfigurasi ──────────────────────────────────────────────────────────────

$targetFolder  = $argv[1] ?? null;
$quality       = 82;
$deleteOriginal = false;

foreach (array_slice($argv, 2) as $arg) {
    if ($arg === '--delete') {
        $deleteOriginal = true;
    } elseif (is_numeric($arg)) {
        $quality = max(1, min(100, (int)$arg));
    }
}

// ─── Validasi ─────────────────────────────────────────────────────────────────

if (!$targetFolder) {
    echo "❌  Penggunaan: php compress-webp.php <folder> [kualitas] [--delete]\n";
    echo "    Contoh   : php compress-webp.php public/images/images/drone_photo 82\n";
    exit(1);
}

$targetFolder = rtrim($targetFolder, '/\\');

if (!is_dir($targetFolder)) {
    echo "❌  Folder tidak ditemukan: $targetFolder\n";
    exit(1);
}

// ─── Cari semua file gambar ───────────────────────────────────────────────────

$extensions = ['jpg', 'jpeg', 'png'];
$files      = [];

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($targetFolder, FilesystemIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {
    $ext = strtolower(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
    if (in_array($ext, $extensions)) {
        $files[] = $file->getPathname();
    }
}

if (empty($files)) {
    echo "ℹ️  Tidak ada file JPG/JPEG/PNG di folder: $targetFolder\n";
    exit(0);
}

// ─── Konversi ─────────────────────────────────────────────────────────────────

$total    = count($files);
$success  = 0;
$failed   = 0;
$skipped  = 0;
$savedMB  = 0;

echo "─────────────────────────────────────────────────────────────\n";
echo "  Folder   : $targetFolder\n";
echo "  Kualitas : $quality\n";
echo "  File     : $total gambar ditemukan\n";
echo "  Delete   : " . ($deleteOriginal ? 'YA (file asli akan dihapus)' : 'TIDAK') . "\n";
echo "─────────────────────────────────────────────────────────────\n\n";

foreach ($files as $i => $srcPath) {
    $ext      = strtolower(pathinfo($srcPath, PATHINFO_EXTENSION));
    $destPath = preg_replace('/\.' . preg_quote($ext, '/') . '$/i', '.webp', $srcPath);
    $filename = basename($srcPath);

    // Jangan proses ulang jika webp sudah ada dan lebih baru
    if (file_exists($destPath) && filemtime($destPath) >= filemtime($srcPath)) {
        echo "[SKIP] $filename → webp sudah ada\n";
        $skipped++;
        continue;
    }

    $sizeBefore = filesize($srcPath);

    // Baca gambar — TIDAK mengaplikasikan rotasi EXIF
    $img = null;
    switch ($ext) {
        case 'jpg':
        case 'jpeg':
            $img = @imagecreatefromjpeg($srcPath);
            if ($img) {
                // Baca EXIF orientation agar piksel WebP tidak miring
                $exif        = @exif_read_data($srcPath);
                $orientation = $exif['Orientation'] ?? 1;
                $img         = applyExifOrientation($img, $orientation);
            }
            break;
        case 'png':
            $img = @imagecreatefrompng($srcPath);
            if ($img) {
                imagepalettetotruecolor($img);
                imagealphablending($img, true);
                imagesavealpha($img, true);
            }
            break;
    }

    if (!$img) {
        echo "[FAIL] $filename → tidak bisa dibaca\n";
        $failed++;
        continue;
    }

    // Simpan sebagai WebP
    $ok = imagewebp($img, $destPath, $quality);
    imagedestroy($img);

    if (!$ok || !file_exists($destPath)) {
        echo "[FAIL] $filename → gagal menulis WebP\n";
        $failed++;
        continue;
    }

    $sizeAfter = filesize($destPath);
    $saved     = $sizeBefore - $sizeAfter;
    $savedMB  += $saved;
    $pct       = $sizeBefore > 0 ? round((1 - $sizeAfter / $sizeBefore) * 100) : 0;

    $label = sprintf(
        "%.1f MB → %.1f MB  (-%d%%)",
        $sizeBefore / 1048576,
        $sizeAfter  / 1048576,
        $pct
    );

    echo "[OK]   $filename\n       $label\n";

    if ($deleteOriginal) {
        unlink($srcPath);
    }

    $success++;
}

// ─── Ringkasan ────────────────────────────────────────────────────────────────

echo "\n─────────────────────────────────────────────────────────────\n";
echo "  Berhasil : $success\n";
echo "  Gagal    : $failed\n";
echo "  Dilewati : $skipped\n";
printf("  Hemat    : %.1f MB\n", $savedMB / 1048576);
echo "─────────────────────────────────────────────────────────────\n";
