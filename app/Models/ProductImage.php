<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_path', 
        'caption',
        'order'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            // Check if we're in admin area by looking at the current URL
            $currentUrl = url()->current();
            if (str_contains($currentUrl, '/admin/')) {
                return route('admin.products.image', $this->image_path);
            }
            return asset('storage/products/' . $this->image_path);
        }
        return asset('images/default-product.png');
    }
}