<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_url',
        'price_start',
        'price_end',
        'duration_hours',
        'features',
        'package_type',
        'is_popular',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
        'price_start' => 'decimal:2',
        'price_end' => 'decimal:2'
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getFormattedPriceAttribute(): string
    {
        if ($this->price_end && $this->price_end > $this->price_start) {
            return 'Rp ' . number_format($this->price_start, 0, ',', '.') . ' - Rp ' . number_format($this->price_end, 0, ',', '.');
        }

        return 'Rp ' . number_format($this->price_start, 0, ',', '.');
    }

    public function getImageUrlAttribute($value): string
    {
        if ($value && !str_starts_with($value, 'http')) {
            return asset('storage/' . $value);
        }

        return $value ?: asset('images/placeholder-service.jpg');
    }
}
