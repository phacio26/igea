@extends('layouts.admin')

@section('title', 'Manage Pages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Pages</h2>
</div>

<div class="card">
    <div class="card-body">
        @php
            // Filter out About Us and Contact Us pages
            $filteredPages = $pages->filter(function($page) {
                return !in_array($page->slug, ['about', 'contact']);
            });
        @endphp

        @if($filteredPages->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($filteredPages as $page)
                            <tr>
                                <td>{{ $page->title }}</td>
                                <td><code>{{ $page->slug }}</code></td>
                                <td>
                                    <span class="badge bg-{{ $page->is_active ? 'success' : 'secondary' }}">
                                        {{ $page->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        // Convert to Malawian time (CAT - Central Africa Time, UTC+2)
                                        $malawianTime = $page->updated_at->setTimezone('Africa/Blantyre');
                                        echo $malawianTime->format('M j, Y g:i A');
                                    @endphp
                                    <br>
                                  
                                </td>
                                <td>
                                    @switch($page->slug)
                                        @case('gallery')
                                            <a href="{{ route('admin.gallery.index') }}" 
                                               class="btn btn-sm btn-primary">
                                                <i class="bi bi-images me-1"></i> Manage Gallery
                                            </a>
                                            @break

                                        @case('team')
                                            <a href="{{ route('admin.team.index') }}" 
                                               class="btn btn-sm btn-primary">
                                                <i class="bi bi-people me-1"></i> Manage Team
                                            </a>
                                            @break

                                        @case('products')
                                            <a href="{{ route('admin.products.index') }}" 
                                               class="btn btn-sm btn-primary">
                                                <i class="bi bi-box-seam me-1"></i> Manage Products
                                            </a>
                                            @break

                                        @default
                                            {{-- Home page goes to regular page editor --}}
                                            <a href="{{ route('admin.pages.edit', $page->slug) }}" 
                                               class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil me-1"></i> Edit Content
                                            </a>
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="bi bi-file-text display-1 text-muted"></i>
                <h4 class="text-muted mt-3">No Pages Found</h4>
                <p class="text-muted">There are no pages in the system yet.</p>
            </div>
        @endif
    </div>
</div>

<div class="mt-4">
    
</div>

<style>
.text-muted {
    font-size: 0.75rem;
}
</style>
@endsection