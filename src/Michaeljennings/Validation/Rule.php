<?php namespace Michaeljennings\Validation;

use Illuminate\Support\Fluent;

class Rule extends Fluent {

	/**
	 * The field must be a valid url according to the checkdnsrr php function.
	 * 
	 * @return Mixed
	 */
	public function activeUrl()
	{
		$this->attributes['active_url'] = true;
		return $this;
	}

	/**
	 * The field may have alpha-numeric characters, as well as dashes and 
	 * underscores.
	 * 
	 * @return Mixed 
	 */
	public function alphaDash()
	{
		$this->attributes['alpha_dash'] = true;
		return $this;
	}

	/**
	 * The field must be entirely alpha-numeric characters.
	 * 
	 * @return Mixed 
	 */
	public function alphaNum()
	{
		$this->attributes['alpha_num'] = true;
		return $this;
	}

	/**
	 * The field must match the format defined according to the 
	 * date_parse_from_format PHP function.
	 * 
	 * @param  string $format 
	 * @return Mixed         
	 */
	public function dateFormat($format)
	{
		$this->attributes['date_format'] = $format;
		return $this;
	}

	/**
	 * The field must have a length between the given min and max.
	 * 
	 * @param  int   $min 
	 * @param  int   $max 
	 * @return Mixed      
	 */
	public function digitsBetween($min, $max)
	{
		$this->attributes['digits_between'] = $min.','.$max;
		return $this;
	}

	/**
	 * The field must be included in the given list of values.
	 * 
	 * @param  string|array $values Either a comma seperated string or an array
	 * @return Mixed         
	 */
	public function in($values)
	{
		if (is_array($values)) $values = implode(',', $values);

		$this->attributes['in'] = $values;
		return $this;
	}

	/**
	 * Set a message for the rule
	 * 
	 * @param  string $rule    
	 * @param  string $message 
	 * @return Mixed          
	 */
	public function message($rule, $message)
	{
		$this->attributes['messages'][snake_case($rule)] = $message;
		return $this;
	}

	/**
	 * Set messages for the rule
	 * 
	 * @param  array $messages Array of messages where the key is the rule and
	 *                         the value is the message
	 * @return Mixed          
	 */
	public function messages(array $messages)
	{
		foreach ($messages as $rule => $message) {
			$this->attributes['messages'][snake_case($rule)] = $message;
		}

		return $this;
	}

	/**
	 * The file must have a MIME type corresponding to one of the listed 
	 * extensions.
	 * 
	 * @param  string|array $values Either a comma seperated string or an array
	 * @return Mixed   
	 */
	public function mimes($mimes)
	{
		if (is_array($mimes)) $mimes = implode(',', $mimes);

		$this->attributes['mimes'] = $mimes;
		return $this;
	}

	/**
	 * The field must not be included in the given list of values.
	 * 
	 * @param  string|array $values Either a comma seperated string or an array
	 * @return Mixed         
	 */
	public function notIn($values)
	{
		if (is_array($values)) $values = implode(',', $values);

		$this->attributes['not_in'] = $values;
		return $this;
	}

	/**
	 * The field must be present if the field field is equal to value.
	 * 
	 * @param  string|array $values Either a comma seperated string or an array
	 * @return Mixed         
	 */
	public function requiredIf($values)
	{
		if (is_array($values)) $values = implode(',', $values);

		$this->attributes['required_if'] = $values;
		return $this;
	}

	/**
	 * The field must be present only if any of the other specified fields are 
	 * present.
	 * 
	 * @param  string|array $values Either a comma seperated string or an array
	 * @return Mixed         
	 */
	public function requiredWith($values)
	{
		if (is_array($values)) $values = implode(',', $values);

		$this->attributes['required_with'] = $values;
		return $this;
	}

	/**
	 * The field must be present only if all of the other specified fields are 
	 * present.
	 * 
	 * @param  string|array $values Either a comma seperated string or an array
	 * @return Mixed         
	 */
	public function requiredWithAll($values)
	{
		if (is_array($values)) $values = implode(',', $values);

		$this->attributes['required_with_all'] = $values;
		return $this;
	}

	/**
	 * The field must be present only when any of the other specified fields are 
	 * not present.
	 * 
	 * @param  string|array $values Either a comma seperated string or an array
	 * @return Mixed         
	 */
	public function requiredWithout($values)
	{
		if (is_array($values)) $values = implode(',', $values);

		$this->attributes['required_without'] = $values;
		return $this;
	}

	/**
	 * The field must be present only when the all of the other specified fields 
	 * are not present.
	 * 
	 * @param  string|array $values Either a comma seperated string or an array
	 * @return Mixed         
	 */
	public function requiredWithoutAll($values)
	{
		if (is_array($values)) $values = implode(',', $values);

		$this->attributes['required_without_all'] = $values;
		return $this;
	}

	/**
	 * The field must be unique on a given database table. If the column option 
	 * is not specified, the field name will be used.
	 * 
	 * @param  string|array $values  
	 * @return Mixed         
	 */
	public function unique($values)
	{
		if (is_array($values)) $values = implode(',', $values);

		$this->attributes['unique'] = $values;
		return $this;
	}

	/**
	 * Put the rules attribute into a string ready for the validator
	 * 
	 * @return string 
	 */
	public function toRule($debug = false)
	{
		$rule = '';
		foreach ($this->getAttributes() as $key => $val) {
			$rule .= $key.':'.$val.'|';
		}

		return rtrim($rule, '|');
	}
}