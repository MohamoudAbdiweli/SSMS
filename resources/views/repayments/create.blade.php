@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">

    <h2 class="text-2xl font-semibold mb-6">Add Repayment</h2>

    @if ($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul>
            @foreach ($errors->all() as $error)
            <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('repayments.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">User</label>
            <select name="user_id" class="w-full border p-2 rounded">
                <option value="">Select User</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium">Loan</label>
            <select name="loan_id" class="w-full border p-2 rounded">
                <option value="">Select Loan</option>
                @foreach($loans as $loan)
                <option value="{{ $loan->id }}">
                    Loan ID: {{ $loan->id }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium">Amount</label>
            <input type="number" name="amount" step="0.01" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Paid On</label>
            <input type="date" name="paid_on" class="w-full border p-2 rounded">
        </div>

        <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            Save Repayment
        </button>
    </form>
</div>
@endsection