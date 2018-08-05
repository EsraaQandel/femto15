<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Company;

class ValidDomain implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   

    	$accepted_domains = Company::all()->pluck('domain')->toArray();
        //$accepted_domains = ['gmail.com','yahoo.com'];
        $email_parts = explode('@',trim($value));
        $domain = array_pop($email_parts);
        if (in_array($domain, $accepted_domains)){
 			return true;
        }

        return false;
      
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This is not a valid domain.';
    }
}
