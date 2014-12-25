<?php namespace Michaeljennings\Validation\Facades;

use Illuminate\Support\Facades\Facade;

class Validation extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'validation'; }

}