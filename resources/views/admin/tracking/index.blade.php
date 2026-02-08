<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Analytics & User Activity - Neovala Admin</title>
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
                    <h1>User Activity Monitor</h1>
                    <p class="subtitle">Real-time tracking for Visits, Clicks, and Submissions</p>
                </div>
            </header>

            <!-- Date Filter & Actions Compact -->
            <div class="filter-card">
                <form method="GET" id="dateFilterForm">
                    <div class="filter-container">
                        <!-- Date Inputs: Side by Side -->
                        <div class="filter-date-group">
                            <div class="filter-input-wrapper">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" class="form-input compact-date">
                            </div>
                            <div class="filter-input-wrapper">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" class="form-input compact-date">
                            </div>
                        </div>

                        <!-- Action Buttons: Inline -->
                        <div class="filter-actions-group">
                            <button type="submit" class="btn btn-primary compact-btn">
                                <i class="fas fa-filter"></i> Apply
                            </button>
                            <button type="button" class="btn btn-secondary compact-btn" id="exportBtn">
                                <i class="fas fa-print"></i> Print
                            </button>
                            <a href="{{ route('home') }}" target="_blank" class="btn btn-primary compact-btn" title="Open User Page">
                                <i class="fas fa-external-link-alt"></i> Test
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <!-- Total Visits -->
                <div class="stat-card blue">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ number_format($stats['total_visits']) }}</h3>
                        <p>Total Visits</p>
                        <small class="text-muted">Today: {{ number_format($stats['today_visits']) }}</small>
                    </div>
                </div>

                <!-- Book Now Clicks -->
                <div class="stat-card green">
                    <div class="stat-icon">
                        <i class="fas fa-mouse-pointer"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ number_format($stats['total_bookings']) }}</h3>
                        <p>Clicked "Book Now"</p>
                    </div>
                </div>

                <!-- Download Promo -->
                <div class="stat-card purple">
                    <div class="stat-icon">
                        <i class="fas fa-file-download"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ number_format($stats['total_downloads']) }}</h3>
                        <p>Promo Downloads</p>
                    </div>
                </div>

                <!-- Form Submits -->
                <div class="stat-card orange">
                    <div class="stat-icon">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ number_format($stats['total_forms']) }}</h3>
                        <p>Forms Submitted</p>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="charts-row">
                <!-- Visit Trends Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>Daily Traffic Trend</h3>
                    </div>
                    <div class="chart-body">
                        <canvas id="visitTrendsChart"></canvas>
                    </div>
                </div>

                <!-- Activity Breakdown Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>User Interaction Breakdown</h3>
                    </div>
                    <div class="chart-body">
                        <canvas id="activityBreakdownChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Analytics Grid -->
            <div class="analytics-grid">
                <!-- Popular Pages -->
                <div class="analytics-card">
                    <div class="analytics-header">
                        <h3>Most Visited Pages</h3>
                    </div>
                    <div class="analytics-body">
                        @if($popularPages->count() > 0)
                            <div class="list-items">
                                @foreach($popularPages as $page)
                                <div class="list-item">
                                    <span class="list-label" title="{{ $page->page_path }}">{{ Str::limit($page->page_path, 40) }}</span>
                                    <span class="badgex badge-blue">{{ number_format($page->visits) }} visits</span>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state-small">
                                <i class="fas fa-file"></i>
                                <p>No page data yet</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Popular Apartments -->
                <div class="analytics-card">
                    <div class="analytics-header">
                        <h3>Top Apartments Interest</h3>
                    </div>
                    <div class="analytics-body">
                        @if($popularApartments->count() > 0)
                            @foreach($popularApartments as $apt)
                            <div class="ranking-item">
                                <div class="ranking-info">
                                    <span class="ranking-name">{{ $apt->apartment_type ?: 'Unknown' }}</span>
                                    <span class="ranking-count">{{ $apt->count }} events</span>
                                </div>
                                <div class="ranking-bar">
                                    <div class="ranking-fill" style="width: {{ ($apt->count / $popularApartments->first()->count) * 100 }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="empty-state-small">
                                <i class="fas fa-building"></i>
                                <p>No apartment interest data</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Device Stats -->
                <div class="analytics-card">
                    <div class="analytics-header">
                        <h3>Device Types</h3>
                    </div>
                    <div class="analytics-body">
                         @if($deviceStats->count() > 0)
                            <div class="device-grid">
                                @foreach($deviceStats as $device)
                                <div class="device-item">
                                    <i class="fas fa-{{ $device->device == 'Mobile' ? 'mobile-alt' : 'desktop' }}"></i>
                                    <span class="device-name">{{ $device->device }}</span>
                                    <span class="device-count">{{ number_format($device->count) }}</span>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state-small">
                                <i class="fas fa-laptop"></i>
                                <p>No device data</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Activity Log -->
            <div class="table-card">
                <div class="table-header">
                    <h3>Recent User Activities</h3>
                    <span class="badge">Live Log</span>
                </div>
                <div class="table-responsive">
                    @if($recentActivities->count() > 0)
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Activity Type</th>
                                <th>Page / Target</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentActivities as $act)
                            <tr>
                                <td data-label="Time">{{ $act->created_at->format('M d, H:i') }}</td>
                                <td data-label="Activity Type">
                                    @if($act->activity_type == 'visit')
                                        <span class="badge badge-gray">Visit</span>
                                    @elseif($act->activity_type == 'click_book_now')
                                        <span class="badge badge-green">Book Now</span>
                                    @elseif($act->activity_type == 'submit_form')
                                        <span class="badge badge-orange">Form Submit</span>
                                    @else
                                        <span class="badge badge-blue">{{ str_replace('_', ' ', $act->activity_type) }}</span>
                                    @endif
                                </td>
                                <td data-label="Page / Target">
                                    <small>{{ $act->page_path }}</small>
                                </td>
                                <td data-label="Details">
                                    @if($act->target_name)
                                        <span class="text-xs">{{ $act->target_name }}</span>
                                    @elseif($act->apartment_type)
                                        <span class="text-xs">Apt: {{ $act->apartment_type }}</span>
                                    @else
                                        <span class="text-xs text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-history"></i>
                        <h3>No Recent Activity</h3>
                        <p>Activities will appear here once users interact with the site.</p>
                    </div>
                    @endif
                </div>

                @if($recentActivities instanceof \Illuminate\Pagination\LengthAwarePaginator && $recentActivities->hasPages())
                <div class="table-pagination">
                    {{ $recentActivities->links('admin.pagination.custom') }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script src="{{ asset('js/admin/tracking.js') }}"></script>
    
    <!-- Pass Data to JS -->
    <script>
        const visitTrendsData = @json($visitTrends);
        const actionTrendsData = @json($actionTrends); // { activity_type: 'x', count: 10 }
        
        // Helper untuk Export
        document.getElementById('exportBtn').addEventListener('click', function() {
            const start = document.getElementById('start_date').value;
            const end = document.getElementById('end_date').value;
            window.location.href = "{{ route('admin.dashboard1.tracking.export') }}?start_date=" + start + "&end_date=" + end;
        });
    </script>
</body>
</html>
