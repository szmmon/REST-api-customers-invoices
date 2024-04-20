<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // $user = $this->user(); 
        // return $user != null && $user->tokenCan('create');
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
            'name' => ['sometimes'],
            'type' => ['sometimes', Rule::in(['I', 'B', 'i', 'b'])],
            'email' => ['sometimes', 'email'],
            'city' => ['sometimes'],
            'postalCodeMax' => ['sometimes','integer'],
            'postalCodeMin' => ['sometimes','integer'],
            'address' => ['sometimes']
        ];
    }
}
