<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\TeamMember;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    // ... your existing methods ...

    /**
     * Update page content
     */
    public function updatePageContent(Request $request, $pageSlug)
    {
        $page = Page::where('slug', $pageSlug)->firstOrFail();
        
        // Validate the request
        $request->validate([
            'hero_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'content.stats.products_sold' => 'required|integer|min:0',
            'content.stats.people_reached' => 'required|integer|min:0',
            'content.stats.eco_friendly' => 'required|integer|min:0|max:100',
        ]);

        // Get existing content or create new array
        $content = $page->content ? json_decode($page->content, true) : [];
        
        // Handle image uploads
        $heroImages = [];
        $existingImages = $request->input('existing_images', []);
        
        // Process each image field
        if ($request->hasFile('hero_images')) {
            foreach ($request->file('hero_images') as $index => $file) {
                if ($file && $file->isValid()) {
                    // Generate unique filename
                    $filename = 'home-bg-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();
                    
                    // Store the image
                    $file->storeAs('public/home-backgrounds', $filename);
                    
                    // Add to images array with public path
                    $heroImages[] = 'storage/home-backgrounds/' . $filename;
                } elseif (isset($existingImages[$index]) && !empty($existingImages[$index])) {
                    // Keep existing image if no new file was uploaded
                    $heroImages[] = $existingImages[$index];
                }
            }
        } else {
            // If no new files uploaded, keep all existing images
            $heroImages = array_filter($existingImages); // Remove empty values
        }
        
        // Ensure we have at least one image
        if (empty($heroImages)) {
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
     * List all pages
     */
    public function listPages()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
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
        
        return view('admin.pages.edit', compact('page'));
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
     * Dashboard - FIXED VERSION
     */
    public function dashboard()
    {
        // Get counts for stats cards
        $teamCount = TeamMember::count();
        $galleryCount = Gallery::count();
        $pageCount = Page::count();
        $activeTeamMembers = TeamMember::where('is_active', true)->count();
        $activeGalleryItems = Gallery::where('is_active', true)->count();

        // Get full collections for display sections
        $teamMembers = TeamMember::orderBy('order')->get();
        $gallery = Gallery::orderBy('order')->get();
        $pages = Page::all();

        return view('admin.dashboard', compact(
            'teamCount', 
            'galleryCount', 
            'pageCount',
            'activeTeamMembers',
            'activeGalleryItems',
            'teamMembers',
            'gallery',
            'pages'
        ));
    }

    /**
     * Team Management Methods
     */
    public function manageTeam()
    {
        $teamMembers = TeamMember::orderBy('order')->get();
        return view('admin.team.index', compact('teamMembers'));
    }

    public function createTeamMember()
    {
        return view('admin.team.create');
    }

    public function storeTeamMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
        return view('admin.team.edit', compact('member'));
    }

    public function updateTeamMember(Request $request, $id)
    {
        $member = TeamMember::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
     * Gallery Management Methods
     */
    public function manageGallery()
    {
        $gallery = Gallery::orderBy('order')->get();
        return view('admin.gallery.index', compact('gallery'));
    }

    public function createGalleryImage()
    {
        return view('admin.gallery.create');
    }

    public function storeGalleryImage(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
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
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function updateGalleryImage(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
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
}