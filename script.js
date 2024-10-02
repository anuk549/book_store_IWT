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