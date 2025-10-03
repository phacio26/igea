<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Models\TeamMember;
use App\Models\Page;
use App\Models\Gallery;
use Illuminate\Support\Facades\Route;

// Create admin user route (remove after use)
Route::get('/create-admin-user', [AuthController::class, 'createAdminUser']);

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Public Image Display Routes - FIXED ROUTES
Route::get('/team-member-image/{id}', [AdminController::class, 'showTeamMemberImage'])->name('team.image');
Route::get('/gallery-image/{id}', [AdminController::class, 'showGalleryImage'])->name('gallery.image');
Route::get('/home-bg-image/{filename}', [AdminController::class, 'showHomeBackgroundImage'])->name('home.bg.image');

// Debug route (remove after testing)
Route::get('/debug-images', function() {
    $teamMembers = \App\Models\TeamMember::all();
    $debug = [];
    
    foreach ($teamMembers as $member) {
        $debug[] = [
            'id' => $member->id,
            'name' => $member->name,
            'image_path' => $member->image_path,
            'image_url' => $member->image_url,
            'storage_exists' => $member->image_path ? \Illuminate\Support\Facades\Storage::disk('public')->exists('team/' . $member->image_path) : false,
            'file_path' => $member->image_path ? storage_path('app/public/team/' . $member->image_path) : null,
            'file_exists' => $member->image_path ? file_exists(storage_path('app/public/team/' . $member->image_path)) : false,
        ];
    }
    
    return response()->json($debug);
});

// Public Routes
Route::get('/', function () {
    try {
        $page = Page::where('slug', 'home')->first();
    } catch (\Exception $e) {
        $page = null;
    }
    
    try {
        $gallery = Gallery::where('is_active', true)
            ->orderBy('order')
            ->limit(6)
            ->get();
    } catch (\Exception $e) {
        $gallery = collect([]);
    }
    
    $defaultContent = [
        'hero_images' => [
            'images/MANGANI/IMG-20250307-WA0460.jpg',
            'images/MANGANI/IMG-20250307-WA0464.jpg',
            'images/MANGANI/IMG-20250307-WA0460.jpg',
            'images/MANGANI/IMG-20250307-WA0461.jpg'
        ],
        'stats' => [
            'products_sold' => 1286,
            'people_reached' => 5000,
            'eco_friendly' => 100
        ],
        'hero' => [
            'title' => 'Inclusive Green Energy Africa',
            'subtitle' => 'Empowering Communities Through Sustainable Energy',
            'description' => 'Providing innovative solar energy solutions to drive economic growth and environmental sustainability across Africa.'
        ],
        'why_choose_title' => 'Why Choose Inclusive Green Energy Africa?',
        'products_title' => 'Our Products & Services',
        'products' => [
            [
                'title' => 'Solar Home Systems',
                'description' => 'Complete solar solutions for residential use, providing reliable electricity for lighting, charging, and small appliances.',
                'icon' => 'bi-house-check'
            ],
            [
                'title' => 'Solar Water Pumping',
                'description' => 'Efficient solar-powered water pumping systems for irrigation and domestic water supply.',
                'icon' => 'bi-droplet'
            ],
            [
                'title' => 'Energy Consulting',
                'description' => 'Expert advice and consultation services for sustainable energy projects and implementations.',
                'icon' => 'bi-lightbulb'
            ]
        ],
        'gallery_title' => 'Our Work in Action',
        'gallery_description' => 'See how we\'re transforming communities through sustainable energy solutions.'
    ];

    $content = $page && !empty($page->content) ? json_decode($page->content, true) : $defaultContent;

    return view('pages.home', compact('page', 'content', 'gallery'));
})->name('home');

Route::get('/about', function () {
    try {
        $page = Page::where('slug', 'about')->first();
    } catch (\Exception $e) {
        $page = null;
    }
    
    $defaultContent = [
        'hero' => [
            'title' => 'About Inclusive Green Energy Africa',
            'subtitle' => 'Driving Sustainable Energy Solutions Across Africa'
        ],
        'sections' => [
            'who_we_are' => [
                'title' => 'Who We Are',
                'content' => 'Inclusive Green Energy Africa is a pioneering organization dedicated to providing sustainable energy solutions that empower communities across Africa. We believe in the transformative power of renewable energy to drive economic growth and improve quality of life.'
            ],
            'vision' => [
                'title' => 'Our Vision',
                'content' => 'To be the leading provider of inclusive and sustainable energy solutions across Africa, empowering communities and driving environmental conservation.'
            ],
            'mission' => [
                'title' => 'Our Mission',
                'content' => 'To provide accessible, affordable, and sustainable energy solutions that transform lives, empower communities, and protect our environment through innovative solar technologies.'
            ],
            'keys' => [
                'title' => 'Our Key Focus Areas',
                'items' => [
                    'Solar Home Systems for rural electrification',
                    'Solar water pumping for agriculture and domestic use',
                    'Energy efficiency consulting',
                    'Community empowerment through renewable energy'
                ]
            ],
            'overview' => [
                'title' => 'Company Overview',
                'content' => 'Founded with a passion for sustainable development, Inclusive Green Energy Africa combines technical expertise with deep community engagement to deliver energy solutions that make a real difference in people\'s lives.'
            ]
        ]
    ];

    $content = $page && !empty($page->content) ? json_decode($page->content, true) : $defaultContent;

    return view('pages.about', compact('page', 'content'));
})->name('about');

