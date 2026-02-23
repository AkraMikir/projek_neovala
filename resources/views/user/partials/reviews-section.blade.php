{{-- Tailwind reviews section for discover pages. Expects: $reviews, $reviewAggregate, $location (e.g. spl) --}}
<section id="testimoni-section" class="py-12 px-4 bg-stone-50">
    <div class="max-w-5xl mx-auto">
        <h2 class="text-2xl font-bold text-amber-900 text-center mb-2">WHAT THEY SAY?</h2>
        <div class="border-b-2 border-amber-800 w-24 mx-auto mb-6"></div>

        <div id="reviews-aggregate" class="flex flex-wrap items-center justify-center gap-4 mb-6">
            <div class="text-center px-4">
                <span class="text-2xl font-bold text-amber-800">{{ number_format($reviewAggregate['avg'] ?? 0, 1) }}</span>
                <p class="text-sm text-stone-600">Rating</p>
            </div>
            <div class="text-center px-4 border-l border-stone-300">
                <span class="text-xl font-semibold text-amber-800">{{ number_format($reviewAggregate['count'] ?? 0) }}</span>
                <p class="text-sm text-stone-600">Ulasan</p>
            </div>
        </div>

        <div class="reviews-filter-bar flex flex-wrap gap-2 justify-center mb-6" data-location="{{ $location ?? '' }}">
            <span class="text-stone-600 text-sm">Filter:</span>
            <button type="button" class="reviews-filter-btn px-3 py-1 rounded bg-amber-800 text-white" data-sort="latest" data-rating="">Terbaru</button>
            <button type="button" class="reviews-filter-btn px-3 py-1 rounded bg-stone-200 text-stone-700" data-sort="longest" data-rating="">Waktu terlama</button>
            @for ($r = 5; $r >= 1; $r--)
                <button type="button" class="reviews-filter-btn px-3 py-1 rounded bg-stone-200 text-stone-700" data-sort="latest" data-rating="{{ $r }}">{{ $r }} Bintang</button>
            @endfor
        </div>

        <div class="text-center mb-4">
            <a href="{{ route('reviews.detail.discover', $location) }}" class="text-[#674c1d] font-medium hover:underline">Lihat semua ulasan</a>
        </div>

        <div class="w-[90%] max-w-6xl mx-auto">
            <div class="reviews-slider-outer relative mb-10">
                <button type="button" class="reviews-slider-btn reviews-slider-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 z-10 w-10 h-10 rounded-full bg-amber-800 text-white shadow-md hover:bg-amber-900 items-center justify-center transition-opacity disabled:pointer-events-none" style="display:none;" aria-label="Lihat ulasan sebelumnya">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" class="reviews-slider-btn reviews-slider-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-1 z-10 w-10 h-10 rounded-full bg-amber-800 text-white shadow-md hover:bg-amber-900 flex items-center justify-center transition-opacity disabled:pointer-events-none" aria-label="Lihat ulasan berikutnya">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div id="reviews-list" class="reviews-slider-track flex gap-3 overflow-x-auto overflow-y-hidden py-2 px-1 scroll-smooth snap-x snap-mandatory" style="scrollbar-width: thin;">
                    @forelse($reviews as $review)
                        <div class="reviews-card relative flex-shrink-0 w-64 max-w-[85vw] snap-start bg-white rounded-lg shadow-sm p-3 border border-stone-100 flex flex-col justify-center min-h-[140px]">
                            <div class="reviews-card-inner">
                                <p class="text-stone-800 text-xs leading-snug line-clamp-4 mb-1.5">{{ $review->content }}</p>
                                <div class="flex items-center gap-1 mb-0.5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-[#674c1d]' : 'text-stone-200' }} text-xs"></i>
                                    @endfor
                                </div>
                                <p class="text-stone-500 text-[11px] truncate">{{ $review->hide_identity ? 'Anonymous' : '@' . ($review->instagram ?? '') }} · {{ $review->created_at->format('d M Y') }}</p>
                                @if($review->replies->count() > 0)
                                    <div class="mt-2 relative">
                                        <button type="button" class="review-reply-toggle w-full text-left text-[11px] text-[#674c1d] font-medium flex items-center gap-1 hover:underline focus:outline-none" aria-expanded="false">
                                            <i class="fas fa-chevron-down review-reply-chevron text-[10px] transition-transform duration-200"></i>
                                            Balasan admin ({{ $review->replies->count() }})
                                        </button>
                                        <div class="review-reply-dropdown hidden absolute left-0 right-0 top-full mt-1 z-[50] pl-3 border-l-2 border-stone-400 bg-stone-100 rounded-r py-2 pr-2 shadow-lg min-w-[200px]">
                                            @foreach($review->replies as $reply)
                                                <p class="text-[11px] text-[#674c1d] font-medium">{{ $reply->admin->name ?? 'Admin' }}</p>
                                                <p class="text-[11px] text-stone-600 leading-tight">{{ $reply->content }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="flex-shrink-0 text-center text-stone-500 py-4 w-full text-sm">Belum ada ulasan.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-[#674c1d] text-center mb-6" style="font-family: 'Georgia', serif;">GIVE US FEEDBACK</h2>
        <div class="bg-white rounded-2xl shadow-md p-6 max-w-xl mx-auto border border-[#674c1d]/15">
            <form action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data" id="reviewForm">
                @csrf
                <input type="hidden" name="location" value="{{ $location }}">

                {{-- Rating: centered, dark-brown stars --}}
                <div class="mb-5">
                    <input type="hidden" name="rating" id="ratingInput" value="0" required>
                    <div class="flex justify-center gap-1.5" id="starSelect">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="far fa-star text-2xl cursor-pointer transition-colors text-[#674c1d] hover:text-[#5a4218]" data-rating="{{ $i }}"></i>
                        @endfor
                    </div>
                </div>

                {{-- Instagram: old-style @ prefix --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[#674c1d] mb-1.5">Instagram:</label>
                    <div class="flex rounded-xl border border-[#674c1d]/35 overflow-hidden bg-stone-50/50">
                        <span class="inline-flex items-center pl-3 text-[#674c1d]/80 text-sm">@</span>
                        <input type="text" name="instagram" class="flex-1 min-w-0 py-2.5 pr-3 pl-1 text-sm border-0 bg-transparent placeholder:text-[#674c1d]/40 focus:ring-0" placeholder="your instagram" maxlength="50">
                    </div>
                </div>

                {{-- Hide identity: switch toggle (like old) --}}
                <div class="mb-4">
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-[#674c1d]/80">hide</span>
                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input id="hideIdentityToggle" type="checkbox" name="hide_identity" value="on" class="sr-only peer">
                            <div class="w-11 h-6 bg-stone-200 rounded-full peer-checked:bg-[#674c1d] transition-colors"></div>
                            <div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                        </label>
                        <span class="text-sm text-[#674c1d]/80">Sembunyikan identitas</span>
                    </div>
                </div>

                {{-- Pesan --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-[#674c1d] mb-1.5">Pesan:</label>
                    <textarea name="content" rows="4" class="w-full rounded-xl border border-[#674c1d]/35 px-3 py-2.5 text-sm placeholder:text-[#674c1d]/40 focus:border-[#674c1d]/60 focus:ring-1 focus:ring-[#674c1d]/15 resize-y" placeholder="Silakan tulis pesanmu di sini..." required maxlength="2000"></textarea>
                </div>

                {{-- Gambar: + adds slots (max 5) --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[#674c1d] mb-2">Gambar (max 5)</label>
                    <div class="flex flex-wrap gap-3 items-center">
                        <button type="button" id="addPhotoBtn" class="flex items-center justify-center w-12 h-12 rounded-xl border-2 border-dashed border-[#674c1d]/45 text-[#674c1d] hover:bg-stone-50 hover:border-[#674c1d]/65 transition-colors" title="Tambah foto">
                            <i class="fas fa-plus text-lg"></i>
                        </button>
                        <span id="photoCount" class="text-xs text-[#674c1d]/60">0/5 foto</span>
                    </div>
                    <div id="photoSlots" class="mt-3 flex flex-wrap gap-2"></div>
                </div>

                {{-- Video: styled like old, dark-brown dashed --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-[#674c1d] mb-2">Video (max 1)</label>
                    <input type="file" name="video" id="videoInput" accept="video/*" class="hidden">
                    <button type="button" id="addVideoBtn" class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border-2 border-dashed border-[#674c1d]/45 text-[#674c1d] hover:bg-stone-50 hover:border-[#674c1d]/65 transition-colors text-sm">
                        <i class="fas fa-video"></i>
                        <span id="videoLabel">Tambah video</span>
                    </button>
                </div>

                <button type="submit" class="w-full py-3 rounded-xl bg-[#674c1d] text-white font-medium hover:bg-[#5a4218] transition-colors border border-black/10">Kirim</button>
            </form>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reviewForm');
    const starSelect = document.getElementById('starSelect');
    const ratingInput = document.getElementById('ratingInput');
    const addPhotoBtn = document.getElementById('addPhotoBtn');
    const photoSlots = document.getElementById('photoSlots');
    const photoCount = document.getElementById('photoCount');
    const videoInput = document.getElementById('videoInput');
    const addVideoBtn = document.getElementById('addVideoBtn');
    const videoLabel = document.getElementById('videoLabel');

    if (starSelect && ratingInput) {
        starSelect.querySelectorAll('[data-rating]').forEach(function(star) {
            star.addEventListener('click', function() {
                const r = parseInt(this.getAttribute('data-rating'), 10);
                ratingInput.value = r;
                starSelect.querySelectorAll('[data-rating]').forEach(function(s, i) {
                    s.classList.toggle('fas', i < r);
                    s.classList.toggle('far', i >= r);
                });
            });
        });
    }

    // Photos: + button adds a new slot (max 5). Each slot is its own input named images[].
    const imageInputs = [];
    function getSelectedImageCount() {
        return imageInputs.filter(x => x.input.files && x.input.files.length > 0).length;
    }
    function updatePhotoUi() {
        if (!photoCount || !addPhotoBtn) return;
        const selected = getSelectedImageCount();
        photoCount.textContent = selected + '/5 foto';
        addPhotoBtn.style.display = selected >= 5 ? 'none' : 'flex';
    }
    function addImageSlot() {
        if (!photoSlots) return;
        if (getSelectedImageCount() >= 5) return;

        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'images[]';
        input.accept = 'image/*';
        input.className = 'hidden';

        const slot = document.createElement('div');
        slot.className = 'relative w-12 h-12 rounded-xl overflow-hidden border-2 border-dashed border-[#674c1d]/45 bg-stone-50 flex items-center justify-center';
        slot.innerHTML = '<i class=\"fas fa-image text-[#674c1d]/70\"></i>';

        const rm = document.createElement('button');
        rm.type = 'button';
        rm.className = 'absolute -top-1 -right-1 w-5 h-5 rounded-full bg-red-600 text-white text-xs flex items-center justify-center shadow';
        rm.textContent = '×';

        function removeSlot() {
            const idx = imageInputs.findIndex(x => x.input === input);
            if (idx >= 0) imageInputs.splice(idx, 1);
            input.remove();
            slot.remove();
            updatePhotoUi();
        }
        rm.addEventListener('click', removeSlot);

        input.addEventListener('change', function () {
            const file = input.files && input.files[0];
            if (!file) {
                removeSlot();
                return;
            }
            slot.innerHTML = '';
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'w-full h-full object-cover';
            img.onload = function () { URL.revokeObjectURL(img.src); };
            slot.appendChild(img);
            slot.appendChild(rm);
            updatePhotoUi();
        });

        imageInputs.push({ input, slot });
        photoSlots.appendChild(input);
        photoSlots.appendChild(slot);
        slot.appendChild(rm);
        input.click();
        updatePhotoUi();
    }
    if (addPhotoBtn) {
        addPhotoBtn.addEventListener('click', addImageSlot);
        updatePhotoUi();
    }

    if (addVideoBtn && videoInput) {
        addVideoBtn.addEventListener('click', function() { videoInput.click(); });
        videoInput.addEventListener('change', function() {
            if (this.files && this.files.length) videoLabel.textContent = this.files[0].name || '1 video dipilih';
        });
    }

    if (form) {
        form.addEventListener('submit', function(e) {
            if (parseInt(ratingInput?.value || 0, 10) < 1) {
                e.preventDefault();
                alert('Pilih rating 1-5 bintang.');
            }
        });
    }

    // Reviews filter (no refresh) on discover pages
    var bar = document.querySelector('#testimoni-section .reviews-filter-bar');
    var listEl = document.getElementById('reviews-list');
    var aggEl = document.getElementById('reviews-aggregate');
    if (bar && listEl && aggEl) {
        function renderCard(r) {
            var identity = r.hide_identity ? 'Anonymous' : ('@' + (r.instagram || ''));
            var stars = '';
            for (var i = 1; i <= 5; i++) {
                stars += '<i class="fas fa-star ' + (i <= r.rating ? 'text-[#674c1d]' : 'text-stone-200') + ' text-xs"></i>';
            }
            var repliesHtml = '';
            if (r.replies && r.replies.length) {
                var replyBlocks = r.replies.map(function(rep) {
                    return '<p class="text-[11px] text-[#674c1d] font-medium">' + (rep.admin_name || 'Admin') + '</p><p class="text-[11px] text-stone-600 leading-tight">' + (rep.content || '') + '</p>';
                }).join('');
                repliesHtml = '<div class="mt-2 relative">' +
                    '<button type="button" class="review-reply-toggle w-full text-left text-[11px] text-[#674c1d] font-medium flex items-center gap-1 hover:underline focus:outline-none" aria-expanded="false">' +
                    '<i class="fas fa-chevron-down review-reply-chevron text-[10px] transition-transform duration-200"></i> Balasan admin (' + r.replies.length + ')</button>' +
                    '<div class="review-reply-dropdown hidden absolute left-0 right-0 top-full mt-1 z-[50] pl-3 border-l-2 border-stone-400 bg-stone-100 rounded-r py-2 pr-2 shadow-lg min-w-[200px]">' + replyBlocks + '</div></div>';
            }
            return '<div class="reviews-card relative flex-shrink-0 w-64 max-w-[85vw] snap-start bg-white rounded-lg shadow-sm p-3 border border-stone-100 flex flex-col justify-center min-h-[140px]">' +
                '<div class="reviews-card-inner">' +
                '<p class="text-stone-800 text-xs leading-snug line-clamp-4 mb-1.5">' + (r.content || '') + '</p>' +
                '<div class="flex items-center gap-1 mb-0.5">' + stars + '</div>' +
                '<p class="text-stone-500 text-[11px] truncate">' + identity + ' · ' + (r.created_at || '') + '</p>' + repliesHtml + '</div></div>';
        }
        function setActiveBtn(activeBtn) {
            bar.querySelectorAll('.reviews-filter-btn').forEach(function(btn) {
                btn.classList.remove('bg-amber-800', 'text-white');
                btn.classList.add('bg-stone-200', 'text-stone-700');
            });
            activeBtn.classList.remove('bg-stone-200', 'text-stone-700');
            activeBtn.classList.add('bg-amber-800', 'text-white');
        }
        bar.querySelectorAll('.reviews-filter-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                setActiveBtn(this);
                var location = (bar.getAttribute('data-location') || '').trim();
                var sort = this.getAttribute('data-sort') || 'latest';
                var rating = (this.getAttribute('data-rating') || '').trim();
                var params = new URLSearchParams();
                if (location) params.set('location', location);
                params.set('sort', sort);
                if (rating) params.set('rating', rating);
                if (window.closeReviewsReplyDropdown) window.closeReviewsReplyDropdown();
                listEl.innerHTML = '<p class="flex-shrink-0 text-center text-stone-500 py-4 w-full">Memuat...</p>';
                fetch('/api/reviews?' + params.toString())
                    .then(function(res) { return res.json(); })
                    .then(function(data) {
                        aggEl.querySelector('.text-2xl').textContent = Number(data.aggregate.avg).toFixed(1);
                        aggEl.querySelector('.text-xl').textContent = data.aggregate.count;
                        if (!data.reviews || data.reviews.length === 0) {
                            listEl.innerHTML = '<p class="flex-shrink-0 text-center text-stone-500 py-4 w-full">Belum ada ulasan.</p>';
                        } else {
                            listEl.innerHTML = data.reviews.map(renderCard).join('');
                        }
                        if (typeof updateReviewsSliderButtons === 'function') updateReviewsSliderButtons();
                    })
                    .catch(function() {
                        listEl.innerHTML = '<p class="flex-shrink-0 text-center text-stone-500 py-4 w-full">Gagal memuat ulasan.</p>';
                        if (typeof updateReviewsSliderButtons === 'function') updateReviewsSliderButtons();
                    });
            });
        });
    }

    // Reviews slider: satu baris, tombol kiri hilang saat di awal (biar komentar keliatan)
    var sliderTrack = document.getElementById('reviews-list');
    var sliderPrev = document.querySelector('#testimoni-section .reviews-slider-prev');
    var sliderNext = document.querySelector('#testimoni-section .reviews-slider-next');
    if (sliderTrack && sliderPrev && sliderNext) {
        var CARD_GAP = 16;
        var getCardWidth = function() {
            var card = sliderTrack.querySelector('.reviews-card');
            return card ? card.offsetWidth + CARD_GAP : 304;
        };
        updateReviewsSliderButtons = function() {
            var hasCards = sliderTrack.querySelectorAll('.reviews-card').length > 0;
            if (!hasCards) {
                sliderPrev.style.setProperty('display', 'none');
                sliderNext.style.setProperty('display', 'none');
                return;
            }
            var tw = sliderTrack.scrollWidth;
            var cw = sliderTrack.clientWidth;
            var sl = Math.round(sliderTrack.scrollLeft);
            if (tw <= cw + 2) {
                sliderPrev.style.setProperty('display', 'none');
                sliderNext.style.setProperty('display', 'none');
                sliderPrev.disabled = true;
                sliderNext.disabled = true;
            } else {
                sliderPrev.style.setProperty('display', sl <= 2 ? 'none' : 'flex');
                sliderPrev.disabled = sl <= 2;
                sliderNext.style.setProperty('display', (sl + cw >= tw - 2) ? 'none' : 'flex');
                sliderNext.disabled = sl + cw >= tw - 2;
            }
        };
        sliderTrack.addEventListener('scroll', updateReviewsSliderButtons);
        sliderPrev.addEventListener('click', function() {
            sliderTrack.scrollBy({ left: -getCardWidth(), behavior: 'smooth' });
        });
        sliderNext.addEventListener('click', function() {
            sliderTrack.scrollBy({ left: getCardWidth(), behavior: 'smooth' });
        });
        updateReviewsSliderButtons();
        setTimeout(updateReviewsSliderButtons, 100);
        window.addEventListener('resize', updateReviewsSliderButtons);
    }

    // Toggle balasan admin: pindah dropdown ke .reviews-slider-outer + position absolute agar tidak terpotong overflow dan ikut scroll dengan section
    var reviewsList = document.getElementById('reviews-list');
    var sliderOuter = document.querySelector('.reviews-slider-outer');
    var openReplyDropdown = null;
    var openReplyBtn = null;
    window.closeReviewsReplyDropdown = function() { closeReplyDropdown(); };

    function closeReplyDropdown() {
        if (openReplyDropdown) {
            var parent = openReplyDropdown._originalParent;
            if (parent && document.body.contains(parent)) {
                parent.appendChild(openReplyDropdown);
            } else if (openReplyDropdown.parentNode) {
                openReplyDropdown.parentNode.removeChild(openReplyDropdown);
            }
            openReplyDropdown.classList.add('hidden');
            openReplyDropdown.style.cssText = '';
            if (openReplyBtn && document.body.contains(openReplyBtn)) {
                openReplyBtn.setAttribute('aria-expanded', 'false');
                var ch = openReplyBtn.querySelector('.review-reply-chevron');
                if (ch) ch.style.transform = 'rotate(0deg)';
            }
            openReplyDropdown = null;
            openReplyBtn = null;
        }
        document.removeEventListener('click', closeReplyOnClickOutside);
    }

    function closeReplyOnClickOutside(ev) {
        if (openReplyDropdown && openReplyBtn && !openReplyDropdown.contains(ev.target) && !openReplyBtn.contains(ev.target)) {
            closeReplyDropdown();
        }
    }

    if (reviewsList && sliderOuter) {
        reviewsList.addEventListener('click', function(e) {
            var btn = e.target.closest('.review-reply-toggle');
            if (!btn) return;
            e.preventDefault();
            if (openReplyBtn === btn) {
                closeReplyDropdown();
                return;
            }
            var card = btn.closest('.reviews-card');
            var dropdown = card ? card.querySelector('.review-reply-dropdown') : null;
            if (!dropdown) return;
            closeReplyDropdown();
            var btnRect = btn.getBoundingClientRect();
            var outerRect = sliderOuter.getBoundingClientRect();
            dropdown._originalParent = dropdown.parentNode;
            sliderOuter.appendChild(dropdown);
            dropdown.classList.remove('hidden');
            var topPx = btnRect.bottom - outerRect.top + 4;
            var leftPx = btnRect.left - outerRect.left;
            dropdown.style.cssText = 'position:absolute;left:' + leftPx + 'px;top:' + topPx + 'px;width:' + Math.max(btnRect.width, 200) + 'px;min-width:200px;z-index:9999;';
            btn.setAttribute('aria-expanded', 'true');
            var chevron = btn.querySelector('.review-reply-chevron');
            if (chevron) chevron.style.transform = 'rotate(180deg)';
            openReplyDropdown = dropdown;
            openReplyBtn = btn;
            setTimeout(function() { document.addEventListener('click', closeReplyOnClickOutside); }, 0);
        });
    }
});
</script>
