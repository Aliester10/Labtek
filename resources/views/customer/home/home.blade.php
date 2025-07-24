@extends('layouts.customer.master')

@section('content')

@include('customer.partials.home.welcome__messages')

<!-- Shopee Exact Replica Slider -->
<section class="hero-shopee-exact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if ($slider->isEmpty())
                    <!-- Default single slide when no slider data -->
                    <div class="shopee-slider-grid single-layout">
                        <div class="shopee-banner-item main-banner">
                            <a href="{{ route('shop') }}" class="shopee-banner-link">
                                <img src="{{ asset('assets/images/slider_default.jpg') }}" 
                                     alt="Default Banner" 
                                     class="shopee-banner-image">
                            </a>
                        </div>
                    </div>
                @elseif ($slider->count() == 1)
                    <!-- Single image layout -->
                    <div class="shopee-slider-grid single-layout">
                        <div class="shopee-banner-item main-banner">
                            <a href="{{ $slider->first()->url }}" class="shopee-banner-link">
                                <img src="{{ asset($slider->first()->image) }}" 
                                     alt="Banner" 
                                     class="shopee-banner-image">
                            </a>
                        </div>
                    </div>
                @elseif ($slider->count() == 2)
                    <!-- Two images layout - Equal split -->
                    <div class="shopee-slider-grid two-layout">
                        @foreach ($slider as $item)
                            <div class="shopee-banner-item half-banner">
                                <a href="{{ $item->url }}" class="shopee-banner-link">
                                    <img src="{{ asset($item->image) }}" 
                                         alt="Banner" 
                                         class="shopee-banner-image">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @elseif ($slider->count() == 3)
                    <!-- Three images layout - Main + 2 stacked -->
                    <div class="shopee-slider-grid three-layout">
                        <div class="shopee-banner-item main-banner">
                            <a href="{{ $slider->first()->url }}" class="shopee-banner-link">
                                <img src="{{ asset($slider->first()->image) }}" 
                                     alt="Banner" 
                                     class="shopee-banner-image">
                            </a>
                        </div>
                        <div class="shopee-side-grid">
                            @foreach ($slider->skip(1) as $item)
                                <div class="shopee-banner-item side-banner">
                                    <a href="{{ $item->url }}" class="shopee-banner-link">
                                        <img src="{{ asset($item->image) }}" 
                                             alt="Banner" 
                                             class="shopee-banner-image">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @elseif ($slider->count() == 4)
                    <!-- Four images layout - Main + 3 in proper grid -->
                    <div class="shopee-slider-grid four-layout">
                        <div class="shopee-banner-item main-banner">
                            <a href="{{ $slider->first()->url }}" class="shopee-banner-link">
                                <img src="{{ asset($slider->first()->image) }}" 
                                     alt="Banner" 
                                     class="shopee-banner-image">
                            </a>
                        </div>
                        <div class="shopee-side-grid">
                            <div class="shopee-banner-item side-top">
                                <a href="{{ $slider->slice(1, 1)->first()->url }}" class="shopee-banner-link">
                                    <img src="{{ asset($slider->slice(1, 1)->first()->image) }}" 
                                         alt="Banner" 
                                         class="shopee-banner-image">
                                </a>
                            </div>
                            <div class="shopee-bottom-grid">
                                @foreach ($slider->slice(2, 2) as $item)
                                    <div class="shopee-banner-item quarter-banner">
                                        <a href="{{ $item->url }}" class="shopee-banner-link">
                                            <img src="{{ asset($item->image) }}" 
                                                 alt="Banner" 
                                                 class="shopee-banner-image">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <!-- 5+ images - Shopee Style Carousel -->
                    <div class="shopee-carousel-container">
                        <div id="shopeeCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                            <div class="carousel-inner">
                                @foreach ($slider as $index => $item)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <a href="{{ $item->url }}" class="shopee-banner-link">
                                            <img src="{{ asset($item->image) }}" 
                                                 alt="Banner" 
                                                 class="shopee-banner-image">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Shopee Style Controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#shopeeCarousel" data-bs-slide="prev">
                                <div class="shopee-control-btn">
                                    <i class="fas fa-chevron-left"></i>
                                </div>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#shopeeCarousel" data-bs-slide="next">
                                <div class="shopee-control-btn">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </button>
                            
                            <!-- Shopee Style Indicators -->
                            <div class="carousel-indicators shopee-indicators">
                                @foreach ($slider as $index => $item)
                                    <button type="button" data-bs-target="#shopeeCarousel" data-bs-slide-to="{{ $index }}" 
                                            class="{{ $index == 0 ? 'active' : '' }}"></button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Feature Cards Section -->
