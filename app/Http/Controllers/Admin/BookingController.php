<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::with(['user', 'bookedBy', 'service'])
            ->latest()
            ->paginate(20);
        
        return inertia('admin/bookings/index', [
            'bookings' => $bookings,
        ]);
    }
    
    public function show(Booking $booking)
    {
        $booking->load(['user', 'bookedBy', 'service']);
        
        return inertia('admin/bookings/show', [
            'booking' => $booking,
        ]);
    }
    
    public function destroy(Booking $booking)
    {
        $booking->delete();
        
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted.');
    }
}