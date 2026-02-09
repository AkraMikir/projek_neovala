document.addEventListener('DOMContentLoaded', function () {
    // Timeout in milliseconds (e.g., 15 minutes = 900,000 ms)
    // 30 minutes = 1800000
    const TIMEOUT_DURATION = 10 * 60 * 1000; // 15 Minutes
    let idleTimer;

    const warningLog = () => console.log("Session timer reset due to activity.");

    function resetTimer() {
        clearTimeout(idleTimer);
        idleTimer = setTimeout(logoutUser, TIMEOUT_DURATION);
    }

    function logoutUser() {
        // Create form and submit
        // Ensure we target the admin logout route
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/logout'; // Make sure this matches your route

        // Get CSRF token from meta tag
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (csrfMeta) {
            const csrfToken = csrfMeta.content;
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);
        } else {
            console.error('CSRF token not found');
        }

        document.body.appendChild(form);
        // alert('You have been logged out due to inactivity.');
        form.submit();
    }

    // Events to monitor - using 'true' for capture phase to catch all events
    const events = ['click', 'mousemove', 'keypress', 'scroll', 'touchstart'];
    events.forEach(event => {
        document.addEventListener(event, resetTimer, true);
    });

    // Start timer on load
    resetTimer();
    console.log(`Idle timer started. Timeout: ${TIMEOUT_DURATION / 60000} minutes.`);
});
