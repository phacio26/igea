@extends('layouts.admin')

@section('title', 'Edit Page - ' . $page->title)

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Home Page</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Back to Pages
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Please fix the following errors:
                            <ul class="mb-0 mt-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.pages.update', $page->slug) }}" method="POST" enctype="multipart/form-data" id="page-form">
                        @csrf
                        @method('PUT')

                        <!-- Hidden field to track deleted images for form submission -->
                        <input type="hidden" name="deleted_images" id="deleted-images" value="">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Hero Section Background Images</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Upload Background Images</label>
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
                                                <div class="image-upload-item mb-3 p-3 border rounded" data-image="{{ $image }}" id="image-item-{{ $index }}">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4">
                                                            @if(file_exists(public_path($image)))
                                                                <img src="{{ asset($image) }}" class="img-thumbnail existing-image" style="height: 100px; object-fit: cover;">
                                                            @else
                                                                <div class="text-muted text-center py-4 border">
                                                                    <i class="bi bi-image fs-1"></i>
                                                                    <p class="small mb-0">No image</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="file" class="form-control image-upload" name="hero_images[]" accept="image/*">
                                                            <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                                            <div class="form-text small">
                                                                Max: 5MB, Recommended: 1920x1080px
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-outline-danger remove-image" 
                                                                    onclick="confirmImageDelete('{{ $image }}', {{ $index }})" 
                                                                    {{ count($heroImages) <= 1 ? 'disabled' : '' }}>
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-image">
                                                <i class="bi bi-plus"></i> Add Another Image
                                            </button>
                                            <div class="form-text">
                                                Upload 4 images for the slideshow. Leave empty to keep existing images.
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

<!-- Single Delete Confirmation Modal for Images -->
<div class="modal fade" id="imageDeleteConfirmationModal" tabindex="-1" aria-labelledby="imageDeleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="imageDeleteConfirmationModalLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Confirm Image Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="bi bi-image display-4 text-danger"></i>
                </div>
                <h6 class="fw-semibold mb-3">You are about to delete a background image</h6>
                <p class="mb-2">This action will permanently remove the image:</p>
                <p class="fw-bold text-dark mb-3" id="imageName"></p>
                <div class="alert alert-warning small mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    This action cannot be undone. The image will be permanently removed from the home page.
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal" id="cancelDeleteBtn">
                    <i class="bi bi-x-circle me-2"></i>Cancel
                </button>
                <button type="button" class="btn btn-danger px-4" id="confirmImageDelete">
                    <i class="bi bi-trash me-2"></i>Confirm Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentImageToDelete = null;
let currentImageIndex = null;
let isDeleting = false; // Prevent multiple simultaneous deletions

function confirmImageDelete(imagePath, index) {
    if (isDeleting) return; // Prevent multiple clicks
    
    currentImageToDelete = imagePath;
    currentImageIndex = index;
    
    // Extract filename for display
    const fileName = imagePath.split('/').pop();
    document.getElementById('imageName').textContent = fileName;
    
    // Reset button states
    document.getElementById('confirmImageDelete').disabled = false;
    document.getElementById('confirmImageDelete').innerHTML = '<i class="bi bi-trash me-2"></i>Confirm Delete';
    document.getElementById('cancelDeleteBtn').disabled = false;
    
    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('imageDeleteConfirmationModal'));
    modal.show();
}

// Handle image deletion confirmation
document.getElementById('confirmImageDelete').addEventListener('click', function() {
    if (isDeleting || !currentImageToDelete || currentImageIndex === null) return;
    
    isDeleting = true;
    const confirmBtn = document.getElementById('confirmImageDelete');
    const cancelBtn = document.getElementById('cancelDeleteBtn');
    
    // Disable buttons during deletion
    confirmBtn.disabled = true;
    cancelBtn.disabled = true;
    confirmBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-2"></i>Deleting...';

    // Send AJAX request to delete the image immediately
    fetch('{{ route("admin.pages.delete-image", $page->slug) }}', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            image_path: currentImageToDelete
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the image item from the DOM immediately
            const imageItem = document.getElementById(`image-item-${currentImageIndex}`);
            if (imageItem) {
                imageItem.remove();
                
                // Add to deleted images for form submission
                addToDeletedImages(currentImageToDelete);
                
                // Update remove buttons state
                updateRemoveButtonsState();
                
                // Show success message
                showSuccessMessage('Image deleted successfully!');
                
                // Hide the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('imageDeleteConfirmationModal'));
                modal.hide();
            } else {
                showErrorMessage('Image element not found');
            }
        } else {
            showErrorMessage(data.message || 'Failed to delete image');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showErrorMessage('An error occurred while deleting the image');
    })
    .finally(() => {
        isDeleting = false;
        // Reset button states
        confirmBtn.disabled = false;
        cancelBtn.disabled = false;
        confirmBtn.innerHTML = '<i class="bi bi-trash me-2"></i>Confirm Delete';
    });
});

