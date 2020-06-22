<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCateRequest extends FormRequest
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
            'name' => 'required|unique:categories,name|min:3|max:255',
            'desription' => 'required'
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Please Enter Name Category',
            'name.min' => 'Attribute length of 3-255 characters ',
            'name.max' => 'Attribute length of 3-255 characters ',
            'name.unique' => 'Category Name Is Exist ',
            'desription.required' =>'Please Enter Name Desription',
        ];
    }
}
