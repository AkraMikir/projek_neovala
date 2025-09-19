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
            if (bookNowBtn) {
                bookNowBtn.classList.add("visible");
            }
        } else {
            navbar.classList.remove("scrolled");
            if (bookNowBtn) {
                bookNowBtn.classList.remove("visible");
            }
        }
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
            // Ensure Book Now button stays visible if it was visible
            if (bookNowBtn.classList.contains("visible")) {
                bookNowBtn.style.zIndex = "100";
            }
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

    // Auto slide setiap 5 detik
    setInterval(() => {
        showSlide(currentSlide + 1);
    }, 2000);

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
