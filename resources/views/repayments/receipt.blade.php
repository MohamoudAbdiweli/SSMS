<!DOCTYPE html>
<html>

<head>
    <title>Repayment Receipt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-xl p-6 print:shadow-none print:mt-0">

        <!-- Header -->
        <div class="text-center mb-4">
            <img src="{{ asset('images/logo.png') }}" class="mx-auto h-16 w-16 rounded-full mb-2">
            <h2 class="text-xl font-bold">SHIRE SACCO MANAGEMENT SYSTEM</h2>
            <p class="text-sm text-gray-500">Loan Repayment Receipt</p>
        </div>

        <!-- Details -->
        <div class="space-y-2">
            <p><strong>User:</strong> {{ $repayment->user->name }}</p>
            <p><strong>Loan ID:</strong> #{{ $repayment->loan->id }}</p>
            <p class="text-green-600 font-semibold">
                <strong class="text-gray-800">Amount:</strong>
                ${{ number_format($repayment->amount, 2) }}
            </p>
        </div>

        <div class="border-t border-dashed my-4"></div>

        <!-- Date & Time -->
        <div class="space-y-1">
            <p><strong>Date:</strong> {{ $repayment->paid_on->format('Y-m-d') }}</p>
            <p><strong>Time:</strong> {{ $repayment->created_at->format('h:i A') }}</p>
        </div>

        <div class="border-t border-dashed my-4"></div>

        <!-- Footer -->
        <div class="text-center text-sm text-gray-600 mt-4">
            <p>Thank you for using our service!</p>
        </div>

        <!-- QR Code -->
        <div class="text-center mt-6">
            <div class="inline-block bg-white p-2 rounded-lg shadow-md">
                {!!
                QrCode::size(120)->generate(
                "URL: " . url("/repayments/{$repayment->id}/print") . "\n" .
                "User: " . $repayment->user->name . "\n" .
                "Loan ID: " . $repayment->loan->id . "\n" .
                "Amount: $" . number_format($repayment->amount, 2) . "\n" .
                "Date: " . $repayment->paid_on->format('Y-m-d') . "\n" .
                "Time: " . $repayment->created_at->format('h:i A') . "\n" .
                "Repayment ID: " . $repayment->id
                )
                !!}
            </div>
            <p class="mt-2 text-sm text-gray-500">Scan to view repayment details</p>
        </div>

        <!-- Print -->
        <div class="mt-6 text-center print:hidden">
            <button onclick="window.print()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Print Receipt
            </button>
        </div>

    </div>

</body>

</html>