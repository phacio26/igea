@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Website Overview</h1>
    <div class="text-muted">
        <small>Last updated: {{ now()->format('M j, Y g:i A') }}</small>
    </div>
</div>

<!-- Quick Stats -->
<div class="row mb-5">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body text-center">
                <h2>{{ $pageCount }}</h2>
                <p class="mb-0">Pages</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body text-center">
                <h2>{{ $teamCount }}</h2>
                <p class="mb-0">Team Members</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body text-center">
                <h2>{{ $galleryCount }}</h2>
                <p class="mb-0">Gallery Items</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body text-center">
                <h2>{{ $activeGalleryItems }}</h2>
                <p class="mb-0">Active Gallery</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Current Team Members -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Current Team Members</h5>
                <a href="{{ route('admin.team.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle"></i> Add New
                </a>
            </div>
            <div class="card-body">
                @if($teamMembers->count() > 0)
                    <div class="row">
                        @foreach($teamMembers as $member)
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <!-- Updated Image Display -->
                                <div class="team-dash-image-container me-3">
                                    <img src="{{ $member->image_url }}" 
                                         alt="{{ $member->name }}" 
                                         class="team-dash-img"
                                         onerror="this.onerror=null; this.src='{{ asset('images/default-avatar.png') }}';">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $member->name }}</h6>
                                    <small class="text-muted">{{ $member->position }}</small>
                                    <div class="mt-1">
                                        <a href="{{ route('admin.team.edit', $member->id) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-people display-4 text-muted"></i>
                        <p class="text-muted mt-2">No team members yet</p>
                        <a href="{{ route('admin.team.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Add First Team Member
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Current Gallery Images -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Current Gallery Images</h5>
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle"></i> Add New
                </a>
            </div>
            <div class="card-body">
                @if($gallery->count() > 0)
                    <div class="row g-2">
                        @foreach($gallery->take(6) as $item)
                        <div class="col-4 mb-3">
                            <div class="gallery-dash-card position-relative">
                                <!-- Updated Image Display -->
                                <div class="gallery-dash-image-container">
                                    <img src="{{ $item->image_url }}" 
                                         alt="{{ $item->title }}" 
                                         class="gallery-dash-img"
                                         onerror="this.onerror=null; this.src='{{ asset('images/default-image.png') }}';">
                                </div>
                                <div class="gallery-dash-overlay">
                                    <div class="gallery-dash-content">
                                        <small class="gallery-dash-title text-white">{{ Str::limit($item->title, 20) }}</small>
                                    </div>
                                </div>
                                <div class="position-absolute top-0 end-0 m-1">
                                    <a href="{{ route('admin.gallery.edit', $item->id) }}" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                                @if(!$item->is_active)
                                    <span class="position-absolute top-0 start-0 m-1 badge bg-secondary">Inactive</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if($gallery->count() > 6)
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-primary btn-sm">
                                View All {{ $gallery->count() }} Images
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-images display-4 text-muted"></i>
                        <p class="text-muted mt-2">No gallery images yet</p>
                        <a href="{{ route('admin.gallery.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Add First Image
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Current Pages -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Website Pages</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($pages as $page)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-title">{{ $page->name }}</h6>
                                <p class="card-text text-muted small">
                                    {{ $page->meta_description ?: 'No description set' }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge {{ $page->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $page->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    <a href="{{ route('admin.pages.edit', $page->slug) }}" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.pages.edit', 'home') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-house me-2"></i>Edit Home Page
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.pages.edit', 'about') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-info-circle me-2"></i>Edit About Page
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.team.create') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-person-plus me-2"></i>Add Team Member
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.gallery.create') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-plus-circle me-2"></i>Add Gallery Image
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Live Preview -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Live Website Preview</h5>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-success btn-sm">
                    <i class="bi bi-eye me-1"></i> View Live Site
                </a>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Changes made here will be reflected immediately on the live website.
                </div>
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('home') }}" target="_blank" class="text-decoration-none">
                            <div class="card">
                                <div class="card-body">
                                    <i class="bi bi-house display-6 text-primary"></i>
                                    <h6 class="mt-2">Home Page</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('about') }}" target="_blank" class="text-decoration-none">
                            <div class="card">
                                <div class="card-body">
                                    <i class="bi bi-info-circle display-6 text-primary"></i>
                                    <h6 class="mt-2">About Page</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('team') }}" target="_blank" class="text-decoration-none">
                            <div class="card">
                                <div class="card-body">
                                    <i class="bi bi-people display-6 text-primary"></i>
                                    <h6 class="mt-2">Team Page</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('gallery') }}" target="_blank" class="text-decoration-none">
                            <div class="card">
                                <div class="card-body">
                                    <i class="bi bi-images display-6 text-primary"></i>
                                    <h6 class="mt-2">Gallery Page</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Team Member Dashboard Styles */
.team-dash-image-container {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.team-dash-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

/* Gallery Dashboard Styles */
.gallery-dash-card {
    border-radius: 8px;
    overflow: hidden;
    background: white;
    transition: all 0.3s ease;
}

.gallery-dash-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.gallery-dash-image-container {
    width: 100%;
    height: 100px;
    overflow: hidden;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gallery-dash-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-dash-card:hover .gallery-dash-img {
    transform: scale(1.05);
}

.gallery-dash-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.6) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: flex-end;
    padding: 0.5rem;
}

.gallery-dash-card:hover .gallery-dash-overlay {
    opacity: 1;
}

.gallery-dash-content {
    transform: translateY(10px);
    transition: transform 0.3s ease;
}

.gallery-dash-card:hover .gallery-dash-content {
    transform: translateY(0);
}

.gallery-dash-title {
    font-size: 0.75rem;
    font-weight: 500;
    line-height: 1.2;
}

/* Mobile Responsive Styles */
@media (max-width: 576px) {
    .team-dash-image-container {
        width: 50px;
        height: 50px;
    }
    
    .gallery-dash-image-container {
        height: 80px;
    }
    
    .gallery-dash-img {
        object-fit: contain;
        width: auto;
        max-width: 100%;
        max-height: 100%;
    }
    
    .gallery-dash-overlay {
        opacity: 1;
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.4) 100%);
    }
    
    .gallery-dash-content {
        transform: translateY(0);
    }
}

@media (min-width: 577px) and (max-width: 768px) {
    .gallery-dash-image-container {
        height: 90px;
    }
    
    .gallery-dash-img {
        object-fit: cover;
    }
}

@media (min-width: 769px) and (max-width: 992px) {
    .gallery-dash-image-container {
        height: 100px;
    }
}

@media (min-width: 993px) {
    .gallery-dash-image-container {
        height: 110px;
    }
}
</style>
@endsection