@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">All Repayments</h2>
        <a href="{{ route('repayments.create') }}"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Add Repayment
        </a>
    </div>

    @if (session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b">ID</th>
                    <th class="px-4 py-2 border-b">User</th>
                    <th class="px-4 py-2 border-b">Loan</th>
                    <th class="px-4 py-2 border-b">Amount</th>
                    <th class="px-4 py-2 border-b">Paid On</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($repayments as $repayment)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $repayment->id }}</td>
                    <td class="px-4 py-2 border-b">{{ $repayment->user->name }}</td>
                    <td class="px-4 py-2 border-b">{{ $repayment->loan->id }}</td>
                    <td class="px-4 py-2 border-b text-green-600 font-semibold">
                        ${{ number_format($repayment->amount, 2) }}
                    </td>
                    <td class="px-4 py-2 border-b">{{ $repayment->paid_on->format('Y-m-d') }}</td>

                    <td class="px-4 py-2 border-b flex space-x-2">
                        <a href="{{ route('repayments.edit', $repayment->id) }}"
                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            Edit
                        </a>

                        <form action="{{ route('repayments.destroy', $repayment->id) }}" method="POST"
                            onsubmit="return confirm('Delete this repayment?');">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>

                        <a href="{{ route('repayments.receipt', $repayment->id) }}" target="_blank"
                            class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                            Print
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection