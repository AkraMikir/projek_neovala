// ========================================== -->
// BSC (BASSURA CITY) ADMIN FUNCTIONS -->
// ========================================== -->

// BSC Carousel Functions
let bscCurrentSlideIndex = 0;
let bscCurrentRoomId = null;

function bscUpdateCarousel() {
    const bscSlides = document.querySelectorAll("#bsc-section .carousel-slide");
    const bscDots = document.querySelectorAll("#bsc-section .carousel-dot");

    bscSlides.forEach((slide, index) => {
        slide.classList.toggle("active", index === bscCurrentSlideIndex);
    });
    bscDots.forEach((dot, index) => {
        dot.classList.toggle("active", index === bscCurrentSlideIndex);
    });
}

function bscNextSlide() {
    const bscSlides = document.querySelectorAll("#bsc-section .carousel-slide");
    bscCurrentSlideIndex = (bscCurrentSlideIndex + 1) % bscSlides.length;
    bscUpdateCarousel();
}

function bscPrevSlide() {
    const bscSlides = document.querySelectorAll("#bsc-section .carousel-slide");
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

// BSC Room Management Functions
function bscCreateRoom() {
    const mainImage = document.getElementById("bsc-main-image").files[0];
    const roomImages = [
        document.getElementById("bsc-room-image-1").files[0],
        document.getElementById("bsc-room-image-2").files[0],
        document.getElementById("bsc-room-image-3").files[0],
        document.getElementById("bsc-room-image-4").files[0],
    ];

    if (!mainImage) {
        alert("Please select a main image");
        return;
    }

    const formData = new FormData();
    formData.append("main_image", mainImage);
    formData.append("apartment_type", "bsc");

    roomImages.forEach((image, index) => {
        if (image) {
            formData.append(`room_image_${index + 1}`, image);
        }
    });

    fetch("/admin/room/create", {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert("Room created successfully!");
                bscLoadRooms();
                showSection("bsc-room-section");
            } else {
                alert("Error creating room: " + data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Error creating room");
        });
}

function bscUpdateRoom() {
    const mainImage = document.getElementById("bsc-edit-main-image").files[0];
    const roomImages = [
        document.getElementById("bsc-edit-room-image-1").files[0],
        document.getElementById("bsc-edit-room-image-2").files[0],
        document.getElementById("bsc-edit-room-image-3").files[0],
        document.getElementById("bsc-edit-room-image-4").files[0],
    ];

    const formData = new FormData();
    formData.append("apartment_type", "bsc");
    formData.append("_method", "PUT");

    if (mainImage) {
        formData.append("main_image", mainImage);
    }

    roomImages.forEach((image, index) => {
        if (image) {
            formData.append(`room_image_${index + 1}`, image);
        }
    });

    fetch(`/admin/room/update/${bscCurrentRoomId}`, {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert("Room updated successfully!");
                bscLoadRooms();
                showSection("bsc-room-section");
            } else {
                alert("Error updating room: " + data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Error updating room");
        });
}

function bscLoadRooms() {
    fetch("/admin/rooms/bsc")
        .then((response) => response.json())
        .then((data) => {
            const roomCards = document.getElementById("bsc-room-cards");
            roomCards.innerHTML = "";

            data.rooms.forEach((room) => {
                const roomCard = document.createElement("div");
                roomCard.className = "room-card";
                roomCard.innerHTML = `
                <div class="room-card-header">
                    <div class="left-text">Bassura City</div>
                    <div class="right-text">
                        <div class="room-type">Room Type</div>
                        <div class="room-logo">
                            <img src="${room.main_image}" alt="Room Image">
                        </div>
                    </div>
                </div>
                <div class="room-card-image">
                    <img src="${room.main_image}" alt="Room Image">
                    <button class="more-btn" onclick="bscShowRoomPopup(${room.id})">More</button>
                </div>
                <div class="room-action-buttons">
                    <button class="edit-room-btn" onclick="bscEditRoom(${room.id})">Edit Room</button>
                    <button class="delete-room-btn" onclick="bscDeleteRoom(${room.id})">Delete</button>
                </div>
            `;
                roomCards.appendChild(roomCard);
            });
        })
        .catch((error) => {
            console.error("Error loading rooms:", error);
        });
}

function bscEditRoom(roomId) {
    bscCurrentRoomId = roomId;
    showSection("bsc-edit-room");
}

function bscDeleteRoom(roomId) {
    if (confirm("Are you sure you want to delete this room?")) {
        fetch(`/admin/room/delete/${roomId}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert("Room deleted successfully!");
                    bscLoadRooms();
                } else {
                    alert("Error deleting room: " + data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("Error deleting room");
            });
    }
}

function bscShowRoomPopup(roomId) {
    fetch(`/admin/room/details/${roomId}`)
        .then((response) => response.json())
        .then((data) => {
            console.log("Room details:", data);
        })
        .catch((error) => {
            console.error("Error loading room details:", error);
        });
}

// BSC Comments Functions
function bscLoadComments() {
    fetch("/admin/comments/bsc")
        .then((response) => response.json())
        .then((data) => {
            const commentCards = document.getElementById("bsc-comment-cards");
            commentCards.innerHTML = "";

            data.comments.forEach((comment) => {
                const commentCard = document.createElement("div");
                commentCard.className = "comment-card";
                commentCard.innerHTML = `
                <div class="comment-header">
                    <i class="fas fa-quote-left"></i>
                </div>
                <div class="comment-content">
                    <p>${comment.comment}</p>
                </div>
                <div class="comment-footer">
                    <div class="comment-info">
                        <span class="comment-user">${comment.user_name}</span>
                        <div class="star-rating">
                            ${Array(5)
                                .fill(0)
                                .map(
                                    (_, i) =>
                                        `<i class="fas fa-star ${
                                            i < comment.rating
                                                ? "star-filled"
                                                : "star-empty"
                                        }"></i>`
                                )
                                .join("")}
                        </div>
                    </div>
                    <div class="comment-actions">
                        <button class="apply-btn" onclick="bscApplyComment(${
                            comment.id
                        })">Apply</button>
                        <button class="unapply-btn" onclick="bscUnapplyComment(${
                            comment.id
                        })">Unapply</button>
                        <button class="delete-btn" onclick="bscDeleteComment(${
                            comment.id
                        })">Delete</button>
                    </div>
                </div>
            `;
                commentCards.appendChild(commentCard);
            });
        })
        .catch((error) => {
            console.error("Error loading comments:", error);
        });
}

function bscApplyComment(commentId) {
    fetch(`/komentar-bsc/${commentId}/accept`, {
        method: "PATCH",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert("Comment applied successfully!");
                bscLoadComments();
            } else {
                alert("Error applying comment: " + data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Error applying comment");
        });
}

function bscUnapplyComment(commentId) {
    fetch(`/komentar-bsc/${commentId}/unapply`, {
        method: "PATCH",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert("Comment unapplied successfully!");
                bscLoadComments();
            } else {
                alert("Error unapplying comment: " + data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Error unapplying comment");
        });
}

function bscDeleteComment(commentId) {
    if (confirm("Are you sure you want to delete this comment?")) {
        fetch(`/komentar-bsc/${commentId}/delete`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert("Comment deleted successfully!");
                    bscLoadComments();
                } else {
                    alert("Error deleting comment: " + data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("Error deleting comment");
            });
    }
}

// BSC Form Data Functions
function bscLoadFormData() {
    fetch("/get-form-data/bsc")
        .then((response) => response.json())
        .then((data) => {
            const formDataBody = document.getElementById("bsc-form-data-body");
            formDataBody.innerHTML = "";

            data.formData.forEach((item) => {
                const formDataRow = document.createElement("div");
                formDataRow.className = "form-data-row";
                formDataRow.innerHTML = `
                <div class="data-cell">${item.nama}</div>
                <div class="data-cell">${item.no_hp}</div>
                <div class="data-cell">${item.lama_sewa}</div>
                <div class="data-cell">${item.ukuran_kamar}</div>
                <div class="data-cell actions">
                    <button class="detail-btn" onclick="bscShowDetail(${item.id})">Detail</button>
                    <button class="delete-btn-data" onclick="bscDeleteFormData(${item.id})">Delete</button>
                </div>
            `;
                formDataBody.appendChild(formDataRow);
            });
        })
        .catch((error) => {
            console.error("Error loading form data:", error);
        });
}

function bscShowDetail(id) {
    fetch(`/form-data/${id}`)
        .then((response) => response.json())
        .then((data) => {
            console.log("Form data detail:", data);
        })
        .catch((error) => {
            console.error("Error loading detail:", error);
        });
}

function bscDeleteFormData(id) {
    if (confirm("Are you sure you want to delete this form data?")) {
        fetch(`/admin/delete-form/${id}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert("Form data deleted successfully!");
                    bscLoadFormData();
                } else {
                    alert("Error deleting form data: " + data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("Error deleting form data");
            });
    }
}

// BSC Event Listeners
document.addEventListener("DOMContentLoaded", function () {
    const bscLink = document.querySelector(".bsc-link");
    if (bscLink) {
        bscLink.addEventListener("click", function () {
            showSection("bsc-section");
            bscLoadRooms();
            bscLoadComments();
            bscLoadFormData();
        });
    }
});
