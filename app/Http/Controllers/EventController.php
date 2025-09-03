<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use App\Models\Venue;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['venue', 'organizer', 'eventType', 'tickets'])
            ->published()
            ->upcoming();

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by event type
        if ($request->filled('event_type')) {
            $query->where('event_type_id', $request->event_type);
        }

        // Filter by location/venue
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

        // Sort options
        $sortBy = $request->get('sort', 'start_date');
        $sortOrder = $request->get('order', 'asc');

        switch ($sortBy) {
            case 'popularity':
                $query->withCount('bookings')->orderBy('bookings_count', 'desc');
                break;
            case 'price':
                $query->join('tickets', 'events.id', '=', 'tickets.event_id')
                      ->orderBy('tickets.price', $sortOrder);
                break;
            default:
                $query->orderBy($sortBy, $sortOrder);
        }

        $events = $query->paginate(12);
        $eventTypes = EventType::all();

        return view('Browse', compact('events', 'eventTypes'));
    }

    public function show($slug = null)
    {
        // If no slug provided, show the first available event (for demo)
        if (!$slug) {
            $event = Event::with([
                'venue',
                'organizer',
                'eventType',
                'tickets' => function($query) {
                    $query->with('ticketType')->orderBy('price');
                },
                'performers.performerType',
                'sponsors',
                'reviews.user',
                'eventSessions' => function($query) {
                    $query->orderBy('start_time');
                }
            ])->where('status', 'published')
              ->where('start_date', '>', now())
              ->first();
        } else {
            $event = Event::with([
                'venue',
                'organizer',
                'eventType',
                'tickets' => function($query) {
                    $query->with('ticketType')->orderBy('price');
                },
                'performers.performerType',
                'sponsors',
                'reviews.user',
                'eventSessions' => function($query) {
                    $query->orderBy('start_time');
                }
            ])->where('slug', $slug)->firstOrFail();
        }

        if (!$event) {
            abort(404, 'No events available');
        }

        $relatedEvents = Event::where('event_type_id', $event->event_type_id)
            ->where('id', '!=', $event->id)
            ->where('status', 'published')
            ->where('start_date', '>', now())
            ->limit(4)
            ->get();

        return view('events.eventsDetails', compact('event', 'relatedEvents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_type_id' => 'required|exists:event_types,id',
            'venue_id' => 'required|exists:venues,id',
            'organizer_id' => 'required|exists:organizers,id',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'max_capacity' => 'required|integer|min:1',
            'image_url' => 'nullable|url',
            'is_featured' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['status'] = 'draft';

        $event = Event::create($validated);

        return redirect()->route('events.show', $event->slug)
            ->with('success', 'Event created successfully!');
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_type_id' => 'required|exists:event_types,id',
            'venue_id' => 'required|exists:venues,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_capacity' => 'required|integer|min:1',
            'image_url' => 'nullable|url',
            'is_featured' => 'boolean',
            'status' => 'in:draft,published,cancelled'
        ]);

        if ($validated['name'] !== $event->name) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $event->update($validated);

        return redirect()->route('events.show', $event->slug)
            ->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully!');
    }

    public function featured()
    {
        $events = Event::with(['venue', 'organizer', 'eventType'])
            ->featured()
            ->published()
            ->upcoming()
            ->limit(6)
            ->get();

        return response()->json($events);
    }
}
