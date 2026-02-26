// Fungsi untuk navbar scroll
function handleNavbarScroll() {
    const navbar = document.querySelector(".navbar");
    const header = document.querySelector(".header");
    const bookNowBtn = document.querySelector(".book-now-container");

    if (!navbar || !header) {
        console.log(
            "Navbar or header not found, skipping navbar scroll initialization"
        );
        return;
    }

    const headerBottom = header.offsetTop + header.offsetHeight;

    function updateNavbarState() {
        if (window.scrollY > headerBottom - navbar.offsetHeight) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
        // Book Now button selalu visible, tidak ada logika hide/show
    }

    // Remove existing scroll listener to avoid duplicates
    window.removeEventListener("scroll", updateNavbarState);
    window.addEventListener("scroll", updateNavbarState);

    // Set initial state
    updateNavbarState();
}

function handleSmoothScroll() {
    const navLinks = document.querySelectorAll(".nav-links a, .logo-left a");
    const navHeight = document.querySelector(".navbar").offsetHeight;

    // Function to scroll smoothly to the target section
    function smoothScrollTo(targetId) {
        const targetSection = document.querySelector(targetId);
        if (!targetSection) return; // If target section doesn't exist, do nothing

        let targetPosition = targetSection.offsetTop - navHeight;

        window.scrollTo({
            top: targetPosition,
            behavior: "smooth",
        });
    }

    navLinks.forEach((link) => {
        link.addEventListener("click", (e) => {
            const href = link.getAttribute("href");

            // Extract the hash part of the href (e.g., #apartment-section)
            const hash = href.split("#")[1];
            if (hash) {
                e.preventDefault();
                smoothScrollTo(`#${hash}`); // Scroll to the section with the corresponding id
            }
        });
    });
}

handleSmoothScroll(); // Call the function to enable smooth scrolling

// Fungsi untuk menu burger
function handleBurgerMenu() {
    const burgerMenu = document.querySelector(".burger-menu");
    const navLinks = document.querySelector(".nav-links");
    const overlay = document.querySelector(".nav-overlay");
    const navItems = document.querySelectorAll(".nav-links a");
    const closeButton = document.createElement("button");

    if (!burgerMenu || !navLinks || !overlay) return;

    closeButton.innerHTML = "×";
    closeButton.className = "close-menu-btn";
    navLinks.insertBefore(closeButton, navLinks.firstChild);

    function toggleMenu() {
        const isOpening = !navLinks.classList.contains("active");
        const bookNowBtn = document.querySelector(".book-now-container");

        if (isOpening && bookNowBtn) {
            // Ensure Book Now button stays visible
            bookNowBtn.style.zIndex = "100";
        } else if (bookNowBtn) {
            bookNowBtn.style.zIndex = "";
        }

        burgerMenu.classList.toggle("active");
        navLinks.classList.toggle("active");
        overlay.classList.toggle("active");
    }

    // Event listeners
    burgerMenu.addEventListener("click", toggleMenu);
    overlay.addEventListener("click", toggleMenu);
    closeButton.addEventListener("click", toggleMenu);

    // Event listener untuk navlinks
    // Event listener for nav items
    navItems.forEach((item) => {
        item.addEventListener("click", (e) => {
            const href = item.getAttribute("href");

            // If the link is an external URL (contains .html or a full URL), let the browser handle it
            if (href.includes(".html") || href.startsWith("http")) {
                return;
            }

            e.preventDefault(); // Prevent default behavior

            // Handle internal hash links
            if (href.startsWith("#")) {
                const targetSection = document.querySelector(href);
                if (!targetSection) return; // If the target section doesn't exist, stop the function

                const navHeight =
                    document.querySelector(".navbar").offsetHeight;
                let targetPosition = targetSection.offsetTop - navHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: "smooth",
                });
            }
        });
    });
}

