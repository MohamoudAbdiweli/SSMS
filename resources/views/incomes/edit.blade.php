@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-4 bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Edit Income</h2>

    @if ($errors->any())
    <div class="mb-4 p-2 bg-red-100 text-red-700 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('incomes.update', $income->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">User</label>
            <select name="user_id" class="border rounded px-3 py-2 w-full">
                <option value="">Select User</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $income->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold">Source</label>
            <input type="text" name="source" value="{{ $income->source }}" class="border rounded px-3 py-2 w-full">
        </div>

        <div>
            <label class="block font-semibold">Amount</label>
            <input type="number" name="amount" step="0.01" value="{{ $income->amount }}"
                class="border rounded px-3 py-2 w-full">
        </div>

        <div>
            <label class="block font-semibold">Received On</label>
            <input type="date" name="received_on" value="{{ $income->received_on->format('Y-m-d') }}"
                class="border rounded px-3 py-2 w-full">
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Income
            </button>
            <a href="{{ route('incomes.index') }}" class="ml-2 text-gray-700 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection