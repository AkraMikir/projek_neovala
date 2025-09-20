console.log("admin.js loaded");

document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM fully loaded");
    console.log(document.getElementById("applyForm")); // pastikan ini tidak null
});

// Toggle Sidebar untuk tampilan mobile
document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector(".sidebar");
    const mainContent = document.querySelector(".main-content");

    // Tambahkan tombol toggle untuk mobile
    const toggleButton = document.createElement("button");
    toggleButton.innerHTML = '<i class="fas fa-bars" aria-hidden="true"></i>';
    toggleButton.classList.add("sidebar-toggle");
    mainContent.insertBefore(toggleButton, mainContent.firstChild);

    // Style untuk tombol toggle
    const style = document.createElement("style");
    style.textContent = `
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: var(--primary-color);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-toggle i {
            transition: transform 0.3s ease;
        }

        @media screen and (max-width: 768px) {
            .sidebar-toggle {
                display: block;
            }
        }
    `;
    document.head.appendChild(style);

    // Fungsi untuk menutup sidebar dan mereset toggle button
    function closeSidebarAndResetToggle() {
        sidebar.classList.remove("active");
        toggleButton.classList.remove("active");
        const icon = toggleButton.querySelector("i");
        if (icon) {
            icon.classList.remove("fa-times");
            icon.classList.add("fa-bars");
        }
    }

    // Event listener untuk toggle sidebar pada mobile
    toggleButton.addEventListener("click", () => {
        sidebar.classList.toggle("active");
        toggleButton.classList.toggle("active");

        // Ubah ikon saat toggle
        const icon = toggleButton.querySelector("i");
        if (sidebar.classList.contains("active")) {
            icon.classList.remove("fa-bars");
            icon.classList.add("fa-times");
        } else {
            icon.classList.remove("fa-times");
            icon.classList.add("fa-bars");
        }
    });

    // Tutup sidebar ketika mengklik di luar sidebar pada mobile
    document.addEventListener("click", (e) => {
        if (window.innerWidth <= 768) {
            if (
                !sidebar.contains(e.target) &&
                !toggleButton.contains(e.target)
            ) {
                closeSidebarAndResetToggle();
            }
        }
    });

    // Dropdown Menu
    const menuItems = document.querySelectorAll(".menu-item");

    menuItems.forEach((item) => {
        const menuButton = item.querySelector(".menu-button");
        const submenuLinks = item.querySelectorAll(".submenu a");

        menuButton.addEventListener("click", (e) => {
            e.preventDefault();

            // Tutup submenu lain
            menuItems.forEach((otherItem) => {
                if (otherItem !== item) {
                    otherItem.classList.remove("active");
                }
            });

            // Toggle active class
            item.classList.toggle("active");
        });

        // Event listener untuk submenu links
        submenuLinks.forEach((link) => {
            link.addEventListener("click", () => {
                if (window.innerWidth <= 768) {
                    closeSidebarAndResetToggle();
                }
            });
        });
    });

    // Section Management
    const adminPanel = document.getElementById("adminPanel");
    const promoSection = document.getElementById("promoSection");
    const komentarSection = document.getElementById("komentarSection");

    const tpjSection = document.getElementById("tpjSection");
    const tpcSection = document.getElementById("tpcSection");
    const gklSection = document.getElementById("gklSection");
    const pluSection = document.getElementById("pluSection");
    const gtwSection = document.getElementById("gtwSection");
    const pgvSection = document.getElementById("pgvSection");

    const changeSlideSection = document.getElementById("changeSlideSection");
    const tpcChangeSlideSection = document.getElementById(
        "tpcChangeSlideSection"
    );
    const gklChangeSlideSection = document.getElementById(
        "gklChangeSlideSection"
    );
    const pluChangeSlideSection = document.getElementById(
        "pluChangeSlideSection"
    );
    const gtwChangeSlideSection = document.getElementById(
        "gtwChangeSlideSection"
    );
    const pgvChangeSlideSection = document.getElementById(
        "pgvChangeSlideSection"
    );

    const editRoomSection = document.getElementById("editRoomSection");
    const tpcEditRoomSection = document.getElementById("tpcEditRoomSection");
    const gklEditRoomSection = document.getElementById("gklEditRoomSection");
    const pluEditRoomSection = document.getElementById("pluEditRoomSection");
    const gtwEditRoomSection = document.getElementById("gtwEditRoomSection");
    const pgvEditRoomSection = document.getElementById("pgvEditRoomSection");

    const createRoomSection = document.getElementById("createRoomSection");
    const tpcCreateRoomSection = document.getElementById(
        "tpcCreateRoomSection"
    );
    const gklCreateRoomSection = document.getElementById(
        "gklCreateRoomSection"
    );
    const pluCreateRoomSection = document.getElementById(
        "pluCreateRoomSection"
    );
    const gtwCreateRoomSection = document.getElementById(
        "gtwCreateRoomSection"
    );
    const pgvCreateRoomSection = document.getElementById(
        "pgvCreateRoomSection"
    );

    const promoLinks = document.querySelectorAll(".promo-link");
    const komentarLinks = document.querySelectorAll(".komentar-link");
    const tpjLinks = document.querySelectorAll(".tpj-link");
    const tpcLinks = document.querySelectorAll(".tpc-link");
    const gklLinks = document.querySelectorAll(".gkl-link");
    const pluLinks = document.querySelectorAll(".plu-link");
    const gtwLinks = document.querySelectorAll(".gtw-link");
    const pgvLinks = document.querySelectorAll(".pgv-link");
    const bscLinks = document.querySelectorAll(".bsc-link");

    const logoLink = document.querySelector(".home-link");
    const changeBtn = document.querySelector(".change-btn");

    const tpcChangeBtn = document.querySelector(".tpc-change-btn");
    const gklChangeBtn = document.querySelector(".gkl-change-btn");
    const pluChangeBtn = document.querySelector(".plu-change-btn");
    const gtwChangeBtn = document.querySelector(".gtw-change-btn");
    const pgvChangeBtn = document.querySelector(".pgv-change-btn");

    const backBtn = document.querySelector(".back-btn");
    const tpcBackBtn = document.querySelector(".tpc-back-btn");
    const gklBackBtn = document.querySelector(".gkl-back-btn");
    const pluBackBtn = document.querySelector(".plu-back-btn");
    const gtwBackBtn = document.querySelector(".gtw-back-btn");
    const pgvBackBtn = document.querySelector(".pgv-back-btn");

    // Fungsi untuk menampilkan section
    function showSection(section) {
        // Sembunyikan semua section
        document
            .querySelectorAll(
                ".admin-section, .promo-section, .komentar-section, .tpj-section, .tpc-section, .gkl-section, .plu-section, .gtw-section, .pgv-section, .change-slide-section, .tpc-change-slide-section, .gkl-change-slide-section, .plu-change-slide-section, .gtw-change-slide-section, .pgv-change-slide-section, .edit-room-section, .tpc-edit-room-section, .gkl-edit-room-section, .plu-edit-room-section, .gtw-edit-room-section, .pgv-edit-room-section, .create-room-section, .tpc-create-room-section, .gkl-create-room-section, .plu-create-room-section, .gtw-create-room-section, .pgv-create-room-section, .detail-data-section, .tpc-detail-data-section, .gkl-detail-data-section, .plu-detail-data-section, .gtw-detail-data-section, .pgv-detail-data-section "
            )
            .forEach((s) => {
                s.style.display = "none";
            });

        // Tampilkan section yang dipilih
        section.style.display = "block";
    }

    // Event listener untuk logo (kembali ke main content)
    if (logoLink) {
        logoLink.addEventListener("click", () => {
            showSection(adminPanel);
            closeSidebarAndResetToggle();
        });
    }

    // Event listener untuk tombol-tombol navigasi
    document
        .querySelectorAll(
            ".promo-link, .komentar-link, .tpj-link, .tpc-link, .gkl-link, .plu-link, .gtw-link, .pgv-link, .bsc-link"
        )
        .forEach((link) => {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                const sectionId = this.classList.contains("promo-link")
                    ? "promoSection"
                    : this.classList.contains("komentar-link")
                    ? "komentarSection"
                    : this.classList.contains("tpj-link")
                    ? "tpjSection"
                    : this.classList.contains("tpc-link")
                    ? "tpcSection"
                    : this.classList.contains("gkl-link")
                    ? "gklSection"
                    : this.classList.contains("plu-link")
                    ? "pluSection"
                    : this.classList.contains("gtw-link")
                    ? "gtwSection"
                    : this.classList.contains("pgv-link")
                    ? "pgvSection"
                    : this.classList.contains("bsc-link")
                    ? "bsc-section"
                    : null;

                if (sectionId) {
                    showSection(document.getElementById(sectionId));
                }
            });
        });

    // Event listener untuk tombol back
    document
        .querySelectorAll(".back-btn, .edit-back-btn, .create-back-btn")
        .forEach((btn) => {
            btn.addEventListener("click", function () {
                showSection(document.getElementById("tpjSection"));
            });
        });

    document
        .querySelectorAll(
            ".tpc-edit-back-btn, .tpc-create-back-btn, .tpc-back-btn-slide, .tpc-back-btn"
        )
        .forEach((btn) => {
            btn.addEventListener("click", function () {
                showSection(document.getElementById("tpcSection"));
            });
        });

    document
        .querySelectorAll(
            ".gkl-edit-back-btn, .gkl-create-back-btn, .gkl-back-btn-slide, .gkl-back-btn"
        )
        .forEach((btn) => {
            btn.addEventListener("click", function () {
                showSection(document.getElementById("gklSection"));
            });
        });

    document
        .querySelectorAll(
            ".plu-edit-back-btn, .plu-create-back-btn, .plu-back-btn-slide, .plu-back-btn"
        )
        .forEach((btn) => {
            btn.addEventListener("click", function () {
                showSection(document.getElementById("pluSection"));
            });
        });

    document
        .querySelectorAll(
            ".gtw-edit-back-btn, .gtw-create-back-btn, .gtw-back-btn-slide, .gtw-back-btn"
        )
        .forEach((btn) => {
            btn.addEventListener("click", function () {
                showSection(document.getElementById("gtwSection"));
            });
        });

    document
        .querySelectorAll(
            ".pgv-edit-back-btn, .pgv-create-back-btn, .pgv-back-btn-slide, .pgv-back-btn"
        )
        .forEach((btn) => {
            btn.addEventListener("click", function () {
                showSection(document.getElementById("pgvSection"));
            });
        });

    document
        .querySelectorAll(
            ".bsc-edit-back-btn, .bsc-create-back-btn, .bsc-back-btn-slide, .bsc-back-btn"
        )
        .forEach((btn) => {
            btn.addEventListener("click", function () {
                if (this.classList.contains("bsc-create-back-btn")) {
                    showSection(document.getElementById("bsc-room-section"));
                } else if (this.classList.contains("bsc-edit-back-btn")) {
                    showSection(document.getElementById("bsc-room-section"));
                } else {
                    showSection(document.getElementById("bsc-section"));
                }
            });
        });

    // Event listener untuk tombol change slide
    document
        .querySelector(".change-btn")
        .addEventListener("click", function () {
            showSection(document.getElementById("changeSlideSection"));
        });

    document
        .querySelector(".tpc-change-btn")
        .addEventListener("click", function () {
            showSection(document.getElementById("tpcChangeSlideSection"));
        });

    document
        .querySelector(".gkl-change-btn")
        .addEventListener("click", function () {
            showSection(document.getElementById("gklChangeSlideSection"));
        });

    document
        .querySelector(".plu-change-btn")
        .addEventListener("click", function () {
            showSection(document.getElementById("pluChangeSlideSection"));
        });

    document
        .querySelector(".gtw-change-btn")
        .addEventListener("click", function () {
            showSection(document.getElementById("gtwChangeSlideSection"));
        });

    document
        .querySelector(".pgv-change-btn")
        .addEventListener("click", function () {
            showSection(document.getElementById("pgvChangeSlideSection"));
        });

    document
        .querySelector(".bsc-change-btn")
        .addEventListener("click", function () {
            showSection(document.getElementById("bsc-change-slide"));
        });

    // BSC Add Room Button
    document
        .querySelector(".bsc-add-room-btn")
        .addEventListener("click", function () {
            showSection(document.getElementById("bsc-create-room"));
        });

    // Delete Room Functionality
    const deletePopup = document.querySelector(".delete-popup");
    let cardToDelete = null;

    // Show popup
    document.querySelectorAll(".delete-room-btn").forEach((btn) => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            deletePopup.classList.add("active");
            cardToDelete = this.closest(".room-card");
        });
    });

    // Cancel popup
    document.querySelector(".popup-cancel").addEventListener("click", () => {
        deletePopup.classList.remove("active");
        cardToDelete = null;
    });

    // Confirm delete
    document.querySelector(".popup-delete").addEventListener("click", () => {
        if (cardToDelete) {
            const deleteBtn = cardToDelete.querySelector(".delete-room-btn");
            const dbId = deleteBtn.getAttribute("data-db-id");

            fetch(`/admin/delete/room/${dbId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    Accept: "application/json",
                },
            })
                .then((response) => {
                    if (response.ok) {
                        cardToDelete.remove();
                        alert("Room berhasil dihapus permanen!");
                    } else {
                        return response.text().then((text) => {
                            throw new Error(text);
                        });
                    }
                })
                .catch((error) => {
                    console.error("Gagal menghapus:", error);
                    alert("Gagal menghapus room. Silakan coba lagi.");
                })
                .finally(() => {
                    deletePopup.classList.remove("active");
                    cardToDelete = null;
                });
        }
    });

    // Close popup when clicking outside
    deletePopup.addEventListener("click", function (e) {
        if (e.target === deletePopup) {
            deletePopup.classList.remove("active");
            cardToDelete = null;
        }
    });

    // PROMO HOME
    document
        .getElementById("promoImage")
        .addEventListener("change", function (event) {
            const file = event.target.files[0];
            const previewArea = document.getElementById("previewArea");

            if (file) {
                const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

                if (!allowedTypes.includes(file.type)) {
                    alert(
                        "Format gambar tidak didukung. Hanya JPG dan PNG yang diperbolehkan."
                    );
                    // Reset input agar bisa upload ulang
                    event.target.value = "";
                    previewArea.innerHTML = `
                <i class="fas fa-image"></i>
                <p>Insert promo card</p>
            `;
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (e) {
                    previewArea.innerHTML = `
                <img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 200px; object-fit: contain;">
            `;
                };

                reader.readAsDataURL(file);
            } else {
                previewArea.innerHTML = `
            <i class="fas fa-image"></i>
            <p>Insert promo card</p>
        `;
            }
        });

    // Komentar Section Functionality
    // Ambil elemen input dari form
    const apartmentInput = document.getElementById("apartmenInput");
    const instagramInput = document.getElementById("instagramInput");
    const messageInput = document.getElementById("isiInput");
    const bintangInput = document.getElementById("bintangInput");
    const komentarIdInput = document.getElementById("komentarId");
    const komentarForm = document.getElementById("komentarForm");
    const submitBtn = document.getElementById("submitBtn");
    const methodInput = document.getElementById("formMethod");

    // DELETE KOMENTAR
    const deleteKomentarButtons = document.querySelectorAll(
        ".komentar-card .delete-btn"
    );
    deleteKomentarButtons.forEach((button) => {
        button.addEventListener("click", (e) => {
            e.preventDefault(); // Cegah aksi default link
            if (confirm("Apakah Anda yakin ingin menghapus komentar ini?")) {
                button.closest("form").submit(); // Submit form delete
            }
        });
    });

    // EDIT KOMENTAR
    const editButtons = document.querySelectorAll(".edit-btn");
    editButtons.forEach((button) => {
        button.addEventListener("click", (e) => {
            e.preventDefault();

            const card = button.closest(".komentar-card");
            const id = button.dataset.id; // asumsikan kamu pasang data-id="{{ $komentar->id }}"

            const apartmen = card.querySelector("h3").textContent.trim();
            const instagram = card
                .querySelector(".instagram-handle")
                .textContent.trim();
            const isi = card
                .querySelector(".komentar-content p")
                .textContent.trim();
            const bintang = card.querySelectorAll(".fa-star").length;

            // Isi ke form
            apartmentInput.value = apartmen;
            instagramInput.value = instagram;
            messageInput.value = isi;
            bintangInput.value = bintang;
            komentarIdInput.value = id;

            // Ubah method form menjadi PATCH & action ke URL update
            komentarForm.action = `/admin/komentar/${id}`;
            methodInput.value = "PATCH";
            submitBtn.textContent = "Update";

            komentarForm.scrollIntoView({ behavior: "smooth" });
        });
    });

    // ==============================
    // ROOM CLICK INPUT FILE FUNCTIONALITY
    // ==============================
    const uploadContainers = document.querySelectorAll(
        ".image-upload-large, .image-upload-small"
    );

    uploadContainers.forEach((container) => {
        const fileInput = container.querySelector(".room-photo-input");

        // Klik pada container akan memicu input file
        container.addEventListener("click", () => {
            if (fileInput) fileInput.click();
        });

        // Saat file dipilih
        if (fileInput) {
            fileInput.addEventListener("change", (event) => {
                const file = event.target.files[0];

                if (file && file.type.startsWith("image/")) {
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        // Hapus preview lama jika ada
                        const oldPreview =
                            container.querySelector("img.preview-image");
                        if (oldPreview) oldPreview.remove();

                        // Sembunyikan ikon dan label
                        const icon = container.querySelector("i");
                        const label = container.querySelector("p");
                        if (icon) icon.style.display = "none";
                        if (label) label.style.display = "none";

                        // Buat dan tambahkan elemen preview gambar baru
                        const imgPreview = document.createElement("img");
                        imgPreview.src = e.target.result;
                        imgPreview.alt = "Preview";
                        imgPreview.classList.add("preview-image");

                        // Gaya agar tetap proporsional dalam rasio 1:1
                        imgPreview.style.width = "98%";
                        imgPreview.style.aspectRatio = "1 / 1"; // CSS modern, memastikan rasio 1:1
                        imgPreview.style.objectFit = "cover"; // Gambar dipotong jika perlu
                        imgPreview.style.borderRadius = "8px";

                        container.appendChild(imgPreview);
                    };

                    reader.readAsDataURL(file);
                }
            });
        }
    });
    // ==============================
    // EDIT ROOM FUNCTION JUANDA
    // ==============================
    document.querySelectorAll(".edit-room-btn").forEach((button) => {
        button.addEventListener("click", () => {
            const roomData = JSON.parse(button.getAttribute("data-room"));

            // Hidden Inputs
            document.querySelector('input[name="room_section"]').value =
                roomData.section || "";
            document.querySelector('input[name="room_id"]').value =
                roomData.id || "";

            // Main Photo
            const mainPhotoContainer = document.querySelector(
                "#editRoomSection .room-main-image .image-upload-large"
            );
            const mainImgTag = mainPhotoContainer.querySelector("img");

            if (mainImgTag && roomData.main_photo) {
                mainImgTag.src = roomData.main_photo;
                mainImgTag.style.display = "block";

                // Tambahkan styling
                mainImgTag.classList.add("preview-image");
                mainImgTag.style.width = "100%";
                mainImgTag.style.height = "auto";
                mainImgTag.style.maxHeight = "100%";
                mainImgTag.style.objectFit = "cover";
                mainImgTag.style.aspectRatio = "1 / 1";
                mainImgTag.style.borderRadius = "8px";
            }

            // Sembunyikan icon dan teks
            const mainIcon = mainPhotoContainer.querySelector("i");
            const mainLabel = mainPhotoContainer.querySelector("p");
            if (mainIcon) mainIcon.style.display = "none";
            if (mainLabel) mainLabel.style.display = "none";

            // Additional Photos
            const additionalContainers = document.querySelectorAll(
                "#editRoomSection .room-additional-images .image-upload-small"
            );

            additionalContainers.forEach((container, index) => {
                const img = container.querySelector("img");
                const popupPhoto = roomData.popup_photos[index];

                if (popupPhoto) {
                    if (img) {
                        img.src = popupPhoto;
                        img.style.display = "block";

                        // Tambahkan styling
                        img.classList.add("preview-image");
                        img.style.width = "100%";
                        img.style.height = "auto";
                        img.style.maxHeight = "100%";
                        img.style.objectFit = "cover";
                        img.style.aspectRatio = "1 / 1";
                        img.style.borderRadius = "8px";
                    }

                    const icon = container.querySelector("i");
                    const label = container.querySelector("p");
                    if (icon) icon.style.display = "none";
                    if (label) label.style.display = "none";
                } else {
                    if (img) {
                        img.src = "";
                        img.style.display = "none";
                    }
                }
            });
        });
    });
    // ==============================
    // EDIT ROOM FUNCTION CIBUBUR
    // ==============================
    document.querySelectorAll(".tpc-edit-room-btn").forEach((button) => {
        button.addEventListener("click", () => {
            const roomData = JSON.parse(button.getAttribute("data-room"));

            // Hidden Inputs
            document.querySelector(
                '#tpcEditRoomSection input[name="room_section"]'
            ).value = roomData.section || "";
            document.querySelector(
                '#tpcEditRoomSection input[name="room_id"]'
            ).value = roomData.id || "";

            // Main Photo
            const mainPhotoContainer = document.querySelector(
                "#tpcEditRoomSection .room-main-image .image-upload-large"
            );
            const mainImgTag = mainPhotoContainer.querySelector("img");

            if (mainImgTag && roomData.main_photo) {
                mainImgTag.src = roomData.main_photo;
                mainImgTag.style.display = "block";
                mainImgTag.classList.add("preview-image");
                mainImgTag.style.width = "100%";
                mainImgTag.style.height = "auto";
                mainImgTag.style.maxHeight = "100%";
                mainImgTag.style.objectFit = "cover";
                mainImgTag.style.aspectRatio = "1 / 1";
                mainImgTag.style.borderRadius = "8px";
            }

            // Sembunyikan icon dan teks
            const mainIcon = mainPhotoContainer.querySelector("i");
            const mainLabel = mainPhotoContainer.querySelector("p");
            if (mainIcon) mainIcon.style.display = "none";
            if (mainLabel) mainLabel.style.display = "none";

            // Additional Photos
            const additionalContainers = document.querySelectorAll(
                "#tpcEditRoomSection .room-additional-images .image-upload-small"
            );

            additionalContainers.forEach((container, index) => {
                const img = container.querySelector("img");
                const popupKey = "popup" + (index + 1);
                const popupPhoto = roomData[popupKey];

                if (popupPhoto) {
                    if (img) {
                        img.src = popupPhoto;
                        img.style.display = "block";
                        img.classList.add("preview-image");
                        img.style.width = "100%";
                        img.style.height = "auto";
                        img.style.maxHeight = "100%";
                        img.style.objectFit = "cover";
                        img.style.aspectRatio = "1 / 1";
                        img.style.borderRadius = "8px";
                    }

                    const icon = container.querySelector("i");
                    const label = container.querySelector("p");
                    if (icon) icon.style.display = "none";
                    if (label) label.style.display = "none";
                } else {
                    if (img) {
                        img.src = "";
                        img.style.display = "none";
                    }
                }
            });

            // Tampilkan edit section
            document.getElementById("tpcEditRoomSection").style.display =
                "block";
        });
    });
    // ==============================
    // EDIT ROOM FUNCTION LAGOON
    // ==============================
    document.querySelectorAll(".gkl-edit-room-btn").forEach((button) => {
        button.addEventListener("click", () => {
            const roomData = JSON.parse(button.getAttribute("data-room"));

            // Hidden Inputs
            document.querySelector(
                '#gklEditRoomSection input[name="room_section"]'
            ).value = roomData.section || "";
            document.querySelector(
                '#gklEditRoomSection input[name="room_id"]'
            ).value = roomData.id || "";

            // Main Photo
            const mainPhotoContainer = document.querySelector(
                "#gklEditRoomSection .room-main-image .image-upload-large"
            );
            const mainImgTag = mainPhotoContainer.querySelector("img");

            if (mainImgTag && roomData.main_photo) {
                mainImgTag.src = roomData.main_photo;
                mainImgTag.style.display = "block";
                mainImgTag.classList.add("preview-image");
                mainImgTag.style.width = "100%";
                mainImgTag.style.height = "auto";
                mainImgTag.style.maxHeight = "100%";
                mainImgTag.style.objectFit = "cover";
                mainImgTag.style.aspectRatio = "1 / 1";
                mainImgTag.style.borderRadius = "8px";
            }

            // Sembunyikan icon dan teks
            const mainIcon = mainPhotoContainer.querySelector("i");
            const mainLabel = mainPhotoContainer.querySelector("p");
            if (mainIcon) mainIcon.style.display = "none";
            if (mainLabel) mainLabel.style.display = "none";

            // Additional Photos
            const additionalContainers = document.querySelectorAll(
                "#gklEditRoomSection .room-additional-images .image-upload-small"
            );

            additionalContainers.forEach((container, index) => {
                const img = container.querySelector("img");
                const popupKey = "popup" + (index + 1);
                const popupPhoto = roomData[popupKey];

                if (popupPhoto) {
                    if (img) {
                        img.src = popupPhoto;
                        img.style.display = "block";
                        img.classList.add("preview-image");
                        img.style.width = "100%";
                        img.style.height = "auto";
                        img.style.maxHeight = "100%";
                        img.style.objectFit = "cover";
                        img.style.aspectRatio = "1 / 1";
                        img.style.borderRadius = "8px";
                    }

                    const icon = container.querySelector("i");
                    const label = container.querySelector("p");
                    if (icon) icon.style.display = "none";
                    if (label) label.style.display = "none";
                } else {
                    if (img) {
                        img.src = "";
                        img.style.display = "none";
                    }
                }
            });

            // Tampilkan edit section
            document.getElementById("gklEditRoomSection").style.display =
                "block";
        });
    });

    // ==============================
    // EDIT ROOM FUNCTION PLU
    // ==============================
    document.querySelectorAll(".plu-edit-room-btn").forEach((button) => {
        button.addEventListener("click", () => {
            const roomData = JSON.parse(button.getAttribute("data-room"));

            // Hidden Inputs
            document.querySelector(
                '#pluEditRoomSection input[name="room_section"]'
            ).value = roomData.section || "";
            document.querySelector(
                '#pluEditRoomSection input[name="room_id"]'
            ).value = roomData.id || "";

            // Main Photo
            const mainPhotoContainer = document.querySelector(
                "#pluEditRoomSection .room-main-image .image-upload-large"
            );
            const mainImgTag = mainPhotoContainer.querySelector("img");

            if (mainImgTag && roomData.main_photo) {
                mainImgTag.src = roomData.main_photo;
                mainImgTag.style.display = "block";
                mainImgTag.classList.add("preview-image");
                mainImgTag.style.width = "100%";
                mainImgTag.style.height = "auto";
                mainImgTag.style.maxHeight = "100%";
                mainImgTag.style.objectFit = "cover";
                mainImgTag.style.aspectRatio = "1 / 1";
                mainImgTag.style.borderRadius = "8px";
            }

            const mainIcon = mainPhotoContainer.querySelector("i");
            const mainLabel = mainPhotoContainer.querySelector("p");
            if (mainIcon) mainIcon.style.display = "none";
            if (mainLabel) mainLabel.style.display = "none";

            // Additional Photos
            const additionalContainers = document.querySelectorAll(
                "#pluEditRoomSection .room-additional-images .image-upload-small"
            );

            additionalContainers.forEach((container, index) => {
                const img = container.querySelector("img");
                const popupKey = "popup" + (index + 1);
                const popupPhoto = roomData[popupKey];

                if (popupPhoto) {
                    if (img) {
                        img.src = popupPhoto;
                        img.style.display = "block";
                        img.classList.add("preview-image");
                        img.style.width = "100%";
                        img.style.height = "auto";
                        img.style.maxHeight = "100%";
                        img.style.objectFit = "cover";
                        img.style.aspectRatio = "1 / 1";
                        img.style.borderRadius = "8px";
                    }

                    const icon = container.querySelector("i");
                    const label = container.querySelector("p");
                    if (icon) icon.style.display = "none";
                    if (label) label.style.display = "none";
                } else {
                    if (img) {
                        img.src = "";
                        img.style.display = "none";
                    }
                }
            });

            document.getElementById("pluEditRoomSection").style.display =
                "block";
        });
    });

    // ==============================
    // EDIT ROOM FUNCTION GTW
    // ==============================
    document.querySelectorAll(".gtw-edit-room-btn").forEach((button) => {
        button.addEventListener("click", () => {
            const roomData = JSON.parse(button.getAttribute("data-room"));

            document.querySelector(
                '#gtwEditRoomSection input[name="room_section"]'
            ).value = roomData.section || "";
            document.querySelector(
                '#gtwEditRoomSection input[name="room_id"]'
            ).value = roomData.id || "";

            const mainPhotoContainer = document.querySelector(
                "#gtwEditRoomSection .room-main-image .image-upload-large"
            );
            const mainImgTag = mainPhotoContainer.querySelector("img");

            if (mainImgTag && roomData.main_photo) {
                mainImgTag.src = roomData.main_photo;
                mainImgTag.style.display = "block";
                mainImgTag.classList.add("preview-image");
                mainImgTag.style.width = "100%";
                mainImgTag.style.height = "auto";
                mainImgTag.style.maxHeight = "100%";
                mainImgTag.style.objectFit = "cover";
                mainImgTag.style.aspectRatio = "1 / 1";
                mainImgTag.style.borderRadius = "8px";
            }

            const mainIcon = mainPhotoContainer.querySelector("i");
            const mainLabel = mainPhotoContainer.querySelector("p");
            if (mainIcon) mainIcon.style.display = "none";
            if (mainLabel) mainLabel.style.display = "none";

            const additionalContainers = document.querySelectorAll(
                "#gtwEditRoomSection .room-additional-images .image-upload-small"
            );

            additionalContainers.forEach((container, index) => {
                const img = container.querySelector("img");
                const popupKey = "popup" + (index + 1);
                const popupPhoto = roomData[popupKey];

                if (popupPhoto) {
                    if (img) {
                        img.src = popupPhoto;
                        img.style.display = "block";
                        img.classList.add("preview-image");
                        img.style.width = "100%";
                        img.style.height = "auto";
                        img.style.maxHeight = "100%";
                        img.style.objectFit = "cover";
                        img.style.aspectRatio = "1 / 1";
                        img.style.borderRadius = "8px";
                    }

                    const icon = container.querySelector("i");
                    const label = container.querySelector("p");
                    if (icon) icon.style.display = "none";
                    if (label) label.style.display = "none";
                } else {
                    if (img) {
                        img.src = "";
                        img.style.display = "none";
                    }
                }
            });

            document.getElementById("gtwEditRoomSection").style.display =
                "block";
        });
    });

    // ==============================
    // EDIT ROOM FUNCTION PGV
    // ==============================
    document.querySelectorAll(".pgv-edit-room-btn").forEach((button) => {
        button.addEventListener("click", () => {
            const roomData = JSON.parse(button.getAttribute("data-room"));

            document.querySelector(
                '#pgvEditRoomSection input[name="room_section"]'
            ).value = roomData.section || "";
            document.querySelector(
                '#pgvEditRoomSection input[name="room_id"]'
            ).value = roomData.id || "";

            const mainPhotoContainer = document.querySelector(
                "#pgvEditRoomSection .room-main-image .image-upload-large"
            );
            const mainImgTag = mainPhotoContainer.querySelector("img");

            if (mainImgTag && roomData.main_photo) {
                mainImgTag.src = roomData.main_photo;
                mainImgTag.style.display = "block";
                mainImgTag.classList.add("preview-image");
                mainImgTag.style.width = "100%";
                mainImgTag.style.height = "auto";
                mainImgTag.style.maxHeight = "100%";
                mainImgTag.style.objectFit = "cover";
                mainImgTag.style.aspectRatio = "1 / 1";
                mainImgTag.style.borderRadius = "8px";
            }

            const mainIcon = mainPhotoContainer.querySelector("i");
            const mainLabel = mainPhotoContainer.querySelector("p");
            if (mainIcon) mainIcon.style.display = "none";
            if (mainLabel) mainLabel.style.display = "none";

            const additionalContainers = document.querySelectorAll(
                "#pgvEditRoomSection .room-additional-images .image-upload-small"
            );

            additionalContainers.forEach((container, index) => {
                const img = container.querySelector("img");
                const popupKey = "popup" + (index + 1);
                const popupPhoto = roomData[popupKey];

                if (popupPhoto) {
                    if (img) {
                        img.src = popupPhoto;
                        img.style.display = "block";
                        img.classList.add("preview-image");
                        img.style.width = "100%";
                        img.style.height = "auto";
                        img.style.maxHeight = "100%";
                        img.style.objectFit = "cover";
                        img.style.aspectRatio = "1 / 1";
                        img.style.borderRadius = "8px";
                    }

                    const icon = container.querySelector("i");
                    const label = container.querySelector("p");
                    if (icon) icon.style.display = "none";
                    if (label) label.style.display = "none";
                } else {
                    if (img) {
                        img.src = "";
                        img.style.display = "none";
                    }
                }
            });

            document.getElementById("pgvEditRoomSection").style.display =
                "block";
        });
    });

    // APARTMENT Section Functionality
    document.addEventListener("DOMContentLoaded", function () {
        // Add Room Button
        const addRoomBtn = document.querySelector(".add-room-btn");
        if (addRoomBtn) {
            addRoomBtn.addEventListener("click", () => {
                showSection(createRoomSection);
            });
        }

        const tpcAddRoomBtn = document.querySelector(".tpc-add-room-btn");
        if (tpcAddRoomBtn) {
            tpcAddRoomBtn.addEventListener("click", () => {
                showSection(tpcCreateRoomSection);
            });
        }

        const gklAddRoomBtn = document.querySelector(".gkl-add-room-btn");
        if (gklAddRoomBtn) {
            gklAddRoomBtn.addEventListener("click", () => {
                showSection(gklCreateRoomSection);
            });
        }

        const pluAddRoomBtn = document.querySelector(".plu-add-room-btn");
        if (pluAddRoomBtn) {
            pluAddRoomBtn.addEventListener("click", () => {
                showSection(pluCreateRoomSection);
            });
        }

        const gtwAddRoomBtn = document.querySelector(".gtw-add-room-btn");
        if (gtwAddRoomBtn) {
            gtwAddRoomBtn.addEventListener("click", () => {
                showSection(gtwCreateRoomSection);
            });
        }

        const pgvAddRoomBtn = document.querySelector(".pgv-add-room-btn");
        if (pgvAddRoomBtn) {
            pgvAddRoomBtn.addEventListener("click", () => {
                showSection(pgvCreateRoomSection);
            });
        }

        // Room Edit & Delete Buttons
        document.querySelectorAll(".room-actions .edit-btn").forEach((btn) => {
            btn.addEventListener("click", () => {
                // Implementasi untuk edit room
                console.log("Edit room clicked");
            });
        });

        document
            .querySelectorAll(".room-actions .delete-btn")
            .forEach((btn) => {
                btn.addEventListener("click", () => {
                    if (
                        confirm("Apakah Anda yakin ingin menghapus kamar ini?")
                    ) {
                        // Implementasi untuk delete room
                        console.log("Delete room clicked");
                    }
                });
            });

        // Comment Apply & Delete Buttons
        document.querySelectorAll(".apply-btn").forEach((btn) => {
            btn.addEventListener("click", () => {
                // Implementasi untuk apply comment
                console.log("Apply comment clicked");
            });
        });

        document
            .querySelectorAll(".comment-card .delete-btn")
            .forEach((btn) => {
                btn.addEventListener("click", () => {
                    if (
                        confirm(
                            "Apakah Anda yakin ingin menghapus komentar ini?"
                        )
                    ) {
                        // Implementasi untuk delete comment
                        console.log("Delete comment clicked");
                    }
                });
            });

        // Form Data Detail & Delete Buttons
        document.querySelectorAll(".detail-btn").forEach((btn) => {
            btn.addEventListener("click", () => {
                // Implementasi untuk view detail
                console.log("View detail clicked");
            });
        });

        document
            .querySelectorAll(".form-data-table .delete-btn")
            .forEach((btn) => {
                btn.addEventListener("click", () => {
                    if (
                        confirm("Apakah Anda yakin ingin menghapus data ini?")
                    ) {
                        // Implementasi untuk delete data
                        console.log("Delete data clicked");
                    }
                });
            });
    });

    // Room Management
    const addRoomBtn = document.querySelector(".add-room-btn");
    const tpcAddRoomBtn = document.querySelector(".tpc-add-room-btn");
    const gklAddRoomBtn = document.querySelector(".gkl-add-room-btn");
    const pluAddRoomBtn = document.querySelector(".plu-add-room-btn");
    const gtwAddRoomBtn = document.querySelector(".gtw-add-room-btn");
    const pgvAddRoomBtn = document.querySelector(".pgv-add-room-btn");

    const editRoomButtons = document.querySelectorAll(".edit-room-btn");
    const tpcEditRoomButtons = document.querySelectorAll(".tpc-edit-room-btn");
    const gklEditRoomButtons = document.querySelectorAll(".gkl-edit-room-btn");
    const pluEditRoomButtons = document.querySelectorAll(".plu-edit-room-btn");
    const gtwEditRoomButtons = document.querySelectorAll(".gtw-edit-room-btn");
    const pgvEditRoomButtons = document.querySelectorAll(".pgv-edit-room-btn");

    const editBackBtn = document.querySelector(".edit-back-btn");
    const createBackBtn = document.querySelector(".create-back-btn");

    // Add Room Button
    if (addRoomBtn) {
        addRoomBtn.addEventListener("click", () => {
            console.log("Add Room clicked");
            showSection(document.getElementById("createRoomSection"));
        });
    }

    if (tpcAddRoomBtn) {
        tpcAddRoomBtn.addEventListener("click", () => {
            console.log("TPC Add Room clicked");
            showSection(document.getElementById("tpcCreateRoomSection"));
        });
    }

    if (gklAddRoomBtn) {
        gklAddRoomBtn.addEventListener("click", () => {
            console.log("gkl Add Room clicked");
            showSection(document.getElementById("gklCreateRoomSection"));
        });
    }

    if (pluAddRoomBtn) {
        pluAddRoomBtn.addEventListener("click", () => {
            console.log("plu Add Room clicked");
            showSection(document.getElementById("pluCreateRoomSection"));
        });
    }

    if (gtwAddRoomBtn) {
        gtwAddRoomBtn.addEventListener("click", () => {
            console.log("gtw Add Room clicked");
            showSection(document.getElementById("gtwCreateRoomSection"));
        });
    }

    if (pgvAddRoomBtn) {
        pgvAddRoomBtn.addEventListener("click", () => {
            console.log("pgv Add Room clicked");
            showSection(document.getElementById("pgvCreateRoomSection"));
        });
    }

    // Edit Room Buttons
    if (editRoomButtons) {
        editRoomButtons.forEach((btn) => {
            btn.addEventListener("click", () => {
                showSection(document.getElementById("editRoomSection"));
            });
        });
    }

    if (tpcEditRoomButtons) {
        tpcEditRoomButtons.forEach((btn) => {
            btn.addEventListener("click", () => {
                showSection(document.getElementById("tpcEditRoomSection"));
            });
        });
    }
    if (gklEditRoomButtons) {
        gklEditRoomButtons.forEach((btn) => {
            btn.addEventListener("click", () => {
                showSection(document.getElementById("gklEditRoomSection"));
            });
        });
    }

    if (pluEditRoomButtons) {
        pluEditRoomButtons.forEach((btn) => {
            btn.addEventListener("click", () => {
                showSection(document.getElementById("pluEditRoomSection"));
            });
        });
    }

    if (gtwEditRoomButtons) {
        gtwEditRoomButtons.forEach((btn) => {
            btn.addEventListener("click", () => {
                showSection(document.getElementById("gtwEditRoomSection"));
            });
        });
    }

    if (pgvEditRoomButtons) {
        pgvEditRoomButtons.forEach((btn) => {
            btn.addEventListener("click", () => {
                showSection(document.getElementById("pgvEditRoomSection"));
            });
        });
    }

    // Back Button di Edit Room
    if (editBackBtn) {
        editBackBtn.addEventListener("click", () => {
            showSection(document.getElementById("tpjSection"));
        });
    }

    // Back Button di Create Room
    if (createBackBtn) {
        createBackBtn.addEventListener("click", () => {
            showSection(document.getElementById("tpjSection"));
        });
    }

    // More Buttons (menghapus navigasi ke edit section)
    document.querySelectorAll(".more-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            // Tidak melakukan apa-apa ketika tombol more diklik
            console.log("More button clicked");
        });
    });

    document.querySelectorAll(".tpc-more-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            console.log("More button clicked");
        });
    });

    // Detail Button Click Handler
    const detailButtons = document.querySelectorAll(".detail-btn");
    const tpcDetailButtons = document.querySelectorAll(".tpc-detail-btn");
    const gklDetailButtons = document.querySelectorAll(".gkl-detail-btn");
    const pluDetailButtons = document.querySelectorAll(".plu-detail-btn");
    const gtwDetailButtons = document.querySelectorAll(".gtw-detail-btn");
    const pgvDetailButtons = document.querySelectorAll(".pgv-detail-btn");

    const detailBackBtn = document.querySelector(".detail-container .back-btn");
    const tpcDetailBackBtn = document.querySelector(
        ".tpc-detail-container .tpc-back-btn"
    );
    const gklDetailBackBtn = document.querySelector(
        ".gkl-detail-container .gkl-back-btn"
    );
    const pluDetailBackBtn = document.querySelector(
        ".plu-detail-container .plu-back-btn"
    );
    const gtwDetailBackBtn = document.querySelector(
        ".gtw-detail-container .gtw-back-btn"
    );
    const pgvDetailBackBtn = document.querySelector(
        ".pgv-detail-container .pgv-back-btn"
    );

    //tpj detail controll
    detailButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            // Mendapatkan data dari row
            const row = this.closest(".form-data-row");
            const nama = row.querySelector(
                ".data-cell:nth-child(1)"
            ).textContent;
            const noTelp = row.querySelector(
                ".data-cell:nth-child(2)"
            ).textContent;
            const lamaSewa = row.querySelector(
                ".data-cell:nth-child(3)"
            ).textContent;
            const ukuranKamar = row.querySelector(
                ".data-cell:nth-child(4)"
            ).textContent;

            // Update detail section dengan data
            document.getElementById("detailNama").textContent = nama;
            document.getElementById("detailNoTelp").textContent = noTelp;
            document.getElementById("detailLamaSewa").textContent = lamaSewa;
            document.getElementById("detailUkuranKamar").textContent =
                ukuranKamar;

            // Tampilkan section detail
            showSection(document.getElementById("detailDataSection"));
        });
    });

    //tpc detail controll
    tpcDetailButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            // Mendapatkan data dari row
            const row = this.closest(".form-data-row");
            const nama = row.querySelector(
                ".data-cell:nth-child(1)"
            ).textContent;
            const noTelp = row.querySelector(
                ".data-cell:nth-child(2)"
            ).textContent;
            const lamaSewa = row.querySelector(
                ".data-cell:nth-child(3)"
            ).textContent;
            const ukuranKamar = row.querySelector(
                ".data-cell:nth-child(4)"
            ).textContent;

            // Update detail section dengan data
            document.getElementById("detailNama").textContent = nama;
            document.getElementById("detailNoTelp").textContent = noTelp;
            document.getElementById("detailLamaSewa").textContent = lamaSewa;
            document.getElementById("detailUkuranKamar").textContent =
                ukuranKamar;

            // Tampilkan section detail
            showSection(document.getElementById("tpcDetailDataSection"));
        });
    });

    //gkl detail controll
    gklDetailButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            // Mendapatkan data dari row
            const row = this.closest(".form-data-row");
            const nama = row.querySelector(
                ".data-cell:nth-child(1)"
            ).textContent;
            const noTelp = row.querySelector(
                ".data-cell:nth-child(2)"
            ).textContent;
            const lamaSewa = row.querySelector(
                ".data-cell:nth-child(3)"
            ).textContent;
            const ukuranKamar = row.querySelector(
                ".data-cell:nth-child(4)"
            ).textContent;

            // Update detail section dengan data
            document.getElementById("detailNama").textContent = nama;
            document.getElementById("detailNoTelp").textContent = noTelp;
            document.getElementById("detailLamaSewa").textContent = lamaSewa;
            document.getElementById("detailUkuranKamar").textContent =
                ukuranKamar;

            // Tampilkan section detail
            showSection(document.getElementById("gklDetailDataSection"));
        });
    });

    //gkl detail controll
    gklDetailButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            // Mendapatkan data dari row
            const row = this.closest(".form-data-row");
            const nama = row.querySelector(
                ".data-cell:nth-child(1)"
            ).textContent;
            const noTelp = row.querySelector(
                ".data-cell:nth-child(2)"
            ).textContent;
            const lamaSewa = row.querySelector(
                ".data-cell:nth-child(3)"
            ).textContent;
            const ukuranKamar = row.querySelector(
                ".data-cell:nth-child(4)"
            ).textContent;

            // Update detail section dengan data
            document.getElementById("detailNama").textContent = nama;
            document.getElementById("detailNoTelp").textContent = noTelp;
            document.getElementById("detailLamaSewa").textContent = lamaSewa;
            document.getElementById("detailUkuranKamar").textContent =
                ukuranKamar;

            // Tampilkan section detail
            showSection(document.getElementById("gklDetailDataSection"));
        });
    });

    //plu detail controll
    pluDetailButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            // Mendapatkan data dari row
            const row = this.closest(".form-data-row");
            const nama = row.querySelector(
                ".data-cell:nth-child(1)"
            ).textContent;
            const noTelp = row.querySelector(
                ".data-cell:nth-child(2)"
            ).textContent;
            const lamaSewa = row.querySelector(
                ".data-cell:nth-child(3)"
            ).textContent;
            const ukuranKamar = row.querySelector(
                ".data-cell:nth-child(4)"
            ).textContent;

            // Update detail section dengan data
            document.getElementById("detailNama").textContent = nama;
            document.getElementById("detailNoTelp").textContent = noTelp;
            document.getElementById("detailLamaSewa").textContent = lamaSewa;
            document.getElementById("detailUkuranKamar").textContent =
                ukuranKamar;

            // Tampilkan section detail
            showSection(document.getElementById("pluDetailDataSection"));
        });
    });

    //gtw detail controll
    gtwDetailButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            // Mendapatkan data dari row
            const row = this.closest(".form-data-row");
            const nama = row.querySelector(
                ".data-cell:nth-child(1)"
            ).textContent;
            const noTelp = row.querySelector(
                ".data-cell:nth-child(2)"
            ).textContent;
            const lamaSewa = row.querySelector(
                ".data-cell:nth-child(3)"
            ).textContent;
            const ukuranKamar = row.querySelector(
                ".data-cell:nth-child(4)"
            ).textContent;

            // Update detail section dengan data
            document.getElementById("detailNama").textContent = nama;
            document.getElementById("detailNoTelp").textContent = noTelp;
            document.getElementById("detailLamaSewa").textContent = lamaSewa;
            document.getElementById("detailUkuranKamar").textContent =
                ukuranKamar;

            // Tampilkan section detail
            showSection(document.getElementById("gtwDetailDataSection"));
        });
    });

    //pgv detail controll
    pgvDetailButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            // Mendapatkan data dari row
            const row = this.closest(".form-data-row");
            const nama = row.querySelector(
                ".data-cell:nth-child(1)"
            ).textContent;
            const noTelp = row.querySelector(
                ".data-cell:nth-child(2)"
            ).textContent;
            const lamaSewa = row.querySelector(
                ".data-cell:nth-child(3)"
            ).textContent;
            const ukuranKamar = row.querySelector(
                ".data-cell:nth-child(4)"
            ).textContent;

            // Update detail section dengan data
            document.getElementById("detailNama").textContent = nama;
            document.getElementById("detailNoTelp").textContent = noTelp;
            document.getElementById("detailLamaSewa").textContent = lamaSewa;
            document.getElementById("detailUkuranKamar").textContent =
                ukuranKamar;

            // Tampilkan section detail
            showSection(document.getElementById("pgvDetailDataSection"));
        });
    });

    // tpj Back Button Handler
    if (detailBackBtn) {
        detailBackBtn.addEventListener("click", function (e) {
            e.preventDefault();
            showSection(document.getElementById("tpjSection"));
        });
    }

    //tpc back button handler
    if (tpcDetailBackBtn) {
        tpcDetailBackBtn.addEventListener("click", function (e) {
            e.preventDefault();
            showSection(document.getElementById("tpcSection"));
        });
    }
    //gkl back button handler
    if (gklDetailBackBtn) {
        gklDetailBackBtn.addEventListener("click", function (e) {
            e.preventDefault();
            showSection(document.getElementById("gklSection"));
        });
    }

    //plu back button handler
    if (pluDetailBackBtn) {
        pluDetailBackBtn.addEventListener("click", function (e) {
            e.preventDefault();
            showSection(document.getElementById("pluSection"));
        });
    }

    //gtw back button handler
    if (gtwDetailBackBtn) {
        gtwDetailBackBtn.addEventListener("click", function (e) {
            e.preventDefault();
            showSection(document.getElementById("gtwSection"));
        });
    }

    //pgv back button handler
    if (pgvDetailBackBtn) {
        pgvDetailBackBtn.addEventListener("click", function (e) {
            e.preventDefault();
            showSection(document.getElementById("pgvSection"));
        });
    }

    // TPJ Carousel functionality
    const carousel = document.querySelector(".carousel-container");
    const slides = document.querySelectorAll(".carousel-slide");
    const dots = document.querySelectorAll(".carousel-dot");
    const prevButton = document.querySelector(".carousel-button.prev");
    const nextButton = document.querySelector(".carousel-button.next");
    let currentSlide = 0;

    function updateCarousel() {
        carousel.style.transform = `translateX(-${currentSlide * 25}%)`;
        dots.forEach((dot, index) => {
            dot.classList.toggle("active", index === currentSlide);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        updateCarousel();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        updateCarousel();
    }

    // Event listeners for carousel
    if (prevButton && nextButton) {
        prevButton.addEventListener("click", prevSlide);
        nextButton.addEventListener("click", nextSlide);
    }

    // Add click events to dots
    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            currentSlide = index;
            updateCarousel();
        });
    });

    // Auto advance slides every 5 seconds
    setInterval(nextSlide, 5000);

    // TPC Carousel functionality
    const tpcCarousel = document.querySelector(".tpc-carousel-container");
    const tpcSlides = document.querySelectorAll(".tpc-carousel-slide");
    const tpcDots = document.querySelectorAll(".tpc-carousel-dot");
    const tpcPrevButton = document.querySelector(".tpc-carousel-button.prev");
    const tpcNextButton = document.querySelector(".tpc-carousel-button.next");
    let tpcCurrentSlide = 0;

    function tpcUpdateCarousel() {
        tpcCarousel.style.transform = `translateX(-${tpcCurrentSlide * 25}%)`;
        tpcDots.forEach((dot, index) => {
            dot.classList.toggle("active", index === tpcCurrentSlide);
        });
    }

    function tpcNextSlide() {
        tpcCurrentSlide = (tpcCurrentSlide + 1) % tpcSlides.length;
        tpcUpdateCarousel();
    }

    function tpcPrevSlide() {
        tpcCurrentSlide =
            (tpcCurrentSlide - 1 + tpcSlides.length) % tpcSlides.length;
        tpcUpdateCarousel();
    }

    // Event listeners for carousel
    if (tpcPrevButton && tpcNextButton) {
        tpcPrevButton.addEventListener("click", tpcPrevSlide);
        tpcNextButton.addEventListener("click", tpcNextSlide);
    }

    // Add click events to dots
    tpcDots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            tpcCurrentSlide = index;
            tpcUpdateCarousel();
        });
    });

    // Auto advance slides every 5 seconds
    setInterval(tpcNextSlide, 5000);

    // LAGOON Carousel functionality
    const gklCarousel = document.querySelector(".gkl-carousel-container");
    const gklSlides = document.querySelectorAll(".gkl-carousel-slide");
    const gklDots = document.querySelectorAll(".gkl-carousel-dot");
    const gklPrevButton = document.querySelector(".gkl-carousel-button.prev");
    const gklNextButton = document.querySelector(".gkl-carousel-button.next");
    let gklCurrentSlide = 0;

    function gklUpdateCarousel() {
        gklCarousel.style.transform = `translateX(-${gklCurrentSlide * 25}%)`;
        gklDots.forEach((dot, index) => {
            dot.classList.toggle("active", index === gklCurrentSlide);
        });
    }

    function gklNextSlide() {
        gklCurrentSlide = (gklCurrentSlide + 1) % gklSlides.length;
        gklUpdateCarousel();
    }

    function gklPrevSlide() {
        gklCurrentSlide =
            (gklCurrentSlide - 1 + gklSlides.length) % gklSlides.length;
        gklUpdateCarousel();
    }

    // Event listeners for carousel
    if (gklPrevButton && gklNextButton) {
        gklPrevButton.addEventListener("click", gklPrevSlide);
        gklNextButton.addEventListener("click", gklNextSlide);
    }

    // Add click events to dots
    gklDots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            gklCurrentSlide = index;
            gklUpdateCarousel();
        });
    });

    // Auto advance slides every 5 seconds
    setInterval(gklNextSlide, 5000);

    // URBANO Carousel functionality
    const pluCarousel = document.querySelector(".plu-carousel-container");
    const pluSlides = document.querySelectorAll(".plu-carousel-slide");
    const pluDots = document.querySelectorAll(".plu-carousel-dot");
    const pluPrevButton = document.querySelector(".plu-carousel-button.prev");
    const pluNextButton = document.querySelector(".plu-carousel-button.next");
    let pluCurrentSlide = 0;

    function pluUpdateCarousel() {
        pluCarousel.style.transform = `translateX(-${pluCurrentSlide * 25}%)`;
        pluDots.forEach((dot, index) => {
            dot.classList.toggle("active", index === pluCurrentSlide);
        });
    }

    function pluNextSlide() {
        pluCurrentSlide = (pluCurrentSlide + 1) % pluSlides.length;
        pluUpdateCarousel();
    }

    function pluPrevSlide() {
        pluCurrentSlide =
            (pluCurrentSlide - 1 + pluSlides.length) % pluSlides.length;
        pluUpdateCarousel();
    }

    // Event listeners for carousel
    if (pluPrevButton && pluNextButton) {
        pluPrevButton.addEventListener("click", pluPrevSlide);
        pluNextButton.addEventListener("click", pluNextSlide);
    }

    // Add click events to dots
    pluDots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            pluCurrentSlide = index;
            pluUpdateCarousel();
        });
    });

    // Auto advance slides every 5 seconds
    setInterval(pluNextSlide, 5000);

    // Gateway Carousel functionality
    const gtwCarousel = document.querySelector(".gtw-carousel-container");
    const gtwSlides = document.querySelectorAll(".gtw-carousel-slide");
    const gtwDots = document.querySelectorAll(".gtw-carousel-dot");
    const gtwPrevButton = document.querySelector(".gtw-carousel-button.prev");
    const gtwNextButton = document.querySelector(".gtw-carousel-button.next");
    let gtwCurrentSlide = 0;

    function gtwUpdateCarousel() {
        gtwCarousel.style.transform = `translateX(-${gtwCurrentSlide * 25}%)`;
        gtwDots.forEach((dot, index) => {
            dot.classList.toggle("active", index === gtwCurrentSlide);
        });
    }

    function gtwNextSlide() {
        gtwCurrentSlide = (gtwCurrentSlide + 1) % gtwSlides.length;
        gtwUpdateCarousel();
    }

    function gtwPrevSlide() {
        gtwCurrentSlide =
            (gtwCurrentSlide - 1 + gtwSlides.length) % gtwSlides.length;
        gtwUpdateCarousel();
    }

    // Event listeners for carousel
    if (gtwPrevButton && gtwNextButton) {
        gtwPrevButton.addEventListener("click", gtwPrevSlide);
        gtwNextButton.addEventListener("click", gtwNextSlide);
    }

    // Add click events to dots
    gtwDots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            gtwCurrentSlide = index;
            gtwUpdateCarousel();
        });
    });

    // Auto advance slides every 5 seconds
    setInterval(gtwNextSlide, 5000);

    // Podomoro Carousel functionality
    const pgvCarousel = document.querySelector(".pgv-carousel-container");
    const pgvSlides = document.querySelectorAll(".pgv-carousel-slide");
    const pgvDots = document.querySelectorAll(".pgv-carousel-dot");
    const pgvPrevButton = document.querySelector(".pgv-carousel-button.prev");
    const pgvNextButton = document.querySelector(".pgv-carousel-button.next");
    let pgvCurrentSlide = 0;

    function pgvUpdateCarousel() {
        pgvCarousel.style.transform = `translateX(-${pgvCurrentSlide * 25}%)`;
        pgvDots.forEach((dot, index) => {
            dot.classList.toggle("active", index === pgvCurrentSlide);
        });
    }

    function pgvNextSlide() {
        pgvCurrentSlide = (pgvCurrentSlide + 1) % pgvSlides.length;
        pgvUpdateCarousel();
    }

    function pgvPrevSlide() {
        pgvCurrentSlide =
            (pgvCurrentSlide - 1 + pgvSlides.length) % pgvSlides.length;
        pgvUpdateCarousel();
    }

    // Event listeners for carousel
    if (pgvPrevButton && pgvNextButton) {
        pgvPrevButton.addEventListener("click", pgvPrevSlide);
        pgvNextButton.addEventListener("click", pgvNextSlide);
    }

    // Add click events to dots
    pgvDots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            pgvCurrentSlide = index;
            pgvUpdateCarousel();
        });
    });

    // Auto advance slides every 5 seconds
    setInterval(pgvNextSlide, 5000);

    document.querySelectorAll(".select-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const input = btn.parentElement.querySelector(".file-input");
            if (input) input.click();
        });
    });

    // Preview gambar saat dipilih
    document.querySelectorAll(".file-input").forEach((input, index) => {
        input.addEventListener("change", (e) => {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = function (event) {
                const img = input.closest(".slide-image").querySelector("img");
                img.src = event.target.result;
            };
            if (file) reader.readAsDataURL(file);
        });
    });

    const inputs = document.querySelectorAll(".file-input");
    const updateBtn = document.querySelector(".update-btn");
    const updateTpcBtn = document.querySelector(".tpc-update-btn-slide");
    const updateGklBtn = document.querySelector(".gkl-update-btn-slide");
    const updatePluBtn = document.querySelector(".plu-update-btn-slide");
    const updateGtwBtn = document.querySelector(".gtw-update-btn-slide");
    const updatePgvBtn = document.querySelector(".pgv-update-btn-slide");

    inputs.forEach((input) => {
        input.addEventListener("change", () => {
            updateBtn.style.display = "inline-block";
        });
    });
    inputs.forEach((input) => {
        input.addEventListener("change", () => {
            updateTpcBtn.style.display = "inline-block";
        });
    });
    inputs.forEach((input) => {
        input.addEventListener("change", () => {
            updateGklBtn.style.display = "inline-block";
        });
    });
    inputs.forEach((input) => {
        input.addEventListener("change", () => {
            updatePluBtn.style.display = "inline-block";
        });
    });
    inputs.forEach((input) => {
        input.addEventListener("change", () => {
            updateGtwBtn.style.display = "inline-block";
        });
    });
    inputs.forEach((input) => {
        input.addEventListener("change", () => {
            updatePgvBtn.style.display = "inline-block";
        });
    });

    //POPUP NEW CODE
    document.querySelectorAll(".more-btn").forEach((button) => {
        button.addEventListener("click", () => {
            const popupId = button.getAttribute("data-popup-id");
            document.getElementById(popupId)?.classList.add("active");
        });
    });

    document.querySelectorAll(".room-popup-close").forEach((button) => {
        button.addEventListener("click", () => {
            button.closest(".room-popup-overlay")?.classList.remove("active");
        });
    });

    // Handle Room popup carousel navigation
    document.querySelectorAll(".room-popup-nav").forEach((button) => {
        button.addEventListener("click", () => {
            const isNext = button.classList.contains("next");
            const roomName = button.dataset.room;
            const carousel = document.querySelector(`#carousel-${roomName}`);
            const slides = carousel.querySelectorAll(".room-popup-slide");
            let currentIndex = Array.from(slides).findIndex((slide) =>
                slide.classList.contains("active")
            );

            slides[currentIndex].classList.remove("active");

            if (isNext) {
                currentIndex = (currentIndex + 1) % slides.length;
            } else {
                currentIndex =
                    (currentIndex - 1 + slides.length) % slides.length;
            }

            slides[currentIndex].classList.add("active");
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    // === APPLY ===
    document.querySelectorAll(".apply-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id?.trim();
            const section = btn.dataset.section?.trim();
            const form = document.getElementById(`applyForm-${section}`);
            const popup = document.querySelector(`.apply-popup-${section}`);
            if (form && popup && id && section) {
                form.action = `/komentar-${section}/${id}/accept`;
                popup.style.display = "flex";
            } else {
                console.error(
                    "Apply form or popup not found for section:",
                    section
                );
            }
        });
    });

    // Cancel ALL Apply Popups
    document.querySelectorAll(".popup-cancel-comment").forEach((btn) => {
        btn.addEventListener("click", () => {
            document
                .querySelectorAll(".apply-comment-popup")
                .forEach((popup) => {
                    popup.style.display = "none";
                });
        });
    });

    // === UNAPPLY ===
    document.querySelectorAll(".unapply-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id?.trim();
            const section = btn.dataset.section?.trim();
            const form = document.getElementById(`unapplyForm-${section}`);
            const popup = document.querySelector(`.unapply-popup-${section}`);
            if (form && popup && id && section) {
                form.action = `/komentar-${section}/${id}/unapply`;
                popup.style.display = "flex";
            } else {
                console.error(
                    "Unapply form or popup not found for section:",
                    section
                );
            }
        });
    });

    // Cancel ALL Unapply Popups
    document
        .querySelectorAll(".popup-cancel-unapply-comment")
        .forEach((btn) => {
            btn.addEventListener("click", () => {
                document
                    .querySelectorAll(".unapply-comment-popup")
                    .forEach((popup) => {
                        popup.style.display = "none";
                    });
            });
        });

    // === DELETE ===
    document.querySelectorAll(".delete-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id?.trim();
            const section = btn.dataset.section?.trim();
            const form = document.getElementById(`deleteForm-${section}`);
            const popup = document.querySelector(`.delete-popup-${section}`);
            if (form && popup && id && section) {
                form.action = `/komentar-${section}/${id}/delete`;
                popup.style.display = "flex";
            } else {
                console.error(
                    "Delete form or popup not found for section:",
                    section
                );
            }
        });
    });

    // Cancel ALL Delete Popups
    document.querySelectorAll(".popup-cancel-delete-comment").forEach((btn) => {
        btn.addEventListener("click", () => {
            document
                .querySelectorAll(".delete-comment-popup")
                .forEach((popup) => {
                    popup.style.display = "none";
                });
        });
    });
});

