<?php

namespace GhulamAli\Artisan;

use Illuminate\Support\ServiceProvider;
use GhulamAli\Artisan\Console\Database\ArtisanDatabaseList;
use GhulamAli\Artisan\Console\Database\ArtisanDatabaseRefresh;
use GhulamAli\Artisan\Console\Database\ArtisanDatabaseTruncate;
use GhulamAli\Artisan\Console\Database\ArtisanDatabaseDrop;
use GhulamAli\Artisan\Console\Log\ArtisanClearLogFile;
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
        $this->app->bind('command.artisan-database:tables', ArtisanDatabaseList::class);
		$this->app->bind('command.artisan-database:fresh', ArtisanDatabaseRefresh::class);
		$this->app->bind('command.artisan-database:truncate', ArtisanDatabaseTruncate::class);
		$this->app->bind('command.artisan-database:drop', ArtisanDatabaseDrop::class);
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
