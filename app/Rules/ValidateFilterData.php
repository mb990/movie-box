<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\ValidationService;
use Illuminate\Foundation\Http\FormRequest;

class ValidateFilterData implements Rule
{
    protected $request;
    protected $validationService;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(FormRequest $request, ValidationService $validationService)
    {
        $this->request = $request;
        $this->validationService = $validationService;
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

        return $this->validationService->validateFilterData($this->request);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "You didn't add any criteria.";
    }
}
