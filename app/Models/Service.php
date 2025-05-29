<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
    
    public function availabilities()
    {
        return $this->belongsToMany(Availability::class, 'availability_service');
    }
    
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
} 