<?php

namespace App\Providers;

use App\Http\ViewComposers\SortingOptionsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            [
                'layouts.__paginator',
            ],
            SortingOptionsComposer::class
        );
    }
}
