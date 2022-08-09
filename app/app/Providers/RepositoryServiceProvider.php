<?php

namespace App\Providers;

use App\Repositories\Interfaces\ShortLinkRepositoryInterface;
use App\Repositories\ShortLinkRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ShortLinkRepositoryInterface::class,
            ShortLinkRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