Route::get('/products', function () {
    try {
        $page = Page::where('slug', 'products')->first();
    } catch (\Exception $e) {
        $page = null;
    }
    
    $defaultContent = [
        'hero' => [
            'title' => 'Our Products & Services',
            'subtitle' => 'Sustainable Energy Solutions for Every Need'
        ],
        'sections' => [
            'solar_home' => [
                'title' => 'Solar Home Systems',
                'content' => 'Complete solar solutions designed for residential use, providing reliable electricity for lighting, mobile charging, radio, television, and small appliances. Our systems are perfect for both urban and rural households.',
                'images' => []
            ],
            'solar_water' => [
                'title' => 'Solar Water Pumping Systems',
                'content' => 'Efficient solar-powered water pumping solutions for irrigation, livestock watering, and domestic water supply. Reduce your energy costs while ensuring reliable water access.',
                'images' => []
            ]
        ]
    ];

    $content = $page && !empty($page->content) ? json_decode($page->content, true) : $defaultContent;

    return view('pages.products', compact('page', 'content'));
})->name('products');

// Public Gallery Route
Route::get('/gallery', function () {
    try {
        $gallery = Gallery::where('is_active', true)
            ->orderBy('order')
            ->get();
    } catch (\Exception $e) {
        $gallery = collect([]);
    }
    return view('pages.gallery', compact('gallery'));
})->name('gallery');

Route::get('/team', function () {
    try {
        $teamMembers = TeamMember::where('is_active', true)
            ->orderBy('order')
            ->get();
    } catch (\Exception $e) {
        $teamMembers = collect([]);
    }
    return view('pages.team', compact('teamMembers'));
})->name('team');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Admin routes - protected by auth middleware
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Team Members Routes - FIXED: Added PUT routes
    Route::prefix('team')->group(function () {
        Route::get('/', [AdminController::class, 'manageTeam'])->name('admin.team.index');
        Route::get('/create', [AdminController::class, 'createTeamMember'])->name('admin.team.create');
        Route::post('/store', [AdminController::class, 'storeTeamMember'])->name('admin.team.store');
        Route::get('/edit/{id}', [AdminController::class, 'editTeamMember'])->name('admin.team.edit');
        Route::put('/update/{id}', [AdminController::class, 'updateTeamMember'])->name('admin.team.update'); // FIXED: Changed to PUT
        Route::post('/update/{id}', [AdminController::class, 'updateTeamMember'])->name('admin.team.update.post'); // Alternative POST route
        Route::delete('/delete/{id}', [AdminController::class, 'deleteTeamMember'])->name('admin.team.delete');
        Route::patch('/toggle-status/{id}', [AdminController::class, 'toggleTeamMemberStatus'])->name('admin.team.toggle-status');
    });
    
    // Gallery Routes - FIXED: Added PUT routes
    Route::prefix('gallery')->group(function () {
        Route::get('/', [AdminController::class, 'manageGallery'])->name('admin.gallery.index');
        Route::get('/create', [AdminController::class, 'createGalleryImage'])->name('admin.gallery.create');
        Route::post('/store', [AdminController::class, 'storeGalleryImage'])->name('admin.gallery.store');
        Route::get('/edit/{id}', [AdminController::class, 'editGalleryImage'])->name('admin.gallery.edit');
        Route::put('/update/{id}', [AdminController::class, 'updateGalleryImage'])->name('admin.gallery.update'); // FIXED: Changed to PUT
        Route::post('/update/{id}', [AdminController::class, 'updateGalleryImage'])->name('admin.gallery.update.post'); // Alternative POST route
        Route::delete('/delete/{id}', [AdminController::class, 'deleteGalleryImage'])->name('admin.gallery.delete');
    });
    
    // Page Routes - FIXED: Added PUT route for page updates
    Route::delete('/admin/pages/{id}/delete', [AdminController::class, 'deletePage'])->name('admin.pages.delete');
    Route::prefix('pages')->group(function () {
        Route::get('/', [AdminController::class, 'listPages'])->name('admin.pages.index');
        Route::get('/edit/{pageSlug}', [AdminController::class, 'editPage'])->name('admin.pages.edit');
        Route::put('/update/{pageSlug}', [AdminController::class, 'updatePageContent'])->name('admin.pages.update'); // FIXED: Changed to PUT
        Route::post('/update/{pageSlug}', [AdminController::class, 'updatePageContent'])->name('admin.pages.update.post'); // Alternative POST route
    });
});

// Redirect /admin to dashboard
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

// Fallback route for 404 pages
Route::fallback(function () {
    abort(404);
});