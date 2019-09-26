<?php

namespace GhulamAli\Artisan\Console\Database;

use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use Illuminate\Support\Facades\DB;

class ArtisanDatabaseList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artisan-database:tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List of the database tables';

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
        $db_tables = array_pluck(DB::select('SHOW TABLES'), 'Tables_in_' . $database);
        foreach($db_tables as $table):
            $db_tables_with_count[] = [
                $table, 
                DB::table($table)->count(),
                $this->tableSize($database, $table)
            ];
        endforeach;
        
        $table = new Table($this->output);
        $table->setHeaders([
            'Tables', 'Records', 'Size'
        ]);
        
        $table->setRows($db_tables_with_count);
        $table->render();
    }
    
    
    /**
     * Get the size of the table
     * 
     * return $size
     */
    private function tableSize($database, $table){
        $size = DB::select('SELECT table_name AS `Table`, 
            round(((data_length + index_length) / 1024 / 1024), 2) `size`
            FROM information_schema.TABLES 
            WHERE table_schema = "'.$database.'" AND table_name = "'.$table.'"');
        
        return $size[0]->size . ' MB';
    }
}
