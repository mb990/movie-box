<?php

namespace App\Http\Requests;

use App\Rules\ValidateFilterData;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\ValidationService;
use Illuminate\Validation\Rule;

class FilterProductsRequest extends FormRequest
{
    protected $validationService;

    public function __construct(ValidationService $validationService, array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->validationService = $validationService;;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'min_rating' => 'required_without_all:max_rating,min_year,max_year',
            'max_rating' => 'required_without_all:min_rating,min_year,max_year',
            'min_year' => 'required_without_all:min_rating,max_rating,max_year',
            'max_year' => 'required_without_all:min_rating,max_rating,min_year'
//            'min_year' => new ValidateFilterData($this, $this->validationService)
        ];
    }

    public function messages()
    {
        return [
            'min_rating.required_without_all' => 'Choose at least one filter',
            'max_rating.required_without_all' => 'Choose at least one filter',
            'min_year.required_without_all' => 'Choose at least one filter',
            'max_year.required_without_all' => 'Choose at least one filter'
        ];
    }
}
