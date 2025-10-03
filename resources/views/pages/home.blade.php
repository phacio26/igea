@extends('layouts.app')

@section('title', 'Inclusive Green Energy Africa')

@section('content')
<!-- Hero Section with Slideshow -->
<section class="hero-section">
    <div class="slideshow-container">
        <img src="{{ asset('images/MANGANI/IMG-20250307-WA0460.jpg') }}" alt="Solar panel installation progress">
        <img src="{{ asset('images/MANGANI/IMG-20250307-WA0464.jpg') }}" alt="Community benefiting from solar energy">
        <img src="{{ asset('images/MANGANI/IMG-20250307-WA0460.jpg') }}" alt="Close-up of solar panels">
        <img src="{{ asset('images/MANGANI/IMG-20250307-WA0461.jpg') }}" alt="Sustainable energy solutions in Africa">
    </div>
    <div class="text-above-image scroll-up" id="hero-text">
        <h1>WELCOME TO</h1>
        <h2>Inclusive Green Energy Africa</h2>
        <p>Eco-friendly for a better planet</p>
    </div>
</section>

<!-- Main Content Area -->
<main>
    <!-- Why Choosing Us Section -->
    <section id="why-choose-us" class="content-section">
        <div class="container">
            <h2 class="section-heading">Why Choose Us?</h2>
            <div class="row justify-content-center">
                <!-- Column 1 -->
                <div class="col-md-4">
                    <div class="stats-card">
                        <i class="bi bi-cart-check text-dark"></i>
                        <h3 class="counter-number" id="productsCounter">0</h3>
                        <p>Affordable products sold</p>
                    </div>
                </div>
                <!-- Column 2 -->
                <div class="col-md-4">
                    <div class="stats-card">
                        <i class="bi bi-people text-dark"></i>
                        <h3 class="counter-number" id="peopleCounter">0</h3>
                        <p>People reached</p>
                    </div>
                </div>
                <!-- Column 3 -->
                <div class="col-md-4">
                    <div class="stats-card">
                        <i class="bi bi-globe text-dark"></i>
                        <h3 class="counter-number" id="ecoCounter">0%</h3>
                        <p>Eco-friendly products</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Go For Our Products and Services Section -->
    <section id="why-go-for-our-products" class="content-section">
         <div class="container">
            <h2 class="section-heading">Why Go For Our Products and Services?</h2>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="animated-border-box">
                        <span class="border-line border-line-top"></span>
                        <span class="border-line border-line-right"></span>
                        <span class="border-line border-line-bottom"></span>
                        <span class="border-line border-line-left"></span>
                        <i class="bi bi-universal-access-circle fs-1"></i>
                        <h3>Accessibility</h3>
                        <p>Solar lanterns, portable panels, community microgrids provide affordable and sustainable energy access in remote areas.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                     <div class="animated-border-box">
                        <span class="border-line border-line-top"></span>
                        <span class="border-line border-line-right"></span>
                        <span class="border-line border-line-bottom"></span>
                        <span class="border-line border-line-left"></span>
                        <i class="bi bi-cash-coin fs-1"></i>
                        <h3>Affordability</h3>
                        <p>Economical solar panels harnessing sunlight for sustainable energy, lowering costs and promoting renewable power adoption.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                     <div class="animated-border-box">
                        <span class="border-line border-line-top"></span>
                        <span class="border-line border-line-right"></span>
                        <span class="border-line border-line-bottom"></span>
                        <span class="border-line border-line-left"></span>
                        <i class="bi bi-people-fill fs-1"></i>
                        <h3>Inclusivity</h3>
                        <p>Equitable solar tech: Affordable, accessible, culturally sensitive, empowering all communities for sustainable energy transition.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- View Gallery Button Section -->
    <section id="view-gallery-section" class="content-section text-center">
        <div class="container">
             <h2 class="section-heading">Our Work in Action</h2>
             <p class="lead mb-4">See examples of our projects and the impact we're making.</p>
             <!-- Button to trigger the modal -->
             <button type="button" class="btn btn-green btn-lg" data-bs-toggle="modal" data-bs-target="#galleryModal">
                 View Gallery <i class="bi bi-images ms-2"></i>
             </button>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="contact-section content-section">
         <div class="container">
            <h2 class="text-center section-heading">Contact Us</h2>
            <div class="contact-info col-lg-8 mx-auto">
                <p><i class="bi bi-telephone"></i> <strong>Phone:</strong> <a href="tel:+265988415852">+265 (0) 988 415 852</a></p>
                <p><i class="bi bi-envelope"></i> <strong>Email:</strong> <a href="mailto:inclusivegreenenergyafrica@gmail.com">inclusivegreenenergyafrica@gmail.com</a></p>
                <p><i class="bi bi-geo-alt"></i> <strong>Address:</strong> Lilongwe, Malawi</p>

                <h3 class="mt-4 h5 fw-semibold">Office Hours</h3>
                <p>Monday to Friday: 8:00 am - 5:00 pm</p>
                <p>Saturday: 9:00 am - 12:00 noon</p>
                <p>Closed on Sundays</p>

                <div class="social-icons">
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
</main>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalLabel">Our Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row g-3">
                        <!-- Dynamic Gallery Images from Database -->
                        @if(isset($gallery) && $gallery->count() > 0)
                            @foreach($gallery as $item)
                            <div class="col-lg-4 col-md-6">
                                <img src="{{ $item->image_url }}" 
                                     alt="{{ $item->title }}" 
                                     class="img-fluid modal-gallery-image"
                                     onerror="this.src='{{ asset('images/default-image.png') }}'">
                                @if($item->title)
                                    <p class="text-center mt-2 small">{{ $item->title }}</p>
                                @endif
                            </div>
                            @endforeach
                        @else
                            <!-- Fallback message if no gallery images -->
                            <div class="col-12 text-center py-5">
                                <i class="bi bi-images display-1 text-muted"></i>
                                <h4 class="text-muted mt-3">No Gallery Images Available</h4>
                                <p class="text-muted">Gallery images will be added soon.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Footer styling */
    footer {
        width: 100%;
        background-color: rgb(116, 119, 116);
        color: white;
        padding: 20px 0;
        text-align: center;
        z-index: 1000;
        margin-top: 40px;
    }

    /* Body styling */
    body {
        padding-bottom: 0;
        padding-top: 56px;
        position: relative;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        overflow-x: hidden;
    }

    /* Hero Section */
    .hero-section {
        position: relative;
        height: 100vh;
        overflow: hidden;
    }

    .slideshow-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .slideshow-container img {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 1s ease-in-out;
        animation: slideshow 12s infinite;
    }
    .slideshow-container img:nth-child(1) { animation-delay: 0s; }
    .slideshow-container img:nth-child(2) { animation-delay: 3s; }
    .slideshow-container img:nth-child(3) { animation-delay: 6s; }
    .slideshow-container img:nth-child(4) { animation-delay: 9s; }

    @keyframes slideshow {
        0%, 20%, 100% { opacity: 0; }
        25%, 95% { opacity: 1; }
    }

    /* Text Above Image */
    .text-above-image {
        position: absolute;
        top: 25%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: green;
        z-index: 1;
        transition: opacity 1s ease, transform 1s ease;
    }
    .text-above-image h1 { font-size: 3rem; font-weight: bold; margin-bottom: 10px; }
    .text-above-image h2 { font-size: 2.5rem; font-weight: bold; margin-bottom: 10px; }
    .text-above-image p { font-size: 1.5rem; }
    .scroll-down { opacity: 0; transform: translate(-50%, -40%) scale(0.9); }
    .scroll-up { opacity: 1; transform: translate(-50%, -50%) scale(1); }

    /* Counter Number Styling */
    .counter-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        transition: all 0.3s ease;
    }

    /* Theme */
    .bg-green { background-color: #28a745; color: white; }
    .text-green { color: #28a745; }
    .btn-green { background-color: #28a745; color: white; border: none; }
    .btn-green:hover { background-color: #218838; color: white; }

    /* --- Section Base Styling & Observer Animation --- */
    .content-section {
         padding: 60px 0;
         opacity: 0;
         transform: translateY(30px);
         transition: opacity 0.8s ease-out, transform 0.8s ease-out;
         will-change: opacity, transform;
    }
    .content-section.visible {
         opacity: 1;
         transform: translateY(0);
    }
    #why-choose-us { background-color: #ffffff; }
    #why-go-for-our-products { background-color: #e0f2e3; }
    #view-gallery-section { background-color: #ffffff; }
    .contact-section { background-color: #e0f2e3; }

    /* Section Heading */
     .section-heading {
        font-size: 2.2rem; font-weight: 600; margin-bottom: 40px;
        text-align: center; color: #28a745;
    }

    /* --- Why Choose Us Section - Card Styling & ANIMATIONS --- */
    #why-choose-us .stats-card {
        background-color: #ffc107;
        padding: 25px; border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-align: center; height: 100%; color: #333;
        margin-bottom: 20px;
        opacity: 0;
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        will-change: transform, opacity;
    }
    #why-choose-us .row > div:nth-child(1) .stats-card { transform: translateX(-80px); transition-delay: 0.1s; }
    #why-choose-us .row > div:nth-child(2) .stats-card { transform: scale(0.7) translateY(50px); transition-delay: 0.2s; }
    #why-choose-us .row > div:nth-child(3) .stats-card { transform: translateX(80px); transition-delay: 0.3s; }
    #why-choose-us.visible .row > div:nth-child(1) .stats-card,
    #why-choose-us.visible .row > div:nth-child(3) .stats-card { opacity: 1; transform: translateX(0); }
    #why-choose-us.visible .row > div:nth-child(2) .stats-card { opacity: 1; transform: scale(1) translateY(0); }
    #why-choose-us .stats-card:hover {
        transform: translateY(-5px) scale(1.03);
        box-shadow: 0 8px 15px rgba(0,0,0,0.15);
    }
    #why-choose-us .stats-card i { font-size: 2.5rem; margin-bottom: 10px; }
    #why-choose-us .stats-card h3 { margin-bottom: 5px;}
    #why-choose-us .stats-card p { font-size: 1rem; margin-bottom: 0; }

    /* Why Go For Our Products - Rectangle Styling & Animation */
    .animated-border-box {
         position: relative; text-align: center; padding: 35px 25px;
         background-color: #ffffff; border-radius: 8px;
         box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); height: 100%;
         overflow: hidden;
         transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
         z-index: 1;
     }
     .animated-border-box:hover {
         transform: translateY(-5px);
         box-shadow: 0 8px 20px rgba(40, 167, 69, 0.15);
     }
    .animated-border-box i { font-size: 3rem; margin-bottom: 15px; color: #28a745; }
    .animated-border-box h3 { font-size: 1.4rem; font-weight: 600; margin-bottom: 10px; color: #343a40; }
    .animated-border-box p { font-size: 0.95rem; color: #555; line-height: 1.6; margin-bottom: 0; }
    .border-line { position: absolute; background-color: #28a745; transition: all 0.3s ease-out; z-index: 0; }
    .border-line-top { top: 0; left: 0; width: 0; height: 3px; transition-delay: 0.6s; }
    .border-line-right { top: 0; right: 0; width: 3px; height: 0; transition-delay: 0s; }
    .border-line-bottom { bottom: 0; right: 0; width: 0; height: 3px; transition-delay: 0.2s; }
    .border-line-left { bottom: 0; left: 0; width: 3px; height: 0; transition-delay: 0.4s; }
    .animated-border-box:hover .border-line-top { width: 100%; }
    .animated-border-box:hover .border-line-right { height: 100%; }
    .animated-border-box:hover .border-line-bottom { width: 100%; }
    .animated-border-box:hover .border-line-left { height: 100%; }

    /* --- Gallery Modal Styling --- */
    .modal-gallery-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 0;
        transition: transform 0.2s ease-in-out;
    }
    .modal-gallery-image:hover {
         transform: scale(1.03);
    }
    .modal-body .row > div {
         margin-bottom: 1rem;
    }
     .modal-body {
         max-height: 75vh;
         overflow-y: auto;
     }

    /* Contact Us Section Base Styling */
    .contact-section {
        padding: 60px 0;
        margin-bottom: 40px;
        text-align: center;
    }
    .contact-section h2.section-heading { margin-bottom: 40px; }
    .contact-section p { margin-bottom: 15px; color: #333; line-height: 1.7; font-size: 1.1rem; }
    .contact-section i { color: #28a745; margin-right: 10px; width: 20px; text-align: center; vertical-align: middle;}
    .contact-section .contact-info a { color: #28a745; text-decoration: none; transition: color 0.3s ease; font-weight: 500;}
    .contact-section .contact-info a:hover { color: #218838; text-decoration: underline; }
    .contact-section .social-icons { margin-top: 25px; }
    .contact-section .social-icons a { color: #28a745; transition: color 0.3s ease, transform 0.3s ease; display: inline-block; margin: 0 10px; }
    .contact-section .social-icons a:hover { color: #218838; transform: scale(1.15); }

    /* Footer Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .copyright {
        font-size: 0.9rem; animation: fadeIn 1s 1s ease-out forwards;
        opacity: 0; color: #eee;
    }

    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .animated-border-box { margin-bottom: 30px; }
        #why-choose-us .row > div { margin-bottom: 20px; }
        #why-choose-us .row > div:last-child { margin-bottom: 0; }
    }

    @media (max-width: 768px) {
        .text-above-image h1 { font-size: 2rem; } .text-above-image h2 { font-size: 1.8rem; } .text-above-image p { font-size: 1.2rem; }
        .content-section, .contact-section { padding: 50px 15px; }
        .section-heading { font-size: 1.8rem; margin-bottom: 30px; }
        .contact-section h2.section-heading { font-size: 1.8rem; }
        .contact-section p { font-size: 1rem; }
        .modal-gallery-image { height: 200px; }
        .counter-number { font-size: 2rem; }
    }

    @media (max-width: 576px) {
        body { padding-top: 56px; }
        .text-above-image { top: 30%; }
        .text-above-image h1 { font-size: 1.5rem; } .text-above-image h2 { font-size: 1.3rem; } .text-above-image p { font-size: 1rem; }
        .content-section, .contact-section { padding: 40px 15px; }
        .section-heading { font-size: 1.6rem; }
        .contact-section h2.section-heading { margin-bottom: 20px; font-size: 1.6rem; }
        .contact-section p { font-size: 0.95rem; }
        footer { padding: 15px 0; }
        .copyright { font-size: 0.8rem; }
        .animated-border-box { padding: 25px 15px; }
        .counter-number { font-size: 1.8rem; }
        .modal-gallery-image { height: 180px; }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hero Text Scroll Effect
        let lastScrollTop = 0;
        const heroText = document.getElementById("hero-text");
        const heroSection = document.querySelector('.hero-section');

        if (heroText && heroSection) {
             if (window.pageYOffset <= 50) {
                heroText.classList.add("scroll-up");
                heroText.classList.remove("scroll-down");
             } else {
                heroText.classList.add("scroll-down");
                heroText.classList.remove("scroll-up");
             }
            window.addEventListener("scroll", () => {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const heroHeight = heroSection.offsetHeight;
                if (scrollTop < heroHeight * 0.7) {
                    if (scrollTop > lastScrollTop && scrollTop > 50) {
                        heroText.classList.remove("scroll-up");
                        heroText.classList.add("scroll-down");
                    } else if (scrollTop < lastScrollTop) {
                        heroText.classList.remove("scroll-down");
                        heroText.classList.add("scroll-up");
                    }
                } else {
                     heroText.classList.remove("scroll-up");
                     heroText.classList.add("scroll-down");
                }
                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
            }, { passive: true });
        }

        // Intersection Observer for Section Animations
        const sectionsToAnimate = document.querySelectorAll('.content-section');
        const observerOptions = { root: null, rootMargin: '0px', threshold: 0.15 };
        const observerCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) { 
                    entry.target.classList.add('visible'); 
                    
                    // Start counter animation when Why Choose Us section becomes visible
                    if (entry.target.id === 'why-choose-us' && !entry.target.classList.contains('counters-animated')) {
                        entry.target.classList.add('counters-animated');
                        startCounterAnimation();
                    }
                } else { 
                    entry.target.classList.remove('visible'); 
                }
            });
        };
        const sectionObserver = new IntersectionObserver(observerCallback, observerOptions);
        sectionsToAnimate.forEach(section => { sectionObserver.observe(section); });

        // Counter Animation Function
        function startCounterAnimation() {
            // Function to animate counting
            function animateCounter(elementId, targetNumber, suffix = '', duration = 2000) {
                const element = document.getElementById(elementId);
                const startNumber = 0;
                const increment = targetNumber / (duration / 16); // 60fps
                let currentNumber = startNumber;
                
                const timer = setInterval(() => {
                    currentNumber += increment;
                    if (currentNumber >= targetNumber) {
                        currentNumber = targetNumber;
                        clearInterval(timer);
                    }
                    
                    if (elementId === 'ecoCounter') {
                        // For percentage, show integer
                        element.textContent = Math.floor(currentNumber) + suffix;
                    } else {
                        // For other numbers, format with commas
                        element.textContent = Math.floor(currentNumber).toLocaleString() + suffix;
                    }
                }, 16);
            }

            // Start animations with different durations for better effect
            animateCounter('productsCounter', 1286, '+', 2500);
            animateCounter('peopleCounter', 5000, '+', 3000);
            animateCounter('ecoCounter', 100, '%', 2000);
        }

        // Update Copyright Year
        const currentYear = new Date().getFullYear();
        const yearElement = document.getElementById("current-year");
        if (yearElement) {
            yearElement.textContent = currentYear;
        }
    });
</script>
@endsection