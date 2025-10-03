@extends('layouts.app')

@section('title', 'Gallery - Inclusive Green Energy Africa')

@section('content')
<!-- Hero Section -->
<section class="gallery-hero-section">
    <div class="container hero-content">
        <h1>Our Gallery</h1>
        <p>See our sustainable energy projects and solutions in action across Africa.</p>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-5">
    <div class="container">
        @if($gallery->count() > 0)
            <div class="row justify-content-center">
                @foreach($gallery as $item)
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-5">
                        <div class="gallery-card text-center h-100">
                            <!-- Responsive Image Section -->
                            <div class="gallery-image-container">
                                <img src="{{ $item->image_url }}" 
                                     alt="{{ $item->title }}" 
                                     class="gallery-img img-fluid"
                                     onerror="this.onerror=null; this.src='{{ asset('images/default-image.png') }}';">
                            </div>
                            
                            <div class="gallery-content">
                                <h4 class="gallery-title h5 mb-2">{{ $item->title }}</h4>
                                
                                @if($item->description)
                                    <p class="gallery-description text-muted mb-0">{{ $item->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-images display-1 text-muted mb-4"></i>
                    <h3 class="text-muted mb-3">No Gallery Images Available</h3>
                    <p class="text-muted mb-4">Our gallery is currently being updated with new projects and installations.</p>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Contact Us Section -->
<section class="contact-section py-5">
    <div class="container">
        <h2 class="text-center section-heading">Contact Us</h2>
        <div class="contact-info-details col-lg-8 mx-auto">
            <p class="text-center">Get in touch with our team:</p>
            <div class="text-center">
                <p><i class="bi bi-telephone"></i> <strong>Phone:</strong> <a href="tel:+265988415852">+265 (0) 988 415 852</a></p>
                <p><i class="bi bi-envelope"></i> <strong>Email:</strong> <a href="mailto:inclusivegreenenergyafrica@gmail.com">inclusivegreenenergyafrica@gmail.com</a></p>
                <p><i class="bi bi-geo-alt"></i> <strong>Address:</strong> Lilongwe, Malawi</p>
            </div>
            <h3 class="mt-4 h5 fw-semibold text-center">Office Hours</h3>
            <p class="text-center">Monday to Friday: 8:00 am - 5:00 pm</p>
            <p class="text-center">Saturday: 9:00 am - 12:00 noon</p>
            <p class="text-center">Closed on Sundays</p>
            <!-- Follow Us Online Section -->
            <div class="social-icons text-center">
                <h4 class="h5 fw-semibold mb-3">Follow us online</h4>
                <div class="d-flex justify-content-center gap-3">
                    <a href="https://www.facebook.com/profile.php?id=100085898573695" target="_blank" rel="noopener noreferrer" class="text-decoration-none" aria-label="Facebook">
                        <i class="bi bi-facebook fs-3"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/inclusive-green-energy-africa/" target="_blank" rel="noopener noreferrer" class="text-decoration-none" aria-label="LinkedIn">
                        <i class="bi bi-linkedin fs-3"></i>
                    </a>
                    <a href="https://www.instagram.com/igea23?igsh=bG5jNmJoZ3h2cWhl" target="_blank" rel="noopener noreferrer" class="text-decoration-none" aria-label="Instagram">
                        <i class="bi bi-instagram fs-3"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Gallery Hero Section */
.gallery-hero-section {
    position: relative;
    padding: 80px 0;
    margin-bottom: 50px;
    background: url('{{ asset("images/MANGANI/gallery-background.jpg") }}') no-repeat center center;
    background-size: cover;
    color: white;
    text-align: center;
    border-radius: 0 0 15px 15px;
    overflow: hidden;
}

.gallery-hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(40, 167, 69, 0.7);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-content h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}

.hero-content p {
    font-size: 1.2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    opacity: 0.9;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

.gallery-card {
    padding: 0 0 2rem 0;
    border-radius: 15px;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
    background: white;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    margin: 0 5px;
}

.gallery-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border-color: #198754;
}

.gallery-image-container {
    width: 100%;
    height: 280px;
    overflow: hidden;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    padding: 0;
}

.gallery-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-card:hover .gallery-img {
    transform: scale(1.08);
}

.gallery-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 0 1.5rem;
}

