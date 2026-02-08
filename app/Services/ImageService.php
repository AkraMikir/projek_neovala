<?php

namespace App\Services;

use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * Upload and compress image efficiently
     *
     * @param UploadedFile $file The image file
     * @param string $path Target storage folder (e.g. 'rooms')
     * @param int $width Max width (height auto-adjusted)
     * @param int $quality Quality 0-100 (Default 80 is good balance)
     * @return string The stored filename
     */
    public static function upload(UploadedFile $file, string $path, int $width = 1000, int $quality = 80, ?string $customFilename = null): string
    {
        if ($customFilename) {
            // Use custom filename, force WebP check
            $filename = $customFilename;
            if (!str_ends_with(strtolower($filename), '.webp')) {
                $filename .= '.webp';
            }
        } else {
            // 1. Get original filename without extension
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            
            // 2. Clean filename (only alphanumeric and dash), limit length
            $safeName = preg_replace('/[^A-Za-z0-9\-]/', '', $originalName);
            $safeName = substr($safeName, 0, 50); // Max 50 chars
            
            // 3. Generate final filename with timestamp
            $filename = time() . '_' . $safeName . '.webp';
        }
        
        // Ensure directory exists
        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path);
        }

        // Read image
        $image = Image::read($file);

        // Resize if width is larger than target (downscale only)
        if ($image->width() > $width) {
            $image->scale(width: $width);
        }

        // Encode to WebP (Modern format, smaller size)
        $encoded = $image->toWebp($quality);

        // Save to storage
        Storage::disk('public')->put($path . '/' . $filename, (string) $encoded);

        return $filename;
    }
    
    /**
     * Delete image from storage
     */
    public static function delete(string $path, string $filename): void
    {
        if (Storage::disk('public')->exists($path . '/' . $filename)) {
            Storage::disk('public')->delete($path . '/' . $filename);
        }
    }
}
