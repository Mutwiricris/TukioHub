<?php

namespace App\Observers;

use App\Models\Event;
use App\Services\CacheService;

class EventObserver
{
    protected $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    /**
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        $this->cacheService->invalidateEventCaches();
    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        $this->cacheService->invalidateEventCaches($event->id);
    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        $this->cacheService->invalidateEventCaches($event->id);
    }

    /**
     * Handle the Event "restored" event.
     */
    public function restored(Event $event): void
    {
        $this->cacheService->invalidateEventCaches($event->id);
    }

    /**
     * Handle the Event "force deleted" event.
     */
    public function forceDeleted(Event $event): void
    {
        $this->cacheService->invalidateEventCaches($event->id);
    }
}
