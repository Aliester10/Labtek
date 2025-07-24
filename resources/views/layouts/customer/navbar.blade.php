<?php 
use App\Models\Order;
use App\Models\Payment;
use App\Models\TParameter;
use Illuminate\Support\Facades\Auth;

// Initialize variables at the beginning of the file
$orders = Order::where('user_id', Auth::id())->where('is_viewed_by_customer', false)->get();
$payments = Payment::whereHas('order', function($query) { $query->where('user_id', Auth::id()); })->where('is_viewed_by_customer', false)->get();
$parameter = TParameter::first();
?>

<style>
/* Modern Navbar with #416bbf color scheme */
:root {
    --primary-color: #416bbf;
    --primary-dark: #2d4d8a;
    --text-color: #333;
    --light-bg: #f8f9fa;
    --border-color: #e2e8f0;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
    --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
    --transition: all 0.3s ease;
}

/* Top Header Bar */
.header__top {
    color: black;
}

.header__top__left ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.header__top__left ul li {
    display: inline-block;
    font-size: 14px;
    margin-right: 20px;
}

.header__top__left ul li i {
    margin-right: 5px;
}

/* Language Switcher - FIXED */
.header__top__right__language {
    position: relative;
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    margin-right: 15px;
    padding: 5px 0;
}

.header__top__right__language img {
    width: 20px;
    height: 15px;
    margin-right: 5px;
}

.header__top__right__language div {
    color: black;
    font-size: 14px;
}

.header__top__right__language span {
    margin-left: 5px;
    color: black;
}

.header__top__right__language ul {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    width: 140px;
    text-align: left;
    padding: 5px 0;
    z-index: 1050;
    opacity: 0;
    visibility: hidden;
    transition: var(--transition);
    box-shadow: var(--shadow-md);
    border-radius: 4px;
    transform: translateY(10px);
}

.header__top__right__language:hover ul {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.header__top__right__language ul li {
    list-style: none;
}

.header__top__right__language ul li a {
    font-size: 14px;
    color: var(--text-color);
    padding: 8px 15px;
    display: block;
    transition: var(--transition);
}

.header__top__right__language ul li a:hover {
    background-color: #f1f5ff;
    color: var(--primary-color);
}

/* Main Header */
.main-header {
    background: white;
    padding: 15px 0;
    box-shadow: var(--shadow-sm);
    position: relative;
    z-index: 99;
}

.header__fixed {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    animation: slideDown 0.35s ease-out;
    box-shadow: var(--shadow-md);
    z-index: 1000;
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
    }
    to {
        transform: translateY(0);
    }
}

.header__shrink {
    padding: 10px 0;
}

.header__logo img {
    max-height: 70px;
    transition: var(--transition);
}

.header__fixed .header__logo img {
    max-height: 60px;
}

/* Search Bar */
.hero__search {
    position: relative;
    width: 100%;
}

.hero__search__form {
    position: relative;
    width: 100%;
}

.hero__search__form input {
    width: 100%;
    height: 46px;
    font-size: 14px;
    color: var(--text-color);
    padding-left: 20px;
    border: 1px solid var(--border-color);
    border-radius: 23px;
    transition: var(--transition);
}

.hero__search__form input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(65, 107, 191, 0.15);
    outline: none;
}

.hero__search__form button {
    position: absolute;
    right: 0;
    top: 0;
    height: 46px;
    padding: 0 25px;
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 0 23px 23px 0;
    font-weight: 500;
    transition: var(--transition);
}

.hero__search__form button:hover {
    background: var(--primary-dark);
}

/* Login Button */
.site-btn {
    background: var(--primary-color);
    color: white;
    border: none;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 10px 25px;
    transition: var(--transition);
}

.site-btn:hover {
    background: var(--primary-dark);
    color: white;
    text-decoration: none;
}

.site-btn.rounded {
    border-radius: 50px;
}

