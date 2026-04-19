<!DOCTYPE html>
<html>

<head>
    <title>Financial Report</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
        }

        h2,
        h3 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px;
        }

        th {
            background: #f0f0f0;
        }

        .section-title {
            margin-top: 20px;
            font-weight: bold;
            background: #ddd;
            padding: 5px;
        }
    </style>
</head>

<body>

    <h2>Financial Report ({{ ucfirst($type) }})</h2>
    <p style="text-align:center;">
        From {{ $start->format('Y-m-d') }} To {{ $end->format('Y-m-d') }}
    </p>

    {{-- ================= INCOMES ================= --}}
    <h3 class="section-title">INCOMES</h3>
    <table>
        <tr>
            <th>User</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        @foreach($incomes as $i)
        <tr>
            <td>{{ $i->user->name ?? 'N/A' }}</td>
            <td>{{ number_format($i->amount,2) }}</td>
            <td>{{ $i->received_on }}</td>
        </tr>
        @endforeach
    </table>

    {{-- ================= SAVINGS ================= --}}
    <h3 class="section-title">SAVINGS</h3>
    <table>
        <tr>
            <th>User</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        @foreach($savings as $s)
        <tr>
            <td>{{ $s->user->name ?? 'N/A' }}</td>
            <td>{{ number_format($s->amount,2) }}</td>
            <td>{{ $s->created_on }}</td>
        </tr>
        @endforeach
    </table>

    {{-- ================= DEPOSITS ================= --}}
    <h3 class="section-title">DEPOSITS</h3>
    <table>
        <tr>
            <th>User</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        @foreach($deposits as $d)
        <tr>
            <td>{{ $d->user->name ?? 'N/A' }}</td>
            <td>{{ number_format($d->amount,2) }}</td>
            <td>{{ $d->deposited_on }}</td>
        </tr>
        @endforeach
    </table>

    {{-- ================= WITHDRAWALS ================= --}}
    <h3 class="section-title">WITHDRAWALS</h3>
    <table>
        <tr>
            <th>User</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        @foreach($withdrawals as $w)
        <tr>
            <td>{{ $w->user->name ?? 'N/A' }}</td>
            <td>{{ number_format($w->amount,2) }}</td>
            <td>{{ $w->withdrawn_on }}</td>
        </tr>
        @endforeach
    </table>

    {{-- ================= LOANS ================= --}}
    <h3 class="section-title">LOANS</h3>
    <table>
        <tr>
            <th>User</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        @foreach($loans as $l)
        <tr>
            <td>{{ $l->user->name ?? 'N/A' }}</td>
            <td>{{ number_format($l->amount,2) }}</td>
            <td>{{ $l->requested_on }}</td>
        </tr>
        @endforeach
    </table>

    {{-- ================= REPAYMENTS ================= --}}
    <h3 class="section-title">REPAYMENTS</h3>
    <table>
        <tr>
            <th>User</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        @foreach($repayments as $r)
        <tr>
            <td>{{ $r->user->name ?? 'N/A' }}</td>
            <td>{{ number_format($r->amount,2) }}</td>
            <td>{{ $r->paid_on }}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>