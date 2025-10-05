@extends('layouts.admin')

@section('title', 'Manage Products - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Manage Products</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Add New Product
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

<div class="card">
    <div class="card-body">
        @if($products && $products->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Images</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                <div class="product-admin-thumb">
                                    @php
                                        $mainImage = $product->images->first();
                                        $imageSrc = ($mainImage && !empty($mainImage->image_path))
                                            ? asset('storage/products/' . basename($mainImage->image_path))
                                            : asset('images/default-product.png');
                                    @endphp
                                    
                                    <img src="{{ $imageSrc }}" 
                                         alt="{{ $product->name }}" 
                                         class="admin-product-img"
                                         loading="lazy"
                                         onerror="this.src='{{ asset('images/default-product.png') }}'; this.onerror=null;">
                                </div>
                            </td>
                            <td>
                                <strong>{{ $product->name }}</strong>
                                @if(!$product->is_active)
                                    <br><small class="text-muted">(Inactive)</small>
                                @endif
                            </td>
                            <td>{{ Str::limit(strip_tags($product->description ?? ''), 100) }}</td>
                            <td>
                                <span class="badge bg-info">{{ $product->images->count() }} images</span>
                            </td>
                            <td>{{ $product->order ?? 0 }}</td>
                            <td>
                                <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                                       class="btn btn-outline-primary btn-sm"
                                       title="Edit Product">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.products.toggle-status', $product->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn btn-outline-warning btn-sm"
                                                title="{{ $product->is_active ? 'Deactivate' : 'Activate' }}">
                                            <i class="bi bi-power"></i>
                                        </button>
                                    </form>
                                    <button type="button"
                                            class="btn btn-outline-danger btn-sm"
                                            title="Delete Product"
                                            onclick="confirmProductDelete('{{ addslashes($product->name) }}', '{{ route('admin.products.delete', $product->id) }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-box display-4 text-muted"></i>
                <h4 class="text-muted mt-3">No products found</h4>
                <p class="text-muted">Get started by adding your first product.</p>
                <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Add First Product
                </a>
            </div>
        @endif
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
                    <i class="bi bi-box display-4 text-danger"></i>
                </div>
                <h6 class="fw-semibold mb-3">You are about to delete a product</h6>
                <p class="mb-2">This action will permanently remove:</p>
                <p class="fw-bold text-dark mb-3" id="itemName"></p>
                <div class="alert alert-warning small mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    This action cannot be undone. The product and all its associated images will be permanently removed.
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
.product-admin-thumb {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.admin-product-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.btn-group .btn {
    margin-right: 5px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

/* Table improvements */
.table th {
    border-top: none;
    font-weight: 600;
    color: #495057;
    background-color: #f8f9fa;
}

.table td {
    vertical-align: middle;
}

/* Badge improvements */
.badge {
    font-size: 0.75rem;
    font-weight: 500;
}
</style>

<script>
function confirmProductDelete(productName, deleteUrl) {
    document.getElementById('itemName').textContent = productName;
    document.getElementById('deleteForm').action = deleteUrl;
    const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    modal.show();
}

document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = document.getElementById('deleteConfirmationModal');
    if (deleteModal) {
        deleteModal.addEventListener('hidden.bs.modal', function () {
            document.getElementById('deleteForm').action = '';
        });
    }

    // Handle image loading errors
    const images = document.querySelectorAll('.admin-product-img');
    images.forEach(img => {
        img.onerror = function() {
            this.src = '{{ asset('images/default-product.png') }}';
            this.onerror = null; 
        };
    });
});
</script>
@endsection