/* COMPLETELY REDESIGNED MOBILE HEADER */
@media (max-width: 991px) {
    /* Hide desktop elements on mobile */
    .header__top,
    .hero__search {
        display: none;
    }
    
    /* Main mobile header container */
    .mobile-header {
        background: white;
        padding: 12px 0;
        box-shadow: var(--shadow-sm);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
    }
    
    .mobile-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 15px;
    }
    
    /* Logo section */
    .mobile-logo {
        flex: 1;
        padding-right: 10px;
    }
    
    .mobile-logo img {
        max-height: 38px;
        vertical-align: middle;
    }
    
    /* Mobile icons group */
    .mobile-icons {
        display: flex;
        align-items: center;
        gap: 18px; /* Increased spacing between icons */
    }
    
    .mobile-icon {
        position: relative;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: var(--text-color);
        border-radius: 50%;
        transition: var(--transition);
        background: transparent;
    }
    
    .mobile-icon:active {
        background-color: rgba(65, 107, 191, 0.1);
    }
    
    .mobile-icon i {
        font-size: 18px;
    }
    
    /* Mobile badge */
    .mobile-badge {
        position: absolute;
        top: 0;
        right: 0;
        width: 18px;
        height: 18px;
        background: var(--primary-color);
        color: white;
        font-size: 10px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 2px solid white;
    }
    
    /* Mobile user avatar */
    .mobile-user {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid var(--border-color);
    }
    
    .mobile-user img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    /* Mobile menu container */
    .mobile-menu-container {
        position: fixed;
        top: 0;
        left: -300px;
        width: 280px;
        height: 100%;
        background: white;
        z-index: 1001;
        transition: left 0.3s ease;
        box-shadow: var(--shadow-md);
        overflow-y: auto;
    }
    
    .mobile-menu-container.active {
        left: 0;
    }
    
    /* Mobile menu content */
    .mobile-menu-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        border-bottom: 1px solid var(--border-color);
    }
    
    .mobile-menu-header img {
        max-height: 40px;
    }
    
    .mobile-close {
        font-size: 24px;
        color: var(--text-color);
        background: none;
        border: none;
        cursor: pointer;
    }
    
    /* Mobile menu search */
    .mobile-search {
        padding: 15px;
        border-bottom: 1px solid var(--border-color);
    }
    
    .mobile-search-form {
        position: relative;
    }
    
    .mobile-search-form input {
        width: 100%;
        height: 44px;
        font-size: 14px;
        padding: 0 15px;
        border: 1px solid var(--border-color);
        border-radius: 22px;
    }
    
    .mobile-search-form button {
        position: absolute;
        right: 0;
        top: 0;
        height: 44px;
        width: 44px;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 0 22px 22px 0;
    }
    
    /* Mobile menu links */
    .mobile-menu-links {
        padding: 15px 0;
        border-bottom: 1px solid var(--border-color);
    }
    
    .mobile-menu-links a {
        display: block;
        padding: 12px 20px;
        color: var(--text-color);
        font-size: 16px;
        font-weight: 500;
        transition: var(--transition);
    }
    
    .mobile-menu-links a:hover {
        background-color: #f1f5ff;
        color: var(--primary-color);
    }
    
    .mobile-menu-links a i {
        width: 24px;
        margin-right: 10px;
        color: var(--primary-color);
    }
    
    /* Mobile language switcher */
    .mobile-language {
        padding: 15px 20px;
        border-bottom: 1px solid var(--border-color);
    }
    
    .mobile-language-title {
        font-size: 14px;
        color: #888;
        margin-bottom: 10px;
    }
    
    .mobile-language-options {
        display: flex;
        gap: 10px;
    }
    
    .mobile-language-option {
        display: flex;
        align-items: center;
        padding: 8px 15px;
        background: #f5f5f5;
        border-radius: 20px;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .mobile-language-option.active {
        background: var(--primary-color);
        color: white;
    }
    
    .mobile-language-option img {
        width: 20px;
        height: 15px;
        margin-right: 8px;
    }
    
    /* Mobile user info */
    .mobile-user-info {
        padding: 20px;
        display: flex;
        align-items: center;
        border-bottom: 1px solid var(--border-color);
    }
    
    .mobile-user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid var(--border-color);
        margin-right: 15px;
    }
    
    .mobile-user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .mobile-user-details h4 {
        margin: 0 0 5px;
        font-size: 16px;
        font-weight: 600;
    }
    
    .mobile-user-details p {
        margin: 0;
        font-size: 14px;
        color: #888;
    }
    
    /* Mobile menu actions */
    .mobile-menu-actions {
        padding: 20px;
    }
    
    .mobile-menu-actions a {
        display: block;
        padding: 12px 20px;
        text-align: center;
        background: var(--primary-color);
        color: white;
        font-weight: 500;
        border-radius: 4px;
        transition: var(--transition);
    }
    
    /* Mobile menu overlay */
    .mobile-menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        display: none;
        transition: var(--transition);
    }
    
    .mobile-menu-overlay.active {
        display: block;
    }
    
    /* Fixed height placeholder for fixed header */
    .mobile-header-placeholder {
        height: 64px; /* Match the height of your mobile header */
        display: none;
    }
    
    @media (max-width: 991px) {
        .mobile-header-placeholder {
            display: block;
        }
    }
    
    /* Bottom Mobile Navigation */
    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: white;
        display: flex;
        justify-content: space-around;
        padding: 8px 0 5px;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        z-index: 990;
    }
    
    .bottom-nav-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: #888;
        transition: var(--transition);
    }
    
    .bottom-nav-item:hover,
    .bottom-nav-item.active {
        color: var(--primary-color);
    }
    
    .bottom-nav-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f5f5f5;
        margin-bottom: 4px;
        transition: var(--transition);
    }
    
    .bottom-nav-item:hover .bottom-nav-icon,
    .bottom-nav-item.active .bottom-nav-icon {
        background: var(--primary-color);
        color: white;
        transform: translateY(-5px);
    }
    
    .bottom-nav-text {
        font-size: 12px;
        font-weight: 500;
    }
    
    /* Floating action button */
    .mobile-fab {
        position: fixed;
        right: 20px;
        bottom: 80px;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: var(--primary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(65, 107, 191, 0.3);
        z-index: 989;
        transition: var(--transition);
    }
    
    .mobile-fab:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(65, 107, 191, 0.4);
    }
    
    .mobile-fab i {
        font-size: 24px;
    }
    
    /* Mobile notifications panel */
    .mobile-notifications {
        position: fixed;
        top: 0;
        right: -320px;
        width: 320px;
        height: 100%;
        background: white;
        z-index: 1001;
        transition: right 0.3s ease;
        box-shadow: -2px 0 10px rgba(0,0,0,0.1);
        overflow-y: auto;
    }
    
    .mobile-notifications.active {
        right: 0;
    }
    
    .mobile-notifications-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        border-bottom: 1px solid var(--border-color);
        background: var(--primary-color);
        color: white;
    }
    
    .mobile-notifications-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 500;
    }
    
    .mobile-notifications-close {
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
    }
    
    .mobile-notification-item {
        padding: 15px 20px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: flex-start;
    }
    
    .mobile-notification-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f1f5ff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: var(--primary-color);
    }
    
    .mobile-notification-content {
        flex: 1;
    }
    
    .mobile-notification-content h4 {
        margin: 0 0 5px;
        font-size: 15px;
        font-weight: 500;
    }
    
    .mobile-notification-content p {
        margin: 0;
        font-size: 13px;
        color: #888;
    }
    
    .mobile-notification-time {
        font-size: 12px;
        color: #aaa;
        margin-top: 5px;
    }
    
    .mobile-notifications-footer {
        padding: 15px 20px;
        text-align: center;
        border-top: 1px solid var(--border-color);
    }
    
    .mobile-notifications-footer a {
        color: var(--primary-color);
        font-size: 14px;
        font-weight: 500;
    }
}

