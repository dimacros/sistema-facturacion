<?php

namespace App\System;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public static function list() {
        return [
            'PEN', 'USD'
        ];
    }
}
