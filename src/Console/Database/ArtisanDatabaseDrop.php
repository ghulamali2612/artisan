<?php

namespace Ghulamali\Artisan\Console\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ArtisanDatabaseDrop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artisan-database:drop {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop the specified table';

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
        $confirmation = $this->confirm('Are you sure to drop this table! This will also delete migration row from the migration table', 'yes');
        
        if(!in_array($this->argument('table'), $tables))
            die($this->error('Requested table not found')); 
            
        if($confirmation):
            DB::table('migrations')->where('migration', 'LIKE', '%'.$this->argument('table').'_table%')->delete();
            DB::statement('drop table ' . $this->argument('table'));
            $this->info('Table dropped successfully!');
        else:
            $this->info('Operation failed');
        endif;
    }
}
