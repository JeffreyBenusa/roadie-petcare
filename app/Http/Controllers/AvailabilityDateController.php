<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Inertia\Inertia;

class AvailabilityDateController extends Controller
{
    public function search(Request $request)
    {
        $filters = $request->only(['start_date', 'end_date', 'service_type_id']);
        
        $users = [];
        
        // Ensure all filters are present before running query
        if (collect($filters)->filter()->count() === 3) {
            
            $validated = $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'service_type_id' => 'required|exists:service_types,id',
            ]);
            
            $start = Carbon::parse($validated['start_date']);
            $end = Carbon::parse($validated['end_date']);
            $days = (int) $start->diffInDays($end) + 1;
            
            $dateRange = collect();
            for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                $dateRange->push($date->toDateString());
            }
            
            $userIds = DB::table('availability_dates')
                ->select('user_id', DB::raw('COUNT(DISTINCT DATE(date)) as distinct_days'))
                ->whereRaw('max_pets > booked_pets')
                ->where('service_type_id', $validated['service_type_id'])
                ->whereIn(DB::raw('DATE(date)'), $dateRange)
                ->groupBy('user_id')
                ->havingRaw('COUNT(DISTINCT DATE(date)) = ?', [$days])
                ->pluck('user_id');
            
            $users = User::whereIn('id', $userIds)->get();
        }
        
        return Inertia::render('providers/index', [
            'serviceTypes' => ServiceType::all(),
            'users' => $users,
            'filters' => $filters,
        ]);
    }
}