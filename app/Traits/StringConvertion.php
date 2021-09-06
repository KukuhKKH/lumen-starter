<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

trait StringConvertion {
    public function generateInvoiceTrx($prefix) {
        $str = $prefix;
        $str .= "-" . Carbon::now()->format("ymdHi");
        return $str;
    }
}
