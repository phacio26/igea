@extends('layouts.admin')

@section('title', 'Edit Product - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Edit Product: {{ $product->name }}</h1>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Products
    </a>
</div>

<!-- Success Message Container -->
<div id="successMessage" class="alert alert-success alert-dismissible fade show" style="display: none;" role="alert">
    <i class="bi bi-check-circle me-2"></i>
    <span id="successText"></span>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name *</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name', $product->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control" id="description" name="description" 
                                  rows="6" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="order" class="form-label">Display Order</label>
                        <input type="number" class="form-control" id="order" name="order" 
                               value="{{ old('order', $product->order) }}" min="0">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                               value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>

            <!-- Existing Additional Images -->
            @if($product->images->count() > 0)
            <div class="mb-4">
                <h5 class="mb-3">Existing Gallery Images</h5>
                @foreach($product->images as $image)
                <div class="existing-image-group mb-4" id="image-{{ $image->id }}">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            @php
                                // FIXED: Use direct public storage path since files exist there
                                $filename = basename($image->image_path);
                                $imageSrc = asset('storage/products/' . $filename);
                            @endphp
                            <img src="{{ $imageSrc }}" 
                                 alt="{{ $image->caption }}" 
                                 class="img-thumbnail"
                                 style="max-height: 120px; width: 100%; object-fit: cover;"
                                 onerror="this.src='{{ asset('images/default-product.png') }}'">
                            <div class="text-center small mt-1 text-success">
                                <i class="bi bi-check-circle"></i> Loaded
                            </div>
                        </div>
                        <div class="col-md-8">
                            <input type="hidden" name="existing_images[{{ $image->id }}]" 
                                   value="{{ $image->image_path }}">
                            <div class="caption-field">
                                <label class="form-label fw-bold text-primary">
                                    <i class="bi bi-chat-square-text"></i> Image Caption
                                </label>
                                <input type="text" class="form-control caption-input" 
                                       name="existing_captions[{{ $image->id }}]" 
                                       value="{{ old('existing_captions.'.$image->id, $image->caption) }}"
                                       placeholder="Enter a descriptive caption for this image (appears below the image on the website)">
                                <div class="form-text caption-help">
                                    <i class="bi bi-info-circle"></i> This caption will be displayed prominently below the image on the product page. 
                                    Use it to describe what the image shows or highlight specific features.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-center justify-content-end">
                            <button type="button" 
                                    class="btn btn-outline-danger btn-sm delete-image"
                                    data-image-id="{{ $image->id }}"
                                    onclick="confirmImageDelete('{{ $image->id }}', '{{ addslashes($image->caption ?: 'Untitled Image') }}')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- New Additional Images -->
            <div class="mb-4">
                <h5 class="mb-3">Add New Gallery Images</h5>
                <p class="text-muted mb-4">
                    <strong>Add more images to this product gallery.</strong> 
                    Each image can have an optional caption that appears below it.
                </p>
                
                <div id="additional-images-container">
                    <div class="additional-image-group mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Image File</label>
                                    <input type="file" class="form-control" name="images[]" accept="image/*">
                                    <div class="form-text">Select an image file to upload.</div>
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
                    <i class="bi bi-check-circle"></i> Update Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary px-4">
                    Cancel
                </a>
                <button type="button" class="btn btn-outline-danger px-4" 
                        onclick="confirmProductDelete('{{ $product->name }}', '{{ route('admin.products.delete', $product->id) }}')">
                    <i class="bi bi-trash me-2"></i> Delete Product
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Product Confirmation Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteProductModalLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Confirm Product Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="bi bi-box display-4 text-danger"></i>
                </div>
                <h6 class="fw-semibold mb-3">You are about to delete a product</h6>
                <p class="mb-2">This action will permanently remove:</p>
                <p class="fw-bold text-dark mb-3" id="productName"></p>
                <div class="alert alert-warning small mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    This action cannot be undone. The product and all its images will be permanently removed from the website.
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Cancel
                </button>
                <form id="deleteProductForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="bi bi-trash me-2"></i>Confirm Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Image Confirmation Modal -->
<div class="modal fade" id="deleteImageModal" tabindex="-1" aria-labelledby="deleteImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="deleteImageModalLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Confirm Image Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="bi bi-image display-4 text-warning"></i>
                </div>
                <h6 class="fw-semibold mb-3">You are about to delete an image</h6>
                <p class="mb-2">This action will permanently remove:</p>
                <p class="fw-bold text-dark mb-3" id="imageCaption"></p>
                <div class="alert alert-warning small mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    This action cannot be undone. The image will be permanently removed from the product gallery.
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Cancel
                </button>
                <button type="button" class="btn btn-warning px-4" id="confirmImageDelete">
                    <i class="bi bi-trash me-2"></i>Confirm Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add more images functionality
    const addMoreBtn = document.getElementById('add-more-images');
    const container = document.getElementById('additional-images-container');
    
    addMoreBtn.addEventListener('click', function() {
        const newGroup = document.createElement('div');
        newGroup.className = 'additional-image-group mb-4';
        newGroup.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Image File</label>
                        <input type="file" class="form-control" name="images[]" accept="image/*">
                        <div class="form-text">Select an image file to upload.</div>
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
        
        container.appendChild(newGroup);
        
        // Add remove functionality
        newGroup.querySelector('.remove-image').addEventListener('click', function() {
            container.removeChild(newGroup);
        });
    });
});

