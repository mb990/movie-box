<?php


namespace App\Services;

use Illuminate\Foundation\Http\FormRequest;

class ValidationService
{
    public function __construct()
    {
        //
    }

    public function validateFile($product) {

        $data = [
            $product->title,
            $product->year,
            $product->rating,
            $product->length,
            $product->rating_votes,
            $product->poster,
            $product->plot,
            $product->trailer->link
        ];

        foreach ($data as $field) {

            if (empty($field)) {

                return false;
            }
        }

        return true;
    }

    public function validateFilterData(FormRequest $request) {

//        if ($this->checkIfEmpty($request)) {
//
//            return false;
//        }

        $this->fixData($request);

//        $this->addDefaultValues($request);

        return true;
    }

    public function fixData(FormRequest $request) {

        if ($request->min_rating > $request->max_rating) {

            $request->max_rating = floatval(10);
        }

        if ($request->min_year > $request->max_year) {

            $request->max_year = intval(date("Y"));
        }
    }

    public function addDefaultValues(FormRequest $request) {

        if (!$request->filled('min_rating')) {

            $request->min_rating = floatval(1);
        }

        if (!$request->filled('max_rating')) {

            $request->max_rating = floatval(10);
        }

        if (!$request->filled('min_year')) {

            $request->min_year = intval(1970);
        }

        if (!$request->filled('max_year')) {

            $request->max_year = intval(date("Y"));
        }
    }

    public function checkIfEmpty(FormRequest $request) {

        if (empty($request->min_rating) && empty($request->max_rating) &&
            empty($request->min_year) && empty($request->max_year)) {

            return true;
        }

        return false;
    }
}