<section class="features-section">
    <div class="container">
        <div class="row features-grid">
            <!-- Card 1 -->
            <div class="col-6 col-lg-3 col-md-6 feature-column">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                    <div class="feature-content">
                        <h4>{{ __('messages.fast_delivery') }}</h4>
                        <p>{{ __('messages.every_order') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="col-6 col-lg-3 col-md-6 feature-column">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <div class="feature-icon blue-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                    </div>
                    <div class="feature-content">
                        <h4>{{ __('messages.quality_assurance') }}</h4>
                        <p>{{ __('messages.quality_assurance_description') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Card 3 -->
            <div class="col-6 col-lg-3 col-md-6 feature-column">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                    </div>
                    <div class="feature-content">
                        <h4>{{ __('messages.24/7_support') }}</h4>
                        <p>{{ __('messages.dedicated_customer_service') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Card 4 -->
            <div class="col-6 col-lg-3 col-md-6 feature-column">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <div class="feature-icon blue-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                    </div>
                    <div class="feature-content">
                        <h4>{{ __('messages.secure_payment') }}</h4>
                        <p>{{ __('messages.secure_payment_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rest of sections remain the same... -->
@if($bigSales && $bigSales->products->isNotEmpty())
<section class="big-sale-section">
    <div class="container-fluid px-0">
        <div class="big-sale-wrapper">
            <!-- Enhanced background with multiple overlay effects -->
            <div class="big-sale-bg" style="background-image: url('{{ asset($bigSales->banner) }}')"></div>
            <div class="big-sale-overlay"></div>
            <div class="big-sale-shape"></div>
            <div class="big-sale-particles"></div>
            
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center">
                        <div class="big-sale-content wow animate__animated animate__fadeInUp">
                            <!-- Enhanced badge with pulse effect -->
                            <div class="sale-badge-wrapper">
                                <div class="sale-badge pulse-effect">Special Offer</div>
                            </div>
                            
                            <!-- Enhanced typography -->
                            <h2 class="text-glow">{{ $bigSales->title }}</h2>
                            <p class="sale-description">{{ Str::limit($bigSales->description, 120) }}</p>
                            
                            <!-- Enhanced countdown with 3D effect -->
                            <div class="countdown-container">
                                <div class="countdown-row">
                                    <div class="countdown-item">
                                        <div class="countdown-value" id="days">00</div>
                                        <div class="countdown-label">{{ __('messages.days') }}</div>
                                        <div class="countdown-item-shine"></div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-value" id="hours">00</div>
                                        <div class="countdown-label">{{ __('messages.hours') }}</div>
                                        <div class="countdown-item-shine"></div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-value" id="minutes">00</div>
                                        <div class="countdown-label">{{ __('messages.minutes') }}</div>
                                        <div class="countdown-item-shine"></div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-value" id="seconds">00</div>
                                        <div class="countdown-label">{{ __('messages.seconds') }}</div>
                                        <div class="countdown-item-shine"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Enhanced CTA button -->
                            <div class="sale-button-wrapper">
                                <a href="{{ route('customer.bigsale.index', ['slug' => $bigSales->slug ?? 'default-slug']) }}" 
                                   class="btn btn-xl btn-primary btn-glow btn-sale">
                                    <span class="btn-label">{{ __('messages.shop_now') }}</span>
                                    <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const bigSaleEndTime = new Date("{{ date('Y-m-d\TH:i:s', strtotime($bigSales->end_time)) }}").getTime();

        function startCountdown(endTime) {
            const countdownInterval = setInterval(function() {
                const now = new Date().getTime();
                const distance = endTime - now;

                if (distance < 0) {
                    clearInterval(countdownInterval);
                    document.getElementById("days").innerHTML = "00";
                    document.getElementById("hours").innerHTML = "00";
                    document.getElementById("minutes").innerHTML = "00";
                    document.getElementById("seconds").innerHTML = "00";
                } else {
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById("days").innerHTML = days < 10 ? "0" + days : days;
                    document.getElementById("hours").innerHTML = hours < 10 ? "0" + hours : hours;
                    document.getElementById("minutes").innerHTML = minutes < 10 ? "0" + minutes : minutes;
                    document.getElementById("seconds").innerHTML = seconds < 10 ? "0" + seconds : seconds;
                }
            }, 1000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            startCountdown(bigSaleEndTime);
            
            // Create particle effect for Big Sale section
            createParticles();
        });
        
        function createParticles() {
            const particlesContainer = document.querySelector('.big-sale-particles');
            if (!particlesContainer) return;
            
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Random properties
                const size = Math.random() * 6 + 2; // 2-8px
                const posX = Math.random() * 100; // 0-100%
                const posY = Math.random() * 100; // 0-100%
                const delay = Math.random() * 5; // 0-5s
                const duration = Math.random() * 10 + 10; // 10-20s
                
                // Apply styles
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = posX + '%';
                particle.style.top = posY + '%';
                particle.style.animationDelay = delay + 's';
                particle.style.animationDuration = duration + 's';
                
                particlesContainer.appendChild(particle);
            }
        }
    </script>
</section>
@endif

<!-- Featured Products with Modern Card Design -->
@if($product->isNotEmpty())
<section class="featured-products" id="featured-products">
    <div class="container">
        <div class="section-header text-center">
            <h2>{{ __('messages.Product_terbaru') }}</h2>
            <p>Discover our latest products and innovations</p>
        </div>

        <div class="row">
            @foreach ($product as $item)
                @php
                    // Pastikan cek apakah images memiliki data
                    $imagePath = optional($item->images->first())->images ?? 'assets/dummy/produck1.png';
                    
                    // Calculate discount percentage if applicable
                    $discountPercentage = 0;
                    if($item->discount_price && $item->price > 0) {
                        $discountPercentage = round((($item->price - $item->discount_price) / $item->price) * 100);
                    }
                @endphp
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card" data-href="{{ route('product.show', $item->slug) }}?source={{ Str::random(10) }}">
                        @if($discountPercentage > 0)
                        <div class="product-badge">-{{ $discountPercentage }}%</div>
                        @endif
                        
                        <div class="product-thumb">
                            <img src="{{ asset($imagePath) }}" alt="{{ $item->name }}" class="product-img">
                            <div class="product-actions">
                                <a href="{{ route('product.show', $item->slug) }}" class="btn-action" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="btn-action quick-view" title="Quick View">
                                    <i class="fas fa-search-plus"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-info">
                            <h3 class="product-title">
                                <a href="{{ route('product.show', $item->slug) }}">{{ Str::limit($item->name, 40) }}</a>
                            </h3>
                            
                            <div class="product-price">
                                @if ($item->discount_price)
                                    <span class="price-old">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                    <span class="price-new">Rp{{ number_format($item->discount_price, 0, ',', '.') }}</span>
                                @else
                                    @if ($item->is_price_displayed === 'yes')
                                        <span class="price-new">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="price-contact">{{ __('messages.hubungi_admin') }}</span>
                                    @endif
                                @endif
                            </div>
                            
                            <div class="product-footer">
                                <a href="{{ route('product.show', $item->slug) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.view_details') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('shop') }}" class="btn btn-primary btn-lg">{{ __('messages.selengkapnya') }} <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>
@endif

<!-- Modal Section -->
@if($bigSales && $bigSales->modal_image)
<div class="modal fade modern-modal" id="saleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <a href="{{ route('customer.bigsale.index', ['slug' => $bigSales->slug]) }}">
                    <img src="{{ asset($bigSales->modal_image) }}" alt="Big Sale Banner" class="img-fluid w-100">
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function() {
            var myModal = new bootstrap.Modal(document.getElementById('saleModal'));
            myModal.show();
        }, 2000);
    });
</script>
@endif

<!-- Shopee Exact Replica CSS -->
<style>
    /* Global Variables */
    :root {
        --primary: #416bbf;
        --primary-dark: #2d4d8a;
        --white: #ffffff;
        --gray-100: #f8f9fa;
        --gray-800: #343a40;
        --shopee-orange: #ee4d2d;
        --transition: all 0.3s ease;
    }

    /* Hero Section */
    .hero-shopee-exact {
        padding: 20px 0;
        background-color: var(--gray-100);
    }

    /* EXACT SHOPEE REPLICA - NO BORDERS, MINIMAL GAPS */
    .shopee-slider-grid {
        display: grid;
        width: 100%;
        height: 400px;
        overflow: hidden;
        border-radius: 8px;
        
        /* KEY: Minimal gap like Shopee */
        gap: 4px;
        
        /* Remove all padding/borders */
        padding: 0;
        margin: 0;
        background: transparent;
        box-shadow: none;
    }

    /* Layout Definitions - Exactly like Shopee */
    .single-layout {
        grid-template-columns: 1fr;
        grid-template-rows: 1fr;
    }

    .two-layout {
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 1fr;
    }

    .three-layout {
        grid-template-columns: 2fr 1fr;
        grid-template-rows: 1fr;
    }

    .four-layout {
        grid-template-columns: 2fr 1fr;
        grid-template-rows: 1fr;
    }

    /* Shopee Side Grid for 3+ images */
    .shopee-side-grid {
        display: grid;
        gap: 4px;
        height: 100%;
    }

    /* For 3 images: 2 stacked vertically */
    .three-layout .shopee-side-grid {
        grid-template-rows: 1fr 1fr;
    }

    /* For 4 images: top single + bottom 2 horizontal */
    .four-layout .shopee-side-grid {
        grid-template-rows: 1fr 1fr;
    }

    .shopee-bottom-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4px;
        height: 100%;
    }

    /* Shopee Banner Items - ZERO padding/borders */
    .shopee-banner-item {
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: var(--transition);
        
        /* ZERO borders, padding, margins */
        border: none;
        padding: 0;
        margin: 0;
        border-radius: 8px;
        
        /* Ensure full coverage */
        width: 100%;
        height: 100%;
        min-height: 0;
    }

    .shopee-banner-item:hover {
        transform: scale(1.02);
        z-index: 10;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    /* Banner Link - Full coverage */
    .shopee-banner-link {
        display: block;
        width: 100%;
        height: 100%;
        text-decoration: none;
        color: inherit;
        border: none;
        padding: 0;
        margin: 0;
    }

    /* SHOPEE EXACT IMAGE STYLING */
    .shopee-banner-image {
        width: 100%;
        height: 100%;
        object-fit: fill;
        object-position: center;
        display: block;
        
        /* ZERO borders/padding */
        border: none;
        padding: 0;
        margin: 0;
        border-radius: 8px;
        
        /* Smooth transitions */
        transition: transform 0.3s ease;
    }

    .shopee-banner-item:hover .shopee-banner-image {
        transform: scale(1.05);
    }

    /* Shopee Carousel Container */
    .shopee-carousel-container {
        position: relative;
        width: 100%;
        height: 400px;
        overflow: hidden;
        border-radius: 8px;
        background: transparent;
    }

    .shopee-carousel-container .carousel {
        height: 100%;
    }

    .shopee-carousel-container .carousel-inner {
        height: 100%;
        border-radius: 8px;
    }

    .shopee-carousel-container .carousel-item {
        height: 100%;
    }

    /* Shopee Style Controls */
    .carousel-control-prev,
    .carousel-control-next {
        width: auto;
        padding: 0;
        background: none;
        border: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .shopee-carousel-container:hover .carousel-control-prev,
    .shopee-carousel-container:hover .carousel-control-next {
        opacity: 1;
    }

    .shopee-control-btn {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        transition: var(--transition);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        border: none;
    }

    .shopee-control-btn:hover {
        background: var(--shopee-orange);
        color: white;
        transform: scale(1.1);
    }

    /* Shopee Style Indicators */
    .shopee-indicators {
        bottom: 12px;
        margin-bottom: 0;
    }

    .shopee-indicators button {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        border: none;
        margin: 0 2px;
        transition: var(--transition);
    }

    .shopee-indicators button.active {
        width: 20px;
        border-radius: 10px;
        background: white;
    }

    /* Responsive Design - Shopee Style */
    @media (max-width: 1200px) {
        .shopee-slider-grid {
            height: 350px;
        }
        
        .shopee-carousel-container {
            height: 350px;
        }
    }

    @media (max-width: 991px) {
        .hero-shopee-exact {
            padding: 15px 0;
        }

        .shopee-slider-grid {
            height: 300px;
            gap: 3px;
        }
        
        .shopee-carousel-container {
            height: 300px;
        }

        .shopee-side-grid {
            gap: 3px;
        }

        .shopee-bottom-grid {
            gap: 3px;
        }

        .shopee-control-btn {
            width: 35px;
            height: 35px;
        }

        .shopee-banner-item:hover {
            transform: scale(1.01);
        }
    }

    @media (max-width: 767px) {
        .shopee-slider-grid {
            height: 250px;
            gap: 2px;
        }
        
        .shopee-carousel-container {
            height: 250px;
        }

        /* Mobile: Stack layouts vertically for better view */
        .two-layout {
            grid-template-columns: 1fr;
            grid-template-rows: 1fr 1fr;
            height: 300px;
        }

        .three-layout {
            grid-template-columns: 1fr;
            grid-template-rows: 2fr 1fr;
            height: 350px;
        }

        .three-layout .shopee-side-grid {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr;
        }

        .four-layout {
            grid-template-columns: 1fr;
            grid-template-rows: 2fr 1fr;
            height: 350px;
        }

        .four-layout .shopee-side-grid {
            grid-template-rows: 1fr;
            grid-template-columns: 1fr 1fr 1fr;
        }

        .shopee-bottom-grid {
            display: contents;
        }

        .shopee-side-grid {
            gap: 2px;
        }

        .shopee-control-btn {
            width: 30px;
            height: 30px;
        }

        .shopee-banner-item:hover {
            transform: none;
        }
    }

    @media (max-width: 576px) {
        .shopee-slider-grid {
            height: 200px;
        }
        
        .shopee-carousel-container {
            height: 200px;
        }

        .two-layout {
            height: 240px;
        }

        .three-layout,
        .four-layout {
            height: 280px;
        }

        .shopee-control-btn {
            width: 28px;
            height: 28px;
        }

        .shopee-indicators button {
            width: 5px;
            height: 5px;
        }

        .shopee-indicators button.active {
            width: 16px;
        }
    }

    /* Features Section */
    .features-section {
        padding: 50px 0;
        background-color: var(--white);
    }

    .features-grid {
        margin-left: -10px;
        margin-right: -10px;
    }

    .feature-column {
        padding: 10px;
    }

    .feature-card {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        text-align: center;
        height: 100%;
        transition: all 0.3s ease;
        padding: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .feature-icon-wrapper {
        margin-bottom: 12px;
        padding: 10px;
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #f0f4ff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: #416bbf;
        font-size: 20px;
        transition: all 0.3s ease;
    }

    .blue-icon {
        background-color: #416bbf;
        color: white;
    }

    .feature-card:hover .feature-icon {
        background-color: #416bbf;
        color: white;
    }

    .feature-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .feature-card h4 {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
        line-height: 1.3;
    }

    .feature-card p {
        color: #666;
        font-size: 13px;
        line-height: 1.4;
        margin-bottom: 0;
    }

    /* Continue with existing styles for other sections... */
    
    /* Big Sale Section */
    .big-sale-section {
        padding: 0;
        margin: 50px 0;
    }

    .big-sale-wrapper {
        position: relative;
        height: 550px;
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .big-sale-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        transform: scale(1.1);
        transition: transform 10s linear;
        animation: subtle-zoom 20s infinite alternate;
    }

    @keyframes subtle-zoom {
        0% {
            transform: scale(1.0);
        }
        100% {
            transform: scale(1.1);
        }
    }

    .big-sale-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, 
            rgba(0, 0, 0, 0.1) 0%, 
            rgba(0, 0, 0, 0.2) 25%,
            rgba(0, 0, 0, 0.3) 50%,
            rgba(0, 0, 0, 0.4) 75%,
            rgba(0, 0, 0, 0.5) 100%);
    }

    .big-sale-shape {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(
            circle at center,
            rgba(65, 107, 191, 0.3) 0%,
            transparent 70%
        );
        opacity: 0.6;
        mix-blend-mode: overlay;
    }

    .big-sale-particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .particle {
        position: absolute;
        background-color: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        pointer-events: none;
        opacity: 0;
        animation: float-up 15s linear infinite, fade-in-out 15s ease-in-out infinite;
    }

    @keyframes float-up {
        0% {
            transform: translateY(100%) translateX(0) rotate(0deg);
        }
        100% {
            transform: translateY(-100%) translateX(20px) rotate(360deg);
        }
    }

    @keyframes fade-in-out {
        0%, 100% {
            opacity: 0;
        }
        50% {
            opacity: 0.8;
        }
    }

    .big-sale-content {
        padding: 50px 30px;
        color: var(--white);
        position: relative;
    }

    .sale-badge-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: 25px;
    }

    .sale-badge {
        display: inline-block;
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5253 100%);
        color: white;
        font-weight: 700;
        padding: 10px 25px;
        border-radius: 50px;
        font-size: 18px;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: 0 5px 15px rgba(238, 82, 83, 0.4);
        position: relative;
    }

    .pulse-effect {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(238, 82, 83, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(238, 82, 83, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(238, 82, 83, 0);
        }
    }

    .text-glow {
        font-size: 48px;
        font-weight: 900;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 2px;
        line-height: 1.2;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.3),
                    0 0 20px rgba(65, 107, 191, 0.3),
                    0 0 30px rgba(65, 107, 191, 0.2);
        background: linear-gradient(to right, #ffffff, #abc4ffff, #ffffff);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shine 3s linear infinite;
        background-size: 200% auto;
    }

    @keyframes shine {
        to {
            background-position: 200% center;
        }
    }

    .sale-description {
        font-size: 18px;
        margin-bottom: 30px;
        opacity: 0.9;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    /* Enhanced Countdown */
    .countdown-container {
        position: relative;
        padding: 20px 0;
    }

    .countdown-container:before {
        content: '';
        position: absolute;
        width: 200px;
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(255,255,255,0.3), transparent);
        top: 0;
        left: 50%;
        transform: translateX(-50%);
    }

    .countdown-container:after {
        content: '';
        position: absolute;
        width: 200px;
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(255,255,255,0.3), transparent);
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
    }

    .countdown-row {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 30px 0;
    }

    .countdown-item {
        width: 100px;
        height: 100px;
        background: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--white);
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), 
                    inset 0 2px 0 rgba(255, 255, 255, 0.1),
                    inset 0 -3px 0 rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transform: perspective(800px) rotateX(10deg);
    }

    .countdown-value {
        font-size: 36px;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 8px;
        background: linear-gradient(180deg, #ffffff, #d0d0d0);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .countdown-label {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.8;
        font-weight: 500;
    }

    .countdown-item-shine {
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            to bottom right,
            rgba(255, 255, 255, 0) 0%,
            rgba(255, 255, 255, 0.1) 50%,
            rgba(255, 255, 255, 0) 100%
        );
        transform: rotate(45deg);
        animation: shine-rotate 6s linear infinite;
    }

    @keyframes shine-rotate {
        0% {
            transform: rotate(0deg);
            opacity: 0;
        }
        25% {
            opacity: 0.5;
        }
        50% {
            transform: rotate(180deg);
            opacity: 0;
        }
        100% {
            transform: rotate(360deg);
            opacity: 0;
        }
    }

    /* Enhanced Button */
    .sale-button-wrapper {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }

    .btn {
        border-radius: 50px;
        padding: 12px 28px;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-lg {
        padding: 14px 32px;
        font-size: 16px;
    }

    .btn-xl {
        padding: 16px 36px;
        font-size: 18px;
    }

    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
        transform: translateY(-2px);
    }

    .btn-sale {
        position: relative;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border: none;
        padding: 16px 40px;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 1px;
        border-radius: 50px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(45, 77, 138, 0.3),
                    inset 0 2px 0 rgba(255, 255, 255, 0.3);
        transition: all 0.4s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        z-index: 1;
    }

    .btn-sale:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 50%);
        z-index: -1;
    }

    .btn-sale:after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            to right,
            rgba(255, 255, 255, 0) 0%,
            rgba(255, 255, 255, 0.3) 50%,
            rgba(255, 255, 255, 0) 100%
        );
        transform: rotate(45deg);
        z-index: 0;
        transition: all 0.8s ease;
        opacity: 0;
    }

    .btn-sale:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 25px rgba(45, 77, 138, 0.4);
    }

    .btn-sale:hover:after {
        left: 100%;
        opacity: 1;
    }

    .btn-label {
        position: relative;
        z-index: 1;
    }

    .btn-icon {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        transition: transform 0.3s ease;
    }

    .btn-sale:hover .btn-icon {
        transform: translateX(5px);
    }

    .btn-glow {
        box-shadow: 0 0 20px rgba(65, 107, 191, 0.5);
    }

    .btn-glow:hover {
        box-shadow: 0 0 30px rgba(65, 107, 191, 0.7);
    }

    .btn i {
        margin-left: 8px;
    }

    /* Product Cards */
    .featured-products {
        background-color: var(--white);
    }

    .section-header {
        margin-bottom: 50px;
    }

    .section-header h2 {
        position: relative;
        display: inline-block;
        margin-bottom: 15px;
        font-size: 32px;
        font-weight: 800;
        color: var(--gray-800);
    }

    .section-header h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background-color: var(--primary);
        border-radius: 2px;
    }

    .section-header p {
        color: #6c757d;
        font-size: 18px;
        max-width: 700px;
        margin: 15px auto 0;
    }

    .product-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
        background-color: var(--white);
        transition: var(--transition);
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .product-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background-color: #dc3545;
        color: white;
        font-size: 12px;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 50px;
        z-index: 2;
    }

    .product-thumb {
        position: relative;
        padding-top: 100%; /* 1:1 Aspect Ratio */
        overflow: hidden;
        background-color: var(--gray-100);
    }

    .product-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: fill;
        padding: 7px;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-img {
        transform: scale(1.05);
    }

    .product-actions {
        position: absolute;
        right: 15px;
        top: 15px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        opacity: 0;
        transform: translateX(20px);
        transition: var(--transition);
    }

    .product-card:hover .product-actions {
        opacity: 1;
        transform: translateX(0);
    }

    .btn-action {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: var(--white);
        color: var(--gray-800);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: var(--transition);
        border: none;
    }

    .btn-action:hover {
        background-color: var(--primary);
        color: var(--white);
        transform: translateY(-2px);
    }

    .product-info {
        padding: 20px;
    }

    .product-title {
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: 600;
        line-height: 1.4;
        height: 44px;
        overflow: hidden;
    }

    .product-title a {
        color: var(--gray-800);
        text-decoration: none;
        transition: var(--transition);
    }

    .product-title a:hover {
        color: var(--primary);
    }

    .product-price {
        margin-bottom: 15px;
    }

    .price-old {
        text-decoration: line-through;
        color: #adb5bd;
        font-size: 14px;
        margin-right: 8px;
    }

    .price-new {
        color: var(--primary);
        font-weight: 700;
        font-size: 18px;
    }

    .price-contact {
        color: var(--primary);
        font-weight: 600;
        font-size: 16px;
    }

    .product-footer {
        margin-top: 15px;
    }

    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .btn-sm {
        padding: 8px 18px;
        font-size: 14px;
    }

    /* Modern Modal */
    .modern-modal .modal-content {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .modern-modal .btn-close {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: rgba(0, 0, 0, 0.3);
        color: var(--white);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        opacity: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border: none;
    }

    .modern-modal .btn-close:hover {
        background-color: #dc3545;
    }

    /* Animation Classes */
    .wow {
        visibility: hidden;
    }

    section {
        padding: 70px 0;
    }

    @media (max-width: 767px) {
        section {
            padding: 40px 0;
        }
    }
</style>

<!-- Include WOW.js for animation effects -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize WOW.js for animations
        new WOW().init();
        
        // Product card click functionality
        const productCards = document.querySelectorAll('.product-card');
        
        productCards.forEach(card => {
            card.addEventListener('click', function(e) {
                // Don't navigate if clicked on a button or link
                if (!e.target.closest('button') && !e.target.closest('a')) {
                    const url = this.getAttribute('data-href');
                    if (url) window.location.href = url;
                }
            });
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a.scroll-down').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>

@endsection