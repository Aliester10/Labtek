<!-- Footer Section Begin -->
<?php 
$parameter = App\Models\TParameter::first();
?>

<style>
/* Enhanced Modern Footer with Blue Accent (#416bbf) */
.footer-modern {
    background: linear-gradient(to bottom, #f9f9f9, #f2f2f2);
    padding: 60px 0 30px;
    position: relative;
    overflow: hidden;
}

.footer-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: #416bbf;
}

.footer-shape {
    position: absolute;
    opacity: 0.03;
    z-index: 0;
}

.footer-shape-1 {
    top: 10%;
    right: 5%;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: #416bbf;
}

.footer-shape-2 {
    bottom: 10%;
    left: 5%;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: #416bbf;
}

.footer-container {
    position: relative;
    z-index: 1;
}

/* Section Headings */
.footer-title {
    color: #222;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 12px;
    letter-spacing: 0.5px;
}

.footer-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 40px;
    height: 3px;
    background: #416bbf;
}

/* Contact Information */
.contact-list {
    margin: 0;
    padding: 0;
    list-style: none;
}

.contact-list li {
    display: flex;
    margin-bottom: 18px;
    align-items: flex-start;
}

.contact-list .icon-wrapper {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(65, 107, 191, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    transition: all 0.3s ease;
}

.contact-list li:hover .icon-wrapper {
    background: rgba(65, 107, 191, 0.2);
    transform: translateY(-2px);
}

.contact-list .icon-wrapper i {
    color: #416bbf;
    font-size: 16px;
}

.contact-list .contact-info {
    flex: 1;
    color: #555;
    font-size: 14px;
    line-height: 1.6;
}

/* Navigation Menu */
.footer-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-nav li {
    margin-bottom: 12px;
    position: relative;
}

.footer-nav a {
    color: #555;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
    position: relative;
    padding-left: 0;
}

.footer-nav a::before {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 0;
    height: 1px;
    background: #416bbf;
    transition: width 0.3s ease;
}

.footer-nav a:hover {
    color: #416bbf;
    padding-left: 5px;
}

.footer-nav a:hover::before {
    width: 100%;
}

/* Logo Section */
.logo-section {
    text-align: center;
    padding: 15px;
    background: rgba(255, 255, 255, 0.7);
    border-radius: 10px;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
}

.footer-logo {
    display: block;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.footer-logo:hover {
    transform: translateY(-5px);
}

.footer-logo img {
    max-height: 80px;
    width: auto;
}

/* Social Media Icons */
.social-icons {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    gap: 10px;
}

.social-icons a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #f1f1f1;
    color: #555;
    transition: all 0.3s ease;
}

.social-icons a:hover {
    background: #416bbf;
    color: white;
    transform: translateY(-3px) rotate(10deg);
}

/* Copyright Section */
.footer-copyright {
    text-align: center;
    padding-top: 30px;
    margin-top: 40px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    font-size: 14px;
    color: #666;
}

.footer-copyright span {
    color: #416bbf;
    font-weight: 600;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .footer-modern {
        padding: 40px 0 20px;
    }
    
    .footer-shape {
        display: none;
    }
}

@media (max-width: 768px) {
    .logo-section {
        margin-top: 20px;
    }
}
</style>

<footer class="footer-modern">
    <div class="footer-shape footer-shape-1"></div>
    <div class="footer-shape footer-shape-2"></div>
    <div class="container footer-container">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <h3 class="footer-title">{{ __('messages.contact_info') }}</h3>
                <ul class="contact-list">
                    <li>
                        <div class="icon-wrapper">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-info">
                            {{ $parameter->address ? $parameter->address : 'Alamat belum tersedia' }}
                        </div>
                    </li>
                    <li>
                        <div class="icon-wrapper">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-info">
                            {{ $parameter->telephone_number ? $parameter->telephone_number : '(021) 2204 3144' }}
                        </div>
                    </li>
                    <li>
                        <div class="icon-wrapper">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-info">
                            {{ $parameter->email1 ? $parameter->email1 : 'info@labtek.id' }}
                        </div>
                    </li>
                    <li>
                        <div class="icon-wrapper">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-info">
                            {{ $parameter->email2 ? $parameter->email2 : 'sales@labtek.id' }}
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Navigation Links -->
            <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h3 class="footer-title">{{ __('messages.help_resources') }}</h3>
                        <ul class="footer-nav">
                            <li><a href="{{ route('shop') }}">{{ __('messages.find_product') }}</a></li>
                            <li><a href="{{route ('cart.show') }}">{{ __('messages.shopping_cart') }}</a></li>
                            <li><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h3 class="footer-title">{{ __('messages.about') }}</h3>
                        <ul class="footer-nav">
                            <li><a href="{{ route('customer.faq') }}">{{ __('messages.qna') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Logo Section -->
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="logo-section">
                    <a href="{{ route('home') }}" class="footer-logo">
                        <img src="{{ $parameter->logo2 ? asset($parameter->logo2) : asset('assets/images/AGS-logo.png') }}" alt="Company Logo">
                    </a>
                    <a href="{{ route('home') }}" class="footer-logo">
                        <img src="{{ $parameter->logo2 ? asset($parameter->logo2) : asset('assets/images/AGS-logo.png') }}" alt="Company Logo">
                    </a>
                    
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="footer-copyright">
            &copy; <script>document.write(new Date().getFullYear());</script> 
            <span>{{ $parameter->company_name ?? 'PT. Arkamaya Guna Saharsa' }}</span>. All Rights Reserved.
        </div>
    </div>
</footer>
<!-- Footer Section End -->

@if(Auth::check())
   @php
       $user = Auth::user();
       $email = $user->email;
       $no_telepon = $user->userDetail->no_telepone ?? 'N/A';
       $perusahaan = $user->userDetail->perusahaan ?? 'N/A';
   @endphp

   <!--Start of Tawk.to Script-->
   <script type="text/javascript">
       var Tawk_API = Tawk_API || {};
       Tawk_API.visitor = {
           name : '{{ $user->name }}',
           email : '{{ $email }}',
           phone : '{{ $no_telepon }}',
           job_title: '{{ $perusahaan }}'
       };

       var Tawk_LoadStart = new Date();
       (function(){
           var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
           s1.async = true;
           s1.src = 'https://embed.tawk.to/66d166adea492f34bc0ba27f/1i6gvi641';
           s1.charset = 'UTF-8';
           s1.setAttribute('crossorigin', '*');
           s0.parentNode.insertBefore(s1, s0);
       })();
   </script>
   <!--End of Tawk.to Script-->
@endif

<!-- Js Plugins -->
<script src="{{ asset('ogani/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('ogani/js/bootstrap.bundle.min.js') }}"></script> 
<script src="{{ asset('ogani/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('ogani/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('ogani/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('ogani/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('ogani/js/mixitup.min.js') }}"></script>
<script src="{{ asset('ogani/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('ogani/js/main.js') }}"></script>
<script src="{{ asset('ogani/js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('ogani/js/custom.js') }}"></script>

</body>
</html>