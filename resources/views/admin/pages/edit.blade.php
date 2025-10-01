@extends('layouts.admin')

@section('title', 'Edit Page - ' . $page->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Edit Page: {{ $page->name }}</h1>
    <div>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary me-2">
            <i class="bi bi-arrow-left"></i> Back to Pages
        </a>
        <a href="{{ route($page->slug) }}" target="_blank" class="btn btn-outline-primary">
            <i class="bi bi-eye"></i> View Live
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<form action="{{ route('admin.pages.update', $page->slug) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Page Content</h5>
        </div>
        <div class="card-body">
            <!-- Hero Section -->
            <div class="mb-4">
                <h6>Hero Section</h6>
                <div class="row">
                    <div class="col-md-4">
                        <label for="hero_title" class="form-label">Hero Title</label>
                        <input type="text" class="form-control" id="hero_title" name="content[hero][title]"
                               value="{{ $page->content['hero']['title'] ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <label for="hero_subtitle" class="form-label">Hero Subtitle</label>
                        <input type="text" class="form-control" id="hero_subtitle" name="content[hero][subtitle]"
                               value="{{ $page->content['hero']['subtitle'] ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <label for="hero_description" class="form-label">Hero Description</label>
                        <input type="text" class="form-control" id="hero_description" name="content[hero][description]"
                               value="{{ $page->content['hero']['description'] ?? '' }}">
                    </div>
                </div>
            </div>

            <!-- Dynamic content based on page type -->
            @if($page->slug === 'home')
                <!-- Home Page Specific Fields -->
                <div class="mb-4">
                    <h6>Why Choose Us Section</h6>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="why_choose_title" class="form-label">Section Title</label>
                            <input type="text" class="form-control" id="why_choose_title" name="content[why_choose_title]"
                                   value="{{ $page->content['why_choose_title'] ?? '' }}">
                        </div>
                        <!-- Stats fields would go here -->
                    </div>
                </div>
            @elseif($page->slug === 'about')
                <!-- About Page Specific Fields -->
                <div class="mb-4">
                    <h6>About Sections</h6>
                    <!-- Who We Are -->
                    <div class="mb-3">
                        <label for="who_we_are_title" class="form-label">Who We Are Title</label>
                        <input type="text" class="form-control" id="who_we_are_title" name="content[sections][who_we_are][title]"
                               value="{{ $page->content['sections']['who_we_are']['title'] ?? '' }}">
                        <label for="who_we_are_content" class="form-label mt-2">Content</label>
                        <textarea class="form-control" id="who_we_are_content" name="content[sections][who_we_are][content]" rows="4">{{ $page->content['sections']['who_we_are']['content'] ?? '' }}</textarea>
                    </div>
                    <!-- Add more sections as needed -->
                </div>
            @endif

            <!-- Meta Information -->
            <div class="mb-3">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input type="text" class="form-control" id="meta_title" name="meta_title"
                       value="{{ $page->meta_title ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ $page->meta_description ?? '' }}</textarea>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle"></i> Update Page
        </button>
    </div>
</form>
@endsection