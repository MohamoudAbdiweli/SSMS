<?php

namespace App\Http\Controllers;

use App\Models\Repayments;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RepaymentCreatedMail;

class RepaymentController extends Controller
{
    /**
     * Display all repayments
     */
    public function index()
    {
        $repayments = Repayments::with(['user', 'loan'])
            ->orderBy('created_at', 'asc') // ascending order
            ->get();

        return view('repayments.index', compact('repayments'));
    }

    /**
     * Show form to create a repayment
     */
    public function create()
    {
        $users = User::all();
        $loans = Loan::all();

        return view('repayments.create', compact('users', 'loans'));
    }

    /**
     * Store a new repayment
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_id' => 'required|exists:loans,id',
            'amount' => 'required|numeric|min:1',
            'paid_on' => 'required|date',
        ]);

        $loan = Loan::findOrFail($request->loan_id);

        // Prevent overpayment
        $totalPaid = $loan->repayments()->sum('amount');
        if (($totalPaid + $request->amount) > $loan->amount) {
            return back()->withErrors('Amount exceeds remaining loan balance');
        }

        $repayment = Repayments::create([
            'user_id' => $request->user_id,
            'loan_id' => $request->loan_id,
            'amount' => $request->amount,
            'paid_on' => $request->paid_on,
        ]);

        // Load relationships for email
        $repayment->load('user', 'loan');

        // Send email notification to the user
        Mail::to($repayment->user->email)->send(new RepaymentCreatedMail($repayment));

        return redirect()->route('repayments.index');
    }

    /**
     * Show edit form
     */
    public function edit(Repayments $repayment)
    {
        $users = User::all();
        $loans = Loan::all();

        return view('repayments.edit', compact('repayment', 'users', 'loans'));
    }

    /**
     * Update repayment
     */
    public function update(Request $request, Repayments $repayment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_id' => 'required|exists:loans,id',
            'amount' => 'required|numeric|min:1',
            'paid_on' => 'required|date',
        ]);

        $loan = Loan::findOrFail($request->loan_id);

        // Prevent overpayment after update
        $totalPaid = $loan->repayments()->where('id', '!=', $repayment->id)->sum('amount');
        if (($totalPaid + $request->amount) > $loan->amount) {
            return back()->withErrors('Updated amount exceeds loan balance');
        }

        $repayment->update([
            'user_id' => $request->user_id,
            'loan_id' => $request->loan_id,
            'amount' => $request->amount,
            'paid_on' => $request->paid_on,
        ]);

        return redirect()->route('repayments.index');
    }

    /**
     * Delete repayment
     */
    public function destroy(Repayments $repayment)
    {
        $repayment->delete();

        return back();
    }

    /**
     * Show repayment receipt
     */
    public function receipt(Repayments $repayment)
    {
        $repayment->load('user', 'loan');
        return view('repayments.receipt', compact('repayment'));
    }
}
