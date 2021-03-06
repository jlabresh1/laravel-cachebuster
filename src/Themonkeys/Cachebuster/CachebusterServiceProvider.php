<?php namespace Themonkeys\Cachebuster;

use Illuminate\Support\ServiceProvider;

class CachebusterServiceProvider extends ServiceProvider {

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
		$this->package('themonkeys/cachebuster');
        $this->app->close('cachebuster.StripSessionCookiesFilter');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['cachebuster.url'] = $this->app->share(function($app) {
            return new AssetURLGenerator();
        });
        $this->app['cachebuster.StripSessionCookiesFilter'] = $this->app->share(function($app) {
            return new StripSessionCookiesFilter();
        });
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