<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Models\Availability;
use App\Models\Service;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $listings = Listing::query()
            ->when(Request::input('service'), function ($query, $type) {
                $query->where('service_id', $type);
            })
            ->orderBy('created_at')
            ->paginate(12)
            ->through(fn ($listing) => [
                'id' => $listing->id,
                'title' => $listing->title,
                'service' => $listing->service->name,
                'body' => $listing->body,
                'user' => $listing->user
            ])
            ->withQueryString();
        
        return Inertia::render('listings/index', [
            'listings' => $listings,
            'filters' => Request::only(['service']),
            'services' => Service::all()->toArray(),
        ]);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return Inertia::render('listings/show', [
            'listing' => $listing,
        ]);
    }
}
