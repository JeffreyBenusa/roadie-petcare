<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
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
        $query = Job::query();
        
        if (!Auth::user()->isAdmin())
            $query->where('user_id', auth()->id());
        
        $jobs = $query
            ->paginate(50)
            ->through(fn ($job) => [
                'id' => $job->id,
                'title' => $job->title,
                'serviceType' => $job->serviceType->name,
                'body' => $job->body,
                'user' => $job->user?->name
            ])
            ->withQueryString();
        
        return Inertia::render('admin/jobs/index', [
            'jobs' => $jobs,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/jobs/create', [
            'serviceTypes' => ServiceType::all(),
            'can' => [
                'create' => auth()->user()->can('create', Availability::class)
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        $attributes = $request->validated();
        $attributes['publisher_id'] = auth()->id();
        
        Job::create($attributes);
        
        return to_route('admin.jobs.index');
    }
    
    /**
     * Redirect 'show' url to edit
     */
    public function show(Job $job)
    {
        return redirect()->route('admin.jobs.edit', $job);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        // Authorize the user using the `update` policy for the Job model
        Gate::authorize('edit', $job);
        
        // Render the edit page with the necessary data
        return Inertia::render('admin/jobs/edit', [
            'job' => $job,
            'serviceTypes' => ServiceType::all(),
        ]);
    }
        
        
        /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $job)
    {
        // Authorize the user using the `update` policy for the Job model
        Gate::authorize('update', $job);
        
        // Perform the update
        $job->update($request->validated());
        
        // Redirect back to the jobs index
        return to_route('admin.jobs.index');
    }
}
