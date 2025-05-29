<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'date',
    ];
    
    protected $casts = [
        'date' => 'date',
    ];
    
    /**
     * Relationship: Availability belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Relationship: Availability has many services.
     */
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    
    /**
     * Scope: Filter by user ID.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
    
    /**
     * Scope: Filter by specific date.
     */
    public function scopeOnDate($query, $date)
    {
        return $query->whereDate('date', $date);
    }
}