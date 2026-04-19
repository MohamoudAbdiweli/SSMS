@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 space-y-8">

    <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 text-center">
            <p class="text-gray-500 font-semibold">Total Deposits</p>
            <p class="text-2xl font-bold text-blue-600 mt-2">$ {{ number_format($totalDeposits,2) }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 text-center">
            <p class="text-gray-500 font-semibold">Total Withdrawals</p>
            <p class="text-2xl font-bold text-red-600 mt-2">$ {{ number_format($totalWithdrawals,2) }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 text-center">
            <p class="text-gray-500 font-semibold">Total Incomes</p>
            <p class="text-2xl font-bold text-green-600 mt-2">$ {{ number_format($totalIncomes,2) }}</p>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Line Chart -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <h3 class="text-lg font-semibold mb-4">Monthly Transactions</h3>
            <canvas id="lineChart" class="h-64 md:h-72"></canvas>
        </div>

        <!-- Bar Chart -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <h3 class="text-lg font-semibold mb-4">Deposits vs Withdrawals</h3>
            <canvas id="barChart" class="h-64 md:h-72"></canvas>
        </div>

        <!-- Pie Chart -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <h3 class="text-lg font-semibold mb-4">Proportion of Funds</h3>
            <canvas id="pieChart" class="h-64 md:h-72"></canvas>
        </div>

        <!-- Linear Chart: Loan Prediction -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <h3 class="text-lg font-semibold mb-4">Loan Eligibility Prediction</h3>
            <canvas id="loanChart" class="h-64 md:h-72"></canvas>
        </div>

    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    const deposits = @json(array_values($deposits));
    const withdrawals = @json(array_values($withdrawals));
    const incomes = @json(array_values($incomes));
    const projectedLoan = @json($projectedLoan);

    // Line Chart: Deposits, Withdrawals, Incomes
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                    label: 'Deposits',
                    data: deposits,
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59,130,246,0.2)',
                    fill: true
                },
                {
                    label: 'Withdrawals',
                    data: withdrawals,
                    borderColor: '#EF4444',
                    backgroundColor: 'rgba(239,68,68,0.2)',
                    fill: true
                },
                {
                    label: 'Incomes',
                    data: incomes,
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16,185,129,0.2)',
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });

    // Bar Chart: Deposits vs Withdrawals
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                    label: 'Deposits',
                    data: deposits,
                    backgroundColor: '#3B82F6'
                },
                {
                    label: 'Withdrawals',
                    data: withdrawals,
                    backgroundColor: '#EF4444'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });

    // Pie Chart: Fund Proportion
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: ['Deposits', 'Withdrawals', 'Incomes'],
            datasets: [{
                data: [@json($totalDeposits), @json($totalWithdrawals), @json($totalIncomes)],
                backgroundColor: ['#3B82F6', '#EF4444', '#10B981']
            }]
        },
        options: {
            responsive: true
        }
    });

    // Linear Chart: Loan Prediction
    new Chart(document.getElementById('loanChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Projected Loan Eligibility ($)',
                data: projectedLoan,
                borderColor: '#6366F1',
                backgroundColor: 'rgba(99,102,241,0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
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
@endsection