function addToDeletedImages(imagePath) {
    const deletedImagesInput = document.getElementById('deleted-images');
    let deletedImages = [];
    
    try {
        deletedImages = JSON.parse(deletedImagesInput.value || '[]');
    } catch (e) {
        deletedImages = [];
    }
    
    if (!deletedImages.includes(imagePath)) {
        deletedImages.push(imagePath);
        deletedImagesInput.value = JSON.stringify(deletedImages);
    }
}

function updateRemoveButtonsState() {
    const imageItems = document.querySelectorAll('.image-upload-item');
    const removeButtons = document.querySelectorAll('.remove-image');
    
    if (imageItems.length <= 1) {
        removeButtons.forEach(btn => {
            btn.disabled = true;
        });
    } else {
        removeButtons.forEach(btn => {
            btn.disabled = false;
        });
    }
}

function showSuccessMessage(message) {
    // Remove any existing alerts
    const existingAlerts = document.querySelectorAll('.alert-dismissible:not(.alert-danger)');
    existingAlerts.forEach(alert => alert.remove());

    // Create and show a success message
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-success alert-dismissible fade show';
    alertDiv.innerHTML = `
        <i class="bi bi-check-circle me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    const cardBody = document.querySelector('.card-body');
    cardBody.insertBefore(alertDiv, cardBody.firstChild);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}

function showErrorMessage(message) {
    // Remove any existing alerts
    const existingAlerts = document.querySelectorAll('.alert-dismissible:not(.alert-success)');
    existingAlerts.forEach(alert => alert.remove());

    // Create and show an error message
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-danger alert-dismissible fade show';
    alertDiv.innerHTML = `
        <i class="bi bi-exclamation-triangle me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    const cardBody = document.querySelector('.card-body');
    cardBody.insertBefore(alertDiv, cardBody.firstChild);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}

// Add image field
document.getElementById('add-image').addEventListener('click', function() {
    const container = document.getElementById('hero-images-container');
    const imageItems = container.querySelectorAll('.image-upload-item');
    const newIndex = imageItems.length;
    
    const newInput = document.createElement('div');
    newInput.className = 'image-upload-item mb-3 p-3 border rounded';
    newInput.id = `image-item-${newIndex}`;
    newInput.innerHTML = `
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="text-muted text-center py-4 border">
                    <i class="bi bi-image fs-1"></i>
                    <p class="small mb-0">No image selected</p>
                </div>
            </div>
            <div class="col-md-6">
                <input type="file" class="form-control image-upload" name="hero_images[]" accept="image/*">
                <input type="hidden" name="existing_images[]" value="">
                <div class="form-text small">
                    Max: 5MB, Recommended: 1920x1080px
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-outline-danger remove-image" onclick="removeNewImage(${newIndex})">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(newInput);
    
    // Update remove buttons state
    updateRemoveButtonsState();
});

// Remove newly added image (without AJAX)
function removeNewImage(index) {
    const imageItem = document.getElementById(`image-item-${index}`);
    if (imageItem) {
        const container = document.getElementById('hero-images-container');
        const imageItems = container.querySelectorAll('.image-upload-item');
        
        if (imageItems.length > 1) {
            imageItem.remove();
            updateRemoveButtonsState();
            showSuccessMessage('Image removed successfully!');
        }
    }
}

// Preview image when selected
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('image-upload')) {
        const file = e.target.files[0];
        const item = e.target.closest('.image-upload-item');
        const previewContainer = item.querySelector('.col-md-4');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewContainer.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="height: 100px; object-fit: cover;">`;
            };
            reader.readAsDataURL(file);
        }
    }
});

// Reset modal when hidden
document.getElementById('imageDeleteConfirmationModal').addEventListener('hidden.bs.modal', function () {
    currentImageToDelete = null;
    currentImageIndex = null;
    isDeleting = false;
    
    // Reset button states
    document.getElementById('confirmImageDelete').disabled = false;
    document.getElementById('confirmImageDelete').innerHTML = '<i class="bi bi-trash me-2"></i>Confirm Delete';
    document.getElementById('cancelDeleteBtn').disabled = false;
});

// Initialize remove buttons state on page load
document.addEventListener('DOMContentLoaded', function() {
    updateRemoveButtonsState();
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

.image-upload-item {
    background-color: #f8f9fa;
    transition: all 0.3s ease;
}

.image-upload-item:hover {
    background-color: #e9ecef;
}

.spinner-border-sm {
    width: 1rem;
    height: 1rem;
}

.btn:disabled {
    cursor: not-allowed;
    opacity: 0.6;
}
</style>
@endsection