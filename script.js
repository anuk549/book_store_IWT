// Select the user icon and popup elements
const accountIcon = document.querySelector('.account');
const userPopup = document.querySelector('.user-popup');

// Function to toggle the popup
accountIcon.addEventListener('click', function(event) {
    event.stopPropagation(); // Prevent the click event from bubbling up
    userPopup.classList.toggle('show');
});

// Hide the popup when clicking outside
document.addEventListener('click', function(event) {
    if (!userPopup.contains(event.target) && !accountIcon.contains(event.target)) {
        userPopup.classList.remove('show');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all product sliders
    const sliders = document.querySelectorAll('.product-slider');
    
    sliders.forEach(slider => {
        const container = slider.querySelector('.product-container');
        const prevBtn = slider.querySelector('.prev');
        const nextBtn = slider.querySelector('.next');
        
        if (!container || !prevBtn || !nextBtn) return;

        const cardWidth = 220; // card width + gap
        const scrollAmount = cardWidth * 3; // Scroll 3 cards at a time

        prevBtn.addEventListener('click', () => {
            container.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });

        nextBtn.addEventListener('click', () => {
            container.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });

        // Hide/show arrows based on scroll position
        container.addEventListener('scroll', () => {
            const maxScroll = container.scrollWidth - container.clientWidth;
            
            prevBtn.style.display = container.scrollLeft <= 0 ? 'none' : 'flex';
            nextBtn.style.display = container.scrollLeft >= maxScroll ? 'none' : 'flex';
        });

        // Initial arrow visibility check
        prevBtn.style.display = 'none';
    });

    // Add to cart functionality
    const cartButtons = document.querySelectorAll('.cart-btn');
    cartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            // Add animation effect
            this.classList.add('added');
            setTimeout(() => {
                this.classList.remove('added');
            }, 1000);
            
            // Here you would typically add the product to cart
            console.log('Product added to cart');
        });
    });
});