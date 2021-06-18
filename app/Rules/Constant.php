<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Constant implements Rule
{
    private $constClass;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($constClass)
    {
        $this->constClass = $constClass;
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
        if($this->constClass::getOption($value) !== null) {
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
        return 'The :attribute value is invalid!';
    }
}
