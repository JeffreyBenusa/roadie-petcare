<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'service_type_id');
    }
} 