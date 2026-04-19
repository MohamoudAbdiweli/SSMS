@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg">

    <h2 class="text-2xl font-bold mb-6 text-center">Edit Loan</h2>

    @if(session('error'))
    <p class="bg-red-100 text-red-600 p-3 rounded mb-4">
        {{ session('error') }}
    </p>
    @endif

    <form method="POST" action="{{ route('loans.update', $loan->id) }}">
        @csrf
        @method('PUT')

        <input type="number" name="amount" value="{{ $loan->amount }}" class="w-full mb-4 p-3 border rounded-lg"
            required>

        <input type="number" name="duration" value="{{ $loan->duration }}" class="w-full mb-4 p-3 border rounded-lg"
            required>

        <button class="w-full bg-yellow-500 text-white py-3 rounded-lg hover:bg-yellow-600">
            Update Loan
        </button>
    </form>

</div>
@endsection