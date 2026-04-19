@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg">

    <h2 class="text-2xl font-bold mb-4 text-center">
        {{ ucfirst($type) }} Report
    </h2>
    <p class="text-center mb-6 text-gray-600">
        From {{ $start->format('Y-m-d') }} To {{ $end->format('Y-m-d') }}
    </p>

    {{-- Incomes --}}
    <h3 class="font-semibold text-lg mb-2">Incomes</h3>
    <div class="flex justify-end mb-4 space-x-2">
        <form action="{{ route('reports.export.pdf') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="incomes">
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Export PDF</button>
        </form>
        <form action="{{ route('reports.export.excel') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="incomes">
            <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Export Excel</button>
        </form>
    </div>
    <table class="w-full mb-6 border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">User</th>
                <th class="p-2 border">Source</th>
                <th class="p-2 border">Amount</th>
                <th class="p-2 border">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($incomes as $i)
            <tr>
                <td class="p-2 border">{{ $i->id }}</td>
                <td class="p-2 border">{{ $i->user->name }}</td>
                <td class="p-2 border">{{ $i->source }}</td>
                <td class="p-2 border">${{ number_format($i->amount,2) }}</td>
                <td class="p-2 border">{{ $i->received_on->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Savings --}}
    <h3 class="font-semibold text-lg mb-2">Savings</h3>
    <div class="flex justify-end mb-4 space-x-2">
        <form action="{{ route('reports.export.pdf') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="savings">
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Export PDF</button>
        </form>
        <form action="{{ route('reports.export.excel') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="savings">
            <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Export Excel</button>
        </form>
    </div>
    <table class="w-full mb-6 border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">User</th>
                <th class="p-2 border">Amount</th>
                <th class="p-2 border">Saved On</th>
            </tr>
        </thead>
        <tbody>
            @foreach($savings as $s)
            <tr>
                <td class="p-2 border">{{ $s->id }}</td>
                <td class="p-2 border">{{ $s->user->name }}</td>
                <td class="p-2 border">${{ number_format($s->amount,2) }}</td>
                <td class="p-2 border">{{ $s->created_on->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Deposits --}}
    <h3 class="font-semibold text-lg mb-2">Deposits</h3>
    <div class="flex justify-end mb-4 space-x-2">
        <form action="{{ route('reports.export.pdf') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="deposits">
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Export PDF</button>
        </form>
        <form action="{{ route('reports.export.excel') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="deposits">
            <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Export Excel</button>
        </form>
    </div>
    <table class="w-full mb-6 border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">User</th>
                <th class="p-2 border">Amount</th>
                <th class="p-2 border">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deposits as $d)
            <tr>
                <td class="p-2 border">{{ $d->id }}</td>
                <td class="p-2 border">{{ $d->user->name }}</td>
                <td class="p-2 border">${{ number_format($d->amount,2) }}</td>
                <td class="p-2 border">{{ $d->deposited_on->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Withdrawals --}}
    <h3 class="font-semibold text-lg mb-2">Withdrawals</h3>
    <div class="flex justify-end mb-4 space-x-2">
        <form action="{{ route('reports.export.pdf') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="withdrawals">
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Export PDF</button>
        </form>
        <form action="{{ route('reports.export.excel') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="withdrawals">
            <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Export Excel</button>
        </form>
    </div>
    <table class="w-full mb-6 border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">User</th>
                <th class="p-2 border">Amount</th>
                <th class="p-2 border">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($withdrawals as $w)
            <tr>
                <td class="p-2 border">{{ $w->id }}</td>
                <td class="p-2 border">{{ $w->user->name }}</td>
                <td class="p-2 border">${{ number_format($w->amount,2) }}</td>
                <td class="p-2 border">{{ $w->withdrawn_on->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Loans --}}
    <h3 class="font-semibold text-lg mb-2">Loans</h3>
    <div class="flex justify-end mb-4 space-x-2">
        <form action="{{ route('reports.export.pdf') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="loans">
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Export PDF</button>
        </form>
        <form action="{{ route('reports.export.excel') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="loans">
            <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Export Excel</button>
        </form>
    </div>
    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">User</th>
                <th class="p-2 border">Amount</th>
                <th class="p-2 border">Total Payable</th>
                <th class="p-2 border">Requested On</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $l)
            <tr>
                <td class="p-2 border">{{ $l->id }}</td>
                <td class="p-2 border">{{ $l->user->name }}</td>
                <td class="p-2 border">${{ number_format($l->amount,2) }}</td>
                <td class="p-2 border">${{ number_format($l->total_payable,2) }}</td>
                <td class="p-2 border">{{ $l->requested_on->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Repayments --}}
    <h3 class="font-semibold text-lg mb-2">Repayments</h3>
    <div class="flex justify-end mb-4 space-x-2">
        <form action="{{ route('reports.export.pdf') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="repayments">
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Export PDF</button>
        </form>
        <form action="{{ route('reports.export.excel') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="repayments">
            <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Export Excel</button>
        </form>
    </div>
    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">User</th>
                <th class="p-2 border">Loan</th>
                <th class="p-2 border">Amount</th>
                <th class="p-2 border">Paid On</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repayments as $r)
            <tr>
                <td class="p-2 border">{{ $r->id }}</td>
                <td class="p-2 border">{{ $r->user->name }}</td>
                <td class="p-2 border">{{ $r->loan->title ?? 'Loan #' . $r->loan->id }}</td>
                <td class="p-2 border">${{ number_format($r->amount,2) }}</td>
                <td class="p-2 border">{{ $r->paid_on->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection