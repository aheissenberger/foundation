<?php namespace Aheissenberger\Foundation;

use Illuminate\Support\ServiceProvider;

class FoundationServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('aheissenberger/foundation');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['setup'] = $this->app->share(function($app)
		{
			return new SetupCommand($app);
		});
		$this->commands('setup');
		$this->app['demo'] = $this->app->share(function($app)
		{
			return new DemoCommand($app);
		});
		$this->commands('demo');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}



}