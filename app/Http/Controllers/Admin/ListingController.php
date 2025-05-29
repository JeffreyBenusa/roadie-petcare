<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListingRequest;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
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
        $query = Listing::query();
        
        if (!Auth::user()->isAdmin())
            $query->where('user_id', auth()->id());
        
        $listings = $query
            ->paginate(50)
            ->through(fn ($listing) => [
                'id' => $listing->id,
                'title' => $listing->title,
                'service' => $listing->service->name,
                'body' => $listing->body,
                'user' => $listing->user?->name
            ])
            ->withQueryString();
        
        return Inertia::render('admin/listings/index', [
            'listings' => $listings,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/listings/create', [
            'services' => Service::all(),
            'can' => [
                'create' => auth()->user()->can('create', Availability::class)
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListingRequest $request)
    {
        $attributes = $request->validated();
        $attributes['publisher_id'] = auth()->user();
        
        Listing::create($attributes);
        
        return to_route('admin.listings.index');
    }
    
    /**
     * Redirect 'show' url to edit
     */
    public function show(Listing $listing)
    {
        return redirect()->route('admin.listings.edit', $listing);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        // Authorize the user using the `update` policy for the Listing model
        Gate::authorize('edit', $listing);
        
        // Render the edit page with the necessary data
        return Inertia::render('admin/listings/edit', [
            'listing' => $listing,
            'services' => Service::all(),
        ]);
    }
    
        /**
     * Update the specified resource in storage.
     */
    public function update(ListingRequest $request, Listing $listing)
    {
        // Authorize the user using the `update` policy for the Listing model
        Gate::authorize('update', $listing);
        
        // Perform the update
        $listing->update($request->validated());
        
        // Redirect back to the listings index
        return to_route('admin.listings.index')->with('success', 'Listing updated!');
    }
}
