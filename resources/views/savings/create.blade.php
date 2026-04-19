@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow mt-6">

    <h2 class="text-xl font-bold mb-4">Create Saving</h2>

    <form action="{{ route('savings.store') }}" method="POST">
        @csrf

        <label class="block mb-2 font-medium">Select Member</label>
        <select name="user_id" class="w-full border p-2 mb-3">
            <option value="">Select User</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <label class="block mb-2 font-medium">Type</label>
        <select name="type" class="w-full border p-2 mb-3">
            <option value="regular">Regular Savings</option>
            <option value="fixed">Fixed Savings</option>
            <option value="target">Target Savings</option>
        </select>

        <label class="block mb-2 font-medium">Target Amount (Optional)</label>
        <input type="number" name="target_amount" class="w-full border p-2 mb-3" step="0.01">

        <label class="block mb-2 font-medium">Maturity Date (Optional)</label>
        <input type="date" name="maturity_date" class="w-full border p-2 mb-3">

        <button class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
    </form>

</div>
@endsection