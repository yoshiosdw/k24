<?php

namespace App\Traits;

use App\Models\SequenceNumber;
use Dotenv\Util\Str;

trait Numbering {

  protected static function generateSequenceNumber($code){
    $number = SequenceNumber::where('code', '=', $code)->first();
    $prefix = $number->prefix;
    $countOfDigit = $number->count_of_digit;
    $lastUsed = $number->last_number;
    $countOfUsed = Str::len($lastUsed+1);
    $temp = "";
    $next = $lastUsed + 1;

    for ($i=0; $i < $countOfDigit - $countOfUsed; $i++) { 
      $temp = $temp . '0';
    }

    $number->last_number = $number->last_number + 1;
    $number->save();
    return $prefix.$temp.$next;
  }

}

?>