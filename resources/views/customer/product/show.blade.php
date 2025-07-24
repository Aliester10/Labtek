@extends('layouts.customer.master')

@section('content')

@include('customer.partials.order.order__messages')

<!-- Premium Product Details Section with Modern Design -->
<section class="product-details-section">
    <div class="container">
        <!-- Product Breadcrumb -->
        <nav aria-label="breadcrumb" class="product-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                @if($product->Category)
                    <li class="breadcrumb-item"><a href="{{ route('shop', ['category' => $product->Category->slug]) }}">{{ $product->Category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="product-main-content">
            <div class="row">
                <!-- Product Gallery Column -->
                <div class="col-lg-6 col-md-6">
                    <div class="product-gallery">
                        <!-- Main Image with Magnifier -->
                        <div class="product-gallery-main">
                            @if($images->isNotEmpty())
                                <div class="gallery-primary-image" id="galleryMainImage">
                                    <img src="{{ asset($images->first()->images) }}" alt="{{ $product->name }}" id="mainProductImage">
                                    <div class="image-zoom-lens" id="zoomLens"></div>
                                    <div class="image-zoom-result" id="zoomResult"></div>
                                    <span class="zoom-icon"><i class="fa fa-search-plus"></i></span>
                                </div>
                            @else
                                <div class="gallery-primary-image no-image">
                                    <img src="https://via.placeholder.com/600x600" alt="{{ $product->name }}">
                                </div>
                            @endif
                        </div>

                        <!-- Thumbnail Gallery -->
                        @if($images->count() > 1)
                            <div class="product-gallery-thumbs">
                                <div class="swiper-container gallery-thumbs">
                                    <div class="swiper-wrapper">
                                        @foreach($images as $index => $image)
                                            <div class="swiper-slide {{ $index === 0 ? 'active' : '' }}" data-image="{{ asset($image->images) }}">
                                                <img src="{{ asset($image->images) }}" alt="{{ $product->name }} - {{ __('messages.image') }} {{ $index + 1 }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Details Column -->
                <div class="col-lg-6 col-md-6">
                    <div class="product-details">
                        <h1 class="product-title">{{ $product->name }}</h1>
                        
                        <!-- Product Rating -->
                        <div class="product-rating">
                            @if ($averageRating && $totalRatings)
                                <div class="rating-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $averageRating)
                                            <i class="fas fa-star"></i>
                                        @elseif ($i > $averageRating && $i < $averageRating + 1)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="rating-count">{{ number_format($averageRating, 1) }}/5 ({{ $totalRatings }} {{ __('messages.reviews') }})</span>
                            @else
                                <div class="rating-stars empty">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="rating-count">{{ __('messages.no_reviews_yet') }}</span>
                            @endif
                        </div>
                        
                        <!-- Product Price -->
                        <div class="product-price-wrapper">
                            @if ($product->is_price_displayed === 'yes')
                                @php
                                    // Determine the final price to display
                                    $finalPrice = $product->price;
                                    $isBigSaleProduct = isset($activeBigSale) && $activeBigSale->products->contains($product->id);

                                    if ($isBigSaleProduct) {
                                        // Apply Big Sale discount
                                        if ($activeBigSale->discount_amount) {
                                            $finalPrice = $product->price - $activeBigSale->discount_amount;
                                        } elseif ($activeBigSale->discount_percentage) {
                                            $finalPrice = $product->price - ($activeBigSale->discount_percentage / 100) * $product->price;
                                        }
                                    } elseif ($product->discount_price > 0) {
                                        // If no Big Sale, use product-specific discount price
                                        $finalPrice = $product->discount_price;
                                    }

                                    // Calculate discount percentage for display purposes
                                    $discountPercentage = ($product->price > $finalPrice) ? round((($product->price - $finalPrice) / $product->price) * 100) : null;
                                @endphp

                                {{-- Display Price --}}
                                @if ($isBigSaleProduct || $product->discount_price > 0)
                                    <div class="price-container">
                                        <div class="price-current">Rp{{ number_format($finalPrice, 0, ',', '.') }}</div>
                                        <div class="price-original">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                                        <div class="price-discount">
                                            <span class="discount-badge">{{ $discountPercentage }}% {{ __('off') }}</span>
                                            @if($isBigSaleProduct)
                                                <span class="sale-badge">{{ __('messages.big_sale') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="price-container">
                                        <div class="price-current single">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                                    </div>
                                @endif
                            @else
                                <div class="price-container">
                                    <div class="price-contact">{{ __('messages.contact_admin_for_price') }}</div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Product Stock Status -->
                        <div class="product-stock">
                            @if($product->stock > 10)
                                <span class="in-stock"><i class="fas fa-check-circle"></i> {{ __('messages.stock_available') }}</span>
                            @elseif($product->stock > 0)
                                <span class="limited-stock"><i class="fas fa-exclamation-circle"></i> {{ __('messages.stock_limited') }} ({{ $product->stock }} {{ __('messages.remaining') }})</span>
                            @else
                                <span class="out-of-stock"><i class="fas fa-times-circle"></i> {{ __('messages.stock_out') }}</span>
                            @endif
                        </div>
                        
                        <!-- Product Attributes -->
                        <div class="product-attributes">
                            <div class="attribute-row">
                                <div class="attribute-label">{{ __('messages.category') }}:</div>
                                <div class="attribute-value">{{ $product->Category ? $product->Category->name : 'N/A' }}</div>
                            </div>
                            <div class="attribute-row">
                                <div class="attribute-label">{{ __('messages.sub_category') }}:</div>
                                <div class="attribute-value">{{ $product->subCategory ? $product->subCategory->name : 'N/A' }}</div>
                            </div>
                            @if($product->brand)
                            <div class="attribute-row">
                                <div class="attribute-label">{{ __('messages.brand') }}:</div>
                                <div class="attribute-value">{{ $product->brand }}</div>
                            </div>
                            @endif
                            @if ($product->e_catalog_link)
                            <div class="attribute-row">
                                <div class="attribute-label">{{ __('messages.ecatalog') }}:</div>
                                <div class="attribute-value">
                                    @php
                                        $url = $product->e_catalog_link;
                                        if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
                                            $url = 'http://' . $url;
                                        }
                                    @endphp
                                    <a href="{{ $url }}" target="_blank" class="catalog-link">
                                        <i class="fa fa-external-link-alt"></i> {{ Str::limit($product->e_catalog_link, 30) }}
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Add to Cart Section -->
                        <div class="product-actions {{ $product->stock == 0 ? 'disabled' : '' }}">
                            <!-- Quantity Selector -->
                            <div class="product-quantity">
                                <div class="quantity-label">{{ __('messages.quantity') }}</div>
                                <div class="quantity-selector">
                                    <button type="button" class="quantity-btn minus" {{ $product->stock == 0 ? 'disabled' : '' }}><i class="fa fa-minus"></i></button>
                                    <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock }}" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                    <button type="button" class="quantity-btn plus" {{ $product->stock == 0 ? 'disabled' : '' }}><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                @auth
                                    <button type="button" class="btn-add-to-cart {{ $product->stock == 0 ? 'disabled' : '' }}" id="add-to-cart" data-id="{{ $product->id }}" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                        <i class="fa fa-shopping-cart"></i> 
                                        {{ $product->stock == 0 ? __('messages.stock_out_message') : __('messages.add_to_cart') }}
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="btn-add-to-cart {{ $product->stock == 0 ? 'disabled' : '' }}">
                                        <i class="fa fa-shopping-cart"></i>
                                        {{ $product->stock == 0 ? __('messages.stock_out_message') : __('messages.add_to_cart') }}
                                    </a>
                                @endauth
                                
                                <button type="button" class="btn-wishlist {{ $isFavorite ? 'active' : '' }}" data-product-id="{{ $product->id }}">
                                    <i class="fa{{ $isFavorite ? 's' : 'r' }} fa-heart"></i>
                                </button>
                                
                                <button type="button" class="btn-share" data-bs-toggle="modal" data-bs-target="#shareModal">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                            
                            <!-- Subtotal Display -->
                            <div class="product-subtotal {{ $product->stock == 0 ? 'hidden' : '' }}" id="subtotalContainer">
                                <span class="subtotal-label">{{ __('messages.subtotal') }}:</span>
                                <span class="subtotal-value" id="subtotal">Rp{{ number_format($product->discount_price > 0 ? $product->discount_price : $product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <!-- Product Guarantee -->
                        <div class="product-guarantee">
                            <div class="guarantee-item">
                                <i class="fas fa-truck"></i>
                                <span>{{ __('messages.fast_delivery') }}</span>
                            </div>
                            <div class="guarantee-item">
                                <i class="fas fa-shield-alt"></i>
                                <span>{{ __('messages.authentic_product') }}</span>
                            </div>
                            <div class="guarantee-item">
                                <i class="fas fa-headset"></i>
                                <span>{{ __('messages.customer_service') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Product Details Tabs -->
        <div class="product-tabs-section">
            <ul class="nav nav-tabs product-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab" aria-controls="specifications" aria-selected="true">
                        <i class="fas fa-clipboard-list"></i> {{ __('messages.specifications') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="additional-info-tab" data-bs-toggle="tab" data-bs-target="#additional-info" type="button" role="tab" aria-controls="additional-info" aria-selected="false">
                        <i class="fas fa-info-circle"></i> {{ __('messages.additional_info') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">
                        <i class="fas fa-star"></i> {{ __('messages.reviews') }} 
                        <span class="review-count">{{ $product->reviews->count() }}</span>
                    </button>
                </li>
            </ul>
            
            <div class="tab-content product-tabs-content">
                <!-- Specifications Tab -->
                <div class="tab-pane fade show active" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                    <div class="tab-inner-content">
                        <h3>{{ __('messages.product_information') }}</h3>
                        <div class="product-specifications">
                            {!! $product->product_specifications !!}
                        </div>
                    </div>
                </div>
                
                <!-- Additional Information Tab -->
                <div class="tab-pane fade" id="additional-info" role="tabpanel" aria-labelledby="additional-info-tab">
                    <div class="tab-inner-content">
                        <h3>{{ __('messages.additional_info') }}</h3>
                        <div class="product-additional-info">
                            <table class="table info-table">
                                <tbody>
                                    @if($product->product_type)
                                        <tr>
                                            <th>{{ __('messages.product_type') }}:</th>
                                            <td>{{ $product->product_type }}</td>
                                        </tr>
                                    @endif
                                    @if($product->stock)
                                        <tr>
                                            <th>{{ __('messages.stock') }}:</th>
                                            <td>{{ $product->stock }}</td>
                                        </tr>
                                    @endif
                                    @if($product->product_expiration_date)
                                        <tr>
                                            <th>{{ __('messages.expiration_date') }}:</th>
                                            <td>{{ $product->product_expiration_date }}</td>
                                        </tr>
                                    @endif
                                    @if($product->brand)
                                        <tr>
                                            <th>{{ __('messages.brand') }}:</th>
                                            <td>{{ $product->brand }}</td>
                                        </tr>
                                    @endif
                                    @if($product->provider_product_number)
                                        <tr>
                                            <th>{{ __('messages.provider_product_number') }}:</th>
                                            <td>{{ $product->provider_product_number }}</td>
                                        </tr>
                                    @endif
                                    @if($product->measurement_unit)
                                        <tr>
                                            <th>{{ __('messages.measurement_unit') }}:</th>
                                            <td>{{ $product->measurement_unit }}</td>
                                        </tr>
                                    @endif
                                    @if($product->tool_type)
                                        <tr>
                                            <th>{{ __('messages.product_type') }}:</th>
                                            <td>{{ $product->tool_type }}</td>
                                        </tr>
                                    @endif
                                    @if($product->kbki_code)
                                        <tr>
                                            <th>{{ __('messages.kbki_code') }}:</th>
                                            <td>{{ $product->kbki_code }}</td>
                                        </tr>
                                    @endif
                                    @if($product->tkdn_value)
                                        <tr>
                                            <th>{{ __('messages.tkdn_value') }}:</th>
                                            <td>{{ $product->tkdn_value }}</td>
                                        </tr>
                                    @endif
                                    @if($product->sni_number)
                                        <tr>
                                            <th>{{ __('messages.sni_number') }}:</th>
                                            <td>{{ $product->sni_number }}</td>
                                        </tr>
                                    @endif
                                    @if($product->product_warranty)
                                        <tr>
                                            <th>{{ __('messages.product_warranty') }}:</th>
                                            <td>{{ $product->product_warranty }}</td>
                                        </tr>
                                    @endif
                                    @if($product->sni)
                                        <tr>
                                            <th>{{ __('messages.sni') }}:</th>
                                            <td>{{ $product->sni }}</td>
                                        </tr>
                                    @endif
                                    @if($product->function_test)
                                        <tr>
                                            <th>{{ __('messages.function_test') }}:</th>
                                            <td>{{ $product->function_test }}</td>
                                        </tr>
                                    @endif
                                    @if($product->has_svlk)
                                        <tr>
                                            <th>{{ __('messages.has_svlk') }}:</th>
                                            <td>{{ $product->has_svlk }}</td>
                                        </tr>
                                    @endif
                                    @if($product->function)
                                        <tr>
                                            <th>{{ __('messages.function') }}:</th>
                                            <td>{{ $product->function }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="review-tab">
                    <div class="tab-inner-content">
                        <div class="reviews-section">
                            <h3>{{ __('messages.customer_reviews') }}</h3>
                            
                            <!-- Reviews Summary -->
                            <div class="reviews-summary">
                                <div class="summary-stats">
                                    <div class="average-rating">
                                        <span class="rating-value">{{ $averageRating ? number_format($averageRating, 1) : '0.0' }}</span>
                                        <span class="rating-max">/5</span>
                                    </div>
                                    <div class="rating-stars-large">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($averageRating && $i <= $averageRating)
                                                <i class="fas fa-star"></i>
                                            @elseif ($averageRating && $i > $averageRating && $i < $averageRating + 1)
                                                <i class="fas fa-star-half-alt"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="total-reviews">
                                        {{ $totalRatings ?? 0 }} {{ __('messages.reviews') }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Reviews List -->
                            <div class="reviews-list">
                                @if ($product->reviews->isNotEmpty())
                                    @foreach ($product->reviews as $review)
                                        <div class="review-item">
                                            <div class="review-header">
                                                <div class="reviewer-info">
                                                    <img src="{{ $review->user->foto_profile ? asset($review->user->foto_profile) : asset('assets/images/default-avatar.png') }}" 
                                                         alt="Avatar" class="reviewer-avatar">
                                                    <div class="reviewer-details">
                                                        <h4>{{ $review->user->name }}</h4>
                                                        @if ($review->user->userDetail && $review->user->userDetail->perusahaan)
                                                            <span class="reviewer-company">{{ $review->user->userDetail->perusahaan }}</span>
                                                        @endif
                                                        <div class="review-meta">
                                                            <div class="review-date">
                                                                <i class="far fa-calendar-alt"></i> {{ $review->created_at->format('d M Y') }}
                                                            </div>
                                                            <div class="review-rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $review->rating)
                                                                        <i class="fas fa-star"></i>
                                                                    @else
                                                                        <i class="far fa-star"></i>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-content">
                                                <p>{{ $review->content }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="no-reviews">
                                        <div class="no-reviews-icon">
                                            <i class="far fa-comment-dots"></i>
                                        </div>
                                        <h4>{{ __('messages.no_reviews_yet') }}</h4>
                                        <p>{{ __('messages.be_first_to_review') }}</p>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Review Form -->
                            <div class="review-form-container">
                                <h3>{{ __('messages.leave_review') }}</h3>
                                
                                @if (!$reviewExists)
                                    @if ($deliveredOrders->isNotEmpty())
                                        <form action="{{ route('review.store', ['productId' => $product->slug]) }}" method="POST" class="review-form">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $deliveredOrders->first()->id }}">
                                            <input type="hidden" name="product_id" value="{{ $product->slug }}">

                                            <div class="form-group rating-field">
                                                <label>{{ __('messages.your_rating') }}:</label>
                                                <div class="rating-selector">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                                        <label for="star{{ $i }}"><i class="fa fa-star"></i></label>
                                                    @endfor
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="review-content">{{ __('messages.your_review') }}:</label>
                                                <textarea id="review-content" name="comment" rows="5" placeholder="{{ __('messages.review_placeholder') }}" required></textarea>
                                            </div>
                                            
                                            <button type="submit" class="btn-submit-review">
                                                {{ __('messages.submit_review') }}
                                            </button>
                                        </form>
                                    @else
                                        <div class="review-notice">
                                            <p><i class="fas fa-info-circle"></i> {{ __('messages.must_purchase') }}</p>
                                        </div>
                                    @endif
                                @else
                                    <div class="review-notice">
                                        <p><i class="fas fa-check-circle"></i> {{ __('messages.already_reviewed') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Improved Related Products Section -->
        @if($relatedProducts->count() > 0)
        <section class="related-products">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">{{ __('messages.other_products') }}</h2>
                    <div class="section-line"></div>
                </div>
                
                <div class="related-products-slider">
                    <!-- Tombol navigasi slider diperbaiki -->
                    <button type="button" class="slider-nav slider-prev" id="sliderPrevBtn" aria-label="{{ __('messages.previous') }}">
                        <i class="fa fa-chevron-left"></i>
                    </button>
                    <button type="button" class="slider-nav slider-next" id="sliderNextBtn" aria-label="{{ __('messages.next') }}">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                    
                    <!-- Container produk -->
                    <div class="products-container">
                        <div class="products-wrapper" id="productsWrapper">
                            @foreach ($relatedProducts as $item)
                                @if ($item instanceof \App\Models\Product)
                                    @php
                                        $imagePath = $item->images->isNotEmpty()
                                            ? $item->images->first()->images
                                            : 'assets/dummy/produck1.png';
                                    @endphp
                                    <div class="product-item">
                                        <div class="product-card">
                                            <div class="product-image-container">
                                                <img src="{{ asset($imagePath) }}" alt="{{ $item->name }}" class="product-image">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name">{{ $item->name }}</h3>
                                                <div class="product-price">Rp{{ number_format($item->price, 0, ',', '.') }}</div>
                                                <a href="{{ route('product.show', $item->slug) }}?source={{ Str::random(10) }}" class="btn-view-detail">{{ __('messages.view_detail') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Pagination dots -->
                    <div class="slider-pagination">
                        <span class="pagination-dot active"></span>
                        <span class="pagination-dot"></span>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </div>
</section>

<!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">{{ __('messages.share_product') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Product Preview -->
                <div class="share-product-preview">
                    @if($images->isNotEmpty())
                        <img src="{{ asset($images->first()->images) }}" alt="{{ $product->name }}" class="share-product-image">
                    @else
                        <img src="https://via.placeholder.com/150" alt="{{ $product->name }}" class="share-product-image">
                    @endif
                    <div class="share-product-info">
                        <h4>{{ $product->name }}</h4>
                        <div class="share-product-price">
                            @if ($product->is_price_displayed === 'yes')
                                @if($product->discount_price > 0)
                                    <span class="price-old">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="price-current">Rp{{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                @else
                                    <span class="price-current">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                @endif
                            @else
                                <span class="price-contact">{{ __('messages.contact_admin_for_price') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="share-options">
                    <h5>{{ __('messages.share_via') }}</h5>
                    <div class="share-buttons">
                        <button class="share-button whatsapp" onclick="share('WhatsApp')">
                            <i class="fab fa-whatsapp"></i>
                            <span>WhatsApp</span>
                        </button>
                        <button class="share-button telegram" onclick="share('Telegram')">
                            <i class="fab fa-telegram-plane"></i>
                            <span>Telegram</span>
                        </button>
                        <button class="share-button twitter" onclick="share('Twitter')">
                            <i class="fab fa-twitter"></i>
                            <span>Twitter</span>
                        </button>
                        <button class="share-button facebook" onclick="share('Facebook')">
                            <i class="fab fa-facebook-f"></i>
                            <span>Facebook</span>
                        </button>
                        <button class="share-button copy" onclick="copyURL()">
                            <i class="fas fa-copy"></i>
                            <span>{{ __('messages.copy_link') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notification Toasts -->
<div class="notification-container" id="notificationContainer">
    <div class="toast-notification" id="cart-notification">
        <div class="notification-icon success">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="notification-content">
            <p class="notification-message">{{ __('messages.product_added_to_cart') }}</p>
        </div>
        <button class="notification-close">&times;</button>
    </div>
    
    <div class="toast-notification" id="wishlist-notification">
        <div class="notification-icon success">
            <i class="fas fa-heart"></i>
        </div>
        <div class="notification-content">
            <p class="notification-message">{{ __('messages.product_added_to_wishlist') }}</p>
        </div>
        <button class="notification-close">&times;</button>
    </div>
    
    <div class="toast-notification" id="copy-notification">
        <div class="notification-icon info">
            <i class="fas fa-link"></i>
        </div>
        <div class="notification-content">
            <p class="notification-message">{{ __('messages.link_copied') }}</p>
        </div>
        <button class="notification-close">&times;</button>
    </div>
</div>

<!-- Product Image Viewer Modal -->
<div class="modal fade" id="imageViewerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="btn-close image-viewer-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                
                <div class="image-viewer-container">
                    <div class="swiper-container image-viewer-main">
                        <div class="swiper-wrapper">
                            @if($images->isNotEmpty())
                                @foreach($images as $image)
                                    <div class="swiper-slide">
                                        <div class="image-viewer-slide">
                                            <img src="{{ asset($image->images) }}" alt="{{ $product->name }}">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="swiper-slide">
                                    <div class="image-viewer-slide">
                                        <img src="https://via.placeholder.com/800x600" alt="{{ $product->name }}">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- Add navigation -->
                        <div class="swiper-button-next image-viewer-next"></div>
                        <div class="swiper-button-prev image-viewer-prev"></div>
                    </div>
                    
                    @if($images->count() > 1)
                        <div class="swiper-container image-viewer-thumbs">
                            <div class="swiper-wrapper">
                                @foreach($images as $image)
                                    <div class="swiper-slide">
                                        <div class="image-viewer-thumb">
                                            <img src="{{ asset($image->images) }}" alt="{{ $product->name }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS Styles -->
<style>
/* Modern Product Details Page Styling */

/* Root Variables */
:root {
    --primary-color: #416bbf;
    --secondary-color: #2d4d8a;
    --accent-color: #ff6b6b;
    --text-color: #333;
    --text-light: #666;
    --background-light: #f8f9fa;
    --background-white: #ffffff;
    --background-dark: #2c3e50;
    --border-color: #e6e6e6;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
    --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
    --shadow-md: 0 4px 8px rgba(0,0,0,0.1);
    --shadow-lg: 0 8px 16px rgba(0,0,0,0.15);
    --border-radius-sm: 4px;
    --border-radius-md: 8px;
    --border-radius-lg: 16px;
    --transition: all 0.3s ease;
}

/* Base Styles */
.product-details-section {
    padding: 60px 0;
    background-color: var(--background-light);
    font-family: 'Poppins', sans-serif;
    color: var(--text-color);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Breadcrumbs */
.product-breadcrumb {
    margin-bottom: 30px;
    padding: 0;
}

.breadcrumb {
    background-color: transparent;
    padding: 0;
    margin-bottom: 0;
    display: flex;
    flex-wrap: wrap;
}

.breadcrumb-item {
    font-size: 14px;
    color: var(--text-light);
}

.breadcrumb-item a {
    color: var(--text-light);
    text-decoration: none;
    transition: var(--transition);
}

.breadcrumb-item a:hover {
    color: var(--primary-color);
}

.breadcrumb-item.active {
    color: var(--primary-color);
}

.breadcrumb-item + .breadcrumb-item::before {
    content: '>';
    color: var(--text-light);
}

/* Main Content */
.product-main-content {
    background-color: var(--background-white);
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-md);
    padding: 30px;
    margin-bottom: 40px;
}

/* Product Gallery */
.product-gallery {
    position: relative;
}

.product-gallery-main {
    position: relative;
    margin-bottom: 20px;
    border-radius: var(--border-radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.gallery-primary-image {
    position: relative;
    padding-top: 100%; /* 1:1 Aspect ratio */
    overflow: hidden;
    background-color: var(--background-light);
}

.gallery-primary-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.5s ease;
}

.gallery-primary-image:hover img {
    transform: scale(1.05);
}

.zoom-icon {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background-color: rgba(255, 255, 255, 0.7);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
    z-index: 2;
}

.zoom-icon:hover {
    background-color: var(--primary-color);
    color: white;
}

/* Image Zoom */
.image-zoom-lens {
    position: absolute;
    border: 1px solid var(--primary-color);
    width: 100px;
    height: 100px;
    opacity: 0;
    background-color: rgba(255, 255, 255, 0.2);
    cursor: crosshair;
    z-index: 1;
}

.image-zoom-result {
    position: absolute;
    top: 0;
    right: -350px;
    width: 300px;
    height: 300px;
    border: 1px solid var(--border-color);
    background-color: white;
    display: none;
    z-index: 1000;
    box-shadow: var(--shadow-lg);
    overflow: hidden;
}

.gallery-primary-image:hover .image-zoom-lens {
    opacity: 1;
}

/* Thumbnails */
.product-gallery-thumbs {
    position: relative;
}

.gallery-thumbs {
    padding-bottom: 10px;
}

.gallery-thumbs .swiper-slide {
    height: 80px;
    opacity: 0.5;
    cursor: pointer;
    border-radius: var(--border-radius-sm);
    overflow: hidden;
    border: 2px solid transparent;
    transition: var(--transition);
}

.gallery-thumbs .swiper-slide.active {
    opacity: 1;
    border-color: var(--primary-color);
}

.gallery-thumbs .swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Product Details */
.product-details {
    padding-left: 20px;
}

.product-title {
    font-size: 28px;
    font-weight: 700;
    color: var(--text-color);
    margin-bottom: 15px;
    line-height: 1.3;
}

/* Product Rating */
.product-rating {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.rating-stars {
    color: var(--warning-color);
    font-size: 16px;
    margin-right: 10px;
}

.rating-stars.empty {
    color: #ddd;
}

.rating-stars i {
    margin-right: 2px;
}

.rating-count {
    color: var(--text-light);
    font-size: 14px;
}

/* Product Price */
.price-container {
    margin-bottom: 20px;
}

.price-current {
    font-size: 28px;
    font-weight: 700;
    color: var(--primary-color);
    display: inline-block;
}

.price-current.single {
    color: var(--text-color);
}

.price-original {
    font-size: 18px;
    font-weight: 400;
    color: var(--text-light);
    text-decoration: line-through;
    margin-right: 10px;
    display: inline-block;
}

.price-discount {
    margin-top: 5px;
}

.discount-badge {
    background-color: #ffebee;
    color: var(--accent-color);
    font-size: 14px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 50px;
    margin-right: 8px;
}

.sale-badge {
    background-color: var(--accent-color);
    color: white;
    font-size: 14px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 50px;
}

.price-contact {
    font-size: 20px;
    font-weight: 600;
    color: var(--primary-color);
}

/* Stock Status */
.product-stock {
    margin-bottom: 20px;
    font-weight: 500;
}

.product-stock .in-stock {
    color: var(--success-color);
}

.product-stock .limited-stock {
    color: var(--warning-color);
}

.product-stock .out-of-stock {
    color: var(--danger-color);
}

.product-stock i {
    margin-right: 5px;
}

/* Product Attributes */
.product-attributes {
    border-top: 1px solid var(--border-color);
    border-bottom: 1px solid var(--border-color);
    padding: 15px 0;
    margin-bottom: 20px;
}

.attribute-row {
    display: flex;
    margin-bottom: 8px;
}

.attribute-row:last-child {
    margin-bottom: 0;
}

.attribute-label {
    width: 120px;
    font-weight: 600;
    color: var(--text-light);
}

.attribute-value {
    flex: 1;
    color: var(--text-color);
}

.catalog-link {
    color: var(--primary-color);
    text-decoration: none;
    transition: var(--transition);
}

.catalog-link:hover {
    text-decoration: underline;
}

/* Product Actions */
.product-actions {
    margin-bottom: 20px;
}

.product-actions.disabled {
    opacity: 0.6;
    pointer-events: none;
}

/* Quantity Selector */
.product-quantity {
    margin-bottom: 15px;
}

.quantity-label {
    margin-bottom: 8px;
    font-weight: 600;
}

.quantity-selector {
    display: flex;
    align-items: center;
    border: 1px solid var(--border-color);
    border-radius: 50px;
    overflow: hidden;
    width: fit-content;
}

.quantity-btn {
    width: 40px;
    height: 40px;
    border: none;
    background-color: var(--background-light);
    cursor: pointer;
    transition: var(--transition);
}

.quantity-btn:hover {
    background-color: var(--primary-color);
    color: white;
}

.quantity-selector input {
    width: 60px;
    height: 40px;
    text-align: center;
    border: none;
    border-left: 1px solid var(--border-color);
    border-right: 1px solid var(--border-color);
}

.quantity-selector input:focus {
    outline: none;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}

.btn-add-to-cart {
    flex: 1;
    height: 50px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: var(--transition);
}

.btn-add-to-cart:hover {
    background-color: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-add-to-cart.disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

.btn-wishlist, .btn-share {
    width: 50px;
    height: 50px;
    border: 1px solid var(--border-color);
    border-radius: 50%;
    background-color: white;
    color: var(--text-light);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
}

.btn-wishlist:hover, .btn-share:hover {
    background-color: #f5f5f5;
    transform: translateY(-2px);
}

.btn-wishlist.active {
    color: var(--accent-color);
    border-color: var(--accent-color);
}

/* Subtotal */
.product-subtotal {
    margin-top: 15px;
    padding: 10px 15px;
    background-color: #f5f7fa;
    border-radius: var(--border-radius-md);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.product-subtotal.hidden {
    display: none;
}

.subtotal-label {
    font-weight: 600;
}

.subtotal-value {
    font-weight: 700;
    color: var(--primary-color);
}

/* Product Guarantee */
.product-guarantee {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
    border-top: 1px dashed var(--border-color);
    padding-top: 20px;
}

.guarantee-item {
    text-align: center;
    padding: 0 10px;
    flex: 1;
}

.guarantee-item i {
    font-size: 24px;
    color: var(--primary-color);
    margin-bottom: 8px;
    display: block;
}

.guarantee-item span {
    font-size: 13px;
    color: var(--text-light);
    display: block;
}

/* Product Tabs */
.product-tabs-section {
    background-color: var(--background-white);
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-md);
    margin-bottom: 40px;
}

.product-tabs {
    display: flex;
    border-bottom: none;
    padding: 0 30px;
}

.product-tabs .nav-item {
    margin: 0 5px;
}

.product-tabs .nav-link {
    border: none;
    border-bottom: 3px solid transparent;
    padding: 15px 25px;
    color: var(--text-light);
    font-weight: 600;
    transition: var(--transition);
    border-radius: 0;
}

.product-tabs .nav-link i {
    margin-right: 8px;
}

.product-tabs .nav-link.active {
    color: var(--primary-color);
    border-bottom-color: var(--primary-color);
    background-color: transparent;
}

.product-tabs .nav-link:hover:not(.active) {
    border-bottom-color: #ddd;
}

.review-count {
    background-color: #f0f0f0;
    color: var(--text-light);
    font-size: 12px;
    padding: 2px 6px;
    border-radius: 50px;
    margin-left: 5px;
}

.product-tabs-content {
    padding: 30px;
}

.tab-inner-content h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
    color: var(--text-color);
}

/* Product Specifications */
.product-specifications {
    color: var(--text-color);
    line-height: 1.7;
}

.product-specifications h1,
.product-specifications h2,
.product-specifications h3,
.product-specifications h4,
.product-specifications h5,
.product-specifications h6 {
    margin-bottom: 15px;
}

.product-specifications p {
    margin-bottom: 15px;
}

.product-specifications ul,
.product-specifications ol {
    margin-bottom: 15px;
    padding-left: 20px;
}

.product-specifications li {
    margin-bottom: 8px;
}

/* Additional Information Table */
.info-table {
    width: 100%;
    margin-bottom: 0;
    border-collapse: separate;
    border-spacing: 0;
}

.info-table th,
.info-table td {
    padding: 12px 15px;
    border-top: 1px solid var(--border-color);
}

.info-table tr:first-child th,
.info-table tr:first-child td {
    border-top: none;
}

.info-table th {
    width: 30%;
    font-weight: 600;
    color: var(--text-color);
    background-color: #f8f9fa;
}

/* Reviews Section */
.reviews-section {
    margin-top: 10px;
}

.reviews-summary {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
    text-align: center;
}

.summary-stats {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.average-rating {
    margin-bottom: 10px;
}

.rating-value {
    font-size: 36px;
    font-weight: 700;
    color: #333;
}

.rating-max {
    font-size: 16px;
    color: #666;
}

.rating-stars-large {
    font-size: 24px;
    color: #ffc107;
    margin-bottom: 10px;
}

.total-reviews {
    font-size: 14px;
    color: #666;
}

.no-reviews {
    text-align: center;
    padding: 40px 0;
}

.no-reviews-icon {
    font-size: 50px;
    color: #ddd;
    margin-bottom: 15px;
}

.no-reviews h4 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
}

.review-form-container {
    background-color: #f8f9fa;
    padding: 30px;
    border-radius: 8px;
    margin-top: 30px;
}

.rating-selector {
    direction: rtl;
    display: flex;
    margin-bottom: 15px;
}

.rating-selector input {
    display: none;
}

.rating-selector label {
    cursor: pointer;
    font-size: 30px;
    color: #ddd;
    padding: 0 5px;
}

.rating-selector label:hover,
.rating-selector label:hover ~ label,
.rating-selector input:checked ~ label {
    color: #ffc107;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
}

textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    resize: vertical;
}

.btn-submit-review {
    background-color: #416bbf;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-submit-review:hover {
    background-color: #2d4d8a;
}

.review-notice {
    background: white;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #416bbf;
}

.review-item {
    padding: 20px;
    border-bottom: 1px solid #eee;
}

.reviewer-info {
    display: flex;
    margin-bottom: 15px;
}

.reviewer-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 15px;
    border: 1px solid #eee;
}

.reviewer-details h4 {
    font-size: 16px;
    margin-bottom: 2px;
}

.review-meta {
    display: flex;
    gap: 15px;
    margin-top: 5px;
    align-items: center;
}

.review-date {
    font-size: 13px;
    color: #777;
}

.review-rating {
    color: #ffc107;
}

/* Share Modal */
.share-product-preview {
    display: flex;
    align-items: center;
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: var(--border-radius-md);
    margin-bottom: 20px;
}

.share-product-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: var(--border-radius-sm);
    margin-right: 15px;
}

.share-product-info h4 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
    color: var(--text-color);
}

.share-product-price .price-old {
    display: block;
    margin-bottom: 3px;
}

.share-options h5 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 15px;
    color: var(--text-color);
    text-align: center;
}

.share-buttons {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}

.share-button {
    padding: 15px;
    border: none;
    border-radius: var(--border-radius-md);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: var(--transition);
    cursor: pointer;
    color: white;
}

.share-button i {
    font-size: 20px;
}

.share-button span {
    font-size: 12px;
    font-weight: 500;
}

.share-button.whatsapp {
    background-color: #25D366;
}

.share-button.telegram {
    background-color: #0088cc;
}

.share-button.twitter {
    background-color: #1DA1F2;
}

.share-button.facebook {
    background-color: #3b5998;
}

.share-button.copy {
    background-color: #6c757d;
}

.share-button:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-sm);
}

/* Notification Toast */
.notification-container {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 300px;
    z-index: 9999;
}

.toast-notification {
    background-color: white;
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-lg);
    padding: 15px;
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    transform: translateX(120%);
    transition: transform 0.3s ease;
    position: relative;
}

.toast-notification.show {
    transform: translateX(0);
}

.notification-icon {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 14px;
}

.notification-icon.success {
    background-color: #e8f5e9;
    color: #2e7d32;
}

.notification-icon.info {
    background-color: #e3f2fd;
    color: #1565c0;
}

.notification-icon.warning {
    background-color: #fff3e0;
    color: #e65100;
}

.notification-content {
    flex: 1;
}

.notification-message {
    margin: 0;
    font-size: 14px;
    color: var(--text-color);
}

.notification-close {
    background: transparent;
    border: none;
    color: #aaa;
    font-size: 16px;
    cursor: pointer;
    padding: 0;
    margin-left: 10px;
}

/* Image Viewer Modal */
.image-viewer-modal .modal-content {
    background-color: rgba(0, 0, 0, 0.9);
    border: none;
}

.image-viewer-close {
    position: absolute;
    top: 15px;
    right: 15px;
    color: white;
    background-color: rgba(255, 255, 255, 0.2);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    transition: var(--transition);
}

.image-viewer-close:hover {
    background-color: white;
    color: black;
}

.image-viewer-container {
    padding: 30px;
}

.image-viewer-main {
    margin-bottom: 20px;
}

.image-viewer-slide {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 500px;
}

.image-viewer-slide img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
}

.image-viewer-thumbs {
    padding: 0 40px;
}

.image-viewer-thumb {
    height: 80px;
    opacity: 0.5;
    transition: var(--transition);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-viewer-thumb.active,
.image-viewer-thumb:hover {
    opacity: 1;
}

.image-viewer-thumb img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
}

.image-viewer-next,
.image-viewer-prev {
    color: white !important;
}

/* Related Products Section - Fixed */
.related-products {
    padding: 40px 0;
    background-color: #f8f9fa;
    margin-top: 40px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.section-header {
    text-align: center;
    margin-bottom: 30px;
}

.section-title {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
    position: relative;
    display: inline-block;
}

.section-line {
    width: 60px;
    height: 4px;
    background-color: #416bbf;
    margin: 0 auto;
    border-radius: 2px;
}

/* Slider Container and Navigation - Fixed */
.related-products-slider {
    position: relative;
    padding: 10px 30px;
    margin: 0 auto;
    max-width: 1200px;
}

/* Improved slider navigation buttons styling */
.slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    background-color: white;
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    display: flex !important;
    align-items: center;
    justify-content: center;
    z-index: 100;
    cursor: pointer;
    border: none;
    font-size: 18px;
    transition: all 0.3s ease;
    color: #416bbf;
}

.slider-nav:hover {
    background-color: #416bbf;
    color: white;
}

.slider-nav.disabled {
    opacity: 0.5 !important;
    cursor: not-allowed;
}

.slider-prev {
    left: -15px;
}

.slider-next {
    right: -15px;
}

/* Products Container - Fixed */
.products-container {
    overflow: hidden;
    padding: 10px 0;
}

.products-wrapper {
    display: flex;
    transition: transform 0.4s ease;
}

.product-item {
    flex: 0 0 auto;
    padding: 0 10px;
    width: calc(100% - 20px); /* Default for mobile */
}

/* Improved Product Card Styles */
.product-card {
    margin: 5px;
    height: 100%;
    display: flex;
    flex-direction: column;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    background: white;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}

/* Product Image Container */
.product-image-container {
    position: relative;
    padding-top: 100%; /* 1:1 Aspect ratio */
    background-color: #f9f9f9;
    overflow: hidden;
}

.product-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 15px;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

/* Product Body */
.product-body {
    padding: 15px;
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.product-name {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
    height: 40px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.product-price {
    font-size: 16px;
    font-weight: 700;
    color: #416bbf;
    margin-bottom: 15px;
}

.btn-view-detail {
    display: block;
    padding: 8px 16px;
    background-color: #f8f9fa;
    color: #333;
    border: 1px solid #ddd;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    margin-top: auto;
}

.btn-view-detail:hover {
    background-color: #416bbf;
    color: white;
    border-color: #416bbf;
}

/* Pagination Dots */
.slider-pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    gap: 8px;
}

.pagination-dot {
    width: 8px;
    height: 8px;
    background-color: #ccc;
    border-radius: 50%;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.pagination-dot.active {
    background-color: #416bbf;
    width: 20px;
    border-radius: 4px;
}

/* Improved Responsive Design for Related Products */
@media (min-width: 576px) {
    .product-item {
        width: calc(50% - 20px);
    }
}

@media (min-width: 768px) {
    .product-item {
        width: calc(33.333% - 20px);
    }
    
    .slider-prev {
        left: -20px;
    }
    
    .slider-next {
        right: -20px;
    }
}

@media (min-width: 992px) {
    .product-item {
        width: calc(25% - 20px);
    }
}

@media (min-width: 1200px) {
    .product-item {
        width: calc(20% - 20px);
    }
}

/* Mobile Optimizations */
@media (max-width: 767px) {
    .product-details-section {
        padding: 30px 0;
    }
    
    .product-main-content {
        padding: 15px;
    }
    
    .product-details {
        padding-left: 0;
        margin-top: 20px;
    }
    
    .product-title {
        font-size: 22px;
        line-height: 1.4;
    }
    
    .price-current {
        font-size: 24px;
    }
    
    .price-original {
        font-size: 16px;
    }
    
    .attribute-row {
        flex-direction: column;
        margin-bottom: 15px;
    }
    
    .attribute-label {
        width: 100%;
        margin-bottom: 5px;
    }
    
    .action-buttons {
        flex-wrap: wrap;
    }
    
    .btn-add-to-cart {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .btn-wishlist, .btn-share {
        width: 45px;
        height: 45px;
    }
    
    .product-guarantee {
        flex-wrap: wrap;
    }
    
    .guarantee-item {
        width: 50%;
        margin-bottom: 15px;
    }
    
    /* Better Tab Navigation on Mobile */
    .product-tabs {
        display: flex;
        padding: 0;
    }
    
    .product-tabs .nav-item {
        flex: 1;
        margin: 0;
    }
    
    .product-tabs .nav-link {
        padding: 12px 8px;
        text-align: center;
        font-size: 14px;
    }
    
    .product-tabs .nav-link i {
        display: block;
        margin: 0 auto 5px;
        text-align: center;
        font-size: 16px;
    }
    
    .product-tabs-content {
        padding: 20px 15px;
    }
    
    .review-count {
        display: none;
    }
    
    .tab-inner-content h3 {
        font-size: 18px;
        margin-bottom: 15px;
    }
    
    .info-table th {
        width: 40%;
    }
    
    .reviews-summary {
        padding: 15px;
    }
    
    .rating-value {
        font-size: 30px;
    }
    
    .rating-stars-large {
        font-size: 20px;
    }
    
    .review-form-container {
        padding: 20px 15px;
    }
    
    .rating-selector label {
        font-size: 25px;
    }
    
    .share-buttons {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .related-products-slider {
        padding: 0 20px;
    }
    
    .product-image-container {
        height: auto;
    }
}

/* Small Mobile Optimizations */
@media (max-width: 480px) {
    .product-breadcrumb {
        margin-bottom: 15px;
        font-size: 12px;
    }
    
    .gallery-primary-image {
        height: 250px;
    }
    
    .section-title {
        font-size: 20px;
    }
    
    .share-product-preview {
        flex-direction: column;
        text-align: center;
    }
    
    .share-product-image {
        margin-right: 0;
        margin-bottom: 10px;
    }
    
    .share-buttons {
        gap: 8px;
    }
    
    .btn-view-detail {
        padding: 6px 12px;
        font-size: 12px;
    }
}

/* Fix for notification-container to avoid covering mobile menu button */
@media (max-width: 991px) {
    .notification-container {
        top: 70px !important; /* Move below header */
        right: 10px !important;
        width: auto !important;
        max-width: 280px !important;
        z-index: 1040 !important; /* Lower z-index than header */
    }
    
    /* Ensure header and mobile menu toggle have higher z-index */
    header, 
    .navbar-toggler,
    .mobile-menu-toggle,
    .navbar-collapse,
    .site-header,
    .header-mobile,
    .header-container,
    .header-wrapper {
        z-index: 1050 !important;
        position: relative !important;
    }
    
    /* Any menu toggle button should be clickable */
    .btn-menu,
    .navbar-toggler-icon,
    .menu-toggle {
        position: relative !important;
        z-index: 1060 !important;
    }
}

/* For very small screens */
@media (max-width: 400px) {
    .notification-container {
        top: 60px !important;
        left: 10px !important;
        right: 10px !important;
        width: auto !important;
    }
    
    .toast-notification {
        width: 100% !important;
    }
}
</style>

<!-- JavaScript for Interactive Features -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== Image Gallery =====
    // Thumbnail gallery click handler
    const thumbnails = document.querySelectorAll('.gallery-thumbs .swiper-slide');
    const mainImage = document.getElementById('mainProductImage');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Update main image
            const imageUrl = this.getAttribute('data-image');
            mainImage.src = imageUrl;
            
            // Update active class
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Image zoom functionality
    const zoomContainer = document.getElementById('galleryMainImage');
    const zoomLens = document.getElementById('zoomLens');
    const zoomResult = document.getElementById('zoomResult');
    
    if (zoomContainer && zoomLens && zoomResult && window.innerWidth > 991) {
        let cx = 3; // Zoom ratio
        
        zoomContainer.addEventListener('mouseenter', function() {
            zoomResult.style.backgroundImage = "url('" + mainImage.src + "')";
            zoomResult.style.backgroundSize = (mainImage.width * cx) + "px " + (mainImage.height * cx) + "px";
            zoomResult.style.display = "block";
        });
        
        zoomContainer.addEventListener('mousemove', function(e) {
            e.preventDefault();
            let pos = getCursorPos(e);
            
            // Calculate position
            let x = pos.x - (zoomLens.offsetWidth / 2);
            let y = pos.y - (zoomLens.offsetHeight / 2);
            
            // Prevent lens from going outside the image
            if (x > mainImage.width - zoomLens.offsetWidth) {x = mainImage.width - zoomLens.offsetWidth;}
            if (x < 0) {x = 0;}
            if (y > mainImage.height - zoomLens.offsetHeight) {y = mainImage.height - zoomLens.offsetHeight;}
            if (y < 0) {y = 0;}
            
            // Set lens position
            zoomLens.style.left = x + "px";
            zoomLens.style.top = y + "px";
            
            // Set background position for zoom result
            zoomResult.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cx) + "px";
        });
        
        zoomContainer.addEventListener('mouseleave', function() {
            zoomResult.style.display = "none";
        });
        
        function getCursorPos(e) {
            let bounds = mainImage.getBoundingClientRect();
            let x = e.pageX - bounds.left - window.scrollX;
            let y = e.pageY - bounds.top - window.scrollY;
            return {x, y};
        }
    }
    
    // Open image viewer modal on click
    zoomContainer?.addEventListener('click', function() {
        const imageViewerModal = new bootstrap.Modal(document.getElementById('imageViewerModal'));
        imageViewerModal.show();
    });
    
    // ===== Quantity Selector =====
    const quantityInput = document.getElementById('quantity');
    const plusBtn = document.querySelector('.quantity-btn.plus');
    const minusBtn = document.querySelector('.quantity-btn.minus');
    
    if(quantityInput) {
        const maxStock = parseInt(quantityInput.getAttribute('max') || '0');
        
        plusBtn?.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < maxStock) {
                quantityInput.value = currentValue + 1;
                updateSubtotal();
            }
        });
        
        minusBtn?.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                updateSubtotal();
            }
        });
        
        quantityInput?.addEventListener('change', function() {
            let value = parseInt(this.value);
            
            // Ensure value is a number
            if (isNaN(value) || value < 1) {
                this.value = 1;
            } else if (value > maxStock) {
                this.value = maxStock;
                showNotification('warning', '{{ __('messages.max_quantity_reached') }}');
            }
            
            updateSubtotal();
        });
    }
    
    // Update subtotal when quantity changes
    function updateSubtotal() {
        if(!quantityInput) return;
        
        const quantity = parseInt(quantityInput.value);
        const price = {{ $product->discount_price > 0 ? $product->discount_price : $product->price }};
        const subtotal = price * quantity;
        
        // Format number with thousands separator
        const formatter = new Intl.NumberFormat('id-ID');
        const subtotalElement = document.getElementById('subtotal');
        if(subtotalElement) {
            subtotalElement.innerText = 'Rp' + formatter.format(subtotal);
        }
        
        // Show/hide subtotal container
        const subtotalContainer = document.getElementById('subtotalContainer');
        if(subtotalContainer) {
            subtotalContainer.classList.toggle('hidden', quantity === 1);
        }
    }
    
    // ===== Add to Cart Functionality =====
    const addToCartBtn = document.getElementById('add-to-cart');
    
    addToCartBtn?.addEventListener('click', function(e) {
        e.preventDefault();
        
        const productId = this.getAttribute('data-id');
        const quantity = document.getElementById('quantity')?.value || 1;
        
        fetch("{{ route('cart.add') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('success', '{{ __('messages.product_added_to_cart') }}');
                
                // Update cart count in navbar if it exists
                const cartCountElement = document.querySelector('.notification');
                if (cartCountElement) {
                    const currentCount = parseInt(cartCountElement.innerText || '0');
                    cartCountElement.innerText = currentCount + parseInt(quantity);
                }
            } else {
                showNotification('warning', data.error || '{{ __('messages.failed_add_to_cart') }}');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('warning', '{{ __('messages.failed_add_to_cart') }}');
        });
    });
    
    // ===== Wishlist Functionality =====
    const wishlistBtn = document.querySelector('.btn-wishlist');
    
    wishlistBtn?.addEventListener('click', function() {
        const productId = this.getAttribute('data-product-id');
        
        fetch('{{ route('wishlist.add') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: productId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.classList.add('active');
                const icon = this.querySelector('i');
                if (icon) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                }
                showNotification('success', data.message || '{{ __('messages.product_added_to_wishlist') }}');
            } else {
                showNotification('info', data.message || '{{ __('messages.product_already_in_wishlist') }}');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('warning', '{{ __('messages.failed_add_to_wishlist') }}');
        });
    });
    
    // ===== Share Functionality =====
    window.share = function(platform) {
        const url = window.location.href;
        const productName = "{{ $product->name }}";
        const message = `${productName} - {{ __('messages.check_this_product') }}`;
        
        let shareUrl;
        
        switch (platform) {
            case 'WhatsApp':
                shareUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(message + ' ' + url)}`;
                break;
            case 'Telegram':
                shareUrl = `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(message)}`;
                break;
            case 'Twitter':
                shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(message)}&url=${encodeURIComponent(url)}`;
                break;
            case 'Facebook':
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                break;
        }
        
        if (shareUrl) {
            window.open(shareUrl, '_blank');
        }
    };
    
    window.copyURL = function() {
        const url = window.location.href;
        
        // Create a temporary input element to copy URL
        const tempInput = document.createElement('input');
        tempInput.value = url;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        
        showNotification('info', '{{ __('messages.link_copied') }}');
    };
    
    // ===== Notification System =====
    function showNotification(type, message) {
        let notificationId;
        
        switch (type) {
            case 'success':
                notificationId = 'cart-notification';
                break;
            case 'info':
                notificationId = 'copy-notification';
                break;
            case 'warning':
                notificationId = 'wishlist-notification';
                break;
            default:
                notificationId = 'cart-notification';
        }
        
        const notification = document.getElementById(notificationId);
        if (!notification) return;
        
        const messageElement = notification.querySelector('.notification-message');
        if (messageElement) {
            messageElement.textContent = message;
        }
        
        notification.classList.add('show');
        
        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    }
    
    // Close notification on click
    document.querySelectorAll('.notification-close').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.toast-notification').classList.remove('show');
        });
    });
    
    // ===== Rating System =====
    const ratingInputs = document.querySelectorAll('.rating-selector input');
    
    ratingInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Add 'checked' class to the selected star and all stars before it
            const stars = document.querySelectorAll('.rating-selector label');
            stars.forEach(star => star.classList.remove('checked'));
            
            let selectedRating = this.value;
            for (let i = 5; i >= selectedRating; i--) {
                const star = document.querySelector(`label[for="star${i}"]`);
                if (star) {
                    star.classList.add('checked');
                }
            }
        });
    });
    
    // ===== Product Tabs =====
    // Remember active tab on page reload using localStorage
    const tabLinks = document.querySelectorAll('.product-tabs .nav-link');
    const tabContents = document.querySelectorAll('.product-tabs-content .tab-pane');
    
    // Set default active tab if no tab is stored
    if (!localStorage.getItem('activeProductTab')) {
        localStorage.setItem('activeProductTab', 'specifications');
    }
    
    // Set active tab based on localStorage
    const activeTabId = localStorage.getItem('activeProductTab');
    tabLinks.forEach(link => {
        const tabId = link.getAttribute('data-bs-target')?.replace('#', '');
        if (tabId && tabId === activeTabId) {
            link.classList.add('active');
            const tabContent = document.getElementById(tabId);
            if (tabContent) {
                tabContent.classList.add('show', 'active');
            }
        } else {
            link.classList.remove('active');
            if (tabId) {
                const tabContent = document.getElementById(tabId);
                if (tabContent) {
                    tabContent.classList.remove('show', 'active');
                }
            }
        }
    });
    
    // Store active tab when clicked
    tabLinks.forEach(link => {
        link.addEventListener('click', function() {
            const tabId = this.getAttribute('data-bs-target')?.replace('#', '');
            if (tabId) {
                localStorage.setItem('activeProductTab', tabId);
            }
        });
    });
    
    // ===== Fixed Related Products Slider =====
    function initializeRelatedProductsSlider() {
        const sliderWrapper = document.getElementById('productsWrapper');
        const prevButton = document.getElementById('sliderPrevBtn');
        const nextButton = document.getElementById('sliderNextBtn');
        const productItems = document.querySelectorAll('.product-item');
        const paginationDots = document.querySelectorAll('.pagination-dot');
        
        // Jika tidak menemukan elemen yang dibutuhkan, keluar dari fungsi
        if (!sliderWrapper || productItems.length === 0) return;
        
        // Variabel slider
        let currentIndex = 0;
        let itemWidth = 0;
        let itemsPerPage = 1;
        let maxIndex = 0;
        
        // Hitung item per halaman berdasarkan ukuran layar
        function calculateItemsPerPage() {
            const windowWidth = window.innerWidth;
            
            if (windowWidth >= 1200) return 5;
            if (windowWidth >= 992) return 4;
            if (windowWidth >= 768) return 3;
            if (windowWidth >= 576) return 2;
            return 1;
        }
        
        // Perbarui properti slider
        function updateSliderProperties() {
            itemsPerPage = calculateItemsPerPage();
            // Hitung ulang lebar item termasuk margin dan padding
            if (productItems.length === 0) return;
            
            const firstItem = productItems[0];
            const style = window.getComputedStyle(firstItem);
            const marginRight = parseInt(style.marginRight) || 0;
            const marginLeft = parseInt(style.marginLeft) || 0;
            const paddingRight = parseInt(style.paddingRight) || 0;
            const paddingLeft = parseInt(style.paddingLeft) || 0;
            
            // Calculate total width including all spacing
            itemWidth = firstItem.offsetWidth + marginRight + marginLeft;
            maxIndex = Math.max(0, productItems.length - itemsPerPage);
            
            // Pastikan currentIndex tidak melebihi maxIndex
            if (currentIndex > maxIndex) {
                currentIndex = maxIndex;
            }
            
            updateSliderPosition();
        }
        
        // Perbarui posisi slider
        function updateSliderPosition() {
            if (!sliderWrapper) return;
            
            const translateX = currentIndex * itemWidth;
            sliderWrapper.style.transform = `translateX(-${translateX}px)`;
            
            // Perbarui status tombol navigasi
            if (prevButton) {
                if (currentIndex <= 0) {
                    prevButton.classList.add('disabled');
                } else {
                    prevButton.classList.remove('disabled');
                }
            }
            
            if (nextButton) {
                if (currentIndex >= maxIndex) {
                    nextButton.classList.add('disabled');
                } else {
                    nextButton.classList.remove('disabled');
                }
            }
            
            // Perbarui pagination dots
            if (paginationDots && paginationDots.length > 0) {
                paginationDots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === (currentIndex > 0 ? 1 : 0));
                });
            }
        }
        
        // Event listener untuk tombol sebelumnya
        if (prevButton) {
            prevButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (currentIndex > 0) {
                    currentIndex--;
                    updateSliderPosition();
                }
            });
        }
        
        // Event listener untuk tombol berikutnya
        if (nextButton) {
            nextButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (currentIndex < maxIndex) {
                    currentIndex++;
                    updateSliderPosition();
                }
            });
        }
        
        // Event listener untuk pagination dots
        if (paginationDots && paginationDots.length > 0) {
            paginationDots.forEach((dot, index) => {
                dot.addEventListener('click', function() {
                    currentIndex = index * itemsPerPage;
                    if (currentIndex > maxIndex) currentIndex = maxIndex;
                    updateSliderPosition();
                });
            });
        }
        
        // Perbarui slider saat resize window
        window.addEventListener('resize', updateSliderProperties);
        
        // Initialize slider with a small delay to ensure DOM is fully loaded
        setTimeout(() => {
            updateSliderProperties();
        }, 300);
    }
    
    // Initialize the related products slider
    initializeRelatedProductsSlider();
    
    // ===== Review Tab - Fix texts and functionality =====
    const reviewTab = document.getElementById('review-tab');
    if (reviewTab) {
        reviewTab.addEventListener('click', function() {
            // Ensure tab is activated and content is shown
            const reviewsPane = document.getElementById('reviews');
            if (reviewsPane) {
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.remove('show', 'active');
                });
                reviewsPane.classList.add('show', 'active');
                
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.remove('active');
                });
                reviewTab.classList.add('active');
            }
        });
    }
    
    // ===== Initialize Image Viewer Swiper =====
    if (typeof Swiper !== 'undefined') {
        // Image viewer gallery
        const imageViewerThumbs = new Swiper('.image-viewer-thumbs', {
            spaceBetween: 10,
            slidesPerView: 5,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });
        
        const imageViewerMain = new Swiper('.image-viewer-main', {
            spaceBetween: 10,
            navigation: {
                nextEl: '.image-viewer-next',
                prevEl: '.image-viewer-prev',
            },
            thumbs: {
                swiper: imageViewerThumbs
            }
        });
    }
    
    // ===== Fix notification container to avoid covering header elements =====
    const notificationContainer = document.getElementById('notificationContainer');
    const header = document.querySelector('header');
    
    if (notificationContainer && header) {
        // Ensure notification container doesn't overlap with header
        if (window.innerWidth <= 991) {
            const headerHeight = header.offsetHeight;
            notificationContainer.style.top = (headerHeight + 10) + 'px';
        }
    }
});
</script>

<!-- Include Required Libraries for Functionality -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
@endsection