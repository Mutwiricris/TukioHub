<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheService
{
    /**
     * Cache durations in minutes
     */
    const CACHE_DURATIONS = [
        'events' => 60,           // 1 hour
        'event_details' => 120,   // 2 hours
        'tickets' => 30,          // 30 minutes
        'user_profile' => 240,    // 4 hours
        'categories' => 1440,     // 24 hours
        'popular_events' => 60,   // 1 hour
        'featured_events' => 120, // 2 hours
        'event_stats' => 15,      // 15 minutes
        'user_bookings' => 30,    // 30 minutes
    ];

    /**
     * Get cached events with pagination
     */
    public function getCachedEvents($page = 1, $perPage = 12, $filters = [])
    {
        $cacheKey = $this->generateCacheKey('events', compact('page', 'perPage', 'filters'));
        
        return Cache::remember($cacheKey, self::CACHE_DURATIONS['events'], function () use ($page, $perPage, $filters) {
            $query = DB::table('events')
                ->where('status', 'published')
                ->where('event_date', '>=', now());

            // Apply filters
            if (!empty($filters['category'])) {
                $query->where('category_id', $filters['category']);
            }
            
            if (!empty($filters['location'])) {
                $query->where('location', 'like', '%' . $filters['location'] . '%');
            }
            
            if (!empty($filters['search'])) {
                $query->where(function ($q) use ($filters) {
                    $q->where('title', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('description', 'like', '%' . $filters['search'] . '%');
                });
            }

            return $query->orderBy('event_date', 'asc')
                        ->paginate($perPage, ['*'], 'page', $page);
        });
    }

    /**
     * Get cached event details
     */
    public function getCachedEventDetails($eventId)
    {
        $cacheKey = $this->generateCacheKey('event_details', ['id' => $eventId]);
        
        return Cache::remember($cacheKey, self::CACHE_DURATIONS['event_details'], function () use ($eventId) {
            return DB::table('events')
                ->leftJoin('users', 'events.organizer_id', '=', 'users.id')
                ->leftJoin('categories', 'events.category_id', '=', 'categories.id')
                ->select(
                    'events.*',
                    'users.name as organizer_name',
                    'users.email as organizer_email',
                    'categories.name as category_name'
                )
                ->where('events.id', $eventId)
                ->first();
        });
    }

    /**
     * Get cached event tickets
     */
    public function getCachedEventTickets($eventId)
    {
        $cacheKey = $this->generateCacheKey('tickets', ['event_id' => $eventId]);
        
        return Cache::remember($cacheKey, self::CACHE_DURATIONS['tickets'], function () use ($eventId) {
            return DB::table('tickets')
                ->where('event_id', $eventId)
                ->where('is_active', true)
                ->orderBy('price', 'asc')
                ->get();
        });
    }

    /**
     * Get cached popular events
     */
    public function getCachedPopularEvents($limit = 6)
    {
        $cacheKey = $this->generateCacheKey('popular_events', ['limit' => $limit]);
        
        return Cache::remember($cacheKey, self::CACHE_DURATIONS['popular_events'], function () use ($limit) {
            return DB::table('events')
                ->leftJoin('bookings', 'events.id', '=', 'bookings.event_id')
                ->select('events.*', DB::raw('COUNT(bookings.id) as booking_count'))
                ->where('events.status', 'published')
                ->where('events.event_date', '>=', now())
                ->groupBy('events.id')
                ->orderBy('booking_count', 'desc')
                ->limit($limit)
                ->get();
        });
    }

    /**
     * Get cached featured events
     */
    public function getCachedFeaturedEvents($limit = 3)
    {
        $cacheKey = $this->generateCacheKey('featured_events', ['limit' => $limit]);
        
        return Cache::remember($cacheKey, self::CACHE_DURATIONS['featured_events'], function () use ($limit) {
            return DB::table('events')
                ->where('status', 'published')
                ->where('is_featured', true)
                ->where('event_date', '>=', now())
                ->orderBy('event_date', 'asc')
                ->limit($limit)
                ->get();
        });
    }

    /**
     * Get cached user bookings
     */
    public function getCachedUserBookings($userId)
    {
        $cacheKey = $this->generateCacheKey('user_bookings', ['user_id' => $userId]);
        
        return Cache::remember($cacheKey, self::CACHE_DURATIONS['user_bookings'], function () use ($userId) {
            return DB::table('bookings')
                ->leftJoin('events', 'bookings.event_id', '=', 'events.id')
                ->leftJoin('tickets', 'bookings.ticket_id', '=', 'tickets.id')
                ->select(
                    'bookings.*',
                    'events.title as event_title',
                    'events.event_date',
                    'events.location',
                    'tickets.name as ticket_name'
                )
                ->where('bookings.user_id', $userId)
                ->orderBy('bookings.created_at', 'desc')
                ->get();
        });
    }

    /**
     * Get cached event statistics
     */
    public function getCachedEventStats($eventId)
    {
        $cacheKey = $this->generateCacheKey('event_stats', ['event_id' => $eventId]);
        
        return Cache::remember($cacheKey, self::CACHE_DURATIONS['event_stats'], function () use ($eventId) {
            return [
                'total_bookings' => DB::table('bookings')->where('event_id', $eventId)->count(),
                'total_revenue' => DB::table('bookings')
                    ->where('event_id', $eventId)
                    ->where('status', 'confirmed')
                    ->sum('total_amount'),
                'tickets_sold' => DB::table('bookings')
                    ->where('event_id', $eventId)
                    ->where('status', 'confirmed')
                    ->sum('quantity'),
                'unique_attendees' => DB::table('bookings')
                    ->where('event_id', $eventId)
                    ->where('status', 'confirmed')
                    ->distinct('user_id')
                    ->count('user_id'),
            ];
        });
    }

    /**
     * Invalidate event-related caches
     */
    public function invalidateEventCaches($eventId = null)
    {
        $patterns = [
            'events:*',
            'popular_events:*',
            'featured_events:*',
        ];

        if ($eventId) {
            $patterns[] = "event_details:*{$eventId}*";
            $patterns[] = "tickets:*{$eventId}*";
            $patterns[] = "event_stats:*{$eventId}*";
        }

        foreach ($patterns as $pattern) {
            $this->forgetByPattern($pattern);
        }
    }

    /**
     * Invalidate user-related caches
     */
    public function invalidateUserCaches($userId)
    {
        $patterns = [
            "user_profile:*{$userId}*",
            "user_bookings:*{$userId}*",
        ];

        foreach ($patterns as $pattern) {
            $this->forgetByPattern($pattern);
        }
    }

    /**
     * Warm up critical caches
     */
    public function warmUpCaches()
    {
        // Warm up popular events
        $this->getCachedPopularEvents();
        
        // Warm up featured events
        $this->getCachedFeaturedEvents();
        
        // Warm up first page of events
        $this->getCachedEvents(1, 12);
        
        return true;
    }

    /**
     * Generate cache key
     */
    private function generateCacheKey($type, $params = [])
    {
        $key = $type;
        
        if (!empty($params)) {
            ksort($params);
            $key .= ':' . md5(serialize($params));
        }
        
        return $key;
    }

    /**
     * Forget cache by pattern (Redis specific)
     */
    private function forgetByPattern($pattern)
    {
        if (config('cache.default') === 'redis') {
            $redis = Cache::getRedis();
            $keys = $redis->keys(config('cache.prefix') . $pattern);
            
            if (!empty($keys)) {
                $redis->del($keys);
            }
        } else {
            // For non-Redis drivers, we'll need to track keys manually
            // This is a simplified approach
            Cache::forget($pattern);
        }
    }
}
