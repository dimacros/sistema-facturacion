<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    const PERUVIAN_CURRENCY = 'PEN';
    const STATUS_PAID = 'PAGADO';

    protected $fillable = [
        'operation_type_code', // Catalog. 51
        'document_type_code', //Catalog. 01
        'serie',
        'correlative',
        'currency_code', //Catalog. 02
        'creation_date',
        'expiration_date',
        'customer_id',
        'status',
        'subtotal',
        'igv_percent',
        'tax', 
        'discount',
        'total',
        'user_id',
        'company_id'
    ];

    protected $attributes = [
        'currency_code' => self::PERUVIAN_CURRENCY,
        'status' => self::STATUS_PAID
    ];

    public static function listStatus() {
        return [
            'PENDIENTE', 'PAGADO'
        ];
    }

    public static function IGV() {
        return 18;
    }

    public function items() {
        return $this->hasMany(InvoiceItem::class);
    }
}
