<?php

namespace App\Http\Requests\Admin;

use App\Invoice;
use App\System\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateInvoiceRequest extends FormRequest
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
            'serie' => [
                'required',
                'string', 
                'alpha_num', 
                'size:4'   
            ],
            'correlative' => [
                'required', 
                'numeric',
                Rule::unique('invoices', 'correlative')->where('company_id',  $this->company_id())  
            ],
            'currency_code' => [
                'required', 
                'string', 
                'size:3', 
                Rule::in(Currency::list())
            ],
            'creation_date' => ['required', 'date'],
            'expiration_date' => ['nullable', 'date', 'after:creation_date'],
            'customer_id' => [
                'required',
                Rule::exists('customers', 'id')->where('company_id', $this->company_id())
            ],
            'status' => [
                'required', 
                'string',
                Rule::in(Invoice::listStates())
            ],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => [
                'required',
                Rule::exists('products', 'id')->where('company_id', $this->company_id())
            ],
            'items.*.code' => ['required', 'size:4'],
            'items.*.description' => ['required', 'string', 'max:255'],
            'items.*.quantity' => ['required', 'numeric'], 
            'items.*.price' => ['required', 'numeric', 'min:0']
        ];
    }

    private function company_id() {
        return $this->user()->company_id;
    }

    public function attributes()
    {
        return [
            'customer_id' => 'Proveedor'
        ];
    }
}
