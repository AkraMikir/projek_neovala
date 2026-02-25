@props([
    'images',
    'mobileImages'  => [],
    'overlayText'   => null,
    'overlayClass'  => 'header-text-overlay',
    'heroBadge'     => null,
    'heroTitle'     => null,
    'heroSubtitle'  => null,
    'heroCtaText'   => null,
    'heroCtaUrl'    => null,
])

<!-- Carousel Component -->
<div class="carousel">

    {{-- Dark gradient overlay for readability --}}
    <div class="carousel-gradient-overlay"></div>

    {{-- Hero content overlay (new rich mode) --}}
    @if($heroTitle || $heroBadge)
    <div class="carousel-hero-overlay">
        <div class="carousel-hero-inner">
            @if($heroBadge)
            <div class="carousel-hero-badge">
                <i class="bi bi-buildings"></i>
                <span>{{ $heroBadge }}</span>
            </div>
            @endif
            @if($heroTitle)
            <h1 class="carousel-hero-title">{!! $heroTitle !!}</h1>
            @endif
            @if($heroSubtitle ?? $overlayText)
            <p class="carousel-hero-subtitle">{{ $heroSubtitle ?? $overlayText }}</p>
            @endif
            @if($heroCtaText && $heroCtaUrl)
            <a href="{{ $heroCtaUrl }}" class="carousel-hero-cta">
                <span>{{ $heroCtaText }}</span>
                <i class="bi bi-arrow-right"></i>
            </a>
            @endif
        </div>
    </div>
    @elseif($overlayText)
    {{-- Legacy simple overlay --}}
    <div class="{{ $overlayClass }}">
        <p>{{ $overlayText }}</p>
    </div>
    @endif

    <button class="carousel-button prev" aria-label="Previous slide">
        <i class="bi bi-chevron-left"></i>
    </button>
    <button class="carousel-button next" aria-label="Next slide">
        <i class="bi bi-chevron-right"></i>
    </button>

    <div class="carousel-container">
        @if(is_array($images) && count($images) > 0)
            @foreach($images as $index => $image)
            <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}">
                @if(is_array($mobileImages) && count($mobileImages) > 0 && isset($mobileImages[$index]))
                    <picture>
                        <source media="(max-width: 767px)" srcset="{{ $mobileImages[$index] }}">
                        <img src="{{ $image }}" alt="Neovala Apartemen Slide {{ $index + 1 }}" loading="{{ $index === 0 ? 'eager' : 'lazy' }}" @if($index === 0) fetchpriority="high" @endif>
                    </picture>
                @else
                    <img src="{{ $image }}" alt="Neovala Apartemen Slide {{ $index + 1 }}" loading="{{ $index === 0 ? 'eager' : 'lazy' }}" @if($index === 0) fetchpriority="high" @endif>
                @endif
            </div>
            @endforeach
        @else
            <div class="carousel-slide active" style="background:#1a1a1a;"></div>
        @endif
    </div>

    <div class="carousel-dots">
        @if(is_array($images) && count($images) > 0)
            @foreach($images as $index => $image)
            <span class="dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></span>
            @endforeach
        @endif
    </div>
</div>

