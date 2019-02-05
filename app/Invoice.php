<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use Tenant;
    
    const DEFAULT_OPERATION_TYPE = '101';
    const DEFAULT_DOCUMENT_TYPE = '01';
    const PERUVIAN_CURRENCY = 'PEN';
    const STATUS_PAID = 'PAGADO';

    protected $fillable = [
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
        'sunat_operation_type', // Catalog. 51
        'sunat_document_type', //Catalog. 01
        'created_by',
        'company_id'
    ];

    protected $attributes = [
        'sunat_operation_type' => self::DEFAULT_OPERATION_TYPE,
        'sunat_document_type' => self::DEFAULT_DOCUMENT_TYPE,
        'currency_code' => self::PERUVIAN_CURRENCY,
        'status' => self::STATUS_PAID
    ];

    protected $visible = [
        'id', 
        'serie', 
        'correlative', 
        'currency_code', 
        'creation_date', 
        'expiration_date', 
        'status',
        'subtotal',
        'tax',
        'discount',
        'total'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function items() {
        return $this->hasMany(InvoiceItem::class);
    }

    public function scopePurchases($query) {
        return $query->whereHas('customer', function($query) {
            $query->where('type', Customer::SUPPLIER);
        });
    }

    public function getSubtotalAttribute($value) {
        return number_format($value, 2, '.', '');
    }

    public static function listStates() {
        return [
            'PENDIENTE', 'PAGADO'
        ];
    }

    public static function calculateSummary(array $items) {

        $igv_percent = self::IGV();
        $subtotal = collect($items)->sum('subtotal');
        $tax = $subtotal * ($igv_percent/100);
        $total = $subtotal + $tax;
        
        return [
            'igv_percent' => $igv_percent, 
            'subtotal' => $subtotal, 
            'tax' => $tax, 
            'total' => $total
        ];
    }

    public static function IGV() {
        return 18;
    }
}
