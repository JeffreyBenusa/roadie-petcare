<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'booked_by_id',
        'date',
        'service_id',
        'notes',
        'status',
    ];
    
    protected $casts = [
        'date' => 'date',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function bookedBy() {
        return $this->belongsTo(User::class, 'booked_by_id');
    }
    
    public function service() {
        return $this->belongsTo(Service::class);
    }
}