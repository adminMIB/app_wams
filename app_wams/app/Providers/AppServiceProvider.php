<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       // kita buat 
        Gate::define('admin', function(User $user) {
        // jika dia sudah login dan username nya admin kasih kunci crud
        return $user->role_id === 1;
    });
    Paginator::useBootstrap();
    
    }

}
