<?php

namespace Ejimba\Authenticator;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class AuthenticatorServiceProvider extends ServiceProvider {

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
		$this->package('ejimba/authenticator');
		include __DIR__.'/../../routes.php';
		include __DIR__.'/../../filters.php';
		$this->overwriteSentryConfig();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{	
        $this->registerProviders();
        $this->registerAliases();
        $this->bindClasses();
	}

	protected function registerProviders()
    {
        $this->app->register('Cartalyst\Sentry\SentryServiceProvider');
    }

    protected function registerAliases()
    {
        AliasLoader::getInstance()->alias('Sentry', 'Cartalyst\Sentry\Facades\Laravel\Sentry');
        AliasLoader::getInstance()->alias('Authenticator', 'Ejimba\Authenticator\Facades\Authenticator');
    }

    protected function bindClasses()
    {
        $this->app->bind('authenticator', function ()
        {
        	return new Authenticator;
        });
    }

    protected function overwriteSentryConfig()
    {
        $this->app['config']->getLoader()->addNamespace('cartalyst/sentry', __DIR__ . '/../../config/sentry');
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