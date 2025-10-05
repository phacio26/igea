<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'features',
        'image_path',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'features' => 'array'
    ];

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/products/' . $this->image_path);
        }
        return asset('images/default-product.png');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}