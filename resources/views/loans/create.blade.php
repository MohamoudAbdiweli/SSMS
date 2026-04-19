@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg">

    <h2 class="text-2xl font-bold mb-6 text-center">Request Loan</h2>

    @if(session('error'))
    <p class="bg-red-100 text-red-600 p-3 rounded mb-4">
        {{ session('error') }}
    </p>
    @endif

    <form method="POST" action="{{ route('loans.store') }}">
        @csrf

        <!-- Select User -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Select User</label>
            <select name="user_id" required
                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                <option value="" disabled selected>Select a user</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Loan Amount -->
        <input type="number" name="amount" placeholder="Amount" class="w-full mb-4 p-3 border rounded-lg" required>

        <!-- Duration -->
        <input type="number" name="duration" placeholder="Duration (months)" class="w-full mb-4 p-3 border rounded-lg"
            required>

        <!-- Submit -->
        <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition">
            Request Loan
        </button>
    </form>

</div>
@endsection