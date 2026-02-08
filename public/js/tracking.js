/**
 * Neovala Analytics Tracking System (Refactored v2)
 * Features: Session, Debounce, Link Clicks, Form Simulation
 */

const NeovalaAnalytics = {
    // Configuration
    apiEndpoint: '/api/track-activity',
    storageKey: 'neovala_analytics_session', // Key for session ID

    // 1. Session Management
    getSessionId: function () {
        let sid = localStorage.getItem(this.storageKey);
        if (!sid) {
            sid = 'sess_' + Date.now().toString(36) + Math.random().toString(36).substr(2, 5);
            localStorage.setItem(this.storageKey, sid);
        }
        return sid;
    },

    // 2. Main Tracking Function
    track: async function (type, metadata = {}) {
        // Prepare Payload
        const payload = {
            activity_type: type, // 'visit', 'click_book_now', 'click_download_promo', 'submit_form', 'submit_comment'
            page_url: window.location.href,
            session_id: this.getSessionId(),
            metadata: metadata // Flexible object
        };

        // Get CSRF Token
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!token) return console.warn('Analytics: CSRF Token Missing');

        try {
            const response = await fetch(this.apiEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();

            if (result.status === 'skipped') {
                // console.log('Analytics: Duplicate event skipped by server.');
            } else {
                console.log('Analytics: Event recorded', type, metadata);
            }

        } catch (error) {
            console.error('Analytics Error:', error);
        }
    },

    // 3. Auto-Track Page Visits
    initVisitTracking: function () {
        let metadata = {};

        // Detect Apartment Type from URL
        const path = window.location.pathname;
        if (path.includes('discover-tpj')) metadata.apartment_type = 'TPJ';
        else if (path.includes('discover-gkl')) metadata.apartment_type = 'GKL';
        else if (path.includes('discover-tpc')) metadata.apartment_type = 'TPC';
        else if (path.includes('discover-plu')) metadata.apartment_type = 'PLU';
        else if (path.includes('discover-gwc')) metadata.apartment_type = 'GWC';
        else if (path.includes('discover-pgv')) metadata.apartment_type = 'PGV';
        else if (path.includes('discover-bsr')) metadata.apartment_type = 'BSR';
        else if (path.includes('discover-gpc')) metadata.apartment_type = 'GPC';

        this.track('visit', metadata);
    },

    // 4. Bind Click Events (Booking & Promo)
    initClickTracking: function () {
        document.addEventListener('click', (e) => {
            // A. BOOKING LINKS (WhatsApp / Tiket.com)
            // Mencari elemen terdekat dengan class .booking-image atau link yang mengandung 'wa.me' / 'tiket.com'
            const bookingLink = e.target.closest('.booking-image, a[href*="wa.me"], a[href*="tiket.com"]');

            if (bookingLink) {
                // Tentukan destinasi (WA atau Tiket.com)
                let destination = 'Unknown';
                const href = bookingLink.getAttribute('href') || '';

                if (href.includes('wa.me')) destination = 'WhatsApp';
                else if (href.includes('tiket.com')) destination = 'Tiket.com';

                // Cari nama Apartment dari context (biasanya ada di judul section terdekat)
                const sectionTitle = bookingLink.closest('.booking-section')?.querySelector('h2')?.innerText || 'General Booking';

                this.track('click_book_now', {
                    destination_type: destination,
                    apartment_name: sectionTitle, // "BOOKING TRANSPARK JUANDA"
                    url: href
                });
                return; // Stop checking other types
            }

            // B. GENERIC BOOK NOW BUTTONS
            const btnBook = e.target.closest('a[href*="book-now"], .btn-book-now, .book-now-trigger');
            if (btnBook) {
                this.track('click_book_now', {
                    target_name: btnBook.innerText || 'Book Now Button',
                    destination: btnBook.getAttribute('href')
                });
                return;
            }

            // C. DOWNLOAD PROMO
            const btnDownload = e.target.closest('.download-promo, a[download]');
            if (btnDownload) {
                this.track('click_download_promo', {
                    target_name: btnDownload.getAttribute('download') || 'Promo File',
                    url: btnDownload.getAttribute('href')
                });
            }

            // D. TITIP KUNCI SUBMIT BUTTON (Simulasi Form Submit)
            const btnSubmit = e.target.closest('.kirim-btn');
            if (btnSubmit) {
                // Ambil form induknya
                const form = btnSubmit.closest('form');
                if (form && form.id === 'titipKunciForm') {
                    this.track('submit_form', {
                        form_type: 'Titip Kunci (WhatsApp)',
                        nama_pengirim: form.querySelector('#nama')?.value || 'Unknown'
                    });
                }
            }
        });
    },

    // 5. Form Submissions (Real Forms)
    initFormTracking: function () {
        document.addEventListener('submit', (e) => {
            // Cek form comment atau form lain yang beneran submit
            const form = e.target;

            if (form.action && form.action.includes('komentar')) {
                this.track('submit_comment', {
                    form_id: form.id || 'comment-form'
                });
            } else {
                this.track('submit_form', {
                    form_id: form.id || 'unknown-form'
                });
            }
        });
    }
};

// Initialize on DOM Ready
document.addEventListener('DOMContentLoaded', () => {
    NeovalaAnalytics.initVisitTracking();
    NeovalaAnalytics.initClickTracking();
    NeovalaAnalytics.initFormTracking();
});
