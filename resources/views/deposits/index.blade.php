@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">All Deposits</h2>
        <a href="{{ route('deposits.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">
            Add Deposit
        </a>
    </div>

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">ID</th> <!-- Deposit ID -->
                <th class="p-2">User</th>
                <th class="p-2">Saving Type</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Date</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deposits as $deposit)
            <tr class="text-center border-t">
                <td>{{ $deposit->id }}</td>
                <td>{{ $deposit->user?->name ?? 'N/A' }}</td>
                <td>{{ $deposit->savingRelation?->type ?? 'N/A' }}</td>
                <td>${{ number_format($deposit->amount, 2) }}</td>
                <td>{{ \Carbon\Carbon::parse($deposit->deposited_on)->format('Y-m-d') }}</td>
                <td class="space-x-2">
                    <a href="{{ route('deposits.edit', $deposit->id) }}"
                        class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>

                    <form action="{{ route('deposits.destroy', $deposit->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-2 py-1 rounded">
                            Delete
                        </button>
                    </form>

                    <a href="{{ route('deposits.print', $deposit->id) }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded inline-block text-sm">
                        Print
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection