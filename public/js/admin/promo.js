// ====================================
// PROMO JAVASCRIPT
// Old Admin Style
// ====================================

document.addEventListener('DOMContentLoaded', function () {
    const promoImage = document.getElementById('promoImage');
    const previewArea = document.getElementById('previewArea');
    const imageUploadDiv = previewArea ? previewArea.parentElement : null;

    // Image preview
    if (promoImage && imageUploadDiv && previewArea) {
        promoImage.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    // Replace placeholder with image preview
                    imageUploadDiv.innerHTML = '';
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    imageUploadDiv.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Auto-dismiss alerts
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
