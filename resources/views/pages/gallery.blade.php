@extends('layouts.app')

@section('title', 'Gallery - Inclusive Green Energy Africa')

@section('content')
<main>
    <!-- Hero Section -->
    <section class="gallery-hero-section">
        <div class="container hero-content">
            <h1 data-aos="fade-down">Our Gallery</h1>
            <p data-aos="fade-up" data-aos-delay="200">
                Explore our sustainable energy projects and initiatives across Africa.
            </p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-5 page-bg">
        <div class="container">
            @if($galleryItems->count() > 0)
                <div class="row justify-content-center">
                    @foreach($galleryItems as $item)
                        <div class="col-xl-4 col-lg-4 col-md-6 mb-5" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="gallery-card text-center h-100">
                                <div class="gallery-image-container">
                                    <img src="{{ $item->image_url }}" 
                                         alt="{{ $item->title }}" 
                                         class="gallery-img img-fluid"
                                         onerror="this.onerror=null; this.src='{{ asset('images/default-image.png') }}';">
                                </div>
                                <div class="gallery-content p-3">
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
                <div class="text-center py-5" data-aos="fade-up">
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
    <section class="contact-section py-5" id="contact-us" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center">Contact Us</h2>
            <div class="contact-info-details col-lg-8 mx-auto text-center">
                <p>Get in touch with our team:</p>
                <div class="contact-links">
                    <p><i class="bi bi-telephone"></i> <strong>Phone:</strong> <a href="tel:+265988415852">+265 (0) 988 415 852</a></p>
                    <p><i class="bi bi-envelope"></i> <strong>Email:</strong> <a href="mailto:inclusivegreenenergyafrica@gmail.com">inclusivegreenenergyafrica@gmail.com</a></p>
                    <p><i class="bi bi-geo-alt"></i> <strong>Address:</strong> Lilongwe, Malawi</p>
                </div>
                <h3 class="mt-4 h5 fw-semibold">Office Hours</h3>
                <p>Monday to Friday: 8:00 am - 5:00 pm</p>
                <p>Saturday: 9:00 am - 12:00 noon</p>
                <p>Closed on Sundays</p>

                <div class="social-icons mt-4">
                    <h4 class="h5 fw-semibold mb-3">Follow us online</h4>
                    <div class="d-flex justify-content-center gap-4">
                        <a href="https://www.facebook.com/profile.php?id=100085898573695" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-facebook fs-2"></i>
                        </a>
                        <a href="https://www.linkedin.com/company/inclusive-green-energy-africa/" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-linkedin fs-2"></i>
                        </a>
                        <a href="https://www.instagram.com/igea23?igsh=bG5jNmJoZ3h2cWhl" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-instagram fs-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
/* ===== GENERAL ===== */
body {
    scroll-behavior: smooth;
    font-family: 'Poppins', sans-serif;
}

.page-bg {
    background: linear-gradient(to bottom right, #f5fdf8, #e9f8ee);
}

/* ===== HERO SECTION ===== */
.gallery-hero-section {
    position: relative;
    padding: 100px 0;
    background: url('{{ asset("images/MANGANI/gallery-background.jpg") }}') center/cover no-repeat;
    color: white;
    text-align: center;
    overflow: hidden;
    border-radius: 0 0 20px 20px;
}
.gallery-hero-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 100, 0, 0.6);
    z-index: 1;
    backdrop-filter: blur(3px);
}
.hero-content {
    position: relative;
    z-index: 2;
}
.hero-content h1 {
    font-size: 3rem;
    font-weight: 800;
    text-transform: uppercase;
}
.hero-content p {
    font-size: 1.2rem;
    max-width: 600px;
    margin: 15px auto 0;
    opacity: 0.95;
}

/* ===== GALLERY CARD ===== */
.gallery-card {
    border-radius: 15px;
    border: 1px solid #e9ecef;
    background: #fff;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}
.gallery-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(0, 128, 0, 0.15);
}
.gallery-image-container {
    overflow: hidden;
    border-bottom: 2px solid #e9ecef;
}
.gallery-img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.gallery-card:hover .gallery-img {
    transform: scale(1.08);
}
.gallery-title {
    color: #198754;
    font-weight: 700;
}

/* ===== CONTACT SECTION ===== */
.contact-section {
    background: linear-gradient(to right, #f0fff4, #e8f5e9);
    border-top: 2px solid #28a745;
}
.contact-section a {
    color: #28a745;
    font-weight: 500;
    text-decoration: none;
}
.contact-section a:hover {
    text-decoration: underline;
}
.social-icons a {
    color: #28a745;
    transition: transform 0.3s, color 0.3s;
}
.social-icons a:hover {
    transform: scale(1.2);
    color: #218838;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .hero-content h1 { font-size: 2.2rem; }
    .gallery-img { height: 220px; }
}
</style>
@endsection

@section('scripts')
<!-- Include AOS (Animate On Scroll) -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

<script>
    document.addEventListener('DOMContentLoaded', function () {
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
        });
    });
</script>
@endsection
