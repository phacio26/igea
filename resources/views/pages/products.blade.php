@extends('layouts.app')

@section('title', 'Products & Services - Inclusive Green Energy Africa')

@section('content')
<main>
    <!-- Product Hero Section -->
    <section class="product-hero-section">
        <div class="container hero-content">
            <h1>Empowering Africa with Sustainable Energy</h1>
            <p>Discover our innovative and affordable solar, and irrigation solutions designed for homes, farms, and communities.</p>
        </div>
    </section>

    <div class="container">
        <!-- Solar Home Systems Section -->
        <section class="product-section" id="solar-home-systems">
             <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-green">Solar Home Systems</h2>
                        <p>IGEA offers high-quality, affordable home solar systems providing reliable electricity to off-grid communities. Systems include panels, batteries, LED lighting, and USB charging ports, available in various capacities. Durable and easy to install, they reduce reliance on harmful fuels like kerosene, improving health and productivity. Flexible payment plans, including Pay-As-You-Go, ensure accessibility.</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <!-- Image 1 -->
                    <div class="col-md-6 mb-4">
                        <div class="product-image-container">
                            <img src="{{ asset('images/MANGANI/20240324_155522.jpg') }}" alt="Customer smiling while using a Solar Home System" class="product-img">
                        </div>
                        <p class="text-center image-caption mt-3">Solar panels in use</p>
                    </div>
                    <!-- Image 2 -->
                    <div class="col-md-6 mb-4">
                        <div class="product-image-container">
                            <img src="{{ asset('images/MANGANI/home-lights.jpg') }}" alt="The exterior of a building is lit up at night using solar power" class="product-img">
                        </div>
                        <p class="text-center image-caption mt-3">The exterior of a building is lit up at night using solar power.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Solar Water Pumps Section -->
        <section class="product-section" id="solar-water-pumps">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-green">Solar Water Pumps</h2>
                        <p>Driving agricultural transformation with solar water pumps for irrigation, enabling year-round farming. Our PAYG model provides affordable access, allowing farmers in groups of five to cultivate crops multiple times annually. Training in good farming practices maximizes yields. This sustainable model empowers farmers, enhances income, reduces dependency on rain, and promotes climate resilience.</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <!-- Image 3 -->
                    <div class="col-md-6 mb-4">
                         <div class="product-image-container">
                            <img src="{{ asset('images/MANGANI/woman.jpg') }}" alt="A woman works on installing a water pump" class="product-img">
                         </div>
                        <p class="text-center image-caption mt-3">A woman works on installing a water pump while being observed by a group of adults and children.</p>
                    </div>
                    <!-- Image 4 -->
                    <div class="col-md-6 mb-4">
                        <div class="product-image-container">
                            <img src="{{ asset('images/MANGANI/Solar-water.jpg') }}" alt="Solar-powered irrigation" class="product-img">
                        </div>
                        <p class="text-center image-caption mt-3">Solar-powered irrigation in action, watering a field</p>
                    </div>
                </div>
             </div>
        </section>
    </div>

    <!-- Contact Us Section -->
    <section class="contact-section py-5">
        <div class="container">
            <h2 class="text-center section-heading">Contact Us</h2>
            <div class="contact-info-details col-lg-8 mx-auto">
                <p class="text-center">For inquiries about our products and services:</p>
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
</main>

<style>
/* Product Hero Section */
.product-hero-section {
    position: relative;
    padding: 80px 0;
    margin-bottom: 50px;
    background: url('{{ asset("images/MANGANI/products-background.jpg") }}') no-repeat center center;
    background-size: cover;
    color: white;
    text-align: center;
    border-radius: 0 0 15px 15px;
    overflow: hidden;
}

.product-hero-section::before {
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

/* Product Sections */
.product-section {
    padding: 60px 0;
    border-bottom: 1px solid #e9ecef;
}

.product-section:last-of-type {
    border-bottom: none;
}

.text-green {
    color: #198754;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.product-image-container {
    width: 100%;
    height: 300px;
    overflow: hidden;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    margin-bottom: 1rem;
}

.product-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-img:hover {
    transform: scale(1.05);
}

.image-caption {
    color: #6c757d;
    font-size: 0.95rem;
    font-style: italic;
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
    .product-hero-section {
        padding: 60px 0;
    }
    
    .hero-content h1 {
        font-size: 2rem;
    }
    
    .hero-content p {
        font-size: 1rem;
    }
    
    .product-image-container {
        height: 250px;
    }
    
    .product-img {
        object-fit: contain;
        width: auto;
        max-width: 100%;
        max-height: 100%;
    }
    
    .product-section {
        padding: 40px 0;
    }
    
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
}

@media (min-width: 577px) and (max-width: 768px) {
    .product-hero-section {
        padding: 70px 0;
    }
    
    .hero-content h1 {
        font-size: 2.5rem;
    }
    
    .hero-content p {
        font-size: 1.1rem;
    }
    
    .product-image-container {
        height: 280px;
    }
    
    .contact-section {
        padding: 50px 20px;
    }
}

@media (min-width: 769px) and (max-width: 992px) {
    .product-hero-section {
        padding: 80px 0;
    }
    
    .product-image-container {
        height: 300px;
    }
}

@media (min-width: 993px) and (max-width: 1200px) {
    .product-image-container {
        height: 320px;
    }
}

@media (min-width: 1201px) {
    .product-image-container {
        height: 340px;
    }
}

/* Extra small devices adjustments */
@media (max-width: 575.98px) {
    .product-hero-section {
        padding: 50px 0;
        border-radius: 0;
    }
    
    .hero-content h1 {
        font-size: 1.8rem;
    }
    
    .product-image-container {
        height: 220px;
    }
    
    .contact-section p {
        font-size: 0.95rem;
    }
}
</style>
@endsection