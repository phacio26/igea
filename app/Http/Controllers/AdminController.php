<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\TeamMember;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Add no-cache headers to response
     */
    protected function addNoCacheHeaders($response)
    {
        return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                       ->header('Pragma', 'no-cache')
                       ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
    }

    /**
     * Delete home page background image immediately
     */
    public function deleteHomePageImage(Request $request, $pageSlug)
    {
        $page = Page::where('slug', $pageSlug)->firstOrFail();
        
        $request->validate([
            'image_path' => 'required|string'
        ]);

        $imagePath = $request->input('image_path');

        // Get current content
        $content = $page->content;
        if (is_string($content)) {
            $content = json_decode($content, true) ?? [];
        } elseif (!is_array($content)) {
            $content = [];
        }

        // Remove the image from hero_images array
        if (isset($content['hero_images'])) {
            $content['hero_images'] = array_values(array_filter($content['hero_images'], function($image) use ($imagePath) {
                return $image !== $imagePath;
            }));

            // Ensure we have at least one image
            if (empty($content['hero_images'])) {
                $content['hero_images'] = [
                    'images/MANGANI/IMG-20250307-WA0460.jpg',
                    'images/MANGANI/IMG-20250307-WA0464.jpg',
                    'images/MANGANI/IMG-20250307-WA0460.jpg',
                    'images/MANGANI/IMG-20250307-WA0461.jpg'
                ];
            }

            // Update the page
            $page->update([
                'content' => json_encode($content)
            ]);

            // Delete physical file if it's in storage (not default images)
            if (strpos($imagePath, 'storage/page-backgrounds/') !== false) {
                $filename = str_replace('storage/page-backgrounds/', '', $imagePath);
                Storage::delete('public/page-backgrounds/' . $filename);
            } elseif (strpos($imagePath, 'storage/home-backgrounds/') !== false) {
                $filename = str_replace('storage/home-backgrounds/', '', $imagePath);
                Storage::delete('public/home-backgrounds/' . $filename);
            }
            // Don't delete default images from public/images folder

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Image not found'
        ], 404);
    }

    /**
     * Update page content - FIXED VERSION
     */
    public function updatePageContent(Request $request, $pageSlug)
    {
        $page = Page::where('slug', $pageSlug)->firstOrFail();
        
        // Validate the request
        $request->validate([
            'hero_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:51200', // 50MB
            'content.stats.products_sold' => 'required|integer|min:0',
            'content.stats.people_reached' => 'required|integer|min:0',
            'content.stats.eco_friendly' => 'required|integer|min:0|max:100',
        ]);

        // FIX: Check if content is already an array or needs decoding
        $content = $page->content;
        if (is_string($content)) {
            $content = json_decode($content, true) ?? [];
        } elseif (!is_array($content)) {
            $content = [];
        }
        
        // Handle image uploads - FIXED LOGIC
        $heroImages = [];
        $existingImages = $request->input('existing_images', []);
        
        // Process uploaded files while preserving existing images
        if ($request->hasFile('hero_images')) {
            $uploadedFiles = $request->file('hero_images');
            
            foreach ($existingImages as $index => $existingImage) {
                // Check if a new file was uploaded for this position
                if (isset($uploadedFiles[$index]) && $uploadedFiles[$index] && $uploadedFiles[$index]->isValid()) {
                    $file = $uploadedFiles[$index];
                    
                    // Generate unique filename
                    $filename = 'home-bg-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();
                    
                    // Store the image
                    $file->storeAs('public/home-backgrounds', $filename);
                    
                    // Add to images array with public path
                    $heroImages[] = 'storage/home-backgrounds/' . $filename;
                } else {
                    // Keep existing image if no new file was uploaded for this position
                    $heroImages[] = $existingImage;
                }
            }
        } else {
            // If no new files uploaded, keep all existing images
            $heroImages = $existingImages;
        }
        
        // Ensure we have at least one image
        if (empty($heroImages) || empty(array_filter($heroImages))) {
            $heroImages = [
                'images/MANGANI/IMG-20250307-WA0460.jpg',
                'images/MANGANI/IMG-20250307-WA0464.jpg',
                'images/MANGANI/IMG-20250307-WA0460.jpg',
                'images/MANGANI/IMG-20250307-WA0461.jpg'
            ];
        }
        
        // Update content array - preserve existing content and only update what we're changing
        $content['hero_images'] = $heroImages;
        
        // Update stats - merge with existing stats to preserve any other stat fields
        $existingStats = $content['stats'] ?? [];
        $content['stats'] = array_merge($existingStats, $request->input('content.stats', []));
        
        // Update page
        $page->update([
            'content' => json_encode($content),
            'meta_title' => $request->input('meta_title', $page->meta_title),
            'meta_description' => $request->input('meta_description', $page->meta_description),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Home page updated successfully!');
    }

    /**
     * Display home background image
     */
    public function showHomeBackgroundImage($filename)
    {
        try {
            $path = storage_path('app/public/home-backgrounds/' . $filename);
            
            if (!file_exists($path)) {
                abort(404);
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        } catch (\Exception $e) {
            return response()->file(public_path('images/default-image.png'));
        }
    }

    /**
     * Display page background image (generic for all pages)
     */
    public function showPageBackgroundImage($filename)
    {
        try {
            $path = storage_path('app/public/page-backgrounds/' . $filename);
            
            if (!file_exists($path)) {
                abort(404);
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        } catch (\Exception $e) {
            return response()->file(public_path('images/default-image.png'));
        }
    }

    /**
     * List all pages
     */
    public function listPages()
    {
        $pages = Page::all();
        $response = response()->view('admin.pages.index', compact('pages'));
        return $this->addNoCacheHeaders($response);
    }

    /**
     * Show page edit form
     */
    public function editPage($pageSlug)
    {
        $page = Page::where('slug', $pageSlug)->firstOrFail();
        
        // Ensure content is properly decoded
        if ($page->content && is_string($page->content)) {
            $page->content = json_decode($page->content, true);
        }
        
        $response = response()->view('admin.pages.edit', compact('page'));
        return $this->addNoCacheHeaders($response);
    }

    /**
     * Show team member image
     */
    public function showTeamMemberImage($id)
    {
        try {
            $teamMember = TeamMember::findOrFail($id);
            
            if (!$teamMember->image_path) {
                return response()->file(public_path('images/default-avatar.png'));
            }

            $path = storage_path('app/public/team/' . $teamMember->image_path);
            
            if (!file_exists($path)) {
                return response()->file(public_path('images/default-avatar.png'));
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        } catch (\Exception $e) {
            return response()->file(public_path('images/default-avatar.png'));
        }
    }

    /**
     * Show gallery image
     */
    public function showGalleryImage($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            
            if (!$gallery->image_path) {
                return response()->file(public_path('images/default-image.png'));
            }

            $path = storage_path('app/public/gallery/' . $gallery->image_path);
            
            if (!file_exists($path)) {
                return response()->file(public_path('images/default-image.png'));
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        } catch (\Exception $e) {
            return response()->file(public_path('images/default-image.png'));
        }
    }

    /**
     * Dashboard - UPDATED WITH PRODUCTS
     */
    public function dashboard()
    {
        // Get counts for stats cards
        $teamCount = TeamMember::count();
        $galleryCount = Gallery::count();
        $pageCount = Page::count();
        $productCount = Product::count();
        $activeTeamMembers = TeamMember::where('is_active', true)->count();
        $activeGalleryItems = Gallery::where('is_active', true)->count();

        // Get full collections for display sections
        $teamMembers = TeamMember::orderBy('order')->get();
        $gallery = Gallery::orderBy('order')->get();
        $pages = Page::all();
        $products = Product::with('images')->orderBy('order')->get();

        $response = response()->view('admin.dashboard', compact(
            'teamCount', 
            'galleryCount', 
            'pageCount',
            'productCount',
            'activeTeamMembers',
            'activeGalleryItems',
            'teamMembers',
            'gallery',
            'pages',
            'products'
        ));
        return $this->addNoCacheHeaders($response);
    }

    /**
     * Team Management Methods
     */
    public function manageTeam()
    {
        $teamMembers = TeamMember::orderBy('order')->get();
        $response = response()->view('admin.team.index', compact('teamMembers'));
        return $this->addNoCacheHeaders($response);
    }

    public function createTeamMember()
    {
        $response = response()->view('admin.team.create');
        return $this->addNoCacheHeaders($response);
    }

    public function storeTeamMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:51200', // 50MB
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'team-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/team', $filename);
            $imagePath = $filename;
        }

        TeamMember::create([
            'name' => $request->name,
            'position' => $request->position,
            'description' => $request->description,
            'image_path' => $imagePath,
            'order' => $request->order,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.team.index')->with('success', 'Team member created successfully!');
    }

    public function editTeamMember($id)
    {
        $member = TeamMember::findOrFail($id);
        $response = response()->view('admin.team.edit', compact('member'));
        return $this->addNoCacheHeaders($response);
    }

    public function updateTeamMember(Request $request, $id)
    {
        $member = TeamMember::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:51200', // 50MB
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $updateData = [
            'name' => $request->name,
            'position' => $request->position,
            'description' => $request->description,
            'order' => $request->order,
            'is_active' => $request->is_active ?? true,
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($member->image_path) {
                Storage::delete('public/team/' . $member->image_path);
            }

            $image = $request->file('image');
            $filename = 'team-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/team', $filename);
            $updateData['image_path'] = $filename;
        }

        $member->update($updateData);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully!');
    }

    public function deleteTeamMember($id)
    {
        $member = TeamMember::findOrFail($id);

        // Delete image
        if ($member->image_path) {
            Storage::delete('public/team/' . $member->image_path);
        }

        $member->delete();

        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully!');
    }

    public function toggleTeamMemberStatus($id)
    {
        $member = TeamMember::findOrFail($id);
        $member->update([
            'is_active' => !$member->is_active
        ]);

        $status = $member->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.team.index')->with('success', "Team member {$status} successfully!");
    }

    /**
     * Delete a page
     */
    public function deletePage($id)
    {
        $page = Page::findOrFail($id);
        
        // Prevent deletion of home page
        if ($page->slug === 'home') {
            return redirect()->route('admin.pages.index')->with('error', 'Home page cannot be deleted.');
        }
        
        $pageTitle = $page->title;
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', "Page '{$pageTitle}' deleted successfully!");
    }

    /**
     * Gallery Management Methods
     */
    public function manageGallery()
    {
        $gallery = Gallery::orderBy('order')->get();
        $response = response()->view('admin.gallery.index', compact('gallery'));
        return $this->addNoCacheHeaders($response);
    }

    public function createGalleryImage()
    {
        $response = response()->view('admin.gallery.create');
        return $this->addNoCacheHeaders($response);
    }

    public function storeGalleryImage(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:51200', // 50MB
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'gallery-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/gallery', $filename);
            $imagePath = $filename;
        }

        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'order' => $request->order,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image added successfully!');
    }

    public function editGalleryImage($id)
    {
        $gallery = Gallery::findOrFail($id);
        $response = response()->view('admin.gallery.edit', compact('gallery'));
        return $this->addNoCacheHeaders($response);
    }

    public function updateGalleryImage(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:51200', // 50MB
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order,
            'is_active' => $request->is_active ?? true,
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image_path) {
                Storage::delete('public/gallery/' . $gallery->image_path);
            }

            $image = $request->file('image');
            $filename = 'gallery-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/gallery', $filename);
            $updateData['image_path'] = $filename;
        }

        $gallery->update($updateData);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image updated successfully!');
    }

    public function deleteGalleryImage($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete image
        if ($gallery->image_path) {
            Storage::delete('public/gallery/' . $gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image deleted successfully!');
    }

    /**
     * Product Management Methods
     */
    public function manageProducts()
    {
        $products = Product::with('images')->orderBy('order')->get();
        $response = response()->view('admin.products.index', compact('products'));
        return $this->addNoCacheHeaders($response);
    }

    public function createProduct()
    {
        $response = response()->view('admin.products.create');
        return $this->addNoCacheHeaders($response);
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:51200',
            'image_captions.*' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Generate unique slug
        $slug = $this->generateUniqueSlug($request->name);

        // Create product with proper order value
        $product = Product::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'features' => $request->features ? array_filter(array_map('trim', explode("\n", $request->features))) : [],
            'order' => $request->order ?? 0,
            'is_active' => $request->is_active ?? true,
        ]);

        // Handle gallery images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                if ($image && $image->isValid()) {
                    $filename = 'product-' . $product->id . '-' . $index . '-' . time() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/products', $filename);
                    
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $filename,
                        'caption' => $request->image_captions[$index] ?? null,
                        'order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function editProduct($id)
    {
        $product = Product::with('images')->findOrFail($id);
        
        // Ensure features is properly formatted for textarea
        if ($product->features && is_array($product->features)) {
            $product->features = implode("\n", $product->features);
        }
        
        $response = response()->view('admin.products.edit', compact('product'));
        return $this->addNoCacheHeaders($response);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:51200',
            'image_captions.*' => 'nullable|string|max:255',
            'existing_images.*' => 'nullable|string',
            'existing_captions.*' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Generate unique slug if name changed
        $slug = $product->slug;
        if ($product->name !== $request->name) {
            $slug = $this->generateUniqueSlug($request->name, $product->id);
        }

        $updateData = [
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'features' => $request->features ? array_filter(array_map('trim', explode("\n", $request->features))) : [],
            'order' => $request->order ?? $product->order,
            'is_active' => $request->is_active ?? true,
        ];

        $product->update($updateData);

        // Update existing images and captions
        if ($request->has('existing_images')) {
            foreach ($request->existing_images as $imageId => $imagePath) {
                $productImage = ProductImage::find($imageId);
                if ($productImage && $productImage->product_id == $product->id) {
                    $productImage->update([
                        'caption' => $request->existing_captions[$imageId] ?? null
                    ]);
                }
            }
        }

        // Handle new additional images
        if ($request->hasFile('images')) {
            $existingImagesCount = $product->images()->count();
            
            foreach ($request->file('images') as $index => $image) {
                if ($image && $image->isValid()) {
                    $filename = 'product-' . $product->id . '-' . ($existingImagesCount + $index) . '-' . time() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/products', $filename);
                    
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $filename,
                        'caption' => $request->image_captions[$index] ?? null,
                        'order' => $existingImagesCount + $index,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        // Delete additional images
        foreach ($product->images as $image) {
            Storage::delete('public/products/' . $image->image_path);
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    public function deleteProductImage($id)
    {
        $image = ProductImage::findOrFail($id);
        
        Storage::delete('public/products/' . $image->image_path);
        $image->delete();

        return response()->json(['success' => true]);
    }

    public function toggleProductStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'is_active' => !$product->is_active
        ]);

        $status = $product->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.products.index')->with('success', "Product {$status} successfully!");
    }

     
    public function showProductImage($filename)
    {
        try {
            $path = storage_path('app/public/products/' . $filename);
            
            if (!file_exists($path)) {
                // Try to find the image in the database
                $productImage = ProductImage::where('image_path', $filename)->first();
                if (!$productImage) {
                    return response()->file(public_path('images/default-product.png'));
                }
                
                // If database record exists but file doesn't, return default
                return response()->file(public_path('images/default-product.png'));
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            
            // Add caching headers for better performance
            return $response->header('Cache-Control', 'public, max-age=31536000')
                          ->header('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + 31536000));
        } catch (\Exception $e) {
            \Log::error('Product image error: ' . $e->getMessage());
            return response()->file(public_path('images/default-product.png'));
        }
    }

    /**
     * Show product image for admin - separate method to avoid caching issues
     */
    public function showProductImageAdmin($filename)
    {
        try {
            $path = storage_path('app/public/products/' . $filename);
            
            if (!file_exists($path)) {
                return response()->file(public_path('images/default-product.png'));
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            
            // No caching for admin to see immediate changes
            return $this->addNoCacheHeaders($response);
        } catch (\Exception $e) {
            return response()->file(public_path('images/default-product.png'));
        }
    }

    /**
     * Generate unique slug for products
     */
    private function generateUniqueSlug($name, $excludeId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        // Check if slug exists
        while (Product::where('slug', $slug)
            ->when($excludeId, function($query) use ($excludeId) {
                return $query->where('id', '!=', $excludeId);
            })
            ->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}