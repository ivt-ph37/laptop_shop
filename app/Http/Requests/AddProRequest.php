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
            'RAM' => 'required',
            'VGA' => 'required',
            'operating_system' => 'required',
            'CPU' => 'required',
            'guarantee' => 'required',
            'description' => 'required',
            'sales_volume' => 'required',
            // 'image' => 'image'
        ];
    }
        public function messages(){
        return [
            'name.required' => 'Please Enter Name Product',
            'name.unique' => 'Product Name Is Exist ',
            'quantity.required' =>'Please Enter Name Quantity',
            'price.required' =>'Please Enter Name Price',
            'RAM.required' =>'Please Enter Name RAM',
            'VGA.required' =>'Please Enter Name VGA',
            'operating_system.required' =>'Please Enter Name Operating_System',
            'CPU.required' =>'Please Enter Name CPU',
            'guarantee.required' =>'Please Enter Name Guarantee',
            'description.required' =>'Please Enter Name Desription',
            'sales_volume.required' =>'Please Enter Name Sales_volume',
            // 'image.image'=>'Please select images with .jpeg, .jpg, .png extensions',
        ];
    }
}
