<?php

namespace GhulamAli\Artisan\Console\Log;

use Illuminate\Console\Command;

class ArtisanClearLogFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artisan-log:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clearing Log File';

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
     * @return mixed
     */
    public function handle()
    {
        exec('echo "" > ' . storage_path('logs/laravel.log'));
        $this->info('Logs cleared successfully');
    }
}
