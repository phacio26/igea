<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes - MUST COME FIRST
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/team', [PageController::class, 'team'])->name('team');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

// Product routes for public site
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/products/{product:slug}', [PageController::class, 'showProduct'])->name('products.show');

// Authentication Routes with Cache Control
Route::get('/login', function () {
    $response = response()->view('auth.login');
    
    return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                   ->header('Pragma', 'no-cache')
                   ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});

// Enhanced Logout Route
Route::post('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    
    return redirect('/login')
        ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
})->name('logout');

// Admin Routes - All admin routes should have cache control
 
Route::get('/admin/products/images/{filename}', [AdminController::class, 'showProductImageAdmin'])
    ->name('admin.products.image');
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Page Management
    Route::get('/pages', [AdminController::class, 'listPages'])->name('admin.pages.index');
    Route::get('/pages/{pageSlug}/edit', [AdminController::class, 'editPage'])->name('admin.pages.edit');
    Route::put('/pages/{pageSlug}/update', [AdminController::class, 'updatePageContent'])->name('admin.pages.update');
    Route::delete('/pages/{pageSlug}/delete-image', [AdminController::class, 'deleteHomePageImage'])->name('admin.pages.delete-image');
    Route::delete('/pages/{id}', [AdminController::class, 'deletePage'])->name('admin.pages.delete');
    
    // Team Management
    Route::get('/team', [AdminController::class, 'manageTeam'])->name('admin.team.index');
    Route::get('/team/create', [AdminController::class, 'createTeamMember'])->name('admin.team.create');
    Route::post('/team', [AdminController::class, 'storeTeamMember'])->name('admin.team.store');
    Route::get('/team/{id}/edit', [AdminController::class, 'editTeamMember'])->name('admin.team.edit');
    Route::put('/team/{id}', [AdminController::class, 'updateTeamMember'])->name('admin.team.update');
    Route::delete('/team/{id}', [AdminController::class, 'deleteTeamMember'])->name('admin.team.delete');
    Route::patch('/team/{id}/toggle-status', [AdminController::class, 'toggleTeamMemberStatus'])->name('admin.team.toggle-status');
    
    // Gallery Management
    Route::get('/gallery', [AdminController::class, 'manageGallery'])->name('admin.gallery.index');
    Route::get('/gallery/create', [AdminController::class, 'createGalleryImage'])->name('admin.gallery.create');
    Route::post('/gallery', [AdminController::class, 'storeGalleryImage'])->name('admin.gallery.store');
    Route::get('/gallery/{id}/edit', [AdminController::class, 'editGalleryImage'])->name('admin.gallery.edit');
    Route::put('/gallery/{id}', [AdminController::class, 'updateGalleryImage'])->name('admin.gallery.update');
    Route::delete('/gallery/{id}', [AdminController::class, 'deleteGalleryImage'])->name('admin.gallery.delete');
    
    // Product Management Routes
    Route::get('/products', [AdminController::class, 'manageProducts'])->name('admin.products.index');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    Route::patch('/products/{id}/toggle-status', [AdminController::class, 'toggleProductStatus'])->name('admin.products.toggle-status');
    Route::delete('/products/images/{id}', [AdminController::class, 'deleteProductImage'])->name('admin.products.images.delete');
});

// Image display routes
Route::get('/storage/team/{filename}', [AdminController::class, 'showTeamMemberImage'])->name('team.image');
Route::get('/storage/gallery/{filename}', [AdminController::class, 'showGalleryImage'])->name('gallery.image');
Route::get('/storage/home-backgrounds/{filename}', [AdminController::class, 'showHomeBackgroundImage'])->name('home.background.image');
Route::get('/storage/products/{filename}', [AdminController::class, 'showProductImage'])->name('products.image');

// Fallback route
Route::fallback(function () {
    return redirect('/');
});