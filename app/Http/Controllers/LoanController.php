<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoanMail;

class LoanController extends Controller
{
    public function index()
    {
        $loans = auth()->user()->loans()->latest()->get();
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        // Get all users so admin can select one
        $users = \App\Models\User::all();
        return view('loans.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Added user selection
            'amount' => 'required|numeric|min:1',
            'duration' => 'required|integer|min:1',
        ]);

        $user = \App\Models\User::findOrFail($request->user_id); // Use selected user

        $income = $user->incomes()->sum('amount');

        // Eligibility calculation
        $dtiFactor = 0.8;
        $creditFactor = 0.9;
        $employmentFactor = 1;
        $ageFactor = 0.85;
        $years = $request->duration / 12;
        $eligibility = $income * 0.4 * $dtiFactor * $creditFactor * $employmentFactor * $ageFactor * ($years * 12 * 0.6);

        if ($request->amount > $eligibility) {
            return back()->with('error', 'Loan exceeds user eligibility');
        }

        $interest = 10;
        $total = $request->amount + ($request->amount * $interest / 100);

        $loan = Loan::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'duration' => $request->duration,
            'interest' => $interest,
            'total_payable' => $total,
            'eligibility' => $eligibility,
            'requested_on' => now(),
        ]);

        // Send email to selected user
        Mail::to($user->email)->send(new LoanMail($loan));

        return redirect()->route('loans.index');
    }
    // Show edit form
    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        return view('loans.edit', compact('loan'));
    }

    // Update loan
    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'duration' => 'required|integer|min:1',
        ]);

        $user = auth()->user();

        $income = $user->incomes()->sum('amount');

        // Factors
        $dtiFactor = 0.8;
        $creditFactor = 0.9;
        $employmentFactor = 1;
        $ageFactor = 0.85;

        $years = $request->duration / 12;

        $eligibility = $income * 0.4 * $dtiFactor * $creditFactor * $employmentFactor * $ageFactor * ($years * 12 * 0.6);

        if ($request->amount > $eligibility) {
            return back()->with('error', 'Loan exceeds your eligibility');
        }

        $interest = 10;
        $total = $request->amount + ($request->amount * $interest / 100);

        $loan->update([
            'amount' => $request->amount,
            'duration' => $request->duration,
            'total_payable' => $total,
            'eligibility' => $eligibility,
        ]);

        return redirect()->route('loans.index');
    }

    // Delete loan
    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();

        return redirect()->route('loans.index');
    }

    public function print($id)
    {
        $loan = Loan::findOrFail($id);
        return view('loans.receipt', compact('loan'));
    }
}
