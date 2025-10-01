@extends('layouts.admin')

@section('title', 'Manage Gallery')

@section('content')
@php
use Illuminate\Support\Facades\Storage;
@endphp

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Gallery</h2>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Add New Image
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($gallery->count() > 0)
    <div class="row">
        @foreach($gallery as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($item->image_path && Storage::disk('public')->exists($item->image_path))
                        <div class="gallery-image-container">
                            <img src="{{ asset('storage/' . $item->image_path) }}" 
                                 class="card-img-top" 
                                 alt="{{ $item->title }}">
                        </div>
                    @else
                        <div class="gallery-image-container">
                            <img src="{{ asset('images/placeholder-gallery.jpg') }}" 
                                 class="card-img-top" 
                                 alt="{{ $item->title }}">
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        @if($item->description)
                            <p class="card-text">{{ Str::limit($item->description, 100) }}</p>
                        @endif
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Order: {{ $item->order }}
                                @if($item->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </small>
                            <div class="btn-group">
                                <a href="{{ route('admin.gallery.edit', $item->id) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.gallery.delete', $item->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this image?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-5">
        <i class="bi bi-images display-1 text-muted"></i>
        <h3 class="text-muted mt-3">No Gallery Images</h3>
        <p class="text-muted">Get started by adding your first gallery image.</p>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add First Image
        </a>
    </div>
@endif
@endsection