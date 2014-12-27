<?php namespace Michaeljennings\Validation;

use Closure;
use ReflectionException;
use Illuminate\Container\Container;
use Michaeljennings\Validation\Exceptions\ValidatorNotFoundException;

class ValidationCollection extends Container {

    /**
     * Return a validation closure from the collection
     *
     * @param  string $name
     * @return Closure
     */
    public function get($name)
    {
        try {
            return $this->make($name);
        } catch (ReflectionException $e) {
            throw new ValidatorNotFoundException("Failed to find a validator with the name '{$name}'.");
        }
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