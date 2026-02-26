/**
 * review-likes.js
 *
 * Script handle like functionality di semua halaman.
 * Include di layout utama agar berlaku di mana saja.
 */

document.addEventListener('DOMContentLoaded', function () {

    const COLOR_ACTIVE   = '#674c1d';
    const COLOR_INACTIVE = '#9e9e9e';
    const CSRF_TOKEN     = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    let isProcessing = {};

    function initLikeStates() {
        const likeButtons = document.querySelectorAll('.like-btn[data-review-id]');
        if (likeButtons.length === 0) return;

        const reviewIds = Array.from(likeButtons).map(btn => btn.dataset.reviewId);

        fetch('/reviews/check-likes', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ review_ids: reviewIds }),
            credentials: 'same-origin',
        })
        .then(res => res.json())
        .then(data => {
            const likedIds = data.liked_ids || [];

            likeButtons.forEach(btn => {
                const reviewId = parseInt(btn.dataset.reviewId);
                const icon = btn.querySelector('.like-icon');
                const count = btn.querySelector('.like-count');

                if (likedIds.includes(reviewId)) {
                    setLikeActive(icon, true);
                    btn.dataset.liked = 'true';
                } else {
                    setLikeActive(icon, false);
                    btn.dataset.liked = 'false';
                }
            });
        })
        .catch(err => console.error('Error checking like states:', err));
    }

    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.like-btn[data-review-id]');
        if (!btn) return;

        e.preventDefault();
        e.stopPropagation();

        const reviewId = btn.dataset.reviewId;

        if (isProcessing[reviewId]) return;
        isProcessing[reviewId] = true;

        const icon = btn.querySelector('.like-icon');
        const countEl = btn.querySelector('.like-count');

        fetch(`/reviews/${reviewId}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json',
            },
            credentials: 'same-origin',
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.querySelectorAll(`.like-btn[data-review-id="${reviewId}"]`).forEach(b => {
                    const ic = b.querySelector('.like-icon');
                    const ct = b.querySelector('.like-count');

                    if (data.action === 'liked') {
                        setLikeActive(ic, true);
                        b.dataset.liked = 'true';
                    } else {
                        setLikeActive(ic, false);
                        b.dataset.liked = 'false';
                    }

                    if (ct) ct.textContent = data.likes_count;
                });
            }
        })
        .catch(err => console.error('Error toggling like:', err))
        .finally(() => {
            isProcessing[reviewId] = false;
        });
    });

    function setLikeActive(iconEl, isActive) {
        if (!iconEl) return;

        if (isActive) {
            iconEl.style.color = COLOR_ACTIVE;
            iconEl.classList.add('liked');
            iconEl.classList.remove('not-liked');
        } else {
            iconEl.style.color = COLOR_INACTIVE;
            iconEl.classList.remove('liked');
            iconEl.classList.add('not-liked');
        }
    }

    initLikeStates();
    window.initLikeStates = initLikeStates;
});
