<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Models\Availability;
use App\Models\ServiceType;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::query()
            ->when(Request::input('service_type'), function ($query, $type) {
                $query->where('service_type_id', $type);
            })
            ->when(Request::input('date'), function ($query, $date) {
                $query->where('date', $date);
            })
            ->orderBy('date')
            ->paginate(12)
            ->through(fn ($job) => [
                'id' => $job->id,
                'title' => $job->title,
                'serviceType' => $job->serviceType->name,
                'body' => $job->body,
                'user' => $job->userw
            ])
            ->withQueryString();
        
        return Inertia::render('jobs/index', [
            'jobs' => $jobs,
            'filters' => Request::only(['service_type', 'start_date', 'end_date']),
            'serviceTypes' => ServiceType::all()->toArray(),
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Job::class);
        
        return Inertia::render('jobs/create', [
            'serviceTypes' => \App\Models\ServiceType::all(),
            'can' => [
                'create' => auth()->user()->can('create', Job::class)
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = Request::validate([
            'service_type_id' => 'required|exists:service_types,id',
            'starts_at' => 'required|date|after:now',
            'ends_at' => 'required|date|after:starts_at',
            'price' => 'required|numeric|min:0',
            'body' => 'required|min:10',
            'max_pets' => 'required|integer|min:1',
            'location' => 'required|string',
        ]);

        $attributes['provider_id'] = auth()->id();
        
        Job::create($attributes);
        
        return to_route('jobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        
        return Inertia::render('jobs/show', [
            'job' => $job,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $availability = Availability::findOrFail($id);
        Gate::authorize('update', $availability);
        
        return Inertia::render('jobs/edit', [
            'job' => $availability,
            'serviceTypes' => \App\Models\ServiceType::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $availability = Availability::findOrFail($id);
        Gate::authorize('update', $availability);
        
        $attributes = Request::validate([
            'service_type_id' => 'required|exists:service_types,id',
            'starts_at' => 'required|date|after:now',
            'ends_at' => 'required|date|after:starts_at',
            'price' => 'required|numeric|min:0',
            'body' => 'required|min:10',
            'max_pets' => 'required|integer|min:1',
            'location' => 'required|string',
        ]);
        
        $availability->update($attributes);
        
        return to_route('jobs.show', $availability);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $availability = Availability::findOrFail($id);
        Gate::authorize('delete', $availability);
        
        $availability->delete();
        
        return to_route('jobs.index');
    }
}
