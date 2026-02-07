// ====================================
// NEOVALA ADMIN DASHBOARD JAVASCRIPT
// ====================================

document.addEventListener('DOMContentLoaded', function () {
    // Mobile Sidebar Toggle
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('active');

            // Update toggle icon
            const icon = this.querySelector('i');
            if (sidebar.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function (event) {
        if (window.innerWidth <= 768) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnToggle = sidebarToggle && sidebarToggle.contains(event.target);

            if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                const icon = sidebarToggle.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }
    });

    // Add animation to stat cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '0';
                entry.target.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    entry.target.style.transition = 'all 0.6s ease';
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, 100);

                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe stat cards and section cards
    document.querySelectorAll('.stat-card, .section-card').forEach(card => {
        observer.observe(card);
    });
});

/* --- GLOBAL CONFIRMATION MODAL LOGIC --- */
let formToDelete = null;

function confirmDelete(formOrUrl) {
    if (formOrUrl) {
        // Handle Form Element
        if (formOrUrl.tagName === 'FORM') {
            formToDelete = formOrUrl;
        }
        // Handle Button (if passed 'this' where button is inside form but submitted via JS)
        else if (formOrUrl.form) {
            formToDelete = formOrUrl.form;
        }
        else {
            // Fallback
            formToDelete = formOrUrl;
        }

        const modal = document.getElementById('confirmationModal');
        if (modal) {
            modal.style.display = 'flex';
        } else {
            console.warn('Confirmation modal not found');
            if (confirm('Apakah Anda yakin?')) {
                if (formToDelete.submit) formToDelete.submit();
            }
        }
    }
}

function closeConfirmationModal() {
    const modal = document.getElementById('confirmationModal');
    if (modal) modal.style.display = 'none';
    formToDelete = null;
}

// Init Confirmation Listeners
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('confirmationModal');
    const yesBtn = document.getElementById('confirmYesBtn');

    if (yesBtn) {
        yesBtn.addEventListener('click', function () {
            if (formToDelete && formToDelete.submit) {
                formToDelete.submit();
            }
            closeConfirmationModal();
        });
    }

    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeConfirmationModal();
        });
    }
});
