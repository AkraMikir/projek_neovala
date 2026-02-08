/* ====================================
   TPJ APARTMENT JAVASCRIPT
   ==================================== */

document.addEventListener('DOMContentLoaded', function () {
    // Initialize tabs - Check URL param then LocalStorage then Default
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get('tab') || localStorage.getItem('tpj_active_tab') || 'carousel';
    switchTab(activeTab);

    // Auto-dismiss alerts
    const alerts = document.querySelectorAll('.alert-old');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });

    // --- CAROUSEL SLIDER ---
    const carousel = document.querySelector('.carousel-container');
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    const prevButton = document.querySelector('.carousel-button.prev');
    const nextButton = document.querySelector('.carousel-button.next');
    let currentSlide = 0;

    function updateCarousel() {
        if (carousel) {
            // Using translateX to slide. 
            // Assuming 4 slides, container width is 400%, each slide is 25% of container (100% of viewport)
            // If currentSlide is 1, move 25% to the left.
            carousel.style.transform = `translateX(-${currentSlide * 25}%)`;
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }
    }

    function nextSlide() {
        if (slides.length > 0) {
            currentSlide = (currentSlide + 1) % slides.length;
            updateCarousel();
        }
    }

    function prevSlide() {
        if (slides.length > 0) {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            updateCarousel();
        }
    }

    if (prevButton && nextButton) {
        prevButton.addEventListener('click', prevSlide);
        nextButton.addEventListener('click', nextSlide);
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            updateCarousel();
        });
    });

    // Auto advance slides every 5 seconds
    if (slides.length > 0) {
        setInterval(nextSlide, 5000);
    }

    // --- CONFIRMATION MODAL INIT ---
    const confirmOverlay = document.getElementById('confirmationModal');
    const confirmYesBtn = document.getElementById('confirmYesBtn');

    if (confirmYesBtn) {
        confirmYesBtn.addEventListener('click', function () {
            if (typeof formToDelete !== 'undefined' && formToDelete) {
                formToDelete.submit();
            }
            if (typeof closeConfirmationModal === 'function') {
                closeConfirmationModal();
            }
        });
    }

    if (confirmOverlay) {
        confirmOverlay.addEventListener('click', function (e) {
            if (e.target === confirmOverlay) {
                closeConfirmationModal();
            }
        });
    }
});

/* --- TABS --- */
function switchTab(tabId) {
    // Hide all sections
    document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));

    // Show selected section
    const section = document.getElementById(tabId + '-section');
    if (section) {
        section.classList.add('active');

        // Find the button for active state (Improvement: use data attribute if possible, but class selection works)
        const buttons = document.querySelectorAll('.tab-btn');
        // This index logic is fragile if HTML changes, but matches active setup
        if (tabId === 'carousel') buttons[0].classList.add('active');
        if (tabId === 'rooms') buttons[1].classList.add('active');
        if (tabId === 'comments') buttons[2].classList.add('active');
        if (tabId === 'form-data') buttons[3].classList.add('active');

        // Persist tab
        localStorage.setItem('tpj_active_tab', tabId);

        // Update URL without refresh (optional clean UX)
        const url = new URL(window.location);
        url.searchParams.set('tab', tabId);
        window.history.replaceState({}, '', url);
    } else {
        // Fallback if tabId not found (e.g. bad localStorage)
        if (tabId !== 'carousel') switchTab('carousel');
    }
}

// Add event listeners to tab buttons for active state
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});

/* --- MODALS --- */
function showSection(id) {
    const el = document.getElementById(id);
    if (el) el.style.display = 'flex';
}

function hideSection(id) {
    const el = document.getElementById(id);
    if (el) el.style.display = 'none';
}

/* --- ROOMS --- */
function showCreateRoom() {
    document.getElementById('createRoomSection').style.display = 'flex';
}

function hideCreateRoom() {
    document.getElementById('createRoomSection').style.display = 'none';
}

/* Wrapper to safely open edit room from data attribute */
function openEditRoom(btn) {
    try {
        const data = JSON.parse(btn.dataset.room);
        const url = btn.dataset.updateUrl;
        editRoom(data, url);
    } catch (e) {
        console.error('Error parsing room data:', e);
    }
}

