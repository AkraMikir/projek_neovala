// Popup functionality
document.addEventListener('DOMContentLoaded', function() {
    const popupOverlay = document.getElementById('popup-overlay');
    const popupImages = document.querySelectorAll('.popup-image');
    const popupClose = document.getElementById('popup-close');
    
    if (!popupOverlay || !popupImages.length || !popupClose) {
        return; // Exit if elements don't exist
    }
    
    // Show popup every time page loads
    setTimeout(function() {
        popupOverlay.classList.add('active');
        // Prevent body scroll when popup is open
        document.body.style.overflow = 'hidden';
    }, 500); // Delay 500ms after page load
    
    // Close popup when X button is clicked
    popupClose.addEventListener('click', function(e) {
        e.stopPropagation();
        closePopup();
    });
    
    // Close popup when clicking outside the image (on overlay)
    popupOverlay.addEventListener('click', function(e) {
        if (e.target === popupOverlay) {
            closePopup();
        }
    });
    
    // Redirect to book-now page when any popup image is clicked
    popupImages.forEach(function(popupImage) {
        popupImage.addEventListener('click', function(e) {
            e.stopPropagation();
            window.location.href = '/book-now';
        });
    });
    
    // Close popup function
    function closePopup() {
        popupOverlay.classList.remove('active');
        // Restore body scroll
        document.body.style.overflow = '';
    }
    
    // Close popup with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && popupOverlay.classList.contains('active')) {
            closePopup();
        }
    });
});

