@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-extrabold text-white sm:text-4xl">
                My Tickets
            </h1>
            <p class="mt-3 text-xl text-gray-300">
                View and manage your event tickets
            </p>
        </div>

        <div class="bg-gray-800 shadow overflow-hidden sm:rounded-lg">
            @if($tickets->isEmpty())
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2m4-8v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h10a2 2 0 012 2z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-white">No tickets yet</h3>
                    <p class="mt-1 text-sm text-gray-400">Your purchased tickets will appear here.</p>
                    <div class="mt-6">
                        <a href="{{ route('Browse') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Browse Events
                        </a>
                    </div>
                </div>
            @else
                <ul class="divide-y divide-gray-700">
                    @foreach($tickets as $ticket)
                        <li class="hover:bg-gray-700 transition duration-150 ease-in-out">
                            <a href="{{ route('user.tickets.show', $ticket) }}" class="block">
                                <div class="px-6 py-4 flex items-center justify-between">
                                    <div class="flex-1 flex items-center min-w-0">
                                        <div class="flex-shrink-0">
                                            @if($ticket->event->image_url)
                                                <img class="h-16 w-16 rounded-md object-cover" src="{{ $ticket->event->image_url }}" alt="{{ $ticket->event->name }}">
                                            @else
                                                <div class="h-16 w-16 rounded-md bg-gray-600 flex items-center justify-center">
                                                    <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4 min-w-0 flex-1">
                                            <div class="text-sm font-medium text-green-400 truncate">
                                                {{ $ticket->event->name }}
                                            </div>
                                            <div class="flex items-center mt-1 text-sm text-gray-400">
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $ticket->event->start_date->format('M j, Y') }}
                                            </div>
                                            <div class="mt-1 flex items-center text-sm text-gray-400">
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                {{ $ticket->event->venue->name ?? 'Online Event' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <div class="flex items-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                {{ $ticket->ticket->ticketType->name ?? 'General Admission' }}
                                            </span>
                                            <svg class="ml-2 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                        <div class="mt-1 text-right text-sm text-gray-400">
                                            {{ $ticket->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="px-6 py-4 border-t border-gray-700">
                    {{ $tickets->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
