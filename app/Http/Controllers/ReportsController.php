<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saving;
use App\Models\Repayments;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Income;
use App\Models\Loan;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportsExport;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    private function getDateRange($type)
    {
        switch ($type) {
            case 'daily':
                return [Carbon::today(), Carbon::today()->endOfDay()];
            case 'weekly':
                return [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
            case 'annual':
                return [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()];
            default:
                return [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()];
        }
    }

    public function generate(Request $request)
    {
        $type = $request->type;

        [$start, $end] = $this->getDateRange($type);

        $incomes = Income::with('user')->whereBetween('received_on', [$start, $end])->get();
        $savings = Saving::with('user')->whereBetween('created_on', [$start, $end])->get();
        $deposits = Deposit::with('user')->whereBetween('deposited_on', [$start, $end])->get();
        $withdrawals = Withdrawal::with('user')->whereBetween('withdrawn_on', [$start, $end])->get();
        $loans = Loan::with('user')->whereBetween('requested_on', [$start, $end])->get();
        $repayments = Repayments::with('user')->whereBetween('paid_on', [$start, $end])->get();

        return view('reports.show', compact(
            'type',
            'start',
            'end',
            'incomes',
            'savings',
            'deposits',
            'withdrawals',
            'loans',
            'repayments'
        ));
    }

    public function exportPdf(Request $request)
    {
        $type = $request->type;

        [$start, $end] = $this->getDateRange($type);

        $incomes = Income::with('user')->whereBetween('received_on', [$start, $end])->get();
        $savings = Saving::with('user')->whereBetween('created_on', [$start, $end])->get();
        $deposits = Deposit::with('user')->whereBetween('deposited_on', [$start, $end])->get();
        $withdrawals = Withdrawal::with('user')->whereBetween('withdrawn_on', [$start, $end])->get();
        $loans = Loan::with('user')->whereBetween('requested_on', [$start, $end])->get();
        $repayments = Repayments::with('user')->whereBetween('paid_on', [$start, $end])->get();

        $pdf = Pdf::loadView('reports.pdf', compact(
            'type',
            'start',
            'end',
            'incomes',
            'savings',
            'deposits',
            'withdrawals',
            'loans',
            'repayments'
        ));

        return $pdf->download("report_{$type}_" . now()->format('Ymd') . ".pdf");
    }

    public function exportExcel(Request $request)
    {
        $type = $request->type;

        [$start, $end] = $this->getDateRange($type);

        return Excel::download(
            new ReportsExport($type, $start, $end),
            "report_{$type}_" . now()->format('Ymd') . ".xlsx"
        );
    }
}
