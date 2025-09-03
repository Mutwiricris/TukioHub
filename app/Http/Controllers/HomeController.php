<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured events for the carousel (max 5)
        $featuredEvents = Event::with(['venue', 'organizer', 'eventType', 'tickets'])
            ->where('is_featured', true)
            ->where('status', 'published')
            ->where('start_date', '>', now())
            ->orderBy('start_date', 'asc')
            ->limit(5)
            ->get();

        // Get upcoming events for the "Happening Soon" section (max 6)
        $upcomingEvents = Event::with(['venue', 'organizer', 'eventType', 'tickets'])
            ->where('status', 'published')
            ->where('start_date', '>', now())
            ->orderBy('start_date', 'asc')
            ->limit(6)
            ->get();

        // Get event categories for filtering
        $eventTypes = EventType::all();

        return view('welcome', compact('featuredEvents', 'upcomingEvents', 'eventTypes'));
    }
}
