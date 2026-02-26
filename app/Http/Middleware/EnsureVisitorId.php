<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class EnsureVisitorId
{
    /**
     * Middleware ini memastikan setiap visitor punya ID unik yang persistent
     * disimpan di cookie dengan lifetime 1 tahun.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $visitorId = $request->cookie('visitor_id');

        if (!$visitorId) {
            $visitorId = 'v_' . Str::random(32) . '_' . time();
        }

        $request->attributes->set('visitor_id', $visitorId);

        $response = $next($request);

        if (!$request->cookie('visitor_id')) {
            $response->cookie('visitor_id', $visitorId, 60 * 24 * 365, '/', null, false, true);
        }

        return $response;
    }
}
