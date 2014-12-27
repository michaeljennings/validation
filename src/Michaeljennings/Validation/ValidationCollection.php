<?php namespace Michaeljennings\Validation;

use Closure;
use Illuminate\Container\Container;

class ValidationCollection extends Container {

	/**
	 * Return a validation closure from the collection
	 * 
	 * @param  string $name 
	 * @return Closure       
	 */
	public function get($name)
	{
		return $this->make($name);
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
		$this->singleton($name, function() use ($callback)
		{
			return $callback;
		});
	}
}