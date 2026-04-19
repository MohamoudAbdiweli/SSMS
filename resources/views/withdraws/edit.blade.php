@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white shadow-lg rounded-xl p-8 border border-gray-200">

    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Edit Withdrawal</h2>

    @if(session('error'))
    <p class="text-red-600 bg-red-100 border border-red-300 p-3 rounded mb-4">
        {{ session('error') }}
    </p>
    @endif

    <form method="POST" action="{{ route('withdraws.update', $withdraw->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Amount</label>
            <input type="number" name="amount" value="{{ $withdraw->amount }}"
                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400 transition"
                required>
        </div>

        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Date</label>
            <input type="date" name="withdrawn_on" value="{{ $withdraw->withdrawn_on }}"
                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400 transition"
                required>
        </div>

        <button type="submit"
            class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-lg shadow-md transition duration-200">
            Update Withdrawal
        </button>
    </form>
</div>
@endsection