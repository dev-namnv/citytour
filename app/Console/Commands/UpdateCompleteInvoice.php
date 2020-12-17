<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateCompleteInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:update_complete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Invoice::query()->where('status',5)->update(['status'=>6]);

        $date = date('Y-m-d H:i:s', strtotime('-3 days',Carbon::now()->timestamp));
        Invoice::query()->where('status',4)
            ->where('updated_at','<',$date)
            ->update(['status'=>6]);
        return true;
    }
}
