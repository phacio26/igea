@extends('layouts.app')

@section('title', 'Gallery - Inclusive Green Energy Africa')

@section('content')
@php
use Illuminate\Support\Facades\Storage;
@endphp

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-success">Our Gallery</h1>
            <p class="lead">See our work in action across communities in Africa</p>
        </div>

        @if($gallery->count() > 0)
            <div class="row">
                @foreach($gallery as $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            @if($item->image_path && Storage::disk('public')->exists($item->image_path))
                                <img src="{{ asset('storage/' . $item->image_path) }}" 
                                     class="card-img-top" 
                                     alt="{{ $item->title }}"
                                     style="width: 100%; height: auto; max-height: 250px; object-fit: contain;">
                            @else
                                <img src="{{ asset('images/placeholder-gallery.jpg') }}" 
                                     class="card-img-top" 
                                     alt="{{ $item->title }}"
                                     style="width: 100%; height: auto; max-height: 250px; object-fit: contain;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                @if($item->description)
                                    <p class="card-text">{{ $item->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-images display-1 text-muted"></i>
                <h3 class="text-muted mt-3">Gallery Coming Soon</h3>
                <p class="text-muted">We're currently updating our gallery with new images.</p>
            </div>
        @endif
    </div>
</section>
@endsection