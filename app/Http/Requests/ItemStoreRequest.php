<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'nullable',
            'type'=> 'required',
            'currency'=> 'required',
            'cost'=> 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'type.required' => 'Type is required!',
            'currency.required' => 'Currency is required!',
            'cost.required' => 'Cost is required!'
        ];
    }
}
