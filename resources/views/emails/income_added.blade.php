<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Income Added</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">

                <!-- Card -->
                <table width="500" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; margin-top:40px; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.1);">

                    <!-- Header -->
                    <tr>
                        <td style="background:#16a34a; color:#ffffff; padding:20px; text-align:center;">
                            <h2 style="margin:0;">Income Recorded</h2>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:20px; color:#333;">

                            <p style="margin-bottom:10px;">Hello <strong>{{ $income->user->name }}</strong>,</p>

                            <p style="margin-bottom:20px;">
                                Your income has been successfully recorded in the system.
                            </p>

                            <!-- Details -->
                            <table width="100%" cellpadding="8" cellspacing="0"
                                style="border:1px solid #e5e7eb; border-radius:6px;">
                                <tr style="background:#f9fafb;">
                                    <td><strong>Source</strong></td>
                                    <td>{{ $income->source }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Amount</strong></td>
                                    <td style="color:#16a34a; font-weight:bold;">
                                        ${{ number_format($income->amount, 2) }}
                                    </td>
                                </tr>
                                <tr style="background:#f9fafb;">
                                    <td><strong>Date & Time</strong></td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($income->received_on)->format('F d, Y - h:i A') }}
                                    </td>
                                </tr>
                            </table>

                            <p style="margin-top:20px;">
                                Thank you for using our system.
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f3f4f6; padding:15px; text-align:center; font-size:12px; color:#6b7280;">
                            SHIRE SACCO Management System © {{ date('Y') }}
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>