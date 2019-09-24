<?php

namespace GhulamAli\Artisan;

use Illuminate\Support\ServiceProvider;
use GhulamAli\Artisan\Console\Console\Commands\Database\ArtisanDatabaseTableList
use Symfony\Component\Console\Helper\Table;
use Illuminate\Support\Facades\DB;

class ArtisanServiceProcider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind('command.artisan-database:tables', ArtisanDatabaseTableList::class);

        $this->commands([
            'command.artisan-database:tables',
        ]);
    }
}