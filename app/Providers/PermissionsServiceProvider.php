<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


class PermissionsServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        try {
            Permission::get()->map(
                function ($permission) {
                    Gate::define(
                        $permission->slug, function ($user) use ($permission) {
                            return $user->hasPermissionTo($permission);
                        }
                    );
                }
            );
        } catch (\Exception $e) {
            report($e);
            return false;
        }

        //Blade directives
        Blade::directive(
            'admin', function ($expression) {
                return "<?php if( auth()->user()->permission()->first()->slug == 'admin') { ?>";
            }
        );
        Blade::directive(
            'tech', function ($expression) {
                return "<?php if( auth()->user()->permission()->first()->slug == 'tech_mod') { ?>";
            }
        );
        Blade::directive(
            'cashier', function ($expression) {
                return "<?php if( auth()->user()->permission()->first()->slug == 'tech_mod') { ?>";
            }
        );
        Blade::directive(
            'onduty', function ($expression) {
                return "<?php if( auth()->user()->permission()->first()->slug == 'onduty_mod') { ?>";
            }
        );
        Blade::directive(
            'user', function ($expression) {
                return "<?php if( auth()->user()->permission()->first()->slug == 'user') { ?>";
            }
        );
        Blade::directive(
            'staff', function ($expression) {
                return "<?php if( auth()->user()->permission()->first()->slug == 'user') { ?>";
            }
        );

        Blade::directive(
            'end', function ($expression) {
                return "<?php } ?>";
            }
        );
    }
}
