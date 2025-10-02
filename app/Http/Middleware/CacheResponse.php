<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CacheResponse
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, int $minutes = 60): Response
    {
        // Only cache GET requests
        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        // Don't cache authenticated requests or requests with query parameters that shouldn't be cached
        if ($request->user() || $request->has(['token', 'signature'])) {
            return $next($request);
        }

        $cacheKey = $this->getCacheKey($request);
        
        // Try to get cached response
        $cachedResponse = Cache::get($cacheKey);
        
        if ($cachedResponse) {
            return response($cachedResponse['content'])
                ->withHeaders($cachedResponse['headers'])
                ->setStatusCode($cachedResponse['status']);
        }

        $response = $next($request);

        // Only cache successful responses
        if ($response->getStatusCode() === 200) {
            $cacheData = [
                'content' => $response->getContent(),
                'headers' => $response->headers->all(),
                'status' => $response->getStatusCode(),
            ];

            Cache::put($cacheKey, $cacheData, now()->addMinutes($minutes));
        }

        return $response;
    }

    /**
     * Generate cache key for the request
     */
    private function getCacheKey(Request $request): string
    {
        $key = 'response:' . md5($request->fullUrl());
        
        // Include user agent for mobile/desktop variations
        if ($request->header('User-Agent')) {
            $isMobile = $this->isMobileUserAgent($request->header('User-Agent'));
            $key .= ':' . ($isMobile ? 'mobile' : 'desktop');
        }
        
        return $key;
    }

    /**
     * Check if user agent is mobile
     */
    private function isMobileUserAgent(string $userAgent): bool
    {
        return preg_match('/Mobile|Android|iPhone|iPad/', $userAgent);
    }
}
