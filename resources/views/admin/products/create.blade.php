@extends('layouts.admin')

@section('title', 'Add New Product - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Add New Product</h1>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Products
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name *</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name') }}" required>
                        <div class="form-text">This will appear as the main title on the product page.</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description *</label>
                        <textarea class="form-control" id="description" name="description" 
                                  rows="4" placeholder="Describe the main features and benefits of this product" required>{{ old('description') }}</textarea>
                        <div class="form-text">This description appears at the top of the product page, below the product name.</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="order" class="form-label">Display Order</label>
                        <input type="number" class="form-control" id="order" name="order" 
                               value="{{ old('order', 0) }}" min="0">
                        <div class="form-text">Lower numbers appear first in product listings.</div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                               value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                        <div class="form-text">Inactive products won't be visible on the website.</div>
                    </div>
                </div>
            </div>

            <!-- Product Gallery Images with Captions -->
            <div class="mb-4">
                <h5 class="mb-3">Product Gallery Images *</h5>
                <p class="text-muted mb-4">
                    <strong>Add at least one gallery image for this product.</strong> 
                    Each image can have an optional caption that appears below it.
                </p>
                
                <div id="product-images-container">
                    <div class="product-image-card mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Image File *</label>
                                    <input type="file" class="form-control" name="images[]" accept="image/*" required>
                                    <div class="form-text">First image will be used as the main product image.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="caption-field">
                                    <label class="form-label fw-bold text-primary">
                                        <i class="bi bi-chat-square-text"></i> Image Caption
                                    </label>
                                    <input type="text" class="form-control caption-input" name="image_captions[]" 
                                           placeholder="Enter a descriptive caption for this image (appears below the image on the website)">
                                    <div class="form-text caption-help">
                                        <i class="bi bi-info-circle"></i> This caption will be displayed prominently below the image on the product page. 
                                        Use it to describe what the image shows or highlight specific features.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="button" class="btn btn-outline-primary" id="add-more-images">
                    <i class="bi bi-plus-circle"></i> Add Another Gallery Image
                </button>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-check-circle"></i> Create Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary px-4">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addMoreBtn = document.getElementById('add-more-images');
    const container = document.getElementById('product-images-container');
    
    addMoreBtn.addEventListener('click', function() {
        const newCard = document.createElement('div');
        newCard.className = 'product-image-card mb-4';
        newCard.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Image File *</label>
                        <input type="file" class="form-control" name="images[]" accept="image/*" required>
                        <div class="form-text">Additional gallery images for this product.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="caption-field">
                        <label class="form-label fw-bold text-primary">
                            <i class="bi bi-chat-square-text"></i> Image Caption
                        </label>
                        <input type="text" class="form-control caption-input" name="image_captions[]" 
                               placeholder="Enter a descriptive caption for this image (appears below the image on the website)">
                        <div class="form-text caption-help">
                            <i class="bi bi-info-circle"></i> This caption will be displayed prominently below the image on the product page. 
                            Use it to describe what the image shows or highlight specific features.
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-danger btn-sm mt-3 remove-image">
                        <i class="bi bi-trash"></i> Remove This Image
                    </button>
                </div>
            </div>
        `;
        container.appendChild(newCard);

        newCard.querySelector('.remove-image').addEventListener('click', function() {
            container.removeChild(newCard);
        });
    });
});
</script>

<style>
.product-image-card {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 1rem;
    background: #fff;
    transition: all 0.3s ease;
}

.product-image-card:hover {
    border-color: #28a745;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.1);
}

/* Caption Field Styling */
.caption-field {
    background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 100%);
    border: 2px dashed #4dabf7;
    border-radius: 10px;
    padding: 1.5rem;
    margin: 1rem 0;
    transition: all 0.3s ease;
}

.caption-field:hover {
    background: linear-gradient(135deg, #e3f2fd 0%, #e8f5e8 100%);
    border-color: #228be6;
    box-shadow: 0 4px 15px rgba(77, 171, 247, 0.2);
}

.caption-input {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.75rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.caption-input:focus {
    border-color: #228be6;
    box-shadow: 0 0 0 0.2rem rgba(34, 139, 230, 0.25);
    background: #f8f9ff;
}

.caption-help {
    background: rgba(77, 171, 247, 0.1);
    border-left: 4px solid #4dabf7;
    padding: 0.75rem;
    border-radius: 4px;
    margin-top: 0.5rem;
    color: #495057;
    font-size: 0.9rem;
}

.remove-image {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}

.form-text {
    font-size: 0.85rem;
    color: #6c757d;
}
</style>
@endsection
