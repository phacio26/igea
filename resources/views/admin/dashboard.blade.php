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
                <h2>{{ $stats['pages_count'] }}</h2>
                <p class="mb-0">Pages</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body text-center">
                <h2>{{ $stats['team_count'] }}</h2>
                <p class="mb-0">Team Members</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body text-center">
                <h2>{{ $stats['gallery_count'] }}</h2>
                <p class="mb-0">Gallery Items</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body text-center">
                <h2>{{ $stats['active_gallery'] }}</h2>
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
                                @if($member->image)
                                    <img src="{{ Storage::disk('public')->url($member->image) }}" 
                                         alt="{{ $member->name }}" 
                                         class="rounded me-3"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-3"
                                         style="width: 60px; height: 60px;">
                                        <i class="bi bi-person text-muted"></i>
                                    </div>
                                @endif
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
                        <div class="col-4">
                            <div class="position-relative">
                                <img src="{{ Storage::disk('public')->url($item->image) }}" 
                                     alt="{{ $item->title }}" 
                                     class="img-fluid rounded" 
                                     style="height: 80px; width: 100%; object-fit: cover;">
                                <div class="position-absolute top-0 end-0 m-1">
                                    <a href="{{ route('admin.gallery.edit', $item->id) }}" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                                <small class="d-block text-truncate mt-1" title="{{ $item->title }}">
                                    {{ $item->title }}
                                </small>
                                @if(!$item->is_active)
                                    <span class="badge bg-secondary">Inactive</span>
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
@endsection