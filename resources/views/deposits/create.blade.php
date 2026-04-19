@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Add Deposit</h2>

    <form action="{{ route('deposits.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- User -->
        <select name="user_id" class="w-full border px-3 py-2 rounded">
            <option value="">Select User</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <!-- Saving (FIX) -->
        <select name="saving_id" class="w-full border px-3 py-2 rounded">
            <option value="">Select Saving</option>
            @foreach($savings as $saving)
            <option value="{{ $saving->id }}">
                {{ $saving->user->name }} - Saving #{{ $saving->id }}
            </option>
            @endforeach
        </select>

        <!-- Amount -->
        <input type="number" name="amount" placeholder="Amount" class="w-full border px-3 py-2 rounded">

        <!-- Date -->
        <input type="date" name="deposited_on" class="w-full border px-3 py-2 rounded">

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Save Deposit
        </button>
    </form>
</div>
@endsection