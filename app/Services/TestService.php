<?php


namespace App\Services;


class TestService {

    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var ProductService
     */
    private $productService;
    /**
     * @var ValidationService
     */
    private $validationService;

    public function __construct(UserService $userService, ProductService $productService, ValidationService $validationService)
    {
        $this->userService = $userService;
        $this->productService = $productService;
        $this->validationService = $validationService;
    }

}
