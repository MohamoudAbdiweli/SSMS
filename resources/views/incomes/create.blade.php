@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Add Income</h2>

    @if ($errors->any())
    <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('incomes.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium mb-1">User</label>
            <select name="user_id"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <option value="">Select User</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Source</label>
            <input type="text" name="source"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Amount</label>
            <input type="number" name="amount" step="0.01"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Received On</label>
            <input type="date" name="received_on"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>

        <div>
            <button type="submit"
                class="w-full bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition duration-200">
                Add Income
            </button>
        </div>
    </form>
</div>
@endsection