<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\TeamMember;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display home page
     */
    public function home()
    {
        $page = Page::where('slug', 'home')->firstOrFail();
        
        // Decode content if it's JSON
        if ($page->content && is_string($page->content)) {
            $page->content = json_decode($page->content, true);
        }
        
        // Get active team members for the team section
        $teamMembers = TeamMember::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Get active gallery items
        $galleryItems = Gallery::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pages.home', compact('page', 'teamMembers', 'galleryItems'));
    }

    /**
     * Display about page
     */
    public function about()
    {
        $page = Page::where('slug', 'about')->firstOrFail();
        
        // Get active team members
        $teamMembers = TeamMember::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pages.about', compact('page', 'teamMembers'));
    }

    /**
     * Display team page
     */
    public function team()
    {
        $page = Page::where('slug', 'team')->firstOrFail();
        
        $teamMembers = TeamMember::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pages.team', compact('page', 'teamMembers'));
    }

    /**
     * Display gallery page
     */
    public function gallery()
    {
        $page = Page::where('slug', 'gallery')->firstOrFail();
        
        $galleryItems = Gallery::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pages.gallery', compact('page', 'galleryItems'));
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        $page = Page::where('slug', 'contact')->firstOrFail();
        return view('pages.contact', compact('page'));
    }

    /**
     * Display products page
     */
    public function products()
    {
        $page = Page::where('slug', 'products')->firstOrFail();
        $products = Product::with('images')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pages.products', compact('page', 'products'));
    }

    /**
     * Display individual product detail page
     */
    public function showProduct($slug)
    {
        $product = Product::with('images')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get other active products for related products section
        $relatedProducts = Product::with('images')
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->orderBy('order')
            ->take(3)
            ->get();

        return view('pages.product-detail', compact('product', 'relatedProducts'));
    }

    /**
     * Handle contact form submission
     */
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        
        
        return redirect()->route('contact')->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    /**
     * Fallback method for any other page requests
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        // Check if there's a specific view for this page
        $viewName = 'pages.' . $slug;
        if (view()->exists($viewName)) {
            return view($viewName, compact('page'));
        }
        
        // Fallback to generic page view
        return view('pages.generic', compact('page'));
    }
}