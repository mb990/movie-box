<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\ProductService;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Factory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AddToWishlistRequest extends FormRequest
{

    protected $productService;
    protected $product;

    public function __construct(Request $request1, ProductService $productService, array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->productService = $productService;

        $this->product = $this->productService->findBySlug(request()->slug);

        $request1->merge(['product_id' => $this->product->id]);
//        dd($this->request);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {

            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'product_id' => [Rule::unique('wishlist', 'product_id')->where(function ($query) {
                $query->where('user_id', \auth()->user()->id);
            }),
            ],
        ];

        return $rules;
    }

    public function messages()
    {

        return[
            'product_id.unique' => 'Item is already in your wishlist'
        ];
    }
}
