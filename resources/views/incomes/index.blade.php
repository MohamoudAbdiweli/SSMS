@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">All Incomes</h2>
        <a href="{{ route('incomes.create') }}"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Add Income</a>
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
                    <th class="px-4 py-2 border-b text-left text-gray-700">ID</th>
                    <th class="px-4 py-2 border-b text-left text-gray-700">User</th>
                    <th class="px-4 py-2 border-b text-left text-gray-700">Source</th>
                    <th class="px-4 py-2 border-b text-left text-gray-700">Amount</th>
                    <th class="px-4 py-2 border-b text-left text-gray-700">Received On</th>
                    <th class="px-4 py-2 border-b text-left text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($incomes as $income)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $income->id }}</td>
                    <td class="px-4 py-2 border-b">{{ $income->user->name }}</td>
                    <td class="px-4 py-2 border-b">{{ $income->source }}</td>
                    <td class="px-4 py-2 border-b">${{ number_format($income->amount, 2) }}</td>
                    <td class="px-4 py-2 border-b">{{ $income->received_on->format('Y-m-d') }}</td>
                    <td class="px-4 py-2 border-b">
                        <div class="flex items-center space-x-2">

                            <!-- Edit Button -->
                            <a href="{{ route('incomes.edit', $income->id) }}"
                                class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-600 transition">
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('incomes.destroy', $income->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this income?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>

                            <!-- Print Button -->
                            <a href="{{ route('incomes.print', $income->id) }}" target="_blank"
                                class="bg-green-600 text-white px-3 py-1 rounded-md text-sm hover:bg-green-700 transition">
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