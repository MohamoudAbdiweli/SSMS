<?php

namespace App\Exports;

use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Income;
use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class ReportsExport implements FromCollection, WithHeadings
{
    protected $type;
    protected $start;
    protected $end;

    public function __construct($type, $start, $end)
    {
        $this->type = $type;
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        // Combine all data in one collection for Excel
        $deposits = Deposit::whereBetween('deposited_on', [$this->start, $this->end])->get()->map(function ($d) {
            return [
                'Type' => 'Deposit',
                'User' => $d->user->name,
                'Amount' => $d->amount,
                'Date' => $d->deposited_on
            ];
        });

        $withdrawals = Withdrawal::whereBetween('withdrawn_on', [$this->start, $this->end])->get()->map(function ($w) {
            return [
                'Type' => 'Withdrawal',
                'User' => $w->user->name,
                'Amount' => $w->amount,
                'Date' => $w->withdrawn_on
            ];
        });

        $incomes = Income::whereBetween('received_on', [$this->start, $this->end])->get()->map(function ($i) {
            return [
                'Type' => 'Income',
                'User' => $i->user->name,
                'Amount' => $i->amount,
                'Date' => $i->received_on
            ];
        });

        $loans = Loan::whereBetween('requested_on', [$this->start, $this->end])->get()->map(function ($l) {
            return [
                'Type' => 'Loan',
                'User' => $l->user->name,
                'Amount' => $l->amount,
                'Date' => $l->requested_on
            ];
        });

        return $deposits->merge($withdrawals)->merge($incomes)->merge($loans);
    }

    public function headings(): array
    {
        return ['Type', 'User', 'Amount', 'Date'];
    }
}
