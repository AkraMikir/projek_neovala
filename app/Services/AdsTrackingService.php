<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

/**
 * Service untuk mengelola tracking Meta Ads dan Google Ads
 */
class AdsTrackingService
{
    /**
     * Cek apakah Meta Ads tracking enabled
     */
    public static function isMetaAdsEnabled(): bool
    {
        return config('services.meta_ads.enabled', false) && 
               !empty(config('services.meta_ads.pixel_id'));
    }

    /**
     * Cek apakah Google Ads tracking enabled
     */
    public static function isGoogleAdsEnabled(): bool
    {
        return config('services.google_ads.enabled', false) && 
               !empty(config('services.google_ads.conversion_id'));
    }

    /**
     * Get Meta Pixel ID
     */
    public static function getMetaPixelId(): ?string
    {
        return config('services.meta_ads.pixel_id');
    }

    /**
     * Get Google Ads Conversion ID
     */
    public static function getGoogleAdsConversionId(): ?string
    {
        return config('services.google_ads.conversion_id');
    }

    /**
     * Get Google Ads Conversion Label untuk event tertentu
     */
    public static function getGoogleAdsConversionLabel(string $eventName): ?string
    {
        $labels = config('services.google_ads.conversion_labels', []);
        return $labels[$eventName] ?? config('services.google_ads.conversion_label');
    }

    /**
     * Track event ke Meta Pixel (untuk server-side tracking via Conversions API)
     * Note: Ini memerlukan setup Conversions API yang lebih kompleks
     * Untuk sekarang, kita fokus ke client-side tracking dulu
     */
    public static function trackMetaEvent(string $eventName, array $data = []): void
    {
        if (!self::isMetaAdsEnabled()) {
            return;
        }

        // Log untuk debugging
        Log::info('Meta Ads Event Tracked', [
            'event' => $eventName,
            'data' => $data,
            'pixel_id' => self::getMetaPixelId()
        ]);
    }

    /**
     * Track event ke Google Ads (untuk server-side tracking)
     * Note: Ini memerlukan setup Google Ads API yang lebih kompleks
     * Untuk sekarang, kita fokus ke client-side tracking dulu
     */
    public static function trackGoogleAdsEvent(string $eventName, array $data = []): void
    {
        if (!self::isGoogleAdsEnabled()) {
            return;
        }

        // Log untuk debugging
        Log::info('Google Ads Event Tracked', [
            'event' => $eventName,
            'data' => $data,
            'conversion_id' => self::getGoogleAdsConversionId()
        ]);
    }

    /**
     * Map event name dari sistem tracking ke Meta Pixel event
     */
    public static function mapToMetaEvent(string $eventName): string
    {
        $mapping = [
            'visit' => 'PageView',
            'download_promo' => 'Lead',
            'book_now' => 'InitiateCheckout',
            'form_submit' => 'CompleteRegistration',
        ];

        return $mapping[$eventName] ?? 'PageView';
    }

    /**
     * Map event name dari sistem tracking ke Google Ads conversion
     */
    public static function mapToGoogleAdsEvent(string $eventName): string
    {
        // Google Ads menggunakan conversion label yang berbeda untuk setiap event
        // Mapping ini akan digunakan untuk menentukan label mana yang dipakai
        return $eventName; // Return as is, karena kita pakai conversion_label per event
    }
}

