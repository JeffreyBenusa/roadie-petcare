<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Review extends Pivot
{
    protected $table = 'reviews';
    
    protected $fillable = [
        'provider_id',
        'listing_id',
        'rating',
        'title',
        'body'
    ];
    
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;
    
    public function user() : belongsTo
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
    
    public function listing() : belongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}
