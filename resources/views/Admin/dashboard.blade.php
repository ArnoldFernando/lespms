<x-app-layout>
    <div class="container">
        <h1 class="text-center mb-4">Admin Dashboard</h1>

        <!-- First Row (Charts 1 and 2) -->
        <div class="row mb-4 justify-content-center">
            <div class="col-12 col-lg-4">
                <canvas id="userDistributionChart"></canvas>
            </div>
            <div class="col-12 col-lg-4">
                <canvas id="eventServiceChart"></canvas>
            </div>
        </div>

        <!-- Second Row (Charts 3 and 4) -->
        <div class="row mb-4">
            <div class="col-12">
                <canvas id="monthlyBookingsChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // User Distribution
        const userDistributionCtx = document.getElementById('userDistributionChart').getContext('2d');
        new Chart(userDistributionCtx, {
            type: 'pie',
            data: {
                labels: ['Clients', 'Service Providers', 'Admins', 'Blocked Users', 'Active Users'],
                datasets: [{
                    data: [
                        {{ $clientUserCount }},
                        {{ $serviceProviderCount }},
                        {{ $adminCount }},
                        {{ $blockedUsers }},
                        {{ $activeUsers }}
                    ],
                    backgroundColor: ['#36a2eb', '#ff6384', '#ffcd56', '#4bc0c0', '#9966ff']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'User Distribution'
                    }
                }
            }
        });

        // Event Service Status
        const eventServiceCtx = document.getElementById('eventServiceChart').getContext('2d');
        new Chart(eventServiceCtx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Inactive', 'Featured'],
                datasets: [{
                    data: [
                        {{ $activeServices }},
                        {{ $inactiveServices }},
                        {{ $featuredServices }}
                    ],
                    backgroundColor: ['#42a5f5', '#ef5350', '#ffa726']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Event Service Status'
                    }
                }
            }
        });

        // Monthly Bookings
        const monthlyBookingsCtx = document.getElementById('monthlyBookingsChart').getContext('2d');
        new Chart(monthlyBookingsCtx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                datasets: [{
                    label: 'Monthly Bookings',
                    data: {{ json_encode($bookingsPerMonth) }},
                    borderColor: '#3e95cd',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    },
                    title: {
                        display: true,
                        text: 'Monthly Bookings Trend'
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
</x-app-layout>