@media (min-width: 992px) {
    .mobile-header,
    .mobile-header-placeholder,
    .bottom-nav,
    .mobile-fab,
    .mobile-menu-container,
    .mobile-menu-overlay,
    .mobile-notifications {
        display: none;
    }
}

/* Original Header Cart Styles (for desktop) */
.header__cart {
    display: flex;
    justify-content: flex-end;
}

.header__cart ul {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    align-items: center;
}

.header__cart ul li {
    position: relative;
    margin-right: 15px;
}

.header__cart ul li:last-child {
    margin-right: 0;
}

.header__cart ul li a {
    color: var(--text-color);
    position: relative;
    display: inline-block;
    font-size: 18px;
}

.header__cart ul li a:hover {
    color: var(--primary-color);
}

.notification {
    position: absolute;
    top: -8px;
    right: -8px;
    height: 18px;
    width: 18px;
    background: var(--primary-color);
    color: white;
    border-radius: 50%;
    font-size: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

/* User Profile Display in Navbar - FIXED */
.user-profile-display {
    display: flex;
    align-items: center;
    background-color: #000000001;
    border-radius: 100%;
    transition: all 0.2s ease;
}

.user-profile-display:hover {
    background-color: #ffffff;
}

.profile-image {
    width: 50px;
    height: 50px;
    border-radius: 100%;
    object-fit: content;
    border: 2px solid #f2e1e1ff;
}

.nav-link.dropdown-toggle::after {
    display: none; /* Remove Bootstrap default dropdown arrow */
}

/* Notification Dropdown (Desktop) */
.notification-dropdown {
    position: absolute;
    top: 100%;
    right: -15px;
    width: 300px;
    background: white;
    border-radius: 8px;
    box-shadow: var(--shadow-md);
    padding: 0;
    z-index: 1050;
    display: none;
    overflow: hidden;
}

.notification-header {
    background: var(--primary-color);
    color: white;
    padding: 12px 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.notification-header h4 {
    margin: 0;
    font-size: 16px;
}

.notification-link {
    color: var(--text-color);
    text-decoration: none;
}

.notification-item {
    padding: 12px 15px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: flex-start;
    transition: var(--transition);
}

.notification-item:hover {
    background-color: #f1f5ff;
}

.notification-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(65, 107, 191, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
}

.notification-icon i {
    color: var(--primary-color);
    font-size: 16px;
}

.notification-content {
    flex: 1;
}

.notification-content p {
    margin: 0 0 5px;
    font-size: 14px;
    line-height: 1.4;
}

.notification-content small {
    color: #888;
    font-size: 12px;
}

.notification-footer {
    padding: 10px 15px;
    text-align: center;
    background: #f9f9f9;
}

.notification-footer a {
    color: var(--primary-color);
    font-size: 13px;
    font-weight: 500;
}

/* User Dropdown (Desktop) */
.dropdown-menu {
    border: none;
    box-shadow: var(--shadow-md);
    border-radius: 8px;
    margin-top: 10px;
    padding: 8px 0;
    min-width: 200px;
    z-index: 1050;
}

.dropdown-menu::before {
    content: '';
    position: absolute;
    top: -6px;
    right: 20px;
    width: 12px;
    height: 12px;
    background: white;
    transform: rotate(45deg);
    border-top: 1px solid rgba(0,0,0,0.05);
    border-left: 1px solid rgba(0,0,0,0.05);
}

.dropdown-item {
    padding: 10px 20px;
    color: var(--text-color);
    font-size: 14px;
    transition: var(--transition);
}

.dropdown-item:hover {
    background-color: #f1f5ff;
    color: var(--primary-color);
}

.dropdown-divider {
    margin: 5px 0;
    border-top: 1px solid var(--border-color);
}

/* Humberger (Desktop) */
.humberger__menu__wrapper {
    position: fixed;
    left: -300px;
    top: 0;
    width: 300px;
    height: 100%;
    background: white;
    z-index: 1000;
    transition: var(--transition);
    padding: 30px;
    overflow-y: auto;
    box-shadow: var(--shadow-md);
}

.humberger__menu__wrapper.show__humberger__menu__wrapper {
    left: 0;
}

.humberger__menu__overlay {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
    display: none;
    transition: var(--transition);
}

.humberger__menu__overlay.active {
    display: block;
}

.humberger__open {
    display: none;
    cursor: pointer;
    font-size: 22px;
}

@media (max-width: 991px) {
    .humberger__open {
        display: none; /* Hide the old hamburger button */
    }
    
    .main-header {
        display: none; /* Hide the main header on mobile */
    }
}
</style>

<!-- Mobile Header (Completely Redesigned) -->
<div class="mobile-header d-lg-none">
    <div class="mobile-header-content">
        <div class="mobile-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
            </a>
        </div>
            <!-- Menu Toggle -->
            <a href="#" class="mobile-icon" id="mobileMenuToggle">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </div>
</div>

<!-- Mobile Header Placeholder -->
<div class="mobile-header-placeholder d-lg-none"></div>

<!-- Mobile Search Panel -->
<div class="mobile-search-panel" id="mobileSearchPanel" style="display: none; position: fixed; top: 64px; left: 0; right: 0; background: white; z-index: 999; padding: 15px; box-shadow: 0 5px 10px rgba(0,0,0,0.1);">
    <form action="{{ route('shop') }}" method="GET">
        <div style="position: relative;">
            <input type="text" name="query" placeholder="{{ __('messages.search_product') }}" style="width: 100%; height: 46px; padding: 0 15px; padding-right: 50px; border: 1px solid #e2e8f0; border-radius: 23px;">
            <button type="submit" style="position: absolute; right: 0; top: 0; height: 46px; width: 46px; background: var(--primary-color); color: white; border: none; border-radius: 0 23px 23px 0;">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>
</div>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>
<div class="mobile-menu-container" id="mobileMenuContainer">
    <div class="mobile-menu-header">
        <a href="{{ route('home') }}">
            <img src="{{ asset($parameter->logo1 ? $parameter->logo1 : 'assets/images/logo.png') }}" alt="Logo">
        </a>
        <button class="mobile-close" id="mobileMenuClose">
            <i class="fa fa-times"></i>
        </button>
    </div>
    
    @if (Auth::check())
    <div class="mobile-user-info">
        <div class="mobile-user-avatar">
            <img src="{{ Auth::user()->foto_profile ? asset(Auth::user()->foto_profile) : asset('assets/images/labtek_wo_text.png') }}" alt="User">
        </div>
        <div class="mobile-user-details">
            <h4>{{ Auth::user()->name }}</h4>
            <p>{{ Auth::user()->email }}</p>
        </div>
    </div>
    @endif
    
    <div class="mobile-search">
        <div class="mobile-search-form">
            <form action="{{ route('shop') }}" method="GET">
                <input type="text" name="query" placeholder="{{ __('messages.search_product') }}">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    
    <div class="mobile-menu-links">
        <a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('messages.home') }}</a>
        <a href="{{ route('shop') }}"><i class="fa fa-shopping-bag"></i> {{ __('messages.shop') }}</a>
        
        @if (Auth::check())
        <a href="{{ route('cart.show') }}">
            <i class="fa fa-shopping-cart"></i> {{ __('messages.cart') }}
            @if(\App\Models\Cart::where('user_id', Auth::id())->sum('quantity') > 0)
            <span style="background: var(--primary-color); color: white; padding: 2px 6px; border-radius: 10px; font-size: 10px; margin-left: 5px;">
                {{ \App\Models\Cart::where('user_id', Auth::id())->sum('quantity') }}
            </span>
            @endif
        </a>
        <a href="{{ route('wishlist.index') }}">
            <i class="fa fa-heart"></i> {{ __('messages.wishlist') }}
            @if(Auth::user()->wishlist()->count() > 0)
            <span style="background: var(--primary-color); color: white; padding: 2px 6px; border-radius: 10px; font-size: 10px; margin-left: 5px;">
                {{ Auth::user()->wishlist()->count() }}
            </span>
            @endif
        </a>
        <a href="{{ route('customer.orders.index') }}">
            <i class="fa fa-box"></i> {{ __('messages.purchase') }}
        </a>
        <a href="{{ route('user.show') }}">
            <i class="fa fa-user"></i> {{ __('messages.profile') }}
        </a>
        @endif
    </div>
    
    <div class="mobile-language">
        <div class="mobile-language-title">{{ __('messages.language') }}</div>
        <div class="mobile-language-options">
            <a href="{{ route('lang.switch', 'id') }}" class="mobile-language-option {{ app()->getLocale() == 'id' ? 'active' : '' }}">
                <img src="{{ asset('kaiadmin-lite-1.2.0/assets/img/flags/id.png') }}" alt="Indonesia">
                Bahasa
            </a>
            <a href="{{ route('lang.switch', 'en') }}" class="mobile-language-option {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                <img src="{{ asset('kaiadmin-lite-1.2.0/assets/img/flags/england.png') }}" alt="English">
                English
            </a>
        </div>
    </div>
    
    <div class="mobile-menu-actions">
        @if (Auth::check())
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out-alt"></i> {{ __('messages.logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @else
        <a href="{{ route('login') }}">
            <i class="fa fa-sign-in-alt"></i> {{ __('messages.login') }}
        </a>
        @endif
    </div>
