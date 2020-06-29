<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPromotionRequest extends FormRequest
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
            'price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ];
    }
     public function messages(){
        return [
            'price.required' => 'Please Enter Name Price',
            'start_date.required' =>'Please Enter Name Start_date',
            'end_date.required' =>'Please Enter Name End_date',
        ];
    }
}
