@extends('layouts.app')

@section('title', 'Products & Services - Inclusive Green Energy Africa')

@section('content')
<main>
    <!-- Hero Section -->
    <section class="product-hero-section">
        <div class="container hero-content">
            <h1 data-aos="fade-down">Empowering Africa with Sustainable Energy</h1>
            <p data-aos="fade-up" data-aos-delay="200">
                Discover our innovative and affordable solar and irrigation solutions designed for homes, farms, and communities.
            </p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-5 page-bg">
        <div class="container">
            @foreach($products as $product)
            <section class="product-section mb-5" id="{{ Str::slug($product->name) }}" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="product-header p-4">
                            <h2 class="text-green mb-3">{{ $product->name }}</h2>
                            <div class="product-description">
                                <p class="mb-0">{!! nl2br(e($product->description)) !!}</p>
                            </div>

                            @if($product->features && count($product->features) > 0)
                            <div class="mt-4">
                                <h5 class="text-green mb-3">Key Features:</h5>
                                <ul class="benefits-list">
                                    @foreach($product->features as $feature)
                                        @if(trim($feature))
                                        <li>{{ $feature }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if($product->images->count() > 0)
                <div class="row">
                    @foreach($product->images as $image)
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="product-card h-100 text-center">
                            <div class="product-image-container">
                                <img src="{{ $image->image_url }}"
                                     alt="{{ $image->caption ?? $product->name }}"
                                     class="product-img img-fluid"
                                     onerror="this.onerror=null; this.src='{{ asset('images/default-image.png') }}';">
                            </div>
                            <div class="product-content p-4">
                                @if($image->title && $image->title != $product->name)
                                <h5 class="image-title mb-2">{{ $image->title }}</h5>
                                @endif

                                @if($image->description)
                                <p class="image-description text-muted mb-0">{{ $image->description }}</p>
                                @elseif($image->caption)
                                <p class="image-caption text-muted mb-0">{{ $image->caption }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </section>
            
            @if(!$loop->last)
            <div class="section-divider my-5" data-aos="fade-up">
                <div class="divider-line"></div>
            </div>
            @endif
            @endforeach

            @if($products->count() == 0)
            <div class="text-center py-5" data-aos="fade-up">
                <i class="bi bi-box display-1 text-muted"></i>
                <h3 class="text-muted mt-3">No Products Available</h3>
                <p class="text-muted">Check back soon for our latest products and services.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="contact-section py-5" id="contact-us">
        <div class="container">
            <h2 class="text-center mb-4">Contact Us</h2>
            <div class="contact-info-details col-lg-8 mx-auto text-center">
                <p class="mb-4">For inquiries about our products and services:</p>
                <div class="contact-links mb-4">
                    <p class="mb-2"><i class="bi bi-telephone"></i> <strong>Phone:</strong> <a href="tel:+265988415852">+265 (0) 988 415 852</a></p>
                    <p class="mb-2"><i class="bi bi-envelope"></i> <strong>Email:</strong> <a href="mailto:inclusivegreenenergyafrica@gmail.com">inclusivegreenenergyafrica@gmail.com</a></p>
                    <p class="mb-2"><i class="bi bi-geo-alt"></i> <strong>Address:</strong> Lilongwe, Malawi</p>
                </div>
                <h3 class="mt-4 h5 fw-semibold mb-3">Office Hours</h3>
                <p class="mb-1">Monday to Friday: 8:00 am - 5:00 pm</p>
                <p class="mb-1">Saturday: 9:00 am - 12:00 noon</p>
                <p class="mb-4">Closed on Sundays</p>

                <div class="social-icons mt-4">
                    <h4 class="h5 fw-semibold mb-3">Follow us online</h4>
                    <div class="d-flex justify-content-center gap-4">
                        <a href="https://www.facebook.com/profile.php?id=100085898573695" target="_blank"><i class="bi bi-facebook fs-2"></i></a>
                        <a href="https://www.linkedin.com/company/inclusive-green-energy-africa/" target="_blank"><i class="bi bi-linkedin fs-2"></i></a>
                        <a href="https://www.instagram.com/igea23?igsh=bG5jNmJoZ3h2cWhl" target="_blank"><i class="bi bi-instagram fs-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
/* ===== GENERAL ===== */
body {
    font-family: 'Poppins', sans-serif;
    scroll-behavior: smooth;
}
.page-bg {
    background: linear-gradient(to bottom right, #f5fdf8, #e9f8ee);
}

/* ===== HERO SECTION ===== */
.product-hero-section {
    position: relative;
    padding: 100px 0;
    background: url('{{ asset("images/MANGANI/products-background.jpg") }}') center/cover no-repeat;
    color: white;
    text-align: center;
    overflow: hidden;
    border-radius: 0 0 20px 20px;
}
.product-hero-section::before {
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
}
.hero-content p {
    font-size: 1.2rem;
    max-width: 600px;
    margin: 15px auto 0;
    opacity: 0.95;
}

/* ===== PRODUCT HEADER ===== */
.product-header {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    margin-bottom: 2rem;
}
.product-description {
    line-height: 1.7;
    font-size: 1.05rem;
    color: #495057;
}

/* ===== PRODUCT CARD ===== */
.product-card {
    border-radius: 15px;
    border: 1px solid #e9ecef;
    background: #fff;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    margin: 0.5rem;
}
.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(0, 128, 0, 0.15);
}
.product-image-container {
    overflow: hidden;
    border-bottom: 2px solid #e9ecef;
}
.product-img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.product-card:hover .product-img {
    transform: scale(1.08);
}
.product-content {
    padding: 1.5rem !important;
}
.image-title {
    color: #198754;
    font-weight: 600;
    margin-bottom: 0.75rem;
}
.image-description, .image-caption {
    color: #6c757d;
    font-size: 0.95rem;
    line-height: 1.5;
}

/* ===== SECTION DIVIDER ===== */
.section-divider {
    display: flex;
    align-items: center;
    justify-content: center;
}
.divider-line {
    width: 80%;
    height: 2px;
    background: linear-gradient(to right, transparent, #28a745, transparent);
    border-radius: 2px;
}

/* ===== FEATURES LIST ===== */
.benefits-list {
    list-style: none;
    padding-left: 0;
    margin-bottom: 0;
}
.benefits-list li {
    position: relative;
    padding-left: 30px;
    margin-bottom: 12px;
    line-height: 1.6;
    color: #495057;
}
.benefits-list li::before {
    content: "\F28A";
    font-family: 'bootstrap-icons';
    position: absolute;
    left: 0;
    color: #28a745;
    font-size: 1.1rem;
}

/* ===== CONTACT SECTION ANIMATIONS ===== */
.contact-section {
    background: linear-gradient(to right, #f0fff4, #e8f5e9);
    border-top: 2px solid #28a745;
    position: relative;
    overflow: hidden;
    transition: all 0.5s ease-out;
}

/* Initial state - hidden to the left */
.contact-section.scroll-animate {
    transform: translateX(-100%);
    opacity: 0;
}

/* Active state - visible with heartbeat effect */
.contact-section.scroll-active {
    transform: translateX(0);
    opacity: 1;
}

/* Continuous Heartbeat animation */
.contact-section.heartbeat {
    animation: heartbeat 2s ease-in-out infinite;
}

@keyframes heartbeat {
    0% {
        transform: scale(1);
    }
    5% {
        transform: scale(1.02);
    }
    10% {
        transform: scale(1);
    }
    15% {
        transform: scale(1.02);
    }
    20% {
        transform: scale(1);
    }
    100% {
        transform: scale(1);
    }
}

/* Slide in from right animation */
@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Slide in from left animation */
@keyframes slideInLeft {
    from {
        transform: translateX(-100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.contact-section a {
    color: #28a745;
    font-weight: 500;
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
    .hero-content h1 { 
        font-size: 2.2rem; 
        padding: 0 1rem;
    }
    .hero-content p {
        padding: 0 1rem;
    }
    .product-img { 
        height: 220px; 
    }
    .product-header {
        padding: 1.5rem !important;
        margin: 0 0.5rem 1.5rem 0.5rem;
    }
    .product-card {
        margin: 0.25rem;
    }
    .product-content {
        padding: 1.25rem !important;
    }
    .benefits-list li {
        padding-left: 25px;
        margin-bottom: 10px;
    }
    
    /* Adjust heartbeat animation for mobile */
    @keyframes heartbeat-mobile {
        0% {
            transform: scale(1);
        }
        5% {
            transform: scale(1.01);
        }
        10% {
            transform: scale(1);
        }
        15% {
            transform: scale(1.01);
        }
        20% {
            transform: scale(1);
        }
        100% {
            transform: scale(1);
        }
    }
    
    .contact-section.heartbeat {
        animation: heartbeat-mobile 2s ease-in-out infinite;
    }
}

@media (max-width: 576px) {
    .product-hero-section {
        padding: 80px 0;
    }
    .hero-content h1 {
        font-size: 1.8rem;
    }
    .hero-content p {
        font-size: 1rem;
    }
    .product-header {
        padding: 1.25rem !important;
    }
    .product-description {
        font-size: 1rem;
    }
}
</style>
@endsection

@section('scripts')
<!-- Include AOS (Animate On Scroll) -->
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
        duration: 1000,
        once: false,
        offset: 100,
    });

    // Refresh AOS on scroll for smooth repeated animations
    window.addEventListener('scroll', function() {
        AOS.refresh();
    });

    // Custom scroll animation for contact section
    const contactSection = document.getElementById('contact-us');
    let scrollTimeout;
    let lastScrollDirection = 'down';
    let lastScrollY = window.scrollY;
    let isHeartbeatActive = false;
    
    // Add initial animation class
    if (contactSection) {
        contactSection.classList.add('scroll-animate');
        
        // Function to handle scroll events
        function handleScroll() {
            const currentScrollY = window.scrollY;
            const scrollDirection = currentScrollY > lastScrollY ? 'down' : 'up';
            
            // Detect scroll direction change
            if (scrollDirection !== lastScrollDirection) {
                // Remove heartbeat when scrolling starts
                if (isHeartbeatActive) {
                    contactSection.classList.remove('heartbeat');
                    isHeartbeatActive = false;
                }
                
                // Reset animation classes
                contactSection.classList.remove('scroll-active');
                
                // Add slide animation based on direction
                if (scrollDirection === 'down') {
                    contactSection.style.animation = 'slideInRight 0.5s ease-out forwards';
                } else {
                    contactSection.style.animation = 'slideInLeft 0.5s ease-out forwards';
                }
                
                // Add active class after a short delay
                setTimeout(() => {
                    contactSection.classList.add('scroll-active');
                }, 50);
                
                lastScrollDirection = scrollDirection;
            }
            
            // Clear existing timeout
            clearTimeout(scrollTimeout);
            
            // Set a timeout to add heartbeat effect when scrolling stops
            scrollTimeout = setTimeout(function() {
                // Remove any inline animation
                contactSection.style.animation = '';
                
                // Add continuous heartbeat effect
                if (!isHeartbeatActive) {
                    contactSection.classList.add('heartbeat');
                    isHeartbeatActive = true;
                }
            }, 150);
            
            lastScrollY = currentScrollY;
        }
        
        // Listen for scroll events with throttling
        let ticking = false;
        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(function() {
                    handleScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });
        
        // Trigger animation when contact section comes into view initially
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    contactSection.classList.add('scroll-active');
                    contactSection.style.animation = 'slideInRight 0.5s ease-out forwards';
                    
                    // Start heartbeat after initial animation
                    setTimeout(() => {
                        contactSection.classList.add('heartbeat');
                        isHeartbeatActive = true;
                    }, 600);
                }
            });
        }, { threshold: 0.3 });
        
        observer.observe(contactSection);
    }
});
</script>
@endsection