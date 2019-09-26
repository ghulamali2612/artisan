<?php

namespace Ghulamali\Artisan\Console\Commands\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ArtisanDatabaseTruncate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artisan-database:truncate {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate the specified table';

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
        $database = config('database.connections.mysql.database');
        $tables = array_pluck(DB::select('SHOW TABLES'), 'Tables_in_' . $database);
        $confirmation = $this->confirm('Are you sure to truncate this table', 'yes');
        
        if(!in_array($this->argument('table'), $tables))
            die($this->warn('Requested table not found')); 
            
        
        if($confirmation):
            DB::table($this->argument('table'))->truncate();
            $this->info('Table truncated successfully!');
        else:
            $this->info('Operation failed');
        endif;
    }
}
