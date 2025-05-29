<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AvailabilityController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $services = Service::all();
        
        // Get service IDs the user has selected through availabilities
        $selected = $user->services()->pluck('id')->unique()->values();
        
        return Inertia::render('admin/availability/index', [
            'services' => $services,
            'selectedServiceIds' => $selected,
        ]);
    }
    
    public function updateServices(Request $request)
    {
        $validated = $request->validate([
            'service_ids' => 'array',
            'service_ids.*' => 'exists:services,id',
        ]);
        
        $user = auth()->user();
        
        // Remove all current associations and re-sync
        $user->availabilities()->each(function ($availability) use ($validated) {
            $availability->services()->sync($validated['service_ids']);
        });
        
        return redirect()->route('admin.dashboard')->with('success', 'Services updated!');
    }
}