<x-app-layout>

    <div class="container mt-5">
        <h1>Dashboard</h1>

        <div class="row">
            <!-- Pie Chart for User Distribution -->
            <div class="col-md-6">
                <canvas id="userDistributionChart"></canvas>
            </div>

            <!-- Bar Chart for Event and Booking Counts -->
            <div class="col-md-6">
                <canvas id="eventBookingChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // User Distribution Chart
        const userDistributionCtx = document.getElementById('userDistributionChart').getContext('2d');
        new Chart(userDistributionCtx, {
            type: 'pie',
            data: {
                labels: ['Clients', 'Service Providers'],
                datasets: [{
                    data: [{{ $clientUserCount }}, {{ $serviceProviderCount }}],
                    backgroundColor: ['#36a2eb', '#ff6384'],
                    hoverBackgroundColor: ['#36a2eb', '#ff6384']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        // Event and Booking Counts Chart
        const eventBookingCtx = document.getElementById('eventBookingChart').getContext('2d');
        new Chart(eventBookingCtx, {
            type: 'bar',
            data: {
                labels: ['Event Services', 'Confirmed Bookings'],
                datasets: [{
                    label: 'Count',
                    data: [{{ $eventServicesCount }}, {{ $bookingsCount }}],
                    backgroundColor: ['#4caf50', '#f44336']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</x-app-layout>
