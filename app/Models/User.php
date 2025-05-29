<?php

namespace App\Models;

use App\Models\Service;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\hasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'services'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'services' => 'array',
        ];
    }
    
    public function isAdmin() : bool
    {
        return $this->role === 'admin';
    }
    
    public function reviews() : hasMany
    {
        return $this->hasMany(Review::class,'provider_id');
    }
    
    public function rating(): Attribute
    {
        return Attribute::make(
            get: function () {
                $reviews = $this->relationLoaded('reviews')
                    ? $this->reviews
                    : $this->reviews()->get();
                
                return round($reviews->average('rating'), 1);
            },
        );
    }
    
    public function availabilities() : hasMany
    {
        return $this->hasMany(Availability::class);
    }
    
    public function services()
    {
        return Service::whereHas('availabilities', function ($query) {
            $query->where('user_id', $this->id);
        })->distinct()->get();
    }
}
