@props(['komentar'])

<!-- Comment Card Component -->
<div class="comment-card">
    <div class="comment-header">
        <span class="quote-icon">"</span>
        <h3 class="comment-location">{{ strtoupper($komentar->apartmen) }}</h3>
    </div>
    <p class="comment-text">
        {{ $komentar->isi }}
    </p>
    <div class="comment-footer">
        <span class="comment-user">{{ '@' . $komentar->instagram }}</span>
        <div class="star-rating">
            @for ($i = 0; $i < $komentar->bintang; $i++)
                <img src="{{ asset('images/logo/star-filled.png') }}" alt="Star"
                    class="star-icon star-filled">
            @endfor
        </div>
    </div>
</div>

