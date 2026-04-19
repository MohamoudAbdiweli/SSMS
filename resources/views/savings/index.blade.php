@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">All Savings</h2>
        <a href="{{ route('savings.create') }}"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Add Saving
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
                    <th class="px-4 py-2 border-b text-left text-gray-700">ID</th>
                    <th class="px-4 py-2 border-b text-left text-gray-700">Member</th>
                    <th class="px-4 py-2 border-b text-left text-gray-700">Type</th>
                    <th class="px-4 py-2 border-b text-left text-gray-700">Status</th>
                    <th class="px-4 py-2 border-b text-left text-gray-700">Balance</th>
                    <th class="px-4 py-2 border-b text-left text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($savings as $saving)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $saving->id }}</td>
                    <td class="px-4 py-2 border-b">{{ $saving->user->name }}</td>
                    <td class="px-4 py-2 border-b">{{ ucfirst($saving->type) }}</td>
                    <td class="px-4 py-2 border-b">{{ ucfirst($saving->status) }}</td>
                    <td class="px-4 py-2 border-b">${{ number_format($saving->balance, 2) }}</td>
                    <td class="px-4 py-2 border-b">
                        <div class="flex items-center space-x-2">

                            <!-- Edit Button -->
                            <a href="{{ route('savings.edit', $saving->id) }}"
                                class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-600 transition">
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('savings.destroy', $saving->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this saving?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>

                            <!-- Receipt Button -->
                            <a href="{{ route('savings.receipt', $saving->id) }}" target="_blank"
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