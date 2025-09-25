<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Event Tracking Dashboard - Neovala Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
    html,
    body {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden;
        display: block !important;
        min-height: 100vh !important;
    }

    * {
        box-sizing: border-box;
    }

    /* Override admin.css untuk halaman tracking */
    body.tracking-page {
        display: block !important;
        flex-direction: unset !important;
    }

    /* Hide sidebar untuk halaman tracking */
    .sidebar {
        display: none !important;
    }

    /* Override main-content dari admin.css */
    .main-content {
        margin-left: 0 !important;
        width: 100% !important;
    }

    .tracking-dashboard {
        padding: 20px;
        background: #f8f9fa;
        min-height: 100vh;
        width: 100vw;
        max-width: 100vw;
        box-sizing: border-box;
        margin: 0;
        position: relative;
        left: 0;
        right: 0;
    }

    .dashboard-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    .tracking-header {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        box-sizing: border-box;
    }

    .tracking-header h1 {
        color: #674c1d;
        margin: 0;
        font-size: 2rem;
        font-weight: 600;
    }

    .back-btn {
        background: #674c1d;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        transition: background-color 0.3s;
    }

    .back-btn:hover {
        background: #5a3f16;
        color: white;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
        width: 100%;
        box-sizing: border-box;
    }

    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s;
        width: 100%;
        box-sizing: border-box;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: #674c1d;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        color: white;
        font-size: 1.5rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #674c1d;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #333;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .stat-description {
        color: #888;
        font-size: 0.85rem;
        font-weight: 400;
    }

    .summary-section {
        margin-bottom: 30px;
        width: 100%;
        box-sizing: border-box;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        width: 100%;
        box-sizing: border-box;
    }

    .summary-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-left: 4px solid #674c1d;
        width: 100%;
        box-sizing: border-box;
    }

    .summary-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .summary-header i {
        color: #674c1d;
        font-size: 1.2rem;
    }

    .summary-header h3 {
        color: #333;
        font-size: 1rem;
        font-weight: 600;
        margin: 0;
    }

    .summary-content {
        text-align: center;
    }

    .summary-number {
        font-size: 2rem;
        font-weight: 700;
        color: #674c1d;
        margin-bottom: 5px;
    }

    .summary-text {
        color: #666;
        font-size: 0.85rem;
    }

    .chart-section {
        margin-bottom: 30px;
        width: 100%;
        box-sizing: border-box;
    }

    .chart-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        width: 100%;
        box-sizing: border-box;
    }

    .chart-card {
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        box-sizing: border-box;
    }

    .chart-header {
        margin-bottom: 20px;
    }

    .chart-header h3 {
        color: #333;
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .chart-header i {
        color: #674c1d;
    }

    .chart-bars {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .chart-bar {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .bar-label {
        min-width: 80px;
        font-size: 0.9rem;
        color: #333;
        font-weight: 500;
    }

    .bar-container {
        flex: 1;
        height: 20px;
        background: #f0f0f0;
        border-radius: 10px;
        overflow: hidden;
    }

    .bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #674c1d, #8b6914);
        border-radius: 10px;
        transition: width 0.5s ease;
    }

    .bar-value {
        min-width: 30px;
        text-align: right;
        font-weight: 600;
        color: #674c1d;
    }

    .today-stats {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .today-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .today-item i {
        color: #674c1d;
        font-size: 1.1rem;
        width: 20px;
    }

    .today-item span {
        flex: 1;
        color: #333;
        font-size: 0.9rem;
    }

    .today-item strong {
        color: #674c1d;
        font-size: 1.1rem;
    }

    .recent-events {
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        box-sizing: border-box;
    }

    .recent-events h2 {
        color: #674c1d;
        margin-bottom: 20px;
        font-size: 1.5rem;
    }

    .event-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #eee;
        transition: background-color 0.3s;
    }

    .event-item:hover {
        background: #f8f9fa;
    }

    .event-item:last-child {
        border-bottom: none;
    }

    .event-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1rem;
    }

    .event-icon.visit {
        background: #e3f2fd;
        color: #1976d2;
    }

    .event-icon.download_promo {
        background: #f3e5f5;
        color: #7b1fa2;
    }

    .event-icon.book_now {
        background: #e8f5e8;
        color: #388e3c;
    }

    .event-icon.form_submit {
        background: #fff3e0;
        color: #f57c00;
    }

    .event-details {
        flex: 1;
    }

    .event-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .event-meta {
        color: #666;
        font-size: 0.9rem;
    }

    .event-time {
        color: #999;
        font-size: 0.8rem;
    }

    .filter-section {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        box-sizing: border-box;
    }

    .filter-group {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-select {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: white;
        color: #333;
    }

    .refresh-btn {
        background: #674c1d;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .refresh-btn:hover {
        background: #5a3f16;
    }

    .loading {
        text-align: center;
        padding: 20px;
        color: #666;
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .chart-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .tracking-dashboard {
            padding: 10px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .filter-group {
            flex-direction: column;
            align-items: stretch;
        }

        .stat-number {
            font-size: 2rem;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .stat-card {
            padding: 20px;
        }

        .stat-number {
            font-size: 1.8rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
        }
    }
    </style>
</head>

<body class="tracking-page">
    <div class="tracking-dashboard">
        <div class="dashboard-container">
            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Dashboard
            </a>

            <div class="tracking-header">
                <h1><i class="bi bi-graph-up"></i> Event Tracking Dashboard</h1>
                <p>Pantau aktivitas pengunjung website Neovala secara real-time</p>
            </div>

            <div class="filter-section">
                <div class="filter-group">
                    <select id="timeFilter" class="filter-select">
                        <option value="7">7 Hari Terakhir</option>
                        <option value="30" selected>30 Hari Terakhir</option>
                        <option value="90">90 Hari Terakhir</option>
                    </select>
                    <button id="refreshBtn" class="refresh-btn">
                        <i class="bi bi-arrow-clockwise"></i>
                        Refresh
                    </button>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-eye"></i>
                    </div>
                    <div class="stat-number" id="totalVisits">{{ $stats['total_visits'] }}</div>
                    <div class="stat-label">Total Kunjungan</div>
                    <div class="stat-description">Pengunjung website</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-download"></i>
                    </div>
                    <div class="stat-number" id="totalDownloads">{{ $stats['total_downloads'] }}</div>
                    <div class="stat-label">Download Promo</div>
                    <div class="stat-description">Promo yang diunduh</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="stat-number" id="totalBookNow">{{ $stats['total_book_now'] }}</div>
                    <div class="stat-label">Click Book Now</div>
                    <div class="stat-description">Klik tombol booking</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-file-text"></i>
                    </div>
                    <div class="stat-number" id="totalFormSubmit">{{ $stats['total_form_submit'] }}</div>
                    <div class="stat-label">Form Data Submit</div>
                    <div class="stat-description">Form yang disubmit</div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="summary-section">
                <div class="summary-grid">
                    <div class="summary-card">
                        <div class="summary-header">
                            <i class="bi bi-graph-up"></i>
                            <h3>Conversion Rate</h3>
                        </div>
                        <div class="summary-content">
                            <div class="summary-number" id="conversionRate">0%</div>
                            <div class="summary-text">Dari kunjungan ke booking</div>
                        </div>
                    </div>

                    <div class="summary-card">
                        <div class="summary-header">
                            <i class="bi bi-download"></i>
                            <h3>Promo Engagement</h3>
                        </div>
                        <div class="summary-content">
                            <div class="summary-number" id="promoEngagement">0%</div>
                            <div class="summary-text">Dari kunjungan ke download</div>
                        </div>
                    </div>

                    <div class="summary-card">
                        <div class="summary-header">
                            <i class="bi bi-file-text"></i>
                            <h3>Form Completion</h3>
                        </div>
                        <div class="summary-content">
                            <div class="summary-number" id="formCompletion">0%</div>
                            <div class="summary-text">Dari kunjungan ke form</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="chart-section">
                <div class="chart-grid">
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3><i class="bi bi-bar-chart"></i> Distribusi Event</h3>
                        </div>
                        <div class="chart-content">
                            <div class="chart-bars">
                                <div class="chart-bar">
                                    <div class="bar-label">Kunjungan</div>
                                    <div class="bar-container">
                                        <div class="bar-fill" id="visitBar" style="width: 0%"></div>
                                    </div>
                                    <div class="bar-value" id="visitValue">0</div>
                                </div>
                                <div class="chart-bar">
                                    <div class="bar-label">Download</div>
                                    <div class="bar-container">
                                        <div class="bar-fill" id="downloadBar" style="width: 0%"></div>
                                    </div>
                                    <div class="bar-value" id="downloadValue">0</div>
                                </div>
                                <div class="chart-bar">
                                    <div class="bar-label">Book Now</div>
                                    <div class="bar-container">
                                        <div class="bar-fill" id="bookNowBar" style="width: 0%"></div>
                                    </div>
                                    <div class="bar-value" id="bookNowValue">0</div>
                                </div>
                                <div class="chart-bar">
                                    <div class="bar-label">Form Submit</div>
                                    <div class="bar-container">
                                        <div class="bar-fill" id="formBar" style="width: 0%"></div>
                                    </div>
                                    <div class="bar-value" id="formValue">0</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chart-card">
                        <div class="chart-header">
                            <h3><i class="bi bi-pie-chart"></i> Ringkasan Hari Ini</h3>
                        </div>
                        <div class="chart-content">
                            <div class="today-stats">
                                <div class="today-item">
                                    <i class="bi bi-eye"></i>
                                    <span>Kunjungan Hari Ini</span>
                                    <strong id="todayVisits">0</strong>
                                </div>
                                <div class="today-item">
                                    <i class="bi bi-download"></i>
                                    <span>Download Hari Ini</span>
                                    <strong id="todayDownloads">0</strong>
                                </div>
                                <div class="today-item">
                                    <i class="bi bi-calendar-check"></i>
                                    <span>Booking Hari Ini</span>
                                    <strong id="todayBookNow">0</strong>
                                </div>
                                <div class="today-item">
                                    <i class="bi bi-file-text"></i>
                                    <span>Form Hari Ini</span>
                                    <strong id="todayForms">0</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="recent-events">
                <h2><i class="bi bi-clock-history"></i> Aktivitas Terbaru</h2>
                <div id="recentEventsList">
                    @forelse($recentEvents as $event)
                    <div class="event-item">
                        <div class="event-icon {{ $event->event_name }}">
                            @if($event->event_name == 'visit')
                            <i class="bi bi-eye"></i>
                            @elseif($event->event_name == 'download_promo')
                            <i class="bi bi-download"></i>
                            @elseif($event->event_name == 'book_now')
                            <i class="bi bi-calendar-check"></i>
                            @elseif($event->event_name == 'form_submit')
                            <i class="bi bi-file-text"></i>
                            @endif
                        </div>
                        <div class="event-details">
                            <div class="event-name">
                                @if($event->event_name == 'visit')
                                Kunjungan Website
                                @elseif($event->event_name == 'download_promo')
                                Download Promo
                                @elseif($event->event_name == 'book_now')
                                Click Book Now
                                @elseif($event->event_name == 'form_submit')
                                Submit Form Data
                                @endif
                            </div>
                            <div class="event-meta">
                                IP: {{ $event->ip_address }} |
                                URL: {{ Str::limit($event->url, 50) }}
                            </div>
                        </div>
                        <div class="event-time">
                            {{ $event->created_at->diffForHumans() }}
                        </div>
                    </div>
                    @empty
                    <div class="loading">
                        <p>Belum ada aktivitas yang tercatat</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const refreshBtn = document.getElementById('refreshBtn');
        const timeFilter = document.getElementById('timeFilter');

        // Refresh data
        refreshBtn.addEventListener('click', function() {
            refreshData();
        });

        // Filter by time
        timeFilter.addEventListener('change', function() {
            refreshData();
        });

        function refreshData() {
            const days = timeFilter.value;

            // Show loading
            refreshBtn.innerHTML = '<i class="bi bi-arrow-clockwise spin"></i> Loading...';
            refreshBtn.disabled = true;

            fetch(`/api/dashboard-stats?days=${days}`)
                .then(response => response.json())
                .then(data => {
                    // Update stats
                    document.getElementById('totalVisits').textContent = data.total_visits;
                    document.getElementById('totalDownloads').textContent = data.total_downloads;
                    document.getElementById('totalBookNow').textContent = data.total_book_now;
                    document.getElementById('totalFormSubmit').textContent = data.total_form_submit;

                    // Calculate and update conversion rates
                    const visits = data.total_visits || 0;
                    const downloads = data.total_downloads || 0;
                    const bookNow = data.total_book_now || 0;
                    const formSubmit = data.total_form_submit || 0;

                    const conversionRate = visits > 0 ? Math.round((bookNow / visits) * 100) : 0;
                    const promoEngagement = visits > 0 ? Math.round((downloads / visits) * 100) : 0;
                    const formCompletion = visits > 0 ? Math.round((formSubmit / visits) * 100) : 0;

                    document.getElementById('conversionRate').textContent = conversionRate + '%';
                    document.getElementById('promoEngagement').textContent = promoEngagement + '%';
                    document.getElementById('formCompletion').textContent = formCompletion + '%';

                    // Update chart bars
                    updateChartBars(visits, downloads, bookNow, formSubmit);

                    // Update today stats (simplified - using same data for demo)
                    document.getElementById('todayVisits').textContent = visits;
                    document.getElementById('todayDownloads').textContent = downloads;
                    document.getElementById('todayBookNow').textContent = bookNow;
                    document.getElementById('todayForms').textContent = formSubmit;

                    // Update recent events
                    updateRecentEvents(data.recent_events);
                })
                .catch(error => {
                    console.error('Error refreshing data:', error);
                    alert('Gagal memuat data terbaru');
                })
                .finally(() => {
                    // Reset button
                    refreshBtn.innerHTML = '<i class="bi bi-arrow-clockwise"></i> Refresh';
                    refreshBtn.disabled = false;
                });
        }

        function updateRecentEvents(events) {
            const eventsList = document.getElementById('recentEventsList');

            if (events.length === 0) {
                eventsList.innerHTML = '<div class="loading"><p>Belum ada aktivitas yang tercatat</p></div>';
                return;
            }

            eventsList.innerHTML = events.map(event => {
                const eventName = getEventDisplayName(event.event_name);
                const eventIcon = getEventIcon(event.event_name);
                const timeAgo = new Date(event.created_at).toLocaleString('id-ID');

                return `
                        <div class="event-item">
                            <div class="event-icon ${event.event_name}">
                                <i class="bi bi-${eventIcon}"></i>
                            </div>
                            <div class="event-details">
                                <div class="event-name">${eventName}</div>
                                <div class="event-meta">
                                    IP: ${event.ip_address} | 
                                    URL: ${event.url ? event.url.substring(0, 50) + '...' : 'N/A'}
                                </div>
                            </div>
                            <div class="event-time">${timeAgo}</div>
                        </div>
                    `;
            }).join('');
        }

        function getEventDisplayName(eventName) {
            const names = {
                'visit': 'Kunjungan Website',
                'download_promo': 'Download Promo',
                'book_now': 'Click Book Now',
                'form_submit': 'Submit Form Data'
            };
            return names[eventName] || eventName;
        }

        function getEventIcon(eventName) {
            const icons = {
                'visit': 'eye',
                'download_promo': 'download',
                'book_now': 'calendar-check',
                'form_submit': 'file-text'
            };
            return icons[eventName] || 'circle';
        }

        function updateChartBars(visits, downloads, bookNow, formSubmit) {
            const maxValue = Math.max(visits, downloads, bookNow, formSubmit);

            if (maxValue > 0) {
                const visitPercent = (visits / maxValue) * 100;
                const downloadPercent = (downloads / maxValue) * 100;
                const bookNowPercent = (bookNow / maxValue) * 100;
                const formPercent = (formSubmit / maxValue) * 100;

                document.getElementById('visitBar').style.width = visitPercent + '%';
                document.getElementById('downloadBar').style.width = downloadPercent + '%';
                document.getElementById('bookNowBar').style.width = bookNowPercent + '%';
                document.getElementById('formBar').style.width = formPercent + '%';
            }

            document.getElementById('visitValue').textContent = visits;
            document.getElementById('downloadValue').textContent = downloads;
            document.getElementById('bookNowValue').textContent = bookNow;
            document.getElementById('formValue').textContent = formSubmit;
        }

        // Initial data load
        refreshData();

        // Auto refresh every 30 seconds
        setInterval(refreshData, 30000);
    });
    </script>
</body>

</html>