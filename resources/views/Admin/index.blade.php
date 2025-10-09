@extends('layouts.dashboard')

@section('content')
<div class="container py-4">
    <!-- Welcome Card -->
    <div class="card welcome-card mb-4">
        <div class="card-body text-center">
            <h5 class="card-title">Welcome Admin</h5>
            <p class="card-text fs-6">Welcome to the admin page</p>
        </div>
    </div>

    <!-- Feature Cards and Chart -->
    <div class="row g-4">
        <div class="col-md-6">
            <a href="" class="text-decoration-none text-dark">
                <div class="card feature-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="icon bi bi-box-seam"></i>
                        </div>
                        <div>
                            <h6 class="card-title">Contribution</h6>
                            <p class="card-text mb-1">Today Contribution: <strong>{{ $contributiontoday }}</strong></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="" class="text-decoration-none text-dark">
                <div class="card feature-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="icon bi bi-currency-dollar"></i>
                        </div>
                        <div>
                            <h6 class="card-title">Donations</h6>
                            <p class="card-text mb-1">Today Donations: <strong>${{ number_format($donationToday, 2, '.', ',') }}</strong></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="card welcome-card mb-4">
            <div class="card-body text-center">
                <h5 class="card-title">Contribution Statistics of This Week</h5>
                <canvas id="chartContribution"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const ctx = document.getElementById('chartContribution');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: @json($datasets)
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                },
                scales: {
                    x: { title: { display: true, text: 'Date' } },
                    y: { title: { display: true, text: 'Number of Contributions' }, beginAtZero: true }
                }
            }
        });
    </script>
@endpush