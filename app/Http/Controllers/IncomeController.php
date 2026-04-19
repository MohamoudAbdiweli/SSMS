<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\IncomeAddedMail;

class IncomeController extends Controller
{
    // Show form to create income
    public function create()
    {
        $users = User::all(); // get all users for dropdown
        return view('incomes.create', compact('users'));
    }

    // Store income
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'source' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'received_on' => 'required|date',
        ]);

        $income = Income::create($request->all());

        Mail::to($income->user->email)->send(new IncomeAddedMail($income));

        return redirect()->route('incomes.index');
    }

    // List all incomes
    public function index()
    {
        $incomes = Income::with('user')->get(); // eager load user
        return view('incomes.index', compact('incomes'));
    }

    // Show form to edit income
    public function edit(Income $income)
    {
        $users = User::all();
        return view('incomes.edit', compact('income', 'users'));
    }

    // Update income
    public function update(Request $request, Income $income)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'source' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'received_on' => 'required|date',
        ]);

        $income->update($request->all());

        return redirect()->route('incomes.index');
    }

    // Delete income
    public function destroy(Income $income)
    {
        $income->delete();
        return redirect()->route('incomes.index');
    }

    public function print(Income $income)
    {
        $income->load('user');
        return view('incomes.print', compact('income'));
    }
}
