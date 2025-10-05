@extends('layouts.app')

@section('title', $product->name . ' - Inclusive Green Energy Africa')

@section('content')
<main>
    <!-- Product Hero Section -->
    <section class="product-hero-section">
        <div class="container hero-content">
            <h1>{{ $product->name }}</h1>
            <p>{{ Str::limit(strip_tags($product->description), 150) }}</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-8">
                @if($product->images->count() > 0)
                    <div class="row">
                        @foreach($product->images as $image)
                        <div class="col-md-6 mb-4">
                            <div class="product-image-card">
                                <div class="product-image-container">
                                    <img src="{{ $image->image_url }}" 
                                         alt="{{ $image->caption ?? $product->name }}" 
                                         class="product-img">
                                </div>
                                @if($image->description || $image->caption)
                                <div class="image-description-container p-3">
                                    @if($image->description)
                                    <p class="image-description mb-0">{{ $image->description }}</p>
                                    @elseif($image->caption)
                                    <p class="image-caption mb-0">{{ $image->caption }}</p>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-image display-1 text-muted"></i>
                        <h4 class="text-muted mt-3">No images available</h4>
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div class="col-lg-4">
                <div class="product-details-card">
                    <h3 class="text-green">Product Details</h3>
                    
                    <div class="product-description mb-4">
                        {!! nl2br(e($product->description)) !!}
                    </div>

                    @if($product->features && count($product->features) > 0)
                    <div class="product-features mb-4">
                        <h5 class="text-green">Key Features:</h5>
                        <ul class="benefits-list">
                            @foreach($product->features as $feature)
                                @if(trim($feature))
                                <li>{{ $feature }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="product-actions">
                        <a href="#contact" class="btn btn-success btn-lg w-100 mb-3">
                            <i class="bi bi-envelope me-2"></i>Inquire About This Product
                        </a>
                        <a href="{{ route('products') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-left me-2"></i>Back to Products
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <section class="related-products mt-5">
            <h3 class="text-green mb-4">Related Products</h3>
            <div class="row">
                @foreach($relatedProducts as $relatedProduct)
                <div class="col-md-4 mb-4">
                    <div class="card product-card h-100">
                        <div class="product-image-container">
                            <img src="{{ $relatedProduct->image_url }}" 
                                 alt="{{ $relatedProduct->name }}" 
                                 class="product-img">
                        </div>
                        <div class="card-body">
                            <h5 class="product-title">{{ $relatedProduct->name }}</h5>
                            <p class="product-description">{{ Str::limit(strip_tags($relatedProduct->description), 100) }}</p>
                            <a href="{{ route('products.show', $relatedProduct->slug) }}" class="btn btn-primary btn-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>

    <!-- Contact Us Section -->
    <section id="contact" class="contact-section py-5">
        <div class="container">
            <h2 class="text-center section-heading">Contact Us</h2>
            <div class="contact-info-details col-lg-8 mx-auto">
                <p class="text-center">For inquiries about <strong>{{ $product->name }}</strong>:</p>
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

/* Product Image Card */
.product-image-card {
    border: 1px solid #e9ecef;
    border-radius: 12px;
    overflow: hidden;
    background: white;
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.product-image-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: #198754;
}

.product-image-container {
    width: 100%;
    height: 250px;
    overflow: hidden;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-image-card:hover .product-img {
    transform: scale(1.05);
}

/* Image Description */
.image-description-container {
    background: white;
    border-top: 1px solid #e9ecef;
}

.image-description {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 0;
}

.image-caption {
    color: #6c757d;
    font-size: 0.9rem;
    font-style: italic;
    margin-bottom: 0;
}

/* Product Details Card */
.product-details-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    position: sticky;
    top: 20px;
}

.text-green {
    color: #198754;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.product-description {
    color: #555;
    line-height: 1.7;
    font-size: 1rem;
}

.benefits-list {
    list-style-type: none;
    padding-left: 0;
}

.benefits-list li {
    margin-bottom: 12px;
    position: relative;
    padding-left: 30px;
    font-size: 0.95rem;
    color: #444;
}

.benefits-list li::before {
    content: "\F28A";
    font-family: 'bootstrap-icons';
    position: absolute;
    left: 0;
    top: 2px;
    color: #28a745;
    font-weight: bold;
    font-size: 1.1rem;
}

/* Related Products */
.product-card {
    border: 1px solid #e9ecef;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.product-title {
    color: #2c3e50;
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

/* Contact Us Section */
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
        height: 200px;
    }
    
    .product-details-card {
        padding: 1.5rem;
        margin-top: 2rem;
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
        height: 220px;
    }
}
</style>
@endsection