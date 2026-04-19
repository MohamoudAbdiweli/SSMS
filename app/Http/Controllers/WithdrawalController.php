<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawalMail;

class WithdrawalController extends Controller
{
    // List all withdrawals (optional: show for all users or selected user)
    public function index()
    {
        $withdrawals = Withdrawal::with('user')->latest()->get();
        return view('withdraws.index', compact('withdrawals'));
    }

    // Show create form with user selection
    public function create()
    {
        $users = User::all(); // Pass all users for dropdown
        return view('withdraws.create', compact('users'));
    }

    // Store withdrawal
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'saving_id' => 'required|exists:savings,id',
            'amount' => 'required|numeric|min:1',
            'withdrawn_on' => 'required|date'
        ]);

        $user = User::findOrFail($request->user_id);

        // Calculate balance for selected user
        $balance = $user->incomes()->sum('amount')
            + $user->deposits()->sum('amount')
            - $user->withdrawals()->sum('amount');

        if ($request->amount > $balance) {
            return back()->with('error', 'Insufficient balance for selected user');
        }

        $withdrawal = Withdrawal::create([
            'user_id' => $user->id,
            'saving_id' => $request->saving_id,
            'amount' => $request->amount,
            'withdrawn_on' => $request->withdrawn_on
        ]);

        // Send email to the selected user
        if ($user->email) {
            Mail::to($user->email)->send(new WithdrawalMail($withdrawal));
        }

        return redirect()->route('withdraws.index');
    }

    // Edit withdrawal
    public function edit(Withdrawal $withdraw)
    {
        $users = User::all(); // For user dropdown
        return view('withdraws.edit', compact('withdraw', 'users'));
    }

    // Update withdrawal
    public function update(Request $request, Withdrawal $withdraw)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'saving_id' => 'required|exists:savings,id',
            'amount' => 'required|numeric|min:1',
            'withdrawn_on' => 'required|date',
        ]);

        $user = User::findOrFail($request->user_id);

        // Calculate balance excluding current withdrawal
        $balance = $user->incomes()->sum('amount')
            + $user->deposits()->sum('amount')
            - $user->withdrawals()->where('id', '!=', $withdraw->id)->sum('amount');

        if ($request->amount > $balance) {
            return back()->with('error', 'Insufficient balance for selected user');
        }

        $withdraw->update([
            'user_id' => $user->id,
            'saving_id' => $request->saving_id,
            'amount' => $request->amount,
            'withdrawn_on' => $request->withdrawn_on
        ]);

        return redirect()->route('withdraws.index');
    }

    // Delete withdrawal
    public function destroy(Withdrawal $withdraw)
    {
        $withdraw->delete();
        return redirect()->route('withdraws.index');
    }

    // Print withdrawal receipt
    public function print($id)
    {
        $w = Withdrawal::with('user')->findOrFail($id);
        return view('withdraws.receipt', compact('w'));
    }
}
