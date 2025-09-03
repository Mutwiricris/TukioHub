<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use App\Models\Venue;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['venue', 'organizer', 'eventType', 'tickets'])
            ->where('status', 'published')
            ->where('start_date', '>', now());

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('venue', function($venueQuery) use ($searchTerm) {
                      $venueQuery->where('name', 'like', '%' . $searchTerm . '%')
                                 ->orWhere('city', 'like', '%' . $searchTerm . '%');
                  })
                  ->orWhereHas('organizer', function($organizerQuery) use ($searchTerm) {
                      $organizerQuery->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Filter by event type/category
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('event_type_id', $request->category);
        }

        // Filter by location/city
        if ($request->filled('location')) {
            $query->whereHas('venue', function($q) use ($request) {
                $q->where('city', 'like', '%' . $request->location . '%');
            });
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->where('start_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('start_date', '<=', $request->date_to);
        }

        // Filter by price range
        if ($request->filled('price_min') || $request->filled('price_max')) {
            $query->whereHas('tickets', function($q) use ($request) {
                if ($request->filled('price_min')) {
                    $q->where('price', '>=', $request->price_min);
                }
                if ($request->filled('price_max')) {
                    $q->where('price', '<=', $request->price_max);
                }
            });
        }

        // Sort options
        $sortBy = $request->get('sort', 'start_date');
        $sortOrder = $request->get('order', 'asc');

        switch ($sortBy) {
            case 'popularity':
                $query->withCount('bookings')->orderBy('bookings_count', 'desc');
                break;
            case 'price_low':
                $query->join('tickets', 'events.id', '=', 'tickets.event_id')
                      ->orderBy('tickets.price', 'asc');
                break;
            case 'price_high':
                $query->join('tickets', 'events.id', '=', 'tickets.event_id')
                      ->orderBy('tickets.price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', $sortOrder);
                break;
            default:
                $query->orderBy('start_date', $sortOrder);
        }

        // Paginate results
        $events = $query->paginate(12)->appends($request->query());

        // Get filter options
        $eventTypes = EventType::all();
        $cities = Event::join('venues', 'events.venue_id', '=', 'venues.id')
                      ->where('events.status', 'published')
                      ->where('events.start_date', '>', now())
                      ->distinct()
                      ->pluck('venues.city')
                      ->sort();

        return view('Browse', compact('events', 'eventTypes', 'cities'));
    }

    public function search(Request $request)
    {
        // AJAX search for autocomplete
        $searchTerm = $request->get('q');

        $events = Event::with(['venue', 'organizer'])
            ->where('status', 'published')
            ->where('start_date', '>', now())
            ->where(function($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%')
                      ->orWhereHas('venue', function($q) use ($searchTerm) {
                          $q->where('name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('city', 'like', '%' . $searchTerm . '%');
                      });
            })
            ->limit(10)
            ->get(['id', 'name', 'slug', 'start_date']);

        return response()->json($events);
    }
}
