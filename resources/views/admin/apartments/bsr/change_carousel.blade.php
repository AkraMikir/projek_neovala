<div class="change-slide-section" id="changeSlideSection" style="display: none;">
    <form action="{{ route('admin.dashboard1.bsr.updateCarousel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="section" value="BSR">

        <div class="header-admin">
            <header>
                <h1>Change Slide Bassura City</h1>
            </header>
            <div class="button-container">
                <button type="button" class="back-btn" onclick="hideChangeSlide()">Back</button>
                <button type="submit" class="update-btn">Update</button>
            </div>
        </div>

        <div class="slide-grid">
            @for($i = 1; $i <= 4; $i++)
            <div class="slide-item" data-index="{{ $i-1 }}">
                <div class="slide-image">
                    <img src="{{ $carouselImages[$i] ? asset('storage/' . $carouselImages[$i]) : asset('img/default-slide.png') }}"
                        alt="Slide {{ $i }} BSR" id="previewSlide{{ $i }}">

                    <div class="slide-overlay">
                        <input type="file" class="file-input" name="images[{{ $i }}]" accept="image/*" hidden id="slideFile{{ $i }}" onchange="previewImage(this, 'previewSlide{{ $i }}')">
                        <button type="button" class="select-btn" onclick="document.getElementById('slideFile{{ $i }}').click()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </form>
</div>
