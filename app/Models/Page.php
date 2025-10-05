<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'is_active'
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Get the content as array with fallback
     */
    public function getContentAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Set the content as JSON
     */
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = is_array($value) ? json_encode($value) : $value;
    }

    /**
     * Get hero images with fallback
     */
    public function getHeroImagesAttribute()
    {
        $content = $this->content;
        $heroImages = $content['hero_images'] ?? [];
        
        // If no hero images, return default images
        if (empty($heroImages) || empty(array_filter($heroImages))) {
            return [
                'images/MANGANI/IMG-20250307-WA0460.jpg',
                'images/MANGANI/IMG-20250307-WA0464.jpg',
                'images/MANGANI/IMG-20250307-WA0460.jpg',
                'images/MANGANI/IMG-20250307-WA0461.jpg'
            ];
        }

        return $heroImages;
    }

    /**
     * Get stats with fallback
     */
    public function getStatsAttribute()
    {
        $content = $this->content;
        $stats = $content['stats'] ?? [];
        
        return array_merge([
            'products_sold' => 0,
            'people_reached' => 0,
            'eco_friendly' => 0
        ], $stats);
    }

    /**
     * Scope to get only active pages
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}