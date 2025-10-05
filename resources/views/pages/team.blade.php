@extends('layouts.app')

@section('title', 'Our Team - Inclusive Green Energy Africa')

@section('content')
<main>
    <!-- Hero Section -->
    <section class="team-hero-section">
        <div class="container hero-content">
            <h1 data-aos="fade-down">Meet Our Passionate Team</h1>
            <p data-aos="fade-up" data-aos-delay="200">The dedicated individuals driving sustainable energy solutions and community empowerment across Africa.</p>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5">
        <div class="container">
            @if($teamMembers->count() > 0)
                <div class="row justify-content-center">
                    @foreach($teamMembers as $member)
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-5" 
                             data-aos="{{ ['fade-up','fade-left','fade-right','zoom-in'][ $loop->index % 4 ] }}" 
                             data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="team-card text-center h-100">
                                <div class="team-image-container">
                                    <img src="{{ $member->image_url }}"
                                         alt="{{ $member->name }}"
                                         class="team-img img-fluid"
                                         onerror="this.onerror=null; this.src='{{ asset('images/default-avatar.png') }}';">
                                </div>
                                <div class="team-content">
                                    <h4 class="team-name">{{ $member->name }}</h4>
                                    <h5 class="team-position">{{ $member->position }}</h5>
                                    @if($member->description)
                                        <p class="team-description">{{ $member->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5" data-aos="fade-up">
                    <div class="empty-state">
                        <i class="bi bi-people display-1 text-muted mb-4"></i>
                        <h3 class="text-muted mb-3">No Team Members Available</h3>
                        <p class="text-muted mb-4">Our team information is currently being updated. Please check back soon.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact-us">
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
/* ===== HERO SECTION ===== */
.team-hero-section {
    position: relative;
    padding: 100px 0;
    background: url('{{ asset("images/MANGANI/team-background.jpg") }}') center/cover no-repeat;
    color: white;
    text-align: center;
    border-radius: 0 0 20px 20px;
    overflow: hidden;
}

.team-hero-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 100, 0, 0.6);
    backdrop-filter: blur(3px);
    z-index: 1;
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

/* ===== TEAM CARDS ===== */
.team-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.4s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.team-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 10px 30px rgba(0, 128, 0, 0.15);
}

.team-image-container {
    /* Let the image container adjust to the image height naturally */
    flex: 0 0 auto;
    overflow: hidden;
    width: 100%;
}

.team-img {
    width: 100%;
    height: auto; /* Let height adjust automatically */
    display: block;
    transition: transform 0.4s ease;
}

.team-card:hover .team-img {
    transform: scale(1.08);
}

.team-content {
    padding: 1.5rem;
    flex: 1 0 auto; /* Allow content to grow and take remaining space */
}

.team-name {
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.team-position {
    color: #28a745;
    font-weight: 600;
    margin-bottom: 1rem;
}

.team-description {
    color: #555;
    line-height: 1.6;
    font-size: 0.95rem;
}

/* ===== CONTACT SECTION ANIMATIONS ===== */
.contact-section {
    background: linear-gradient(to right, #f0fff4, #e8f5e9);
    padding: 60px 0;
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
    text-decoration: none;
    transition: color 0.3s;
}

.contact-section a:hover {
    text-decoration: underline;
    color: #218838;
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
    
    /* Ensure images display fully on mobile */
    .team-image-container {
        max-height: none; /* Remove any max-height restrictions */
    }
}

/* Extra small devices (phones, 576px and down) */
@media (max-width: 576px) {
    .team-card {
        margin-bottom: 2rem;
    }
}
</style>
@endsection

@section('scripts')
<!-- Include AOS (Animate On Scroll) Library -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

<script>
document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
        duration: 1000,  // animation duration
        once: false,     // repeat animation every scroll
        offset: 120,     // trigger offset
        easing: 'ease-in-out',
        mirror: true     // animate elements out and back in
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