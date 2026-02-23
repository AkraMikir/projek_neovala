<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CompressDronePhotos extends Command
{
    protected $signature = 'drone:compress
                            {--quality=80 : Kualitas WebP (1-100, default 80)}
                            {--max-width=2560 : Lebar maksimum piksel (default 2560)}
                            {--delete-original : Hapus file asli setelah konversi}
                            {--dry-run : Tampilkan daftar file tanpa mengkonversi}';

    protected $description = 'Kompres foto drone di folder drone_photo menjadi format WebP';

    private array $supported = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];

    public function handle(): int
    {
        $sourceDir  = public_path('images/images/drone_photo');
        $quality    = (int) $this->option('quality');
        $maxWidth   = (int) $this->option('max-width');
        $deleteOrig = $this->option('delete-original');
        $dryRun     = $this->option('dry-run');

        if (! File::isDirectory($sourceDir)) {
            $this->error("Folder tidak ditemukan: {$sourceDir}");
            return self::FAILURE;
        }

        $files = File::allFiles($sourceDir);
        $targets = collect($files)->filter(
            fn($f) => in_array($f->getExtension(), $this->supported)
        );

        if ($targets->isEmpty()) {
            $this->info('Tidak ada file gambar yang ditemukan.');
            return self::SUCCESS;
        }

        $this->info("Ditemukan <comment>{$targets->count()}</comment> file gambar.");
        $this->info("Quality : <comment>{$quality}</comment>  |  Max-width : <comment>{$maxWidth}px</comment>");
        $this->info("Delete original : <comment>" . ($deleteOrig ? 'YA' : 'TIDAK') . "</comment>");

        if ($dryRun) {
            $this->warn('[DRY-RUN] Tidak ada file yang diubah.');
            $targets->each(fn($f) => $this->line('  ' . $f->getRelativePathname()));
            return self::SUCCESS;
        }

        $this->newLine();

        $bar       = $this->output->createProgressBar($targets->count());
        $bar->setFormat(" %current%/%max% [%bar%] %percent:3s%%  %message%\n");
        $bar->start();

        $converted = 0;
        $failed    = 0;
        $skipped   = 0;
        $savedMB   = 0.0;

        foreach ($targets as $file) {
            $origPath  = $file->getRealPath();
            $webpPath  = $file->getPath() . DIRECTORY_SEPARATOR
                       . pathinfo($file->getFilename(), PATHINFO_FILENAME) . '.webp';
            $relName   = $file->getRelativePathname();

            $bar->setMessage("Processing: {$relName}");
            $bar->advance();

            // Lewati jika WebP sudah ada dan lebih baru dari original
            if (File::exists($webpPath) && filemtime($webpPath) >= filemtime($origPath)) {
                $skipped++;
                continue;
            }

            try {
                $origSize = filesize($origPath);

                // Buat GD image dari file
                $ext = strtolower($file->getExtension());
                $src = match ($ext) {
                    'jpg', 'jpeg' => imagecreatefromjpeg($origPath),
                    'png'         => imagecreatefrompng($origPath),
                    default       => null,
                };

                if (! $src) {
                    $failed++;
                    continue;
                }

                // Resize jika lebar melebihi maxWidth
                $origW = imagesx($src);
                $origH = imagesy($src);

                if ($origW > $maxWidth) {
                    $ratio  = $maxWidth / $origW;
                    $newW   = $maxWidth;
                    $newH   = (int) round($origH * $ratio);
                    $resized = imagecreatetruecolor($newW, $newH);

                    // Pertahankan transparansi untuk PNG
                    if ($ext === 'png') {
                        imagealphablending($resized, false);
                        imagesavealpha($resized, true);
                    }

                    imagecopyresampled($resized, $src, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
                    imagedestroy($src);
                    $src = $resized;
                }

                // Simpan sebagai WebP
                imagewebp($src, $webpPath, $quality);
                imagedestroy($src);

                $newSize  = filesize($webpPath);
                $savedMB += ($origSize - $newSize) / 1048576;

                if ($deleteOrig) {
                    File::delete($origPath);
                }

                $converted++;

            } catch (\Throwable $e) {
                $failed++;
                $this->newLine();
                $this->error("  Gagal: {$relName} — " . $e->getMessage());
            }
        }

        $bar->setMessage('Selesai!');
        $bar->finish();
        $this->newLine(2);

        // Ringkasan
        $this->table(
            ['Status', 'Jumlah'],
            [
                ['✅ Berhasil dikonversi', $converted],
                ['⏭  Dilewati (sudah ada)', $skipped],
                ['❌ Gagal',               $failed],
                ['💾 Total penghematan',   round($savedMB, 2) . ' MB'],
            ]
        );

        return self::SUCCESS;
    }
}
