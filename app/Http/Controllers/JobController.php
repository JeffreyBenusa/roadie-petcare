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
            ->orderBy('created_at')
            ->paginate(12)
            ->through(fn ($job) => [
                'id' => $job->id,
                'title' => $job->title,
                'serviceType' => $job->serviceType->name,
                'body' => $job->body,
                'user' => $job->user
            ])
            ->withQueryString();
        
        return Inertia::render('jobs/index', [
            'jobs' => $jobs,
            'filters' => Request::only(['service_type']),
            'serviceTypes' => ServiceType::all()->toArray(),
        ]);
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
}
