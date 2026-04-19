1️⃣ Create a Command

Run:

php artisan make:command ClearTableData

This creates app/Console/Commands/ClearTableData.php.

2️⃣ Edit the Command
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Deposit;
use App\Models\Income;
use App\Models\Loan;
use App\Models\Withdraw;

class ClearTableData extends Command
{
    protected $signature = 'data:clear-tables';
    protected $description = 'Delete all records from deposits, income, loans, and withdraws tables';

    public function handle()
    {
        // Delete all records
        Deposit::query()->delete();
        Income::query()->delete();
        Loan::query()->delete();
        Withdraw::query()->delete();

        $this->info('All table data deleted successfully!');
    }
}

✅ query()->delete() removes all rows without dropping the table. Auto-increment IDs remain intact if needed.

3️⃣ Schedule the Command

Open app/Console/Kernel.php and update the schedule() function:

protected function schedule(\Illuminate\Console\Scheduling\Schedule $schedule)
{
    $schedule->command('data:clear-tables')->everyMinute();
}
4️⃣ Set Up Cron Job (Linux / Server)
crontab -e

Add:

* * * * * cd /path-to-your-laravel && php artisan schedule:run >> /dev/null 2>&1
Replace /path-to-your-laravel with your Laravel project path.
This will trigger the Laravel scheduler every minute, which runs your delete command.
⚠️ Warning
All data will be erased every 1 minute — any new records only last 1 minute.
If you want to delete only old records instead,
I can rewrite it to delete records older than 1 minute automatically.
