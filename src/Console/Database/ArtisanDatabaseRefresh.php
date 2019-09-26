<?php

namespace GhulamAli\Artisan\Console\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ArtisanDatabaseRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artisan-database:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncating all tables data from the database';

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
        $confirmation = $this->confirm('Are you sure to delete this table', 'yes');
        
        if($confirmation):
            foreach($tables as $table):
                if($table !== 'migrations'):
                    DB::table($table)->truncate();
                endif;
            endforeach;
            $this->info('Database refreshed successfully!');
        endif;
    }
}
