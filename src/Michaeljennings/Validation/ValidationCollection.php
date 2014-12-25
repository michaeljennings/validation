<?php namespace Michaeljennings\Validation;

use Closure;

class ValidationCollection {

	/**
	 * An instance of the IOC container
	 * 
	 * @var Illuminate\Container\Container
	 */
	protected $app;

	public function __construct($app)
	{
		$this->app = $app;
	}

	/**
	 * Return a validation closure from the collection
	 * 
	 * @param  string $name 
	 * @return Closure       
	 */
	public function get($name)
	{
		return $this->app->make($name);
	}

	/**
	 * Add a validation closure to the collection
	 * 
	 * @param  string  $name     
	 * @param  Closure $callback 
	 * @return void            
	 */
	public function put($name, Closure $callback)
	{
		$this->app->singleton($name, function($app) use ($callback)
		{
			return $callback;
		});
	}
}