.gallery-title {
    color: #2c3e50;
    font-weight: 600;
    font-size: 1.25rem;
    line-height: 1.3;
    margin-bottom: 0.5rem;
}

.gallery-description {
    line-height: 1.6;
    font-size: 0.95rem;
    color: #6c757d;
}

.empty-state {
    max-width: 500px;
    margin: 0 auto;
}

/* Contact Us Section Styling */
.contact-section {
    background-color: #e9ecef;
    text-align: center;
}

.contact-section h2.section-heading {
    color: #28a745;
    margin-bottom: 40px;
    font-weight: 600;
}

.contact-section p {
    margin-bottom: 15px;
    color: #555;
    line-height: 1.7;
    font-size: 1.1rem;
}

.contact-section i {
    color: #28a745;
    margin-right: 10px;
    width: 20px;
    text-align: center;
    vertical-align: middle;
}

.contact-section .contact-info-details a {
    color: #28a745;
    text-decoration: none;
    transition: color 0.3s ease;
    font-weight: 500;
}

.contact-section .contact-info-details a:hover {
    color: #218838;
    text-decoration: underline;
}

.contact-section .social-icons {
    margin-top: 25px;
}

.contact-section .social-icons a {
    color: #28a745;
    transition: color 0.3s ease, transform 0.3s ease;
    display: inline-block;
}

.contact-section .social-icons a:hover {
    color: #218838;
    transform: scale(1.15);
}

/* Mobile-first responsive design */
@media (max-width: 576px) {
    .gallery-hero-section {
        padding: 60px 0;
    }
    
    .hero-content h1 {
        font-size: 2rem;
    }
    
    .hero-content p {
        font-size: 1rem;
    }
    
    .gallery-image-container {
        height: 250px;
        margin-bottom: 1rem;
    }
    
    .gallery-img {
        object-fit: contain;
        width: auto;
        max-width: 100%;
        max-height: 100%;
    }
    
    .gallery-card {
        margin: 0 15px 2rem 15px;
        padding: 0 0 1.5rem 0;
    }
    
    .gallery-content {
        padding: 0 1rem;
    }
    
    .gallery-title {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
    }
    
    .gallery-description {
        font-size: 1rem;
        line-height: 1.5;
    }
    
    .row.justify-content-center {
        margin: 0 -5px;
    }

    /* Contact section mobile adjustments */
    .contact-section {
        padding: 40px 15px;
    }
    
    .contact-section h2.section-heading {
        font-size: 1.8rem;
        margin-bottom: 30px;
    }
    
    .contact-section p {
        font-size: 1rem;
    }
    
    .contact-section .social-icons a {
        margin: 0 8px;
    }
}

@media (min-width: 577px) and (max-width: 768px) {
    .gallery-hero-section {
        padding: 70px 0;
    }
    
    .hero-content h1 {
        font-size: 2.5rem;
    }
    
    .hero-content p {
        font-size: 1.1rem;
    }
    
    .gallery-image-container {
        height: 240px;
    }
    
    .gallery-img {
        object-fit: cover;
    }
    
    .gallery-card {
        margin: 0 8px 2rem 8px;
    }

    .contact-section {
        padding: 50px 20px;
    }
}

@media (min-width: 769px) and (max-width: 992px) {
    .gallery-hero-section {
        padding: 80px 0;
    }
    
    .gallery-image-container {
        height: 260px;
    }
    
    .gallery-card {
        margin: 0 5px 2rem 5px;
    }
}

@media (min-width: 993px) and (max-width: 1200px) {
    .gallery-image-container {
        height: 280px;
    }
}

@media (min-width: 1201px) {
    .gallery-image-container {
        height: 300px;
    }
    
    .gallery-card {
        margin: 0 2px 2rem 2px;
    }
}

/* Extra small devices adjustments */
@media (max-width: 575.98px) {
    .gallery-hero-section {
        padding: 50px 0;
        border-radius: 0;
    }
    
    .hero-content h1 {
        font-size: 1.8rem;
    }
    
    .gallery-image-container {
        height: 220px;
    }
    
    .gallery-card .gallery-title {
        font-size: 1.1rem;
    }
    
    .contact-section p {
        font-size: 0.95rem;
    }
}
</style>
@endsection