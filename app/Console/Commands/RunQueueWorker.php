<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunQueueWorker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:work-scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the queue worker from the scheduler';

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
        \Illuminate\Support\Facades\Artisan::call('queue:work', ['--tries' => 3]);
    }
}
