@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-12 bg-white p-6 rounded-xl shadow-lg border border-gray-200">

    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">All Withdrawals</h2>
        <a href="{{ route('withdraws.create') }}"
            class="bg-red-500 hover:bg-red-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition duration-200">
            New Withdrawal
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
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                {{-- Display oldest first --}}
                @foreach($withdrawals->sortBy('id') as $w)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $w->id }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $w->user->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">$ {{ number_format($w->amount, 2) }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($w->withdrawn_on)->format('Y-m-d') }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('withdraws.edit', $w->id) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg shadow-sm transition duration-200">
                                Edit
                            </a>

                            <form action="{{ route('withdraws.destroy', $w->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow-sm transition duration-200">
                                    Delete
                                </button>
                            </form>

                            <a href="{{ route('withdraws.print', $w->id) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg shadow-sm transition duration-200">
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