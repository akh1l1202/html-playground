$(document).ready(function() {
    let myChart = null;

    function fetchStats() {
        const start = $('#startDate').val();
        const end = $('#endDate').val();

        $.ajax({
            url: 'fetch_stats.php',
            type: 'GET',
            data: { start: start, end: end },
            dataType: 'json',
            success: function(response) {
                renderChart(response.labels, response.counts);
            },
            error: function() {
                alert("Failed to fetch dashboard data.");
            }
        });
    }

    function renderChart(labels, data) {
        const ctx = document.getElementById('statsChart').getContext('2d');

        if (myChart !== null) {
            myChart.destroy();
        }

        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'New User Signups',
                    data: data,
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3 
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    $('#updateBtn').on('click', fetchStats);

    // Initial load
    fetchStats();
});