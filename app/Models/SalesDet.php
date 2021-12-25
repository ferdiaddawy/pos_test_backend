<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDet extends Model
{
    use HasFactory;
    protected $table = 'sales_det';
    protected $fillable = [
        'sales_idmstr',
        'product',
        'qty',
        'price',
        'subtotal',
    ];
}
