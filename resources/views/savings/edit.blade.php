@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow rounded">

    <h2 class="text-2xl font-bold mb-4">Edit Saving</h2>

    {{-- Show Validation Errors --}}
    @if ($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('savings.update', $saving->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Select Member --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Member</label>
            <select name="user_id" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="">Select User</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $saving->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Type --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Type</label>
            <select name="type" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="regular" {{ $saving->type == 'regular' ? 'selected' : '' }}>Regular</option>
                <option value="fixed" {{ $saving->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                <option value="target" {{ $saving->type == 'target' ? 'selected' : '' }}>Target</option>
            </select>
        </div>

        {{-- Target Amount --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Target Amount (Optional)</label>
            <input type="number" name="target_amount" step="0.01" value="{{ $saving->target_amount }}"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        {{-- Maturity Date --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Maturity Date (Optional)</label>
            <input type="date" name="maturity_date" value="{{ $saving->maturity_date }}"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        {{-- Buttons --}}
        <div class="flex items-center space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Saving
            </button>
            <a href="{{ route('savings.index') }}" class="text-gray-700 hover:underline">Cancel</a>
        </div>

    </form>
</div>
@endsection