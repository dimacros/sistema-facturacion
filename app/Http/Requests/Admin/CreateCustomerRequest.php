<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
            'document_type' => ['required', 'string'],
            'document_value' => [
                'required', 
                'numeric',
                'unique:customers,document_value,NULL,id,company_id,' . $this->user()->company_id
            ],
            'company_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:Consumidor,Proveedor'],
            'contact.name' => ['nullable', 'string', 'max:255'],
            'contact.phone' => ['nullable', 'string', 'max:15'],
            'contact.email' => ['nullable', 'email']
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
            'document_type' => 'Tipo de Documento',
            'document_value' => 'Número del Documento',
            'company_name' => 'Nombre o Razón Social',
            'address' => 'Dirección',
            'type' => 'Tipo de Cliente',
            'contact.name' => 'Nombre de Contacto',
            'contact.phone' => 'Teléfono de Contacto',
            'contact.email' => 'Correo eletrónico de Contacto'
        ];
    }
}
