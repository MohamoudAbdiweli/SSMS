@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white shadow-lg rounded-xl p-8 border border-gray-200">

    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Make Withdrawal</h2>

    @if(session('error'))
    <p class="text-red-600 bg-red-100 border border-red-300 p-3 rounded mb-4">
        {{ session('error') }}
    </p>
    @endif

    <form method="POST" action="{{ route('withdraws.store') }}">
        @csrf

        <!-- Select User -->
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Select User</label>
            <select name="user_id" required
                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400 transition">
                <option value="" disabled selected>Select a user</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Add inside your form, after user selection -->
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Select Saving</label>
            <select name="saving_id" required
                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400 transition">
                <option value="" disabled selected>Select a saving</option>
                @foreach($users as $user)
                @foreach($user->savings as $saving)
                <option value="{{ $saving->id }}">
                    {{ $saving->id }} - {{ $saving->amount }}
                </option>
                @endforeach
                @endforeach
            </select>
        </div>

        <!-- Amount -->
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Amount</label>
            <input type="number" name="amount"
                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400 transition"
                placeholder="Enter amount" required>
        </div>

        <!-- Date -->
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Date</label>
            <input type="date" name="withdrawn_on"
                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400 transition"
                required>
        </div>

        <button type="submit"
            class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-lg shadow-md transition duration-200">
            Withdraw
        </button>
    </form>

    <p class="mt-4 text-sm text-gray-500 text-center">Ensure the user's balance is sufficient before submitting a
        withdrawal.</p>
</div>
@endsection