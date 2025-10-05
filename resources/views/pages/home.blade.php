@extends('layouts.app')

@section('title', 'Inclusive Green Energy Africa')

@section('content')
<!-- Hero Section with Slideshow -->
<section class="hero-section">
    <div class="slideshow-container">
        @php
            // Get hero images from page content
            $heroImages = $page->hero_images ?? [];
        @endphp
        
        @if(count($heroImages) > 0)
            @foreach($heroImages as $image)
                <img src="{{ asset($image) }}" alt="Inclusive Green Energy Africa">
            @endforeach
        @else
            <!-- Default images -->
            <img src="{{ asset('images/MANGANI/IMG-20250307-WA0460.jpg') }}" alt="Solar panel installation progress">
            <img src="{{ asset('images/MANGANI/IMG-20250307-WA0464.jpg') }}" alt="Community benefiting from solar energy">
            <img src="{{ asset('images/MANGANI/IMG-20250307-WA0460.jpg') }}" alt="Close-up of solar panels">
            <img src="{{ asset('images/MANGANI/IMG-20250307-WA0461.jpg') }}" alt="Sustainable energy solutions in Africa">
        @endif
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
    <section class="contact-section content-section" id="contact-us">
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
                        @if($galleryItems->count() > 0)
                            @foreach($galleryItems as $item)
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

<style>
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
            // Get dynamic numbers from page content or use defaults
            const stats = @json($page->stats ?? []);
            const productsCount = stats.products_sold || 1286;
            const peopleCount = stats.people_reached || 5000;
            const ecoPercentage = stats.eco_friendly || 100;

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
            animateCounter('productsCounter', productsCount, '+', 2500);
            animateCounter('peopleCounter', peopleCount, '+', 3000);
            animateCounter('ecoCounter', ecoPercentage, '%', 2000);
        }

        // Update Copyright Year
        const currentYear = new Date().getFullYear();
        const yearElement = document.getElementById("current-year");
        if (yearElement) {
            yearElement.textContent = currentYear;
        }

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