// Fungsi untuk carousel (existing code)
function initializeCarousel() {
    const slides = document.querySelectorAll(".carousel-slide");
    const dots = document.querySelectorAll(".dot");
    const prevButton = document.querySelector(".prev");
    const nextButton = document.querySelector(".next");
    let currentSlide = 0;

    // Cek apakah elemen carousel ada
    if (slides.length === 0 || dots.length === 0) {
        console.log(
            "Carousel elements not found, skipping carousel initialization"
        );
        return;
    }

    // Fungsi untuk menampilkan slide
    function showSlide(n) {
        if (slides.length === 0 || dots.length === 0) return;

        slides.forEach((slide) => {
            if (slide && slide.classList) {
                slide.classList.remove("active");
            }
        });
        dots.forEach((dot) => {
            if (dot && dot.classList) {
                dot.classList.remove("active");
            }
        });

        let newSlide;
        if (n >= slides.length) {
            newSlide = 0;
        } else if (n < 0) {
            newSlide = slides.length - 1;
        } else {
            newSlide = n;
        }
        currentSlide = newSlide;

        if (slides[currentSlide] && slides[currentSlide].classList) {
            slides[currentSlide].classList.add("active");
        }
        if (dots[currentSlide] && dots[currentSlide].classList) {
            dots[currentSlide].classList.add("active");
        }
    }

    // Event listener untuk tombol prev
    if (prevButton) {
        prevButton.addEventListener("click", () => {
            showSlide(currentSlide - 1);
        });
    }

    // Event listener untuk tombol next
    if (nextButton) {
        nextButton.addEventListener("click", () => {
            showSlide(currentSlide + 1);
        });
    }

    // Event listener untuk dots
    dots.forEach((dot, index) => {
        if (dot) {
            dot.addEventListener("click", () => {
                showSlide(index);
            });
        }
    });

    // Auto slide setiap 7 detik
    setInterval(() => {
        showSlide(currentSlide + 1);
    }, 5000);

    // Tampilkan slide pertama
    showSlide(0);
}

