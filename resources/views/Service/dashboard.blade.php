<x-serv-provider-layout>
    <div class="container">
        <h1>Service Provider Dashboard</h1>

        <!-- Chart: Services Overview -->
        <div class="row">
            <div class="col-md-6">
                <h3>Total Services Provided</h3>
                <canvas id="servicesChart"></canvas>
            </div>
        </div>

        <!-- Merged Booking Status Chart -->
        <div class="row">
            <div class="col-md-12">
                <h3>Bookings Status (Confirmed vs Pending)</h3>
                <canvas id="mergedBookingsChart"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Services Overview Line Chart
            const servicesCtx = document.getElementById('servicesChart').getContext('2d');
            new Chart(servicesCtx, {
                type: 'line',
                data: {
                    labels: ['Total Services'], // Just one data point
                    datasets: [{
                        label: 'Services Provided',
                        data: [{{ $ServicesCount }}],
                        borderColor: '#42a5f5',
                        backgroundColor: 'rgba(66, 165, 245, 0.2)', // Light blue background
                        fill: true,
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total Services Provided'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Merged Bookings Status (Confirmed vs Pending) Line Chart
            const bookingsCtx = document.getElementById('mergedBookingsChart').getContext('2d');
            new Chart(bookingsCtx, {
                type: 'line',
                data: {
                    labels: ['Bookings Status'], // Just one data point for each type
                    datasets: [{
                            label: 'Confirmed Bookings',
                            data: [{{ $ConfirmedBookingsCount }}],
                            borderColor: '#4caf50',
                            backgroundColor: 'rgba(76, 175, 80, 0.2)', // Light green background
                            fill: true,
                            tension: 0.1
                        }, {
                            label: 'Pending Bookings',
                            data: [{{ $PendingBookingsCount }}],
                            borderColor: '#ff5722',
                            backgroundColor: 'rgba(255, 87, 34, 0.2)', // Light red background
                            fill: true,
                            tension: 0.1
                        },
                        {
                            label: 'Total Bookings',
                            data: [{{ $BookingsCount }}],
                            borderColor: '#ff5722',
                            backgroundColor: 'rgba(255, 87, 34, 0.2)', // Light red background
                            fill: true,
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Bookings Status: Confirmed vs Pending'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
</x-serv-provider-layout>
