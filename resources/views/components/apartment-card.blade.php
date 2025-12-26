@props(['image', 'name', 'route'])

<!-- Apartment Card Component -->
<div class="apartment-card">
    <div class="apartment-image">
        <img src="{{ $image }}" alt="{{ $name }}">
        <div class="apartment-content">
            <h3 class="apartment-name">{{ $name }}</h3>
            <a href="{{ $route }}" class="view-details-btn">DISCOVER</a>
        </div>
    </div>
</div>

