@extends('layouts.app')

@section('title', 'Products & Services - Inclusive Green Energy Africa')

@section('content')
<main>
    <!-- Product Hero Section -->
    <section class="product-hero-section">
        <div class="container hero-content animated-element">
            <h1>Empowering Africa with Sustainable Energy</h1>
            <p>Discover our innovative and affordable solar, and irrigation solutions designed for homes, farms, and communities.</p>
        </div>
    </section>

    <div class="container">
        <!-- Solar Home Systems Section -->
        <section class="product-section animated-element" id="solar-home-systems">
             <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-green">Solar Home Systems</h2>
                        <p>IGEA offers high-quality, affordable home solar systems providing reliable electricity to off-grid communities. Systems include panels, batteries, LED lighting, and USB charging ports, available in various capacities. Durable and easy to install, they reduce reliance on harmful fuels like kerosene, improving health and productivity. Flexible payment plans, including Pay-As-You-Go, ensure accessibility.</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <!-- Image 1: Slide Left -->
                    <div class="col-md-6 animate-child animate-slide-left">
                        <div class="custom-image-wrapper">
                            <img src="{{ asset('images/MANGANI/20240324_155522.jpg') }}" alt="Customer smiling while using a Solar Home System" class="custom-image">
                        </div>
                        <p class="text-center image-caption"> Solar panels in use</p>
                    </div>
                    <!-- Image 2: Slide Right -->
                    <div class="col-md-6 animate-child animate-slide-right">
                        <div class="custom-image-wrapper">
                            <img src="{{ asset('images/MANGANI/home-lights.jpg') }}" alt="The exterior of a building is lit up at night using solar power " class="custom-image">
                        </div>
                        <p class="text-center image-caption">The exterior of a building is lit up at night using solar power.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Solar Water Pumps Section -->
        <section class="product-section animated-element" id="solar-water-pumps">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-green">Solar Water Pumps</h2>
                        <p>Driving agricultural transformation with solar water pumps for irrigation, enabling year-round farming. Our PAYG model provides affordable access, allowing farmers in groups of five to cultivate crops multiple times annually. Training in good farming practices maximizes yields. This sustainable model empowers farmers, enhances income, reduces dependency on rain, and promotes climate resilience.</p>
                    </div>
                </div>
                <div class="row mt-3">
                     <!-- Image 3: Scale Up -->
                    <div class="col-md-6 animate-child animate-scale-up">
                         <div class="custom-image-wrapper">
                            <img src="{{ asset('images/MANGANI/woman.jpg') }}" alt="A woman works on installing a water pump" class="custom-image">
                         </div>
                        <p class="text-center image-caption">A woman works on installing a water pump while being observed by a group of adults and children.</p>
                    </div>
                     <!-- Image 4: Fade In -->
                    <div class="col-md-6 animate-child animate-fade-in">
                        <div class="custom-image-wrapper">
                            <img src="{{ asset('images/MANGANI/Solar-water.jpg') }}" alt="Solar-powered irrigation" class="custom-image">
                        </div>
                        <p class="text-center image-caption">Solar-powered irrigation in action, watering a field</p>
                    </div>
                </div>
             </div>
        </section>
    </div>
</main>

<!-- Contact Us Section -->
<section class="contact-section animated-element" id="contact-us">
    <div class="container">
        <h2 class="text-center">Contact Us</h2>
        <div class="contact-info-details col-lg-8 mx-auto">
             <p>For inquiries about our products and services:</p>
             <div>
                  <p><i class="bi bi-telephone"></i> <strong>Phone:</strong> <a href="tel:+265988415852">+265 (0) 988 415 852</a></p>
                  <p><i class="bi bi-envelope"></i> <strong>Email:</strong> <a href="mailto:inclusivegreenenergyafrica@gmail.com">inclusivegreenenergyafrica@gmail.com</a></p>
                  <p><i class="bi bi-geo-alt"></i> <strong>Address:</strong> Lilongwe, Malawi</p>
             </div>
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
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Intersection Observer for Animations
        const elementsToAnimate = document.querySelectorAll('.animated-element');
        const observerOptions = { root: null, rootMargin: '0px', threshold: 0.1 };
        const observerCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) { 
                    entry.target.classList.add('visible'); 
                } else { 
                    entry.target.classList.remove('visible'); 
                }
            });
        };
        const animationObserver = new IntersectionObserver(observerCallback, observerOptions);
        elementsToAnimate.forEach(el => animationObserver.observe(el));
    });
</script>
@endsection