@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow rounded">

    <h2 class="text-2xl font-bold mb-4">Edit Repayment</h2>

    @if ($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul>
            @foreach ($errors->all() as $error)
            <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('repayments.update', $repayment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="w-full border p-2 rounded">
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $repayment->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Loan</label>
            <select name="loan_id" class="w-full border p-2 rounded">
                @foreach($loans as $loan)
                <option value="{{ $loan->id }}" {{ $repayment->loan_id == $loan->id ? 'selected' : '' }}>
                    Loan #{{ $loan->id }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Amount</label>
            <input type="number" name="amount" value="{{ $repayment->amount }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label>Paid On</label>
            <input type="date" name="paid_on" value="{{ $repayment->paid_on->format('Y-m-d') }}"
                class="w-full border p-2 rounded">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('repayments.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
@endsection
