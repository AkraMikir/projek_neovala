// Popup functionality
document.addEventListener('DOMContentLoaded', function() {
    const popupOverlay = document.getElementById('popup-overlay');
    const popupImages = document.querySelectorAll('.popup-image');
    const popupClose = document.getElementById('popup-close');
    
    // Ensure body scroll is restored if popup doesn't exist or isn't active
    if (!popupOverlay || !popupImages.length || !popupClose) {
        // Make sure overflow is not hidden if popup doesn't exist
        document.body.style.overflow = 'auto';
        return; // Exit if elements don't exist
    }
    
    // Check if popup is already active on page load, if not, ensure overflow is restored
    if (!popupOverlay.classList.contains('active')) {
        document.body.style.overflow = 'auto';
    }
    
    // Check if we're on a discover page - if so, don't show popup automatically
    const isDiscoverPage = window.location.pathname.includes('/discover') || 
                          window.location.pathname.includes('discover-');
    
    // Show popup every time page loads (except on discover pages)
    if (!isDiscoverPage) {
        setTimeout(function() {
            // Double check elements still exist before showing popup
            if (popupOverlay && popupImages.length && popupClose) {
                popupOverlay.classList.add('active');
                // Prevent body scroll when popup is open
                document.body.style.overflow = 'hidden';
            } else {
                // If elements don't exist, ensure overflow is restored
                document.body.style.overflow = 'auto';
            }
        }, 500); // Delay 500ms after page load
    } else {
        // On discover pages, ensure overflow is always auto
        document.body.style.overflow = 'auto';
        // Also ensure popup is not active
        if (popupOverlay) {
            popupOverlay.classList.remove('active');
        }
    }
    
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
            // Restore scroll before redirecting
            document.body.style.overflow = '';
            window.location.href = '/book-now';
        });
    });
    
    // Close popup function
    function closePopup() {
        if (popupOverlay) {
            popupOverlay.classList.remove('active');
        }
        // Restore body scroll - use 'auto' instead of empty string for better compatibility
        document.body.style.overflow = 'auto';
    }
    
    // Close popup with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && popupOverlay && popupOverlay.classList.contains('active')) {
            closePopup();
        }
    });
    
    // Additional safety: Check periodically if popup is still active, if not, restore scroll
    // This handles edge cases where popup might be closed by other scripts
    setInterval(function() {
        // Check if we're on a discover page
        const isDiscoverPage = window.location.pathname.includes('/discover') || 
                              window.location.pathname.includes('discover-');
        
        if (isDiscoverPage) {
            // On discover pages, always ensure overflow is auto unless room popup is active
            const roomPopups = document.querySelectorAll('.popup-overlay:not(#popup-overlay)');
            let anyRoomPopupActive = false;
            roomPopups.forEach(function(popup) {
                if (popup.classList.contains('active') || popup.style.display === 'flex') {
                    anyRoomPopupActive = true;
                }
            });
            
            if (!anyRoomPopupActive) {
                document.body.style.overflow = 'auto';
            }
        } else {
            // On other pages, check if promo popup is active
            if (popupOverlay && !popupOverlay.classList.contains('active')) {
                // Check if any other popup is active (room popups)
                const roomPopups = document.querySelectorAll('.popup-overlay:not(#popup-overlay)');
                let anyRoomPopupActive = false;
                roomPopups.forEach(function(popup) {
                    if (popup.classList.contains('active') || popup.style.display === 'flex') {
                        anyRoomPopupActive = true;
                    }
                });
                
                // Only restore scroll if no popups are active
                if (!anyRoomPopupActive) {
                    document.body.style.overflow = 'auto';
                }
            }
        }
    }, 1000); // Check every second
    
    // Force restore scroll on discover pages after a short delay
    setTimeout(function() {
        const isDiscoverPage = window.location.pathname.includes('/discover') || 
                              window.location.pathname.includes('discover-');
        if (isDiscoverPage) {
            const roomPopups = document.querySelectorAll('.popup-overlay:not(#popup-overlay)');
            let anyRoomPopupActive = false;
            roomPopups.forEach(function(popup) {
                if (popup.classList.contains('active') || popup.style.display === 'flex') {
                    anyRoomPopupActive = true;
                }
            });
            
            if (!anyRoomPopupActive && popupOverlay && !popupOverlay.classList.contains('active')) {
                document.body.style.overflow = 'auto';
            }
        }
    }, 600); // After popup.js timeout (500ms) + 100ms buffer
});

