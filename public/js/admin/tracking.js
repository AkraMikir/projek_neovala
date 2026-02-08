// ====================================
// TRACKING MODULE JAVASCRIPT (REFACTORED V2)
// ====================================

document.addEventListener('DOMContentLoaded', function () {

    // ===============================
    // CHART.JS SETUP
    // ===============================

    // 1. Visit Trends Chart (Line Chart)
    if (typeof visitTrendsData !== 'undefined' && visitTrendsData.length > 0) {
        const visitCtx = document.getElementById('visitTrendsChart');
        if (visitCtx) {
            const visitLabels = visitTrendsData.map(item => {
                const date = new Date(item.date);
                return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
            });

            const visitValues = visitTrendsData.map(item => item.count);

            new Chart(visitCtx, {
                type: 'line',
                data: {
                    labels: visitLabels,
                    datasets: [{
                        label: 'Page Visits',
                        data: visitValues,
                        fill: true,
                        backgroundColor: 'rgba(103, 76, 29, 0.1)', // Gold bg
                        borderColor: '#674c1d', // Gold border
                        borderWidth: 2,
                        tension: 0.3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#674c1d',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: '#1e293b',
                            titleFont: { size: 13, family: 'Inter' },
                            bodyFont: { size: 13, family: 'Inter' },
                            padding: 10,
                            cornerRadius: 4
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f5f9',
                                borderDash: [5, 5]
                            },
                            ticks: { font: { family: 'Inter', size: 11 }, color: '#64748b' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { family: 'Inter', size: 11 }, color: '#64748b' }
                        }
                    }
                }
            });
        }
    }

    // 2. Activity Breakdown Chart (Doughnut Chart)
    if (typeof actionTrendsData !== 'undefined' && actionTrendsData.length > 0) {
        const actionCtx = document.getElementById('activityBreakdownChart');

        if (actionCtx) {
            // Process Data for Pie Chart
            const labelsMap = {
                'click_book_now': 'Book Now Clicks',
                'click_download_promo': 'Promo Downloads',
                'submit_form': 'Forms Submitted',
                'submit_comment': 'Comments Posted',
                'visit': 'Page Visits'
            };

            const colorsMap = {
                'click_book_now': '#674c1d', // Gold
                'click_download_promo': '#a16207', // Dark Gold
                'submit_form': '#f59e0b', // Amber 500
                'submit_comment': '#d97706', // Amber 600
                'visit': '#eab308' // Yellow 500
            };

            // Filter out 'visit' type to focus on interactions only (optional)
            const filteredData = actionTrendsData.filter(d => d.activity_type !== 'visit');

            const labels = filteredData.map(d => labelsMap[d.activity_type] || d.activity_type);
            const data = filteredData.map(d => d.count);
            const bgColors = filteredData.map(d => colorsMap[d.activity_type] || '#ccc');

            new Chart(actionCtx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: bgColors,
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right', // Legend di kanan grafk
                            labels: {
                                font: { family: 'Inter', size: 12 },
                                color: '#475569',
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: { backgroundColor: '#1e293b', padding: 10 }
                    },
                    cutout: '60%',
                }
            });
        }
    } else {
        const chartWrapper = document.getElementById('activityBreakdownChart')?.parentNode;
        if (chartWrapper) {
            chartWrapper.innerHTML = `
                <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; height:100%; color:#94a3b8;">
                    <i class="fas fa-chart-pie" style="font-size:2rem; margin-bottom:0.5rem;"></i>
                    <p style="font-size:0.875rem;">No interaction data yet</p>
                </div>
            `;
        }
    }

    // ===============================
    // EXPORT & PRINT FUNCTIONALITY
    // ===============================
    const exportBtn = document.getElementById('exportBtn');
    if (exportBtn) {
        exportBtn.innerHTML = '<i class="fas fa-print"></i> Print / Save PDF';

        exportBtn.addEventListener('click', function (e) {
            e.preventDefault();
            window.print();
        });
    }

    // ===============================
    // ANIMATIONS
    // ===============================

    // Animate stats cards on load
    const cards = document.querySelectorAll('.stat-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(10px)';
        setTimeout(() => {
            card.style.transition = 'all 0.4s ease-out';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Animate table rows
    const rows = document.querySelectorAll('.data-table tbody tr');
    rows.forEach((row, index) => {
        row.style.opacity = '0';
        setTimeout(() => {
            row.style.transition = 'opacity 0.3s ease';
            row.style.opacity = '1';
        }, 300 + (index * 50));
    });
});
