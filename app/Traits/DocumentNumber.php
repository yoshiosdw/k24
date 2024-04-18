<?php

namespace App\Traits;

use App\Models\SequenceNumber;
use Illuminate\Support\Str;

trait DocumentNumber {

  protected static function generateSequenceNumber($code){
    $number = SequenceNumber::where('code', '=', $code)->first();
    $prefix = $number->prefix;

    $countOfDigit = $number->digit_count;
    $lastUsed = $number->last_number;
    $temp = str_pad($lastUsed, $countOfDigit, '0', STR_PAD_LEFT);

    $number->last_number = $number->last_number + 1;
    $number->save();
    return $prefix . '-' . $temp;
  }

}

?>