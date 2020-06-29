<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProRequest extends FormRequest
{
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
            'name' => 'required|unique:categories,name',
            'quantity' => 'required',
            'price' => 'required',
        ];
    }
        public function messages(){
        return [
            'name.required' => 'Please Enter Name Product',
            'name.unique' => 'Product Name Is Exist ',
            'quantity.required' =>'Please Enter Name Quantity',
            'price.required' =>'Please Enter Name Price',

        ];
    }
}
