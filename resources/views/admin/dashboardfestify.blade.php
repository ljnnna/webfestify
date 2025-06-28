@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-[#493862]">Website Performance</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Produk -->
        <x-card-stat title="All Product" :value="$total_product" />

        <!-- Order Baru -->
        <x-card-stat title="New Order" :value="$order_new ?? 0" />

        <!-- On Progress -->
        <x-card-stat title="On Progress" :value="$order_progress ?? 0" />

        <!-- Order Selesai -->
        <x-card-stat title="Order Completed" :value="$order_done ?? 0" />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8 md:gap-4">
        <!-- Produk Disewa -->
        <x-card-stat title="Product Rented" :value="$product_rented ?? 0" />

        <!-- Customer -->
        <x-card-stat title="User" :value="$total_customers" />
    </div>

    <div class="mt-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Grafik Penyewaan Perbulan</h3>
            <div class="relative h-96">
                <canvas id="monthlyRentalChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('monthlyRentalChart').getContext('2d');

    const chartMonths = ['Jan 2025', 'Feb 2025', 'Mar 2025'];
    const chartRentals = [5, 10, 8];
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartMonths,
            datasets: [{
                label: 'Jumlah Penyewaan',
                data: chartRentals,
                borderColor: 'rgb(147, 51, 234)',
                backgroundColor: 'rgba(147, 51, 234, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
});
</script>
@endsection
