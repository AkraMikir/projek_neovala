<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class GenerateDiscoverCardImages extends Command
{
    protected $signature = 'generate:discover-card-images';

    protected $description = 'Generate compressed WebP images (landscape + portrait) for discover cards and carousel from drone_photo sources.';

    private const MAX_WIDTH = 800;
    private const MAX_HEIGHT = 800;
    private const WEBP_QUALITY = 80;

    /** @var array<string, string> subfolder => filename (landscape) */
    private const CARD_LANDSCAPE = [
        'TPJ' => 'DJI_20250404164408_0277_D.webp',
        'TPC' => 'DJI_20250405123918_0311_D.webp',
        'GKL' => 'DJI_20250327155321_0214_D.webp',
        'PLU' => 'DJI_20250321180632_0140_D.webp',
        'GWC' => 'gwc desktop.webp',
        'PGV' => 'DJI_20250307171436_0097_D.webp',
        'GPC' => 'DJI_20250905143026_0543_D.webp',
        'BSC' => 'DJI_20250827131627_0494_D.webp',
        'SPL' => 'DJI_20260102114257_0580_D.webp',
    ];

    /** @var array<string, string> subfolder => filename (portrait) */
    private const CARD_PORTRAIT = [
        'TPJ' => 'DJI_20250404164446_0282_D.webp',
        'TPC' => 'DJI_20250405123929_0314_D.webp',
        'GKL' => 'DJI_20250327153843_0201_D.webp',
        'PLU' => 'DJI_20250321180704_0146_D.webp',
        'GWC' => 'gwc mobile.webp',
        'PGV' => 'DJI_20250307171441_0098_D.webp',
        'GPC' => 'DJI_20250905143045_0548_D.webp',
        'BSC' => 'DJI_20250827131520_0491_D.webp',
        'SPL' => 'DJI_20260102114312_0582_D.webp',
    ];

    public function handle(): int
    {
        $base = public_path('images/images/drone_photo');
        $cardBase = $base . DIRECTORY_SEPARATOR . 'card';
        $done = 0;

        foreach (self::CARD_LANDSCAPE as $subfolder => $filename) {
            $sourcePath = $this->resolveSourcePath($base, $subfolder, $filename, 'gwc desktop');
            if ($sourcePath === null) {
                continue;
            }

            $destDir = $cardBase . DIRECTORY_SEPARATOR . $subfolder;
            if (!File::isDirectory($destDir)) {
                File::makeDirectory($destDir, 0755, true);
            }
            $destPath = $destDir . DIRECTORY_SEPARATOR . $filename;

            try {
                $image = Image::read($sourcePath);
                if ($image->width() > self::MAX_WIDTH) {
                    $image->scale(width: self::MAX_WIDTH);
                }
                $encoded = $image->toWebp(self::WEBP_QUALITY);
                File::put($destPath, (string) $encoded);
                $this->line("OK (landscape): {$subfolder}/{$filename}");
                $done++;
            } catch (\Throwable $e) {
                $this->warn("Failed {$subfolder}/{$filename}: " . $e->getMessage());
            }
        }

        foreach (self::CARD_PORTRAIT as $subfolder => $filename) {
            $sourcePath = $this->resolveSourcePath($base, $subfolder, $filename, 'gwc mobile');
            if ($sourcePath === null) {
                continue;
            }

            $destDir = $cardBase . DIRECTORY_SEPARATOR . $subfolder;
            if (!File::isDirectory($destDir)) {
                File::makeDirectory($destDir, 0755, true);
            }
            $destPath = $destDir . DIRECTORY_SEPARATOR . $filename;

            try {
                $image = Image::read($sourcePath);
                if ($image->height() > self::MAX_HEIGHT) {
                    $image->scale(height: self::MAX_HEIGHT);
                }
                $encoded = $image->toWebp(self::WEBP_QUALITY);
                File::put($destPath, (string) $encoded);
                $this->line("OK (portrait): {$subfolder}/{$filename}");
                $done++;
            } catch (\Throwable $e) {
                $this->warn("Failed {$subfolder}/{$filename}: " . $e->getMessage());
            }
        }

        $this->info("Generated {$done} discover card images (landscape + portrait).");
        return 0;
    }

    private function resolveSourcePath(string $base, string $subfolder, string $filename, string $gwcAltBase): ?string
    {
        $sourcePath = $base . DIRECTORY_SEPARATOR . $subfolder . DIRECTORY_SEPARATOR . $filename;

        if (file_exists($sourcePath)) {
            return $sourcePath;
        }

        if ($subfolder === 'GWC') {
            $altPath = $base . DIRECTORY_SEPARATOR . $subfolder . DIRECTORY_SEPARATOR . $gwcAltBase . '.jpeg';
            if (file_exists($altPath)) {
                return $altPath;
            }
        }

        $this->warn("Source not found, skipping: {$sourcePath}");
        return null;
    }
}
