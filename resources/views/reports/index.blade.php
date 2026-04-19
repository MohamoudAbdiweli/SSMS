@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-xl shadow-lg">

    <h2 class="text-2xl font-bold mb-6 text-center">Generate Report</h2>

    <form method="POST" action="{{ route('reports.generate') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Select Report Type:</label>
            <select name="type" class="w-full border p-2 rounded-lg">
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="annual">Annual</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg">
            Generate Report
        </button>
    </form>
</div>
@endsection