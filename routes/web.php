<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ConfirmationController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Homepage with featured events
Route::get('/', [HomeController::class, 'index'])->name('home');

// Browse events with search and filters
Route::get('/Browse', [BrowseController::class, 'index'])->name('Browse');

// AJAX search for autocomplete
Route::get('/api/search', [BrowseController::class, 'search'])->name('api.search');


// Event details
Route::get('/Eventsdetails/{slug?}', [EventController::class, 'show'])->name('Eventsdetails');

/*
|--------------------------------------------------------------------------
| Static Pages (for now)
|--------------------------------------------------------------------------
*/

// Checkout flow using controllers
Route::post('/checkout', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

// Payment flow using controllers  
Route::get('/payment', [PaymentController::class, 'show'])->name('payment');
Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');

// Confirmation page
Route::get('/confirmation', [ConfirmationController::class, 'show'])->name('confirmation');

// Download ticket route
Route::middleware(['auth'])->get('/confirmation/download/{ticketId}', [ConfirmationController::class, 'downloadTicket'])->name('confirmation.download');

// Mark ticket as scanned route
Route::middleware(['auth'])->post('/ticket/{ticketId}/scan', function($ticketId) {
    $userTicket = \App\Models\UserTicket::where('id', $ticketId)
        ->where('user_id', auth()->id())
        ->first();
    
    if ($userTicket && $userTicket->status === 'not_scanned') {
        $userTicket->markAsScanned();
        return response()->json([
            'success' => true,
            'message' => 'Ticket scanned successfully',
            'scanned_at' => $userTicket->scanned_at->toISOString()
        ]);
    }
    
    return response()->json([
        'success' => false,
        'message' => 'Ticket not found or already scanned'
    ], 404);
})->name('ticket.scan');

// Ticket verification route
Route::get('/ticket/verify/{ticketId}', function($ticketId) {
    return response()->json([
        'valid' => true,
        'ticket_id' => $ticketId,
        'message' => 'Ticket verified successfully',
        'scanned_at' => now()->toISOString()
    ]);
})->name('ticket.verify');

Route::middleware(['auth'])->get('/Tickets', function(){
    // Get user's purchased tickets with status filtering
    $status = request('status', 'all');
    
    $userTicketsQuery = \App\Models\UserTicket::with(['event.venue', 'ticket.ticketType'])
        ->where('user_id', auth()->id());
    
    // Apply status filter
    switch($status) {
        case 'upcoming':
            $userTicketsQuery->upcoming()->notScanned();
            break;
        case 'scanned':
            $userTicketsQuery->scanned();
            break;
        case 'expired':
            $userTicketsQuery->expired();
            break;
        case 'not_scanned':
            $userTicketsQuery->notScanned();
            break;
        default:
            // Show all tickets
            break;
    }
    
    $userTickets = $userTicketsQuery->orderBy('purchased_at', 'desc')->get();
    
    // Get counts for each status
    $statusCounts = [
        'all' => \App\Models\UserTicket::where('user_id', auth()->id())->count(),
        'upcoming' => \App\Models\UserTicket::where('user_id', auth()->id())->upcoming()->notScanned()->count(),
        'scanned' => \App\Models\UserTicket::where('user_id', auth()->id())->scanned()->count(),
        'expired' => \App\Models\UserTicket::where('user_id', auth()->id())->expired()->count(),
        'not_scanned' => \App\Models\UserTicket::where('user_id', auth()->id())->notScanned()->count(),
    ];
        
    return view('Tickets.Tickets', compact('userTickets', 'statusCounts', 'status'));
})->name('Tickets');

// Ticket verification route for QR code scanning
Route::get('/ticket/verify/{ticketId}', function($ticketId) {
    // Extract reference and timestamp from ticket ID
    $parts = explode('-', $ticketId);
    $reference = $parts[0] ?? 'TKT';
    
    // For demo purposes, create sample ticket data
    // In production, this would query the database for actual ticket data
    $ticketData = [
        'ticket_id' => $ticketId,
        'reference' => $reference,
        'event' => [
            'name' => 'Sample Event',
            'date' => now()->addDays(30)->format('l, F j, Y'),
            'time' => now()->addDays(30)->format('g:i A T'),
            'venue' => 'Laurens Garden'
        ],
        'tickets' => [
            ['name' => 'Sample Ticket', 'quantity' => 1, 'price' => 3500]
        ],
        'total_amount' => 2500,
        'status' => 'confirmed'
    ];
    
    return view('ticket.verify', compact('ticketData'));
})->name('ticket.verify');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    // Redirect dashboard to home
    Route::redirect('dashboard', '/')->name('dashboard');

    // User Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::redirect('/', 'settings/profile');
        Route::get('/profile', Profile::class)->name('profile');
        Route::get('/password', Password::class)->name('password');
        Route::get('/appearance', Appearance::class)->name('appearance');
    });
});

require __DIR__.'/auth.php';
