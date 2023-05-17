<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class TestProvider extends ServiceProvider
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
        Blade::directive('admin', function ($expression) {
            return "<?php if( auth()->user()->permission()->first()->slug == 'admin') { ?>";
        });

        Blade::directive('end', function ($expression) {
            return "<?php } ?>";
        });
    }
}
