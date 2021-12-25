<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numbering extends Model
{
    use HasFactory;
    protected $table = 'numbering';
    public $timestamps = false;
}