document.addEventListener("DOMContentLoaded", function () {
    // Initialize all functions
    if (document.querySelector(".carousel")) {
        initializeCarousel();
    }
    handleSmoothScroll();
    handleBurgerMenu();
    handleNavbarScroll();

    // Ensure navbar scroll works on all pages
    setTimeout(() => {
        handleNavbarScroll();
    }, 100);

    //============================================== START JS ANJAY WOIIIIIIIIIII ini buat form data ya ganteng
    // Fitur: Tampilkan hari pada tanggal check-in
    //     const tanggalInput = document.getElementById('tanggalCheckin');
    //     if (tanggalInput) {
    //         // Buat elemen untuk menampilkan hari
    //         let hariLabel = document.createElement('div');
    //         hariLabel.id = 'hariTanggalCheckin';
    //         hariLabel.style.marginTop = '6px';
    //         hariLabel.style.fontSize = '1rem';
    //         hariLabel.style.color = '#674C1D';
    //         hariLabel.style.fontWeight = 'bold';
    //         tanggalInput.parentNode.appendChild(hariLabel);

    //         // Fungsi untuk update hari
    //         function updateHariTanggal() {
    //             const value = tanggalInput.value;
    //             if (!value) {
    //                 hariLabel.textContent = '';
    //                 return;
    //             }
    //             const hariArr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    //             const tgl = new Date(value);
    //             const hari = hariArr[tgl.getDay()];
    //             // Format dd/mm/yyyy
    //             const tglStr = (tgl.getDate().toString().padStart(2, '0')) + '/' + ((tgl.getMonth()+1).toString().padStart(2, '0')) + '/' + tgl.getFullYear();
    //             hariLabel.textContent = `${hari}, ${tglStr}`;
    //         }
    //         tanggalInput.addEventListener('change', updateHariTanggal);
    //         tanggalInput.addEventListener('input', updateHariTanggal);
    //         // Inisialisasi jika sudah ada value
    //         updateHariTanggal();
    //     }
    // });

    // document.getElementById('checkinForm').addEventListener('submit', function(event) {
    //     event.preventDefault();

    //     // Ambil data form
    //     const formData = {
    //         nama: document.getElementById('nama').value,
    //         nomor_wa: document.getElementById('nomor').value,
    //         tipe_kamar: document.getElementById('tipeKamar').value,
    //         tanggal_checkin: document.getElementById('tanggalCheckin').value,
    //         jam_kedatangan: document.getElementById('jamKedatangan').value,
    //         durasi: document.getElementById('durasi').value,
    //         pesan: document.getElementById('pesan').value,
    //         apartment_type: 'Transpark Juanda by Neovala'
    //     };

    //     // Tambahkan loading state
    //     const submitBtn = document.querySelector('.submit-btn');
    //     submitBtn.disabled = true;
    //     submitBtn.innerHTML = 'Mengirim...';

    //     // Kirim data ke server
    //     fetch('/save-form-data', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         },
    //         body: JSON.stringify(formData)
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         if(data.success) {
    //             // Format pesan WhatsApp
    //             const templatePesan =
    // `Checkin From ${formData.apartment_type} via Website Neovala

    // Nama : ${formData.nama}
    // Nomor WhatsApp : ${formData.nomor_wa}
    // Tipe Kamar : ${formData.tipe_kamar}
    // Tanggal Check-in : ${formData.tanggal_checkin}
    // Jam Kedatangan : ${formData.jam_kedatangan}
    // Durasi Menginap : ${formData.durasi}
    // Pesan Tambahan : ${formData.pesan}`;

    //             // Encode pesan untuk URL
    //             const encodedPesan = encodeURIComponent(templatePesan);

    //             // Mendapatkan nomor WhatsApp berdasarkan apartemen
    //             let nomorTujuan = '6287874176270'; // Default untuk Transpark Juanda

    //             switch(formData.apartment_type) {
    //                 case 'Transpark Juanda by Neovala':
    //                     nomorTujuan = '6287874176270';
    //                     break;
    //                 case 'Transpark Cibubur by Neovala':
    //                     nomorTujuan = '6281805191817';
    //                     break;
    //                 case 'Podomoro Golf View by Neovala':
    //                     nomorTujuan = '6281220391217';
    //                     break;
    //                 case 'Patraland Urbano by Neovala':
    //                     nomorTujuan = '6287852624656';
    //                     break;
    //                 case 'Grand Kamala Lagoon by Neovala':
    //                     nomorTujuan = '6285161518151';
    //                     break;
    //                 case 'Gateway Cicadas by Neovala':
    //                     nomorTujuan = '6289630253533';
    //                     break;
    //                 default:
    //                     nomorTujuan = '6287815933353'; // Neovala Official
    //             }

    //             console.log('Nomor Tujuan:', nomorTujuan); // Log untuk debugging

    //             // Membuat dan membuka URL WhatsApp
    //             const whatsappURL = `https://wa.me/${nomorTujuan}?text=${encodedPesan}`;
    //             window.location.href = whatsappURL;
    //         } else {
    //             throw new Error(data.message || 'Terjadi kesalahan');
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error:', error);
    //         alert('Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
    //     })
    //     .finally(() => {
    //         // Reset loading state
    //         submitBtn.disabled = false;
    //         submitBtn.innerHTML = '<i class="fab fa-whatsapp"></i> Kirim via WhatsApp';
    //     });
});

//============================================== END JS ANJAY WOIIIIIIIIIII

//     return false;
// }
// // Tambahkan event listener untuk memastikan fungsi dipanggil
// document.addEventListener('DOMContentLoaded', function() {
//     const forms = document.querySelectorAll('form[onsubmit="sendToWhatsApp(event)"]');
//     forms.forEach(form => {
//         form.addEventListener('submit', function(event) {
//             sendToWhatsApp(event);
//         });
//     });

//     // Tambahkan event listener untuk tombol submit
//     const submitButtons = document.querySelectorAll('.submit-btn');
//     submitButtons.forEach(button => {
//         button.addEventListener('click', function(event) {
//             const form = this.closest('form');
//             if (form) {
//                 sendToWhatsApp(event);
//             }
//         });
//     });
// });

// Fungsi untuk mendownload gambar promo
document.addEventListener("DOMContentLoaded", function () {
    const downloadButtons = document.querySelectorAll(
        ".download-btn:not(.disabled)"
    );

    downloadButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            // Jika tombol disabled, jangan lakukan apa-apa
            if (this.classList.contains("disabled")) {
                return;
            }

            // Dapatkan card parent
            const card = this.closest(".card");
            // Dapatkan URL gambar dan title
            const cardImage = card.querySelector(".card-image");
            const cardTitle = card
                .querySelector(".card-title")
                .textContent.trim();

            if (cardImage) {
                // Ambil URL gambar
                const imageUrl = cardImage.getAttribute("src");

                // Format nama file: ubah spasi menjadi underscore dan tambahkan '_promo.jpg'
                const fileName =
                    cardTitle
                        .toLowerCase()
                        .replace(/\s+/g, "_") // Ubah spasi menjadi underscore
                        .replace(/[^a-z0-9_]/g, "") + // Hapus karakter special
                    "_promo.jpg";

                // Buat request untuk mengambil gambar
                fetch(imageUrl)
                    .then((response) => response.blob())
                    .then((blob) => {
                        // Buat object URL dari blob
                        const blobUrl = window.URL.createObjectURL(blob);

                        // Buat element anchor untuk download
                        const link = document.createElement("a");
                        link.href = blobUrl;
                        link.download = fileName;

                        // Trigger download
                        document.body.appendChild(link);
                        link.click();

                        // Cleanup
                        document.body.removeChild(link);
                        window.URL.revokeObjectURL(blobUrl);
                    })
                    .catch((error) => {
                        console.error("Error downloading image:", error);
                        alert("Gagal mendownload gambar. Silakan coba lagi.");
                    });
            }
        });
    });
});

