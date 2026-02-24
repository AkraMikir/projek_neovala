@if ($paginator->hasPages())
    <div class="reviews-detail-pagination-simple">
        <p class="text-sm text-stone-500 mb-3 text-center">
            Menampilkan <span class="font-medium text-[#674c1d]">{{ $paginator->firstItem() ?? 0 }}</span>–<span class="font-medium text-[#674c1d]">{{ $paginator->lastItem() ?? 0 }}</span> dari <span class="font-medium text-[#674c1d]">{{ $paginator->total() }}</span> ulasan
        </p>
        <nav class="flex flex-wrap justify-center items-center gap-2" aria-label="Navigasi halaman">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="reviews-detail-page-btn reviews-detail-page-btn--disabled" aria-disabled="true">&lsaquo;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="reviews-detail-page-btn" rel="prev" aria-label="Sebelumnya">&lsaquo;</a>
            @endif

            {{-- Page numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="reviews-detail-page-btn reviews-detail-page-btn--disabled">{{ $element }}</span>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="reviews-detail-page-btn reviews-detail-page-btn--active" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="reviews-detail-page-btn" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="reviews-detail-page-btn" rel="next" aria-label="Selanjutnya">&rsaquo;</a>
            @else
                <span class="reviews-detail-page-btn reviews-detail-page-btn--disabled" aria-disabled="true">&rsaquo;</span>
            @endif
        </nav>
    </div>
@endif
