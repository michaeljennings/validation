# Validation [![Latest Stable Version](https://poser.pugx.org/michaeljennings/validation/v/stable)](https://packagist.org/packages/michaeljennings/validation)[![Latest Unstable Version](https://poser.pugx.org/michaeljennings/validation/v/unstable)](https://packagist.org/packages/michaeljennings/validation) [![License](https://poser.pugx.org/michaeljennings/validation/license)](https://packagist.org/packages/michaeljennings/validation)
<p>A laravel 4 validation package aiming to help you clean up your controllers and models, and make validation 
quicker and simpler.</p>
<h2>Installation</h2>
<p>Include the package in your <code>composer.json</code>.</p>
<pre>
  <code>
"michaeljennings/validation": "1.0"
  </code>
</pre>
<p>Run <code>composer install</code> or <code>composer update</code> to download the dependencies.</p>
<p>Once the package has been downloaded add the validation service provider to the list of service providers in 
<code>app/config/app.php</code>.</p>
<pre>
  <code>
'providers' => array(

  'Michaeljennings\Validation\ValidationServiceProvider'
  
);
  </code>
</pre>
<p>Add the <code>Validation</code> facade to your aliases array.</p>
<pre>
  <code>
'aliases' => array(

  'Validation' => 'Michaeljennings\Validation\Facades\Validation',
  
);
  </code>
</pre>
<p>Publish the config files using the <code>php artisan config:publish michaeljennings/validation</code></p>
<p>By default the validators are store in a <code>app/validators.php</code> so you may need to create this file. 
Alternatively if you want to store your validators else where you can update the path in the package config.</p>

<h2>Usage</h2>
<h3>Creating a Validator</h3>
<p>To create a new validator we use the <code>add</code> function. This function takes two arguments, a name for the 
validator to be called by and a closure with the rules for the validator.</p>
<pre>
  <code>
Validation::add('exampleValidator', function($validator)
{

  $validator->rule('name')->required();
  
});
  </code>
</pre>
<p>To break this down the <code>Validation::add('exampleValidator', function($validator) {});</code> adds a new 
validator into a collection with the name <code>'exampleValidator'</code>.</p>
<p>We then add all of our validation rules on the <code>$validator</code> object. To create a new rule we use the 
<code>rule</code> function and then we can chain the laravel validation rules on the rule object.</p>
<p>For example if we wanted to validate an email field to make sure a value was passed and that the value was a valid 
email address we could use <code>$validator->rule('email')->required()->email();</code>.</p>
<p>The validation rules can either be camel cased or snake cased so both 
<code>$validator->('foo')->requiredWith('bar');</code> and <code>$validator->('foo')->required_with('bar');</code> 
are valid.</p>
<p>To see all of the available validation rules 
<a href="http://laravel.com/docs/4.2/validation#available-validation-rules" target="_blank">see the laravel docs.</a>
<h3>Validation Error Messages</h3>
<p>If you need to set a different validation error message we can use the <code>message</code> function. The 
message function takes two arguments, the validation rule the message is shown for and the error message.</p>
<pre>
  <code>
$validator->rule('foo')->required()->message('required', 'This is a different validation message');
  </code>
</pre>
<h3>Using a Validator</h3>
<p>To run a validator we use the <code>make</code> function. This function takes two arguments, the name of the 
validator we want to run and the input to be validated. When we call the make function the validator is bound to the 
validation class so we can call any of the laravel validation functions on the Validation facade.</p>
<pre>
  <code>
Validation::make('exampleValidator', Input::all());

if (Validation::passes()) {
 // Handle success
} else {
  return Redirect::back()->withErrors(Validation::errors());
}
  </code>
</pre>
<p>You can also chain functions when using the <code>make</code> function, for example:</p>
<pre>
  <code>
if (Validation::make('exampleValidator', Input::all())->fails()) {
  return Redirect::back()->withErrors(Validation::errors());
}
  </code>
</pre>
<p>If you need to add a rule to the validator after it has been made you can do so by using the <code>rule</code>
function to create the new rules and then the <code>createRules</code> function to update the validators rules.</p>
<pre>
  <code>
Validation::make('exampleValidator', Input::all());

Validation::rule('foo')->required();
Validation::createRules();
  </code>
</pre>
