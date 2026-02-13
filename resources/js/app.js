import './bootstrap';

// Light parallax effect for hero section
document.addEventListener('DOMContentLoaded', function() {
    const hero = document.querySelector('.parallax-container');
    if (hero) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = hero.querySelector('.parallax-bg');
            if (parallax) {
                const speed = scrolled * 0.3;
                parallax.style.transform = `translateY(${speed}px)`;
            }
        });
    }
    
    // Fade up animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-up');
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.fade-up-on-scroll').forEach(el => {
        observer.observe(el);
    });
    
    // Counter animation for stats
    const counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                entry.target.classList.add('counted');
                const target = parseInt(entry.target.getAttribute('data-count'));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;
                
                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        entry.target.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        entry.target.textContent = target + (target >= 100 ? '+' : '');
                    }
                };
                
                updateCounter();
            }
        });
    }, { threshold: 0.5 });
    
    document.querySelectorAll('[data-count]').forEach(el => {
        counterObserver.observe(el);
    });
    
    // Form validation and duplicate submission prevention
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        let isSubmitting = false;
        
        contactForm.addEventListener('submit', function(e) {
            // Honeypot check
            const honeypot = document.getElementById('website');
            if (honeypot && honeypot.value !== '') {
                e.preventDefault();
                return false;
            }
            
            // Prevent duplicate submissions
            if (isSubmitting) {
                e.preventDefault();
                return false;
            }
            
            isSubmitting = true;
            const submitButton = contactForm.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Sending...';
            }
        });
    }
    
    // Newsletter form validation
    const newsletterForms = document.querySelectorAll('form[aria-label="Newsletter subscription"]');
    newsletterForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const email = form.querySelector('input[type="email"]');
            if (email && !email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                e.preventDefault();
                email.setCustomValidity('Please enter a valid email address');
                email.reportValidity();
                return false;
            }
        });
    });
});
