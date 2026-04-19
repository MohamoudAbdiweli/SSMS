<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') SHIRE SACCO MS</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-papH8wXKfZ2L8gQZ2sG1yZr0F+5n0F/lHh6ZZg1ZkF/1ZnQxGvR/B+kxS9/U5kdZKgV1+6rO7mOy3Zc1x2k4FA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="flex h-screen bg-gray-100">

    <!-- SIDEBAR -->
    <aside id="sidebar" class="bg-green-600 text-white flex flex-col transition-all duration-300 w-64 min-w-[16rem]">
        <div class="flex justify-center py-4 px-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-16 rounded-full object-cover">
        </div>
        <nav class="flex-1 px-4 space-y-1 flex flex-col items-center">

            <a href="/dashboard"
                class="flex items-center w-full max-w-[180px] py-2 px-3 rounded hover:bg-green-700 transition-colors text-base font-medium text-left">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>

            <a href="{{ route('incomes.index') }}"
                class="flex items-center w-full max-w-[180px] py-2 px-3 rounded hover:bg-green-700 transition-colors text-base font-medium text-left">
                <i class="fas fa-dollar-sign mr-2"></i> Income
            </a>

            <a href="{{ route('savings.index') }}"
                class="flex items-center w-full max-w-[180px] py-2 px-3 rounded hover:bg-green-700 transition-colors text-base font-medium text-left">
                <i class="fas fa-piggy-bank mr-2"></i> Saving
            </a>

            <a href="{{ route('deposits.index') }}"
                class="flex items-center w-full max-w-[180px] py-2 px-3 rounded hover:bg-green-700 transition-colors text-base font-medium text-left">
                <i class="fas fa-wallet mr-2"></i> Deposit
            </a>

            <a href="{{ route('withdraws.index') }}"
                class="flex items-center w-full max-w-[180px] py-2 px-3 rounded hover:bg-green-700 transition-colors text-base font-medium text-left">
                <i class="fas fa-hand-holding-usd mr-2"></i> Withdraw
            </a>

            <a href="{{ route('loans.index') }}"
                class="flex items-center w-full max-w-[180px] py-2 px-3 rounded hover:bg-green-700 transition-colors text-base font-medium text-left">
                <i class="fas fa-file-invoice-dollar mr-2"></i> Loans
            </a>

            <a href="{{ route('repayments.index') }}"
                class="flex items-center w-full max-w-[180px] py-2 px-3 rounded hover:bg-green-700 transition-colors text-base font-medium text-left">
                <i class="fas fa-credit-card mr-2"></i> Repayment
            </a>

            <a href="{{ route('reports.index') }}"
                class="flex items-center w-full max-w-[180px] py-2 px-3 rounded hover:bg-green-700 transition-colors text-base font-medium text-left">
                <i class="fas fa-chart-line mr-2"></i> Reports
            </a>

            <a href="/notifications"
                class="flex items-center w-full max-w-[180px] py-2 px-3 rounded hover:bg-green-700 transition-colors text-base font-medium text-left">
                <i class="fas fa-bell mr-2"></i> Notifications
            </a>

            <a href="/settings"
                class="flex items-center w-full max-w-[180px] py-2 px-3 rounded hover:bg-green-700 transition-colors text-base font-medium text-left">
                <i class="fas fa-cog mr-2"></i> Settings
            </a>

            <form action="{{ route('logout') }}" method="POST" class="w-full flex justify-center">
                @csrf
                <button type="submit"
                    class="w-full max-w-[180px] py-2 px-3 rounded hover:bg-green-700 text-base font-medium text-left">
                    Logout
                </button>
            </form>

        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col transition-all duration-300">
        <!-- Top bar -->
        <header class="bg-white shadow p-3 flex items-center justify-between">
            <button id="sidebarToggle" class="text-gray-700 focus:outline-none">
                <!-- Hamburger icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h1 class="text-xl font-bold">@yield('header')</h1>
        </header>

        <!-- Main content -->
        <main class="p-4 overflow-auto">
            @yield('content')
        </main>
    </div>

    <!-- Toggle Script -->
    <script>
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = sidebar.nextElementSibling;

        toggleBtn.addEventListener('click', () => {
            if (sidebar.classList.contains('w-0')) {
                // Show sidebar
                sidebar.classList.remove('w-0');
                sidebar.classList.add('w-64', 'min-w-[16rem]');
                mainContent.classList.remove('ml-0');
            } else {
                // Hide sidebar
                sidebar.classList.remove('w-64', 'min-w-[16rem]');
                sidebar.classList.add('w-0');
                mainContent.classList.add('ml-0');
            }
        });
    </script>

</body>

</html>