<?php

namespace App\Helpers;
use App\Models\Numbering;

class Utils
{
  public static function TransactionCode()
  {
    $no = Numbering::where('note', 'sales')->first()->value;
    Numbering::where('note', 'sales')->increment('value', 1);
    return 'TR' . date("y") . date("m") . sprintf("%03d", $no);
  }
}
