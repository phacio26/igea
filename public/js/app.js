document.addEventListener('DOMContentLoaded', function() {
    // Update copyright year
    document.getElementById('current-year').textContent = new Date().getFullYear();

    // Hero Text Scroll Effect
    let lastScrollTop = 0;
    const heroText = document.getElementById("hero-text");
    const heroSection = document.querySelector('.hero-section');

    if (heroText && heroSection) {
        if (window.pageYOffset <= 50) {
            heroText.classList.add("scroll-up");
            heroText.classList.remove("scroll-down");
        } else {
            heroText.classList.add("scroll-down");
            heroText.classList.remove("scroll-up");
        }
        
        window.addEventListener("scroll", () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const heroHeight = heroSection.offsetHeight;
            
            if (scrollTop < heroHeight * 0.7) {
                if (scrollTop > lastScrollTop && scrollTop > 50) {
                    heroText.classList.remove("scroll-up");
                    heroText.classList.add("scroll-down");
                } else if (scrollTop < lastScrollTop) {
                    heroText.classList.remove("scroll-down");
                    heroText.classList.add("scroll-up");
                }
            } else {
                heroText.classList.remove("scroll-up");
                heroText.classList.add("scroll-down");
            }
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }, { passive: true });
    }

    // Intersection Observer for Section Animations
    const sectionsToAnimate = document.querySelectorAll('.content-section, .animated-element');
    const observerOptions = { 
        root: null, 
        rootMargin: '0px', 
        threshold: 0.15 
    };

    const observerCallback = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) { 
                entry.target.classList.add('visible'); 
            } else { 
                entry.target.classList.remove('visible'); 
            }
        });
    };

    const sectionObserver = new IntersectionObserver(observerCallback, observerOptions);
    sectionsToAnimate.forEach(section => { 
        sectionObserver.observe(section); 
    });

    // Team member card animations
    const teamCards = document.querySelectorAll('.team-member-card');
    teamCards.forEach((card, index) => {
        card.style.transitionDelay = `${index * 0.1}s`;
    });

    // Gallery modal functionality
    const galleryModal = document.getElementById('galleryModal');
    if (galleryModal) {
        galleryModal.addEventListener('show.bs.modal', function (event) {
            // Add any gallery modal specific functionality here
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Active nav link highlighting
    const currentPage = window.location.pathname;
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    
    navLinks.forEach(link => {
        const linkPage = link.getAttribute('href');
        if (currentPage === linkPage || (currentPage === '/' && linkPage === '/')) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
});