</div>

<!-- Mobile Notifications Panel -->
@if (Auth::check())
<div class="mobile-notifications" id="mobileNotifications">
    <div class="mobile-notifications-header">
        <h3>{{ __('messages.notifications') }}</h3>
        <button class="mobile-notifications-close" id="mobileNotificationsClose">
            <i class="fa fa-times"></i>
        </button>
    </div>
    
    @if ($orders->isEmpty() && $payments->isEmpty())
        <div class="mobile-notification-item">
            <div class="mobile-notification-icon">
                <i class="fa fa-bell-slash"></i>
            </div>
            <div class="mobile-notification-content">
                <h4>{{ __('messages.no_notifications') }}</h4>
                <p>{{ __('messages.no_notifications_message') }}</p>
            </div>
        </div>
    @else
        @foreach ($orders as $order)
            <a href="{{ route('customer.order.show', ['orderId' => $order->id]) }}" style="text-decoration: none; color: inherit;">
                <div class="mobile-notification-item">
                    <div class="mobile-notification-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="mobile-notification-content">
                        <h4>{{ __('messages.order') }} #{{ $order->id }}</h4>
                        <p>{{ $order->statusMessage() }}</p>
                        <div class="mobile-notification-time">{{ $order->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            </a>
        @endforeach
        
        @foreach ($payments as $payment)
            <a href="{{ route('customer.order.show', ['orderId' => $payment->order->id]) }}" style="text-decoration: none; color: inherit;">
                <div class="mobile-notification-item">
                    <div class="mobile-notification-icon">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <div class="mobile-notification-content">
                        <h4>{{ __('messages.payment') }}</h4>
                        <p>{{ __('messages.for_order') }} #{{ $payment->order->id }} {{ $payment->statusMessage() }}</p>
                        <div class="mobile-notification-time">{{ $payment->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            </a>
        @endforeach
    @endif
    
    <div class="mobile-notifications-footer">
        <a href="{{ route('customer.orders.index') }}">{{ __('messages.view_all_notifications') }}</a>
    </div>
</div>
@endif

<!-- Bottom Navigation -->
<div class="bottom-nav d-lg-none">
    <a href="{{ route('home') }}" class="bottom-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <div class="bottom-nav-icon">
            <i class="fa fa-home"></i>
        </div>
        <span class="bottom-nav-text">{{ __('messages.home') }}</span>
    </a>
    <a href="{{ route('shop') }}" class="bottom-nav-item {{ request()->routeIs('shop') ? 'active' : '' }}">
        <div class="bottom-nav-icon">
            <i class="fa fa-search"></i>
        </div>
        <span class="bottom-nav-text">{{ __('messages.shop') }}</span>
    </a>
    @if (Auth::check())
    <a href="{{ route('cart.show') }}" class="bottom-nav-item {{ request()->routeIs('cart.show') ? 'active' : '' }}">
        <div class="bottom-nav-icon">
            <i class="fa fa-shopping-cart"></i>
            @if(\App\Models\Cart::where('user_id', Auth::id())->sum('quantity') > 0)
            <span style="position: absolute; top: 0; right: 0; width: 16px; height: 16px; background: var(--primary-color); color: white; font-size: 10px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                {{ \App\Models\Cart::where('user_id', Auth::id())->sum('quantity') }}
            </span>
            @endif
        </div>
        <span class="bottom-nav-text">{{ __('messages.cart') }}</span>
    </a>
    <a href="{{ route('customer.orders.index') }}" class="bottom-nav-item {{ request()->routeIs('customer.orders.*') ? 'active' : '' }}">
        <div class="bottom-nav-icon">
            <i class="fa fa-box"></i>
        </div>
        <span class="bottom-nav-text">{{ __('messages.orders') }}</span>
    </a>
    <a href="{{ route('user.show') }}" class="bottom-nav-item {{ request()->routeIs('user.show') ? 'active' : '' }}">
        <div class="bottom-nav-icon">
            <i class="fa fa-user"></i>
        </div>
        <span class="bottom-nav-text">{{ __('messages.profile') }}</span>
    </a>
    @else
    <a href="{{ route('login') }}" class="bottom-nav-item">
        <div class="bottom-nav-icon">
            <i class="fa fa-sign-in-alt"></i>
        </div>
        <span class="bottom-nav-text">{{ __('messages.login') }}</span>
    </a>
    @endif
</div>

<!-- Desktop Header (Original) -->
<div class="header__top d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="header__top__left">
                    <ul>
                        <li><i class="fa fa-envelope"></i> {{ $parameter->email1 ? $parameter->email1 : 'info@labtek.id' }}</li>
                        <li>{{ $parameter->slogan ? $parameter->slogan : 'Level-Up Your Output With Labtek' }}</li>
                    </ul>                            
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="header__top__right">
                    <div class="header__top__right__language">
                        <img id="language-flag"
                            src="{{ app()->getLocale() == 'en'
                                ? asset('kaiadmin-lite-1.2.0/assets/img/flags/england.png')
                                : asset('kaiadmin-lite-1.2.0/assets/img/flags/id.png') }}"
                            alt="{{ app()->getLocale() == 'en' ? 'English' : 'Indonesia' }}"
                            data-lang="{{ app()->getLocale() }}">
                        <div id="language-text">
                            @if (app()->getLocale() == 'id')
                                Bahasa
                            @else
                                English
                            @endif
                        </div>

                        <span class="arrow_carrot-down"></span>
                        <ul>
                            <li><a href="{{ route('lang.switch', 'id') }}">Indonesia</a></li>
                            <li><a href="{{ route('lang.switch', 'en') }}">English</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-header container-fluid shadow d-none d-lg-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3">
                <div class="header__logo text-center mb-0">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero__search mb-0">
                    <div class="hero__search__form">
                        <form id="searchForm" action="{{ route('shop', ['categorySlug' => $categorySlug ?? null, 'subcategorySlug' => $subcategorySlug ?? null]) }}" method="GET" onsubmit="removeEmptyInputs()">
                            <input type="text" name="query" id="searchQuery" placeholder="{{ __('messages.search_product') }}" value="{{ $queryParam ?? '' }}">
                            <button type="submit" class="site-btn">{{ __('messages.search') }}</button>
                        
                            <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                            <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                            <input type="hidden" name="rating" value="{{ request('rating') }}">
                        </form>
                        
                        <script>
                            function removeEmptyInputs() {
                                const inputs = document.querySelectorAll('#searchForm input');
                        
                                inputs.forEach(input => {
                                    if (input.value.trim() === '') {
                                        input.removeAttribute('name');
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="header__cart mb-0">
                    <ul>
                        @if (Auth::check())
                        <li>
                            <a href="{{ route('wishlist.index') }}">
                                <i class="fa fa-heart"></i>
                                <span class="notification">
                                    {{ Auth::check() ? Auth::user()->wishlist()->count() : 0 }}
                                </span>
                            </a>
                        </li>
                        <li class="notification-item">
                            <a href="javascript:void(0)" onclick="toggleNotifications()">
                                <i class="fa fa-bell"></i>
                                <span class="notification"><?= $orders->count() + $payments->count() ?></span>
                            </a>
                            <div class="notification-dropdown" id="notificationDropdown">
                                <div class="notification-header">
                                    <h4>Notifikasi</h4>
                                    <i class="fa fa-cog settings-icon"></i>
                                </div>
                        
                                <div class="tab-content" id="updates" style="display: block;">
                                    <?php if ($orders->isEmpty() && $payments->isEmpty()): ?>
                                        <div class="notification-item">
                                            <p>Tidak ada notifikasi saat ini.</p>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($orders as $order): ?>
                                            <a href="<?= route('customer.order.show', ['orderId' => $order->id]) ?>" class="notification-link">
                                                <div class="notification-item" id="notification-<?= $order->id ?>">
                                                    <div class="notification-icon">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </div>
                                                    <div class="notification-content">
                                                        <p><strong>Order #<?= $order->id ?></strong> <?= $order->statusMessage() ?></p>
                                                        <small><?= $order->updated_at->diffForHumans() ?></small>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                        
                                        <?php foreach ($payments as $payment): ?>
                                            <a href="<?= route('customer.order.show', ['orderId' => $payment->order->id]) ?>" class="notification-link">
                                                <div class="notification-item" id="payment-notification-<?= $payment->id ?>">
                                                    <div class="notification-icon">
                                                        <i class="fa fa-credit-card"></i>
                                                    </div>
                                                    <div class="notification-content">
                                                        <p><strong>Pembayaran</strong> untuk order #<?= $payment->order->id ?> <?= $payment->statusMessage() ?></p>
                                                        <small><?= $payment->updated_at->diffForHumans() ?></small>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                        
                                <div class="notification-footer">
                                    <a href="<?= route('customer.orders.index') ?>">Lihat semua notifikasi</a>
                                </div>
                            </div>
                        </li>

                        <li>
                            <a href="{{ route('cart.show') }}">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="notification">
                                    {{ Auth::check() ? \App\Models\Cart::where('user_id', Auth::id())->sum('quantity') : 0 }}
                                </span>
                            </a>
                        </li>
                        @endif
                        
                        @guest
                            <li>
                                @if (Route::has('login'))
                                    <a class="site-btn rounded" href="{{ route('login') }}">
                                        {{ __('messages.login') }}
                                    </a>
                                @endif
                            </li>
                        @else
                            <li>
                                <div class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <div class="user-profile-display">
                                            <img src="{{ Auth::user()->foto_profile ? asset(Auth::user()->foto_profile) : asset('assets/images/labtek_wo_text.png') }}"
                                                alt="Avatar"
                                                class="profile-image">{{ Str::limit(explode(' ', Auth::user()->name)[0], 10) }}<i class="fa fa-angle-down ml-1"></i></span>
                                        </div>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('user.show') }}">
                                            <i class="fa fa-cog fa-fw mr-2" style="color: #888;"></i> {{ __('messages.settings') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('customer.orders.index') }}">
                                            <i class="fa fa-shopping-bag fa-fw mr-2" style="color: #888;"></i> {{ __('messages.purchase') }}
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out-alt fa-fw mr-2" style="color: #888;"></i> {{ __('messages.logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle notifications dropdown (desktop)
function toggleNotifications() {
    const dropdown = document.getElementById('notificationDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

// Close desktop dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('notificationDropdown');
    const notificationItem = document.querySelector('.notification-item');
    if (dropdown && dropdown.style.display === 'block' && !notificationItem.contains(event.target)) {
        dropdown.style.display = 'none';
    }
});

// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const menuToggle = document.getElementById('mobileMenuToggle');
    const menuContainer = document.getElementById('mobileMenuContainer');
    const menuOverlay = document.getElementById('mobileMenuOverlay');
    const menuClose = document.getElementById('mobileMenuClose');
    
    if (menuToggle && menuContainer && menuOverlay && menuClose) {
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            menuContainer.classList.add('active');
            menuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
        
        function closeMenu() {
            menuContainer.classList.remove('active');
            menuOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        menuClose.addEventListener('click', closeMenu);
        menuOverlay.addEventListener('click', closeMenu);
    }
    
    // Mobile notifications toggle
    const notificationsToggle = document.getElementById('mobileNotificationsToggle');
    const notifications = document.getElementById('mobileNotifications');
    const notificationsClose = document.getElementById('mobileNotificationsClose');
    
    if (notificationsToggle && notifications && notificationsClose) {
        notificationsToggle.addEventListener('click', function(e) {
            e.preventDefault();
            notifications.classList.add('active');
            menuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
        
        notificationsClose.addEventListener('click', function() {
            notifications.classList.remove('active');
            menuOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
    
    // Mobile search toggle
    const searchToggle = document.getElementById('mobileSearchToggle');
    const searchPanel = document.getElementById('mobileSearchPanel');
    
    if (searchToggle && searchPanel) {
        searchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (searchPanel.style.display === 'block') {
                searchPanel.style.display = 'none';
            } else {
                searchPanel.style.display = 'block';
                searchPanel.querySelector('input').focus();
            }
        });
        
        // Close search panel when clicking outside
        document.addEventListener('click', function(event) {
            if (searchPanel.style.display === 'block' && 
                !searchPanel.contains(event.target) && 
                event.target !== searchToggle) {
                searchPanel.style.display = 'none';
            }
        });
    }
    
    // Desktop header functionality (for larger screens)
    const header = document.querySelector('.main-header');
    if (header) {
        const headerHeight = header.offsetHeight;
        const placeholder = document.createElement('div');
        placeholder.style.height = headerHeight + 'px';
        placeholder.style.display = 'none';
        
        if (header.parentNode) {
            header.parentNode.insertBefore(placeholder, header.nextSibling);
        }

        window.addEventListener('scroll', function() {
            if (window.innerWidth >= 992) { // Only for desktop
                if (window.pageYOffset > 100) {
                    header.classList.add('header__fixed', 'header__shrink');
                    placeholder.style.display = 'block';
                } else {
                    header.classList.remove('header__fixed', 'header__shrink');
                    placeholder.style.display = 'none';
                }
            }
        });
    }
});
</script>