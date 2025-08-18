<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * 認証後の既定リダイレクト先。
     * ログイン後は intended のフォールバック、登録後はこのパスへ直行。
     */
    public const HOME = '/home';

    public function boot(): void
    {
        //
    }
}
