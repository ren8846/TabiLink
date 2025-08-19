<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Conversation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.header', function ($view) {
            $count = 0;
            if (auth()->check()) {
                $count = Conversation::unreadTotalFor(auth()->id());
            }
            $view->with('dmUnreadTotal', $count);
        });
    }
}
