<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper
{

    public static function countMonth($end, $start)
    {
        return Carbon::parse($end)->diffInMonths(Carbon::parse($start));
    }
}
