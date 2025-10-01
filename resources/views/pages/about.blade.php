@extends('layouts.app')

@section('title', 'About Us - Inclusive Green Energy Africa')

@section('content')
<main>
    <!-- About Us Hero Section -->
    <section class="about-hero-section animated-element">
        <div class="container hero-content">
            <h1>About Inclusive Green Energy Africa</h1>
            <p>Learn about our mission, vision, and commitment to sustainable energy solutions for all.</p>
        </div>
    </section>

    <div class="container">
        <!-- About Us Section -->
        <section class="about-card animated-element" id="about-igea">
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

        <!-- Our Vision Section -->
        <section class="about-card animated-element" id="vision">
            <div class="card-body">
                <h2 class="card-title text-green">Our Vision</h2>
                <p class="card-text">To inspire for a Malawi where all people have access to renewable energy technologies that enable them to lead dignified lives, while protecting the environment for current and future generations.</p>
            </div>
        </section>

        <!-- Our Mission Section -->
        <section class="about-card animated-element" id="mission">
            <div class="card-body">
                <h2 class="card-title text-green">Our Mission</h2>
                <p class="card-text">To become the number one leading renewable energy company in Malawi and rank among the top 10 renewable energy companies in sub-Saharan Africa. We aim to distribute quality renewable energy technologies, targeting both rural and urban areas to eradicate energy poverty.</p>
            </div>
        </section>

        <!-- Our Keys for Development Section -->
        <section class="about-card animated-element" id="keys-development">
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

        <!-- Overview of IGEA Section -->
        <section class="about-card animated-element" id="overview">
            <div class="card-body">
                <h2 class="card-title text-green">Company Overview</h2>
                <p class="card-text">Inclusive Green Energy Africa (IGEA), founded in 2022, is a renewable energy enterprise dedicated to providing affordable and sustainable energy solutions to underserved communities across sub-Saharan Africa. The company specializes in clean energy technologies such as <strong>solar home systems, biogas solutions, and solar water pumps</strong>, targeting households, schools, businesses, and agricultural communities.</p>
                <p class="card-text">IGEA's goal is to <strong>bridge the energy gap</strong> by ensuring that both rural and urban residents have access to <strong>clean, reliable, and cost-effective</strong> energy alternatives for lighting, cooking, and productive use. The enterprise began with the production and distribution of <strong>Chitetezo Mbaula</strong>, an improved cookstove, before expanding into broader renewable energy solutions.</p>
            </div>
        </section>
    </div>
</main>

<!-- Contact Us Section -->
<section class="contact-section animated-element" id="contact-us">
    <div class="container">
        <h2 class="text-center">Contact Us</h2>
        <div class="contact-info-details col-lg-8 mx-auto">
            <p>Get in touch with us for inquiries:</p>
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
        elementsToAnimate.forEach(el => { animationObserver.observe(el); });
    });
</script>
@endsection