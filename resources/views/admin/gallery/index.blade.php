@extends('layouts.admin')

@section('title', 'Manage Gallery')

@section('content')
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

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($gallery->count() > 0)
    <div class="row">
        @foreach($gallery as $item)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card h-100 gallery-card-admin">
                    <!-- Responsive Image Section -->
                    <div class="gallery-image-container-admin">
                        <img src="{{ $item->image_url }}" 
                             alt="{{ $item->title }}" 
                             class="gallery-img-admin img-fluid"
                             onerror="this.onerror=null; this.src='{{ asset('images/default-image.png') }}';">
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title gallery-title-admin mb-2">{{ $item->title }}</h5>
                        
                        @if($item->description)
                            <p class="card-text flex-grow-1 gallery-description-admin">{{ Str::limit($item->description, 80) }}</p>
                        @endif
                        
                        <div class="gallery-meta-admin mt-auto pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted d-block">Order: {{ $item->order }}</small>
                                    @if($item->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </div>
                                <div class="btn-group">
                                    <a href="{{ route('admin.gallery.edit', $item->id) }}"
                                       class="btn btn-outline-primary btn-sm"
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                    <button type="button"
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="confirmGalleryDelete('{{ $item->title }}', '{{ route('admin.gallery.delete', $item->id) }}')"
                                            title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
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

<!-- Professional Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Confirm Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="bi bi-image display-4 text-danger"></i>
                </div>
                <h6 class="fw-semibold mb-3">You are about to delete a gallery image</h6>
                <p class="mb-2">This action will permanently remove:</p>
                <p class="fw-bold text-dark mb-3" id="itemName"></p>
                <div class="alert alert-warning small mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    This action cannot be undone. The image will be permanently removed from the gallery.
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Cancel
                </button>
                <form id="deleteForm" method="POST" class="d-inline">
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

<style>
.gallery-card-admin {
    border: 1px solid #dee2e6;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.gallery-card-admin:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: #198754;
}

.gallery-image-container-admin {
    width: 100%;
    height: 250px;
    overflow: hidden;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}

.gallery-img-admin {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-card-admin:hover .gallery-img-admin {
    transform: scale(1.08);
}

.gallery-title-admin {
    color: #2c3e50;
    font-weight: 600;
    font-size: 1.1rem;
    line-height: 1.3;
}

.gallery-description-admin {
    font-size: 0.9rem;
    line-height: 1.5;
    color: #6c757d;
    margin-bottom: 0;
}

.gallery-meta-admin {
    border-top: 1px solid #e9ecef !important;
}

.btn-group .btn {
    border-radius: 6px !important;
    margin-left: 4px;
    padding: 0.25rem 0.5rem;
}

.btn-group .btn:first-child {
    margin-left: 0;
}

/* Delete Modal Styles */
#deleteConfirmationModal .modal-content {
    border: none;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

#deleteConfirmationModal .modal-header {
    border-radius: 12px 12px 0 0;
    border-bottom: none;
    padding: 1.5rem;
}

#deleteConfirmationModal .modal-body {
    padding: 2rem;
}

#deleteConfirmationModal .modal-footer {
    padding: 1.5rem;
}

#deleteConfirmationModal .btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

#deleteConfirmationModal .btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border: none;
}

#deleteConfirmationModal .btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
}

#deleteConfirmationModal .btn-outline-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(108, 117, 125, 0.2);
}

#deleteConfirmationModal .alert {
    border-radius: 8px;
    border: 1px solid #ffeaa7;
    background-color: #fff9e6;
}

/* Mobile-first responsive design */
@media (max-width: 576px) {
    .gallery-image-container-admin {
        height: 220px;
        margin: 0 auto;
        max-width: 100%;
    }
    
    .gallery-img-admin {
        object-fit: contain;
        width: auto;
        max-width: 100%;
        max-height: 100%;
    }
    
    .gallery-card-admin {
        margin: 0 10px;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .gallery-title-admin {
        font-size: 1.2rem;
    }
    
    .btn-group {
        flex-wrap: wrap;
        gap: 4px;
    }
    
    .btn-group .btn {
        margin: 2px;
        flex: 1;
        min-width: 40px;
    }
}

@media (min-width: 577px) and (max-width: 768px) {
    .gallery-image-container-admin {
        height: 200px;
    }
    
    .gallery-img-admin {
        object-fit: cover;
    }
}

@media (min-width: 769px) and (max-width: 992px) {
    .gallery-image-container-admin {
        height: 220px;
    }
}

@media (min-width: 993px) and (max-width: 1200px) {
    .gallery-image-container-admin {
        height: 240px;
    }
}

@media (min-width: 1201px) {
    .gallery-image-container-admin {
        height: 250px;
    }
}
</style>

<script>
function confirmGalleryDelete(imageTitle, deleteUrl) {
    // Set the modal content
    document.getElementById('itemName').textContent = imageTitle;
    
    // Set the form action for the modal's form
    document.getElementById('deleteForm').action = deleteUrl;
    
    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    modal.show();
}

// Initialize modal functionality
document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = document.getElementById('deleteConfirmationModal');
    if (deleteModal) {
        // Reset form when modal is hidden
        deleteModal.addEventListener('hidden.bs.modal', function () {
            document.getElementById('deleteForm').action = '';
        });
    }
});
</script>
@endsection