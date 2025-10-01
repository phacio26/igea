@extends('layouts.admin')

@section('title', 'Manage Pages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Pages</h2>
</div>

<div class="card">
    <div class="card-body">
        @if($pages->count() > 0)
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
                        @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->title }}</td>
                                <td><code>{{ $page->slug }}</code></td>
                                <td>
                                    <span class="badge bg-{{ $page->is_active ? 'success' : 'secondary' }}">
                                        {{ $page->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ $page->updated_at->format('M j, Y g:i A') }}</td>
                                <td>
                                    <a href="{{ route('admin.pages.edit', $page->slug) }}" 
                                       class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
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
    <div class="alert alert-info">
        <h6><i class="bi bi-info-circle me-2"></i>About Pages</h6>
        <p class="mb-0">Pages contain the main content of your website. You can edit the content of each page using the edit button.</p>
    </div>
</div>
@endsection