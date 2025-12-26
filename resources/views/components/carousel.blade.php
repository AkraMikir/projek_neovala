@props(['images', 'overlayText' => null, 'overlayClass' => 'header-text-overlay'])

<!-- Carousel Component -->
<div class="carousel">
    @if($overlayText)
    <!-- Overlay text -->
    <div class="{{ $overlayClass }}">
        <p>{{ $overlayText }}</p>
    </div>
    @endif

    <button class="carousel-button prev">&#10094;</button>
    <button class="carousel-button next">&#10095;</button>

    <div class="carousel-container">
        @if(is_array($images) && count($images) > 0)
            @foreach($images as $index => $image)
            <div class="carousel-slide">
                <img src="{{ $image }}" alt="Slide {{ $index + 1 }}">
            </div>
            @endforeach
        @else
            <!-- Jika tidak ada gambar, tampilkan placeholder kosong -->
            <div class="carousel-slide" style="background: #f0f0f0; display: flex; align-items: center; justify-content: center; min-height: 400px;">
                <p style="color: #999; font-size: 18px;">No images available</p>
            </div>
        @endif
    </div>

    <div class="carousel-dots">
        @if(is_array($images) && count($images) > 0)
            @foreach($images as $index => $image)
            <span class="dot {{ $index === 0 ? 'active' : '' }}"></span>
            @endforeach
        @else
            <!-- Jika tidak ada gambar, tidak tampilkan dots -->
        @endif
    </div>
</div>

