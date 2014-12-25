<?php namespace Michaeljennings\Validation;

use Closure, Config;

class Validation implements Contracts\ValidatorInterface {

	/**
	 * The validation messages
	 * 
	 * @var array
	 */
	protected $messages = array();

	/**
	 * The validation rules
	 * 
	 * @var array
	 */
	protected $rules = array();

	public function __construct($collection, $validator)
	{
		$this->collection = $collection;
		$this->validator  = $validator;
	}

	/**
	 * Add a validator into the validation collection
	 * 
	 * @param string  $name     
	 * @param Closure $callback 
	 */
	public function add($name, Closure $callback)
	{
		$this->collection->put($name, $callback);
	}

	/**
	 * Load the validators
	 * 
	 * @return void 
	 */
	public function loadValidators()
	{
		$validatorFile = Config::get('validation::validation.validators');

		if (file_exists($validatorFile)) require_once $validatorFile;
	}

	/**
	 * Get a validator from the collection and create a new instance of the 
	 * validator
	 * 
	 * @param  string $name  
	 * @param  array $input 
	 * @return Gmlconsulting\Validation\Validation
	 */
	public function make($name, array $input)
	{
		$this->loadValidators();
		$this->input = $input;

		$callback = $this->collection->get($name);
		$callback($this);

		$this->createRules();

		return $this;
	}

	/**
	 * Render the rules ready for the validator make function
	 * 
	 * @return void
	 */
	public function createRules()
	{
		foreach ($this->rules as $field => $arguments)
		{
			if ($arguments instanceof Rule) {
				//Check for messages and them in to the messages array
				if ($arguments->messages) {
					foreach ($arguments->messages as $rule => $message) {
						$this->messages[$field.'.'.$rule] = $message;
					}
				}

				unset($arguments->messages);

				$this->rules[$field] = $arguments->toRule();
			}
		}

		$this->validatorInstance = $this->validator->make($this->input, $this->rules, $this->messages);
	}

	/**
	 * Create a new rule
	 * 
	 * @param  string $name 
	 * @return Gmlconsulting\Validation\Rule       
	 */
	public function rule($name)
	{
		$this->rules[$name] = new Rule;
		return $this->rules[$name];
	}

	public function __call($name, $arguments)
	{
		return $this->validatorInstance->$name($arguments);
	}
}