function editRoom(data, updateUrl) {
    const form = document.getElementById('editRoomForm');

    // If updateUrl is provided, use it. Otherwise use a default or existing action
    if (updateUrl) {
        form.action = updateUrl;
    } else {
        // Fallback or verify if action is already set
        console.warn('Update URL not provided for editRoom');
    }

    document.getElementById('editRoomId').value = data.id;

    // Main Photo
    const mainImg = document.getElementById('editMainPreview');
    if (data.main_photo) {
        mainImg.src = data.main_photo;
        mainImg.style.display = 'block';
    } else {
        mainImg.style.display = 'none';
    }

    // Popups
    if (data.popup_photos) {
        data.popup_photos.forEach((photo, index) => {
            const i = index + 1;
            const img = document.getElementById('editPopupPreview' + i);
            if (img && photo) {
                img.src = photo;
                img.style.display = 'block';
            } else if (img) {
                img.style.display = 'none';
            }
        });
    }

    document.getElementById('editRoomSection').style.display = 'flex';
}

function hideEditRoom() {
    document.getElementById('editRoomSection').style.display = 'none';
}

/* --- CAROUSEL --- */
function showChangeSlide() {
    document.getElementById('changeSlideSection').style.display = 'flex';
}

function hideChangeSlide() {
    document.getElementById('changeSlideSection').style.display = 'none';
}

function previewImage(input, imgId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.getElementById(imgId);
            img.src = e.target.result;
            img.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

/* --- FORM DATA DETAIL --- */

/* Wrapper to safely open detail from data attribute */
function openDetail(btn) {
    try {
        const data = JSON.parse(btn.dataset.details);
        showFormDetail(data);
    } catch (e) {
        console.error('Error parsing detail data:', e);
    }
}

function showFormDetail(data) {
    document.getElementById('detailNama').textContent = data.nama;
    document.getElementById('detailNoTelp').textContent = data.nomor_wa;
    document.getElementById('detailLamaSewa').textContent = data.durasi;
    document.getElementById('detailUkuranKamar').textContent = data.tipe_kamar;
    document.getElementById('detailTanggalMasuk').textContent = data.tanggal_checkin || '-';
    document.getElementById('detailJamKedatangan').textContent = data.jam_kedatangan || '-';
    document.getElementById('detailCatatan').textContent = data.pesan || '-';

    document.getElementById('detailDataSection').style.display = 'flex';
}

function hideDetail() {
    document.getElementById('detailDataSection').style.display = 'none';
}

/* --- ROOM POPUP SLIDER --- */
function showRoomPopup(id) {
    const popup = document.getElementById(id);
    if (popup) popup.style.display = 'flex';

    // Reset to first slide
    const slides = popup.querySelectorAll('.room-popup-slide');
    slides.forEach(s => s.classList.remove('active'));
    if (slides.length > 0) slides[0].classList.add('active');
}

function closeRoomPopup(id) {
    const popup = document.getElementById(id);
    if (popup) popup.style.display = 'none';
}

function nextPopupSlide(btn) {
    const container = btn.parentElement.querySelector('.room-popup-carousel-container');
    const slides = container.querySelectorAll('.room-popup-slide');
    let activeIndex = -1;

    slides.forEach((slide, index) => {
        if (slide.classList.contains('active')) activeIndex = index;
        slide.classList.remove('active');
    });

    let nextIndex = (activeIndex + 1) % slides.length;
    slides[nextIndex].classList.add('active');
}

function prevPopupSlide(btn) {
    const container = btn.parentElement.querySelector('.room-popup-carousel-container');
    const slides = container.querySelectorAll('.room-popup-slide');
    let activeIndex = -1;

    slides.forEach((slide, index) => {
        if (slide.classList.contains('active')) activeIndex = index;
        slide.classList.remove('active');
    });

    let prevIndex = (activeIndex - 1 + slides.length) % slides.length;
    slides[prevIndex].classList.add('active');
}