// Product deletion confirmation
function confirmProductDelete(productName, deleteUrl) {
    document.getElementById('productName').textContent = productName;
    document.getElementById('deleteProductForm').action = deleteUrl;
    const modal = new bootstrap.Modal(document.getElementById('deleteProductModal'));
    modal.show();
}

// Image deletion confirmation
function confirmImageDelete(imageId, imageCaption) {
    document.getElementById('imageCaption').textContent = imageCaption || 'Untitled Image';
    
    // Set up the confirmation button
    const confirmBtn = document.getElementById('confirmImageDelete');
    confirmBtn.onclick = function() {
        deleteImage(imageId);
    };
    
    const modal = new bootstrap.Modal(document.getElementById('deleteImageModal'));
    modal.show();
}

// Function to delete image via AJAX
function deleteImage(imageId) {
    // Show loading state on the button
    const confirmBtn = document.getElementById('confirmImageDelete');
    const originalText = confirmBtn.innerHTML;
    confirmBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Deleting...';
    confirmBtn.disabled = true;

    fetch(`/admin/products/images/${imageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Find and remove the image element
            const imageElement = document.getElementById(`image-${imageId}`);
            if (imageElement) {
                imageElement.remove();
            }
            
            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteImageModal'));
            modal.hide();
            
            // Show success message in the alert box
            showSuccessMessage('Image deleted successfully!');
        } else {
            showSuccessMessage('Error deleting image. Please try again.', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showSuccessMessage('Error deleting image. Please try again.', 'error');
    })
    .finally(() => {
        // Reset button state
        confirmBtn.innerHTML = originalText;
        confirmBtn.disabled = false;
    });
}

// Function to show success/error messages
function showSuccessMessage(message, type = 'success') {
    const successMessage = document.getElementById('successMessage');
    const successText = document.getElementById('successText');
    
    if (type === 'error') {
        successMessage.className = 'alert alert-danger alert-dismissible fade show';
    } else {
        successMessage.className = 'alert alert-success alert-dismissible fade show';
    }
    
    successText.textContent = message;
    successMessage.style.display = 'block';
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        successMessage.style.display = 'none';
    }, 5000);
}

// Initialize modals
document.addEventListener('DOMContentLoaded', function() {
    const productModal = document.getElementById('deleteProductModal');
    const imageModal = document.getElementById('deleteImageModal');
    
    if (productModal) {
        productModal.addEventListener('hidden.bs.modal', function () {
            document.getElementById('deleteProductForm').action = '';
        });
    }
    
    if (imageModal) {
        imageModal.addEventListener('hidden.bs.modal', function () {
            document.getElementById('confirmImageDelete').onclick = null;
        });
    }
});
</script>

<style>
.existing-image-group, .additional-image-group {
    padding: 20px;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    background: #fff;
    transition: all 0.3s ease;
}

.existing-image-group:hover, .additional-image-group:hover {
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

.caption-field label {
    font-size: 1.1rem;
    margin-bottom: 0.75rem;
    display: block;
}

.caption-field label i {
    margin-right: 0.5rem;
    font-size: 1.2rem;
}

.remove-image {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}

.delete-image {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}

.form-text {
    font-size: 0.85rem;
    color: #6c757d;
}

/* Image thumbnail styling */
.img-thumbnail {
    border: 2px solid #dee2e6;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.img-thumbnail:hover {
    border-color: #28a745;
    transform: scale(1.05);
}
</style>
@endsection