<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Review::query();
        
        if (!Auth::user()->isAdmin())
            $query->where('user_id', auth()->id());
        
        $reviews = $query
            ->paginate(50)
            ->through(fn ($review) => [
                'id' => $review->id,
                'title' => $review->title,
                'body' => $review->body,
                'rating' => $review->rating,
                'user' => $review->user?->name,
                'listing' => $review->listing?->title
            ])
            ->withQueryString();
        
        return Inertia::render('admin/reviews/index', [
            'reviews' => $reviews,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/reviews/create', [
            'can' => [
                'create' => auth()->user()->can('create', Review::class)
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {
        $attributes = $request->validated();
        
        $attributes['provider_id'] = auth()->id();
        
        Review::create($attributes);
        
        return to_route('admin.reviews.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return redirect()->route('admin.reviews.edit', $review);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        // Authorize the user using the `update` policy for the Review model
        Gate::authorize('edit', $review);
        
        // Render the edit page with the necessary data
        return Inertia::render('admin/reviews/edit', [
            'review' => $review,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, Review $review)
    {
        // Authorize the user using the `update` policy for the Review model
        Gate::authorize('update', $review);
        
        // Perform the update
        $review->update($request->validated());
        
        // Redirect back to the listings index
        return to_route('admin.reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
