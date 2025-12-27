/**
 * Neovala Event Tracking System
 * Tracks user interactions on the website
 */

class NeovalaTracker {
    constructor() {
        this.apiUrl = '/api/track';
        this.isTrackingEnabled = true;
        this.sessionId = this.getOrCreateSessionId();
        this.init();
    }

    /**
     * Get or create session ID (persist across page reloads)
     */
    getOrCreateSessionId() {
        const storageKey = 'neovala_session_id';
        const sessionExpiry = 30 * 60 * 1000; // 30 minutes
        
        let sessionId = sessionStorage.getItem(storageKey);
        let sessionTimestamp = sessionStorage.getItem(storageKey + '_timestamp');
        
        // Check if session expired or doesn't exist
        if (!sessionId || !sessionTimestamp || (Date.now() - parseInt(sessionTimestamp)) > sessionExpiry) {
            sessionId = 'session_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            sessionStorage.setItem(storageKey, sessionId);
            sessionStorage.setItem(storageKey + '_timestamp', Date.now().toString());
        }
        
        return sessionId;
    }

    /**
     * Check if visit already tracked in this session
     */
    isVisitTracked() {
        const storageKey = 'neovala_visit_tracked';
        const currentUrl = window.location.pathname;
        const trackedUrl = sessionStorage.getItem(storageKey);
        
        // Track visit only once per URL per session
        if (trackedUrl === currentUrl) {
            return true;
        }
        
        // Mark as tracked
        sessionStorage.setItem(storageKey, currentUrl);
        return false;
    }

    /**
     * Initialize tracking
     */
    init() {
        // Track page visit on load (only once per URL per session)
        if (!this.isVisitTracked()) {
            // Add small delay to ensure page is fully loaded
            setTimeout(() => {
                this.trackEvent('visit', {
                    url: window.location.href,
                    referrer: document.referrer,
                    session_id: this.sessionId,
                    is_new_session: !sessionStorage.getItem('neovala_visit_tracked')
                });
            }, 100);
        }

        // Track download promo clicks
        this.trackDownloadPromo();
        
        // Track book now clicks
        this.trackBookNow();
        
        // Track form submissions
        this.trackFormSubmissions();
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

            // Track ke Meta Pixel dan Google Ads
            this.trackToAdsPlatforms(eventName, metadata);
        } catch (error) {
            console.warn('Error tracking event:', error);
        }
    }

    /**
     * Track event ke Meta Pixel dan Google Ads
     */
    trackToAdsPlatforms(eventName, metadata = {}) {
        // Track ke Meta Pixel (Facebook Pixel)
        this.trackMetaPixel(eventName, metadata);
        
        // Track ke Google Ads
        this.trackGoogleAds(eventName, metadata);
    }

    /**
     * Track event ke Meta Pixel
     */
    trackMetaPixel(eventName, metadata = {}) {
        // Cek apakah fbq (Facebook Pixel) tersedia
        if (typeof fbq === 'undefined') {
            return;
        }

        // Mapping event name ke Meta Pixel event
        const metaEventMap = {
            'visit': 'PageView',
            'download_promo': 'Lead',
            'book_now': 'InitiateCheckout',
            'form_submit': 'CompleteRegistration',
        };

        const metaEventName = metaEventMap[eventName] || 'PageView';

        try {
            // Track standard event
            if (metaEventName !== 'PageView') {
                fbq('track', metaEventName, {
                    content_name: metadata.promo_title || metadata.apartment_name || 'Neovala',
                    content_category: eventName,
                    value: metadata.value || 0,
                    currency: 'IDR'
                });
            }

            // Track custom event juga untuk lebih detail
            fbq('trackCustom', eventName, {
                ...metadata,
                page_url: window.location.href
            });
        } catch (error) {
            console.warn('Error tracking to Meta Pixel:', error);
        }
    }

    /**
     * Track event ke Google Ads
     */
    trackGoogleAds(eventName, metadata = {}) {
        // Cek apakah gtag (Google Analytics/Ads) tersedia
        if (typeof gtag === 'undefined') {
            return;
        }

        try {
            // Get conversion label untuk event ini
            const conversionLabel = this.getGoogleAdsConversionLabel(eventName);
            
            // Jika ada conversion label, track sebagai conversion
            if (conversionLabel) {
                gtag('event', 'conversion', {
                    'send_to': conversionLabel,
                    'value': metadata.value || 0,
                    'currency': 'IDR',
                    'transaction_id': metadata.transaction_id || this.sessionId,
                    'event_category': 'engagement',
                    'event_label': eventName
                });
            }

            // Track sebagai custom event juga (selalu track untuk analytics)
            gtag('event', eventName, {
                'event_category': 'user_action',
                'event_label': eventName,
                'value': metadata.value || 0
            });
        } catch (error) {
            console.warn('Error tracking to Google Ads:', error);
        }
    }

    /**
     * Get Google Ads conversion label untuk event tertentu
     * Mengambil dari window.googleAdsConversionLabels yang di-set oleh ads-tracking component
     */
    getGoogleAdsConversionLabel(eventName) {
        // Cek apakah ada conversion labels dari backend
        if (window.googleAdsConversionLabels && window.googleAdsConversionLabels[eventName]) {
            return window.googleAdsConversionLabels[eventName];
        }

        // Fallback: cek data attribute di body
        const dataAttr = document.body.getAttribute(`data-google-ads-${eventName.replace('_', '-')}-label`);
        if (dataAttr) {
            return dataAttr;
        }

        // Default fallback (jika tidak ada konfigurasi)
        return null; // Return null agar tidak track jika tidak ada label
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
