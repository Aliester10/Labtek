@extends('layouts.customer.master')
@section('content')
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <!-- Mobile Filter Toggle Button -->
            <div class="d-block d-md-none mb-3">
                <button id="filter-toggle" class="btn btn-primary w-100">
                    <i class="fas fa-filter mr-2"></i> {{ __('messages.filter_options') }}
                </button>
            </div>

            <div class="row">
                <!-- Sidebar Filters -->
                <div class="col-lg-3 col-md-4" id="filter-sidebar">
                    <div class="sidebar">
                        <!-- Price Range Filter -->
                        <div class="sidebar__item filter-card">
                            <h4 class="filter-title">{{ __('messages.price_range') }}</h4>
                            <form action="{{ request()->url() }}" method="GET" id="price-filter-form">
                                <!-- Preserve existing query parameters -->
                                @foreach(request()->except(['min_price', 'max_price', 'page']) as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach

                                <div class="price-range1">
                                    <div class="form-group">
                                        <label for="min_price">{{ __('messages.min_price') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="min_price" id="min_price" placeholder="Min"
                                                value="{{ request('min_price') }}" class="form-control input-range" 
                                                oninput="formatInput(this);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="max_price" class="mt-2">{{ __('messages.max_price') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="max_price" id="max_price" placeholder="Max"
                                                value="{{ request('max_price') }}" class="form-control input-range" 
                                                oninput="formatInput(this);">
                                        </div>
                                    </div>
                                    <div class="filter-buttons">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-check mr-1"></i> {{ __('messages.apply_filter') }}
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="resetFields()" 
                                            title="{{ __('messages.refresh') }}">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Category Filter -->
                        <div class="sidebar__item filter-card">
                            <h4 class="filter-title">{{ __('messages.Category') }}</h4>
                            <ul class="filter-list">
                                <li class="{{ !request('category_slug') ? 'active-filter' : '' }}">
                                    <a href="{{ route('shop') }}">
                                        <i class="fas fa-tag mr-2"></i> {{ __('messages.all_Category') }}
                                    </a>
                                </li>
                                @foreach ($categories as $category)
                                    <li class="{{ request('category_slug') == $category->slug ? 'active-filter' : '' }}">
                                        <a href="{{ route('shop', ['category_slug' => $category->slug]) }}">
                                            <i class="fas fa-tag mr-2"></i> {{ \Illuminate\Support\Str::limit($category->name, 25, '...') }}
                                            <span class="category-count">{{ $category->products_count ?? '' }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <!-- Subcategory Filter -->
                        @if($subcategories->isNotEmpty())
                        <div class="sidebar__item filter-card">
                            <h4 class="filter-title">{{ __('messages.subCategory') }}</h4>
                            <ul class="filter-list">
                                @foreach ($subcategories as $subCategory)
                                    <li class="{{ request()->segment(3) == $subCategory->slug ? 'active-filter' : '' }}">
                                        <a href="{{ route('shop', ['category_slug' => $subCategory->category->slug, 'subcategory_slug' => $subCategory->slug]) }}">
                                            <i class="fas fa-tag mr-2"></i> {{ \Illuminate\Support\Str::limit($subCategory->name, 40, '...') }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <!-- Active Filters Summary -->
                        @if(request()->anyFilled(['min_price', 'max_price', 'category_slug', 'subcategory_slug', 'sort']))
                        <div class="sidebar__item filter-card">
                            <h4 class="filter-title">{{ __('messages.active_filters') }}</h4>
                            <div class="active-filters">
                                @if(request('min_price') || request('max_price'))
                                    <span class="filter-tag">
                                        {{ __('messages.price') }}: 
                                        @if(request('min_price') && request('max_price'))
                                            Rp{{ request('min_price') }} - Rp{{ request('max_price') }}
                                        @elseif(request('min_price'))
                                            ≥ Rp{{ request('min_price') }}
                                        @else
                                            ≤ Rp{{ request('max_price') }}
                                        @endif
                                        <a href="{{ route('shop', request()->except(['min_price', 'max_price', 'page'])) }}" class="filter-remove">×</a>
                                    </span>
                                @endif
                                
                                @if(request('category_slug'))
                                    <span class="filter-tag">
                                        {{ __('messages.category') }}: 
                                        @foreach($categories as $category)
                                            @if($category->slug === request('category_slug'))
                                                {{ $category->name }}
                                            @endif
                                        @endforeach
                                        <a href="{{ route('shop', request()->except(['category_slug', 'subcategory_slug', 'page'])) }}" class="filter-remove">×</a>
                                    </span>
                                @endif
                                
                                @if(request('sort'))
                                    <span class="filter-tag">
                                        {{ __('messages.sort_by') }}: {{ __('messages.' . request('sort')) }}
                                        <a href="{{ route('shop', request()->except(['sort', 'page'])) }}" class="filter-remove">×</a>
                                    </span>
                                @endif
                                
                                <a href="{{ route('shop') }}" class="clear-all-filters">
                                    {{ __('messages.clear_all_filters') }}
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Product Listing -->
                <div class="col-lg-9 col-md-8">
                    <!-- Sort Controls -->
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>{{ __('messages.sort_by') }}</span>
                                    <select id="sort-by" class="form-control" onchange="sortProducts()">
                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                                            {{ __('messages.newest') }}
                                        </option>
                                        <option value="oldest" {{ request('sort') == 'oldest' || !request('sort') ? 'selected' : '' }}>
                                            {{ __('messages.oldest') }}
                                        </option>
                                        <option value="price_lowest" {{ request('sort') == 'price_lowest' ? 'selected' : '' }}>
                                            {{ __('messages.price_lowest') }}
                                        </option>
                                        <option value="price_highest" {{ request('sort') == 'price_highest' ? 'selected' : '' }}>
                                            {{ __('messages.price_highest') }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ $productCount }}</span> {{ __('messages.Product_ditemukan') }}</h6>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <button class="view-mode-btn active" data-view="grid">
                                        <i class="fas fa-th"></i>
                                    </button>
                                    <button class="view-mode-btn" data-view="list">
                                        <i class="fas fa-list"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Page Message -->
                    @if($pageMessage)
                    <div class="page-message-container d-flex align-items-center justify-content-between bg-light p-3 rounded mb-4">
                        <span class="page-message-text">{{ $pageMessage }}</span>
                        <a href="{{ route('shop') }}" class="btn btn-secondary btn-sm refresh-button" style="cursor: pointer" title="{{ __('messages.refresh') }}">
                            <i class="fas fa-sync-alt"></i> {{ __('messages.refresh') }}
                        </a>
                    </div>
                    @endif
                    
                    <!-- Loading Indicator -->
                    <div id="loading-indicator" class="text-center py-5" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">{{ __('messages.loading') }}...</span>
                        </div>
                        <p class="mt-2">{{ __('messages.loading_products') }}...</p>
                    </div>
                    
                    <!-- Product List Container -->
                    <div class="row" id="product-list">
                        @if($products->isEmpty())
                        <div class="col-12 text-center">
                            <div class="empty-state py-5">
                                <i class="fas fa-box-open empty-icon"></i>
                                <p class="empty-text mt-3">{{ __('messages.tidak_ada_Product') }}</p>
                                
                                @if(isset($activeBigSale))
                                    <p class="empty-subtext">
                                        {{ __('messages.product_might_be_in_sale') }}
                                    </p>
                                    <a href="{{ route('customer.bigsale.index', ['slug' => $activeBigSale->slug]) }}" class="btn btn-primary mt-3">
                                        <i class="fas fa-tag mr-2"></i> {{ __('messages.view_sale') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        @else
                            @foreach ($products as $product)
                                <div class="col-6 col-md-6 col-lg-4 product-item-wrapper">
                                    <div class="product-card" data-href="{{ route('product.show', $product->slug) }}?source={{ Str::random(10) }}">
                                        <!-- Brand Header -->
                                        <div class="product-brand-header">
                                            ARKAMAYA GUNA SAHARSA
                                        </div>
                                        
                                        <!-- Product Image Container -->
                                        @php
                                            $imagePath = $product->images->isNotEmpty()
                                                ? $product->images->first()->images
                                                : 'assets/images/product-placeholder.jpg';
                                                
                                            $finalPrice = $product->price;
                                            $isBigSale = false;
                                            
                                            // Check if there's an active Big Sale for this product
                                            if (isset($bigSales) && $bigSales->isActive() && $bigSales->products->contains($product->id)) {
                                                $isBigSale = true;
                                                
                                                // Calculate the Big Sale discounted price
                                                if ($bigSales->discount_amount) {
                                                    $finalPrice = $product->price - $bigSales->discount_amount;
                                                } elseif ($bigSales->discount_percentage) {
                                                    $finalPrice = $product->price - ($bigSales->discount_percentage / 100 * $product->price);
                                                }
                                            } elseif ($product->discount_price) {
                                                // If no Big Sale is active, use the product's own discount price
                                                $finalPrice = $product->discount_price;
                                            }
                                
                                            // Calculate discount percentage for display purposes if a discount exists
                                            $discountPercentage = ($product->price > $finalPrice) ? round((($product->price - $finalPrice) / $product->price) * 100) : null;
                                            
                                            // Check if product is new (e.g., created within the last 14 days)
                                            $isNew = $product->created_at->diffInDays(now()) <= 14;
                                        @endphp
                                        <div class="product-image-container">
                                            <img src="{{ asset($imagePath) }}" alt="{{ $product->name }}" class="product-image">
                                            
                                            <!-- Product Badges -->
                                            <div class="product-badges">
                                                @if($discountPercentage)
                                                    <span class="badge badge-sale">-{{ $discountPercentage }}%</span>
                                                @endif
                                                
                                                @if($isNew)
                                                    <span class="badge badge-new">{{ __('messages.new') }}</span>
                                                @endif
                                                
                                                @if($isBigSale)
                                                    <span class="badge badge-big-sale">{{ __('messages.big_sale') }}</span>
                                                @endif
                                            </div>
                                            
                                            <!-- Quick Actions -->
                                            <div class="product-actions">
                                                <a href="{{ route('product.show', $product->slug) }}" class="action-btn" title="{{ __('messages.view_detail') }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @auth
                                                <button type="button" class="action-btn add-to-wishlist" 
                                                    data-product-id="{{ $product->id }}" title="{{ __('messages.add_to_wishlist') }}">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                                @endauth
                                            </div>
                                        </div>
                                        
                                        <!-- Product Info -->
                                        <div class="product-info">
                                            <h3 class="product-name">
                                                <a href="{{ route('product.show', $product->slug) }}">
                                                    {{ \Illuminate\Support\Str::limit($product->name, 45, '...') }}
                                                </a>
                                            </h3>
                                            
                                            @if($product->is_price_displayed === 'yes')
                                                <div class="product-price">
                                                    @if($discountPercentage)
                                                        <span class="original-price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                                        <span class="current-price">Rp{{ number_format($finalPrice, 0, ',', '.') }}</span>
                                                    @else
                                                        <span class="current-price">Rp{{ number_format($finalPrice, 0, ',', '.') }}</span>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="product-price contact-price">
                                                    {{ __('messages.hubungi_admin') }}
                                                </div>
                                            @endif
                                            
                                            <!-- Product Description (only visible in list view) -->
                                            <div class="product-description">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($product->product_specifications), 120, '...') }}
                                            </div>
                                        </div>
                                        
                                        <!-- Card Footer with Action Button -->
                                        <div class="product-card-footer">
                                            <a href="{{ route('product.show', $product->slug) }}?source={{ Str::random(10) }}" class="btn-view-detail">
                                                {{ __('messages.view_details') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    
                    <!-- Pagination -->
                    @if($products->hasPages())
                    <div class="pagination-container">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <!-- Previous Page Link -->
                                @if($products->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                <!-- Pagination Elements -->
                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    @if ($i == $products->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $i }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor

                                <!-- Next Page Link -->
                                @if($products->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <style>
        /* Enhanced Filter Sidebar */
        .filter-card {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        
        .filter-title {
            color: #416bbf;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
            position: relative;
        }
        
        .filter-title:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: #416bbf;
        }
        
        .filter-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .filter-list li {
            margin-bottom: 8px;
            padding: 5px 0;
            border-radius: 4px;
            transition: all 0.2s;
        }
        
        .filter-list li:hover {
            background-color: #f8f9fa;
        }
        
        .filter-list li a {
            color: #666;
            display: flex;
            align-items: center;
            text-decoration: none;
            padding: 4px 8px;
            font-size: 14px;
        }
        
        .filter-list li.active-filter {
            background-color: #e6f0ff;
        }
        
        .filter-list li.active-filter a {
            color: #416bbf;
            font-weight: 600;
        }
        
        .category-count {
            margin-left: auto;
            background-color: #f0f0f0;
            color: #666;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 12px;
        }
        
        .filter-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        .filter-buttons button {
            flex: 1;
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 4px;
        }
        
        .filter-buttons .btn-primary {
            background-color: #416bbf;
            border-color: #416bbf;
        }
        
        .filter-buttons .btn-secondary {
            background-color: #f8f9fa;
            border-color: #ddd;
            color: #333;
        }
        
        /* Product Item Wrapper */
        .product-item-wrapper {
            padding: 15px;
            margin-bottom: 15px;
        }
        
        /* Kartu produk dengan struktur yang diperbaiki */
        .product-card {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08), 0 6px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            border: none;
            transform: translateY(0);
            margin: 0; /* Hapus margin yang tidak perlu */
        }
        
        .product-card:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12), 0 8px 10px rgba(0, 0, 0, 0.08);
            transform: translateY(-5px);
        }
        
        /* Header produk dengan branding */
        .product-brand-header {
            background: #f9f9f9;
            border-bottom: 1px solid #f0f0f0;
            padding: 8px 12px;
            text-align: center;
            font-size: 12px;
            color: #777;
            font-weight: 500;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .product-brand-header img {
            height: 20px;
            margin-right: 5px;
        }
        
        /* Container gambar produk */
        .product-image-container {
            position: relative;
            padding-bottom: 100%;
            overflow: hidden;
            background-color: #ffffff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }
        
        .product-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
            padding: 5px;
            z-index: 1;
        }
        
        .product-card:hover .product-image {
            transform: scale(1.05);
        }
        
        /* Watermark logo */
        .product-image-container::after {
            content: '';
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 50px;
            height: 50px;
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.1;
            z-index: 0;
        }
        
        /* Container informasi produk */
        .product-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            background: linear-gradient(180deg, #ffffff 0%, #f9fafc 100%);
            flex-grow: 1;
        }
        
        /* Nama produk */
        .product-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 12px;
            line-height: 1.4;
            color: #333333;
            transition: color 0.3s ease;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: auto;
            min-height: 44px;
        }
        
        .product-card:hover .product-name a {
            color: #416bbf;
            text-decoration: none;
        }
        
        .product-name a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        /* Harga produk */
        .product-price {
            font-size: 18px;
            font-weight: 700;
            color: #416bbf;
            margin-bottom: 20px;
        }
        
        .original-price {
            text-decoration: line-through;
            color: #999;
            font-size: 14px;
            margin-bottom: 4px;
            display: block;
        }
        
        .current-price {
            color: #416bbf;
            font-size: 18px;
            display: block;
        }
        
        .contact-price {
            color: #666;
            font-size: 14px;
            font-style: italic;
        }
        
        /* Footer kartu dengan tombol aksi */
        .product-card-footer {
            padding: 15px 20px;
            border-top: 1px solid rgba(0,0,0,0.05);
            background: #f8f9fa;
        }
        
        /* Tombol Lihat Detail yang diperbaiki */
        .btn-view-detail {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #416bbf;
            border: none;
            padding: 12px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-view-detail::before {
            content: "\f06e"; /* Font Awesome eye icon */
            font-family: "Font Awesome 5 Free";
            margin-right: 8px;
        }
        
        .btn-view-detail:after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #416bbf 0%, #2d4d8a 100%);
            transition: all 0.4s ease;
            z-index: -1;
        }
        
        .btn-view-detail:hover {
            color: white;
        }
        
        .btn-view-detail:hover:after {
            left: 0;
        }
        
        /* Product Description */
        .product-description {
            margin-top: 10px;
            font-size: 13px;
            color: #666;
            display: none;
        }
        
        /* Active Filters */
        .active-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .filter-tag {
            background-color: #f1f3f9;
            color: #416bbf;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
        }
        
        .filter-remove {
            margin-left: 8px;
            color: #666;
            font-weight: bold;
            text-decoration: none;
        }
        
        .clear-all-filters {
            display: block;
            margin-top: 10px;
            color: #dc3545;
            font-size: 13px;
            text-decoration: none;
        }
        
        /* Product Badges */
        .product-badges {
            position: absolute;
            top: 10px;
            left: 10px;
            display: flex;
            flex-direction: column;
            gap: 5px;
            z-index: 3;
        }
        
        .badge {
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .badge-sale {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5253 100%);
            color: white;
        }
        
        .badge-new {
            background: linear-gradient(135deg, #1dd1a1 0%, #10ac84 100%);
            color: white;
        }
        
        .badge-big-sale {
            background: linear-gradient(135deg, #339af0 0%, #1c7ed6 100%);
            color: white;
        }
        
        /* Quick Action Buttons */
        .product-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s ease;
            z-index: 3;
        }
        
        .product-card:hover .product-actions {
            opacity: 1;
            transform: translateX(0);
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }
        
        .action-btn:hover {
            background: #416bbf;
            color: white;
            transform: scale(1.1);
        }
        
        /* Efek spotlight (optional) */
        .product-card:after {
            content: "";
            position: absolute;
            top: -50%;
            left: -60%;
            width: 20%;
            height: 200%;
            opacity: 0;
            background: rgba(255, 255, 255, 0.13);
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0.13) 0%,
                rgba(255, 255, 255, 0.13) 77%,
                rgba(255, 255, 255, 0.5) 92%,
                rgba(255, 255, 255, 0.0) 100%
            );
            transform: rotate(30deg);
            transition: all 0.7s ease;
            z-index: 1;
        }
        
        .product-card:hover:after {
            opacity: 1;
            left: 130%;
        }
        
        /* List View Styles */
        .list-view .product-item-wrapper {
            width: 100%;
            max-width: 100%;
            flex: 0 0 100%;
        }
        
        .list-view .product-card {
            flex-direction: row;
        }
        
        .list-view .product-image-container {
            width: 200px;
            min-width: 200px;
            padding-bottom: 0;
            height: auto;
        }
        
        .list-view .product-description {
            display: block;
        }
        
        .list-view .product-brand-header {
            display: none;
        }
        
        /* Pagination Styles */
        .pagination-container {
            margin-top: 30px;
            margin-bottom: 20px;
        }
        
        .pagination {
            flex-wrap: wrap;
        }
        
        .page-item.active .page-link {
            background-color: #416bbf;
            border-color: #416bbf;
        }
        
        .page-link {
            color: #416bbf;
        }
        
        .page-link:hover {
            color: #2d4d8a;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }
        
        .empty-icon {
            font-size: 60px;
            color: #ddd;
        }
        
        .empty-text {
            font-size: 18px;
            color: #777;
            margin-top: 15px;
        }
        
        .empty-subtext {
            color: #999;
            margin-top: 10px;
        }
        
        /* View Mode Button Styles */
        .filter__option {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        
        .view-mode-btn {
            width: 35px;
            height: 35px;
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .view-mode-btn:hover, .view-mode-btn.active {
            background-color: #416bbf;
            border-color: #416bbf;
            color: white;
        }
        
        /* Mobile Styles */
        @media (max-width: 767px) {
            #filter-sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                width: 85%;
                max-width: 320px;
                height: 100vh;
                overflow-y: auto;
                background-color: white;
                z-index: 1050;
                box-shadow: 3px 0 15px rgba(0,0,0,0.2);
                padding: 20px;
                transition: left 0.3s ease;
            }
            
            #filter-sidebar.show {
                left: 0;
            }
            
            .filter-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.5);
                z-index: 1040;
                display: none;
            }
            
            .filter-overlay.show {
                display: block;
            }
            
            .filter-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 1px solid #ddd;
            }
            
            .close-filter {
                background: none;
                border: none;
                font-size: 20px;
                cursor: pointer;
            }
            
            .list-view .product-card {
                flex-direction: column;
            }
            
            .list-view .product-image-container {
                width: 100%;
                padding-bottom: 75%;
            }
            
            /* Ensure 2 products per row on mobile */
            .product-item-wrapper {
                padding: 10px 5px;
            }
            
            .product-info {
                padding: 12px;
            }
            
            .product-card-footer {
                padding: 12px;
            }
            
            .product-name {
                font-size: 14px;
                min-height: 40px;
            }
            
            .current-price {
                font-size: 16px;
            }
            
            .original-price {
                font-size: 12px;
            }
            
            .btn-view-detail {
                padding: 10px 12px;
                font-size: 13px;
            }
        }
    </style>

    <script>
        // Format input to show thousands separator
        function formatInput(input) {
            let value = input.value;
            let numericValue = value.replace(/[^0-9]/g, '');
            let formatted = numericValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            input.value = formatted;
        }
        
        // Reset price filter fields
        function resetFields() {
            document.getElementById('min_price').value = '';
            document.getElementById('max_price').value = '';
            
            // Reload the page without price parameters
            const url = new URL(window.location.href);
            url.searchParams.delete('min_price');
            url.searchParams.delete('max_price');
            window.location.href = url.toString();
        }
        
        // Handle sort selection change
        function sortProducts() {
            const sortBy = document.getElementById('sort-by').value;
            const url = new URL(window.location.href);
            
            // Update or add sort parameter
            if (sortBy) {
                url.searchParams.set('sort', sortBy);
            } else {
                url.searchParams.delete('sort');
            }
            
            // Reset page to 1 when sorting
            url.searchParams.delete('page');
            
            // Show loading indicator
            document.getElementById('loading-indicator').style.display = 'block';
            document.getElementById('product-list').style.opacity = '0.5';
            
            // Navigate to new URL
            window.location.href = url.toString();
        }
        
        // Document ready function
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile filter toggle
            const filterToggle = document.getElementById('filter-toggle');
            const filterSidebar = document.getElementById('filter-sidebar');
            
            if (filterToggle && filterSidebar) {
                // Create filter header for mobile
                const filterHeader = document.createElement('div');
                filterHeader.className = 'filter-header d-md-none';
                filterHeader.innerHTML = `
                    <h4>{{ __('messages.filter_options') }}</h4>
                    <button class="close-filter">&times;</button>
                `;
                filterSidebar.prepend(filterHeader);
                
                // Create overlay
                const filterOverlay = document.createElement('div');
                filterOverlay.className = 'filter-overlay';
                document.body.appendChild(filterOverlay);
                
                // Toggle filter sidebar
                filterToggle.addEventListener('click', function() {
                    filterSidebar.classList.add('show');
                    filterOverlay.classList.add('show');
                    document.body.style.overflow = 'hidden';
                });
                
                // Close filter on overlay click
                filterOverlay.addEventListener('click', function() {
                    filterSidebar.classList.remove('show');
                    filterOverlay.classList.remove('show');
                    document.body.style.overflow = '';
                });
                
                // Close button functionality
                const closeFilter = document.querySelector('.close-filter');
                if (closeFilter) {
                    closeFilter.addEventListener('click', function() {
                        filterSidebar.classList.remove('show');
                        filterOverlay.classList.remove('show');
                        document.body.style.overflow = '';
                    });
                }
            }
            
            // View mode switcher (Grid/List)
            const viewModeBtns = document.querySelectorAll('.view-mode-btn');
            const productList = document.getElementById('product-list');
            
            if (viewModeBtns.length && productList) {
                // Get saved view preference or default to grid
                const savedView = localStorage.getItem('productViewMode') || 'grid';
                
                // Apply saved view mode on page load
                if (savedView === 'list') {
                    productList.classList.add('list-view');
                    viewModeBtns.forEach(btn => {
                        btn.classList.toggle('active', btn.dataset.view === 'list');
                    });
                } else {
                    viewModeBtns.forEach(btn => {
                        btn.classList.toggle('active', btn.dataset.view === 'grid');
                    });
                }
                
                // Handle view mode button clicks
                viewModeBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const viewMode = this.dataset.view;
                        
                        // Update active state of buttons
                        viewModeBtns.forEach(btn => btn.classList.remove('active'));
                        this.classList.add('active');
                        
                        // Apply view mode to product list
                        if (viewMode === 'list') {
                            productList.classList.add('list-view');
                        } else {
                            productList.classList.remove('list-view');
                        }
                        
                        // Save preference
                        localStorage.setItem('productViewMode', viewMode);
                    });
                });
            }
            
            // Make product cards clickable
            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    // Don't navigate if clicked on a button or link
                    if (!e.target.closest('button') && !e.target.closest('a')) {
                        const url = this.dataset.href;
                        if (url) {
                            window.location.href = url;
                        }
                    }
                });
            });
            
            // Add to wishlist functionality
            document.querySelectorAll('.add-to-wishlist').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation(); // Prevent card click
                    const productId = this.dataset.productId;
                    
                    // Toggle wishlist icon
                    const icon = this.querySelector('i');
                    icon.classList.toggle('far');
                    icon.classList.toggle('fas');
                    
                    // AJAX call to add/remove from wishlist
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
                            // Show success notification
                            if (typeof showNotification === 'function') {
                                showNotification('success', data.message);
                            } else {
                                alert(data.message);
                            }
                        } else {
                            // Show info notification
                            if (typeof showNotification === 'function') {
                                showNotification('info', data.message);
                            } else {
                                alert(data.message);
                            }
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
@endsection