<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Section;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Schema::defaultStringLength(191);
		URL::forceScheme("https");
		view()->composer('layouts.app', function ($view) {
			$sections = Section::where("parent_id", 0)->orderBy("position", "asc")->get();
			$view->with('sections', $sections);
		});

		view()->composer('layouts.flashlessapp', function ($view) {
			$sections = Section::where("parent_id", 0)->orderBy("position", "asc")->get();
			$view->with('sections', $sections);
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
