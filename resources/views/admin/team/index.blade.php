@extends('layouts.admin')

@section('title', 'Manage Team Members')

@section('content')
@php
use Illuminate\Support\Facades\Storage;
@endphp

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Team Members</h2>
    <a href="{{ route('admin.team.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Add New Team Member
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

@if($teamMembers->count() > 0)
    <div class="row">
        @foreach($teamMembers as $member)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($member->image)
                        <div class="team-image-container" style="height: 250px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            @if(file_exists(public_path($member->image)))
                                <img src="{{ asset($member->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $member->name }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            @elseif(Storage::disk('public')->exists($member->image))
                                <img src="{{ Storage::disk('public')->url($member->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $member->name }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                    <i class="bi bi-person text-muted fs-1"></i>
                                </div>
                                <small class="text-center text-muted p-2">Image not found</small>
                            @endif
                        </div>
                    @else
                        <div class="team-image-container" style="height: 250px; display: flex; align-items: center; justify-content: center;">
                            <div class="bg-light d-flex align-items-center justify-content-center h-100 w-100">
                                <i class="bi bi-person text-muted fs-1"></i>
                            </div>
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $member->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $member->position }}</h6>
                        @if($member->description)
                            <p class="card-text">{{ Str::limit($member->description, 100) }}</p>
                        @endif
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <small class="text-muted d-block">Order: {{ $member->order }}</small>
                                @if($member->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('admin.team.edit', $member->id) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.team.delete', $member->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this team member?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Debug info (remove in production) -->
                        @if($member->image)
                            <div class="mt-2">
                                <small class="text-muted">
                                    Image: {{ $member->image }}<br>
                                    Exists: {{ file_exists(public_path($member->image)) ? 'YES' : 'NO' }}
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-5">
        <i class="bi bi-people display-1 text-muted"></i>
        <h3 class="text-muted mt-3">No Team Members</h3>
        <p class="text-muted">Get started by adding your first team member.</p>
        <a href="{{ route('admin.team.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add First Team Member
        </a>
    </div>
@endif
@endsection