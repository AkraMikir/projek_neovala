<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Analytics & Tracking - Neovala Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/tracking.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    @include('admin.partials.sidebar')

    <div class="main-wrapper">
        <div class="main-content">
            <!-- Header -->
            <header class="page-header">
                <div>
                    <h1>Analytics & Tracking</h1>
                    <p class="subtitle">Monitor performance and user activity</p>
                </div>
                <div class="header-actions">
                    <button class="btn btn-secondary" id="exportBtn">
                        <i class="fas fa-download"></i>
                        Export Data
                    </button>
                </div>
            </header>

            <!-- Date Filter -->
            <div class="filter-card">
                <form method="GET" id="dateFilterForm">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" 
                                   name="start_date" 
                                   id="start_date" 
                                   value="{{ $startDate }}"
                                   class="form-input">
                        </div>
                        <div class="filter-group">
                            <label for="end_date">End Date</label>
                            <input type="date" 
                                   name="end_date" 
                                   id="end_date" 
                                   value="{{ $endDate }}"
                                   class="form-input">
                        </div>
                        <div class="filter-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i>
                                Apply Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card green">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ number_format($stats['total_visits']) }}</h3>
                        <p>Total Visits</p>
                    </div>
                </div>
                <div class="stat-card blue">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ number_format($stats['total_bookings']) }}</h3>
                        <p>Booking Requests</p>
                    </div>
                </div>
                <div class="stat-card purple">
                    <div class="stat-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ number_format($stats['total_testimonials']) }}</h3>
                        <p>New Testimonials</p>
                    </div>
                </div>
                <div class="stat-card orange">
                    <div class="stat-icon">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ number_format($stats['active_rooms']) }}</h3>
                        <p>Active Rooms</p>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="charts-row">
                <!-- Visit Trends Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>Visit Trends (Last 7 Days)</h3>
                    </div>
                    <div class="chart-body">
                        <canvas id="visitTrendsChart"></canvas>
                    </div>
                </div>

                <!-- Booking Trends Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>Booking Trends (Last 7 Days)</h3>
                    </div>
                    <div class="chart-body">
                        <canvas id="bookingTrendsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Analytics Grid -->
            <div class="analytics-grid">
                <!-- Popular Apartments -->
                <div class="analytics-card">
                    <div class="analytics-header">
                        <h3>Popular Apartments</h3>
                        <span class="badge">Top 5</span>
                    </div>
                    <div class="analytics-body">
                        @if($popularApartments->count() > 0)
                            @foreach($popularApartments as $apartment)
                            <div class="ranking-item">
                                <div class="ranking-info">
                                    <span class="ranking-name">{{ $apartment->apartment_type ?? 'Unknown' }}</span>
                                    <span class="ranking-count">{{ $apartment->count }} bookings</span>
                                </div>
                                <div class="ranking-bar">
                                    <div class="ranking-fill" style="width: {{ ($apartment->count / $popularApartments->first()->count) * 100 }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="empty-state-small">
                                <i class="fas fa-chart-bar"></i>
                                <p>No data available</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Popular Pages -->
                <div class="analytics-card">
                    <div class="analytics-header">
                        <h3>Popular Pages</h3>
                        <span class="badge">Top 10</span>
                    </div>
                    <div class="analytics-body">
                        @if($popularPages->count() > 0)
                            <div class="list-items">
                                @foreach($popularPages as $page)
                                <div class="list-item">
                                    <span class="list-label">{{ $page->page }}</span>
                                    <span class="list-value">{{ number_format($page->visits) }}</span>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state-small">
                                <i class="fas fa-file"></i>
                                <p>No page data</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Device Stats -->
                <div class="analytics-card">
                    <div class="analytics-header">
                        <h3>Device Breakdown</h3>
                    </div>
                    <div class="analytics-body">
                        @if($deviceStats->count() > 0)
                            <div class="device-grid">
                                @foreach($deviceStats as $device)
                                <div class="device-item">
                                    <i class="fas fa-{{ $device->device == 'mobile' ? 'mobile-alt' : ($device->device == 'tablet' ? 'tablet-alt' : 'desktop') }}"></i>
                                    <span class="device-name">{{ ucfirst($device->device) }}</span>
                                    <span class="device-count">{{ number_format($device->count) }}</span>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state-small">
                                <i class="fas fa-devices"></i>
                                <p>No device data</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Bookings Table -->
            <div class="table-card">
                <div class="table-header">
                    <h3>Recent Booking Requests</h3>
                    <span class="badge">Last 10</span>
                </div>
                <div class="table-responsive">
                    @if($recentBookings->count() > 0)
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Apartment</th>
                                <th>Room Type</th>
                                <th>Check In</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBookings as $booking)
                            <tr>
                                <td>{{ $booking->created_at->format('M d, Y') }}</td>
                                <td>{{ $booking->nama ?? 'N/A' }}</td>
                                <td>{{ $booking->apartment_type ?? 'N/A' }}</td>
                                <td>{{ $booking->tipe_kamar ?? 'N/A' }}</td>
                                <td>{{ $booking->tanggal_checkin ?? 'N/A' }}</td>
                                <td>{{ $booking->durasi ?? 'N/A' }} days</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>No Recent Bookings</h3>
                        <p>Booking requests will appear here</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script src="{{ asset('js/admin/tracking.js') }}"></script>
    <script>
        // Pass data to JavaScript
        const visitTrendsData = @json($visitTrends);
        const bookingTrendsData = @json($bookingTrends);
    </script>
</body>
</html>
