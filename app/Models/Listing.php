<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listing extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'body',
        'publisher_id',
        'start_date',
        'end_date',
        'slug',
        'service_id',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }
    
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
    
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'listing_id');
    }
}