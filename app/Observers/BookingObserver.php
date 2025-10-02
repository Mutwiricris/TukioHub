<?php

namespace App\Observers;

use App\Models\Booking;
use App\Services\CacheService;

class BookingObserver
{
    protected $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking): void
    {
        $this->invalidateRelatedCaches($booking);
    }

    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $booking): void
    {
        $this->invalidateRelatedCaches($booking);
    }

    /**
     * Handle the Booking "deleted" event.
     */
    public function deleted(Booking $booking): void
    {
        $this->invalidateRelatedCaches($booking);
    }

    /**
     * Invalidate caches related to the booking
     */
    private function invalidateRelatedCaches(Booking $booking): void
    {
        // Invalidate event-related caches
        $this->cacheService->invalidateEventCaches($booking->event_id);
        
        // Invalidate user-related caches
        $this->cacheService->invalidateUserCaches($booking->user_id);
    }
}
