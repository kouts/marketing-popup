<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libs\Db;

class DbServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Db', function ($app) {
            return new Db(
                env('DB_HOST'),
                env('DB_DATABASE'),
                env('DB_USERNAME'),
                env('DB_PASSWORD')
            );
        });
    }
}
