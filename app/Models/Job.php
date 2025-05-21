<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;
    
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }
    
    public function serviceType(): belongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }
    
    // fillable
    protected $fillable = [
        'title',
        'body',
        'service_type_id',
        'publisher_id',
    ];
}
