<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvailabilityDate extends Model
{
    /** @use HasFactory<\Database\Factories\AvailabilityDateFactory> */
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'service_type_id',
        'date',
        'max_pets',
        'booked_pets',
    ];
    
    protected $casts = [
        'date' => 'date',
    ];
    
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function serviceType() : BelongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }
    
    protected function bookedPets(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
//                todo: Set violation on model to stop from overbooking. (draft) Erroring during seeding
//                if ($value > $this->max_pets) {
//                    throw new \InvalidArgumentException('Cannot overbook: booked pets exceeds max.');
//                }
//
                return $value;
            }
        );
    }
}