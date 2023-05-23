<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FileOrString implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (gettype($value) !== 'string' && gettype($value) !== 'object') {
            $fail('The :attribute type must be stirng or file');
            dump(gettype($value));
        }
    }
}
