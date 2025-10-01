@extends('layouts.app')

@section('title', 'Our Team - Inclusive Green Energy Africa')

@section('content')
@php
use Illuminate\Support\Facades\Storage;
@endphp

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-success">Our Team</h1>
            <p class="lead">Meet the dedicated professionals driving sustainable energy solutions across Africa</p>
        </div>

        @if($teamMembers->count() > 0)
            <div class="row">
                @foreach($teamMembers as $member)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card team-card h-100 border-0 shadow-sm">
                            @if($member->image_path && Storage::disk('public')->exists($member->image_path))
                                <img src="{{ asset('storage/' . $member->image_path) }}" 
                                     class="card-img-top" 
                                     alt="{{ $member->name }}">
                            @else
                                <img src="{{ asset('images/placeholder-team.jpg') }}" 
                                     class="card-img-top" 
                                     alt="{{ $member->name }}">
                            @endif
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">{{ $member->name }}</h5>
                                <h6 class="card-subtitle mb-3 text-success">{{ $member->position }}</h6>
                                <p class="card-text">{{ $member->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-people display-1 text-muted"></i>
                <h3 class="text-muted mt-3">Team Information Coming Soon</h3>
                <p class="text-muted">We're currently updating our team information.</p>
            </div>
        @endif
    </div>
</section>
@endsection