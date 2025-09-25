/**
 * Neovala Event Tracking System
 * Tracks user interactions on the website
 */

class NeovalaTracker {
    constructor() {
        this.apiUrl = '/api/track';
        this.isTrackingEnabled = true;
        this.sessionId = this.generateSessionId();
        this.init();
    }

    /**
     * Initialize tracking
     */
    init() {
        // Track page visit on load
        this.trackEvent('visit', {
            url: window.location.href,
            referrer: document.referrer,
            session_id: this.sessionId
        });

        // Track download promo clicks
        this.trackDownloadPromo();
        
        // Track book now clicks
        this.trackBookNow();
        
        // Track form submissions
        this.trackFormSubmissions();
    }

    /**
     * Generate unique session ID
     */
    generateSessionId() {
        return 'session_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    }

    /**
     * Track any event
     */
    async trackEvent(eventName, metadata = {}) {
        if (!this.isTrackingEnabled) return;

        try {
            const payload = {
                event_name: eventName,
                url: window.location.href,
                referrer: document.referrer,
                metadata: {
                    ...metadata,
                    timestamp: new Date().toISOString(),
                    user_agent: navigator.userAgent,
                    screen_resolution: `${screen.width}x${screen.height}`,
                    viewport_size: `${window.innerWidth}x${window.innerHeight}`,
                    language: navigator.language,
                    timezone: Intl.DateTimeFormat().resolvedOptions().timeZone
                }
            };

            const response = await fetch(this.apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                console.warn('Failed to track event:', eventName);
            }
        } catch (error) {
            console.warn('Error tracking event:', error);
        }
    }

    /**
     * Track download promo clicks
     */
    trackDownloadPromo() {
        // Track download promo buttons
        document.addEventListener('click', (e) => {
            const downloadBtn = e.target.closest('.download-btn');
            if (downloadBtn) {
                this.trackEvent('download_promo', {
                    promo_title: downloadBtn.closest('.card')?.querySelector('.card-title')?.textContent || 'Unknown',
                    download_url: downloadBtn.href || 'Unknown'
                });
            }
        });
    }

    /**
     * Track book now clicks
     */
    trackBookNow() {
        // Track book now buttons
        document.addEventListener('click', (e) => {
            const bookNowBtn = e.target.closest('.book-now-btn, .view-details-btn');
            if (bookNowBtn) {
                let eventType = 'book_now';
                let metadata = {};

                // Check if it's a view details button (apartment discovery)
                if (bookNowBtn.classList.contains('view-details-btn')) {
                    eventType = 'book_now';
                    const apartmentCard = bookNowBtn.closest('.apartment-card');
                    if (apartmentCard) {
                        const apartmentName = apartmentCard.querySelector('.apartment-name')?.textContent;
                        metadata.apartment_name = apartmentName || 'Unknown';
                    }
                }

                this.trackEvent(eventType, metadata);
            }
        });
    }

    /**
     * Track form submissions
     */
    trackFormSubmissions() {
        // Track all form submissions
        document.addEventListener('submit', (e) => {
            const form = e.target;
            
            // Check if it's a form data submission (booking form)
            if (form.classList.contains('booking-form') || 
                form.querySelector('input[name="nama"]') || 
                form.querySelector('input[name="no_hp"]')) {
                
                const formData = new FormData(form);
                const metadata = {
                    form_type: 'booking_form',
                    apartment_type: formData.get('apartment_type') || 'Unknown',
                    form_fields: Array.from(formData.keys())
                };

                this.trackEvent('form_submit', metadata);
            }
        });
    }

    /**
     * Track specific apartment discovery clicks
     */
    trackApartmentDiscovery(apartmentName) {
        this.trackEvent('visit', {
            apartment_name: apartmentName,
            discovery_url: window.location.href,
            page_type: 'apartment_discovery'
        });
    }

    /**
     * Track navigation clicks
     */
    trackNavigation(linkText, linkUrl) {
        this.trackEvent('navigation', {
            link_text: linkText,
            link_url: linkUrl,
            current_page: window.location.href
        });
    }

    /**
     * Track time spent on page
     */
    trackTimeOnPage() {
        const startTime = Date.now();
        
        window.addEventListener('beforeunload', () => {
            const timeSpent = Math.round((Date.now() - startTime) / 1000);
            this.trackEvent('time_on_page', {
                time_spent_seconds: timeSpent,
                page_url: window.location.href
            });
        });
    }

    /**
     * Enable/disable tracking
     */
    setTrackingEnabled(enabled) {
        this.isTrackingEnabled = enabled;
    }

    /**
     * Get tracking status
     */
    isEnabled() {
        return this.isTrackingEnabled;
    }
}

// Initialize tracking when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.neovalaTracker = new NeovalaTracker();
    
    // Track time on page
    window.neovalaTracker.trackTimeOnPage();
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = NeovalaTracker;
}
