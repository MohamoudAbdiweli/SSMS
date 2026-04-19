@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-12 bg-white p-6 rounded-xl shadow-lg border border-gray-200">

    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">All Loans</h2>
        <a href="{{ route('loans.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition duration-200">
            New Loan
        </a>
    </div>

    @if(session('success'))
    <p class="text-green-600 bg-green-100 border border-green-300 p-3 rounded mb-4">
        {{ session('success') }}
    </p>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">User</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Amount</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Payable</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                {{-- Display loans oldest first so newest appears at the bottom --}}
                @foreach($loans->sortBy('id') as $loan)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $loan->id }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $loan->user->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">$ {{ number_format($loan->amount, 2) }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">$ {{ number_format($loan->total_payable, 2) }}</td>
                    <td class="px-4 py-3 text-sm text-green-600 font-semibold">
                        {{ \Carbon\Carbon::parse($loan->created_at)->addHours(24)->isPast() ? 'Done' : $loan->status }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('loans.edit', $loan->id) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg shadow-sm transition duration-200">
                                Edit
                            </a>

                            <form action="{{ route('loans.destroy', $loan->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow-sm transition duration-200">
                                    Delete
                                </button>
                            </form>

                            <a href="{{ route('loans.print', $loan->id) }}"
                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg shadow-sm transition duration-200">
                                Print
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection