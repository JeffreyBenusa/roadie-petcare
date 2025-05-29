<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Bookings the user has made
        $bookings = Booking::with(['user', 'service'])
            ->where('booked_by_id', $user->id)
            ->latest()
            ->get();
        
        return inertia('bookings/index', [
            'bookings' => $bookings,
        ]);
    }
    
    public function create()
    {
        $services = Service::all();
        
        return inertia('bookings/create', [
            'services' => $services,
        ]);
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'date' => ['required', 'date'],
            'service_id' => ['nullable', 'exists:services,id'],
            'notes' => ['nullable', 'string'],
        ]);
        
        // Optionally, you can check if user is available here
        
        // Check for existing booking
        $exists = Booking::where('user_id', $validated['user_id'])
            ->where('date', $validated['date'])
            ->exists();
        
        if ($exists) {
            return back()->withErrors(['date' => 'That date is already booked.']);
        }
        
        Booking::create([
            'user_id' => $validated['user_id'],
            'booked_by_id' => $user->id,
            'date' => $validated['date'],
            'service_id' => $validated['service_id'],
            'notes' => $validated['notes'],
        ]);
        
        return redirect()->route('bookings.index')->with('success', 'Booking confirmed!');
    }
    
    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        
        $booking->delete();
        
        return back()->with('success', 'Booking canceled.');
    }
}