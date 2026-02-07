// ====================================
// KOMENTAR/TESTIMONIALS JAVASCRIPT
// Old Style
// ====================================

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('testimonialForm');
    const submitBtn = document.getElementById('submitBtn');
    const formMethod = document.getElementById('formMethod');
    const testimonialId = document.getElementById('testimonialId');

    // Form inputs
    const apartmenInput = document.getElementById('apartmen');
    const instagramInput = document.getElementById('instagram');
    const isiInput = document.getElementById('isi');
    const bintangInput = document.getElementById('bintang');

    // Edit buttons
    const editButtons = document.querySelectorAll('.edit-btn-old');

    // Edit functionality
    editButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const apartmen = this.dataset.apartmen;
            const instagram = this.dataset.instagram;
            const isi = this.dataset.isi;
            const bintang = this.dataset.bintang;

            // Populate form
            testimonialId.value = id;
            apartmenInput.value = apartmen;
            instagramInput.value = instagram;
            isiInput.value = isi;
            bintangInput.value = bintang;

            // Update form action to update route
            form.action = `/admin/dashboard1/komentar/${id}`;
            formMethod.value = 'PATCH';

            // Update button text
            submitBtn.textContent = 'Update';
            submitBtn.style.background = 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)';

            // Scroll to form
            apartmenInput.focus();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });

    // Reset form after submit or when adding new
    form.addEventListener('submit', function (e) {
        // Form will submit normally, just adding some feedback
        submitBtn.disabled = true;
        submitBtn.textContent = 'Menyimpan...';
    });

    // Auto-dismiss success alerts
    const alerts = document.querySelectorAll('.alert-old');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            alert.style.transition = 'all 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});
