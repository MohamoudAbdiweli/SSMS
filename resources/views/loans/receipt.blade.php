<!DOCTYPE html>
<html>

<head>
    <title>Loan Receipt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>

<body class="bg-gray-100 text-gray-800">

    <div
        class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-xl p-6 text-[15px] leading-relaxed print:shadow-none print:mt-0">

        <!-- Header -->
        <div class="text-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="SHIRE SACCO Logo"
                class="mx-auto h-16 w-16 rounded-full mb-2">
            <h2 class="text-xl font-bold tracking-wide">SHIRE SACCO MANAGEMENT SYSTEM</h2>
            <p class="text-sm text-gray-500">Official Loan Receipt</p>
        </div>

        <!-- Receipt Info -->
        <div class="space-y-2">
            <p><span class="font-semibold">User:</span> {{ $loan->user->name ?? 'N/A' }}</p>
            <p class="text-green-600 font-semibold">
                <span class="text-gray-800">Loan Amount:</span>
                ${{ number_format($loan->amount, 2) }}
            </p>
            <p class="text-gray-800 font-semibold">
                <span class="text-gray-800">Total Payable:</span>
                ${{ number_format($loan->total_payable, 2) }}
            </p>
        </div>

        <!-- Divider -->
        <div class="border-t border-dashed my-4"></div>

        <!-- Date & Time -->
        <div class="space-y-1">
            <p><span class="font-semibold">Date:</span> {{ $loan->created_at->format('Y-m-d') }}</p>
            <p><span class="font-semibold">Time:</span> {{ $loan->created_at->format('h:i A') }}</p>
        </div>

        <!-- Divider -->
        <div class="border-t border-dashed my-4"></div>

        <!-- Footer -->
        <div class="text-center text-sm text-gray-600">
            <p>Thank you for using our service!</p>
        </div>

        <!-- Signatures -->
        <div class="flex justify-between mt-6">
            <!-- Authorized -->
            <div class="text-center">
                <p class="font-semibold text-gray-700">Authorized By</p>
                <img src="{{ asset('images/signature.png') }}" alt="Signature"
                    class="mx-auto h-20 w-auto mt-2 object-contain">
                <p class="text-sm text-gray-500">Mohamoud A. Shire</p>
            </div>

            <!-- User -->
            <div class="text-center">
                <p class="font-semibold text-gray-700">Received By</p>
                <p class="mt-8 border-b border-gray-400 w-32 mx-auto">&nbsp;</p>
                <p class="text-sm text-gray-500">User Signature</p>
            </div>
        </div>

        <!-- QR Code as “button” below the line -->
        <div class="text-center mt-6">
            <div class="inline-block bg-white p-2 rounded-lg shadow-md">
                {!!
                QrCode::size(120)->generate(
                "URL: " . url("/loans/{$loan->id}/print") . "\n" .
                "User: " . ($loan->user->name ?? 'N/A') . "\n" .
                "Loan Amount: $" . number_format($loan->amount, 2) . "\n" .
                "Total Payable: $" . number_format($loan->total_payable, 2) . "\n" .
                "Date: " . $loan->created_at->format('Y-m-d') . "\n" .
                "Time: " . $loan->created_at->format('h:i A') . "\n" .
                "Loan ID: " . $loan->id
                )
                !!}
            </div>
            <p class="mt-2 text-sm text-gray-500">Scan to view loan receipt details</p>
        </div>

        <!-- Divider -->
        <div class="border-t border-dashed my-4"></div>

        <!-- Print Button -->
        <div class="mt-6 text-center print:hidden">
            <button onclick="window.print()"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                Print Receipt
            </button>
        </div>

    </div>

</body>

</html>