<?php

namespace App\Rules;

use App\Product;
use Illuminate\Contracts\Validation\Rule;
use App\Services\ProductService;

class IsInWishlist implements Rule
{
    protected $productService;
    protected $product;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
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
        $product = $this->productService->find($value);

        return auth()->user()->hasProduct($product);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Cannot delete item, it is not in your wishlist';
    }
}
