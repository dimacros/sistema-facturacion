<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            //'slug' => 'unique_per_company:stores,slug', 
            'address' => 'required',
            'is_primary' => 'nullable|boolean'
        ];            
        /*
            'slug' => Rule::unique('stores,slug')->where(function ($query) {
                return $query->where('company_id', 1);
            }),
        */
    }

    protected function prepareForValidation()
    {
        if ($this->has('name')) {
            $this->merge(['slug'=> str_slug($this->name)]);
        }  
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Nombre de la Tienda',
            'address' => 'Dirección'
        ];
    }

}
