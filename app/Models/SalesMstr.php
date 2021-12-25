<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesMstr extends Model
{
    use HasFactory;
    protected $table = 'sales_mstr';
    protected $fillable = [
        'code',
        'date',
        'customer',
        'total_discount',
        'total_amount',
        'total_pay',
    ];
}
