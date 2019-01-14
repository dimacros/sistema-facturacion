<?php

namespace App\Http\Requests\Admin;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'code' => Product::CODE_PREFIX . $this->input('code')
        ]);
    }

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
            'code' => [
                'required', 
                'alpha_num', 
                'size:4', 
                'unique:products,code,NULL,id,company_id,' . $this->user()->company_id
            ],
            'description' => ['required', 'string', 'max:255'],
            'currency_code' => ['required', 'string', 'max:3'],
            'unit_code' => ['required', 'string', 'max:3'],
            'images.*' => ['sometimes', 'image', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0']
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'code' => 'Código',
            'description' => 'Descripción',
            'currency_code' => 'Tipo de Moneda',
            'unit_code' => 'Unidad de Medida',
            'images.*' => 'Imagen del Producto',
            'price' => 'Precio'
        ];
    }
}
