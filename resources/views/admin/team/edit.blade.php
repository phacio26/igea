@extends('layouts.admin')

@section('title', 'Edit Team Member')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Team Member: {{ $member->name }}</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.team.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Back to Team
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

                <form action="{{ route('admin.team.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $member->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="position" class="form-label fw-semibold">Position *</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror" 
                                       id="position" name="position" value="{{ old('position', $member->position) }}" required>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description', $member->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Current Image</h6>
                                </div>
                                <div class="card-body text-center">
                                    @if($member->image_path)
                                        <img src="{{ $member->image_url }}" 
                                             alt="{{ $member->name }}" 
                                             class="img-thumbnail mb-2" 
                                             style="max-width: 200px; height: auto;"
                                             onerror="this.onerror=null; this.src='{{ asset('images/default-avatar.png') }}';">
                                        <p class="small text-muted mb-0">Current Profile Image</p>
                                    @else
                                        <div class="text-muted py-3">
                                            <i class="bi bi-person display-6"></i>
                                            <p class="mb-0">No image uploaded</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Upload New Image</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="image" class="form-label fw-semibold">Profile Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                               id="image" name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text small">
                                            Max: 2MB • JPG, PNG, GIF<br>
                                            Leave empty to keep current image
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="order" class="form-label fw-semibold">Display Order</label>
                                        <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                               id="order" name="order" value="{{ old('order', $member->order) }}" min="0">
                                        @error('order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text small">Lower numbers appear first</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Status Settings</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" 
                                       id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $member->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">
                                    Active Team Member
                                </label>
                                <!-- Hidden input to ensure false value is sent when unchecked -->
                                <input type="hidden" name="is_active" value="0">
                            </div>
                            <div class="form-text small">
                                When active, this team member will be visible on the website.
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center py-3">
                                    <button type="submit" class="btn btn-success px-5 me-3">
                                        <i class="bi bi-check-circle me-2"></i> Update Team Member
                                    </button>
                                    <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary px-4">
                                        <i class="bi bi-x-circle me-2"></i> Cancel
                                    </a>
                                    <button type="button" class="btn btn-outline-danger px-4 ms-2" 
                                            onclick="confirmTeamDelete('{{ $member->name }}', '{{ route('admin.team.delete', $member->id) }}')">
                                        <i class="bi bi-trash me-2"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
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
                    <i class="bi bi-person display-4 text-danger"></i>
                </div>
                <h6 class="fw-semibold mb-3">You are about to delete a team member</h6>
                <p class="mb-2">This action will permanently remove:</p>
                <p class="fw-bold text-dark mb-3" id="itemName"></p>
                <div class="alert alert-warning small mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    This action cannot be undone. The team member will be permanently removed from the website.
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

.form-check-input:checked {
    background-color: #198754;
    border-color: #198754;
}
</style>

<script>
function confirmTeamDelete(memberName, deleteUrl) {
    // Set the modal content
    document.getElementById('itemName').textContent = memberName;
    
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

    // Handle checkbox and hidden field interaction
    const checkbox = document.getElementById('is_active');
    const hiddenField = document.querySelector('input[name="is_active"][type="hidden"]');
    
    if (checkbox && hiddenField) {
        checkbox.addEventListener('change', function() {
            // When checkbox is checked, disable the hidden field
            // When unchecked, enable the hidden field (which has value 0)
            hiddenField.disabled = this.checked;
        });
        
        // Initialize the state on page load
        hiddenField.disabled = checkbox.checked;
    }

    // Image preview for new upload
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewContainer = document.querySelector('.card-body.text-center');
                    if (previewContainer) {
                        previewContainer.innerHTML = `
                            <img src="${e.target.result}" 
                                 alt="Preview" 
                                 class="img-thumbnail mb-2"
                                 style="max-width: 200px; height: auto;">
                            <p class="small text-muted mb-0">New Image Preview</p>
                        `;
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endsection