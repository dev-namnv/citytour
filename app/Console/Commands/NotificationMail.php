<?php

namespace App\Console\Commands;

use App\Mail\StatusMail;
use App\Models\Invoice;
use App\Models\Schedule;
use App\Models\Tour;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotificationMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

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
        $date = date('Y-m-d', strtotime('+2 days',Carbon::now()->timestamp));
        $tours = Tour::query()->whereHas('batches', function ($q) use ($date) {
                $q->where('batch', '<=', $date)
                ->where('batch', '>=', date('Y-m-d'));
        })->get();
        foreach ($tours as $tour) {

            $users = array_map(function ($invoice) {
                return $invoice['user'];
                }, $tour->invoices->toArray()
            );
            Mail::to($tour->guide->email)->send(new StatusMail($tour,$users));
        }

        return true;
    }
}
