<div class="slide-section">
    <div class="section-header">
        <h2>Current Slide Show</h2>
        <button class="change-btn" type="button" onclick="showChangeSlide()">Change Now</button>
    </div>
    <div class="current-slide">
        <div class="carousel-container">
            @for($i = 1; $i <= 4; $i++)
            <div class="carousel-slide">
                <img src="{{ $carouselImages[$i] ? asset('storage/' . $carouselImages[$i]) : asset('img/default-slide.png') }}"
                    alt="Slide {{ $i }} TPJ">
            </div>
            @endfor
        </div>
        <button class="carousel-button prev">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="carousel-button next">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="carousel-nav">
            @for($i = 1; $i <= 4; $i++)
            <div class="carousel-dot {{ $i === 1 ? 'active' : '' }}" data-index="{{ $i - 1 }}"></div>
            @endfor
        </div>
    </div>
</div>
