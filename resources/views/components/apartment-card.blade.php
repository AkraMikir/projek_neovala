@props(['image', 'name', 'route'])

<!-- Apartment Card Component -->
<div class="apartment-card" data-scroll-animate="fade-up">
    <div class="apartment-image">
        <img src="{{ $image }}" alt="{{ $name }}">
        <div class="apartment-content">
            <h3 class="apartment-name">{{ $name }}</h3>
            <a href="{{ $route }}" class="view-details-btn">
                <span>DISCOVER</span>
                <i class="bi bi-arrow-right-short"></i>
            </a>
        </div>
    </div>
</div>

