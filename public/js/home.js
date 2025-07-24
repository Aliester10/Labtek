/**
 * Modern Home.js - Enhanced JavaScript for a professional homepage
 */
document.addEventListener('DOMContentLoaded', function() {
    // Initialize modern features
    initCarousel();
    initCountdown();
    initProducts();
    initPromoModal();
    initAnimations();
    initNewsletter();
});

/**
 * Initialize modern carousel with enhanced controls
 */
function initCarousel() {
    const carousel = document.getElementById('heroCarousel');
    if (!carousel) return;
    
    // Set up custom arrows
    const prevArrow = document.querySelector('.carousel-arrow.prev');
    const nextArrow = document.querySelector('.carousel-arrow.next');
    const dots = document.querySelectorAll('.carousel-dot');
    
    if (prevArrow) {
        prevArrow.addEventListener('click', function() {
            $('#heroCarousel').carousel('prev');
        });
    }
    
    if (nextArrow) {
        nextArrow.addEventListener('click', function() {
            $('#heroCarousel').carousel('next');
        });
    }
    
    if (dots.length) {
        dots.forEach(dot => {
            dot.addEventListener('click', function() {
                const slideIndex = this.getAttribute('data-slide-to');
                $('#heroCarousel').carousel(parseInt(slideIndex));
                
                // Update active state
                dots.forEach(d => d.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Update dots when slide changes
        $('#heroCarousel').on('slide.bs.carousel', function(e) {
            const slideIndex = e.to;
            dots.forEach(d => d.classList.remove('active'));
            dots[slideIndex].classList.add('active');
        });
    }
    
    // Add swipe support for mobile
    addSwipeSupport(carousel);
    
    // Add entrance animations when slide changes
    $('#heroCarousel').on('slide.bs.carousel', function(e) {
        // Remove animation classes from current slide
        const currentSlide = $(this).find('.carousel-item.active');
        currentSlide.find('.hero-text').removeClass('animate__animated animate__fadeInUp');
        
        // Add animation classes to next slide after transition
        const nextSlide = $(e.relatedTarget);
        setTimeout(function() {
            nextSlide.find('.hero-text').addClass('animate__animated animate__fadeInUp');
        }, 100);
    });
}

/**
 * Add touch swipe support for carousels
 */
function addSwipeSupport(element) {
    let touchStartX = 0;
    let touchEndX = 0;
    
    element.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, {passive: true});
    
    element.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, {passive: true});
    
    function handleSwipe() {
        const swipeThreshold = 50;
        
        if (touchEndX < touchStartX - swipeThreshold) {
            // Swipe left - next slide
            $('#heroCarousel').carousel('next');
        }
        
        if (touchEndX > touchStartX + swipeThreshold) {
            // Swipe right - previous slide
            $('#heroCarousel').carousel('prev');
        }
    }
}

/**
 * Initialize modern countdown with animation
 */
function initCountdown() {
    const daysElement = document.getElementById('days');
    const hoursElement = document.getElementById('hours');
    const minutesElement = document.getElementById('minutes');
    const secondsElement = document.getElementById('seconds');
    
    if (!daysElement || !hoursElement || !minutesElement || !secondsElement) {
        return;
    }
    
    // Get end time from a data attribute or find it in the script
    const saleEndTime = document.querySelector('script[data-sale-end]')?.getAttribute('data-sale-end');
    
    let endTime;
    try {
        endTime = saleEndTime ? new Date(saleEndTime).getTime() : null;
    } catch (e) {
        console.error('Invalid date format for countdown');
    }
    
    // If no valid end time, try to extract it from the inline script
    if (!endTime) {
        const scripts = document.querySelectorAll('script');
        for (let i = 0; i < scripts.length; i++) {
            const scriptContent = scripts[i].textContent;
            if (scriptContent && scriptContent.includes('bigSaleEndTime')) {
                const match = scriptContent.match(/new Date\("([^"]+)"\)/);
                if (match && match[1]) {
                    try {
                        endTime = new Date(match[1]).getTime();
                        break;
                    } catch (e) {
                        console.error('Error parsing date from script:', e);
                    }
                }
            }
        }
    }
    
    // If still no end time, use 24 hours from now as fallback
    if (!endTime) {
        endTime = new Date();
        endTime.setDate(endTime.getDate() + 1);
        endTime = endTime.getTime();
    }
    
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = endTime - now;
        
        if (distance < 0) {
            daysElement.textContent = '00';
            hoursElement.textContent = '00';
            minutesElement.textContent = '00';
            secondsElement.textContent = '00';
            return;
        }
        
        // Calculate time components
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Add animation to changing values
        updateWithAnimation(daysElement, days);
        updateWithAnimation(hoursElement, hours);
        updateWithAnimation(minutesElement, minutes);
        updateWithAnimation(secondsElement, seconds);
    }
    
    function updateWithAnimation(element, value) {
        const currentValue = element.textContent;
        const newValue = value < 10 ? '0' + value : value.toString();
        
        if (currentValue !== newValue) {
            // Add flip animation
            element.classList.add('flip-animation');
            
            // Update the value after a small delay
            setTimeout(() => {
                element.textContent = newValue;
                
                // Remove animation class after transition
                setTimeout(() => {
                    element.classList.remove('flip-animation');
                }, 300);
            }, 300);
        }
    }
    
    // Initialize and set interval
    updateCountdown();
    setInterval(updateCountdown, 1000);
}

/**
 * Initialize product card interactions
 */
function initProducts() {
    const productItems = document.querySelectorAll('.product-item');
    
    productItems.forEach(item => {
        item.addEventListener('click', function(e) {
            if (!e.target.closest('a') && !e.target.closest('button')) {
                const url = this.getAttribute('data-href');
                if (url) {
                    window.location.href = url;
                }
            }
        });
    });
}

/**
 * Initialize promotional modal
 */
function initPromoModal() {
    const modal = document.getElementById('promoModal');
    if (!modal) return;
    
    const dontShowAgain = document.getElementById('dontShowAgain');
    const modalKey = 'hidePromoModal';
    
    // Check if modal should be shown
    if (localStorage.getItem(modalKey) !== 'true') {
        // Show modal with slight delay
        setTimeout(() => {
            new bootstrap.Modal(modal).show();
        }, 1500);
    }
    
    // Set up "don't show again" button
    if (dontShowAgain) {
        dontShowAgain.addEventListener('click', function() {
            localStorage.setItem(modalKey, 'true');
            
            // Set expiry date for this preference (7 days)
            const expiry = new Date();
            expiry.setDate(expiry.getDate() + 7);
            localStorage.setItem(modalKey + '_expiry', expiry.getTime().toString());
            
            // Hide modal
            bootstrap.Modal.getInstance(modal).hide();
        });
    }
    
    // Check for expired preferences
    const expiryTime = localStorage.getItem(modalKey + '_expiry');
    if (expiryTime && new Date().getTime() > parseInt(expiryTime)) {
        localStorage.removeItem(modalKey);
        localStorage.removeItem(modalKey + '_expiry');
    }
}

/**
 * Initialize scroll-based animations
 */
function initAnimations() {
    // Detect elements that should animate on scroll
    const animateElements = document.querySelectorAll('.feature-box, .product-item, .sale-card, .newsletter-container');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    });
    
    animateElements.forEach(el => {
        observer.observe(el);
    });
}

/**
 * Initialize newsletter functionality
 */
function initNewsletter() {
    const form = document.querySelector('.newsletter-form');
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = this.querySelector('input[type="email"]').value;
        if (!email) return;
        
        // Here you would normally send this to your backend
        // For now, just show a success message
        
        // Create success message
        const successMessage = document.createElement('div');
        successMessage.className = 'alert alert-success mt-3 animate__animated animate__fadeIn';
        successMessage.textContent = 'Thank you for subscribing to our newsletter!';
        
        // Replace form with success message
        this.innerHTML = '';
        this.appendChild(successMessage);
    });
}

// Add CSS animation keyframes dynamically
(function addAnimationStyles() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes flip-animation {
            0% { transform: rotateX(0deg); opacity: 1; }
            50% { transform: rotateX(90deg); opacity: 0; }
            100% { transform: rotateX(0deg); opacity: 1; }
        }
        
        .flip-animation {
            animation: flip-animation 0.6s;
        }
    `;
    document.head.appendChild(style);
})();