// ==============================
// UNIVERSAL MEDIA GALLERY
// ==============================
(function () {
    var _items = [], _idx = 0;
    var _ov, _mediaWrap, _prevBtn, _nextBtn, _counter, _closeBtn, _dotsWrap;
    var _touchStartX = 0;

    function _build() {
        if (_ov) return;

        // Overlay
        _ov = document.createElement('div');
        _ov.setAttribute('role', 'dialog');
        _ov.setAttribute('aria-modal', 'true');
        _ov.setAttribute('aria-hidden', 'true');
        _ov.style.cssText = [
            'position:fixed;inset:0;z-index:999999;',
            'display:flex;align-items:center;justify-content:center;',
            'padding:3rem 1rem 1.5rem;',
            'background:rgba(0,0,0,0.92);backdrop-filter:blur(5px);',
            'opacity:0;pointer-events:none;transition:opacity .22s ease;',
        ].join('');

        // Close button — fixed at top-right of the OVERLAY (always reachable)
        _closeBtn = document.createElement('button');
        _closeBtn.type = 'button';
        _closeBtn.setAttribute('aria-label', 'Tutup');
        _closeBtn.style.cssText = [
            'position:absolute;top:0.75rem;right:0.75rem;',
            'width:2.4rem;height:2.4rem;border-radius:50%;',
            'border:2px solid rgba(255,255,255,0.7);',
            'background:rgba(255,255,255,0.12);',
            'color:#fff;font-size:1rem;cursor:pointer;',
            'display:flex;align-items:center;justify-content:center;',
            'transition:background .15s,border-color .15s;',
            'z-index:10;flex-shrink:0;',
        ].join('');
        _closeBtn.innerHTML = '<i class="fas fa-times"></i>';
        _closeBtn.addEventListener('mouseenter', function () {
            _closeBtn.style.background = 'rgba(255,255,255,0.28)';
            _closeBtn.style.borderColor = '#fff';
        });
        _closeBtn.addEventListener('mouseleave', function () {
            _closeBtn.style.background = 'rgba(255,255,255,0.12)';
            _closeBtn.style.borderColor = 'rgba(255,255,255,0.7)';
        });
        _closeBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            _close();
        });

        // Counter — fixed at top-left of the overlay
        _counter = document.createElement('span');
        _counter.style.cssText = [
            'position:absolute;top:1.1rem;left:1rem;',
            'color:rgba(255,255,255,0.85);',
            'font-size:0.82rem;font-weight:600;letter-spacing:0.08em;font-family:sans-serif;',
        ].join('');

        // Inner container (only holds media + dots)
        var inner = document.createElement('div');
        inner.style.cssText = [
            'position:relative;display:flex;flex-direction:column;align-items:center;',
            'width:100%;max-width:min(92vw,860px);gap:10px;',
        ].join('');

        // Media wrap
        _mediaWrap = document.createElement('div');
        _mediaWrap.style.cssText = [
            'position:relative;width:100%;',
            'display:flex;align-items:center;justify-content:center;',
            'background:#111;border-radius:12px;overflow:hidden;',
            'min-height:80px;max-height:80vh;',
        ].join('');

        function _navBtnStyle(side) {
            return 'position:absolute;' + side + ':10px;top:50%;transform:translateY(-50%);z-index:10;' +
                'width:2.5rem;height:2.5rem;border-radius:50%;' +
                'border:2px solid rgba(255,255,255,0.55);background:rgba(0,0,0,0.45);color:#fff;' +
                'display:none;align-items:center;justify-content:center;cursor:pointer;' +
                'transition:background .15s,border-color .15s;flex-shrink:0;font-size:0.9rem;';
        }
        _prevBtn = document.createElement('button');
        _prevBtn.type = 'button'; _prevBtn.setAttribute('aria-label', 'Sebelumnya');
        _prevBtn.style.cssText = _navBtnStyle('left');
        _prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
        _prevBtn.addEventListener('mouseenter', function () { _prevBtn.style.background = 'rgba(103,76,29,0.75)'; _prevBtn.style.borderColor = '#c49a5a'; });
        _prevBtn.addEventListener('mouseleave', function () { _prevBtn.style.background = 'rgba(0,0,0,0.45)'; _prevBtn.style.borderColor = 'rgba(255,255,255,0.55)'; });
        _prevBtn.addEventListener('click', function (e) { e.stopPropagation(); _navigate(-1); });

        _nextBtn = document.createElement('button');
        _nextBtn.type = 'button'; _nextBtn.setAttribute('aria-label', 'Berikutnya');
        _nextBtn.style.cssText = _navBtnStyle('right');
        _nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
        _nextBtn.addEventListener('mouseenter', function () { _nextBtn.style.background = 'rgba(103,76,29,0.75)'; _nextBtn.style.borderColor = '#c49a5a'; });
        _nextBtn.addEventListener('mouseleave', function () { _nextBtn.style.background = 'rgba(0,0,0,0.45)'; _nextBtn.style.borderColor = 'rgba(255,255,255,0.55)'; });
        _nextBtn.addEventListener('click', function (e) { e.stopPropagation(); _navigate(1); });

        _mediaWrap.appendChild(_prevBtn);
        _mediaWrap.appendChild(_nextBtn);

        // Touch swipe
        _mediaWrap.addEventListener('touchstart', function (e) { _touchStartX = e.touches[0].clientX; }, { passive: true });
        _mediaWrap.addEventListener('touchend', function (e) {
            var dx = e.changedTouches[0].clientX - _touchStartX;
            if (Math.abs(dx) > 45) _navigate(dx < 0 ? 1 : -1);
        });

        // Dot indicators
        _dotsWrap = document.createElement('div');
        _dotsWrap.style.cssText = 'display:none;gap:7px;justify-content:center;align-items:center;flex-wrap:wrap;min-height:14px;';

        inner.appendChild(_mediaWrap);
        inner.appendChild(_dotsWrap);
        _ov.appendChild(_counter);
        _ov.appendChild(_closeBtn);
        _ov.appendChild(inner);

        // Click on dark overlay background closes gallery
        _ov.addEventListener('click', function (e) {
            if (e.target === _ov || e.target === inner) _close();
        });

        document.addEventListener('keydown', function (e) {
            if (!_ov || _ov.style.opacity === '0') return;
            if (e.key === 'ArrowLeft') _navigate(-1);
            else if (e.key === 'ArrowRight') _navigate(1);
            else if (e.key === 'Escape') _close();
        });

        document.body.appendChild(_ov);
    }

    function _renderItem() {
        // Remove old media element
        var old = _mediaWrap.querySelector('.gal-media');
        if (old) { var v = old.tagName === 'VIDEO' ? old : null; if (v) v.pause(); old.remove(); }

        var item = _items[_idx];
        var el;
        if (item.type === 'video') {
            el = document.createElement('video');
            el.src = item.src; el.controls = true; el.preload = 'metadata';
            el.style.cssText = 'max-width:100%;max-height:75vh;display:block;border-radius:8px;';
        } else {
            el = document.createElement('img');
            el.src = item.src; el.alt = '';
            el.style.cssText = 'max-width:100%;max-height:75vh;object-fit:contain;display:block;border-radius:8px;';
        }
        el.className = 'gal-media';
        _mediaWrap.insertBefore(el, _prevBtn);

        // Counter
        _counter.textContent = (_idx + 1) + ' / ' + _items.length;

        // Nav buttons
        _prevBtn.style.display = _items.length > 1 && _idx > 0 ? 'flex' : 'none';
        _nextBtn.style.display = _items.length > 1 && _idx < _items.length - 1 ? 'flex' : 'none';

        // Dots
        if (_items.length > 1) {
            _dotsWrap.style.display = 'flex';
            _dotsWrap.innerHTML = '';
            _items.forEach(function (it, i) {
                var dot = document.createElement('button');
                dot.type = 'button';
                dot.setAttribute('aria-label', 'Slide ' + (i + 1));
                var active = i === _idx;
                dot.style.cssText = 'width:' + (active ? '22px' : '8px') + ';height:8px;border-radius:99px;border:none;cursor:pointer;transition:all .2s;background:' + (active ? '#c49a5a' : 'rgba(255,255,255,0.35)') + ';padding:0;flex-shrink:0;';
                (function (idx) { dot.addEventListener('click', function () { _goTo(idx); }); })(i);
                _dotsWrap.appendChild(dot);
            });
        } else {
            _dotsWrap.style.display = 'none';
        }
    }

    function _navigate(dir) {
        var n = _idx + dir;
        if (n < 0 || n >= _items.length) return;
        _goTo(n);
    }

    function _goTo(i) {
        var v = _mediaWrap.querySelector('video');
        if (v) v.pause();
        _idx = i;
        _renderItem();
    }

    function _open(items, startIdx) {
        _build();
        _items = items;
        _idx = Math.max(0, Math.min(startIdx || 0, items.length - 1));
        _renderItem();
        _ov.style.opacity = '1';
        _ov.style.pointerEvents = 'auto';
        _ov.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function _close() {
        if (!_ov) return;
        _ov.style.opacity = '0';
        _ov.style.pointerEvents = 'none';
        _ov.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        var v = _mediaWrap ? _mediaWrap.querySelector('video') : null;
        if (v) v.pause();
    }

    window.openMediaGallery = _open;
    window.closeMediaGallery = _close;

    // ── Global click handler (capture phase) intercepts ALL media preview buttons ──
    document.addEventListener('click', function (e) {
        var btn = e.target.closest(
            '.review-media-preview, .review-widget-media-preview, .review-page-media-preview'
        );
        if (!btn) return;
        e.preventDefault();
        e.stopPropagation();

        // Collect all media items from the same parent card/article
        var container = btn.closest('article') || btn.closest('.reviews-card') || btn.closest('[data-review-id]') || btn.parentElement;
        var allBtns = container
            ? container.querySelectorAll('.review-media-preview, .review-widget-media-preview, .review-page-media-preview')
            : [btn];

        var items = [];
        var clickedIdx = 0;
        allBtns.forEach(function (b) {
            var src = b.getAttribute('data-src');
            var type = b.getAttribute('data-type') || 'image';
            if (src) {
                if (b === btn) clickedIdx = items.length;
                items.push({ src: src, type: type });
            }
        });

        if (items.length) _open(items, clickedIdx);
    }, true); // capture: true — runs before any bubble-phase handlers
})();