//INI BUATT FUNGSI FUNGSI FORM DATA YAAAAAAAAAAAAAAAAAAAAAAA
function loadFormDataForAllSections() {
    const sections = document.querySelectorAll(".form-data-section");

    sections.forEach((section) => {
        const apartmentType = section.getAttribute("data-apartment");
        const formDataBody = section.querySelector(".form-data-body");

        fetch(`/get-form-data/${encodeURIComponent(apartmentType)}`)
            .then((response) => response.json())
            .then((data) => {
                formDataBody.innerHTML = "";

                if (data.length > 0) {
                    data.forEach((item) => {
                        formDataBody.innerHTML += `
                            <div class="form-data-row">
                                <div class="data-cell">${item.nama}</div>
                                <div class="data-cell">${item.nomor_wa}</div>
                                <div class="data-cell">${item.durasi}</div>
                                <div class="data-cell">${item.tipe_kamar}</div>
                                <div class="data-cell actions">
                                    <button class="detail-btn" onclick="showDetail(${item.id})">Detail</button>
                                    <button class="delete-btn-data trigger-delete-popup" data-id="${item.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    formDataBody.innerHTML = `
                        <div class="form-data-row">
                            <div class="data-cell" colspan="5">Tidak ada data</div>
                        </div>
                    `;
                }
            })
            .catch((error) => {
                console.error("Error fetching form data:", error);
                formDataBody.innerHTML =
                    '<div class="form-data-row"><div class="data-cell" colspan="5">Gagal memuat data</div></div>';
            });
    });
}

// Panggil ketika halaman dimuat
setInterval(loadFormDataForAllSections, 5000);
document.addEventListener("DOMContentLoaded", loadFormDataForAllSections);

function showDetail(id) {
    fetch(`/form-data/${id}`)
        .then((response) => response.json())
        .then((data) => {
            document.getElementById("detailNama").textContent = data.nama;
            document.getElementById("detailNoTelp").textContent = data.nomor_wa;
            document.getElementById("detailLamaSewa").textContent = data.durasi;
            document.getElementById("detailUkuranKamar").textContent =
                data.tipe_kamar;
            document.getElementById("detailTanggalMasuk").textContent =
                data.tanggal_checkin;
            document.getElementById("detailJamKedatangan").textContent =
                data.jam_kedatangan;
            document.getElementById("detailCatatan").textContent =
                data.pesan || "-";

            document.getElementById("detailDataSection").style.display = "flex";
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Gagal memuat detail data");
        });
}

function hideDetail() {
    document.getElementById("detailDataSection").style.display = "none";
}

// Close detail when clicking outside
document
    .getElementById("detailDataSection")
    .addEventListener("click", function (e) {
        if (e.target === this) {
            hideDetail();
        }
    });

//FORM DATA KELAR WOI ANJAY TAKBIRRRRRRRRRRR

document.addEventListener("DOMContentLoaded", function () {
    const deletePopup = document.getElementById("deletePopup");
    let selectedFormDataRow = null;

    // Ketika klik tombol tempat sampah
    document.body.addEventListener("click", function (e) {
        const deleteBtn = e.target.closest(".trigger-delete-popup");

        if (deleteBtn) {
            const id = deleteBtn.getAttribute("data-id");
            selectedFormDataRow = deleteBtn.closest(".form-data-row");

            // Simpan ID di tombol Hapus pada popup
            document
                .querySelector(".popup-delete-data")
                .setAttribute("data-id", id);

            deletePopup.classList.add("active");
        }
    });

    // Tombol "Tidak" / batal
    document
        .querySelector(".popup-cancel-delete-data")
        .addEventListener("click", () => {
            deletePopup.classList.remove("active");
            selectedFormDataRow = null;
        });

    // Tombol "Hapus"
    document
        .querySelector(".popup-delete-data")
        .addEventListener("click", function () {
            const id = this.getAttribute("data-id");

            fetch(`/admin/delete-form/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    Accept: "application/json",
                },
            })
                .then((response) => {
                    if (response.ok) {
                        // Hapus baris dari UI
                        if (selectedFormDataRow) selectedFormDataRow.remove();
                        alert("Data berhasil dihapus!");
                    } else {
                        return response.json().then((json) => {
                            throw new Error(
                                json.message ||
                                    "Terjadi kesalahan saat menghapus."
                            );
                        });
                    }
                })
                .catch((error) => {
                    console.error("Gagal menghapus:", error);
                    alert("Gagal menghapus data. Silakan coba lagi.");
                })
                .finally(() => {
                    deletePopup.classList.remove("active");
                    selectedFormDataRow = null;
                });
        });

    // Klik di luar popup untuk menutup
    deletePopup.addEventListener("click", function (e) {
        if (e.target === deletePopup) {
            deletePopup.classList.remove("active");
            selectedFormDataRow = null;
        }
    });

    // ========================================== -->
    // BSC (BASSURA CITY) FUNCTIONS -->
    // ========================================== -->

    // BSC Carousel Functions
    let bscCurrentSlideIndex = 0;
    const bscSlides = document.querySelectorAll("#bsc-section .carousel-slide");
    const bscDots = document.querySelectorAll("#bsc-section .carousel-dot");

    function bscUpdateCarousel() {
        bscSlides.forEach((slide, index) => {
            slide.classList.toggle("active", index === bscCurrentSlideIndex);
        });
        bscDots.forEach((dot, index) => {
            dot.classList.toggle("active", index === bscCurrentSlideIndex);
        });
    }

    function bscNextSlide() {
        bscCurrentSlideIndex = (bscCurrentSlideIndex + 1) % bscSlides.length;
        bscUpdateCarousel();
    }

    function bscPrevSlide() {
        bscCurrentSlideIndex =
            (bscCurrentSlideIndex - 1 + bscSlides.length) % bscSlides.length;
        bscUpdateCarousel();
    }

    function bscCurrentSlide(n) {
        bscCurrentSlideIndex = n - 1;
        bscUpdateCarousel();
    }

    function bscSelectSlide(slideNumber) {
        console.log("BSC Slide selected:", slideNumber);
        showSection("bsc-section");
    }
});
