@props(['review'])

<button 
    type="button"
    class="like-btn inline-flex flex-col items-center gap-0.5 border-0 bg-transparent p-0 cursor-pointer"
    data-review-id="{{ $review->id }}"
    data-liked="false"
    style="cursor: pointer; outline: none;"
    title="Like komentar ini"
>
    <svg 
        class="like-icon not-liked" 
        width="18" 
        height="18" 
        viewBox="0 0 24 24" 
        fill="none" 
        stroke="currentColor" 
        stroke-width="2" 
        stroke-linecap="round" 
        stroke-linejoin="round"
        style="color: #9e9e9e; transition: color 0.2s ease;"
    >
        <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/>
    </svg>

    <span 
        class="like-count" 
        style="font-size: 11px; color: #666; user-select: none; line-height: 1;"
    >{{ $review->likes_count ?? 0 }}</span>
</button>

<style>
    .like-btn:hover .like-icon.not-liked {
        color: #674c1d !important;
        opacity: 0.7;
    }
    .like-btn .like-icon.liked {
        fill: #674c1d;
        stroke: #674c1d;
        color: #674c1d !important;
    }
    .like-btn .like-icon {
        transition: all 0.2s ease;
    }
</style>
