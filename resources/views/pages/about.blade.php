@extends('layouts.app')

@section('title', 'About Us - Inclusive Green Energy Africa')

@section('content')
<main>
    <!-- About Us Hero Section -->
    <section class="about-hero-section">
        <div class="container hero-content">
            <h1 data-aos="fade-down">About Inclusive Green Energy Africa</h1>
            <p data-aos="fade-up" data-aos-delay="200">Learn about our mission, vision, and commitment to sustainable energy solutions for all.</p>
        </div>
    </section>

    <div class="container">
        <!-- Who We Are Section -->
        <section class="about-card" id="about-igea" data-aos="fade-up">
            <div class="card-body">
                <h2 class="card-title text-green">Who We Are</h2>
                <p class="card-text">
                    INCLUSIVE GREEN ENERGY AFRICA is a Malawian enterprise providing electrical and renewable energy systems solutions for homes, trade, and industry. Depending on customer needs, the enterprise offers energy systems sizing, installation, end-user training, system warranty agreements, and comprehensive after-sales services.
                </p>
                <p class="card-text">
                    We also provide consultation services in energy audits and address other needs within the energy value chain. Inclusive Green Energy Africa focuses on satisfying customers' daily energy requirements while maximizing profitability and savings through efficient energy resources and technologies.
                </p>
            </div>
        </section>

        <!-- Vision Section -->
        <section class="about-card" id="vision" data-aos="fade-right">
            <div class="card-body">
                <h2 class="card-title text-green">Our Vision</h2>
                <p class="card-text">
                    To inspire for a Malawi where all people have access to renewable energy technologies that enable them to lead dignified lives, while protecting the environment for current and future generations.
                </p>
            </div>
        </section>

        <!-- Mission Section -->
        <section class="about-card" id="mission" data-aos="fade-left">
            <div class="card-body">
                <h2 class="card-title text-green">Our Mission</h2>
                <p class="card-text">
                    To become the number one leading renewable energy company in Malawi and rank among the top 10 renewable energy companies in sub-Saharan Africa. We aim to distribute quality renewable energy technologies, targeting both rural and urban areas to eradicate energy poverty.
                </p>
            </div>
        </section>

        <!-- Keys for Development -->
        <section class="about-card" id="keys-development" data-aos="zoom-in">
            <div class="card-body">
                <h2 class="card-title text-green">Our Keys for Development</h2>
                <ul class="keys-list">
                    <li>Desire for Excellence</li>
                    <li>Trust and Confidence Build-up</li>
                    <li>Innovation</li>
                    <li>Transparency</li>
                    <li>Teamwork</li>
                </ul>
            </div>
        </section>

        <!-- Company Overview -->
        <section class="about-card" id="overview" data-aos="fade-up">
            <div class="card-body">
                <h2 class="card-title text-green">Company Overview</h2>
                <p class="card-text">
                    Inclusive Green Energy Africa (IGEA), founded in 2022, is a renewable energy enterprise dedicated to providing affordable and sustainable energy solutions to underserved communities across sub-Saharan Africa. The company specializes in clean energy technologies such as <strong>solar home systems, biogas solutions, and solar water pumps</strong>, targeting households, schools, businesses, and agricultural communities.
                </p>
                <p class="card-text">
                    IGEA's goal is to <strong>bridge the energy gap</strong> by ensuring that both rural and urban residents have access to <strong>clean, reliable, and cost-effective</strong> energy alternatives for lighting, cooking, and productive use. The enterprise began with the production and distribution of <strong>Chitetezo Mbaula</strong>, an improved cookstove, before expanding into broader renewable energy solutions.
                </p>
            </div>
        </section>
    </div>
</main>

<!-- Contact Section -->
<section class="contact-section" id="contact-us">
    <div class="container">
        <h2 class="text-center">Contact Us</h2>
        <div class="contact-info-details col-lg-8 mx-auto text-center">
            <p>Get in touch with us for inquiries:</p>
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

<style>
/* ===== GENERAL ===== */
body {
    scroll-behavior: smooth;
    font-family: 'Poppins', sans-serif;
}

/* ===== HERO SECTION ===== */
.about-hero-section {
    position: relative;
    padding: 100px 0;
    background: url('{{ asset("images/MANGANI/about-background.jpg") }}') center/cover no-repeat;
    color: white;
    text-align: center;
    overflow: hidden;
    border-radius: 0 0 20px 20px;
}

.about-hero-section::before {
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
    letter-spacing: 1px;
}

.hero-content p {
    font-size: 1.2rem;
    max-width: 600px;
    margin: 15px auto 0;
    opacity: 0.95;
}

/* ===== ABOUT CARDS ===== */
.about-card {
    background: #fff;
    border-radius: 15px;
    padding: 40px;
    margin-bottom: 40px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.4s ease;
}

.about-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(0, 128, 0, 0.15);
}

.card-title {
    font-weight: 700;
    font-size: 1.8rem;
    margin-bottom: 20px;
}

.text-green {
    color: #28a745;
}

.card-text {
    color: #555;
    line-height: 1.7;
}

/* ===== KEYS LIST ===== */
.keys-list {
    list-style: none;
    padding-left: 0;
}

.keys-list li {
    background: #e6f5ea;
    color: #2e7d32;
    padding: 10px 15px;
    border-radius: 8px;
    margin-bottom: 8px;
    transition: all 0.3s ease;
}

.keys-list li:hover {
    background: #28a745;
    color: #fff;
    transform: translateX(5px);
}

/* ===== CONTACT SECTION ===== */
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

.contact-info-details a {
    color: #28a745;
    text-decoration: none;
    font-weight: 500;
}

.contact-info-details a:hover {
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
    }

    .about-card {
        padding: 25px;
    }

    .card-title {
        font-size: 1.5rem;
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
</style>
@endsection

@section('scripts')
<!-- Include AOS (Animate On Scroll) Library -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

<script>
    document.addEventListener('DOMContentLoaded', function () {
        AOS.init({
            duration: 1000,   // Animation duration in ms
            once: false,      // Animations repeat every time scrolling
            offset: 100,      // Trigger before 100px of element
            mirror: true      // Animate again on scroll up
        });
        
        // Custom scroll animation for contact section
        const contactSection = document.getElementById('contact-us');
        let scrollTimeout;
        let lastScrollDirection = 'down';
        let lastScrollY = window.scrollY;
        let isHeartbeatActive = false;
        
        // Add initial animation class
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
    });
</script>
@endsection