@extends('mahasiswa.layouts.index')

@section('title', 'Grafik IPK')

@section('content')
<div class="container mt-4">
    <div class="welcome-box">
        <h5><i class="fa-solid fa-chart-line me-2"></i>Grafik Prestasi Akademik</h5>
        <p class="mb-0 text-light opacity-75">Pantau perkembangan IPK dan IPS Anda setiap semester</p>
    </div>

    <div class="card">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #0b1f3a, #1a365d);">
            <span><i class="fa-solid fa-chart-simple me-2"></i>Grafik IPK</span>
            <span class="badge bg-light text-dark">IPK: {{ $ipk }}</span>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background: #f0f4f8;">
                        <span class="fw-semibold">IPK Saat Ini</span>
                        <span class="badge fs-4" style="background: #0b1f3a; color: white; padding: 10px 20px;">{{ $ipk }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background: #f0f4f8;">
                        <span class="fw-semibold">Total Semester</span>
                        <span class="badge fs-5" style="background: #0ea5e9; color: white; padding: 8px 16px;">{{ count($ips) }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background: #f0f4f8;">
                        <span class="fw-semibold">IPS Tertinggi</span>
                        <span class="badge fs-5" style="background: #22c55e; color: white; padding: 8px 16px;">{{ count($ips) > 0 ? max($ips) : 0 }}</span>
                    </div>
                </div>
            </div>

            <div style="position: relative; height: 400px;">
                <canvas id="grafikIPK"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('grafikIPK');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'IPS',
                data: @json($ips),
                fill: true,
                backgroundColor: 'rgba(14, 165, 233, 0.1)',
                borderColor: '#0ea5e9',
                borderWidth: 3,
                pointBackgroundColor: '#0b1f3a',
                pointBorderColor: '#0ea5e9',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 8,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 14,
                            weight: 'bold'
                        },
                        color: '#0b1f3a'
                    }
                },
                tooltip: {
                    backgroundColor: '#0b1f3a',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    borderColor: '#0ea5e9',
                    borderWidth: 2,
                    callbacks: {
                        label: function(context) {
                            return 'IPS: ' + context.parsed.y.toFixed(2);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 4,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        stepSize: 0.5,
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.3
                }
            }
        }
    });
</script>

<style>
    .card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }

    .badge {
        border-radius: 8px;
    }
</style>
@endsection