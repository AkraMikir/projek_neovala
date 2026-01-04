<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fix untuk ngrok dan port forwarding
        // Deteksi jika request datang dari ngrok atau domain eksternal
        if (request()->server('HTTP_HOST')) {
            $host = request()->server('HTTP_HOST');
            
            // Deteksi scheme dengan berbagai cara untuk kompatibilitas maksimal
            $scheme = 'http'; // default
            
            // Prioritas 1: Header dari proxy (ngrok, cloudflare, dll)
            if (request()->server('HTTP_X_FORWARDED_PROTO')) {
                $scheme = request()->server('HTTP_X_FORWARDED_PROTO');
            }
            // Prioritas 2: Header X-Forwarded-Ssl
            elseif (request()->server('HTTP_X_FORWARDED_SSL') === 'on') {
                $scheme = 'https';
            }
            // Prioritas 3: Server variable HTTPS
            elseif (request()->server('HTTPS') === 'on' || request()->server('HTTPS') === '1') {
                $scheme = 'https';
            }
            // Prioritas 4: REQUEST_SCHEME
            elseif (request()->server('REQUEST_SCHEME') === 'https') {
                $scheme = 'https';
            }
            // Prioritas 5: request()->secure() method
            elseif (request()->secure()) {
                $scheme = 'https';
            }
            
            // Jika menggunakan ngrok, force HTTPS (ngrok selalu HTTPS)
            if (str_contains($host, 'ngrok') || str_contains($host, 'ngrok-free.dev') || str_contains($host, 'ngrok.io')) {
                $scheme = 'https'; // ngrok selalu HTTPS
                $url = $scheme . '://' . $host;
                config(['app.url' => $url]);
                URL::forceRootUrl($url);
                URL::forceScheme('https'); // Force HTTPS untuk semua URL
            }
            // Jika menggunakan IP publik atau domain eksternal (bukan localhost)
            elseif (!str_contains($host, 'localhost') && !str_contains($host, '127.0.0.1')) {
                $url = $scheme . '://' . $host;
                config(['app.url' => $url]);
                URL::forceRootUrl($url);
                if ($scheme === 'https') {
                    URL::forceScheme('https');
                }
            }
        }
    }
}
