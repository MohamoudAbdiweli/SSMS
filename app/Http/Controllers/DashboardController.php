<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Monthly deposits
        $deposits = $user->deposits()
            ->selectRaw('MONTH(deposited_on) as month, SUM(amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Monthly withdrawals
        $withdrawals = $user->withdrawals()
            ->selectRaw('MONTH(withdrawn_on) as month, SUM(amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Monthly incomes
        $incomes = $user->incomes()
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Total sums
        $totalDeposits = $user->deposits()->sum('amount');
        $totalWithdrawals = $user->withdrawals()->sum('amount');
        $totalIncomes = $user->incomes()->sum('amount');

        // Loan prediction: 50% of available balance
        $availableBalance = $totalDeposits + $totalIncomes - $totalWithdrawals;
        $loanEligibility = $availableBalance * 0.5;

        // Project loan eligibility over 12 months (linear)
        $projectedLoan = [];
        for ($i = 1; $i <= 12; $i++) {
            $projectedLoan[] = round($loanEligibility + $i * ($totalIncomes * 0.5 - $totalWithdrawals * 0.5), 2);
        }

        return view('dashboard', compact(
            'deposits',
            'withdrawals',
            'incomes',
            'totalDeposits',
            'totalWithdrawals',
            'totalIncomes',
            'projectedLoan'
        ));
    }
}
