<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Saving Created</title>
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
                            <h2 style="margin:0;">Saving Account Created</h2>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:20px; color:#333;">

                            <p style="margin-bottom:10px;">
                                Hello <strong>{{ $saving->user->name }}</strong>,
                            </p>

                            <p style="margin-bottom:20px;">
                                Your saving account has been successfully created in the system.
                            </p>

                            <!-- Details -->
                            <table width="100%" cellpadding="8" cellspacing="0"
                                style="border:1px solid #e5e7eb; border-radius:6px;">

                                <tr style="background:#f9fafb;">
                                    <td><strong>Receipt No</strong></td>
                                    <td>{{ $saving->receipt_number }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Type</strong></td>
                                    <td>{{ ucfirst($saving->type) }}</td>
                                </tr>

                                @if($saving->target_amount)
                                <tr style="background:#f9fafb;">
                                    <td><strong>Target Amount</strong></td>
                                    <td style="color:#16a34a; font-weight:bold;">
                                        {{ number_format($saving->target_amount, 2) }}
                                    </td>
                                </tr>
                                @endif

                                @if($saving->maturity_date)
                                <tr>
                                    <td><strong>Maturity Date</strong></td>
                                    <td>{{ $saving->maturity_date }}</td>
                                </tr>
                                @endif

                                <tr style="background:#f9fafb;">
                                    <td><strong>Status</strong></td>
                                    <td>{{ ucfirst($saving->status) }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Date & Time</strong></td>
                                    <td>
                                        {{ $saving->created_at->format('F d, Y - h:i A') }}
                                    </td>
                                </tr>

                            </table>

                            <p style="margin-top:20px;">
                                Thank you for saving with us.
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