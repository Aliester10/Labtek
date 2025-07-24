@extends('layouts.customer.master')
@section('content')
<section class="product spad" style="background-color: #f8fafc; min-height: 100vh; padding: 60px 0;">
    <div class="container">
        <div class="row">
            <!-- Refined Sidebar -->
            <div class="col-lg-3 col-md-4">
                <div class="sidebar-wrapper" style="position: sticky; top: 30px;">
                    <div class="category-sidebar" style="background: white; border-radius: 16px; padding: 28px; 
                                                         box-shadow: 0 6px 20px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;">
                        <div class="sidebar-header" style="margin-bottom: 24px;">
                            <h4 style="color: #1a202c; font-weight: 700; margin: 0; font-size: 1.2rem; 
                                       display: flex; align-items: center;">
                                <div style="width: 36px; height: 36px; background: #6366f1; 
                                           border-radius: 10px; display: flex; align-items: center; justify-content: center; 
                                           margin-right: 12px;">
                                    <i class="fas fa-th-large" style="color: white; font-size: 0.85rem;"></i>
                                </div>
                                Categories
                            </h4>
                        </div>
                        <nav class="category-nav">
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                @foreach ($categories as $category)
                                    <li style="margin-bottom: 4px;">
                                        <a href="{{ route('customer.bigsale.index', ['slug' => $bigSales->slug, 'category' => $category->id]) }}"
                                           class="category-link-refined" style="display: flex; align-items: center; padding: 14px 18px; 
                                                                               color: #64748b; text-decoration: none; border-radius: 10px; 
                                                                               transition: all 0.3s ease; font-size: 0.95rem; font-weight: 500;
                                                                               border-left: 3px solid transparent;">
                                            <i class="fas fa-folder" style="margin-right: 12px; font-size: 0.8rem; 
                                                                            color: #94a3b8; transition: color 0.3s ease;"></i>
                                            <span>{{ $category->name }}</span>
                                            <i class="fas fa-chevron-right" style="margin-left: auto; font-size: 0.7rem; 
                                                                                  color: #cbd5e1; transition: all 0.3s ease;"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9 col-md-8">
                <!-- Balanced Hero Section -->
                @if($bigSales)
                <div class="hero-section" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); 
                                                border-radius: 20px; padding: 48px 40px; margin-bottom: 32px; 
                                                box-shadow: 0 10px 30px rgba(99,102,241,0.2); position: relative; overflow: hidden;">
                    <!-- Subtle Background Pattern -->
                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1; 
                                background-image: radial-gradient(circle at 30% 20%, white 1px, transparent 1px), 
                                                  radial-gradient(circle at 70% 80%, white 1px, transparent 1px);
                                background-size: 40px 40px;"></div>
                    
                    <div style="position: relative; z-index: 2; text-align: center; color: white;">
                        <div style="margin-bottom: 20px;">
                            <span style="background: rgba(255,255,255,0.2); color: white; 
                                         padding: 8px 20px; border-radius: 25px; font-size: 0.9rem; font-weight: 600; 
                                         display: inline-block; backdrop-filter: blur(10px);">
                                🔥 Special Promotion
                            </span>
                        </div>
                        <h1 style="font-size: 2.6rem; font-weight: 800; margin-bottom: 16px; 
                                   text-shadow: 0 2px 4px rgba(0,0,0,0.2); letter-spacing: -0.8px; line-height: 1.1; color: white;">
                            {{ $bigSales->title }}🔥
                        </h1>
                        <p style="color: white; font-size: 1.1rem; opacity: 1; margin: 0; font-weight: 400; max-width: 550px; margin: 0 auto;">
                            {{ __('messages.limited_time_offer') }}
                        </p>
                    </div>
                </div>
                @endif

                <!-- Refined Countdown Timer -->
                @if($bigSales)
                <div class="countdown-wrapper" style="background: white; border-radius: 20px; padding: 40px; 
                                                     margin-bottom: 32px; box-shadow: 0 6px 20px rgba(0,0,0,0.08); 
                                                     border: 1px solid #e2e8f0;">
                    <div class="countdown-header" style="text-align: center; margin-bottom: 32px;">
                        <div style="margin-bottom: 12px;">
                            <span style="background: #fef3c7; color: #d97706; 
                                         padding: 6px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                                ⏰ {{ __('messages.limited_time_offer2') }}
                            </span>
                        </div>
                        <h3 style="color: #1a202c; margin-bottom: 8px; font-weight: 700; font-size: 1.4rem;">
                            {{ __('messages.offer_ends_in') }}
                        </h3>
                        <p style="color: #64748b; font-size: 0.95rem; margin: 0;">
                            {{ __('messages.hurry_up_and_get_your_dream_product_before_its_too_late') }}
                        </p>
                    </div>
                    
                    <div class="countdown-container" style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                        <!-- Days -->
                        <div class="time-unit-refined" style="background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 16px; 
                                                             padding: 24px 28px; text-align: center; min-width: 100px; 
                                                             transition: all 0.3s ease; position: relative;">
                            <div style="position: absolute; top: 8px; right: 8px; width: 8px; height: 8px; 
                                        background: #ef4444; border-radius: 50%; opacity: 0.7;"></div>
                            <div id="days" style="font-size: 2.2rem; font-weight: 800; color: #1a202c; line-height: 1; margin-bottom: 6px;">00</div>
                            <div style="font-size: 0.8rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">{{ __('messages.days') }}</div>
                        </div>
                        
                        <!-- Hours -->
                        <div class="time-unit-refined" style="background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 16px; 
                                                             padding: 24px 28px; text-align: center; min-width: 100px; 
                                                             transition: all 0.3s ease; position: relative;">
                            <div style="position: absolute; top: 8px; right: 8px; width: 8px; height: 8px; 
                                        background: #f59e0b; border-radius: 50%; opacity: 0.7;"></div>
                            <div id="hours" style="font-size: 2.2rem; font-weight: 800; color: #1a202c; line-height: 1; margin-bottom: 6px;">00</div>
                            <div style="font-size: 0.8rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">{{ __('messages.hours') }}</div>
                        </div>
                        
                        <!-- Minutes -->
                        <div class="time-unit-refined" style="background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 16px; 
                                                             padding: 24px 28px; text-align: center; min-width: 100px; 
                                                             transition: all 0.3s ease; position: relative;">
                            <div style="position: absolute; top: 8px; right: 8px; width: 8px; height: 8px; 
                                        background: #10b981; border-radius: 50%; opacity: 0.7;"></div>
                            <div id="minutes" style="font-size: 2.2rem; font-weight: 800; color: #1a202c; line-height: 1; margin-bottom: 6px;">00</div>
                            <div style="font-size: 0.8rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">{{ __('messages.minutes') }}</div>
                        </div>
                        
                        <!-- Seconds -->
                        <div class="time-unit-refined" style="background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 16px; 
                                                             padding: 24px 28px; text-align: center; min-width: 100px; 
                                                             transition: all 0.3s ease; position: relative;">
                            <div style="position: absolute; top: 8px; right: 8px; width: 8px; height: 8px; 
                                        background: #6366f1; border-radius: 50%; opacity: 0.7;"></div>
                            <div id="seconds" style="font-size: 2.2rem; font-weight: 800; color: #1a202c; line-height: 1; margin-bottom: 6px;">00</div>
                            <div style="font-size: 0.8rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">{{ __('messages.seconds') }}</div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Products Section -->
                <div class="products-wrapper" style="background: white; border-radius: 20px; padding: 40px; 
                                                     box-shadow: 0 6px 20px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;">
                    <div class="products-header" style="text-align: center; margin-bottom: 36px;">
                        <div style="margin-bottom: 16px;">
                            <span style="background: #ecfdf5; color: #059669; 
                                         padding: 8px 20px; border-radius: 25px; font-size: 0.9rem; font-weight: 600;">
                                🛍️ Premium Collection
                            </span>
                        </div>
                        <h3 style="color: #1a202c; font-weight: 700; margin-bottom: 12px; font-size: 1.6rem; letter-spacing: -0.5px;">
                            Produk Pilihan Big Sale
                        </h3>
                        <p style="color: #64748b; font-size: 1rem; margin: 0; max-width: 500px; margin: 0 auto;">
                            {{ __('messages.koleksi') }}
                        </p>
                    </div>

                    <!-- Responsive Products Grid -->
                    <div class="products-grid row g-4">
                        @foreach($bigSales->products as $product)
                            <div class="col-lg-4 col-md-6 col-6">
                                <div class="product-card-balanced" style="background: white; border: 1px solid #e2e8f0; 
                                                                          border-radius: 16px; overflow: hidden; 
                                                                          transition: all 0.3s ease; cursor: pointer; 
                                                                          position: relative; height: 100%; display: flex; 
                                                                          flex-direction: column; box-shadow: 0 2px 8px rgba(0,0,0,0.06);"
                                     data-href="{{ route('product.show', $product->slug) }}?source={{ Str::random(10) }}">
                                    
                                    @php
                                        $imagePath = $product->images->isNotEmpty()
                                            ? $product->images->first()->images
                                            : 'path/to/default/image.jpg';
                    
                                        $finalPrice = $product->price;
                                        if ($bigSales->discount_amount) {
                                            $finalPrice -= $bigSales->discount_amount;
                                        } elseif ($bigSales->discount_percentage) {
                                            $finalPrice -= ($bigSales->discount_percentage / 100) * $product->price;
                                        }
                    
                                        $discountPercentage = ($product->price - $finalPrice) / $product->price * 100;
                                    @endphp
                    
                                    <!-- Product Image Container -->
                                    <div class="image-container" style="position: relative; aspect-ratio: 1; overflow: hidden; 
                                                                       background: #f8fafc;">
                                        <img src="{{ asset($imagePath) }}" 
                                             style="width: 100%; height: 100%; object-fit: cover; 
                                                    transition: transform 0.4s ease;"
                                             alt="{{ $product->name }}"
                                             loading="lazy">
                                        
                                        @if ($bigSales->discount_percentage || $bigSales->discount_amount)
                                            <div class="discount-badge-balanced" 
                                                 style="position: absolute; top: 12px; left: 12px; 
                                                        background: #ef4444; color: white; padding: 6px 12px; border-radius: 8px; 
                                                        font-size: 0.75rem; font-weight: 700; z-index: 2;">
                                                {{ round($discountPercentage) }}% OFF
                                            </div>
                                        @endif

                                        <!-- Simple Quick View Overlay -->
                                        <div class="quick-view-overlay-balanced" style="position: absolute; inset: 0; 
                                                                                          background: rgba(0,0,0,0.7); 
                                                                                          display: flex; align-items: center; justify-content: center;
                                                                                          opacity: 0; transition: opacity 0.3s ease;">
                                            <span style="background: white; color: #374151; padding: 10px 18px; 
                                                         border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                                                <i class="fas fa-eye"></i> Quick View
                                            </span>
                                        </div>
                                    </div>
                    
                                    <!-- Product Details -->
                                    <div class="product-details" style="padding: 18px; flex: 1; display: flex; flex-direction: column;">
                                        <h6 style="font-weight: 600; margin-bottom: 10px; color: #1a202c; 
                                                   font-size: 0.95rem; line-height: 1.3; height: 40px; overflow: hidden; 
                                                   display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                            {{ $product->name }}
                                        </h6>
                                        
                                        <div class="pricing-section" style="margin-bottom: 16px; flex: 1;">
                                            @if ($bigSales->discount_percentage || $bigSales->discount_amount)
                                                <div style="display: flex; flex-direction: column; gap: 4px;">
                                                    <span style="text-decoration: line-through; color: #9ca3af; 
                                                                font-size: 0.8rem; font-weight: 500;">
                                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                                    </span>
                                                    <span style="color: #1a202c; font-size: 1.1rem; font-weight: 700; 
                                                                letter-spacing: -0.3px;">
                                                        Rp{{ number_format($finalPrice, 0, ',', '.') }}
                                                    </span>
                                                    <span style="background: #dcfce7; color: #166534; font-size: 0.7rem; 
                                                                font-weight: 600; padding: 2px 8px; border-radius: 6px; 
                                                                align-self: flex-start;">
                                                        Hemat {{ number_format($product->price - $finalPrice, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            @else
                                                <span style="color: #1a202c; font-size: 1.1rem; font-weight: 700; 
                                                            letter-spacing: -0.3px;">
                                                    @if ($product->is_price_displayed === 'yes')
                                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                                    @else
                                                        {{ __('messages.hubungi_admin') }}
                                                    @endif
                                                </span>
                                            @endif
                                        </div>

                                        <!-- View Details Button -->
                                        <button class="view-details-btn-balanced" 
                                                onclick="window.location.href='{{ route('product.show', $product->slug) }}?source={{ Str::random(10) }}'"
                                                style="width: 100%; background: #6366f1; color: white; border: none; 
                                                       padding: 12px 18px; border-radius: 12px; font-weight: 600; 
                                                       cursor: pointer; font-size: 0.85rem; transition: all 0.3s ease; 
                                                       margin-top: auto;">
                                            <span style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                                <i class="fas fa-eye" style="font-size: 0.8rem;"></i>
                                                View Details
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Refined Category Sidebar */
.category-link-refined:hover {
    background: #f1f5f9;
    color: #6366f1 !important;
    border-left-color: #6366f1 !important;
    transform: translateX(6px);
}

.category-link-refined:hover i.fas.fa-folder {
    color: #6366f1 !important;
}

.category-link-refined:hover i.fas.fa-chevron-right {
    color: #6366f1 !important;
    transform: translateX(3px);
}

/* Refined Time Units */
.time-unit-refined:hover {
    border-color: #6366f1;
    background: #fafbff;
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(99,102,241,0.15);
}

/* Balanced Product Cards */
.product-card-balanced:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.12);
    border-color: #c7d2fe;
}

.product-card-balanced:hover .image-container img {
    transform: scale(1.06);
}

.product-card-balanced:hover .quick-view-overlay-balanced {
    opacity: 1;
}

/* Refined Button */
.view-details-btn-balanced:hover {
    background: #4f46e5 !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(99,102,241,0.25);
}

.view-details-btn-balanced:active {
    transform: translateY(0);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-section {
        padding: 40px 32px !important;
        margin-bottom: 24px !important;
    }
    
    .hero-section h1 {
        font-size: 2.2rem !important;
    }
    
    .countdown-wrapper {
        padding: 32px 28px !important;
        margin-bottom: 24px !important;
    }
    
    .countdown-container {
        gap: 16px !important;
    }
    
    .time-unit-refined {
        padding: 20px 24px !important;
        min-width: 90px !important;
    }
    
    .time-unit-refined div:nth-child(2) {
        font-size: 1.8rem !important;
    }
    
    .products-wrapper {
        padding: 32px 28px !important;
    }
}

@media (max-width: 576px) {
    .countdown-container {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        gap: 12px !important;
        max-width: 300px !important;
        margin: 0 auto !important;
    }
    
    .time-unit-refined {
        padding: 18px 20px !important;
        min-width: auto !important;
    }
    
    .time-unit-refined div:nth-child(2) {
        font-size: 1.6rem !important;
    }
    
    .hero-section {
        padding: 32px 24px !important;
    }
    
    .hero-section h1 {
        font-size: 2rem !important;
    }
    
    .countdown-wrapper {
        padding: 28px 20px !important;
    }
    
    .products-wrapper {
        padding: 28px 20px !important;
    }
    
    .category-sidebar {
        padding: 24px !important;
    }
}

/* Smooth transitions */
* {
    transition: all 0.3s ease;
}

/* Focus states for accessibility */
.view-details-btn-balanced:focus,
.category-link-refined:focus,
.product-card-balanced:focus {
    outline: 2px solid #6366f1;
    outline-offset: 2px;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb {
    background: #6366f1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: #4f46e5;
}
</style>

<script>
// Refined Countdown Timer
@if($bigSales)
function startCountdown(endTime) {
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = endTime - now;

        if (distance < 0) {
            ['days', 'hours', 'minutes', 'seconds'].forEach(id => {
                const element = document.getElementById(id);
                if (element) element.textContent = '00';
            });
            
            // Simple expired message
            document.querySelector('.countdown-wrapper').innerHTML = `
                <div style="text-align: center; padding: 50px 30px;">
                    <div style="font-size: 3.5rem; margin-bottom: 20px; color: #94a3b8;">⏰</div>
                    <h3 style="color: #ef4444; font-weight: 700; margin-bottom: 10px; font-size: 1.5rem;">
                        Penawaran Telah Berakhir
                    </h3>
                    <p style="color: #64748b; font-size: 1rem; margin: 0;">
                        Terima kasih atas antusiasme Anda. Nantikan penawaran menarik lainnya!
                    </p>
                </div>
            `;
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Simple number update
        const updateElement = (id, value) => {
            const element = document.getElementById(id);
            if (element) {
                const newValue = String(value).padStart(2, '0');
                if (element.textContent !== newValue) {
                    element.style.transform = 'scale(1.1)';
                    element.textContent = newValue;
                    setTimeout(() => {
                        element.style.transform = 'scale(1)';
                    }, 150);
                }
            }
        };

        updateElement('days', days);
        updateElement('hours', hours);
        updateElement('minutes', minutes);
        updateElement('seconds', seconds);
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
}

const bigSaleEndTime = new Date("{{ date('Y-m-d\TH:i:s', strtotime($bigSales->end_time)) }}").getTime();
startCountdown(bigSaleEndTime);
@endif

// Product Card Navigation
document.querySelectorAll('.product-card-balanced').forEach(function(card) {
    card.addEventListener('click', function(e) {
        if (!e.target.closest('.view-details-btn-balanced')) {
            this.style.opacity = '0.8';
            this.style.transform = 'scale(0.98)';
            
            setTimeout(() => {
                window.location.href = this.dataset.href;
            }, 150);
        }
    });
});

// Button click effects
document.querySelectorAll('.view-details-btn-balanced').forEach(button => {
    button.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});

// Touch feedback for mobile
document.querySelectorAll('.product-card-balanced, .view-details-btn-balanced').forEach(element => {
    element.addEventListener('touchstart', function() {
        this.style.transform = 'scale(0.98)';
    });
    
    element.addEventListener('touchend', function() {
        this.style.transform = '';
    });
});

// Smooth scroll reveal
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, { threshold: 0.1 });

document.addEventListener('DOMContentLoaded', function() {
    const productCards = document.querySelectorAll('.product-card-balanced');
    productCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `all 0.5s ease ${index * 0.1}s`;
        observer.observe(card);
    });
});
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection