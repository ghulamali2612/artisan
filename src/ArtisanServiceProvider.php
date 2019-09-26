<?php

namespace GhulamAli\Artisan;

use Illuminate\Support\ServiceProvider;
use GhulamAli\Artisan\Console\Commands\Database\ArtisanDatabaseTableList;
use GhulamAli\Artisan\Console\Commands\Database\ArtisanDatabaseRefresh;
use GhulamAli\Artisan\Console\Commands\Database\ArtisanDatabaseTableTruncate;
use GhulamAli\Artisan\Console\Commands\Database\ArtisanDatabaseTableDrop;
use GhulamAli\Artisan\Console\Commands\Database\ArtisanClearLogFile;
use Symfony\Component\Console\Helper\Table;
use Illuminate\Support\Facades\DB;

class ArtisanServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind('command.artisan-database:tables', ArtisanDatabaseTableList::class);
		$this->app->bind('command.artisan-database:fresh', ArtisanDatabaseRefresh::class);
		$this->app->bind('command.artisan-database:truncate', ArtisanDatabaseTableTruncate::class);
		$this->app->bind('command.artisan-database:drop', ArtisanDatabaseTableDrop::class);
		$this->app->bind('command.artisan-log:clear', ArtisanClearLogFile::class);

        $this->commands([
            'command.artisan-database:tables',
			'command.artisan-database:fresh',
			'command.artisan-database:truncate',
			'command.artisan-database:drop',
			'command.artisan-log:clear',
        ]);
    }
}
