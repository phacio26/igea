@extends('layouts.admin')

@section('title', 'Edit Gallery Image')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Edit Gallery Image: {{ $galleryItem->title }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.gallery.update', $galleryItem->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $galleryItem->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description', $galleryItem->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Current Image</label>
                        <div>
                            @if($galleryItem->image_path)
                                <div class="gallery-image-preview mb-3">
                                    <img src="{{ $galleryItem->image_url }}" 
                                         alt="{{ $galleryItem->title }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 300px; height: auto;"
                                         onerror="this.onerror=null; this.src='{{ asset('images/default-image.png') }}';">
                                </div>
                            @else
                                <div class="text-muted">
                                    <i class="bi bi-image fs-1"></i>
                                    <div>No image</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">New Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Leave empty to keep current image. Max 5MB (JPEG, PNG, GIF, WEBP)</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="order" class="form-label">Display Order</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                       id="order" name="order" value="{{ old('order', $galleryItem->order) }}">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Lower numbers display first</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" 
                               {{ old('is_active', $galleryItem->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Gallery Image
                        </button>
                        <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to Gallery
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.gallery-image-preview {
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 10px;
    background: #f8f9fa;
    display: inline-block;
}

.gallery-image-preview img {
    border-radius: 6px;
}
</style>
@endsection