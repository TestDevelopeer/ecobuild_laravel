<?php

namespace App\Providers;

use App\View\Composers\AppComposer;
use App\View\Composers\SidebarComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
		View::composer('layouts.sidebar', SidebarComposer::class);
		View::composer('layouts.footer', AppComposer::class);
	}
}
