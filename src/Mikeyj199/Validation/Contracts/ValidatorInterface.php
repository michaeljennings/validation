<?php namespace Mikeyj199\Validation\Contracts;

use Closure;

interface ValidatorInterface {

	/**
	 * Add a validator into the validation collection
	 * 
	 * @param string  $name     
	 * @param Closure $callback 
	 */
	public function add($name, Closure $callback);

	/**
	 * Load the validators
	 * 
	 * @return void 
	 */
	public function loadValidators();

	/**
	 * Get a validator from the collection and create a new instance of the 
	 * validator
	 * 
	 * @param  string $name  
	 * @param  array $input 
	 * @return Gmlconsulting\Validation\Validation
	 */
	public function make($name, array $input);

	/**
	 * Render the rules ready for the validator make function
	 * 
	 * @return void
	 */
	public function createRules();

	/**
	 * Create a new rule
	 * 
	 * @param  string $name 
	 * @return Gmlconsulting\Validation\Rule       
	 */
	public function rule($name);
}