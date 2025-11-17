<div style="width: 100%; margin: auto;">
    <h2>Biểu đồ Doanh thu theo Tháng</h2>
    <canvas id="revenueChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');

    // Define your months and revenues
    const months = {!! $months !!};
    const revenues = {!! $revenues !!};

    // Create a gradient color for the line
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(75, 192, 192, 0.4)');
    gradient.addColorStop(1, 'rgba(75, 192, 192, 0.1)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: revenues,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                backgroundColor: gradient, // Use gradient
                fill: true, // Fill under the line
                pointRadius: 5, // Size of data points
                pointHoverRadius: 7, // Size when hovered
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `Doanh thu: ${tooltipItem.raw.toLocaleString()} VNĐ`; // Format currency
                        }
                    },
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tháng',
                        font: {
                            size: 20,
                            weight: 'bold',
                        }
                    },
                    ticks: {
                        font: {
                            size: 12,
                        }
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Doanh thu (VNĐ)',
                        font: {
                            size: 20,
                            weight: 'bold',
                        }
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {
                            return value.toLocaleString(); // Format Y-axis numbers
                        }
                    }
                },
            },
        }
    });
</script>
