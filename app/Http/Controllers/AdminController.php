<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\TeamMember;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        try {
            $stats = [
                'pages_count' => Page::count(),
                'team_count' => TeamMember::count(),
                'gallery_count' => Gallery::count(),
                'active_gallery' => Gallery::where('is_active', true)->count(),
            ];

            $teamMembers = TeamMember::latest()->take(4)->get();
            $gallery = Gallery::latest()->take(6)->get();
            $pages = Page::all();
        } catch (\Exception $e) {
            $stats = ['pages_count' => 0, 'team_count' => 0, 'gallery_count' => 0, 'active_gallery' => 0];
            $teamMembers = collect([]);
            $gallery = collect([]);
            $pages = collect([]);
        }

        return view('admin.dashboard', compact('stats', 'teamMembers', 'gallery', 'pages'));
    }

    // Team Management
    public function manageTeam()
    {
        $teamMembers = TeamMember::all();
        return view('admin.team.index', compact('teamMembers'));
    }

    public function createTeamMember()
    {
        return view('admin.team.create');
    }

    public function storeTeamMember(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'order' => 'nullable|integer',
            ]);

            // Store image with original name
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('team', $imageName, 'public');
                
                Log::info('Team image stored', [
                    'path' => $imagePath,
                    'full_path' => storage_path('app/public/' . $imagePath)
                ]);
            }

            TeamMember::create([
                'name' => $request->name,
                'position' => $request->position,
                'description' => $request->description,
                'image' => $imagePath,
                'order' => $request->order ?? 0,
                'is_active' => $request->has('is_active'),
            ]);

            return redirect()->route('admin.team.index')->with('success', 'Team member added successfully!');

        } catch (\Exception $e) {
            Log::error('Team member creation failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to create team member: ' . $e->getMessage())->withInput();
        }
    }

    public function editTeamMember($id)
    {
        $member = TeamMember::findOrFail($id);
        return view('admin.team.edit', compact('member'));
    }

    public function updateTeamMember(Request $request, $id)
    {
        try {
            $member = TeamMember::findOrFail($id);
            
            $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'order' => 'nullable|integer',
            ]);

            $imagePath = $member->image;
            if ($request->hasFile('image')) {
                // Delete old image
                if ($member->image && Storage::disk('public')->exists($member->image)) {
                    Storage::disk('public')->delete($member->image);
                }
                // Store new image
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('team', $imageName, 'public');
            }

            $member->update([
                'name' => $request->name,
                'position' => $request->position,
                'description' => $request->description,
                'image' => $imagePath,
                'order' => $request->order ?? $member->order,
                'is_active' => $request->has('is_active'),
            ]);

            return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update team member: ' . $e->getMessage())->withInput();
        }
    }

    public function deleteTeamMember($id)
    {
        try {
            $member = TeamMember::findOrFail($id);
            
            // Delete image
            if ($member->image && Storage::disk('public')->exists($member->image)) {
                Storage::disk('public')->delete($member->image);
            }
            
            $member->delete();

            return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete team member: ' . $e->getMessage());
        }
    }

    // Gallery Management
    public function manageGallery()
    {
        $gallery = Gallery::all();
        return view('admin.gallery.index', compact('gallery'));
    }

    public function createGalleryImage()
    {
        return view('admin.gallery.create');
    }

    public function storeGalleryImage(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'order' => 'nullable|integer',
            ]);

            // Store image with original name
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('gallery', $imageName, 'public');
                
                Log::info('Gallery image stored', [
                    'path' => $imagePath,
                    'full_path' => storage_path('app/public/' . $imagePath)
                ]);
            }

            Gallery::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imagePath,
                'order' => $request->order ?? 0,
                'is_active' => $request->has('is_active'),
            ]);

            return redirect()->route('admin.gallery.index')->with('success', 'Gallery image added successfully!');

        } catch (\Exception $e) {
            Log::error('Gallery image creation failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to add gallery image: ' . $e->getMessage())->withInput();
        }
    }

    public function editGalleryImage($id)
    {
        $galleryItem = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('galleryItem'));
    }

    public function updateGalleryImage(Request $request, $id)
    {
        try {
            $galleryItem = Gallery::findOrFail($id);
            
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'order' => 'nullable|integer',
            ]);

            $imagePath = $galleryItem->image;
            if ($request->hasFile('image')) {
                // Delete old image
                if ($galleryItem->image && Storage::disk('public')->exists($galleryItem->image)) {
                    Storage::disk('public')->delete($galleryItem->image);
                }
                // Store new image
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('gallery', $imageName, 'public');
            }

            $galleryItem->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imagePath,
                'order' => $request->order ?? $galleryItem->order,
                'is_active' => $request->has('is_active'),
            ]);

            return redirect()->route('admin.gallery.index')->with('success', 'Gallery image updated successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update gallery image: ' . $e->getMessage())->withInput();
        }
    }

    public function deleteGalleryImage($id)
    {
        try {
            $galleryItem = Gallery::findOrFail($id);
            
            // Delete image
            if ($galleryItem->image && Storage::disk('public')->exists($galleryItem->image)) {
                Storage::disk('public')->delete($galleryItem->image);
            }
            
            $galleryItem->delete();

            return redirect()->route('admin.gallery.index')->with('success', 'Gallery image deleted successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete gallery image: ' . $e->getMessage());
        }
    }

    // Pages Management
    public function listPages()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function editPage($pageSlug)
    {
        $page = Page::where('slug', $pageSlug)->firstOrFail();
        return view('admin.pages.edit', compact('page'));
    }

    public function updatePageContent(Request $request, $pageSlug)
    {
        $page = Page::where('slug', $pageSlug)->firstOrFail();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
        ]);

        $page->update([
            'name' => $request->name,
            'meta_description' => $request->meta_description,
            'content' => $request->content,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully!');
    }
}