<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Saving; // ✅ ADD THIS
use Illuminate\Support\Facades\Mail;
use App\Mail\DepositReceiptMail;

class DepositController extends Controller
{
    // List all deposits
    public function index()
    {
        $deposits = Deposit::with(['user', 'savingRelation']) // ✅ include saving
            ->orderBy('id', 'asc')
            ->get();

        return view('deposits.index', compact('deposits'));
    }

    // Show deposit form
    public function create()
    {
        $users = User::all();
        $savings = Saving::with('user')->get(); // ✅ VERY IMPORTANT

        return view('deposits.create', compact('users', 'savings'));
    }

    // Store new deposit and send email
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'saving_id' => 'required|exists:savings,id',
            'amount' => 'required|numeric|min:1', // ✅ better validation
            'deposited_on' => 'required|date',
        ]);

        $deposit = Deposit::create([
            'user_id' => $request->user_id,
            'saving_id' => $request->saving_id,
            'amount' => $request->amount,
            'deposited_on' => $request->deposited_on,
        ]);

        // Load relationships
        $deposit->load(['user', 'savingRelation']);

        // Send email receipt
        if ($deposit->user && $deposit->user->email) {
            Mail::to($deposit->user->email)
                ->send(new DepositReceiptMail($deposit));
        }

        return redirect()->route('deposits.index')
            ->with('success', 'Deposit created successfully'); // ✅ better UX
    }

    // Edit deposit
    public function edit(Deposit $deposit)
    {
        $users = User::all();
        $savings = Saving::with('user')->get(); // ✅ include savings

        return view('deposits.edit', compact('deposit', 'users', 'savings'));
    }

    // Update deposit
    public function update(Request $request, Deposit $deposit)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'saving_id' => 'required|exists:savings,id', // ✅ ADD THIS
            'amount' => 'required|numeric|min:1',
            'deposited_on' => 'required|date',
        ]);

        $deposit->update([
            'user_id' => $request->user_id,
            'saving_id' => $request->saving_id,
            'amount' => $request->amount,
            'deposited_on' => $request->deposited_on,
        ]);

        return redirect()->route('deposits.index')
            ->with('success', 'Deposit updated successfully');
    }

    // Delete deposit
    public function destroy(Deposit $deposit)
    {
        $deposit->delete();

        return redirect()->route('deposits.index')
            ->with('success', 'Deposit deleted successfully');
    }

    // Print or view receipt
    public function print(Deposit $deposit)
    {
        $deposit->load(['user', 'savingRelation']); // ✅ include saving

        return view('deposits.receipt', compact('deposit'));
    }
}
