@props(['image', 'name', 'route', 'priority' => false])

<!-- Apartment Card Component -->
<div class="apartment-card">
    <div class="apartment-image">
        <img
            src="{{ $image }}"
            alt="{{ $name }}"
            width="614"
            height="380"
            loading="{{ $priority ? 'eager' : 'lazy' }}"
            @if($priority) fetchpriority="high" @endif
        >
        <div class="apartment-content">
            <h3 class="apartment-name">{{ $name }}</h3>
            <a href="{{ $route }}" class="view-details-btn">
                <span>DISCOVER</span>
                <i class="bi bi-arrow-right-short"></i>
            </a>
        </div>
    </div>
</div>

