<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Backend validation for Form fields of Vue component:Posts/Create.vue which submit to Api:PostController
            // store() method. If validation fails, Laravel redirects back to same page with error message(s)
            'title' => ['required'],
            'text' => ['required'],
            'category_id' => ['required',  'exists:categories,id'],
        ];
    }
}

/*

    Each field must have set of validation rules which can be placed in Controller or separate Form Request class.

    First method: To add them in Controller:PostController store() method, We must validate Request and call
    `validate()` method and provide fields with rules in array

    Second method: To add them in Request Class:StorePostRequest, replace Request type in Controller:PostController
    store() method from request to StorePostRequest. Add all validation fields into StorePostRequest rules() method

    authorize() method check if user is authorized for request which could contain more checks like user role


    https://laraveldaily.com/lesson/laravel-beginners/form-validation-controller-form-requests
    https://laravel.com/docs/12.x/validation#form-request-validation

*/
