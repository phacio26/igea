@extends('layouts.admin')

@section('title', 'Edit Page - ' . $page->title)

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Home Page</h4>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Back to Pages
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.pages.update', $page->slug) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Hero Section Background Images</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Background Image URLs</label>
                                            <div id="hero-images-container">
                                                @php
                                                    $heroImages = isset($page->content['hero_images']) ? $page->content['hero_images'] : [
                                                        'images/MANGANI/IMG-20250307-WA0460.jpg',
                                                        'images/MANGANI/IMG-20250307-WA0464.jpg',
                                                        'images/MANGANI/IMG-20250307-WA0460.jpg',
                                                        'images/MANGANI/IMG-20250307-WA0461.jpg'
                                                    ];
                                                @endphp
                                                
                                                @foreach($heroImages as $index => $image)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="content[hero_images][]" 
                                                           value="{{ $image }}" placeholder="Enter image URL">
                                                    <button type="button" class="btn btn-outline-danger remove-image" {{ count($heroImages) <= 1 ? 'disabled' : '' }}>
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-image">
                                                <i class="bi bi-plus"></i> Add Another Image
                                            </button>
                                            <div class="form-text">
                                                Enter the file paths for background images (4 images recommended for slideshow)
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Why Choose Us Statistics</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="products_sold" class="form-label fw-semibold">Products Sold</label>
                                            <input type="number" class="form-control" id="products_sold" 
                                                   name="content[stats][products_sold]" 
                                                   value="{{ $page->content['stats']['products_sold'] ?? 1286 }}"
                                                   min="0">
                                        </div>

                                        <div class="mb-3">
                                            <label for="people_reached" class="form-label fw-semibold">People Reached</label>
                                            <input type="number" class="form-control" id="people_reached" 
                                                   name="content[stats][people_reached]" 
                                                   value="{{ $page->content['stats']['people_reached'] ?? 5000 }}"
                                                   min="0">
                                        </div>

                                        <div class="mb-3">
                                            <label for="eco_friendly" class="form-label fw-semibold">Eco-friendly Percentage</label>
                                            <input type="number" class="form-control" id="eco_friendly" 
                                                   name="content[stats][eco_friendly]" 
                                                   value="{{ $page->content['stats']['eco_friendly'] ?? 100 }}"
                                                   min="0" max="100">
                                            <div class="form-text">Enter percentage (0-100)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center py-3">
                                        <button type="submit" class="btn btn-success px-5 me-3">
                                            <i class="bi bi-check-circle me-2"></i> Update Home Page
                                        </button>
                                        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary px-4">
                                            <i class="bi bi-x-circle me-2"></i> Cancel
                                        </a>
                                        <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-primary px-4 ms-2">
                                            <i class="bi bi-eye me-2"></i> View Home Page
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add image field
    document.getElementById('add-image').addEventListener('click', function() {
        const container = document.getElementById('hero-images-container');
        const newInput = document.createElement('div');
        newInput.className = 'input-group mb-2';
        newInput.innerHTML = `
            <input type="text" class="form-control" name="content[hero_images][]" placeholder="Enter image URL">
            <button type="button" class="btn btn-outline-danger remove-image">
                <i class="bi bi-trash"></i>
            </button>
        `;
        container.appendChild(newInput);
        
        // Enable all remove buttons if we have more than 1 image
        const removeButtons = document.querySelectorAll('.remove-image');
        if (removeButtons.length > 1) {
            removeButtons.forEach(btn => btn.disabled = false);
        }
    });

    // Remove image field
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-image') || e.target.closest('.remove-image')) {
            const button = e.target.classList.contains('remove-image') ? e.target : e.target.closest('.remove-image');
            const container = document.getElementById('hero-images-container');
            const inputs = container.querySelectorAll('.input-group');
            
            if (inputs.length > 1) {
                button.closest('.input-group').remove();
                
                // Disable remove buttons if only 1 image left
                if (inputs.length === 2) { // 2 because we're about to remove one
                    document.querySelectorAll('.remove-image').forEach(btn => btn.disabled = true);
                }
            }
        }
    });
});
</script>

<style>
.card {
    border: 1px solid #dee2e6;
    border-radius: 10px;
}

.card-header {
    border-bottom: 1px solid #dee2e6;
    border-radius: 10px 10px 0 0 !important;
}

.btn {
    border-radius: 6px;
    font-weight: 500;
}

.form-control:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
}
</style>
@endsection